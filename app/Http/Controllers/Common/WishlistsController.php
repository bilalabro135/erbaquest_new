<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Common\WishlistRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\WishLists;
use App\Models\User;
use App\Models\Event;

use Carbon\Carbon;
use Carbon\CarbonPeriod;


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
    $user = Auth::user(); //getting user id
    $wishlistsData = WishLists::where('user_id', '=', $user->id)->get(); //Gettin Wishlist data
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
    return view('tempview.wishlist', compact('events'));
  }

  public function redirect() { 

      return redirect()->route('login')->with('msg', 'Please login first before add to wishlist!');
  }

  public function reminder() {
  dd("1");    
    $now = Carbon::tomorrow();
    $tomorrowDate = $now->format('Y-m-d');    
    dd($tomorrowDate);
    $getTomorrowEvents = Event::where('event_date', '=', $tomorrowDate)->where("status","=","published")->get();
    $wishlistUser = array();
    if(count($getTomorrowEvents)){
      foreach ($getTomorrowEvents as $getTomorrowEvent) {
        $sendEmailUser = array();
        $getWishlistUsers = wishlists::where("event_id","=",$getTomorrowEvent['id'])
          ->leftJoin('users', 'wishlists.user_id', '=', 'users.id')->get();
        if(count($getWishlistUsers)){
          foreach ($getWishlistUsers as $getWishlistUser) {
            $wishlistUser[] = $getWishlistUser['email']; 
          }
        } 
        if(!empty($wishlistUser)){
            $details = array();
            Mail::to($wishlistUser)->send(new \App\Mail\eventReminder($details));
        }     
      } 
    }

    return;
    
  }
}
