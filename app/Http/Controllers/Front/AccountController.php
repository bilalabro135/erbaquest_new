<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AccountController extends Controller
{
    public function edit() {
    	$user = Auth::user();
    	// dd($user);
    }
}
