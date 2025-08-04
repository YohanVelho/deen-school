@extends('site.master.page')

@section('content')
    <div class="site-wrapper">

        <div class="doc-loader">
            <img src="assets/site/images/preloader.gif" alt="Caliris">
        </div>


        @include("site.components.header")

        <div id="content" class="site-content">
            <div class="blog-holder block center-relative">
                @foreach($course['playlist'] as $list)
                    <article class="animate relative blog-item-holder center-relative has-post-thumbnail">
                        <div class="entry-holder">
                            <h2 class="entry-title">{{$list['name']}}</h2>
                            <div class="entry-info">
                                <div class="excerpt">
                                    <p>{{$list['desc']}}</p>
                                </div>
                            </div>
                            @if(count($list['lessons']) > 0)
                                <ul>
                                    @foreach ($list['lessons'] as $lesson)
                                        <li><a href="{{route("lesson" , ["slug" => $lesson["slug"]])}}">{{$lesson['name']}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="clear"></div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
