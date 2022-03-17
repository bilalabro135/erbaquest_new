<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Common\WishlistRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\WishLists;
use App\Models\User;
use App\Models\Event;


class WishlistsController extends Controller
{
    public function store(WishlistRequest $request) {
     $getWishListData = $request->getWishListData();
     $user = Auth::user(); //getting user id
     //add wishlist
     $wishlistExist = WishLists::where('event_id', '=', $getWishListData['event_id'])->where('user_id', '=', $user->id)->first();
	 if ($wishlistExist === null) {
	   $wishlist = new WishLists();
       $wishlist->user_id = $user->id;
       $wishlist->event_id = $getWishListData['event_id'];
       $wishlist->save();
   	   return response()->json(['msg' => 'Added to Wishlist', 'msg_type' => 'success']);
	 }else{
	 	return response()->json(['msg' => 'Already In Wishlist', 'msg_type' => 'success']);
	 }
     
   }
   public function view() {     $user = Auth::user(); //getting user id
     $wishlistsData = WishLists::where('user_id', '=', $user->id)->get(); //Gettin Wishlist data
     $events = array();
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
     	// echo "<pre>";
     	// print_r($events);
     	// exit();
     }
     
	//$eventData = WishLists::where('user_id', '=', $user->id)->get(); //Gettin Wishlist data
     return view('tempview.wishlist', compact('events'));
   }
}
