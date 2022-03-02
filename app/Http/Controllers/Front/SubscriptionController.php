<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Settings;
use App\Http\Requests\Auth\SubscriptionRequest;
use App\Models\Package;
use App\Models\Subscription;
use Stripe;
class SubscriptionController extends Controller
{
   public function create(SubscriptionRequest $request)
    {
        $package = Package::where('id', $request->plan)->first();
        if (empty($package)) {
            abort(404);
        }

        $Settings = Settings::get('registration');

        $userData= $request->getUserData();

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $customer = array();
        try{
            $customer = $stripe->customers->create(
                [
                  'name' => $userData['name'],
                  'email' => $userData['email'],
                  'source'  => $request->stripeToken
                ]
            );
            // dd($customer);
        }
        catch(Exception $e) {   
            $api_error = $e->getMessage();              
        } 

        if (!isset($api_error)) {

            $user = new User;
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->username = $userData['username'];
            $user->address = $userData['address'];
            $user->password = $userData['password'];
            $user->phone = $userData['phone'];
            $user->stripe_id = $customer['id'];

            if(!isset($Settings['email_verification_on_reg']) || $Settings['email_verification_on_reg'] != 1){
                $user->email_verified_at = $userData['email_verified_at'];
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

            try{
                $subscription = $stripe->subscriptions->create([
                  'customer' => $user->stripe_id,
                  'items' => [
                    ['price' => $package->plan_id],
                  ],
                ]);

                $sub = new Subscription();
                $sub->user_id = $user->id;
                $sub->name = $user->name;
                $sub->stripe_id = $user->stripe_id;
                $sub->stripe_status = $subscription['status'];
                $sub->stripe_price = $subscription['plan']['amount'];
                $sub->quantity = $subscription['quantity'];
                $sub->trial_ends_at = $subscription['trial_end'];
                $sub->save();
            }      
            catch(Exception $e){
                $api_error = $e->getMessage();  
            }



        }

        if (isset($api_error)) {
            return redirect()->route('register')->with('error', $api_error); 
        }
        else{
            return redirect()->route('register')->with(['msg_type' => 'success', 'msg' => 'Subscription Created']); 
        }
    }
}
