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
                            <p class="date"><i class="far fa-calendar-alt"></i>{{date('m-d-Y', strtotime($event['event_date']))}}</p>
                        @else
                            <p><b>Day: </b> {{  $event['day_dropdown'] }} <b>Type: </b>{{  $event['recurring_type'] }}</p>
                        @endif
                          <div class="txt">
                            <p>{!!$event['description']!!}</p>
                          </div>
                          <a href="../events/{{$event['id']}}" class="link">Details</a>
                          <a href="javascript:void(0)" class="link openModal" data="{{$event['id']}}" style="float: right;">Create ticket</a>
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

    {!! Form::open(array('route' => 'front.events.ticket.store','method'=>'POST')) !!}
      @csrf
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Generate Ticket</h5>
              <input type="hidden" name="event_id"  required value="" class="event_id">
              <button type="button" class="btn close text-dark">x</button>
            </div>
            <div class="modal-body p-4 row">
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Total tickets available:<span class="figure"></label>
                <input type="number" name="total"  required placeholder="200..." value="{{old('total')}}">
                @error('total')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Ticket price:<span class="figure"></span></label>
                <input type="text" name="price"  required placeholder="$20" value="{{old('price')}}">
                @error('price')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>User quantity<span class="figure"></span></label>
                <input type="number" name="qty"  required placeholder="Total users quantity" value="{{old('qty')}}">
                @error('qty')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Discount code<span class="figure"></span></label>
                <input type="text" name="discount_code"  required placeholder="%Discount" value="{{old('discount_code')}}">
                @error('discount_code')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Discount percentage <span class="figure"></span></label>
                <input type="text" name="discount_percentage"  required placeholder="%..." value="{{old('discount_percentage')}}">
                @error('discount_percentage')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Max utilization<span class="figure"></span></label>
                <input type="number" name="max_utilization"  required placeholder="2,3,..." value="{{old('max_utilization')}}">
                @error('max_utilization')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Start date<span class="figure"></span></label>
                <input type="date" name="start_date"  required value="{{old('start_date')}}">
                @error('start_date')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>End date<span class="figure"></span></label>
                <input type="date" name="end_date"  required value="{{old('end_date')}}">
                @error('end_date')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>VIP ticket<span class="figure"></span></label>
                <input type="text" name="vip_ticket"  required placeholder="VIP's ticket" value="{{old('vip_ticket')}}">
                @error('vip_ticket')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>Total VIP tickets<span class="figure"></span></label>
                <input type="number" name="total_vip" required placeholder="VIP ticket's?" value="{{old('total_vip')}}">
                @error('total_vip')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>VIP ticket price<span class="figure"></span></label>
                <input type="text" name="vip_ticket_price" required placeholder="VIP's ticket price $" value="{{old('vip_ticket_price')}}">
                @error('vip_ticket_price')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6 input-field mt-4">
                <label>User quantity to buy today<span class="figure"></span></label>
                <input type="number" name="user_qty" required placeholder="Users can buy?" value="{{old('user_qty')}}">
                @error('user_qty')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-12 input-field mt-4 customDropdown">
                <label>Status<span class="figure"></span></label>
                <select name="status" class="form-control" required >
                    <option selected disabled>--Please select--</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
              </div>
            </div>
            <div class="modal-footer modal-footer-btn">
              <button type="submit" class="btn btn-success text-light">Save</button>
            </div>
          </div>
        </div>
      </div>
    {!! Form::close() !!}

@endsection

@push('scripts')
<script type="text/javascript">
  $('ul.menu_list li .down-icon').on('click',function(){
    $(this).parent('li').toggleClass('current');
    $(this).parent('li').find('ul.sub-menu').slideToggle();
  });

  $('.openModal').click(function(){
      $('#exampleModal').addClass('showModal');
      $('.modal-dialog').slideDown();
    });
    $('.close').click(function(){
      $('#exampleModal').removeClass('showModal');
    });
    // $('.event_id').click(function(){
    //   var eventId = $(this).val();
    //   console.log(eventId);
    // });

    $(".openModal").click(function(){
      var eventId  = $(this).attr('data');
      $(".event_id").attr('value', eventId);
      console.log(eventId);
    });
</script>

@endpush
