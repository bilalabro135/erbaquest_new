<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use Bouncer;
use App\Http\Requests\Admin\SendNotificationRequest;
use App\Notifications\PushNotification;
use Illuminate\Support\Facades\Notification;
class SendNotification extends Controller
{
    public function getAllUsersByRoles($roles){
        $users = array();
        foreach($roles as $role){
            $user = User::whereIs($role)->where('ip_key', '!=', null)->pluck('ip_key');
            foreach ($user as $u){
                $users[] = $u;
            }
        }
        return $users;
    }
    public  function index(){
        $roles = Bouncer::role()->all();
        $users = User::where('ip_key', '!=', null)->get();
        return view('admin.notification.index', compact('roles', 'users'));
    }
    public function send(SendNotificationRequest $request)
    {
        $notify = $request->getNotification();
        $Settings = Settings::get('general');
        if ($notify['to'] == 'all') {
            $users = User::where('ip_key', '!=', null)->pluck('ip_key');
        }
        else if($notify['to'] == 'role'){
            $users = $this->getAllUsersByRoles($request->roles);
        }
        else if($notify['to'] == 'user'){
            $users = User::whereIn('id', $request->users)->pluck('ip_key');
        }
        if (!empty($users)) {
            Notification::send($users, new PushNotification($notify['title'], $notify['body'], $notify['action'], $notify['featured_image'], (isset($Settings['site_logo'])) ? $Settings['site_logo'] : ''));

            return back()->with(['msg' => 'Notification Sent.', 'msg_type' => 'success']); 
        }

        return back()->with(['msg' => 'Some thing went wrong', 'msg_type' => 'danger']); 
    }
    public function store(Request $request){
        $validation = Validator::make($request->all(),[
          'currentToken' => 'required',
        ]);
        if ($validation->fails())
        {
            return response()->json(['error', 'Sorry we got an error in storing your IP!']);
        }
        else{
            auth()->user()->update([
                'ip_key' => $request->currentToken;
            ]);
        }

        return response()->json(['ResponseCode' => 1, 'ResponseText' => 'IP stored'], 200);
    }
}
