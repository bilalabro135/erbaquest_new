@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          EDIT EVENT
        </h1>
      </div>
    </section>

    <section class="secAccount pt-100 pb-100">
      <div class="container">
        <div class="row">
          @include( 'tempview/sidebar' )
          	<div class="col-sm-12 col-md-8 UpcomingEvent">
	            <div class="row">
	            	@foreach($events as $event)
	              	<div class="col-sm-12 col-md-6">
	                <div class="media-box">
	                	<figure>
	                    	<img src="{{asset($event->featured_image)}}">
	                  	</figure>
	                  	<h5 class="cat">{{$event->area}}</h5>
	                  	<h3>{{$event->name}}</h3>
	                  	<p>{!!$event->description!!}</p>
	                  	<a href="<?php echo $event->id;?>/edit" class="md-link">EDIT</a>
                      <a href="{{route('front.events.delete', ['event'=> $event->id])}}" class="delete-event">DELETE</a>
	                </div>
	              	</div>
	              	@endforeach
            	</div>
          	</div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
  
        $('ul.menu_list li .down-icon').on('click',function(){
          $(this).parent('li').toggleClass('current');
          $(this).parent('li').find('ul.sub-menu').slideToggle();
        })
</script>

@endpush