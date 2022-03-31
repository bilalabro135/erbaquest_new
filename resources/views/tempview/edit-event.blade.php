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
                          <p class="date"><i class="far fa-calendar-alt"></i>{{date('d-m-Y', strtotime($event['event_date']))}}</p>
                          <div class="txt">
                            <p class="event_description">{!!$event->description!!}</p>
                          </div>
                          <a href="{{ $event->id }}/edit" class="md-link">EDIT</a>
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

@endsection

@push('scripts')
<script type="text/javascript">
  
        $('ul.menu_list li .down-icon').on('click',function(){
          $(this).parent('li').toggleClass('current');
          $(this).parent('li').find('ul.sub-menu').slideToggle();
        })
</script>

@endpush