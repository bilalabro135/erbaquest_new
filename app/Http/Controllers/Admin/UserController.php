<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use DataTables;
use Redirect;
use Auth;
use Bouncer;
use App\Models\Settings;
class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }
    public function getUsers(){
        $model = User::query();

        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
                $user_id =  auth()->user()->id;
                
                $actionBtn= '';
                if(Bouncer::can('updateUsers')){
                $actionBtn .='<a href="'.route('users.edit', ['user' => $row->id]).'" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Bouncer::can('updateRoles') && $row->id != 1 && $user_id != $row->id) {
                    $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="'.route('users.delete', ['id' => $row->id]).'"><i class="fas fa-trash-alt"></i></a>';
                }
                
                return $actionBtn;
        })
        ->rawColumns(['action'])

        ->toJson();
    }
    public function addUsers()
    {
        $roles = Bouncer::role()->all()->pluck('name');
        $Settings = Settings::get('registration');        
        return view('admin.users.add', compact('roles', 'Settings'));
    }
    public function storeUser(UserRequest $request)
    {

        $userData= $request->getUserData();

        $user = new User;
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->email_verified_at = $userData['email_verified_at'];
        $user->save();
        if ($request->shouldSendVerificationEmail()) {
            $user->sendEmailVerificationNotification();
        }
        $user->assign($request->role);
        return Redirect::route('users')->with(['msg' => 'User added', 'msg_type' => 'success']);
    }
    public function editUsers(User $user)
    {
        $roles = Bouncer::role()->all()->pluck('name');
        $Settings = Settings::get('registration');

        return view('admin.users.edit', compact('user', 'roles', 'Settings'));
    }
    public function updateUsers(UserUpdateRequest $request)
    {
        $userData= $request->getUserData();

        $user = new User;
        $user->exists = true;
        $user->id = $userData['id'];
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        if($request->hasPassword()){
            $user->password = $userData['password'];
        }
        if ($request->shouldUpdateVerifiacation()) {
            $user->email_verified_at = $userData['email_verified_at'];
        }
        $user->save();
        if ($request->shouldSendVerificationEmail()) {
            $user->sendEmailVerificationNotification();
        }

        $currentRole= $user->getRoles();
                
        if(empty($currentRole[0])){
            $user->assign($request->role);
        }else{
            if($currentRole[0] != $request->role){
                $user->retract($currentRole[0]);
                $user->assign($request->role);
            }
        }
        
        return back()->with(['msg' => 'User Updated', 'msg_type' => 'success']);
    }
    public function deleteuser(Request $request)
    {   
        if( $request->id != auth()->user()->id && $request->id != 1 ){
            $user = User::where('id', $request->id)->delete();
            if ($user) {
                return Redirect::back()->with(['msg' => 'User deleted', 'msg_type' => 'success']);
            } 
        }
        else{
            abort(404);
        }
    }
}
