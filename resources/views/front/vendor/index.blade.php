@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif


   <section class="vendor_inner event-inner pt-100 pb-100">
      <div class="container">
        @if(session('msg'))
          <div class="alert alert-{{session('msg_type')}}">
              {{session('msg')}}                                            
          </div>
        @endif
        <div class="row align-center">
          <div class="col-sm-12 col-md-6">
            <h3 class="ft-blanka ftw-bold_36 mb-40">
              {{$vendorData->public_profile_name}}
            </h3>
            <p class="event_detail_text">{!!$vendorData->descreption!!}</p>
          </div>
          <div class="col-sm-12 col-md-6 vendor_profile_img">
            <figure class="m-0">
              <img src="{{asset($vendorData->featured_picture)}}">
            </figure>
          </div>
        </div>
        <div class="row align-center">
          <div class="col-sm-12 col-md-6"></div>
          <div class="col-sm-12 col-md-6">
            <div class="social-box">
              <h4>CONTACT US:</h4>
              <ul class="contact-box">
                @if($vendorData->phone != null)
                <li>
                  <a href="tel:{{$vendorData->phone}}"><i class="fas fa-phone-alt"></i><span>{{$vendorData->phone}}</span></a>
                </li>
                @endif
                @if($vendorData->email != null)
                <li>
                  <a href="mailto:{{$vendorData->email}}"><i class="fas fa-envelope"></i><span>Send Mail</span></a>
                </li>
                @endif
                @if($vendorData->website != null)
                <li>
                  <a href="{{$vendorData->website}}" target="_blank"><i class="fas fa-globe"></i><span>Visit Site</span></a>
                </li>
                @endif
              </ul>

              <h4>SOCIAL LINKS:</h4>
              <ul>
                @if($vendorData->instagram != null)
                <li>
                  <a href="{{$vendorData->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>
                @endif
                @if($vendorData->facebook != null)
                <li>
                  <a href="{{$vendorData->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
                @endif
                @if($vendorData->twitter != null)
                <li>
                  <a href="{{$vendorData->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
                @endif
                @if($vendorData->youtube != null)
                <li>
                  <a href="{{$vendorData->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a>
                </li>
                @endif
                @if($vendorData->linkedin != null)
                <li>
                  <a href="{{$vendorData->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i></a>
                </li>
                @endif
                @if($vendorData->telegram != null)
                <li>
                  <a href="{{$vendorData->telegram}}" target="_blank"><i class="fab fa-telegram"></i></a>
                </li>
                @endif
                @if($vendorData->discord != null)
                <li>
                  <a href="{{$vendorData->discord}}" target="_blank"><i class="fab fa-discord"></i></a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
        <?php
        	$gallery = $vendorData->picture;
        	$gallery = ($gallery != '' && $gallery != null && !empty($gallery)) ? unserialize($gallery) : array();
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
          <div class="col-sm-12 col-md-7">
            @if(auth()->check()) 
            <div class="reviewForm">
                <form class="formReview" action="{{route('review.submit')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="rel_id" value="{{ $vendorData->id }}" >
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
                  <!-- <div class="input-field input-file">
                    <label>FEATURED PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span></label>
                    <input type="file" id="myFile" name="filename">
                    <div class="preview"></div>
                    <button type="button" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                  </div> -->
                  <div class="input-field">
                    <label>Review:</label>
                    <textarea name="comment" placeholder="Review"></textarea>
                    @error('comment')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <!-- <div class="input-field">
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
                  </div> -->
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