<?php

namespace App\Service;

use App\Api\LLM\LanguageModelSettings;
use App\Api\LLM\LanguageModelType;
use App\Api\LLM\OpenApi\OpenAiLanguageModel;
use App\Enum\BlogContentType;
use App\Enum\SocialType;
use App\Models\Blog;
use App\Models\BlogContent;
use App\Models\SocialPost;

class GeneratorArticleService
{

    const GENERATE_ARTICLE_CONTENT_PROMPT = '
    Na podstawie tytułu, który poda użytkownik przygotuj treść artykułu na bloga.
Ma być on zgodny z SEO oraz zawierać jak najwięcej słów kluczowych.
###
Treść będzie dalej kontynuowana w kolejnych wiadomościach. Dlatego nie kończ jej na jednej. Zwykle będzie kontynuowana 3-4 razy

### Nie pisz podsumowania. Zakończ treść tak żeby możnaby było ją kontynuować w kolejnej. Nie pisz o tym użytkownikowi.
Podsumowanie tylko wtedy, kiedy poprosi Cię oto użytkownik

### Nie używaj markdown. W momencie przedstawiania kodu, umieść go między znacznikami:
<pre><code class="language-php"> ... </code></pre>

###
Dołącz spis treści na początku wpisu, po wstępie, linkując do każdej pozycji na liście (za pomocą linków skokowych).

### NIE UŻYWAJ MARKDOWN W ARTYKULE, jedyni możesz użyć znaczników html

### Rozbudowywuj każdą treść. Jeśli podajesz nagłówek to treść musi mieć minimum 7 zdań.
';
    /**
     * Na podstawie tytułu, który poda użytkownik przygotuj treść artykułu na bloga.
     * Ma być on zgodny z SEO oraz zawierać jak najwięcej słów kluczowych.
     *
     * ###
     * Treść będzie dalej kontynuowana w kolejnych wiadomościach. Dlatego nie kończ jej na jednej
     *
     * ### Nie pisz podsumowania. Zakończ treść tak żeby możnaby było ją kontynuować w kolejnej. Nie pisz o tym użytkownikowi.
     * Podsumowanie tylko wtedy, kiedy poprosi Cię oto użytkownik
     *
     * ### W momencie przedstawiania kodu, nie używaj markdown, umieść go między znacznikami:
     * <pre><code class="language-php"> ... </code></pre>
     *
     * ### Zrób aby treść była ciekawa i wciągająca do czytania, oddziel za pomocą paragrafów <p>
     * ### Jeśli chcesz dodać nagłówek aby podkreślić kolejną część artykułu, umieść go między znacznikami:
     * <h6 class="alt-font text-extra-dark-gray font-weight-500 margin-20px-bottom mt-5"> ... </h6>
     */

//Informacje przygotuj w języku: polskim
    const GENERATE_ARTICLE_BASIC_INFORMATION_PROMPT = 'Dla tematu artykułu posta przekazanego przez użytykownika, przygotuj informacje.
###
{
"tags": (tagi dla artykułu bloga oddzielona przecinkiem, podaj ich 10),
"short_description": (Krótki opis na 20 znaków opisujący o czym będzie post, zachęcający do przeczytania),
"slug": (slug do url artykułu, aby był zgodny z seo),
"title": (tytuł artykułu, który będzie widoczny na blogu)
}

### Odpowiedź podaj w JSON i tylko JSON';

    const GENERATE_ARTICLE_DESIGN = 'Popraw aby treść była ciekawa i wciągająca do czytania, pogrób za pomocą <strong>, ważne informacje, oddziel za pomocą paragrafów <p>, podkreśl za pomocą <u>. Za pomocą znaczników html możesz nadać treści odpowiedni wygląd.';


    public function __construct(
        private OpenAiLanguageModel $openAiLanguageModel
    )
    {
    }

    public function generate(int $socialPostId, string $language): void
    {
        $socialPost = SocialPost::where('id', $socialPostId)->first();
        $languageToPrompt = ($language == 'pl') ? 'polskim' : 'angielskim';

        $generatedContent = $this->openAiLanguageModel->generate(
            prompt: $socialPost->title,
            systemPrompt: self::GENERATE_ARTICLE_BASIC_INFORMATION_PROMPT. ' ### Informacje przygotuj w języku: '. $languageToPrompt,
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::NORMAL),
        );

        $generatedContent = json_decode($generatedContent, true);

        if(is_array($generatedContent['tags'])){
            $generatedContent['tags'] = implode(',', $generatedContent['tags']);
        }

        $shortDescription = $generatedContent['short_description'];
        $content = null;
        $tags = strtolower($generatedContent['tags']);
        $title = $generatedContent['title'];
        $image_url = null;
        $slug = $generatedContent['slug'];

        $blog = Blog::create([
            'social_post_id' => $socialPost->id,
            'title' => $title,
            'short_description' => $shortDescription,
            'language' => $language,
            'content' => $content,
            'tags' => $tags,
            'image_url' => $image_url,
            'slug' => $slug,
            'activated' => false
        ]);

