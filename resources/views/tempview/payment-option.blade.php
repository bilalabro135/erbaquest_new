@extends('layouts.front.app')
@section('content')

<script type="text/javascript"
        src="https://jstest.authorize.net/v1/Accept.js"
        charset="utf-8">
    </script>

	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          ACCOUNT
        </h1>
      </div>
    </section>

    <section class="secAccount pt-100 pb-100">
      <div class="container">
        <div class="row">
          @include( 'tempview/sidebar' )
          <div class="col-sm-12 col-md-8">
            <div class="account_editForm">
              @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              @if(session('msg'))
              <div class="alert alert-{{session('msg_type')}}">
                  {{session('msg')}}                                            
              </div>
              @endif
              <div class="card_main">
                <div class="card_info">
                    <div class="card_box"><img src="{{ asset('') }}images/{{ $creditsData['cardType']}}.png"/> {{ $creditsData['cardType'] }} {{ $creditsData['creditsCard'] }} </div>
                </div>
                <div class="card_option">
                    <a href="javascript:void(0);"> Edit </a>
                </div>
                <div style="clear: both;"></div>
              </div>
                <div class="main_payment_form">
                  <form class="form_sign paymentVendorEdit" action="{{route('payment.update')}}" method="post" id="payment-form">
                    @csrf
                      <input type="hidden" name="profile_id" value="{{$creditsData['profile_id'] }}">
                     <!-- credit card info start -->
                        <div class="input-field col-sm-6">
                            <label for="cardName">Name ON CARD</label>
                            <input type="text" name="cardName" id="cardName" placeholder="First Name" required="required">
                            <p class="error cardName"></p>
                        </div>
                        <div class="input-field col-sm-6">
                            <label for="lname"><br></label>
                            <input type="text" name="lname" id="lname" placeholder="Last Name" required="required">
                            <p class="error lname"></p>
                        </div>
                        <div class="input-field col-sm-6">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" name="cardNumber" id="cardNumber" placeholder="Card Number">
                            <p class="error cardNumber"></p>
                        </div>
                        <div class="input-field col-sm-6">
                            <label for="expMonth">Expiry Month</label>
                            <input type="text" name="expMonth" id="expMonth" placeholder="Expiry Month">
                            <p class="error expMonth"></p>
                        </div>
                        <div class="input-field col-sm-6">
                            <label for="expYear">Expiry Year</label>
                            <input type="text" name="expYear" id="expYear" placeholder="Expiry Year">
                            <p class="error expYear"></p>
                        </div>
                        <div class="input-field col-sm-6">
                            <label for="cardCode">Card Code</label>
                            <input type="text" name="cardCode" id="cardCode" placeholder="Card Code">
                            <p class="error cardCode"></p>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="col-sm-12">
                            <div class="input-field input-submit">
                                <input type="submit" value="SUBMIT">
                            </div>
                        </div>
                        <!-- credit card info end -->
                  </form>
                </div>
            </div>
          </div>
        </div>
        </div>
    </section>

    <style type="text/css">
      .paymentVendorEdit .input-field{
        float: left;
        width: 47%;
        margin-left: 10px;
        margin-right: 10px;
      }
      label.error{
        position: absolute;
        color: #f52d2d;
        font-size: 14px;
        margin-top: 10px;
      }
      .card_main{
            border: 1px #d1cdcd solid;
        border-radius: 5px;
        padding: 10px;
      }
      .card_info{
        float: left;
      }
      .card_option{
        float: right;
            margin-top: 12px;
      }
      .card_option a{
           color: #2c9044; 
      }
      .main_payment_form{
       display: none;
      }
    </style>
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
          document.getElementById("payment-form").submit();
      }

      // Register vendor
      $(function(){
        $(".paymentVendorEdit").validate({
          rules: {
            cardNumber: "required",
            expMonth: "required",
            expYear: "required",
            cardCode: "required",
          },
          messages: {
            cardNumber: "The Card Number field is required.",
            expMonth: "The Expiry Month is required.",
            expYear: "The Expiry Year is required.",
            cardCode: "The Card code is required.",
          },
          submitHandler: function(form) {
              sendPaymentDataToAnet();
          }
        });
      });

      $(document).ready(function() {
        $(".card_option").click(function() {
          $(".main_payment_form").show();
        });
      });

    </script>

@endsection

@push('scripts')

@endpush