@extends('site.master.page')

@section('content')
    <div class="site-wrapper">

        <div class="doc-loader">
            <img src="assets/site/images/preloader.gif" alt="Caliris">
        </div>


       @include("site.components.header")



        <div id="content" class="site-content center-relative">

            <!-- Home Section -->
            <div id="home" class="section full-width full-screen">
                <div class="section-wrapper block content-1170 center-relative">
                    <div class="content-wrapper">
                        <h1 class="big-text ">
                            Plataforma<br>
                            de ensino<br>
                            NOMAD SCHOOL    
                        </h1>
                    </div>
                </div>
            </div>

            @foreach($trails as $key => $trail)
                <div id="trilha-{{$key}}" class="section page-split">
                    <div class="section-wrapper block content-1170 center-relative">

                        <div class="bg-holder {{$key%2==0 ? 'float-left' : 'float-right'}}">
                            <img src="assets/site/images/{{ $key%2==0 ? 'left_obj_01' : 'right_obj_02'}}.png" alt="">
                        </div>

                        <div class="section-title-holder {{$key%2==0 ? 'float-left' : 'float-right'}}" data-background="#a13dd7">
                            <div class="section-num">
                                <span class="current-section-num">
                                    0{{$key + 1}}
                                </span>
                                <span class="total-section-num">
                                    / {{count($trails)}}
                                </span>
                            </div>
                            <h2 class="entry-title">
                                {{$trail['name']}}
                            </h2>
                            <p class="page-desc">
                                {{$trail['desc']}}
                            </p>
                        </div>
                        <div class="section-content-holder {{$key%2==0 ? 'float-right' : 'float-left'}}">
                            <div class="content-wrapper">

                                @foreach($trail['courses'] as $key =>  $course)
                                    <a href="{{route('course',['slug' => $course['slug']] )}}" class="one_third animate wait-0{{$key+1}}s">
                                        <div class="service-item">
                                            <img class="service-icon" style="object-fit:contain" src="{{resize($course['image'],1200)}}" alt="">
                                            <p class="service-title">{{$course['name']}}</p>
                                            <div class="service-content">{{$course['desc']}}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
