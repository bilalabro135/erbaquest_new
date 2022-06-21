<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AssignRoles;
use App\Models\Settings;

use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Requests\Common\CardInfoRequest;
use App\Http\Requests\Common\ReviewRequest;

use App\Models\UserGatewayProfiles;
use App\Models\UserPaymentProfiles;
use App\Models\Reviews;
use App\Models\Subscription;
use App\Models\VendorProfile;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use DataTables;
use Redirect;
use Auth;
use Bouncer;
use Carbon\Carbon;
class UserController extends Controller
{
    public $payment_mode = '';

    public function __construct()
    {
        $this->payment_mode = env('AUTHORIZE_MODE');
    }

    public function index()
    {
        return view('admin.users.index');
    }
    public function getUsers(request $ajaxrequest){
        $onlyRoleId = ($ajaxrequest['role_id']) ? $ajaxrequest['role_id']  : '';
        $model = User::query()->select("users.id","users.name","users.email");

        if($onlyRoleId){
           $fullQuery =  $model->leftjoin("assigned_roles as ar","users.id","=","ar.entity_id")->where('ar.role_id', '=', $onlyRoleId);
        }else{
           $fullQuery = $model;
        }

        return DataTables::eloquent($fullQuery)
        ->addColumn('action', function($row){
                $user_id =  auth()->user()->id;
                $actionBtn= '';
                if(Bouncer::can('updateUsers')){
                $actionBtn .='<a href="'.route('users.edit', ['user' => $row->id]).'" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Bouncer::can('updateRoles') && $row->id != 1 && $user_id != $row->id) {
                    $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="'.route('users.delete', ['id' => $row->id]).'"><i class="fas fa-trash-alt"></i></a>';
                }

                return $actionBtn;
        })
        ->addColumn('role', function ($row){
            return $row->getRoles()[0];
        })
        ->rawColumns(['action'])

        ->toJson();
    }
    public function addUsers()
    {
        $roles = Bouncer::role()->all()->pluck('name');
        $Settings = Settings::get('registration');
        return view('admin.users.add', compact('roles', 'Settings'));
    }
    public function storeUser(UserRequest $request)
    {

        $userData= $request->getUserData();

        $user = new User;
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->address = $userData['address'];
        $user->phone = $userData['phone'];
        $user->username = $userData['username'];
        $user->email_verified_at = $userData['email_verified_at'];
        $user->profile_image = $userData['profile_image'];
        $user->featured = $userData['featured'];
        $user->save();
        if ($request->shouldSendVerificationEmail()) {
            $user->sendEmailVerificationNotification();
        }
        $user->assign($request->role);
        return Redirect::route('users')->with(['msg' => 'User added', 'msg_type' => 'success']);
    }
    public function editUsers(User $user)
    {
        $roles = Bouncer::role()->all()->pluck('name');
        $Settings = Settings::get('registration');

        $user_role = (isset($user->roles()->pluck('name')[0]) ? $user->roles()->pluck('name')[0] : 0);
        $VendorProfile = VendorProfile::where("user_id",$user['id'])->first();
        if($VendorProfile){
            $reviews = Reviews::where("rel_id",$VendorProfile['id'])->orderby("created_at","desc")->get();
            $sendReviews = array();
            foreach ($reviews as $review) {
                if($review['user_id']){
                   $getUsers = User::where("id",$review['user_id'])->first();
                   $sendReviews[] = array(
                        'id'    => $review['id'],
                        'profile_image' => $getUsers['profile_image'],
                        'name' => $getUsers['name'],
                        'comment' => $review['comment'],
                        'speed_rating' => $review['speed_rating'],
                        'quality_rating' => $review['quality_rating'],
                        'price_rating' => $review['price_rating'],
                        'date'         => $this->time_elapsed_string($review['created_at']),
                    );

                }else{
                    $sendReviews[] = array(
                        'id'    => $review['id'],
                        'profile_image' => $review['featured_image'],
                        'name' => $review['name'],
                        'comment' => $review['comment'],
                        'speed_rating' => $review['speed_rating'],
                        'quality_rating' => $review['quality_rating'],
                        'price_rating' => $review['price_rating'],
                        'date'         => $this->time_elapsed_string($review['created_at']),
                    );
                }
            }
        }else{
            $sendReviews = array();
        }

        return view('admin.users.edit', compact('user', 'roles', 'Settings','sendReviews','user_role'));
    }

