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
				            	<img src="{{ asset($podcast['cat_featured_image']) }}" alt="{{$podcast['catname']}}" />
				            @else
			                	<img src="{{ asset('images/placeholder.jpg') }}" alt="{{$podcast['catname']}}" />
			                @endif
			              <div class="dtPodcast">
			                <h5>{{$podcast['catname']}}</h5>
			                <!-- <p>6 Episodes</p> -->
			              </div>
			            </figure>
			            <div class="detail">
			            	<p>{{$podcast['cat_description']}}</p>
			              	<div class="list-play">
				                <h4>
					                <span class="icon"><i class="far fa-play-circle"></i></span>
					                <span class="episode">EPISODE {{$podcast['episode_num']}}</span>
					                <span class="text">{{$podcast['podcast_name']}}</span>
					            </h4>
			              	</div>
			            	<a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
			            </div>
			          </div>
			        </li>
		        @endforeach
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