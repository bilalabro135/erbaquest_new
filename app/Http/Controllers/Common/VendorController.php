<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignRoles;
use App\Models\VendorProfile;
use App\Http\Requests\Common\VendorProfileRequest;
use Auth;

class VendorController extends Controller
{
    public function view()
    {
    	$userData = Auth::user();
    	$users = new User;
        $userRole = AssignRoles::where('entity_id', $userData['id'])->first(); 
        $vendorData = VendorProfile::first();

        $users->public_profile_name = (isset($vendorData['public_profile_name'])) ? $vendorData['public_profile_name'] : '';
        $users->email = (isset($vendorData['email'])) ? $vendorData['email'] : '';
        $users->website = (isset($vendorData['website'])) ? $vendorData['website'] : '';
        $users->instagram = (isset($vendorData['instagram'])) ? $vendorData['instagram'] : '';
        $users->facebook = (isset($vendorData['facebook'])) ? $vendorData['facebook'] : '';
        $users->twitter = (isset($vendorData['twitter'])) ? $vendorData['twitter'] : '';
        $users->youtube = (isset($vendorData['youtube'])) ? $vendorData['youtube'] : '';
        $users->linkedin = (isset($vendorData['linkedin'])) ? $vendorData['linkedin'] : '';
        $users->featured_picture = (isset($vendorData['featured_picture'])) ? $vendorData['featured_picture'] : '';
        $users->picture = (isset($vendorData['picture'])) ? $vendorData['picture'] : '';
        $users->phone = (isset($vendorData['phone'])) ? $vendorData['phone'] : '';
        $users->descreption = (isset($vendorData['descreption'])) ? $vendorData['descreption'] : '';
        $users->role = $userRole['role_id'];

        // dd($vendorData);

        return view('tempview/public-profile', compact('vendorData','users'));
    }
    
    public function update(VendorProfileRequest $request, User $user)
    {

    	$userData = $request->getUserData();
        $dbUserData = User::where('id', $userData['id'])->first(); 

        $profile_image = ($userData['profile_image'] != '') ? str_replace(env('APP_URL'),"",$userData['profile_image']) : $dbUserData['profile_image'];

        if($request->profile_image){
            $fname = time().".".$request->profile_image->extension();
            $request->file('profile_image')->move(public_path().'/uploads/', $fname);     
            $user->profile_image =  'uploads/' . $fname;
            $profile_image = 'uploads/' . $fname;
        }

        $users = User::where('id', $userData['id'])->update([
        	'name' => $userData['name'],
        	'email' => $userData['email'],
        	'address' => $userData['address'],
        	'phone' => $userData['phone'],
        	'username' => $userData['username'],
        	'profile_image' => $profile_image,
        ]);

        if ($request->hasPassword()) {
        	 $users = User::where('id', $userData['id'])->update(['password' => $userData['password']]);
        }

        return back()->with(['msg' => 'User Updated', 'msg_type' => 'success']);

    }
}
