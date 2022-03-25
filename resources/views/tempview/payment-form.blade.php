@extends('layouts.front.app')

@section('content')
    
<script type="text/javascript"
    src="https://jstest.authorize.net/v1/Accept.js"
    charset="utf-8">
</script>
   <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          CONTACT US
        </h1>
      </div>
    </section>

<form id="paymentForm"
    method="POST"
    action="{{route('payment.store')}}" >
    @csrf
    <input type="name" name="name" placeholder="name"><br><br>
    <input type="username" name="username" placeholder="username"><br><br>
    <input type="email" name="email" placeholder="email"><br><br>
    <input type="text" name="cardNumber" id="cardNumber" placeholder="cardNumber"/> <br><br>
    <input type="text" name="expMonth" id="expMonth" placeholder="expMonth"/> <br><br>
    <input type="text" name="expYear" id="expYear" placeholder="expYear"/> <br><br>
    <input type="text" name="cardCode" id="cardCode" placeholder="cardCode"/> <br><br>
    <input type="hidden" name="dataValue" id="dataValue" value="dataValue" />
    <input type="hidden" name="dataDescriptor" id="dataDescriptor" value="dataDescriptor" />
    <button type="button" onclick="sendPaymentDataToAnet();">Pay</button>
</form>

<script type="text/javascript">

function sendPaymentDataToAnet() {
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
                var i = 0;
                while (i < response.messages.message.length) {
                    if(response.messages.message[i].code == "E_WC_05" ){
                        $(".cardNumber").text("Please provide valid credit card number.");
                    }else if(response.messages.message[i].code == "E_WC_07" ){
                        $(".expMonth").text("Please provide valid expiration year.");
                        
                    }else if(response.messages.message[i].code == "E_WC_06" ){
                        $(".expMonth").text("Please provide valid expiration year.");
                    }else{
                        console.log(
                            response.messages.message[i].code + ": " +
                            response.messages.message[i].text
                        );    
                    }
                    
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
    document.getElementById("dataDescriptor").value = opaqueData.dataDescriptor;
    document.getElementById("dataValue").value = opaqueData.dataValue;

    // If using your own form to collect the sensitive data from the customer,
    // blank out the fields before submitting them to your server.
    document.getElementById("cardNumber").value = "";
    document.getElementById("expMonth").value = "";
    document.getElementById("expYear").value = "";
    //document.getElementById("cardCode").value = "";

    document.getElementById("paymentForm").submit();
}
</script>
@endsection