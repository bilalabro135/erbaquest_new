@extends('layouts.front.app')
@section('content')

    <script type="text/javascript"
        src="https://jstest.authorize.net/v1/Accept.js"
        charset="utf-8">
    </script>

    <x-front.page.featured-image title="VENDOR SIGNUP" image="{{asset('images/inner-banner.jpg')}}"/>

    <div class="card o-hidden border-0 pb-100 pt-100">
        <div class="card-body p-0">
            <div class="sign_btns text-center mb-40">
              <a href="{{ route('register') }}" class="btn-custom showEventSignup">Event Organizer</a>
              @if(count($packages))
              <a href="{{ route('vendor.register') }}" class="btn-custom active_style showvendorSignup">Vendor</a>
              @endif
            </div>
        </div>
    </div>

    <!-- Vendor Packages -->
    <section class="secSponsor secSignup-vendor">
        <div class="container">
            @if(session('msg'))
                <div class="alert alert-{{session('msg_type')}}">
                    {{session('msg')}}                                            
                </div>
            @endif
            <br>
            <div class="row">
                @foreach($packages as $package)
                <div class="col-sm-12 col-md-4">
                    <div class="pckg-box">
                  <h3 class="ft-blanka">{{$package->name}}</h3>
                  <div class="price-info">
                    <h2>
                      <span class="symbol">$</span>
                      <span class="txt">{{$package->price}}</span>
                      <span class="dt">{{($package->duration > 1) ? $package->duration : 'a'}} {{$package->reccuring_every}}{{($package->duration > 1) ? 's' : ''}}</span>
                    </h2>
                    <p>{{$package->short_description}}</p>
                  </div>
                  {!!$package->description!!}
                    </div>
                    <div class="btn_pckge">
                        <a href="#packages" class="btn-custom select-plan @if(old('plan') == $package->id) package-selected @endif" type="button" data-plan="{{$package->id}}">Select</a>
                    </div>
                </div>
                @endforeach
                <div class="col-sm-12 col-md-8">
                    <div class="sponsorBecome">
                        <h3 class="ft-blanka ftw-bold_36">BECOME A SPONSOR</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        <button class="btn-custom" type="button" data-bs-toggle="modal" data-bs-target="#sponsorForm">CLICK HERE</button>

                            <!-- Modal -->
                        <div class="modal fade" id="sponsorForm" tabindex="-1" aria-labelledby="sponsorFormLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="popup_close">
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="signupForm">
                                            <form class="form_contact" action="" method="post">
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
                                                    <div class="col-sm-12 col-md-6">
                                                        <div class="input-field">
                                                            <label>Email Address:</label>
                                                            <input type="email" name="email" placeholder="Email Address:" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Vendor Form -->
    <section class="secSignup pt-100 pb-100" id="packages">
        <div class="container">
            <div class="signupForm createEventForm">
              <form class="form_sign vendor_form_signUp" action="{{route('subscription.create')}}" method="post" id="payment-form">
                @csrf
                    <input type="hidden" name="plan" value="{{old('plan')}}" id="plan">
                    <input type="hidden" name="role" value="Vendor">
                    <div class="row personal_div @if(!old('plan') ) d-none @endif  mt60">
                        <div class="col-sm-12">
                            <h3 class="ft-blanka ftw-bold_36 text-center mb-40">Personal Information</h3>
                        </div>
                        <div id="card-errors" class="alert alert-danger" style="display: none;"></div>
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
                                <input id="address" type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus placeholder="Address">
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
                        <div class="form_seprator"></div>
                        <div class="credit_main_set form-group row">
                            <div class="input-field col-sm-6">
                                <label for="cardNumber">Name On Card</label>
                                <input type="text" name="cardname" id="cardName" placeholder="First Name" required="required" />
                                <p class="error cardNumber"></p>
                            </div>
                            <div class="input-field col-sm-6">
                                <label for="cardNumber"><br></label>
                                <input type="text" name="lname" id="lname" placeholder="Last Name" required="required" />
                                <p class="error cardNumber"></p>
                            </div>
                            <div class="input-field col-sm-6">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" name="cardNumber" id="cardNumber" placeholder="cardNumber" />
                                <p class="error cardNumber"></p>
                            </div>
                            <div class="input-field col-sm-6">
                                <label for="expMonth">Expiry Month</label>
                                <input type="text" name="expMonth" id="expMonth" placeholder="expMonth" />
                                <input type="text" name="expYear" id="expYear" placeholder="expYear"/>
                                <div style="clear: both;"></div>
                                <p class="error expMonth"></p>
                            </div>
                            <div class="input-field col-sm-6">
                                <label for="cardCode">Card Code</label>
                                <input type="text" name="cardCode" id="cardCode" placeholder="cardCode"/>
                                <p class="error cardCode"></p>
                            </div>
                            <!-- credit card info end -->
                        </div>

                        <div class="input-field input-checkbox active">
                            <label class="checkmark active">
                                <input type="checkbox" name="terms_and_condition" value="1" checked="checked">I Agree With Terms & Conditon
                            </label>
                            @error('terms_and_condition')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <div class="input-field input-submit">
                                <input type="submit" value="SUBMIT" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push ('scripts')
