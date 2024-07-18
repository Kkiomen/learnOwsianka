<!doctype html>
<html class="no-js" lang="{{ env('LANGUAGE') }}">
<head>
    @include('analytics.head_front')
    <title>{{ __('basic.meta_title_blog') }}</title>
    <meta name="description" content="{{ __('basic.meta_description_blog') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Jakub Owsianka">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1"/>

    @if(!empty($tag))
        <link rel="canonical" href="{{ asset('blog/tag/'. $tag) }}"/>
    @else
        <link rel="canonical" href="{{ asset('blog') }}"/>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @include('analytics.head_end')
</head>
<body class="bg-oatllo" data-mobile-nav-style="classic">

<div class="relative isolate overflow-hidden py-16 sm:py-24 lg:py-32">

    <div
        class="mx-auto max-w-7xl px-6 lg:px-8 bg-oatllo-article text-oatllo-article rounded-3xl shadow-xl py-5 article-oattlo mb-8 flex justify-between justify-center items-center">
        <a href="{{ asset('/') }}" class="logo">oatllo</a>
        <a href="{{ asset('/blog') }}" class="underline underline-offset-8">Blog</a>
    </div>


    <div class="mx-auto max-w-7xl lg:px-8 px-2 md:px-0">
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-2xl sm:py-12">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">{{ __('basic.blog_header') }}</h1>
                    <p class="mt-6 text-lg leading-8 text-white">{{ __('basic.blog_subheader') }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="mx-auto max-w-7xl px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 mt-6">

        @if($posts->count() === 0)

            Brak postów

        @endif

        @foreach($posts as $post)
            <article
                class="flex max-w-xl flex-col items-start justify-between bg-oatllo-article text-oatllo-article mx-2 px-4 py-2 rounded-xl blog-oatllo my-5">
                <div class="group relative">
                    <h3 class="mt-3 text-lg font-semibold leading-6 text-oatllo-article group-hover:text-white">
                        <a href="{{ route('blogPost', ['slug' => $post->slug]) }}">
                            <span class="absolute inset-0"></span>
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-oatllo-article">{{ $post->short_description }}</p>
                </div>
            </article>
        @endforeach
        @foreach($posts as $post)
            <article
                class="flex max-w-xl flex-col items-start justify-between bg-oatllo-article text-oatllo-article mx-2 px-4 py-2 rounded-xl blog-oatllo my-5">
                <div class="group relative">
                    <h3 class="mt-3 text-lg font-semibold leading-6 text-oatllo-article group-hover:text-white">
                        <a href="{{ route('blogPost', ['slug' => $post->slug]) }}">
                            <span class="absolute inset-0"></span>
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-oatllo-article">{{ $post->short_description }}</p>
                </div>
            </article>
        @endforeach
        @foreach($posts as $post)
            <article
                class="flex max-w-xl flex-col items-start justify-between bg-oatllo-article text-oatllo-article mx-2 px-4 py-2 rounded-xl blog-oatllo my-5">
                <div class="group relative">
                    <h3 class="mt-3 text-lg font-semibold leading-6 text-oatllo-article group-hover:text-white">
                        <a href="{{ route('blogPost', ['slug' => $post->slug]) }}">
                            <span class="absolute inset-0"></span>
                            {{ $post->title }}
                        </a>
                    </h3>
                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-oatllo-article">{{ $post->short_description }}</p>
                </div>
            </article>
        @endforeach
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        {{ $posts->links('components.basic.pagination_basic') }}
    </div>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>
</body>
