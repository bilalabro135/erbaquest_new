@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	{!!$pages->description!!}
	<x-front.section.events-search isEvent="true" />
	<x-front.section.event-search-amenties  />
	<x-front.section.events-all  past="true"/>
@endsection