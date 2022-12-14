<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

use App\Models\User;
use App\Models\Settings;
use App\Http\Requests\Auth\SubscriptionRequest;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\UserPaymentProfiles;
use App\Models\UserGatewayProfiles;

use Redirect;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public $payment_mode = '';

    public function __construct()
    {
        $this->payment_mode = env('AUTHORIZE_MODE');
    }

    public function create(SubscriptionRequest $request)
    {
        $handle_errors = array(
            252
        );

        $authorizeCardNumber = $this->authorizeCreditCard($request);

        if($authorizeCardNumber['success'] && !in_array( $authorizeCardNumber['code'], $handle_errors )){
            $package = Package::where('id', $request->plan)->first();

            $transaction_id             = $authorizeCardNumber['transaction_id'] ?? '';
            $network_transaction_id     = $authorizeCardNumber['network_transaction_id'] ?? '';

            if (empty($package)) {
                abort(404);
            }
            $dataYear = date('Y');
            $firstTwoDigits = substr($dataYear, 0, 2);

            $expityYear = "";
            if(strlen($request->expYear) == 2){
                $expityYear = $firstTwoDigits.$request->expYear;
            }else{
                $expityYear = $request->expYear;
            }

           $creditName = explode(" ",$request->name);
           $amount= $package['price'];
           $unit = 'months';//strtolower($package['reccuring_every'])."s";
           $intervalLength =  1;
           $totalcycles = 9999;//$package['duration'];
           $start_date = Carbon::now()->addMonths(1);
           $card_number = str_replace(' ', '', $request->cardNumber);
           $expiry_date = $expityYear."-".$request->expMonth;
           $first_name = $request['cardname'];
           $last_name = $request['lname'];

            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

            // Set the transaction's refId
            $refId = 'ref' . time();
            // Subscription Type Info
            $subscription = new AnetAPI\ARBSubscriptionType();
            $subscription->setName($package['name']);
            $interval = new AnetAPI\PaymentScheduleType\IntervalAType();
            $interval->setLength($intervalLength);
            $interval->setUnit($unit);
            $paymentSchedule = new AnetAPI\PaymentScheduleType();
            $paymentSchedule->setInterval($interval);
            $paymentSchedule->setStartDate($start_date);
            $paymentSchedule->setTotalOccurrences($totalcycles);
            //$paymentSchedule->setTrialOccurrences("1");
            $subscription->setPaymentSchedule($paymentSchedule);
            $subscription->setAmount($amount);
            //$subscription->setTrialAmount("0.00");

            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($card_number);
            $creditCard->setExpirationDate($expiry_date);
            $payment = new AnetAPI\PaymentType();
            $payment->setCreditCard($creditCard);
            $subscription->setPayment($payment);
            $order = new AnetAPI\OrderType();
            $order->setInvoiceNumber(mt_rand(10000, 99999));   //generate random invoice number
            $order->setDescription($package['name']);
            $subscription->setOrder($order);

            $billTo = new AnetAPI\NameAndAddressType();
            $billTo->setFirstName($first_name);
            $billTo->setLastName($last_name);
            $subscription->setBillTo($billTo);
            $requestsub = new AnetAPI\ARBCreateSubscriptionRequest();
            $requestsub->setmerchantAuthentication($merchantAuthentication);
            $requestsub->setRefId($refId);
            $requestsub->setSubscription($subscription);
            $controller = new AnetController\ARBCreateSubscriptionController($requestsub);
            if($this->payment_mode == 'sandbox')
            {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            else
            {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            }

            if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
            {
              $Settings = Settings::get('registration');

               $getCustomerProfileId = $response->getProfile()->getCustomerProfileId();
               $getCustomerPaymentProfileId = $response->getProfile()->getCustomerPaymentProfileId();

               $userData = $request->getUserData();
                $user = new User;
                $user->name = $userData['name'];
                $user->email = $userData['email'];
                $user->username = $userData['username'];
                $user->address = $userData['address'];
                $user->password = $userData['password'];
                $user->phone = $userData['phone'];

                if(!isset($Settings['email_verification_on_reg']) || $Settings['email_verification_on_reg'] != 1){
                    $user->email_verified_at = date("Y-m-d H:i:s ");
                    $user->save();
                    $user->assign($userData['role']);
                    Auth::loginUsingId($user->id);
                }
                else{
                    $user->save();
                    $user->assign($userData['role']);
                    Auth::loginUsingId($user->id);
                    $user->sendEmailVerificationNotification();
                }

                $sub = new Subscription();
                $sub->user_id = $user->id;
                $sub->name = $user->name;
                $sub->subscription_name = $package['name'];
                $sub->price = $package['price'];
                $sub->stripe_id = $response->getSubscriptionId();
                $sub->save();

               $profileId = new UserGatewayProfiles();
               $profileId->user_id = $user->id;
               $profileId->profile_id = $getCustomerProfileId;
               $profileId->save();

               $profilePaymentId                            = new UserPaymentProfiles();
               $profilePaymentId->user_id                   = $user->id;
               $profilePaymentId->transaction_id            = $transaction_id;
               $profilePaymentId->network_transaction_id    = $network_transaction_id ;
               $profilePaymentId->subscription_id           = $response->getSubscriptionId();
               $profilePaymentId->payment_profile_id        = $getCustomerPaymentProfileId;
               $profilePaymentId->save();
               return Redirect::route('payment.option')->with(['msg' => 'Thanks for registration', 'msg_type' => 'success']);

            }else{

                $error_message = 'Something went wrong, Try Again!';

                if($response->getMessages()->getResultCode() == "Error" && isset( $response->getMessages()->getMessage()[0] ))
                {
                    $error_message = $response->getMessages()->getMessage()[0]->getText();
                }

                return Redirect::route('vendor.register')->with(['msg' => $error_message, 'msg_type' => 'error']);
            }
        }else{
           return Redirect::route('vendor.register')->with(['msg' => $authorizeCardNumber['message'], 'msg_type' => 'error']);
        }

    }


    function authorizeCreditCard($cardInfo)
    {
        $get_package                    = Package::find($cardInfo->plan);
        $amount                         = $get_package->price;
        $responseFromApi['success']     = FALSE;

        $cardName = $cardInfo['cardName'];
        $lname = $cardInfo['lname'];

        $dataYear = date('Y');
        $firstTwoDigits = substr($dataYear, 0, 2);

        $expityYear = "";
        if(strlen($cardInfo['expYear']) == 2){
            $expityYear = $firstTwoDigits.$cardInfo['expYear'];
        }else{
            $expityYear = $cardInfo['expYear'];
        }

        /* Create a merchantAuthenticationType object with authentication details
           retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber(str_replace(' ', '', $cardInfo['cardNumber']));
        $creditCard->setExpirationDate($expityYear."-".$cardInfo['expMonth']);
        $creditCard->setCardCode($cardInfo['cardCode']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber(time());
        $order->setDescription($get_package->name);

        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($cardName);
        $customerAddress->setLastName($lname);
        // $customerAddress->setCompany("Souveniropolis");
        // $customerAddress->setAddress("14 Main Street");
        // $customerAddress->setCity("Pecan Springs");
        // $customerAddress->setState("TX");
        // $customerAddress->setZip("44628");
        // $customerAddress->setCountry("USA");

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId(time());
        $customerData->setEmail($cardInfo->email);

        // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        /*
        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        $merchantDefinedField1 = new AnetAPI\UserFieldType();
        $merchantDefinedField1->setName("customerLoyaltyNum");
        $merchantDefinedField1->setValue("1128836273");

        $merchantDefinedField2 = new AnetAPI\UserFieldType();
        $merchantDefinedField2->setName("favoriteColor");
        $merchantDefinedField2->setValue("blue");
        */

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        //$transactionRequestType->addToUserFields($merchantDefinedField1);
        //$transactionRequestType->addToUserFields($merchantDefinedField2);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        if($this->payment_mode == 'sandbox')
        {
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        }
        else
        {
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }

        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                $transaction_id         = $tresponse->getTransId() ?? '';
                $network_transaction_id = $tresponse->getNetworkTransId() ?? '';

                if ( $tresponse->getErrors() )
                {
                    $responseFromApi['success'] = FALSE;
                    $responseFromApi['code']    = $tresponse->getErrors()[0]->getErrorCode();
                    $responseFromApi['message'] = $tresponse->getErrors()[0]->getErrorText();
                    $responseFromApi['response']= $tresponse->getErrors();
                }

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $responseFromApi['success']                 = TRUE;
                    $responseFromApi['code']                    = $tresponse->getMessages()[0]->getCode();
                    $responseFromApi['message']                 = $tresponse->getMessages()[0]->getDescription();
                    $responseFromApi['response']                = $tresponse->getMessages();
                    $responseFromApi['transaction_id']          = $transaction_id;
                    $responseFromApi['network_transaction_id']  = $network_transaction_id;
                }

                // Or, print errors if the API request wasn't successful
            } else {
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $responseFromApi['success'] = FALSE;
                    $responseFromApi['code']    = $tresponse->getErrors()[0]->getErrorCode();
                    $responseFromApi['message'] = $tresponse->getErrors()[0]->getErrorText();
                    $responseFromApi['response']= $tresponse->getErrors();
                } else {
                    $responseFromApi['success']     = FALSE;
                    $responseFromApi['code']        = 2;
                    $responseFromApi['message']     = 'Something went wrong!';
                    $responseFromApi['response']    = (object) array('code'=>$responseFromApi['code'],'message'=>$responseFromApi['message']);
                }
            }
        } else {
            $responseFromApi['success']     = FALSE;
            $responseFromApi['code']        = 3;
            $responseFromApi['message']     = 'Something went wrong!';
            $responseFromApi['response']    = (object) array('code'=>$responseFromApi['code'],'message'=>$responseFromApi['message']);
        }

        return $responseFromApi;
    }
}
