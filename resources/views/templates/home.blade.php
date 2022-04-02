@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	{!!$pages->description!!}
	<x-front.section.home-banner />
	<x-front.section.events-search />
	<x-front.section.events-featured />
	<x-front.section.sponsor-featured />
	<x-front.section.become-sponsor />
	<x-front.section.events-upcoming />
	<x-front.section.vendors-recent />
	<x-front.section.events-past />
	<x-front.section.contact-form />
	<x-front.section.newsletter />
@endsection

@push('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $('.ft-grids ul').owlCarousel({
            loop:true,
            margin:10,
            autoplay: true,
            nav:false,
            responsive:{
                0:{
                    items:2,
                    stagePadding: 60
                },
                600:{
                    items:5
                },
                1000:{
                    items:7
                }
            }
        });

         $('.banner-sponsors .logos ul').owlCarousel({
            loop:true,
            margin:10,
            autoplay: true,
            nav:false,
            responsive:{
                0:{
                    items:3
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });



        // var wdt = $(window).width();
        // if (wdt < 767) {
        //     $('.rcVendor-list ul').addClass('owl-carousel');
        //     $('.rcVendor-list ul').addClass('owl-theme');
        //     $('.rcVendor-list ul').owlCarousel({
        //         loop:true,
        //         margin:0,
        //         nav:false,
        //         touchDrag: false,
        //         responsive:{
        //             0:{
        //                 items:3
        //             }
        //         }
        //     });
        // }
    });
    </script>
@endpush