@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif

    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          CONTACT US
        </h1>
      </div>
    </section>

    <section class="secContact pt-100 pb-100">
      <div class="container">
        @if(session('msg'))
            <div class="alert alert-success">
                {{session('msg')}}                                            
            </div>
        @endif
        <x-front.section.contact-us />
        <x-front.section.contact-info />
        <x-front.section.faq />

        <div class="signupForm">
          <form class="form_contact" action="{{route('contact-form.store')}}" method="post">
            @csrf
            <input type="hidden" name="contact_type" value="general">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="input-field">
                  <label>First Name:</label>
                  <input type="text" name="first_name" placeholder="First Name:" required="required">
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="input-field">
                  <label>Last Name:</label>
                  <input type="text" name="last_name" placeholder="Last Name:" required="required">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-field">
                  <label>Email Address:</label>
                  <input type="email" name="email" placeholder="Email Address:" required="required">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-field">
                  <label>Subject:</label>
                  <input type="text" name="subject" placeholder="Subject:" required="required">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-field">
                  <label>Message:</label>
                  <textarea name="message" placeholder="Type your message..."></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="input-field input-submit">
                  <input type="submit" name="submit" value="SEND MESSAGE">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
@endsection