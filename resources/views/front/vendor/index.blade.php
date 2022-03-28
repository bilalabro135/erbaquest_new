@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif


   <section class="vendor_inner event-inner pt-100 pb-100">
      <div class="container">
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
            <div class="reviews">
              <div class="review-box">
                <figure>
                  <img src="{{asset('images/tst-author.png')}}">
                </figure>
                <div class="rv-detail">
                  <h3 class="title">LOREM IPSUM <span class="figure"><img src="{{asset('images/comment-icon.png')}}"></span></h3>
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
                  <img src="{{asset('images/tst-author.png')}}">
                </figure>
                <div class="rv-detail">
                  <h3 class="title">LOREM IPSUM <span class="figure"><img src="{{asset('images/comment-icon.png')}}"></span></h3>
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
            </div>
            <div class="reviewForm">
                <form class="" action="" method="post" enctype="multipart/form-data">
                  <div class="input-field">

                    <!--  -->
                      <div class="form_star_rating">
                        <label>Speed</label>
                        <div class="speedRate">
                          <input type="radio" id="speedStar5" name="rate" value="5" />
                          <label for="speedStar5" title="text">5 stars</label>
                          <input type="radio" id="speedStar4" name="rate" value="4" />
                          <label for="speedStar4" title="text">4 stars</label>
                          <input type="radio" id="speedStar3" name="rate" value="3" />
                          <label for="speedStar3" title="text">3 stars</label>
                          <input type="radio" id="speedStar2" name="rate" value="2" />
                          <label for="speedStar2" title="text">2 stars</label>
                          <input type="radio" id="speedStar1" name="rate" value="1" />
                          <label for="speedStar1" title="text">1 star</label>
                        </div>
                        <div class="clearfix"></div>
                      </div>

                      <div class="form_star_rating">
                        <label>Quality</label>
                        <div class="qualityRate">
                          <input type="radio" id="qualityStar5" name="rate" value="10" />
                          <label for="qualityStar5" title="text">5 stars</label>
                          <input type="radio" id="qualityStar4" name="rate" value="9" />
                          <label for="qualityStar4" title="text">4 stars</label>
                          <input type="radio" id="qualityStar3" name="rate" value="8" />
                          <label for="qualityStar3" title="text">3 stars</label>
                          <input type="radio" id="qualityStar2" name="rate" value="7" />
                          <label for="qualityS" title="text">2 stars</label>
                          <input type="radio" id="qualityStar1" name="rate" value="6" />
                          <label for="qualityStar1" title="text">1 star</label>
                        </div>
                        <div class="clearfix"></div>
                      </div>

                      <div class="form_star_rating">
                        <label>Price</label>
                        <div class="priceRate">
                          <input type="radio" id="priceStar5" name="rate" value="15" />
                          <label for="priceStar5" title="text">5 stars</label>
                          <input type="radio" id="priceStar4" name="rate" value="14" />
                          <label for="priceStar4" title="text">4 stars</label>
                          <input type="radio" id="priceStar3" name="rate" value="13" />
                          <label for="priceStar3" title="text">3 stars</label>
                          <input type="radio" id="priceStar2" name="rate" value="12" />
                          <label for="priceStar2" title="text">2 stars</label>
                          <input type="radio" id="priceStar1" name="rate" value="11" />
                          <label for="priceStar1" title="text">1 star</label>
                        </div>
                        <div class="clearfix"></div>
                      </div>

                    <!--  -->


                   <!--  <label>Speed <span class="stars">
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
                    </span></label> -->
                  </div>
                  <div class="input-field input-file">
                    <label>FEATURED PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span></label>
                    <input type="file" id="myFile" name="filename">
                    <div class="preview"></div>
                    <button type="button" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
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