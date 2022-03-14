<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Common\AccountUpdateRequest;
use Auth;
class AccountController extends Controller
{
    public function edit() {
    	$userData = Auth::user();
    	$users = new User;
        $users->name = $userData['name'];
        $users->user_name = $userData['username'];
        $users->email = $userData['email'];
        $users->phone = $userData['phone'];
        $users->address = $userData['address'];
        $users->profile_image = $userData['profile_image'];
        $users->id = $userData['id'];
        // dd($userData);

        return view('tempview/account', compact('users'));
    }

    public function update(AccountUpdateRequest $request) {
    	$userData= $request->getUserData();
        $users = User::where('id', $userData['id'])->update([
        	'name' => $userData['name'],
        	'email' => $userData['email'],
        	'address' => $userData['address'],
        	'phone' => $userData['phone'],
        	'username' => $userData['username'],
        	'profile_image' => $userData['filename'],
        ]);

        if ($request->hasPassword()) {
        	 $users = User::where('id', $userData['id'])->update(['password' => $userData['password']]);
        }

        return back()->with(['msg' => 'User Updated', 'msg_type' => 'success']);
    }
}
