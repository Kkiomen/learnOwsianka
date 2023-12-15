@extends('layouts.layout_blog_post', [
    'title' => $post->title,
    'short_description' => $post->short_description,
])

@section('header')
    <section class="pb-0 overflow-visible position-relative bg-light-gray padding-eleven-lr lg-padding-four-lr">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 order-2 z-index-1 padding-10-rem-left padding-60px-bottom lg-padding-3-rem-left md-padding-15px-left">
                    <div class="d-flex flex-column justify-content-center h-100">
                        <div class="alt-font text-fast-blue text-uppercase font-weight-500 margin-30px-bottom xs-margin-10px-bottom">
                            <a href="blog-grid.html" class="text-fast-blue">Creative</a><span class="margin-10px-lr">&#8226;</span> <a href="blog-grid.html" class="text-fast-blue">Freebies</a><span class="margin-10px-lr">&#8226;</span> <a href="blog-grid.html" class="text-fast-blue">events</a>
                        </div>
                        <h3 class="alt-font font-weight-500 letter-spacing-minus-1px text-extra-dark-gray">{{ $post->title }}</h3>
                        <span class="alt-font d-block margin-15px-tb">{{ __('basic.by') }} <strong>Jakub Owsianka</strong> {{ __('basic.on') }} <strong>{{ $post->created_at->format('Y-m-d') }}</strong></span>
                    </div>
                </div>
                <div class="col-12 col-lg-6 px-0 order-1 align-self-end md-margin-60px-bottom">
                    <img class="overlap-image border-radius-8px md-no-margin-bottom" src="{{ $post->image_url }}" alt="{{ $post->title }}" />
                </div>
                <div class="col-12 col-lg-6 padding-9-rem-left overflow-hidden alt-font font-weight-600 text-white text-overlap-style-01 d-none d-md-block">Blog</div>
            </div>
        </div>
    </section>
@endsection

@section('short_description')
    <section class="padding-70px-top sm-padding-50px-top position-relative">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 col-xl-5 col-lg-6 last-paragraph-no-margin padding-3-half-rem-left md-padding-15px-left">
                    <p>{{ $post->short_description }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
