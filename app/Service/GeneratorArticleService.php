<?php

namespace App\Service;

use App\Api\LLM\LanguageModelSettings;
use App\Api\LLM\LanguageModelType;
use App\Api\LLM\OpenApi\OpenAiLanguageModel;
use App\Api\MyVpsApplication\Dto\ChatGptCollectionDto;
use App\Api\MyVpsApplication\Dto\ChatGptCollectionRequestDto;
use App\Api\MyVpsApplication\Dto\ChatGptCollectionRequestModelDto;
use App\Api\MyVpsApplication\GeneratorChatGptCollection;
use App\Enum\BlogContentType;
use App\Enum\SocialType;
use App\Models\Blog;
use App\Models\BlogContent;
use App\Models\SocialPost;

class GeneratorArticleService
{

    const WEBHOOK = 'https://oatllo.pl/api/callback/generate/data/';

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
Nagłówki powinny być dostosowane pod SEO. Wykorzystaj jak najwięcej słów kluczowych w nagłówkach. Nagłówki muszą być zgodne z treścią artykułu. Oprócz oczywistych fraz, powinien zawierać frazy powiązane.
###
Dołącz spis treści na początku wpisu, po wstępie, linkując do każdej pozycji na liście (za pomocą linków skokowych).

### NIE UŻYWAJ MARKDOWN W ARTYKULE, jedyni możesz użyć znaczników html

### Rozbudowywuj każdą treść. Jeśli podajesz nagłówek to treść musi mieć minimum 7 zdań.
';

    const GENERATE_ARTICLE_ONLY_CONTENT_PROMPT = '
    Na podstawie konspektu, który poda użytkownik przygotuj treść artykułu na bloga.
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

### Rozbudowywuj każdą treść. Jeśli podajesz nagłówek to treść musi mieć minimum 10 zdań.
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
"short_description": (opis zachęcający  do przeczytania - umieszczany pod tytułem artykułu - ma się składać z max 20 słów, min 16),
"slug": (slug do url artykułu, aby był zgodny z seo),
"title": (tytuł artykułu, który będzie widoczny na blogu),
"title_meta": (tytuł artykułu wyświetlany na pasku przeglądarki. Ma być zgodny z SEO),
"description_meta": (opis artykułu wyświetlany w wyszukiwarce. Ma być zgodny z SEO. Ma mieć 150-160 znaków)
}

### Odpowiedź podaj w JSON i tylko JSON';

    const GENERATE_ARTICLE_DESIGN = 'Popraw aby treść była ciekawa i wciągająca do czytania,