        $this->generateContentForArticle($blog->id, $language);
    }

    public function generateContentForArticle(int $blogId, string $language): void
    {
        $blog = Blog::where('id', $blogId)->first();

        $language = ($language == 'pl') ? 'polskim' : 'angielskim';

        $messages = [];
        $currentMessage = $blog->title;
        $countOfGeneratedContent = rand(3,4);

        for($i = 0; $i <= $countOfGeneratedContent; $i++) {

            if($i > 0 && $i < $countOfGeneratedContent) {
                $currentMessage = 'Kontynuuj';
            }elseif ($i === $countOfGeneratedContent) {
                $currentMessage = 'Dokończ to o czytm chciałeś napisać. Przejdź po mału do końca i napisz podsumowanie';
            }

            $generatedContent = $this->openAiLanguageModel->generateWithConversation(
                prompt: $currentMessage,
                systemPrompt: self::GENERATE_ARTICLE_CONTENT_PROMPT. ' ### Artykuł napisz w języku: '. $language,
                settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::INTELLIGENT),
                messagesUser: $messages
            );

            $messages[] = ['role' => 'user', 'prompt' => $currentMessage];
            $messages[] = ['role' => 'assistant', 'prompt' => $generatedContent];

            $content = BlogContent::create([
                'blog_id' => $blog->id,
                'header' => null,
                'content' => $generatedContent,
                'image_url' => null,
                'type' => BlogContentType::TEXT->value,
                'sequence' => $i,
            ]);

            $this->generateDecorationContentForBlog($content->id);
        }
    }

    public function generateContentForBlog(int $contentId)
    {

        $contentToGenerate = BlogContent::where('id', $contentId)->first();
        $blog = Blog::where('id', $contentToGenerate->blog_id)->first();


        $language = ($blog->language == 'pl') ? 'polskim' : 'angielskim';

        $messages = [];
        $messages[] = ['role' => 'user', 'prompt' => $blog->title];
        foreach ($blog->contents as $content){
            if($content->id == $contentToGenerate->id) {
                break;
            }
            $messages[] = ['role' => 'assistant', 'prompt' => $content->content];
        }

        $generatedContent = $this->openAiLanguageModel->generateWithConversation(
            prompt: $contentToGenerate,
            systemPrompt: self::GENERATE_ARTICLE_CONTENT_PROMPT. ' ### Artykuł napisz w języku: '. $language,
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::NORMAL),
            messagesUser: $messages
        );

        $contentToGenerate->update([
            'content' => $generatedContent,
        ]);
    }

    public function generateDecorationContentForBlog(int $contentId)
    {
        $contentToGenerate = BlogContent::where('id', $contentId)->first();

        $generatedContent = $this->openAiLanguageModel->generate(
            prompt: $contentToGenerate,
            systemPrompt: self::GENERATE_ARTICLE_DESIGN,
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::INTELLIGENT),
        );
        $contentToGenerate->update([
            'content' => $generatedContent,
        ]);

    }

    public function generatePostToSocialMedia(SocialPost $socialPost, SocialType $socialType, string $language): string
    {

        $postLanguage = $language == 'pl' ? 'polskim' : 'angielskim';
        $systemPrompt = 'Stwórz treść posta na Facebooka.
                        Na początku przedstaw temat w taki sposób aby troche wytłumaczyć temat ale i żeby zachęcić do późniejszego przeczytania artykułu
                        ### Nie możesz się witać z czytelnikiem
                        ### Pisz w pierwszej formie
                        ### Dodaj emotikony aby urozmaicić wpis
                        ### Napisz w języku: '. $postLanguage .'
                        ###
                        Link do postu: '. route('');

        $contentToGenerate = 'sdfsdf';

        return $this->openAiLanguageModel->generate(
            prompt: $contentToGenerate,
            systemPrompt: self::GENERATE_ARTICLE_DESIGN,
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::INTELLIGENT),
        );
    }

    public function generatePostToSocialMediaByBlogArticle(Blog $article, SocialType $socialType): string
    {
        $postLanguage = $article->language == 'pl' ? 'polskim' : 'angielskim';
        $systemPrompt = 'Stwórz treść posta na Facebooka.
                        Na początku przedstaw temat w taki sposób aby troche wytłumaczyć temat ale i żeby zachęcić do późniejszego przeczytania artykułu
                        ### Nie możesz się witać z czytelnikiem
                        ### Pisz w pierwszej formie
                        ### Dodaj emotikony aby urozmaicić wpis
                        ### Napisz w języku: '. $postLanguage .'
                        ###
                        Link do postu: '. route('blogPost', ['slug' => $article->slug]);

        return $this->openAiLanguageModel->generate(
            prompt: $article->title,
            systemPrompt: $systemPrompt,
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::INTELLIGENT),
        );
    }
}