<!-- <script src="https://js.stripe.com/v3/"></script> -->
<style type="text/css">
    .secSponsor .alert-error{
        background: #f34949;
        color: #ffff;
        font-size: 20px;
    }

    #expMonth{
        width: 48%;
        float: left;
        margin-right: 10px;
    }
    #expYear{
        width: 48%;
        float: left;
    }
    .credit_main_set{
        margin-bottom: 0px;
        margin-top: 0px;
        width: 50%;
    }
    .credit_main_set input{
        height: 53px;
    }
    .signupForm .credit_main_set .input-field{
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .signupForm .credit_main_set .input-field label{
        margin-bottom: 5px;
            font-size: 15px;
    }    .credit_main_set{

    }
</style>
<script>
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
        $('.select-plan').removeClass('package-selected');
        $(this).addClass('package-selected');
        $('#plan').val($(this).data('plan'));
        $('.personal_div').removeClass('d-none');
      })

    });
</script>

<script type="text/javascript">

function sendPaymentDataToAnet(argument) {
    $("p.error").hide();
    var authData = {};
        authData.clientKey = "8Gh66WPEx6g99ErzyJgr8YEnPV37g8tS88TJQsw4vH3W4vp5dk7MrUQ6r8b2WqhG";
        authData.apiLoginID = "2KD4hR4Qbfh";

    var cardData = {};
        cardData.cardNumber = document.getElementById("cardNumber").value;
        cardData.month = document.getElementById("expMonth").value;
        cardData.year = document.getElementById("expYear").value;
        cardData.cardCode = document.getElementById("cardCode").value;

    var secureData = {};
        secureData.authData = authData;
        secureData.cardData = cardData;
    //    console.log(secureData);
    Accept.dispatchData(secureData, responseHandler);

    function responseHandler(response) {
        try{
            if (response.messages.resultCode === "Error") {
                $("p.error").show();
                var i = 0;
                while (i < response.messages.message.length) {

                    if(response.messages.message[i].code == "E_WC_05" ){
                        $(".cardNumber").text("Please provide valid credit card number.");
                    }
                    if(response.messages.message[i].code == "E_WC_06" ){
                        $(".expMonth").text("Please provide valid expiration month.");
                        
                    }
                    if(response.messages.message[i].code == "E_WC_07" ){
                        $(".expYear").text("Please provide valid expiration year.");
                    }

                    if(response.messages.message[i].code == "E_WC_15" ){
                        $(".cardCode").text("Please provide valid CVV.");
                    }
                    if(response.messages.message[i].code == "E_WC_20" ){
                        $(".cardNumber").text("Invalid Credit Card.");
                    }
                    
                        console.log(
                            response.messages.message[i].code + ": " +
                            response.messages.message[i].text
                        );    


                    i = i + 1;
                }
            } else {
                paymentFormUpdate(response.opaqueData);
            }
        } catch(error){
            console.log(error);
        }
    }
}

function paymentFormUpdate(opaqueData) {

    // If using your own form to collect the sensitive data from the customer,
    // blank out the fields before submitting them to your server.
    // document.getElementById("cardNumber").value = "";
    // document.getElementById("expMonth").value = "";
    // document.getElementById("expYear").value = "";
    //document.getElementById("cardCode").value = "";

    document.getElementById("payment-form").submit();
}

// Register vendor
$(function(){
  $(".vendor_form_signUp").validate({
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      phone: {
        required: true,
        phoneUS: true
      },
      username: "required",
      password_confirmation : {
        minlength : 6,
        equalTo : "#password"
      },
      cardNumber: "required",
      expMonth: "required",
      expYear: "required",
      cardCode: "required",
      terms_and_condition: "required",
    },
    messages: {
      name: "The name field is required.",
      email: {
        required:"The email field is required.",
        email:"Please enter correct email.",
      },
      phone:{
        required : "The phone field is required.",
        phoneUS : "Us Based Number is required.",
      },
      username: "The username field is required.",
      password: "The password field is required.",
      password_confirmation: {
        required:"The password field is required.",
        equalTo:"Please enter the same value again.",
      },
      cardNumber: "The Card Number field is required.",
      expMonth: "The Expiry Month is required.",
      expYear: "The Expiry Year is required.",
      cardCode: "The Card code is required.",
      terms_and_condition: "The term and condition is required."
    },
    submitHandler: function(form) {
        sendPaymentDataToAnet();
    }
  });
});

$(document).ready(function(){  
        $('#phone').mask('(999)-999-9999'); 
    }); 
</script>
<style type="text/css">
    .form_seprator{
        border: 1px #eaeaea solid;
        width: 96%;
        padding: 0px;
        margin: 0px auto;
        margin-top: 25px;
        margin-bottom: 25px;
    }
</style>


@endpush