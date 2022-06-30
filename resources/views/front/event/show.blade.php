@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif

    <section class="event-inner pt-100 pb-100">
      <div class="container">
        @if(session('msg'))
          <div class="alert alert-{{session('msg_type')}}">
              {{session('msg')}}
          </div>
        @endif
        <div class="row align-center">
          <div class="col-sm-12 col-md-6">
            <h3 class="ft-blanka ftw-bold_36 mb-40">
              {{$event->name}}
            </h3>
            <p class="event_detail_text">{!!$event->description!!}</p>
          </div>
          <div class="col-sm-12 col-md-6">
            <figure class="m-0">
              <img src="{{asset($event->featured_image)}}">
            </figure>
          </div>
        </div>
        <?php
        	$gallery = $event->gallery;
        	$gallery = ($gallery != '' && $gallery != null && !empty($gallery)) ? unserialize($gallery) : array();
          // dd(unserialize($event->gallery));
        ?>
        @if(!empty($gallery))
        <div class="evGallery nav_arrow">
          <ul class="owl-carousel owl-theme">
          	@foreach($gallery as $gal)
	            <li class="item">
	              <div class="figure">
	                <img src="{{asset('/' . $gal['url'])}}" alt="{{$gal['alt']}}">
	              </div>
	            </li>
          	@endforeach
          </ul>
        </div>
        @endif
        <div class="row event-detail ">
          <div class="col-sm-12 col-md-7 ft-event">
            <div class="alert alert-success">
               Added To <a href='{{route("wishlist")}}'>WishLists</a>
               <a href="#" class="close_sucesss">x</a>
            </div>
            <div class="alert alert-danger">
               Event has been removed from Wishlist!
               <a href="#" class="close_sucesss">x</a>
            </div>
            <div class="detail">
              @if($event->vendor_space_available != null)
              <h4>VENDOR SPACES AVAILABLE:</h4>
              <p>{{$event->vendor_space_available}}</p>
              @endif


              @if(count($event->amenities))
              <h4>AMENTIES:</h4>
              <ul class="amenties_list">
	            @foreach($event->amenities as $amenity)
                <li>
                  <figure class="m-0">
                    <img src="{{$amenity->icon}}" alt="{{$amenity->name}}">
                  </figure>
                  <span class="txt">{{$amenity->name}}</span>
                </li>
                @endforeach
              </ul>
              @endif
            </div>
            <div class="row placeDetail">
              <div class="col-sm-12 col-md-6">
              	@if($event->area != null)
                <div class="plc-tag">
                  <h5>AREA: <span class="figure"><img src="{{asset('images/vc_area.png')}}"></span></h5>
                  <p>{{$event->area}}</p>
                </div>
                @endif
                @if($event->capacity != null)
                <div class="plc-tag">
                  <h5>CAPACITY: <span class="figure"><img src="{{asset('images/icons/icon7.png')}}"></span></h5>
                  <p>{{$event->capacity}}</p>
                </div>
                @endif
                @if($event->tickiting_number != null)
                <div class="plc-tag">
                  <h5>TICKITING PHONE NUMBER: <span class="figure"><img src="{{asset('images/icons/icon9.png')}}"></span></h5>
                  <a href="tel:{{$event->tickiting_number}}"><p>{{$event->tickiting_number}}</p></a>
                </div>
                @endif
                @if($event->user_number != null)
                <div class="plc-tag">
                  <h5>USER NUMBER: <span class="figure"><img src="{{asset('images/icons/icon10.png')}}"></span></h5>
                  <p>{{$event->user_number}}</p>
                </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-6">
                @if($event->height != null)
                <div class="plc-tag">
                  <h5>HEIGHT: <span class="figure"><img src="{{asset('images/icons/icon6.png')}}"></span></h5>
                  <p>{{$event->height}}</p>
                </div>
                @endif
                @if($event->ATM_on_site != null)
                <div class="plc-tag">
                  <h5>ATM ON SITE: <span class="figure"><img src="{{asset('images/icons/icon8.png')}}"></span></h5>
                  <p>{{$event->ATM_on_site}}</p>
                </div>
                @endif
                @if($event->vendor_number != null)
                <div class="plc-tag">
                  <h5>VENDOR PHONE NUMBER: <span class="figure"><img src="{{asset('images/icons/icon10.png')}}"></span></h5>
                  <a href="tel:{{$event->vendor_number}}"><p>{{$event->vendor_number}}</p></a>
                </div>
                @endif
              </div>
            </div>

            @if($event->status == 'draft')
              <div class="social-box">
                <!-- <h4>Action:</h4> -->
                <div class="button_center">
                    <a href="{{ $action_status }}" class="action_publish">Publish</a>
                    <a href="{{ $action_edit }}" class="action_edit">Edit</a>
                    <a href="javascript:void(0);" class="action_delete" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                </div>
              </div>
              <div class="modal fade delete_event_popup" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="popup_close">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                      <a href="{{ $action_delete }}" class="btn btn-primary">Confirm</a>
                    </div>
                  </div>
                </div>
              </div>
            @else
          <div class="row event-detail ">
          <div class="">
            @if(auth()->check())
            <div class="reviewForm">
                <form class="formReview" action="{{route('review.submit.events')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="rel_id" value="{{ $event->id }}" >
                  <div class="input-field">
                      <div class="form_star_rating">
                        <label>Speed</label>
                        <div class="speedRate rate_style">
                          <input type="radio" id="speedStar5" name="speed" value="5" />
                          <label for="speedStar5" title="text">5 stars</label>
                          <input type="radio" id="speedStar4" name="speed" value="4" />
                          <label for="speedStar4" title="text">4 stars</label>
                          <input type="radio" id="speedStar3" name="speed" value="3" />
                          <label for="speedStar3" title="text">3 stars</label>
                          <input type="radio" id="speedStar2" name="speed" value="2" />
                          <label for="speedStar2" title="text">2 stars</label>
                          <input type="radio" id="speedStar1" name="speed" value="1" />
                          <label for="speedStar1" title="text">1 star</label>
                        </div>
                        <div class="clearfix"></div>
                        @error('speed')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>

                      <div class="form_star_rating">
                        <label>Quality</label>
                        <div class="qualityRate rate_style">
                          <input type="radio" id="qualityStar5" name="quality" value="5" />
                          <label for="qualityStar5" title="text">5 stars</label>
                          <input type="radio" id="qualityStar4" name="quality" value="4" />
                          <label for="qualityStar4" title="text">4 stars</label>
                          <input type="radio" id="qualityStar3" name="quality" value="3" />
                          <label for="qualityStar3" title="text">3 stars</label>
                          <input type="radio" id="qualityStar2" name="quality" value="2" />
                          <label for="qualityStar2" title="text">2 stars</label>
                          <input type="radio" id="qualityStar1" name="quality" value="1" />
                          <label for="qualityStar1" title="text">1 star</label>
                        </div>
                        <div class="clearfix"></div>
                        @error('quality')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>

                      <div class="form_star_rating">
                        <label>Price</label>
                        <div class="priceRate rate_style">
                          <input type="radio" id="priceStar5" name="price" value="5" />
                          <label for="priceStar5" title="text">5 stars</label>
                          <input type="radio" id="priceStar4" name="price" value="4" />
                          <label for="priceStar4" title="text">4 stars</label>
                          <input type="radio" id="priceStar3" name="price" value="3" />
                          <label for="priceStar3" title="text">3 stars</label>
                          <input type="radio" id="priceStar2" name="price" value="2" />
                          <label for="priceStar2" title="text">2 stars</label>
                          <input type="radio" id="priceStar1" name="price" value="1" />
                          <label for="priceStar1" title="text">1 star</label>
                        </div>
                        <div class="clearfix"></div>
                        @error('price')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>
                  </div>
                  <div class="input-field">
                    <label>Review:</label>
                    <textarea name="comment" placeholder="Review"></textarea>
                    @error('comment')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="input-field input-submit">
                    <input type="submit" name="submit" value="SUBMIT YOUR REVIEW">
                  </div>
                </form>
            </div>
            @endif
            <div class="reviews" @if(!auth()->check()) style="margin-top:0px;" @endif>
              @if($sendReviews)
                @foreach($sendReviews as $sendReview)
                  <div class="review-box">
                    <figure>
                      @if(!empty($sendReview['profile_image']))
                        <img src="{{ $sendReview['profile_image'] }}" >
                      @else
                        <img src="{{asset('images/avatar.png')}}">
                      @endif
                    </figure>
                    <div class="rv-detail">
                      <h3 class="title">{{ $sendReview['name'] }}<span class="figure"><img src="{{asset('images/comment-icon.png')}}"></span></h3>
                      <ul class="rate-list">
                        <li>
                          Speed
                          <span class="stars">
                             @for ($i = 0; $i < 5; $i++)
                                @if($i >= $sendReview['speed_rating'])
                                    <i class="far fa-star"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif
                            @endfor
                          </span>
                        </li>
                        <li>
                          Quality
                          <span class="stars">
                            @for ($i = 0; $i < 5; $i++)
                                @if($i >= $sendReview['quality_rating'])
                                    <i class="far fa-star"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif
                            @endfor
                          </span>
                        </li>
                        <li>
                          Price
                          <span class="stars">
                            @for ($i = 0; $i < 5; $i++)
                                @if($i >= $sendReview['price_rating'])
                                    <i class="far fa-star"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif
                            @endfor
                          </span>
                        </li>
                      </ul>
                      <div class="comment">
                        <p>{{ $sendReview['comment'] }}</p>
                      </div>
                      <h5 class="time_ago">{{ $sendReview['date'] }}</h5>
                    </div>
                  </div>
              @endforeach
            @endif
            </div>

          </div>
        </div>
      @endif
    </div>
          <div class="col-sm-12 col-md-5">
            <div class="loct-box">
              @if(!$event->is_recurring)
               <h4 class="date_head">DATE: <i class="far fa-calendar-alt"></i></h4>
              @else
                  <div class="date_rec">
                    <h4 class="date_head_rec">Day Of recurring: {{ $event->day_dropdown }}</h4>
                    <h4 class="date_head_rec">Type: {{ $event->recurring_type }}</h4>
                  </div>
              @endif

              <div class="wishlistIcon">
                <input type="hidden" class="event_wish" name="event_id" value="{{$event->id}}">
                <a class="heart-link" href="javascript:void(0);">
                  <i class=" @if($InWishList) fas @else far @endif fa-heart" aria-hidden="true"></i>
                </a>
              </div>
              <div style="clear: both;"></div>
              @if(!$event->is_recurring)
                <p><span class="dt-tag">{{date('m-d-Y', strtotime($event['event_date']))}}</span></p>
               @endif
              <h4>ADDRESS: <i class="fas fa-map-marker-alt"></i></h4>
              <div class="mapFrame">
              	<iframe src="https://maps.google.com/maps?width=100%25&height=400&hl=en&q={{$event->address}}&t=&z=14&ie=UTF8&iwloc=B&output=embed" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </div>
              <p>{{$event->address}}</p>

            

              @if(count($event->type))
                <h4>TYPE OF EVENT: <span class="figure"><img src="{{asset('images/icons/icon14.png')}}"></span></h4>
                @foreach($event->type as $type)
                  <span class="eventTypeVal clr-green mb-40">{{$type}}</span>
                @endforeach
              @endif


              @if($event->door_dontation != null)
              <h4>EXPECTED DOOR DONATION: <span class="figure"><img src="{{asset('images/icons/icon15.png')}}"></span></h4>
              <p class="clr-green mb-40">${{$event->door_dontation}}</p>
              @endif
              <ul class="vipGuest">
              	@if($event->vip_dontation != null)
                <li>
                  <h4>VIP DONATION: <span class="figure"><img src="{{asset('images/icons/icon16.png')}}"></span></h4>
                  <p>${{$event->vip_dontation}}</p>
                </li>
                @endif
              	@if($event->charity != null)
                <li>
                  <h4>CHARITY: <span class="figure"><img src="{{asset('images/icons/icon16.png')}}"></span></h4>
                  <p>{{$event->charity}}</p>
                </li>
                @endif
              	@if($event->vip_perk != null)
                <li>
                  <h4>VIP PERK: <span class="figure"><img src="{{asset('images/icons/icon17.png')}}"></span></h4>
                  <p>{{$event->vip_perk}}</p>
                </li>
                @endif
              	@if($event->cost_of_vendor != null)
                <li>
                  <h4>COST OF VEND: <span class="figure"><img src="{{asset('images/icons/icon17.png')}}"></span></h4>
                  <p>${{$event->cost_of_vendor}}</p>
                </li>
                @endif
              </ul>
                @if(!$event->is_recurring)
                    <div class="add-to-cal">
                        <a class="" target="_blank" href="https://calendar.google.com/calendar/r/eventedit?text={{$event->name}}&dates={{ \Carbon\Carbon::parse($event['event_date'])->format('Ymd')}}/{{ \Carbon\Carbon::parse($event['event_date'])->addDays(1)->format('Ymd')}}&details={!! $event->description !!}&location={{$event->address}}">
                            <h4>ADD TO CALENDER <i class="far fa-calendar-alt" aria-hidden="true"></i></h4>
                        </a>
                    </div>
                @endif
            </div>
            @if($vendorProfiles)
            <div class="vendor-box">
              <h4>VENDORS: <span class="figure"><img src="{{asset('images/icons/icon18.png')}}"></span></h4>
              <ul class="vendor-list">
              	@foreach($vendorProfiles as $vendorProfile)
                <li>
                  <figure>
                    <a href="{{URL::to('/')}}/vendors/{{ $vendorProfile['link_id'] }}">
                      <img src="{{($vendorProfile['featured_picture'] != null) ? asset($vendorProfile['featured_picture']) : asset('/images/avatar.png') }}" alt="{{$vendorProfile['public_profile_name']}}">
                    </a>
                  </figure>
                  <a href="{{URL::to('/')}}/vendors/{{ $vendorProfile['link_id'] }}">
                    <span class="txt">{{$vendorProfile['public_profile_name']}}</span>
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
            @endif
            <div class="social-box">
              <h4>SOCIAL LINKS:</h4>
              <ul>
              	@if($event->instagram != null)
                <li>
                	<a href="{{$event->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>
                @endif
              	@if($event->facebook != null)
                <li>
                	<a href="{{$event->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
                @endif
              	@if($event->twitter != null)
                <li>
                	<a href="{{$event->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
                @endif
              	@if($event->youtube != null)
                <li>
                	<a href="{{$event->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a>
                </li>
                @endif
              	@if($event->linkedin != null)
                <li>
                	<a href="{{$event->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i></a>
                </li>
                @endif
                @if($event->telegram != null)
                <li>
                	<a href="{{$event->telegram}}" target="_blank"><i class="fab fa-telegram"></i></a>
                </li>
                @endif
                @if($event->discord != null)
                <li>
                	<a href="{{$event->discord}}" target="_blank"><i class="fab fa-discord"></i></a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@push('scripts')
	<script type="text/javascript">
        $('.evGallery ul').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });
        $(".heart-link").click(function() {
          $(".alert").hide();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var event_id = $(this).prev(".event_wish").val();
          $.ajax({
            url:'{{route("add.wishlist")}}',
            type:'POST',
            data:'event_id='+event_id,
            beforeSend: function() {
              $(".heart-link").addClass('disabled-link');
            },
            success:function(data) {
              console.log(data);
              if(data){
                if(data.action == "add"){
                  $(".event_wish").addClass("addedwishlist");
                  $('.wishlistIcon').find('.fa-heart').removeClass('far');
                  $('.wishlistIcon').find('.fa-heart').addClass('fas');
                  $(".alert-success").show();
                }else if(data.action == "remove"){
                  $(".event_wish").removeClass("addedwishlist");
                  $('.wishlistIcon').find('.fa-heart').removeClass('fas');
                  $('.wishlistIcon').find('.fa-heart').addClass('far');
                  $(".alert-danger").show();
                }else if(data.action == "redirect"){
                  //console.log(data.action);
                   window.location=data.url;
                }

                setTimeout(function() {
                  $(".alert").hide();
                }, 2500);
              }
              $(".heart-link").removeClass('disabled-link');
             }
          });
        });

        $(".close_sucesss").click(function() {
          event.preventDefault();
          $(this).parent().hide();
        });
    </script>
@endpush

