@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	<div class="container cms-content pt-100 pb-100">
	    {!!$pages->description!!}
	</div>
@endsection