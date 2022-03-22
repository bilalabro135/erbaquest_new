<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Common\AccountUpdateRequest;
use Auth;
class AccountController extends Controller
{
    public function edit(Request $request) {
        
    	$userData = Auth::user();
    	$users = new User;
        $users->name = $userData['name'];
        $users->user_name = $userData['username'];
        $users->email = $userData['email'];
        $users->phone = $userData['phone'];
        $users->address = $userData['address'];
        
        if ($userData['profile_image']) {
            $users->profile_image = env('APP_URL').$userData['profile_image'];
        }
        
        $users->id = $userData['id'];

        return view('tempview/account', compact('users'));
    }

    public function update(AccountUpdateRequest $request) {
    	$userData= $request->getUserData();
        
        $fname = $request->file('profile_image')->getClientOriginalName();
        $request->file('profile_image')->move(public_path().'/uploads/', $fname);
        
        $users = User::where('id', $userData['id'])->update([
        	'name' => $userData['name'],
        	'email' => $userData['email'],
        	'address' => $userData['address'],
        	'phone' => $userData['phone'],
        	'username' => $userData['username'],
        	'profile_image' => '/uploads/' . $fname,
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
