@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{$pages->featured_image}}"/>
	@endif
	{!!$pages->description!!}
@endsection