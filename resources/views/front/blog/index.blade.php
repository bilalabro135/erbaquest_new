@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif


    <section class="blog_detail_page">
    	<div class="container">
    		<div class="blog_detail">
    			<h3 class="ft-blanka ftw-bold_36 mb-40"> {{$blogsData->name}} </h3>
    			<figure class="m-0 pull_right">
		            @if ($blogsData['featured_image'])
		            	<img src="{{ asset($blogsData['featured_image']) }}" alt="{{$blogsData['name']}}" />
		            @else 
		            	<img src="{{ asset('images/avatar.png') }}" alt="{{$blogsData['name']}}" />
		            @endif
            	</figure>	
            	{!!$blogsData->description!!}
    		</div>
    	</div>
    </section>

@endsection