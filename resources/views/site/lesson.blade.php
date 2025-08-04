@extends('site.master.page')

@section('content')
    <div class="site-wrapper">

        <div class="doc-loader">
            <img src="assets/site/images/preloader.gif" alt="Caliris">
        </div>


        @include('site.components.header')

        <div id="content" class="site-content">
            <div class="blog-holder block center-relative">
                <!-- Video Section -->
                <div id="video" class="section full-width" style="margin: 5rem auto">
                    <div class="section-wrapper block content-1170 center-relative">
                        <div class="content-wrapper">
                            <p class="medium-text center-text bottom-30 top-50">
                                {{ $lesson['name'] }}
                            </p>
                            <a class="video-popup-holder" href="https://youtu.be/{{ $lesson['video'] }}"
                                data-rel="prettyPhoto[gallery-video1]">
                                <p class="popup-play"></p>
                            </a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="links">
                    {!!$lesson['content']!!}
                </div>
            </div>
        </div>
    </div>
@endsection
