<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignRoles;
use App\Http\Requests\Common\AccountUpdateRequest;
use Auth;
class AccountController extends Controller
{
    public function edit(Request $request) {
        
    	$userData = Auth::user();
    	$users = new User;

        $userRole = AssignRoles::where('entity_id', $userData['id'])->first(); 

        $users->name = $userData['name'];
        $users->user_name = $userData['username'];
        $users->email = $userData['email'];
        $users->phone = $userData['phone'];
        $users->address = $userData['address'];
        $users->role = $userRole['role_id'];
        
        if ($userData['profile_image']) {
            $users->profile_image = env('APP_URL').$userData['profile_image'];
        }
        
        $users->id = $userData['id'];
        // dd($users);

        return view('tempview/account', compact('users'));
    }

    public function update(AccountUpdateRequest $request, User $user) {
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

    public function redirect() {

        return redirect()->route('account.edit');

    }
}
