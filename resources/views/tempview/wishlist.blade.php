@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          EDIT EVENT
        </h1>
      </div>
    </section>

    <section class="secAccount pt-100 pb-100">
      <div class="container">
        <div class="row">
          @include( 'tempview/sidebar' )
          	<div class="col-sm-12 col-md-8 UpcomingEvent">
	            <div class="row">
                <div class="alert alert-danger" style="display: none;">
                   msg
                </div>
                @if($events)
  	            	@foreach($events as $event)
                    <div class="col-sm-12 col-md-6" id="event_{{$event['id']}}">
                      <div class="event-box_list">
                        <figure>
                          <div class="wishlist">
                            <input type="hidden" value="{{$event['id']}}" name="event_id" class="event_wish">
                            <a href="javascript:;" class="heart-link removeWishlist"><i class="fas fa-times"></i> </a>
                            <p class="ft-tag">Featured</p>
                          </div>
                            <img src="{{asset($event['featured_image'])}}" alt="{{$event['name']}}">
                          <div class="author">
                            <p>{{$event['area']}}</p>
                            @if(!empty($event->organizer->profile_image))
                            <div class="figure">
                              <img src="{{($event->organizer->profile_image != 'null') ? $event->organizer->profile_image : asset('images/avatar.png') }}" alt="{{$event->organizer->name}}">
                            </div>
                            @endif
                          </div>
                        </figure>
                        <div class="detail">
                          <h3>{{$event['name']}}</h3>
                            @if(!$event['is_recurring'])
                                <p class="date"><i class="far fa-calendar-alt"></i>{{date('m-d-Y', strtotime($event['event_date']))}}</p>
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
                  <p>No Events In Wishlists.</p>
                @endif
            	</div>
          	</div>
        </div>
      </div>
    </section>

@endsection

@push('scripts')
<script type="text/javascript">
  $(".removeWishlist").click(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var event_id = $(this).prev(".event_wish").val();
      $.ajax({
         url:'{{route("remove.wishlist")}}',
         type:'POST',
         data:'event_id='+event_id,
         success:function(data) {
          $("#event_"+event_id).remove();
          $(".alert-danger").text(data.msg);
          $(".alert-danger").show();
          $('html, body').animate({
            scrollTop: 0
          }, 800);
          setTimeout(location.reload.bind(location), 2000);
        }
      });
  });
  $('ul.menu_list li .down-icon').on('click',function(){
    $(this).parent('li').toggleClass('current');
    $(this).parent('li').find('ul.sub-menu').slideToggle();
  });
</script>

@endpush
