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
            <h3 class="ft-blanka ftw-bold_36 mb-40 text-center">{{$podcastsData->podcast_name}}</h3>
            <div class="podcast-ft">
                <figure>
                    @if ($podcastsData->featured_image)
                        <img src="{{ asset($podcastsData->featured_image) }}" alt="{{$podcastsData->podcast_name}}" />
                    @else 
                        <img src="{{ asset('images/avatar.png') }}" alt="{{$podcastsData->podcast_name}}" />
                    @endif
                    <div class="pdcs-info">
                        <div class="start_listen">
                            <h4>
                                <span class="icon"><i class="fas fa-play"></i></span>Start Listen
                            </h4>
                        </div>
                        <div class="audio_list">
                            <ul class="btns">
                                <li><a href="javascript:;"><i class="fab fa-itunes-note"></i> iTunes</a></li>
                                <li><a href="javascript:;"><i class="fab fa-spotify"></i> Spotify</a></li>
                                <li><a href="javascript:;"><i class="fab fa-google-wallet"></i> Google</a></li>
                                <li><a href="javascript:;"><i class="fas fa-sticky-note"></i> Stitcher</a></li>
                            </ul>
                        </div>
                    </div>
                </figure>
                <div class="pdcs-detail">
                    <h5>Traveling and Moving</h5>
                    <h3>People are podcasting all over the world</h3>
                    <ul class="PDlist">
                      <li>Episode 7</li>
                      <li>By Liam Adams</li>
                      <li>2 Weeks Ago</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                    <div class="posdcast_timeline">
                        <h4>Episode timeline</h4>
                        <ul>
                            <li><span class="time">00.10</span>Introduction</li>
                            <li><span class="time">00.25</span>Exploring the topic</li>
                            <li><span class="time">00.57</span>A word from our guest host</li>
                            <li><span class="time">01.14</span>Closing remarks</li>
                        </ul>
                    </div>
                    <h3>Support me on Patreon</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                </div>
            </div>
        </div>
    </section>

@endsection