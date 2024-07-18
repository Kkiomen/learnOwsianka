<!doctype html>
<html class="no-js" lang="{{ env('LANGUAGE') }}">
<head>
    @include('analytics.head_front')
    <title>{{ $course->name }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Jakub Owsianka">
{{--    <link rel="canonical" href="{{ $url }}" />--}}
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="description" content="{{ $course->description }}">
    <meta property=”og:title” content=”{{ $course->name }}” />
    <meta property=”og:description” content="{{ $course->description }}" />
    <meta property="og:type" content="website" />

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
    @if(!empty($course))
        <div class="mx-auto max-w-7xl px-6 lg:px-8 bg-oatllo-article text-oatllo-article rounded-3xl shadow-xl py-5 article-oattlo mt-8 course">

            <h1 class="text-xl font-bold">{{ $course->name }}</h1>
            @if(!empty($course->description))<h2>{{ $course->description }}</h2>@endif

            @foreach($course->courseCategoriesByLanguage() as $category)
                <div class="mt-4">
                    <h2 class="font-bold">{{ $category->name }}</h2>
                    <div>
                        <ul>
                            @foreach($category->blogs() as $lessonCategory)
                                @php
                                    $lesson = $lessonCategory->blog();
                                @endphp
                                @if($lesson && !empty($course->slug) && !empty($category->slug) && !empty($lesson->slug))
                                    <li>
                                        <a href="{{ route('coursePost', ['courseSlag' => $course->slug, 'categorySlug' => $category->slug, 'lessonSlug' => $lesson->slug]) }}">{{ $lesson->title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>
</body>
