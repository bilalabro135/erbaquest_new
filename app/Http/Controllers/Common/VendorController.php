<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignRoles;
use App\Models\VendorProfile;
use App\Models\Pages;
use App\Http\Requests\Common\VendorProfileRequest;
use Auth;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = VendorProfile::all();
        $pages = Pages::all();
        $pageSlug = Pages::where('template', 'vendor')->where('status', 'published')->value('slug');
        return view('templates.vendor',compact('vendors', 'pageSlug', 'pages'));
    }

    public function view()
    {
    	$userData = Auth::user();
    	$users = new User;
        $userRole = AssignRoles::where('entity_id', $userData['id'])->first(); 
        $vendorData = VendorProfile::where('user_id', $userData['id'])->first();

        $users->public_profile_name = (isset($vendorData['public_profile_name'])) ? $vendorData['public_profile_name'] : '';

        $users->email = (isset($vendorData['email'])) ? $vendorData['email'] : '';
        $users->website = (isset($vendorData['website'])) ? $vendorData['website'] : '';
        $users->instagram = (isset($vendorData['instagram'])) ? $vendorData['instagram'] : '';
        $users->facebook = (isset($vendorData['facebook'])) ? $vendorData['facebook'] : '';
        $users->twitter = (isset($vendorData['twitter'])) ? $vendorData['twitter'] : '';
        $users->youtube = (isset($vendorData['youtube'])) ? $vendorData['youtube'] : '';
        $users->linkedin = (isset($vendorData['linkedin'])) ? $vendorData['linkedin'] : '';
        $users->featured_picture = (isset($vendorData['featured_picture'])) ? $vendorData['featured_picture'] : '';
        $users->picture = (isset($vendorData['picture'])) ? unserialize($vendorData['picture']) : '';
        $users->show_picture = (isset($vendorData['picture'])) ? $vendorData['picture'] : '';
        $users->phone = (isset($vendorData['phone'])) ? $vendorData['phone'] : '';
        $users->descreption = (isset($vendorData['descreption'])) ? $vendorData['descreption'] : '';
        $users->user_id = (isset($vendorData['id'])) ? $vendorData['id'] : '';
        $users->role = $userRole['role_id'];

        return view('tempview/public-profile', compact('vendorData','users'));
    }
    
    public function update(VendorProfileRequest $request, User $user)
    {        
    	$currentuser = Auth::user();
        $vendor_data = VendorProfile::where('user_id', $currentuser['id'])->first();
        // dd($vendor_data);
        if($vendor_data == null){

            $fname = rand().time().".".$request->featured_picture->extension();
            $request->file('featured_picture')->move(public_path().'/uploads/', $fname);     
            $user->featured_picture =  'uploads/' . $fname;
            $featured_picture = 'uploads/' . $fname;
            
            $image_names = [];
            foreach ($request->file('picture') as $image) {
                $name = rand().time().".".$image->extension();
                $image->move(public_path().'/uploads/', $name);  
                $image_names[] = array('url' =>  'uploads/' . $name, 'alt' => '');
            }
            $gallery = serialize($image_names);
            $vendor = new VendorProfile();
            $vendor->public_profile_name = $request['public_profile_name'];
            $vendor->email = $request['email'];
            $vendor->website = $request['website'];
            $vendor->instagram = $request['instagram'];
            $vendor->facebook = $request['facebook'];
            $vendor->twitter = $request['twitter'];
            $vendor->youtube = $request['youtube'];
            $vendor->linkedin = $request['linkedin'];
            $vendor->phone = $request['phone'];
            $vendor->descreption = $request['descreption'];
            $vendor->featured_picture = $featured_picture;
            $vendor->picture = $gallery;
            $vendor->user_id = $currentuser['id'];
            $vendor->save();
        }else{
            if($request->featured_picture){
                $fname = rand().time().".".$request->featured_picture->extension();
                $request->featured_picture->move(public_path().'/uploads/', $fname);     
                $featured_picture = 'uploads/' . $fname;
            }else{
                $featured_picture = $vendor_data['featured_picture'];
            }
            if($request->picture){
                $image_names = [];
                foreach ($request->file('picture') as $image) {
                    $name = rand().time().".".$image->extension();
                    $image->move(public_path().'/uploads/', $name);  
                    $image_names[] = array('url' =>  'uploads/' . $name, 'alt' => '');
                }
                $gallery = serialize($image_names);
            }else{
                $gallery = $vendor_data['picture'];
            }

            $users = VendorProfile::where("id",$vendor_data['id'])->update([
                'public_profile_name' => $request['public_profile_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'descreption' => $request['descreption'],
                'website' => $request['website'],
                'instagram' => $request['instagram'],
                'facebook' => $request['facebook'],
                'twitter' => $request['twitter'],
                'youtube' => $request['youtube'],
                'linkedin' => $request['linkedin'],
                'featured_picture' => $featured_picture,
                'picture' => $gallery,
            ]);
        }
        return back()->with(['msg' => 'Profile Updated', 'msg_type' => 'success']);
    }
    public function show($pages,$id){

        $vendorData = VendorProfile::where('id',$id)->first();
        return view('front.vendor.index', compact('vendorData', 'pages'));
    }
}
