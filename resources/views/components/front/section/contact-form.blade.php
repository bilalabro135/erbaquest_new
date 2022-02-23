<section class="recentVendors pt-65 pb-65">
  <div class="container">
    @if(isset($fields['heading']))
       <h3 class="ft-blanka vc_heading vc_heading-green text-center">{!! $fields['heading'] !!}</h3>
    @endif
    @if(isset($fields['description']))
      <p class="text-center">{!! $fields['description'] !!}</p>
    @endif
    <form class="contactForm" action="" method="post">
      <div class="row">
        <div class="col-sm-12 col-md-4 input-field">
          <input type="text" name="name" placeholder="Name*" required="required">
        </div>
        <div class="col-sm-12 col-md-4 input-field">
          <input type="email" name="email" placeholder="Email*" required="required">
        </div>
        <div class="col-sm-12 col-md-4 input-field">
          <input type="text" name="phone" placeholder="Phone*" required="required">
        </div>
        <div class="col-sm-12 input-field">
          <textarea name="message" placeholder="Message"></textarea>
        </div>
        <div class="col-sm-12 input-submit input-field">
          <input type="submit" name="submit" value="{{(isset($fields['cta_action'])) ? isset($fields['cta_action']) : 'SUMBIT'}}">
        </div>
      </div>
    </form>
  </div>
</section>