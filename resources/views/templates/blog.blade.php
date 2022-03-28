@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif

	 <!-- Podcasat -->
	<section class="secPodcast pt-100 pb-100">
		<div class="container">
		<h3 class="ft-blanka ftw-bold_36 text-center mb-40">PODCAST</h3>
		<div class="podcast-slider nav_arrow">
		<ul class="owl-carousel owl-theme owl-loaded owl-drag">
		<div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1146px, 0px, 0px); transition: all 0.25s ease 0s; width: 3820px;"><div class="owl-item cloned" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item cloned" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item cloned" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item active" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item active" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item active" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item cloned" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item cloned" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div><div class="owl-item cloned" style="width: 382px;"><li class="item">
		    <div class="podcast-box">
		      <figure>
		        <img src="images/podcast-1.jpg">
		        <div class="dtPodcast">
		          <h5>LOREM IPSUM DOLOR</h5>
		          <p>6 Episodes</p>
		        </div>
		      </figure>
		      <div class="detail">
		        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <div class="list-play">
		          <h4>
		            <span class="icon"><i class="far fa-play-circle" aria-hidden="true"></i></span>
		            <span class="episode">EPISODE 6</span>
		            <span class="text">LOREM IPSUM DOLOR SIT</span>
		            </h4>
		        </div>
		        <a href="javascript:;" class="pd-link">VIEW ALL EPISODES</a>
		      </div>
		    </div>
		  </li></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></button><button type="button" role="presentation" class="owl-next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button></div><div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button></div></ul>
		</div>
		</div>
	</section>
  	<!-- Podcasat -->

  	<x-front.section.blog-all  />
	

@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
$('.podcast-slider ul').owlCarousel({
    loop:true,
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
</script>
@endpush