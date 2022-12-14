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
                @if(session('msg'))
                  <div class="alert alert-{{session('msg_type')}}">
                      {{session('msg')}}
                  </div>
                  @endif
                @if(count($events))
  	            	@foreach($events as $event)

                    <div class="col-sm-12 col-md-6">
                      <div class="event-box_list" id="event_{{ $event->id }}">
                        <figure>
                          <div class="wishlist">
                                 @if($event['featured'])
                                  <p class="ft-tag">Featured</p>
                                 @endif
                              </div>
                          <div class="wishlist">
                            <!-- <p class="ft-tag">Featured</p> -->
                          </div>
                          <a href="../events/{{$event['id']}}">
                            <img src="{{asset($event->featured_image)}}">
                          </a>
                          <div class="author">
                            <p>{{$event->area}}</p>
                            @if(!empty($profile_image))
                            <div class="figure">
                              <img src="{{ $profile_image }}" >
                            </div>
                            @else
                            <div class="figure">
                              <img src="{{asset('images/avatar.png')}}">
                            </div>
                            @endif
                          </div>
                        </figure>
                        <div class="detail">
                          <a href="../events/{{$event['id']}}">
                            <h3>{{$event->name}}</h3>
                          </a>
                          @if(!$event['is_recurring'])
                            <p class="date"><i class="far fa-calendar-alt"></i>{{date('d-m-Y', strtotime($event['event_date']))}}</p>
                          @else
                                <p><b>Day: </b> {{  $event['day_dropdown'] }} <b>Type: </b>{{  $event['recurring_type'] }}</p>
                          @endif
                          <div class="txt">
                            <p class="event_description">{!!$event->description!!}</p>
                          </div>
                          <a href="{{ $event->id }}/edit" class="md-link">EDIT</a>
                            <a href="javascript:void(0)" data="{{$event->id}}" class="md-link edit-ticket-btn openModal event_id">EDIT TICKET</a>
                            <a href="clone/{{ $event->id }}" class="md-link customeBorder">CLONE</a>
                          <button type="button" class="delete-event" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $event->id }}">
                            DELETE
                          </button>
                          <!-- Modal -->
                          <div class="modal fade delete_event_popup" id="exampleModal_{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="popup_close">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Are you sure?</p>
                                </div>
                                <div class="modal-footer">
                                  <a href="{{route('front.events.delete', ['event'=> $event->id])}}" class="btn btn-primary">Confirm</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


  	              	@endforeach
                  @else
                    <p>No Events Found!</p>
                  @endif

            	</div>
          	</div>
        </div>
    </div>
</section>
    <!-- Modal -->
    <form action="{{ route('front.events.ticket.update') }}" method="post" enctype="multipart/form-data" class="myModalForm">
    @csrf
    @method('PUT')
      
    </form>

@endsection

@push('scripts')
<script type="text/javascript">

        $('ul.menu_list li .down-icon').on('click',function(){
          $(this).parent('li').toggleClass('current');
          $(this).parent('li').find('ul.sub-menu').slideToggle();
        });

        // $('.openModal').click(function(){
        //   $('#exampleModal').addClass('showModal');
        //   $('.modal-dialog').slideDown();
        // });

        $('.event_id').click(function(){
          let event_id = $(this).attr('data');

          $.ajax({
              url:"{{route('front.events.ticket.get')}}",
              method:"GET",
              data:{event_id:event_id},
              beforeSend:function(){
                  // $('.loader').show();
              },
              success:function(data){
                var len   = 0;
                  $('.myModalForm').html(data);
                  $('.close').click(function(){
                    $('#exampleModal').removeClass('showModal');
                  });
                  $('#exampleModal').addClass('showModal');
            }
        });
      });
</script>
@endpush
<style>

    .customeBorder{
        color: #ed9a01 !important;margin-left: 15px;border-left: 1px #eaeaea solid;padding-left: 18px;
    }
    .customeBorder:after{
        background-color: #ed9a01 !important;
    }
    .event-box_list a.customeBorder:hover:after, .media-box a.customeBorder:hover:after{
        width: 77% !important;
        right: 0px;
        left: initial !important;
    }
</style>
