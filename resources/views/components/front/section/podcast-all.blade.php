@if($podcasts)
<section class="secPodcast pt-100 pb-100">
	<div class="container">
		<h3 class="ft-blanka ftw-bold_36 text-center mb-40">PODCAST</h3>
    	<div class="podcast-slider nav_arrow">
	    	<ul class="owl-carousel owl-theme">
	    		@foreach($podcasts as $podcast)
			        <li class="item">
			          <div class="podcast-box">
			            <figure>
			            	@if ($podcast['cat_featured_image'])
				            	<img src="{{ asset($podcast['cat_featured_image']) }}" alt="{{$podcast['name']}}" />
				            @else
			                	<img src="{{ asset('images/avatar.png') }}" alt="{{$podcast['name']}}" />
			                @endif
			              <!-- <img src="{{ asset('images/podcast-1.jpg') }}"> -->
			              <div class="dtPodcast">
			                <h5>LOREM IPSUM DOLOR</h5>
			                <p>6 Episodes</p>
			              </div>
			            </figure>
			            <div class="detail">
			              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
			              <div class="list-play">
			                <h4>
			                  <span class="icon"><i class="far fa-play-circle"></i></span>
			                  <span class="episode">EPISODE 6</span>
			                  <span class="text">LOREM IPSUM DOLOR SIT</span>
			                  </h4>
			              </div>
			              <div class="list-play">
			                <h4>
			                  <span class="icon"><i class="far fa-play-circle"></i></span>
			                  <span class="episode">EPISODE 6</span>
			                  <span class="text">LOREM IPSUM DOLOR SIT</span>
			                  </h4>
			              </div>
			              <div class="list-play">
			                <h4>
			                  <span class="icon"><i class="far fa-play-circle"></i></span>
			                  <span class="episode">EPISODE 6</span>
			                  <span class="text">LOREM IPSUM DOLOR SIT</span>
			                  </h4>
			              </div>
			              <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
			            </div>
			          </div>
			        </li>
		        @endforeach
		        <!-- <li class="item">
		          <div class="podcast-box">
		            <figure>
		              <img src="{{ asset('images/podcast-1.jpg') }}">
		              <div class="dtPodcast">
		                <h5>LOREM IPSUM DOLOR</h5>
		                <p>6 Episodes</p>
		              </div>
		            </figure>
		            <div class="detail">
		              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		            </div>
		          </div>
		        </li>
		        <li class="item">
		          <div class="podcast-box">
		            <figure>
		              <img src="{{ asset('images/podcast-1.jpg') }}">
		              <div class="dtPodcast">
		                <h5>LOREM IPSUM DOLOR</h5>
		                <p>6 Episodes</p>
		              </div>
		            </figure>
		            <div class="detail">
		              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		            </div>
		          </div>
		        </li>
		        <li class="item">
		          <div class="podcast-box">
		            <figure>
		              <img src="{{ asset('images/podcast-1.jpg') }}">
		              <div class="dtPodcast">
		                <h5>LOREM IPSUM DOLOR</h5>
		                <p>6 Episodes</p>
		              </div>
		            </figure>
		            <div class="detail">
		              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <div class="list-play">
		                <h4>
		                  <span class="icon"><i class="far fa-play-circle"></i></span>
		                  <span class="episode">EPISODE 6</span>
		                  <span class="text">LOREM IPSUM DOLOR SIT</span>
		                  </h4>
		              </div>
		              <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		            </div>
		          </div>
		        </li> -->
	    	</ul>
    	</div>
  	</div>
</section>
@endif
<script type="text/javascript">
$(document).ready(function(){
	$('.podcast-slider ul').owlCarousel({
	    loop:false,
	    margin:0,
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
	            items:3
	        }
	    }
	});
});
</script>