<!doctype html>
<html class="no-js" lang="{{ env('LANGUAGE') }}">
<head>
    @include('analytics.head_front')
    <title>{{ $post->title_meta ?? $title }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Jakub Owsianka">
    <link rel="canonical" href="{{ $url }}" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="description" content="{{ $post->description_meta ?? $short_description }}">
    <meta property=”og:title” content=”{{ $title }}” />
    <meta property=”og:description” content="{{ $short_description }}" />
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-icons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme-vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/code.css') }}" />
    @include('analytics.head_end')
</head>
<body data-mobile-nav-style="classic">
<!-- start header -->
<header>
    <!-- start navigation -->
    <nav class="navbar top-space navbar-expand-lg navbar-boxed navbar-light bg-transparent header-light fixed-top header-reverse-scroll">
        <div class="container-fluid nav-header-container">
            <div class="col-auto col-sm-6 col-lg-2 me-auto ps-lg-0">
                <a class="navbar-brand-text" href="{{ route('index') }}">
                    oatllo
                </a>
            </div>
            <div class="col-auto menu-order px-lg-0">
                <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @include('components.basic.navigation')
                </div>
            </div>
            <div class="col-auto text-end hidden-xs pe-0 font-size-0">
                @include('components.basic.navigation_icon')
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<!-- end header -->
<!-- start banner section -->
@yield('header')
<!-- end banner section -->
<!-- start section -->
@yield('short_description')
<!-- end section -->
<!-- start section -->
<div class="post-content">
    <section class="pt-0 margin-30px-top lg-no-margin-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 sm-margin-50px-top last-paragraph-no-margin wow animate__fadeIn article-content-box">
                            @yield('content-box')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- start section -->
{{--<section class="pt-0">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-10 d-flex flex-wrap align-items-center mx-auto margin-35px-bottom wow animate__fadeIn">--}}
{{--                <div class="col-12 col-md-9 text-center text-md-start sm-margin-10px-bottom px-0">--}}
{{--                    <div class="tag-cloud">--}}
{{--                        <a href="blog-grid.html">Development</a>--}}
{{--                        <a href="blog-grid.html">Events</a>--}}
{{--                        <a href="blog-grid.html">Media</a>--}}
{{--                        <a href="blog-grid.html">Mountains</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-12 col-md-3 text-center text-md-end px-0">--}}
{{--                    <a class="likes-count text-uppercase text-extra-dark-gray font-weight-500" href="#"><i class="far fa-heart ml-4"></i><span>05 Likes</span></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-10 mx-auto margin-60px-bottom md-margin-30px-bottom">--}}
{{--                <div class="d-block d-md-flex w-100 box-shadow-small align-items-center border-radius-5px padding-4-rem-all">--}}
{{--                    <div class="w-130px text-center margin-60px-right sm-margin-auto-lr">--}}
{{--                        <img src="https://via.placeholder.com/125x125" class="rounded-circle w-110px" alt=""/>--}}
{{--                        <a href="blog-grid.html" class="text-extra-dark-gray alt-font font-weight-500 margin-20px-top d-inline-block text-medium">Colene Landin</a>--}}
{{--                        <span class="text-medium d-block line-height-18px sm-margin-15px-bottom">Co-founder</span>--}}
{{--                    </div>--}}
{{--                    <div class="w-75 sm-w-100 last-paragraph-no-margin text-center text-md-start">--}}
{{--                        <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>--}}
{{--                        <a href="blog-grid.html" class="btn btn-link btn-large text-extra-dark-gray margin-20px-top">All author posts</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-10 text-center elements-social social-icon-style-09 mx-auto">--}}
{{--                <ul class="medium-icon">--}}
{{--                    <li class="wow animate__fadeIn" data-wow-delay="0.2s"><a class="facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i><span></span></a></li>--}}
{{--                    <li class="wow animate__fadeIn" data-wow-delay="0.3s"><a class="twitter" href="http://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i><span></span></a></li>--}}
{{--                    <li class="wow animate__fadeIn" data-wow-delay="0.4s"><a class="instagram" href="http://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i><span></span></a></li>--}}
{{--                    <li class="wow animate__fadeIn" data-wow-delay="0.5s"><a class="linkedin" href="http://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i><span></span></a></li>--}}
{{--                    <li class="wow animate__fadeIn" data-wow-delay="0.6s"><a class="behance" href="http://www.behance.com/" target="_blank"><i class="fab fa-behance"></i><span></span></a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- end section -->
<!-- start section -->
{{--<section class="bg-light-gray">--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-12 col-lg-5 col-md-6 text-center margin-5-rem-bottom wow animate__fadeIn">--}}
{{--                <span class="alt-font font-weight-500 text-uppercase d-inline-block">You may also like</span>--}}
{{--                <h5 class="alt-font font-weight-500 text-extra-dark-gray letter-spacing-minus-1px">Related posts</h5>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-12 blog-content">--}}
{{--                <ul class="blog-clean blog-wrapper grid grid-loading grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">--}}
{{--                    <li class="grid-sizer"></li>--}}
{{--                    <!-- start blog item -->--}}
{{--                    <li class="grid-item wow animate__fadeIn">--}}
{{--                        <div class="blog-post text-center border-radius-6px bg-white box-shadow box-shadow-large-hover">--}}
{{--                            <div class="blog-post-image bg-gradient-fast-blue-purple">--}}
{{--                                <a href="blog-post-layout-01.html"><img src="https://via.placeholder.com/850x885" alt="">--}}
{{--                                    <div class="blog-rounded-icon bg-white border-color-white absolute-middle-center">--}}
{{--                                        <i class="feather icon-feather-arrow-right text-extra-dark-gray icon-extra-small"></i>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="post-details padding-30px-all xl-padding-25px-lr">--}}
{{--                                <a href="blog-grid.html" class="post-author text-medium text-uppercase">23 February 2020</a>--}}
{{--                                <a href="blog-post-layout-01.html" class="text-extra-dark-gray font-weight-500 alt-font d-block">Build perfect websites</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <!-- end blog item -->--}}
{{--                    <!-- start blog item -->--}}
{{--                    <li class="grid-item wow animate__fadeIn" data-wow-delay="0.2s">--}}
{{--                        <div class="blog-post text-center border-radius-6px bg-white box-shadow box-shadow-large-hover">--}}
{{--                            <div class="blog-post-image bg-gradient-fast-blue-purple">--}}
{{--                                <a href="blog-post-layout-02.html"><img src="https://via.placeholder.com/850x885" alt="">--}}
{{--                                    <div class="blog-rounded-icon bg-white border-color-white absolute-middle-center">--}}
{{--                                        <i class="feather icon-feather-arrow-right text-extra-dark-gray icon-extra-small"></i>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="post-details padding-30px-all xl-padding-25px-lr">--}}
{{--                                <a href="blog-grid.html" class="post-author text-medium text-uppercase">18 February 2020</a>--}}
{{--                                <a href="blog-post-layout-02.html" class="text-extra-dark-gray font-weight-500 alt-font d-block">Beautiful layouts design</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <!-- end blog item -->--}}
{{--                    <!-- start blog item -->--}}
{{--                    <li class="grid-item wow animate__fadeIn" data-wow-delay="0.4s">--}}
{{--                        <div class="blog-post text-center border-radius-6px bg-white box-shadow box-shadow-large-hover">--}}
{{--                            <div class="blog-post-image bg-gradient-fast-blue-purple">--}}
{{--                                <a href="blog-post-layout-03.html"><img src="https://via.placeholder.com/850x885" alt="">--}}
{{--                                    <div class="blog-rounded-icon bg-white border-color-white absolute-middle-center">--}}
{{--                                        <i class="feather icon-feather-arrow-right text-extra-dark-gray icon-extra-small"></i>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="post-details padding-30px-all xl-padding-25px-lr">--}}
{{--                                <a href="blog-grid.html" class="post-author text-medium text-uppercase">23 January 2019</a>--}}
{{--                                <a href="blog-post-layout-03.html" class="text-extra-dark-gray font-weight-500 alt-font d-block">Fashion is not something</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <!-- end blog item -->--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- start footer -->
@include('components.basic.footer')
<!-- end footer -->
<!-- start scroll to top -->
<a class="scroll-top-arrow" href="javascript:void(0);"><i class="fa-solid fa-chevron-up"></i></a>
<!-- end scroll to top -->
<!-- javascript -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/theme-vendors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/php.min.js"></script>
<script>hljs.highlightAll();</script>
</body>
</html>
