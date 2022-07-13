@extends('layouts.front.app')

@section('content')

    <x-front.page.featured-image title="SIGNUP" image="{{asset('images/inner-banner.jpg')}}"/>

    <div class="container">

        <div class="card o-hidden border-0 pb-100 pt-100">
            <div class="card-body p-0">
                <!-- <h3 class="ft-blanka ftw-bold_36 text-center mb-40">
                  SignUp
                </h3> -->
                <div class="sign_btns text-center mb-40">
                  <a href="javascript:;" class="btn-custom active_style showEventSignup">Become a Goonie</a>
                  @if(count($packages))
                  <a href="{{ route('vendor.register') }}" class="btn-custom showvendorSignup">Verified Brands</a>
                  @endif
                </div>
                <p class="goonieText">The Goonie account is a free user account. With this account you will be able to create events, and leave reviews without a monthly subscription. </p>
                <!-- Orgnanizer Form -->
                <div class="row form_area">
                    <div class="col-lg-12">
                        <div class="signupForm">
                            <form class="user register_form_valid" method="POST" action="{{ route('register.user') }}">
                                @csrf
                                <input type="hidden" name="role" value="Organizer">
                                <div class="form-group row">
                                    <div class="input-field col-sm-6 mb-3 mb-sm-0">
                                        <label for="name">Name*</label>
                                        <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Name*" required="required">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col-sm-6">
                                        <label for="email">Email*</label>
                                        <input id="email" type="email" class="form-control  form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email Address*" required="required">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="input-field col-sm-6">
                                        <label for="phone">Phone*</label>
                                        <input id="phone" type="text" class="phone_mask form-control  form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" placeholder="Phone*" required="required">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-field col-sm-6 mb-3 mb-sm-0">
                                        <label for="username">Username*</label>
                                        <input id="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus placeholder="Username*" required="required">
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
                                        <label for="password">Password*</label>
                                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password*" required="required">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="input-field col-sm-6">
                                        <label for="password-confirm">Password Confirm*</label>
                                        <input id="password-confirm" type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm Password*">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-field input-checkbox">
                                    <label class="checkmark active">
                                        <input type="checkbox" name="terms_and_condition" value="1" checked="checked"><a target="_blank" href="terms-and-condition" required="required"> I Agree With Terms & Conditon</a>
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
@endsection

@push ('scripts')
<!-- <script src="https://js.stripe.com/v3/"></script> -->

<script>
    $(document).ready(function(){
        $('.phone_mask').mask('(999)-999-9999');
    });
    // Create a Stripe client.
// var stripe = Stripe('{{ env("STRIPE_KEY") }}');

// // Create an instance of Elements.
// var elements = stripe.elements();

// // Custom styling can be passed to options when creating an Element.
// // (Note that this demo uses a wider set of styles than the guide below.)
// var style = {
//   base: {
//     color: '#32325d',
//     lineHeight: '18px',
//     fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
//     fontSmoothing: 'antialiased',
//     fontSize: '16px',
//     '::placeholder': {
//       color: '#aab7c4'
//     }
//   },
//   invalid: {
//     color: '#fa755a',
//     iconColor: '#fa755a'
//   }
// };

// // Create an instance of the card Element.
// var card = elements.create('card', {style: style});

// // Add an instance of the card Element into the `card-element` <div>.
// card.mount('#card-element');

// // Handle real-time validation errors from the card Element.
// card.addEventListener('change', function(event) {
//   var displayError = document.getElementById('card-errors');
//   if (event.error) {
//     displayError.textContent = event.error.message;
//     $('#card-errors').fadeIn();
//   } else {
//     displayError.textContent = '';
//     $('#card-errors').fadeOut();
//   }
// });

// // Handle form submission.
// var form = document.getElementById('payment-form');
// form.addEventListener('submit', function(event) {
//   event.preventDefault();

//   stripe.createToken(card).then(function(result) {
//     if (result.error) {
//       // Inform the user if there was an error.
//       var errorElement = document.getElementById('card-errors');
//       errorElement.textContent = result.error.message;
//     $('#card-errors').fadeIn();
//     } else {
//       // Send the token to your server.
//       stripeTokenHandler(result.token);
//     $('#card-errors').fadeOut();
//     }
//   });
// });

// // Submit the form with the token ID.
// function stripeTokenHandler(token) {
//   // Insert the token ID into the form so it gets submitted to the server
//   var form = document.getElementById('payment-form');
//   var hiddenInput = document.createElement('input');
//   hiddenInput.setAttribute('type', 'hidden');
//   hiddenInput.setAttribute('name', 'stripeToken');
//   hiddenInput.setAttribute('value', token.id);
//   form.appendChild(hiddenInput);


//   form.submit();
// }
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

      //  $('#btn_next').on('click',function() {
      //   if ($('#plan').val() != '') {
      //     $('.payment_div').removeClass('d-none');
      //     $('.secSignup').removeClass('d-none');
      //     $('.secSponsor').removeClass('pb-100');
      //   }
      //   else{
      //     alert('Please Select A Package To Continue');
      //   }
      // });



      $('.showvendorSignup').on('click',function(){
        $('.secSignup-vendor').removeClass('d-none');
        $('.form_area .signupForm').addClass('d-none');
        $('.card').removeClass('pb-100');
      });

      $('.showEventSignup').on('click',function(){
        $(this).addClass('active_style');
        $('.secSignup-vendor').addClass('d-none');
        $('.secSignup').addClass('d-none');
        $('.personal_div').addClass('d-none');
        $('.form_area .signupForm').removeClass('d-none');
        $('.secSponsor').addClass('pb-100');
        $('.card').addClass('pb-100');
      });

        $('.sign_btns .btn-custom').on('click',function(){
            $(this).removeClass('active_style');
            $(this).addClass('active_style');
        });

        $('.sign_btns .btn-custom').on('click', function(){
            $('.sign_btns .btn-custom.active_style').removeClass('active_style');
            $(this).addClass('active_style');
        });

      $('.select-plan').click(function(){
        // $('.secSponsor').addClass('d-none');
        $('#plan').val($(this).data('plan'));
        $('.personal_div').removeClass('d-none');
      })

    });
</script>

@endpush
