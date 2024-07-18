<!doctype html>
<html class="no-js" lang="{{ env('LANGUAGE') }}">
<head>
    @include('analytics.head_front')
    <title>{{ $post->title }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Jakub Owsianka">
    <link rel="canonical" href="{{ $url }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="description" content="{{ $post->description_meta ?? $post->short_description }}">
    <meta property=”og:title” content=”{{ $post->title }}” />
    <meta property=”og:description” content="{{ $post->short_description }}" />
    <meta property="og:type" content="website" />
    @if($post->image_url !== null)
        <meta property=”og:image” content=”{{ \App\Helper\ImageHelper::getImage($post->image_url) }}” />
    @endif


    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/apple-touch-icon-114x114.png') }}">
    <!-- style sheets and font icons  -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/new-style.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('analytics.head_end')
</head>
<body class="bg-oatllo" data-mobile-nav-style="classic">

<div class="relative isolate overflow-hidden py-16 sm:py-24 lg:py-32">

    <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-oatllo-article text-oatllo-article rounded-3xl shadow-xl py-5 article-oattlo mb-8 flex justify-between justify-center items-center">
        <a href="{{ asset('/') }}" class="logo">oatllo</a>
        <a href="{{ asset('/blog') }}" class="underline underline-offset-8">Blog</a>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-oatllo-article text-oatllo-article rounded-3xl shadow-xl py-5 article-oattlo">
        <div class="article-oattlo-header text-3xl font-bold tracking-tight sm:text-6xl">

            <!-- Title -->
            <h1>{{ $post->title }}</h1>

            <!-- Short Description -->
            @if(!empty($post->short_description)) <p class="mt-6 text-lg">{{ $post->short_description }}</p> @endif
            @if(!empty($course)) <p class="mt-6 text-lg">{{ $course->name }}</p> @endif

            <!-- Image -->
            @if($post->image_url !== null)
                <img class="border-radius-8px md-no-margin-bottom justify-between items-center" src="{{ \App\Helper\ImageHelper::getImage($post->image_url) }}" alt="{{ $post->title }}" />
            @endif

            <!-- Avatar -->
            <div class="flex items-center gap-x-6 avatar">
                <img class="h-16 w-16 rounded-full" src="{{ asset('/images/j-o-avatar.webp') }}" alt="Avatar - Owsianka Jakub">
                <div>
                    <h3 class="text-base font-semibold leading-7 tracking-tight">Autor</h3>
                    <p class="text-sm leading-6 font-semibold">Jakub Owsianka</p>
                </div>
            </div>
        </div>

        @foreach($post->contents as $content)

            @if($content->type === 'text')
                {!! $content->content !!}
            @elseif($content->type === 'image')
                <img src="{{ \App\Helper\ImageHelper::getImage($content->image_url) }}"  alt="{{ $content->image_alt }}" class="rounded"/>
            @endif
        @endforeach
    </div>

    @if(!empty($proposedArticle))
    <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-oatllo-article text-oatllo-article rounded-3xl shadow-xl py-5 article-oattlo mt-8 see-other-oattlo">
        <p><strong>Zobacz inne artykułu:</strong></p>

        <ul>
            @foreach($proposedArticle as $article)
                <li>
                    <a href="{{ route('blogPost', ['slug' => $article->slug]) }}">{{ $article->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>
</body>
