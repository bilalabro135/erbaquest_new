@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	<div class="container cms-content pt-100 pb-100">
	    	<section class="wellcome_sec">
		<div class="container">
			<div class="wellcome_main">
				<div class="wellcome_text">
					<h2>Welcome</h2>
					<p>We at ErbaQuest take pride in strengthening community relationships while entertaining and educating the masses. That why our motto is simple. Stay Lit. Stay Informed.</p>
					<p>As a promotion company we intend to bring you and your brand to the forefront of the industry. Making you look good - makes us look good.</p>
					<p>Our app is designed to keep consumers informed while connecting Event Planners, Vendors, and other service providers to ensure it goes off without a hitch</p>
					<p>Our podcast is an extension of our team - which will provide knowledge and insights surrounding topics like - entertainment, news, events, cultivation, culture, and more!</p>
				</div>
				<div class="btn_podcast">
					<a href="#">Podcast</a>
				</div>
			</div>
		</div>
	</section>
	<section class="about_us">
		<div class="container">
			<div class="about_us_main">
				<div class="about_us_text">
					<h2>About Us</h2>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="img">
							<img src="{{ asset('images/ezgif.com-gif-maker.jpg') }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="about_us_text">
							<h3>Eulie V</h3>
							<p>Bio's Coming Soon!</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="row">					
					<div class="col-md-6">
						<div class="about_us_text">
							<h3>Justin Closser</h3>
							<p>Justin is a family man, an Iraq Vet, and former alcoholic/addict. Following his time in service, he became a medical marijuana patient and was able to overcome his substance abuse through cultivation and consumption. His passion for cultivation led him to quit his job and enroll in college in anticipation of NY Legalization. He graduated with the SUNY Chancellor's Award for Student Excellence, a member of Phi Theta Kappa, and a Coca Cola Academic Team Gold Scholar. Cultivation runs through his veins, as does helping people - let him help you cultivate your way to success. </p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="img">
							<img src="{{ asset('images/ezgif.com-gif-maker (2).jpg') }}">
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="img">
							<img src="{{ asset('images/ezgif.com-gif-maker (1).jpg') }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="about_us_text">
							<h3>John Zingaro</h3>
							<p>Cultivator of many things for 13+ years. That journey has had a lot of ups and downs, more bad than good but the end result is fine tuned high quality medicine after those years of trial and error. I'm supported by my loving fiancé and two wonderful boys ages 4 and 2. All three of them definitely keep me on my toes. I love the community that is being created here - but I started out in the underground community on the East Coast and transfer it over to the Wild West. I spent that time gaining knowledge from multiple cultivators - spending time at different locations learning the ins and outs of the industry - and where it all began. As glad as we are to be back east, I owe almost all of my knowledge to the great group of people I met in the west. I want to be able to take what I know and give back to the community I and promote everyone I can! Coming back here I was able to bring my best friend/brother into this world and together we are able to create something great. One crazy thought over an L sparked a passion in both of us that will show throughout our company and what we have the offer. That passion and drive is what will keep you lit and informed!</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</section>
	</div>
@endsection