W związku z tym pogrób za pomocą <strong>, najważniejsze informacje informacje, oddziel różne fragmenty pomocą paragrafów <p>, podkreśl warte informacje za pomocą <u>. Za pomocą znaczników html możesz nadać treści odpowiedni wygląd.
Za pomocą znaczników html zrób wszystko aby tekst był ciekawy do czytania
';


    public function __construct(
        private OpenAiLanguageModel $openAiLanguageModel,
        private GeneratorChatGptCollection $generatorChatGptCollection
    ){}

    public function generate(int $socialPostId, string $language, bool $withContent = true): void
    {
        set_time_limit(900);

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
        $titleMeta = $generatedContent['title_meta'];
        $descriptionMeta = $generatedContent['description_meta'];
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
            'activated' => false,
            'title_meta' => $titleMeta,
            'description_meta' => $descriptionMeta,
        ]);

        if($withContent){
            $this->generateContentForArticle($blog->id, $language);
        }
    }

    public function generateContentForArticle(int $blogId, string $language): void
    {
        set_time_limit(900);
        $blog = Blog::where('id', $blogId)->first();

        $language = ($language == 'pl') ? 'polskim' : 'angielskim';

        $messages = [];
        $currentMessage = $blog->title;
        $countOfGeneratedContent = rand(4,8);


        $params = new ChatGptCollectionRequestDto();
        $params->setIdExternal($blogId);
        $params->setTemperature('1');
        $params->setType('ARTICLE');
        $params->setModel(ChatGptCollectionRequestModelDto::GPT_4);
        $collection = [];

        for($i = 0; $i <= $countOfGeneratedContent; $i++) {

            if($i > 0 && $i < $countOfGeneratedContent) {
                $currentMessage = 'Kontynuuj';
            }elseif ($i === $countOfGeneratedContent) {
                $currentMessage = 'Dokończ to o czytm chciałeś napisać. Przejdź po mału do końca i napisz podsumowanie';
            }

            $content = BlogContent::create([
                'blog_id' => $blog->id,
                'header' => null,
                'content' => null,
                'image_url' => null,
                'type' => BlogContentType::TEXT->value,
                'sequence' => $i,
                'status_generated' => 1
            ]);

            $collectionParams = new ChatGptCollectionDto();
            $collectionParams->setIdExternal($content->id);
            $collectionParams->setSort($i);
            $collectionParams->setPrompt($currentMessage);
            $collectionParams->setWebhook(self::WEBHOOK . $content->id);
            $collectionParams->setWebhookType('ARTICLE_CONTENT');
            $collectionParams->setSystem(self::GENERATE_ARTICLE_CONTENT_PROMPT. ' ### Artykuł napisz w języku: '. $language);

            $collection[] = $collectionParams;

            // Generate Decoration Content
            $collectionParams = new ChatGptCollectionDto();
            $collectionParams->setIdExternal($content->id);
            $collectionParams->setSort($i);
            $collectionParams->setSystem(self::GENERATE_ARTICLE_DESIGN);
            $collectionParams->setWebhook(self::WEBHOOK . $content->id);
            $collectionParams->setWebhookType('ARTICLE_CONTENT');
            $collectionParams->setPrompt('[LAST_MESSAGE_WITH_SAME_ID_EXTERNAL]');
            $collectionParams->setAddLastMessage(false);

            $collection[] = $collectionParams;
        }


        $params->setCollection($collection);

        $this->generatorChatGptCollection->generateContentByCollection($params);
    }

    public function generateContentForBlog(int $contentId)
    {
        set_time_limit(900);
        $blogContent = BlogContent::where('id', $contentId)->first();
        $blog = Blog::where('id', $blogContent->blog_id)->first();


        $language = ($blog->language == 'pl') ? 'polskim' : 'angielskim';

        $params = new ChatGptCollectionRequestDto();
        $params->setIdExternal($blog->id);
        $params->setTemperature('1');
        $params->setType('ARTICLE');
        $params->setModel(ChatGptCollectionRequestModelDto::GPT_4);
        $collection = [];


        $collectionParams = new ChatGptCollectionDto();
        $collectionParams->setIdExternal($blogContent->id);
        $collectionParams->setSort($blogContent->sequence);
        $collectionParams->setPrompt($blogContent->content);
        $collectionParams->setWebhook(self::WEBHOOK . $blogContent->id);
        $collectionParams->setWebhookType('ARTICLE_CONTENT');
        $collectionParams->setAddLastMessage(true);
        $collectionParams->setSystem(self::GENERATE_ARTICLE_CONTENT_PROMPT. ' ### Artykuł napisz w języku: '. $language);
        $blogContent->status_generated = 1;
        $blogContent->save();

        $collection[] = $collectionParams;

        $params->setCollection($collection);

        $this->generatorChatGptCollection->generateContentByCollection($params);
    }

    public function generateDecorationContentForBlog(int $contentId): ChatGptCollectionDto
    {
        set_time_limit(900);
        $contentToGenerate = BlogContent::where('id', $contentId)->first();
        $contentToGenerate->status_generated = 1;
        $contentToGenerate->save();

        $collectionParams = new ChatGptCollectionDto();
        $collectionParams->setIdExternal($contentToGenerate->id);
        $collectionParams->setSystem(self::GENERATE_ARTICLE_DESIGN);
        $collectionParams->setWebhook(self::WEBHOOK . $contentToGenerate->id);
        $collectionParams->setWebhookType('ARTICLE_CONTENT');
        $collectionParams->setPrompt($contentToGenerate->content);
        $collectionParams->setSort(null);
        $collectionParams->setAddLastMessage(false);

        return $collectionParams;
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
        set_time_limit(900);
        $postLanguage = $article->language == 'pl' ? 'polskim' : 'angielskim';
        $systemPrompt = '
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

    public function generateTitle(): string
    {
        $lastTitle = '';

        $titles = SocialPost::select('title')->orderBy('created_at', 'desc')->limit(12)->get()->toArray();
        $titles = array_column($titles, 'title');
        foreach ($titles as $title){
            $lastTitle .= '- "' . $title . '",';
        }

        if(!empty($lastTitle)){
            $lastTitle = "# Nie pisz o tych tematach (ostatnie 20 artykułów)" . $lastTitle;
        }

        $systemPrompt = 'You are Title Generator GPT, a professional content marketer who helps writers, bloggers, and content creators with crafting captivating titles for their articles.
                        Wygeneruj tytuł artykułu dla bloga skierowanym do programistów.

                        Artykuły tam są o symfony, laravel, wzorce projektowy, SOLID, ciekawostki PHP, wszystko o programowaniu co ciekawi programistów.

                        Blog po prostu jest dla osób, które chcą się dowiedzieć fajnych rzeczy o programowaniu.
                        Jak masz coś opisywać z programowania to w języku PHP

                        Docelowi odbiorcy: Programiści PHP
                        ' . $lastTitle . '

                        ### Odpowiedź podaj w JSON i tylko JSON
                        {
                        "title": (generated title)
                        }';


        $generatedContent = $this->openAiLanguageModel->generate(
            prompt: '',
            systemPrompt: $systemPrompt,
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::NORMAL),
        );

        $title = json_decode($generatedContent, true)['title'];

        SocialPost::create([
            'title' => $title,
            'date_post' => date('Y-m-d')
        ]);

        return $title;
    }

    public function generateAllContent(int $socialPostId)
    {
        $blogs = Blog::where('social_post_id', $socialPostId)->get();

        foreach ($blogs as $blog) {
            $params = new ChatGptCollectionRequestDto();
            $params->setIdExternal($blog->id);
            $params->setTemperature('1');
            $params->setType('ARTICLE');
            $params->setModel(ChatGptCollectionRequestModelDto::GPT_4);
            $collection = [];

            $language = ($blog->language == 'pl') ? 'polskim' : 'angielskim';

            $lp = 0;
            foreach ($blog->contents as $content){
                $addedPrompt = '';
                $system = $this->getSystemPromptToGenerateArticle(false);

                if($lp == 0){
                    $system = $this->getSystemPromptToGenerateArticle(true);
                    $addedPrompt = '### Pisząc traktuj tą treść jako wstęp do artykułu. ';
                }else if($lp === $blog->contents->count() - 1){
                    $addedPrompt = '### Pisząc traktuj tą treść jako zakończenie artykułu. ';
                }else{
                    $addedPrompt = '### Pisząc traktuj tą treść jako kontynuację artykułu. Nie pisz podsumowania. Ma być płynne zakończenie. Postaraj się wyczerpać temat';
                }


                $collectionParams = new ChatGptCollectionDto();
                $collectionParams->setIdExternal($content->id);
                $collectionParams->setSort($content->sequence);
                $collectionParams->setPrompt('Artykuł o tytule (pisze dla kontekstu): "' . $blog->title . '", O czym masz pisać: ' .$content->content . ' ' . $addedPrompt);
                $collectionParams->setWebhook(self::WEBHOOK . $content->id);
                $collectionParams->setWebhookType('ARTICLE_CONTENT');
                $collectionParams->setSystem($system . ' ### Artykuł napisz w języku: '. $language);

                $collection[] = $collectionParams;

                // Generate Decoration Content
                $collectionParams = new ChatGptCollectionDto();
                $collectionParams->setIdExternal($content->id);
                $collectionParams->setSort($content->sequence);
                $collectionParams->setSystem(self::GENERATE_ARTICLE_DESIGN . ' ### Pamiętaj aby treść była w języku: '. $language);
                $collectionParams->setWebhook(self::WEBHOOK . $content->id);
                $collectionParams->setWebhookType('ARTICLE_CONTENT');
                $collectionParams->setPrompt('[LAST_MESSAGE_WITH_SAME_ID_EXTERNAL]');
                $collectionParams->setAddLastMessage(false);

                $collection[] = $collectionParams;
                $content->status_generated = 1;
                $content->save();
                $lp++;
            }

            $params->setCollection($collection);
            $this->generatorChatGptCollection->generateContentByCollection($params);
        }
    }

    public function generatePrototype(Blog $blog)
    {
        $postLanguage = $blog->language == 'pl' ? 'polskim' : 'angielskim';

        $contents = $this->openAiLanguageModel->generate(
            prompt: $blog->title,
            systemPrompt: 'Daj przykłady tytuły artykułu oraz spisu treści.
                            ### Napisz w języku: '. $postLanguage .'
                            ###
                            Odpowiedź podaj w json i tylko w json:

                            {
                            "title_article": "XYZ",
                            "table_of_content" [
                            {
                            "header": "XYZ",
                            "content": "XYZ"
                            }
                            ]
                            }',
            settings: (new LanguageModelSettings())->setLanguageModelType(LanguageModelType::INTELLIGENT),
        );


        $json = json_decode($contents, true);

        if(isset($json['table_of_content'])){
            foreach ($json['table_of_content'] as $key => $value) {
                BlogContent::create([
                    'blog_id' => $blog->id,
                    'header' => $value['header'],
                    'content' => $value['content'],
                    'image_url' => null,
                    'type' => BlogContentType::TEXT->value,
                    'sequence' => $key,
                ]);
            }
        }
    }

    public function getSystemPromptToGenerateArticle(bool $withTableOfContents): string
    {
        $tableContent = '';

        if($withTableOfContents){
            $tableContent = '### Dołącz spis treści na początku wpisu, po wstępie, linkując do każdej pozycji na liście (za pomocą linków skokowych).';
        }

        return 'Na podstawie konspektu, który poda użytkownik przygotuj treść artykułu na bloga.
                        Ma być on zgodny z SEO oraz zawierać jak najwięcej słów kluczowych.
                        ###
                        Treść będzie dalej kontynuowana w kolejnych wiadomościach. Dlatego nie kończ jej na jednej. Zwykle będzie kontynuowana 3-4 razy

                        ### Nie pisz podsumowania. Zakończ treść tak żeby możnaby było ją kontynuować w kolejnej. Nie pisz o tym użytkownikowi.
                        Podsumowanie tylko wtedy, kiedy poprosi Cię oto użytkownik

                        ### Nie używaj markdown. W momencie przedstawiania kodu, umieść go między znacznikami:
                        <pre><code class="language-php"> ... </code></pre>
                        '. $tableContent .'

                        ### NIE UŻYWAJ MARKDOWN W ARTYKULE, jedyni możesz użyć znaczników html

                        ### Rozbudowywuj każdą treść. Jeśli podajesz nagłówek to treść musi mieć minimum 10 zdań.';
    }
}
