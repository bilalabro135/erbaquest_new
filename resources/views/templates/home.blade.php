@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{$pages->featured_image}}"/>
	@endif
	{!!$pages->description!!}
	<x-front.section.home-banner />
	<x-front.section.events-search />
	<x-front.section.events-featured />
	<x-front.section.sponsor />
	<x-front.section.become-sponsor />
	<x-front.section.events-upcoming />
	<x-front.section.vendors-recent />
	<x-front.section.events-past />
	<x-front.section.contact-form />
	<x-front.section.newsletter />
@endsection