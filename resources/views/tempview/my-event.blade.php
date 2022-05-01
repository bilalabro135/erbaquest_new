@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          My EVENT
        </h1>
      </div>
    </section>

    <section class="secAccount pt-100 pb-100">
      <div class="container">
        <div class="row">
          @include( 'tempview/sidebar' )
          	<div class="col-sm-12 col-md-8 UpcomingEvent">
	            <div class="row">
                @if(session('msg'))
                  <div class="alert alert-{{session('msg_type')}}">
                      {{session('msg')}}
                  </div>
                  @endif
                <div class="alert alert-danger" style="display: none;">
                   msg
                </div>
                @if(count($events))
  	            	@foreach($events as $event)
                    <div class="col-sm-12 col-md-6" id="event_{{$event['id']}}">
                      <div class="event-box_list">
                        <figure>
                          <div class="wishlist">
                               @if($event['featured'])
                                <p class="ft-tag">Featured</p>
                               @endif
                          </div>
                            <img src="{{asset($event['featured_image'])}}" alt="{{$event['name']}}">
                          <div class="author">
                            <p>{{$event['area']}}</p>
                            @if(!empty($profile_image))
                            <div class="figure">
                              <img src="{{($profile_image != 'null') ? $profile_image : asset('images/avatar.png') }}" alt="{{$event->organizer->name}}">
                            </div>
                            @endif
                          </div>
                        </figure>
                        <div class="detail">
                          <h3>{{$event['name']}}</h3>
                        @if(!$event['is_recurring'])
                            <p class="date"><i class="far fa-calendar-alt"></i>{{date('d-m-Y', strtotime($event['event_date']))}}</p>
                        @else
                            <p><b>Day: </b> {{  $event['day_dropdown'] }} <b>Type: </b>{{  $event['recurring_type'] }}</p>
                        @endif
                          <div class="txt">
                            <p>{!!$event['description']!!}</p>
                          </div>
                          <a href="../events/{{$event['id']}}" class="link">Details</a>
                        </div>
                      </div>
                    </div>
  	              @endforeach
                @else
                  <p>No Events Found.</p>
                @endif
            	</div>
          	</div>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
<script type="text/javascript">
  $('ul.menu_list li .down-icon').on('click',function(){
    $(this).parent('li').toggleClass('current');
    $(this).parent('li').find('ul.sub-menu').slideToggle();
  });
</script>

@endpush
