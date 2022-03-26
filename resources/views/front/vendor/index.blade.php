@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
<!-- <h1>{{$vendorData->email}}</h1> -->


   <section class="event-inner pt-100 pb-100">
      <div class="container">
        <div class="row align-center">
          <div class="col-sm-12 col-md-6">
            <h3 class="ft-blanka ftw-bold_36 mb-40">
              {{$vendorData->public_profile_name}}
            </h3>
            <p class="event_detail_text">{!!$vendorData->descreption!!}</p>
          </div>
          <div class="col-sm-12 col-md-6">
            <figure class="m-0">
              <img src="{{asset($vendorData->featured_picture)}}">
            </figure>
            <div class="social-box">
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
        <div class="row event-detail ">
			<!-- <div class="reviews">
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
			<!-- <div class="reviewForm">
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
          <div class="col-sm-12 col-md-5">
            
          </div>
        </div>
        <?php
        	$gallery = $vendorData->picture;
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