@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif

    <section class="inner-banner">
        <div class="container">
            <h1 class="ft-blanka">PODCAST</h1>
        </div>
    </section>

    <section class="podcas-inner pt-100 pb-100">
        <div class="container">
            <h3 class="ft-blanka ftw-bold_36 mb-40 text-center">{{$podcastsData->name}}</h3>
            <div class="podcast-ft">
                <figure>
                    @if ($podcastsData->featured_image)
                        <img src="{{ asset($podcastsData->featured_image) }}" alt="{{$podcastsData->podcast_name}}" />
                    @else 
                        <img src="{{ asset('images/placeholder.png') }}" alt="{{$podcastsData->podcast_name}}" />
                    @endif
                    <div class="pdcs-info">
                        @if($additional_info['gallery'])
                        <div class="start_listen">
                            <h4>
                                <span class="icon"><i class="fas fa-play"></i></span> <span class="main_aud_off">Start Listing</span>
                            </h4>
                            <div class="audio_main">
                                    <audio class="audio_tag" controls>
                                      <source src="{{ asset($additional_info['gallery'][ $current ]['url']) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                    </audio>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        @endif
                        <div class="audio_list">
                            <ul class="btns">
                                @if($podcastsData->itune)
                                    <li><a target="_blank" href="{{ $podcastsData->itune }}"><i class="fab fa-itunes-note"></i> iTunes</a></li>
                                @endif
                                @if($podcastsData->spotify)
                                    <li><a target="_blank" href="{{ $podcastsData->spotify }}"><i class="fab fa-spotify"></i> Spotify</a></li>
                                @endif
                                @if($podcastsData->google_music)
                                    <li><a target="_blank" href="{{ $podcastsData->google_music }}"><i class="fab fa-google-wallet"></i> Google</a></li>
                                @endif
                                @if($podcastsData->stitcher_link)
                                    <li><a target="_blank" href="{{ $podcastsData->stitcher_link }}"><i class="fas fa-sticky-note"></i> Stitcher</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </figure>
                <div class="pdcs-detail">
                    <h5>{{$podcastsData->sub_heading}}</h5>
                    <ul class="PDlist">
                      <li>Episode 
                            @if( request()->get('episode') )
                                {{ request()->get('episode') }}
                            @else
                                1
                            @endif
                      </li>
                      <li>By {{ $additional_info['username'] }}</li>
                      <li>{{ $additional_info['duration'] }}</li>
                    </ul>
                    {!! $podcastsData->description !!}
                    <div class="posdcast_timeline podcast_episode_time">
                        <h4>Episode timeline</h4>
                        <ul>
                            @if($additional_info['gallery'])
                                @foreach($additional_info['gallery'] as $gallery)
                                    <li class="list-play">
                                        <a href="{{route('posts.show', ['pages' => 'podcast', 'id' => $podcastsData->id])}}?episode={{ $gallery['sort'] + 1 }}">
                                            <h4>
                                                <span class="icon"><i class="far fa-play-circle"></i></span>
                                                <span class="text">{{ $gallery['alt'] }}</span>
                                            </h4>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    {!! $podcastsData->patreon_message !!}
                </div>
            </div>
        </div>
    </section>
    <style type="text/css">
        .start_listen h4{
            float: left;
        }
        .start_listen .audio_main{
          float: left;
            position: relative;
            top: -4px;
        }
        .audio_main{
            display: none;
        }
        .start_listen .icon{
            cursor: pointer;
        }
    </style>

    <script type="text/javascript">
        $(".start_listen .icon").click(function() {
            $(".main_aud_off").hide();
            $(".audio_main").show();
             var mediaVideo = $(".audio_tag").get(0);
               if (mediaVideo.paused) {
                   mediaVideo.play();
               } else {
                   mediaVideo.pause();
              }

        });
    </script>

@endsection