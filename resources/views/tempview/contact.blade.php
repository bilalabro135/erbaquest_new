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
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="locate-box left">
              <div class="deail">
                <h3>FIND US IN GREECE</h3>
                <p>Cras ultricies ligula sed magna dictum porta. Proin eget <br> tortor risus.</p>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="locate-box right">
              <div class="deail">
                <h3>FIND US IN NEW YORK</h3>
                <p>Cras ultricies ligula sed magna dictum porta. Proin eget <br> tortor risus.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row ct-sect">
          <div class="col-sm-12 col-md-4">
            <div class="info-box">
              <figure>
                <img src="images/info-1.png">
              </figure>
              <h4>CALL CENTER</h4>
              <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Lorem ipsum dolor sit amet, consectetur.</p>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="info-box">
              <figure>
                <img src="images/info-2.png">
              </figure>
              <h4>MAIL US</h4>
              <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Lorem ipsum dolor sit amet, consectetur.</p>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="info-box">
              <figure>
                <img src="images/info-3.png">
              </figure>
              <h4>NEAREST BRANCH</h4>
              <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Lorem ipsum dolor sit amet, consectetur.</p>
            </div>
          </div>
        </div>

        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                What is Flowers?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Getting Started with Flowers?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Do i have the latest version?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                How many times can I use Flowers?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                How to migrate my website?
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p>Nulla porttitor accumsan tincidunt. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Proin eget tortor <br> risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>
              </div>
            </div>
          </div>
        </div>

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