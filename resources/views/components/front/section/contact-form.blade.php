<section class="home_contact_form recentVendors pt-65 pb-65">
  <div class="container">
    @if(isset($fields['heading']))
       <h3 class="ft-blanka vc_heading vc_heading-green text-center">{!! $fields['heading'] !!}</h3>
    @endif
    @if(isset($fields['description']))
      <p class="text-center">{!! $fields['description'] !!}</p>
    @endif
    <form class="contactForm" action="{{route('contact-form.store')}}" method="post">
      @csrf
      <input type="hidden" name="contact_type" value="general">
      <div class="row">
        <div class="col-sm-12 col-md-6 input-field">
          <input type="text" name="first_name" placeholder="First Name:" required="required">
        </div>
        <div class="col-sm-12 col-md-6 input-field">
          <input type="text" name="last_name" placeholder="Last Name:" required="required">
        </div>
        <div class="col-sm-12 col-md-6 input-field">
          <input type="email" name="email" placeholder="Email Address:" required="required">
        </div>
        <div class="col-sm-12 col-md-6 input-field">
          <input type="text" name="subject" placeholder="Subject:" required="required">
        </div>
        <div class="col-sm-12 input-field">
          <textarea name="message" placeholder="Message"></textarea>
        </div>
        <div class="col-sm-12 input-submit input-field">
          <input type="submit" name="submit" value="{{(isset($fields['cta_action'])) ? isset($fields['cta_action']) : 'SUMBIT'}}">
        </div>
        @if(session('msg'))
            <div class="alert alert-success" style="margin-top: 50px;">
                {{session('msg')}}                                            
            </div>
        @endif
      </div>
    </form>
  </div>
</section>