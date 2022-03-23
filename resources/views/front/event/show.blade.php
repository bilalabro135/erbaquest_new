@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif

    <section class="event-inner pt-100 pb-100">
      <div class="container">
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
            @endif
<!--             <div class="reviews">
              <div class="review-box">
                <figure>
                  <img src="images/tst-author.png">
                </figure>
                <div class="rv-detail">
                  <h3 class="title">LOREM IPSUM <span class="figure"><img src="images/comment-icon.png"></span></h3>
                  <ul class="rate-list">
                    <li>
                      Speed
                      <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span>
                    </li>
                    <li>
                      Quality
                      <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span>
                    </li>
                    <li>
                      Price
                      <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span>
                    </li>
                  </ul>
                  <div class="comment">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                  </div>
                  <h5 class="time_ago">5 Years ago</h5>
                </div>
              </div>
              <div class="review-box">
                <figure>
                  <img src="images/tst-author.png">
                </figure>
                <div class="rv-detail">
                  <h3 class="title">LOREM IPSUM <span class="figure"><img src="images/comment-icon.png"></span></h3>
                  <ul class="rate-list">
                    <li>
                      Speed
                      <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span>
                    </li>
                    <li>
                      Quality
                      <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span>
                    </li>
                    <li>
                      Price
                      <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </span>
                    </li>
                  </ul>
                  <div class="comment">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                  </div>
                  <h5 class="time_ago">5 Years ago</h5>
                </div>
              </div>
            </div> -->
<!--             <div class="reviewForm">
              <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                  <label>Speed <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </span></label>
                  <label>Quality <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </span></label>
                  <label>Price <span class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </span></label>
                </div>
                <div class="input-field input-file">
                  <label>FEATURED PICTURE: <span class="figure"><img src="images/ft_profile.png"></span></label>
                  <input type="file" id="myFile" name="filename">
                  <div class="preview"></div>
                  <button type="button" id="uploadImg">
                    <span class="figure"><img src="images/uploadIcon.png"></span>
                    <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                  </button>
                </div>
                <div class="input-field">
                  <label>COMMENT:</label>
                  <textarea name="comment" placeholder="Comment.."></textarea>
                </div>
                <div class="input-field">
                  <label>NAME:</label>
                  <input type="text" name="name" placeholder="NAME:" required="required">
                </div>
                <div class="input-field">
                  <label>EMAIL:</label>
                  <input type="email" name="email" placeholder="EMAIL:" required="required">
                </div>
                <div class="input-field">
                  <label>WEBSITE:</label>
                  <input type="text" name="website" placeholder="WEBSITE:">
                </div>
                <div class="input-field input-submit">
                  <input type="submit" name="submit" value="SUBMIT YOUR REVIEW">
                </div>
              </form>
            </div> -->

          </div>
          <div class="col-sm-12 col-md-5">
            <div class="loct-box">
              <h4 class="date_head">DATE: <i class="far fa-calendar-alt"></i></h4>
              <div class="wishlistIcon">
                <input type="hidden" class="event_wish" name="event_id" value="{{$event->id}}">
                <a class="heart-link" href="javascript:void(0);">
                  <i class=" @if($InWishList) fas @else far @endif fa-heart" aria-hidden="true"></i>
                </a>
              </div>
              <div style="clear: both;"></div>
              <p><span class="dt-tag">{{date('d-m-Y', strtotime($event['event_date']))}}</span></p>
              <h4>ADDRESS: <i class="fas fa-map-marker-alt"></i></h4>
              <div class="mapFrame">
              	<iframe src="https://maps.google.com/maps?width=100%25&height=400&hl=en&q={{$event->address}}&t=&z=14&ie=UTF8&iwloc=B&output=embed" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </div>
              <p>{{$event->address}}</p>
              @if($event->type != null)
              <h4>TYPE OF EVENT: <span class="figure"><img src="{{asset('images/icons/icon14.png')}}"></span></h4>
              <p class="clr-green mb-40">{{$event->type}}</p>
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
            </div>
            @if(count($event->vendors))
            <div class="vendor-box">
              <h4>VENDORS: <span class="figure"><img src="{{asset('images/icons/icon18.png')}}"></span></h4>
              <ul class="vendor-list">
              	@foreach($event->vendors as $vendor)
                <li>
                  <figure>
                    <img src="{{($vendor->profile_image != null) ? $vendor->profile_image : asset('/images/avatar.png') }}" alt="{{$vendor->name}}">
                  </figure>
                  <span class="txt">
                    {{$vendor->name}}
                  </span>
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
                    items:3
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

