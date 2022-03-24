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
    	//dd($request);
    	$current = Auth::user();
    	
    	$userData = $request->getUserData();

        $featured_picture = ($userData['featured_picture'] != '') ? str_replace(env('APP_URL'),"",$userData['featured_picture']) : $dbUserData['featured_picture'];

        if($request->featured_picture){
            $fname = time().".".$request->featured_picture->extension();
            $request->file('featured_picture')->move(public_path().'/uploads/', $fname);     
            $user->featured_picture =  'uploads/' . $fname;
            $featured_picture = 'uploads/' . $fname;
        }

        $users = User::where('id', $userData['id'])->update([
        	'public_profile_name' => $userData['public_profile_name'],
        	'email' => $userData['email'],
        	'phone' => $userData['phone'],
        	'descreption' => $userData['descreption'],
        	'website' => $userData['website'],
        	'instagram' => $userData['instagram'],
        	'facebook' => $userData['facebook'],
        	'twitter' => $userData['twitter'],
        	'youtube' => $userData['youtube'],
        	'linkedin' => $userData['linkedin'],
        	'featured_picture' => $featured_picture,
        ]);

        if ($request->hasPassword()) {
        	 $users = User::where('id', $userData['id'])->update(['password' => $userData['password']]);
        }

        return back()->with(['msg' => 'User Updated', 'msg_type' => 'success']);

    }
}
