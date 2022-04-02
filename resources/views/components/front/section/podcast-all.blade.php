<section class="secPodcast pt-100 pb-100">
	<div class="container">
		<h3 class="ft-blanka ftw-bold_36 text-center mb-40">PODCAST</h3>
		@if($podcasts)
	    	<div class="podcast-slider nav_arrow">
		    	<ul class="owl-carousel owl-theme">
		    		@foreach($podcasts as $podcast)
				        <li class="item">
				          <div class="podcast-box">
				            <figure>
				            	@if ($podcast['cat_featured_image'])
					            	<img src="{{ asset($podcast['cat_featured_image']) }}" alt="{{$podcast['name']}}" />
					            @else
				                	<img src="{{ asset('images/placeholder.jpg') }}" alt="{{$podcast['name']}}" />
				                @endif
				              <div class="dtPodcast">
				                <h5>{{ $podcast['name']}} </h5>
				                 <p>{{ $podcast['total'] }} Episodes</p>
				              </div>
				            </figure>
				            <div class="detail">
				            	<p>{{ $podcast['description'] }}</p>
					            @if($podcast['gallery']) 	
					            	@foreach($podcast['gallery'] as $key => $gallery)
					            		@if($key != 3)
								            <div class="list-play {{$key+1}}">
						            			<a href="{{route('posts.show', ['pages' => 'podcast', 'id' => $podcast['id']])}}?episode={{ $gallery['sort'] + 1 }}">
									                <h4>
										                <span class="icon"><i class="far fa-play-circle"></i></span>
										                <span class="episode">EPISODE {{ $gallery['sort'] + 1 }}</span>
										                <span class="text">{{ $gallery['alt'] }}</span>
										            </h4>
								          		</a>
								            </div>
							            
								        @endif
					              	@endforeach
					             @endif
				            	<a href="{{route('posts.show', ['pages' => 'podcast', 'id' => $podcast['id']])}}" class="pd-link">VIEW ALL EPISODES</a>
				            </div>
				          </div>
				        </li>
			        @endforeach
		    	</ul>
	    	</div>
	    @endif	
  	</div>
</section>
<script type="text/javascript">
$(document).ready(function(){
	$('.podcast-slider ul').owlCarousel({
	    loop:false,
	    margin:0,
	    nav:true,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	        0:{
	            items:1
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

