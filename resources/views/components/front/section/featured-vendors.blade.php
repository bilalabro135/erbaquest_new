@if(!empty($vendors))
<section class="featured_vendors">
	<h3 class="ft-blanka vc_heading vc_heading-green text-center">FEATURED VENDORS</h3>
    <div class="FV_slider nav_arrow">
      <ul class="owl-carousel owl-theme">
      	@foreach($vendors as $vendor)
            <li class="item">
              <div class="figure">
              	<a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $vendor['id']])}}">
                	<img src="https://erbaquest.com{{asset($vendor['featured_picture'])}}">
            	</a>
              </div>
            </li>
      	@endforeach
      </ul>
    </div>
</section>
@endif
@push('scripts')
<script>
	$('.FV_slider ul').owlCarousel({
	    loop:false,
	    margin:10,
	    nav:true,
	    navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
	    responsive:{
	        0:{
	            items:2
	        },
	        600:{
	            items:5
	        },
	        1000:{
	            items:7
	        }
	    }
	});
</script>
@endpush
