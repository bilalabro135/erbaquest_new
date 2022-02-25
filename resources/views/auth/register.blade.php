@extends('layouts.front.app')

@section('content')

    <x-front.page.featured-image title="SIGNUP" image="{{asset('images/inner-banner.jpg')}}"/>

    <div class="container">

        <div class="card o-hidden border-0 pb-100 pt-100">
            <div class="card-body p-0">
                <h3 class="ft-blanka ftw-bold_36 text-center mb-40">
                  SignUp
                </h3>
                <div class="sign_btns text-center mb-40">
                  <a href="javascript:;" class="btn-custom showEventSignup">Event Organizer</a>
                  <a href="javascript:;" class="btn-custom btn-custom-alter showvendorSignup">Vendor</a>
                </div>
                <!-- Nested Row within Card Body -->
                <div class="row form_area">
                    <div class="col-lg-12">
                        <div class="signupForm">
                            <form class="user" method="POST" action="{{ route('register.user') }}">
                                @csrf
                                <input type="hidden" name="role" value="event_orgranizer">
                                <div class="form-group row">
                                    <div class="input-field col-sm-6 mb-3 mb-sm-0">
                                        <label for="name">Name*</label>
                                        <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Name*">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col-sm-6">
                                        <label for="email">Email*</label>
                                        <input id="email" type="email" class="form-control  form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email Address*">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-field col-sm-6">
                                        <label for="phone">Phone</label>
                                        <input id="phone" type="text" class="form-control  form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" placeholder="Phone">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col-sm-6 mb-3 mb-sm-0">
                                        <label for="username">Username*</label>
                                        <input id="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus placeholder="Username*">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>                                    
                                </div>
                                <div class="row form-group">
                                    
                                    <div class="col-sm-12 mb-3 mb-sm-0 input-field">
                                        <label>Address</label>
                                        <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('username') }}" autocomplete="address" autofocus placeholder="Address">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-field col-sm-6 mb-3 mb-sm-0 input-field">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="input-field col-sm-6">
                                        <label for="password-confirm">Password Confirm</label>
                                        <input id="password-confirm" type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-field input-checkbox">
                                    <label class="checkmark">
                                        <input type="checkbox" name="terms_and_condition" value="1">I Agree With Terms & Conditon
                                    </label>
                                    @error('terms_and_condition')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-field input-submit">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <hr>

                            </form>
                            @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="small" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                            @endif
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<section class="secSponsor secSignup-vendor d-none">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4">
        <div class="pckg-box">
          <h3 class="ft-blanka">Non-420 sponsor</h3>
          <div class="price-info">
            <h2>
              <span class="symbol">$</span>
              <span class="txt">25</span>
              <span class="dt">a Month</span>
            </h2>
            <p>As a vendor you have zero intent on working with 420 products</p>
          </div>
          <ul class="pkg-list">
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Listed on app with vendor page
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Links listed for direct access to 
              third party platforms</li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              First shot at vending with affiliated 
              planners
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Monthly social media post/ story 
              (1 post, 1 story per month)
            </li>
          </ul>
        </div>
        <div class="btn_pckge">
          <button class="btn-custom" type="button">Select</button>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="pckg-box">
          <h3 class="ft-blanka">Non-420 sponsor</h3>
          <div class="price-info">
            <h2>
              <span class="symbol">$</span>
              <span class="txt">50</span>
              <span class="dt">a Month</span>
            </h2>
            <p>As a vendor you have zero intent on working with 420 products</p>
          </div>
          <ul class="pkg-list">
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Listed on app with vendor page
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Links listed for direct access to 
              third party platforms</li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              First shot at vending with affiliated 
              planners
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Monthly social media post/ story 
              (1 post, 1 story per month)
            </li>
          </ul>
        </div>
        <div class="btn_pckge">
        <button class="btn-custom" type="button">Select</button>
        </div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div class="pckg-box">
          <h3 class="ft-blanka">Non-420 sponsor</h3>
          <div class="price-info">
            <h2>
              <span class="symbol">$</span>
              <span class="txt">200</span>
              <span class="dt">a Month</span>
            </h2>
            <p>As a vendor you have zero intent on working with 420 products</p>
          </div>
          <ul class="pkg-list">
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Listed on app with vendor page
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Links listed for direct access to 
              third party platforms</li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              First shot at vending with affiliated 
              planners
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Monthly social media post/ story 
              (1 post, 1 story per month)
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Listed on app with vendor page
            </li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              Links listed for direct access to 
              third party platforms</li>
            <li>
              <span class="figure"><img src="images/pk-icon.png"></span>
              First shot at vending with affiliated 
              planners
            </li>
          </ul>
        </div>
        <div class="btn_pckge">
        <button class="btn-custom" type="button">Select</button>
        </div>
      </div>
      <div class="col-sm-12 text-center mt60">
        <button id="btn_next" class="btn-custom btn-custom-alter w-286" type="button">Next</button>
      </div>
    </div>
  </div>
