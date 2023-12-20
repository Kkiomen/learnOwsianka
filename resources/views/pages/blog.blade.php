@extends('layouts.layout_blog')



@section('blog-items')
    @if($posts->count() === 0)

        Brak postów

    @endif

    @foreach($posts as $post)
        <li class="grid-item wow animate__fadeIn">
            <div class="blog-post border-radius-5px bg-white">
{{--                <div class="d-flex align-items-center font-weight-500 padding-30px-lr padding-15px-tb">--}}
{{--                    <a href="{{ route('blogPost', ['slug' => $post->slug]) }}" class="text-small me-auto text-slate-blue">{{ $post->created_at->format('d m Y') }}</a>--}}
{{--                    <a href="blog-post-layout-01.html" class="blog-like text-extra-small"><i class="far fa-heart"></i><span>28</span></a>--}}
{{--                    <a href="blog-post-layout-01.html" class="blog-comment text-extra-small"><i class="far fa-comment"></i><span>52</span></a>--}}
{{--                </div>--}}
                <div class="blog-post-image">
                    @if($post->image_url !== null)
                        <a href="{{ route('blogPost', ['slug' => $post->slug]) }}" title=""><img src="{{ $post->image_url }}" alt="{{ $post->title }}"></a>
                    @endif
                </div>
                <div class="post-details padding-3-rem-lr padding-2-half-rem-tb lg-padding-2-rem-all md-padding-2-half-rem-tb md-padding-3-rem-lr">
                    <a href="{{ route('blogPost', ['slug' => $post->slug]) }}" class="alt-font font-weight-500 text-extra-medium text-extra-dark-gray d-block margin-15px-bottom">{{ $post->title }}</a>
                    <p>{{ $post->short_description }}</p>
                </div>
            </div>
        </li>
    @endforeach

@endsection


@section('pagination')
    {{ $posts->links('components.basic.pagination_basic') }}
@endsection

@section('footer')
    <div class="row">
        <!-- start footer column -->
        <div class="col-12 col-lg-3 col-sm-6 md-margin-40px-bottom xs-margin-25px-bottom">
            <span class="alt-font font-weight-500 d-block text-white margin-15px-bottom xs-margin-10px-bottom">Company</span>
            <ul>
                <li><a href="about-us.html">About company</a></li>
                <li><a href="our-services.html">Company services</a></li>
                <li><a href="our-team.html">Job opportunities</a></li>
                <li><a href="contact-us-classic.html">Contact us</a></li>
            </ul>
        </div>
        <!-- end footer column -->
        <!-- start footer column -->
        <div class="col-12 col-lg-3 col-sm-6 md-margin-40px-bottom xs-margin-25px-bottom">
            <span class="alt-font font-weight-500 d-block text-white margin-15px-bottom xs-margin-10px-bottom">Customer</span>
            <ul>
                <li><a href="faq.html">Client support</a></li>
                <li><a href="pricing-packages.html">Pricing packages</a></li>
                <li><a href="our-story.html">Company history</a></li>
                <li><a href="our-process.html">Our process</a></li>
            </ul>
        </div>
        <!-- end footer column -->
        <!-- start footer column -->
        <div class="col-12 col-lg-3 col-sm-6 xs-margin-25px-bottom">
            <span class="alt-font font-weight-500 d-block text-white margin-15px-bottom xs-margin-10px-bottom">Get in touch</span>
            <p class="w-85 margin-15px-bottom">27 Eden walk eden centre, Orchard view, Paris, France</p>
            <div><i class="feather icon-feather-phone-call icon-very-small margin-10px-right text-white"></i>+1 234 567 8910</div>
            <div><i class="feather icon-feather-mail icon-very-small margin-10px-right text-white"></i><a href="#">info@yourdomain.com</a></div>
        </div>
        <!-- end footer column -->
        <!-- start footer column -->

        {{--                <div class="col-12 col-lg-3 col-sm-6">--}}
        {{--                    <span class="alt-font font-weight-500 d-block text-white margin-15px-bottom">Follow us on Instagram</span>--}}
        {{--                    <div class="w-100 d-inline-block margin-10px-top">--}}
        {{--                        <ul class="instafeed-grid instafeed-wrapper grid grid-3col xl-grid-3col lg-grid-3col md-grid-3col sm-grid-3col xs-grid-3col gutter-small" data-total="3">--}}
        {{--                            <li class="grid-item"><figure><a href="#" data-href="{{link}}" target="_blank"><img src="#" data-src="{{image}}" class="insta-image" alt="" /><span class="insta-counts"><i class="fab fa-instagram"></i>{{likes}}</span></a></figure></li>--}}
        {{--                        </ul>--}}
        {{--                        <a class="alt-font text-extra-small text-uppercase font-weight-500 margin-20px-top d-inline-block" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram icon-extra-small align-middle margin-10px-right text-gradient-light-purple-light-orange"></i><span class="d-inline-block align-middle">Follow instagram</span></a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        <!-- end footer column -->
    </div>
@endsection

@section('navigation')
    @include('components.basic.navigation')
@endsection