    public function submitComment(ReviewRequest $request){

        $request = $request->getRequest();
        $update_revies = Reviews::where('id',$request['comment_id'])->update(['comment'=>$request['comment']]);
        if ( $update_revies ) {
           return response()->json(['msg' => 'Comment has been updated!', 'msg_type' => 'success']);
        }
    }

    public function deleteComment(ReviewRequest $request)
    {
        $delete_id =  $request->getRequest()['comment_id'];
        $comment = Reviews::where('id', $delete_id)->delete();
        if ( $comment ) {
            return response()->json(['msg' => 'Comment has been deleted!', 'msg_type' => 'success']);
        }

    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new Carbon;
        $ago = new Carbon($datetime);

        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
        public function updateUsers(UserUpdateRequest $request)
        {
            $userData= $request->getUserData();

            $user = new User;
            $user->exists = true;
            $user->id = $userData['id'];
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->address = $userData['address'];
            $user->phone = $userData['phone'];
            $user->username = $userData['username'];
            $user->profile_image = $userData['profile_image'];
            $user->featured = $userData['featured'];
            if($request->hasPassword()){
                $user->password = $userData['password'];
            }
            if ($request->shouldUpdateVerifiacation()) {
                $user->email_verified_at = $userData['email_verified_at'];
            }
            $user->save();
            if ($request->shouldSendVerificationEmail()) {
                $user->sendEmailVerificationNotification();
            }

            $currentRole= $user->getRoles();

            if(empty($currentRole[0])){
                $user->assign($request->role);
            }else{
                if($currentRole[0] != $request->role){
                    $user->retract($currentRole[0]);
                    $user->assign($request->role);
                }
            }

            return back()->with(['msg' => 'User Updated', 'msg_type' => 'success']);
    }
    public function deleteuser(Request $request)
    {
        if( $request->id != auth()->user()->id && $request->id != 1 ){
            $user = User::where('id', $request->id)->delete();
            if ($user) {
                return Redirect::back()->with(['msg' => 'User deleted', 'msg_type' => 'success']);
            }
        }
        else{
            abort(404);
        }
    }

    public function paymentOption()
    {

        $creditsData = array();
        $userData = Auth::user();
        $userRole = AssignRoles::where('entity_id', $userData['id'])->first();
        $users = new User;
        $users->role = $userRole['role_id'];

        $getProfileId = UserGatewayProfiles::where("user_id",$userData['id'])->first();

        if(isset($getProfileId['profile_id'])){
            //get Card Numbers
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN_ID'));
            $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));
              // Retrieve an existing customer profile along with all the associated payment profiles and shipping addresses

              $request = new AnetAPI\GetCustomerProfileRequest();
              $request->setMerchantAuthentication($merchantAuthentication);
              $request->setCustomerProfileId($getProfileId['profile_id']);
              $controller = new AnetController\GetCustomerProfileController($request);
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

                if($response->getSubscriptionIds() != null)
                {
                    $creditsCard = $response->getProfile()->getPaymentProfiles()[0]->getPayment()->getCreditCard()->getCardNumber();
                    $cardType = $response->getProfile()->getPaymentProfiles()[0]->getPayment()->getCreditCard()->getCardType();
                    $cardExpiryDate = $response->getProfile()->getPaymentProfiles()[0]->getPayment()->getCreditCard()->getExpirationDate();
                }
              }else
              {
                $errorMessages = $response->getMessages()->getMessage();
                $creditserror = "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
              }
        }

        $creditsData = array(
            'creditsCard' => (isset($creditsCard)) ? str_replace("X", "*", $creditsCard) : '',
            'cardType' => (isset($cardType)) ? $cardType  : '',
            'cardExpiryDate' => (isset($cardExpiryDate)) ? $cardExpiryDate  : '',
            'creditError' => (isset($creditserror)) ? $creditserror : '',
            'profile_id' => (isset($getProfileId['profile_id'])) ? $getProfileId['profile_id'] : '',
        );

        return view('tempview.payment-option',compact('users','creditsData'));

    }
    public function UpdatepaymentOption(CardInfoRequest $requestCardInfo)
    {


        $authorizeCardNumber = $this->authorizeCreditCard($requestCardInfo);

        if($authorizeCardNumber){
            $cardName = $requestCardInfo['cardName'];
            $lname = $requestCardInfo['lname'];

            $dataYear = date('Y');
            $firstTwoDigits = substr($dataYear, 0, 2);

            $expityYear = "";
            if(strlen($requestCardInfo['expYear']) == 2){
                $expityYear = $firstTwoDigits.$requestCardInfo['expYear'];
            }else{
                $expityYear = $requestCardInfo['expYear'];
            }


            $userData = Auth::user();
            $getUserPaymentProfiles = UserPaymentProfiles::where("user_id",$userData["id"])->first();

            $customerProfileId = $requestCardInfo['profile_id']; // "1916322670";
            $customerPaymentProfileId = $getUserPaymentProfiles['payment_profile_id'];

             /* Create a merchantAuthenticationType object with authentication details
           retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN_ID'));
                $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

            // Set the transaction's refId
            $refId = 'ref' . time();

            $request = new AnetAPI\GetCustomerPaymentProfileRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId( $refId);
            $request->setCustomerProfileId($customerProfileId);
            $request->setCustomerPaymentProfileId($customerPaymentProfileId);

            $controller = new AnetController\GetCustomerPaymentProfileController($request);
            if($this->payment_mode == 'sandbox')
            {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            else
            {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            }
            if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
            {
                $billto = new AnetAPI\CustomerAddressType();
                $billto = $response->getPaymentProfile()->getbillTo();

                $creditCard = new AnetAPI\CreditCardType();
                $creditCard->setCardNumber( str_replace(' ', '', $requestCardInfo['cardNumber']));
                $creditCard->setExpirationDate($expityYear."-".$requestCardInfo['expMonth']);

                $paymentCreditCard = new AnetAPI\PaymentType();
                $paymentCreditCard->setCreditCard($creditCard);
                $paymentprofile = new AnetAPI\CustomerPaymentProfileExType();
                $paymentprofile->setBillTo($billto);
                $paymentprofile->setCustomerPaymentProfileId($customerPaymentProfileId);
                $paymentprofile->setPayment($paymentCreditCard);

                // We're updating the billing address but everything has to be passed in an update
                // For card information you can pass exactly what comes back from an GetCustomerPaymentProfile
                // if you don't need to update that info

                // Update the Bill To info for new payment type
                $billto->setFirstName($cardName);
                $billto->setLastName($lname);
                // $billto->setAddress("9 New St.");
                // $billto->setCity("Brand New City");
                // $billto->setState("WA");
                // $billto->setZip("98004");
                // $billto->setPhoneNumber("000-000-0000");
                // $billto->setfaxNumber("999-999-9999");
                // $billto->setCountry("USA");

                // Update the Customer Payment Profile object
               $paymentprofile->setBillTo($billto);

                // Submit a UpdatePaymentProfileRequest
                $request = new AnetAPI\UpdateCustomerPaymentProfileRequest();
                $request->setMerchantAuthentication($merchantAuthentication);
                $request->setCustomerProfileId($customerProfileId);
                $request->setPaymentProfile( $paymentprofile );

                $controller = new AnetController\UpdateCustomerPaymentProfileController($request);
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
                    $message = "Credit Card Information Updated!";

                    return Redirect::route('payment.option')->with(['msg' => $message, 'msg_type' => 'success']);

                }else if ($response != null)
                {
                    $errorMessages = 'Somthing went wrong please try later.';
                   return Redirect::route('payment.option')->with(['msg' => $errorMessages, 'msg_type' => 'error']);
                }

                return $response;
            } else {
                //echo "Failed to Get Customer Payment Profile :  " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
                $errorMessages = 'Somthing went wrong please try later.';
                return Redirect::route('payment.option')->with(['msg' => $errorMessages, 'msg_type' => 'error']);
            }
        }else{
            $errorMessages = "Invalid Credit Card!";
            return Redirect::route('payment.option')->with(['msg' => $errorMessages, 'msg_type' => 'error']);
        }

    }

    function authorizeCreditCard($cardInfo,$amount = 2.00)
    {

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
        $order->setInvoiceNumber("10101");
        $order->setDescription("Golf Shirts");

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
        $customerData->setId("99999456654");
        $customerData->setEmail("test@example.com");

        // Add values for transaction settings
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        $merchantDefinedField1 = new AnetAPI\UserFieldType();
        $merchantDefinedField1->setName("customerLoyaltyNum");
        $merchantDefinedField1->setValue("1128836273");

        $merchantDefinedField2 = new AnetAPI\UserFieldType();
        $merchantDefinedField2->setName("favoriteColor");
        $merchantDefinedField2->setValue("blue");

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        $transactionRequestType->addToUserFields($merchantDefinedField1);
        $transactionRequestType->addToUserFields($merchantDefinedField2);

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

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    $responseFromApi = 1;
                } else {
                    if ($tresponse->getErrors() != null) {
                        $responseFromApi = 1;
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                   $responseFromApi = 0;
                } else {
                    $responseFromApi = 0;
                }
            }
        } else {
            echo  $responseFromApi = 0;
        }

        return $responseFromApi;
    }

    function paymentList()
    {
        $userData = Auth::user();
        $userRole = AssignRoles::where('entity_id', $userData['id'])->first();
        $users = new User;
        $users->role = $userRole['role_id'];

        $getcurrentUser = Auth::user();

        $customerProfileId = UserGatewayProfiles::where("user_id",$getcurrentUser['id'])->first();
        /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();

        $request = new AnetAPI\GetTransactionListForCustomerRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setCustomerProfileId($customerProfileId['profile_id']);

        //https://github.com/AuthorizeNet/sdk-php/issues/417
        $controller = new AnetController\GetTransactionListForCustomerController($request);

        if($this->payment_mode == 'sandbox')
        {
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        }
        else
        {
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
        {
            if(null != $response->getTransactions())
            {
                $getresponse = $response->getTransactions();
                $transactionDatas = array();

                foreach ($getresponse as $transactionData) {
                    $transactionDatas[] = array(
                        'id' => $transactionData->getTransId(),
                        'status' => $transactionData->getTransactionStatus(),
                        'amount' => $transactionData->getSettleAmount(),
                    );
                }
            }
            else{
                $transactionDatas = 0;
            }
         }
        else
        {
            // echo "ERROR :  Invalid response\n";
            // $errorMessages = $response->getMessages()->getMessage();
            // echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        }

        if(!isset($transactionDatas)){
            $transactionDatas = array();
        }


        return view('tempview.payment',compact('transactionDatas','users'));

      }

      public function getPayment(){
        return view('admin.payment.index');
    }

    public function getPaymentList()
    {
        $model = Subscription::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
                $user_id =  auth()->user()->id;

                $actionBtn= '';
                if(Bouncer::can('updateUsers')){
                $actionBtn .='<a href="'.route('admin.payemnt.view', ['order' => $row->id]).'" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-eye"></i></a>';
                }
                return $actionBtn;
        })
        ->rawColumns(['action'])

        ->toJson();
    }
    public function paymentView($getUserId)
    {
        $customerProfileId = UserGatewayProfiles::where("user_id",$getUserId)->first();
        /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();

        $request = new AnetAPI\GetTransactionListForCustomerRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setCustomerProfileId($customerProfileId['profile_id']);

        //https://github.com/AuthorizeNet/sdk-php/issues/417
        $controller = new AnetController\GetTransactionListForCustomerController($request);

        if($this->payment_mode == 'sandbox')
        {
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        }
        else
        {
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
        {
            if(null != $response->getTransactions())
            {
                $getresponse = $response->getTransactions();
                $transactionDatas = array();

                foreach ($getresponse as $transactionData) {
                    $transactionDatas[] = array(
                        'id' => $transactionData->getTransId(),
                        'status' => $transactionData->getTransactionStatus(),
                        'amount' => $transactionData->getSettleAmount(),
                    );
                }
            }
            else{
                $transactionDatas = 0;
            }
         }
        else
        {
            // echo "ERROR :  Invalid response\n";
            // $errorMessages = $response->getMessages()->getMessage();
            // echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
        }

        if(!isset($transactionDatas)){
            $transactionDatas = array();
        }

        //dd($transactionDatas);

        return view('admin.payment.view',compact('transactionDatas'));

    }

}