</section>


<section class="secSignup pt-100 pb-100">
  <div class="container">
    <div class="signupForm createEventForm">
      <form class="form_sign" action="" method="post">
        <div class="row payment_div d-none">
          <div class="col-sm-12 col-md-6">
            <div class="input-field customDropdown">
              <label>Payment Method:</label>
              <select name="payment_method">
                <option selected="selected">Select a Payment Method</option>
                <option>Paypal</option>
                <option>Stripe</option>
                <option>UniPay</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Card Number:</label>
              <input type="text" name="card_number" placeholder="01234455667:">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field customDropdown">
              <label>Name Of Card:</label>
              <select name="card_name">
                <option selected="selected">Select:</option>
                <option>VISA</option>
                <option>Master</option>
              </select>
            </div>
            <div class="card-icon mt-20">
              <img src="images/cards.png">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Card Holder Name:</label>
              <input type="text" name="card_holder" placeholder="Card Holder Name:">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Security Code:</label>
              <input type="text" name="security_code" placeholder="xxxx">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field input-date">
              <label>DATE:</label>
              <input type="date" name="date">
            </div>
          </div>
          <div class="col-sm-12 text-center mt60">
            <button id="btn_next-1" class="btn-custom btn-custom-alter w-286" type="button">Next</button>
          </div>
        </div>
        <div class="row personal_div d-none mt60">
          <div class="col-sm-12">
            <h3 class="ft-blanka ftw-bold_36 text-center mb-40">
              Personal Information
            </h3>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Name:</label>
              <input type="text" name="name" placeholder="Name:" required="required">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Email:</label>
              <input type="email" name="email" placeholder="Email:" required="required">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Phone:</label>
              <input type="tel" name="phone" placeholder="Phone:" required="required">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Address:</label>
              <input type="text" name="address" placeholder="Address:" required="required">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Password:</label>
              <input type="password" name="password" placeholder="Password:" required="required">
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="input-field">
              <label>Confirm Password:</label>
              <input type="password" name="password1" placeholder="Confirm Password:" required="required">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="input-field input-submit">
              <input type="submit" name="submit" value="SUBMIT">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>


@endsection

@push ('scripts')

<script type="text/javascript">
    $(document).ready(function() {
       $('.input-field .checkmark input').on('change',function () {
        if($(this).is(':checked'))
            {
              $(this).parent('label').addClass('active');
            }else
            {
             $(this).parent('label').removeClass('active');
            }
           
       });

       $('#btn_next').on('click',function() {
        $('.payment_div').removeClass('d-none');
      });
      $('#btn_next-1').on('click',function() {
        $('.personal_div').removeClass('d-none');
      }); 


      $('.showvendorSignup').on('click',function(){
        $('.secSignup-vendor').removeClass('d-none');
        $('.form_area .signupForm').addClass('d-none');
        $('.card').removeClass('pb-100');
      });

      $('.showEventSignup').on('click',function(){
        $('.secSignup-vendor').addClass('d-none');
        $('.form_area .signupForm').removeClass('d-none');
        $('.card').addClass('pb-100');
      });

    });
</script>

@endpush