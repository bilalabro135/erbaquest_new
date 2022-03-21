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
                            <a href="javascript:;" class="heart-link" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$event['id']}}"><i class="fas fa-times"></i> </a>
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
                          <p class="date"><i class="far fa-calendar-alt"></i>{{$event['event_date']}}</p>
                          <div class="txt">
                            <p>{!!$event['description']!!}</p>
                          </div>
                          <a href="events/{{$event['id']}}" class="link">Details</a>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade delete_event_popup" id="exampleModal_{{$event['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="popup_close">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure?</p>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" value="{{$event['id']}}" name="event_id" class="event_wish">
                              <a href="javascript:void(0);" class="btn btn-primary removeWishlist">Confirm</a>
                            </div>
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
          $(".delete_event_popup").modal('hide');
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