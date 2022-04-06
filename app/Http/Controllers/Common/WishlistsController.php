<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Common\WishlistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\SendNotificationRequest;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Notification;

use App\Models\WishLists;
use App\Models\User;
use App\Models\Event;
use App\Models\AssignRoles;
use App\Models\Settings;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use HTML;


class WishlistsController extends Controller
{
  public function store(WishlistRequest $request) {
     $user = Auth::user(); //getting user id
     $getWishListData = $request->getWishListData();
     if($user){
       //add wishlist
       $wishlistExist = WishLists::where('event_id', '=', $getWishListData['event_id'])->where('user_id', '=', $user->id)->first();
       if ($wishlistExist === null) {
         $wishlist = new WishLists();
           $wishlist->user_id = $user->id;
           $wishlist->event_id = $getWishListData['event_id'];
           $wishlist->save();
           return response()->json(['action' => 'add', 'msg_type' => 'success']);
       }else{
        $wishlistExist = WishLists::where('event_id', '=', $getWishListData['event_id'])->where('user_id', '=', $user->id)->delete(); //get wishlists
        return response()->json(['action' => 'remove', 'msg_type' => 'success']);
       }
     }else{
        return response()->json(['url' => route('redirect.wishlist'), 'action' => 'redirect']);
        //return redirect()->route('login')->with('error', 'Please auth!!');
     }
  }
  public function remove(WishlistRequest $request) {
     $user = Auth::user(); //getting user id
     $getWishListData = $request->getWishListData(); //wishlistData
     $wishlistExist = WishLists::where('event_id', '=', $getWishListData['event_id'])->where('user_id', '=', $user->id)->delete(); //get wishlists
     if($wishlistExist){
        return response()->json(['msg' => 'Event has been remove form wishlist!', 'msg_type' => 'success']);
     }
  }
  public function view() {
    $users = Auth::user(); //getting user id
    $userRole = AssignRoles::where('entity_id', $users['id'])->first();

    $wishlistsData = WishLists::where('user_id', '=', $users->id)->get(); //Gettin Wishlist data
    $events = array();
    if( count($wishlistsData) ){
      foreach ($wishlistsData as $wishlistData) {
       	$getevents = Event::find($wishlistData['event_id']);
       	$events[] = array(
       		'id' => $getevents['id'],
       		'name' => $getevents['name'],
       		'slug' => $getevents['slug'],
       		'featured_image' => $getevents['featured_image'],
       		'description' => $getevents['description'],
       		'event_date' => $getevents['event_date'],
       		'area' => $getevents['area'],
       	);
      }
    }

    $users->role = $userRole['role_id'];

    return view('tempview.wishlist', compact('events', 'users'));
  }

  public function redirect() {

      return redirect()->route('login')->with('msg', 'Please login first before add to wishlist!');
  }

  public function reminder() {

    $Settings = Settings::get('general');
    $now = Carbon::now()->addDays( ($Settings['remindb']) ? $Settings['remindb'] : '0' );
    $tomorrowDate = $now->format('Y-m-d');

    $getTomorrowEvents = Event::where('event_date', '=', $tomorrowDate)->where("status","=","published")->get();

    $wishlistUser = array();
    if(count($getTomorrowEvents)){
      foreach ($getTomorrowEvents as $getTomorrowEvent) {
        $sendEmailUser = array();
        $getWishlistUsers = wishlists::where("event_id","=",$getTomorrowEvent['id'])
          ->leftJoin('users', 'wishlists.user_id', '=', 'users.id')->get();
        if(count($getWishlistUsers)){
          foreach ($getWishlistUsers as $getWishlistUser) {
            $details = array(
              'event_id' => $getTomorrowEvent['id'],
              'event_name' => $getTomorrowEvent['name'],
              'event_image' => $getTomorrowEvent['featured_image'],
              'event_desc' => $getTomorrowEvent['description'],
              'date' => $tomorrowDate,
              'user' => $getWishlistUser['name'],
              'user_ip_key' => $getWishlistUser['ip_key'],
            );
            //Mail::to($getWishlistUser['email'])->send(new \App\Mail\eventReminder($details));
            $this->send($details);
          }
        }
      }
    }

    $now = Carbon::today();
    $tomorrowDate = $now->format('Y-m-d');

    $getTomorrowEvents = Event::where('event_date', '=', $tomorrowDate)->where("status","=","published")->get();

    $wishlistUser = array();
    if(count($getTomorrowEvents)){
      foreach ($getTomorrowEvents as $getTomorrowEvent) {
        $sendEmailUser = array();
        $getWishlistUsers = wishlists::where("event_id","=",$getTomorrowEvent['id'])
          ->leftJoin('users', 'wishlists.user_id', '=', 'users.id')->get();
        if(count($getWishlistUsers)){
          foreach ($getWishlistUsers as $getWishlistUser) {
            $details = array(
                'event_id' => $getTomorrowEvent['id'],
                'event_name' => $getTomorrowEvent['name'],
                'event_image' => $getTomorrowEvent['featured_image'],
                'event_desc' => $getTomorrowEvent['description'],
                'date' => $tomorrowDate,
                'user' => $getWishlistUser['name'],
                'user_ip_key' => $getWishlistUser['ip_key'],
            );
            $this->send($details);
            //Mail::to($getWishlistUser['email'])->send(new \App\Mail\eventReminder($details));
          }
        }
      }
    }

    return;

  }

  public function send($details)
    {

        //dd($details);

      $featured_image = url($details['event_image']);
      $featured_desc = strip_tags(strlen($details['event_desc']) > 50 ? substr($details['event_desc'],0,50)."..." : $details['event_desc']);
      $event_detail_page = url("/events/".$details['event_id']);
        $notify = $details;
        $Settings = Settings::get('general');

        if (!empty($details['user_ip_key'])) {
            Notification::send($details['user_ip_key'], new PushNotification($details['event_name'], $featured_desc, $event_detail_page, $featured_image, (isset($Settings['site_fav'])) ? $Settings['site_fav'] : ''));
            echo "Notified.";
            return;
            //return back()->with(['msg' => 'Notification Sent.', 'msg_type' => 'success']);
        }
        //echo "Some thing went wrong";
        return;
        //return back()->with(['msg' => 'Some thing went wrong', 'msg_type' => 'danger']);
    }

}
