@extends('layouts.layout_newsletter')

@section('content')

    <!-- LAYER NR. 3 (TITLE) -->
    <div class="tp-caption tp-resizeme alt-font w-80 md-w-70 sm-w-100 md-margin-auto-lr sm-margin-auto-lr maintenance-title"
         data-x="['left','left','center','center']" data-hoffset="['0','0','0','0']"
         data-y="['top','top','top','top']" data-voffset="['0','0','-100','0']"
         data-width="none"
         data-height="none"
         data-whitespace="normal"
         data-type="text"
         data-responsive_offset="on"
         data-responsive="off"
         data-fontsize="['40','28','35','25']"
         data-lineheight="['46','33','41','30']"
         data-letterspacing="['-1','-1','-1','-1']"
         data-frames='[{"delay":"500","speed":1000,"frame":"0","from":"y:50px;opacity:0;fb:10px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"auto:auto;fb:0;","ease":"Power3.easeInOut"}]'
         data-margintop="[0,0,0,0]"
         data-marginright="[0,0,0,0]"
         data-marginbottom="[0,0,0,0]"
         data-marginleft="[0,0,0,0]"
         data-textAlign="['inherit','inherit','center','center']"
         data-paddingtop="[0,0,0,0]"
         data-paddingright="[0,0,0,0]"
         data-paddingbottom="[30,20,20,10]"
         data-paddingleft="[0,0,0,0]"
         style="z-index: 10; font-weight: 600;">{{ __('basic.index_main') }}</div>

    <!-- LAYER NR. 4 (TEXT) -->
    <div class="tp-caption tp-resizeme text-extra-medium alt-font mx-auto mx-lg-0"
         data-x="['left','left','center','center']" data-hoffset="['0','0','0','0']"
         data-y="['top','top','top','top']" data-voffset="['0','0','0','0']"
         data-width="['75%','100%','75%','100%']"
         data-height="none"
         data-fontsize="['16','15','15','13']"
         data-lineheight="['24','24','22','22']"
         data-whitespace="normal"
         data-type="text"
         data-responsive_offset="on"
         data-responsive="off"
         data-frames='[{"delay":"800","speed":1000,"frame":"0","from":"y:50px;opacity:0;fb:10px;","to":"o:0.77;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"auto:auto;fb:0;","ease":"Power3.easeInOut"}]'
         data-margintop="[0,0,0,0]"
         data-marginright="[0,0,0,0]"
         data-marginbottom="[0,0,0,0]"
         data-marginleft="[0,0,0,0]"
         data-textAlign="['inherit','inherit','center','center']"
         data-paddingtop="[0,0,0,0]"
         data-paddingright="[0,0,0,0]"
         data-paddingbottom="[60,40,30,20]"
         data-paddingleft="[0,0,0,0]"
         style="z-index: 10; font-weight: 300">{{ __('basic.index_submain') }}</div>

    <!-- LAYER NR. 5 (Search Input) -->
    <a href="{{ route('blog') }}" class="text-black">
        <div class="bg-white rounded px-4 py-3" style="color: #494949; font-size: 1rem">
            Blog
        </div>
    </a>
{{--    <form action="email-templates/subscribe-newsletter.php" method="post">--}}
{{--        <div class="tp-caption tp-resizeme alt-font newsletter-style-02 mx-auto mx-lg-0"--}}
{{--             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"--}}
{{--             data-y="['middle','middle','middle','middle']" data-voffset="['100','0','0','0']"--}}
{{--             data-width="['75%','100%','75%','100%']"--}}
{{--             data-height="none"--}}
{{--             data-whitespace="normal"--}}
{{--             data-type="form"--}}
{{--             data-responsive_offset="off"--}}
{{--             data-responsive="off"--}}
{{--             data-frames='[{"delay":"1100","speed":1000,"frame":"0","from":"y:50px;opacity:0;fb:10px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"auto:auto;fb:0;","ease":"Power3.easeInOut"}]'--}}
{{--             data-margintop="[0,0,0,0]"--}}
{{--             data-marginright="[0,0,0,0]"--}}
{{--             data-marginbottom="[0,0,20,10]"--}}
{{--             data-marginleft="[0,0,0,0]"--}}
{{--             data-textAlign="['inherit','inherit','left','left']"--}}
{{--             data-paddingtop="[0,0,0,0]"--}}
{{--             data-paddingright="[0,0,0,0]"--}}
{{--             data-paddingbottom="[0,0,0,0]"--}}
{{--             data-paddingleft="[0,0,0,0]"--}}
{{--             style="z-index: 13;">--}}
{{--            <input style="font-size: 14px; line-height: normal;" class="large-input border-radius-4px m-0 border-0 font-weight-300 required" name="email" placeholder="Your email address" type="email">--}}
{{--            <input type="hidden" name="redirect" value="">--}}
{{--            <button class="btn btn-medium text-fast-blue border-left border-0 border-color-extra-medium-gray py-0 submit" type="submit">Notify me</button>--}}
{{--        </div>--}}
{{--        <div class="form-results border-radius-4px d-none w-75 position-absolute"></div>--}}
{{--    </form>--}}

@endsection


@section('socials')
    <!-- LAYER NR. 22 (LOGO) -->
    <a class="tp-caption tp-resizeme rs-parallaxlevel-2 font-medium navbar-brand-text text-white tp-static-layer"
       data-x="['left','left','center','center']" data-hoffset="['30','50','0','0']"
       data-y="['top','top','top','top']" data-voffset="['100','170','50','25']"
       data-width="['auto','auto','auto','auto']"
       data-height="['auto','auto','auto','auto']"
       data-whitespace="nowrap"
       data-type="image"
       data-responsive_offset="on"
       data-responsive="off"
       data-startslide="0"
       data-endslide="3"
       data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
       data-textAlign="['inherit','inherit','inherit','inherit']"
       data-paddingtop="[0,0,0,0]"
       data-paddingright="[0,0,0,0]"
       data-paddingbottom="[0,0,0,0]"
       data-paddingleft="[0,0,0,0]"
       style="z-index: 5; font-size: 4rem"
       href="{{ route('index') }}">oatllo</a>
    <!-- LAYER NR. 7 (SOCIAL MEDIA ICON) -->

    @php
        $facebookUrl = \App\Data\SocialMedia\SocialMediaUrl::getSocialUrl(\App\Data\SocialMedia\SocialMediaType::FACEBOOK);
        $instagramUrl = \App\Data\SocialMedia\SocialMediaUrl::getSocialUrl(\App\Data\SocialMedia\SocialMediaType::INSTAGRAM);
        $linkedinUrl = \App\Data\SocialMedia\SocialMediaUrl::getSocialUrl(\App\Data\SocialMedia\SocialMediaType::LINKEDIN);
        $twitterUrl = \App\Data\SocialMedia\SocialMediaUrl::getSocialUrl(\App\Data\SocialMedia\SocialMediaType::TWITTER);
    @endphp
    @if(!is_null($facebookUrl))
    <a class="tp-caption tp-static-layer text-medium"
       href="{{ $facebookUrl }}" target="_blank"
       data-x="['left','left','center','center']" data-hoffset="['30','50','-60','-60']"
       data-y="['bottom','bottom','bottom','bottom']" data-voffset="['100','170','20','20']"
       data-lineheight="['14','14','14','10']"
       data-width="['auto','auto','auto','auto']"
       data-height="['auto','auto','auto','auto']"
       data-whitespace="nowrap"
       data-type="button"
       data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":"","speed":"1500","ease":"Power1.easeInOut"}]'
       data-responsive_offset="on"
       data-responsive="off"
       data-startslide="0"
       data-endslide="3"
       data-frames='[{"delay":1400,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
       data-visibility="['on','on','on','on']"
       data-margintop="[0,0,0,0]"
       data-marginright="[10,10,10,5]"
       data-marginbottom="[0,0,0,0]"
       data-marginleft="[0,0,0,0]"
       data-textAlign="['inherit','inherit','center','center']"
       data-paddingtop="[5,5,5,5]"
       data-paddingright="[5,5,5,5]"
       data-paddingbottom="[5,5,5,5]"
       data-paddingleft="[5,5,5,5]"
       style="z-index: 999; display: inline-block; color: rgba(255,255,255,1);"><i class="fab fa-facebook-f"></i> </a>
    @endif

    @if(!is_null($instagramUrl))
    <!-- LAYER NR. 8 (SOCIAL MEDIA ICON) -->
    <a class="tp-caption tp-static-layer text-medium"
       href="{{ $instagramUrl }}" target="_blank"
       data-x="['left','left','center','center']" data-hoffset="['70','72','0','0']"
       data-y="['bottom','bottom','bottom','bottom']" data-voffset="['100','170','20','20']"
       data-lineheight="['14','14','14','10']"
       data-width="['auto','auto','auto','auto']"
       data-height="['auto','auto','auto','auto']"
       data-whitespace="nowrap"
       data-type="button"
       data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":"","speed":"1500","ease":"Power1.easeInOut"}]'
       data-responsive_offset="on"
       data-responsive="off"
       data-startslide="0"
       data-endslide="3"
       data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
       data-visibility="['on','on','on','on']"
       data-margintop="[0,0,0,0]"
       data-marginright="[10,10,10,5]"
       data-marginbottom="[0,0,0,0]"
       data-marginleft="[0,0,0,0]"
       data-textAlign="['inherit','inherit','inherit','inherit']"
       data-paddingtop="[5,5,5,5]"
       data-paddingright="[5,5,5,5]"
       data-paddingbottom="[5,5,5,5]"
       data-paddingleft="[5,5,5,5]"
       style="z-index: 999; display: inline-block;color: rgba(255,255,255,1);"><i class="fab fa-instagram"></i></a>
    @endif

    @if(!is_null($linkedinUrl))
        <!-- LAYER NR. 9 (SOCIAL MEDIA ICON) -->
        <a class="tp-caption tp-static-layer text-medium"
           href="{{ $linkedinUrl }}" target="_blank"
           data-x="['left','left','center','center']" data-hoffset="['110','100','60','60']"
           data-y="['bottom','bottom','bottom','bottom']" data-voffset="['94','165','12','10']"
           data-width="['auto','auto','auto','auto']"
           data-height="['auto','auto','auto','auto']"
           data-whitespace="nowrap"
           data-type="button"
           data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":"","speed":"1500","ease":"Power1.easeInOut"}]'
           data-responsive_offset="on"
           data-responsive="off"
           data-startslide="0"
           data-endslide="3"
           data-frames='[{"delay":1500,"speed":1000,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
           data-visibility="['on','on','on','on']"
           data-textAlign="['inherit','inherit','inherit','inherit']"
           data-margintop="[0,0,0,0]"
           data-marginright="[10,10,10,5]"
           data-marginbottom="[0,0,0,0]"
           data-marginleft="[0,0,0,0]"
           data-paddingtop="[5,5,5,5]"
           data-paddingright="[5,5,5,5]"
           data-paddingbottom="[5,5,5,5]"
           data-paddingleft="[5,5,5,5]"
           style="z-index: 999; display: inline-block;color: rgba(255,255,255,1);"><i class="fab fa-linkedin-in"></i></a>
    @endif


@endsection
