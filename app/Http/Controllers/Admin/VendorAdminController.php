<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AssignRoles;
use App\Models\Settings;

use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Http\Requests\Common\CardInfoRequest;
use App\Http\Requests\Common\ReviewRequest;

use App\Models\UserGatewayProfiles;
use App\Models\UserPaymentProfiles;
use App\Models\Reviews; 
use App\Models\VendorProfile;
use App\Models\Subscription; 
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use DataTables;
use Redirect;
use Auth;
use Bouncer;
use Carbon\Carbon;
class VendorAdminController extends Controller
{
    public function index()
    {
        return view('admin.vendors.index');
    }

    public function getUsers(request $ajaxrequest){
        $data = VendorProfile::query()->select('id','public_profile_name','email');
        // $data = json_encode($data);

        // return compact('data');
        
        return DataTables::eloquent($data)
        ->addColumn('action', function($row){
                $user_id =  auth()->user()->id;
                $actionBtn ='<a href="'.route('admin.vendor.edit.id', ['adminEdit' => $row->id]).'" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                 $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="'.route('admin.vendor.delete.id', ['adminDelete' => $row->id]).'"><i class="fas fa-trash-alt"></i></a>';
                
                return $actionBtn;
        })
        ->rawColumns(['action'])

        ->toJson();
    }

    public function addUsers()
    {
        $users = User::pluck('name','id')->all();
        return view('admin.vendors.add', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
                'public_profile_name'   => 'required',
                'email'                 => 'required|email',
                'featured'              => 'required',
                'phone'                 => 'required|regex:/^[0-9]+$/',
                'descreption'           => 'required',
                'user_id'               => 'required|regex:/^[0-9]+$/'
        ]);

        if (isset($request['featured'],$request['picture'])) {
            $featured = str_replace(env('APP_URL'),"",$request['featured']);
            $picture  = str_replace(env('APP_URL'),"",$request['picture']);
        }

        $vendor = VendorProfile::create([
            'public_profile_name'   => $request->public_profile_name,
            'email'                 => $request->email,
            'website'               => $request->website,
            'instagram'             => $request->instagram,
            'facebook'              => $request->facebook,
            'twitter'               => $request->twitter,
            'youtube'               => $request->youtube,
            'linkedin'              => $request->linkedin,
            'featured_picture'      => $featured,
            'phone'                 => $request->phone,
            'descreption'           => $request->descreption,
            'user_id'               => $request->user_id,
        ]);

        return Redirect::route('admin.vendor')->with(['msg' => 'Vendor added', 'msg_type' => 'success']);
    }

    public function editUsers(Request $user,$id)
    {
        $vendor = VendorProfile::where('id',$id)->first();
        $users = User::pluck('name','id')->all();
        if (isset($vendor['picture'],$vendor['featured_picture'])) {
            $vendor['picture']  = ($vendor['picture']) ? env('APP_URL')."/".$vendor['picture'] : '';
            $vendor['featured_picture'] = ($vendor['featured_picture']) ? env('APP_URL')."/".$vendor['featured_picture'] : '';
        }
        // dd($vendor);
        return view('admin.vendors.edit',compact('vendor','users'));
    }

    public function updateUser(Request $request,$id)
    {
        $validated = $request->validate([
                'public_profile_name'   => 'required',
                'email'                 => 'required|email',
                'featured'              => 'required',
                'phone'                 => 'required|regex:/^[0-9]+$/',
                'descreption'           => 'required',
                'user_id'               => 'required|regex:/^[0-9]+$/'
        ]);

        $vendor = VendorProfile::where('id',$id)->first();
        $vendor->public_profile_name    = $request->public_profile_name;
        $vendor->email                  = $request->email;
        $vendor->website                = $request->website;
        $vendor->instagram              = $request->instagram;
        $vendor->facebook               = $request->facebook;
        $vendor->twitter                = $request->twitter;
        $vendor->youtube                = $request->youtube;
        $vendor->linkedin               = $request->linkedin;
        $vendor->featured_picture       = str_replace(env('APP_URL'),"",$request['featured']);
        $vendor->phone                  = $request->phone;
        $vendor->descreption            = $request->descreption;
        $vendor->user_id                = $request->user_id;
        $vendor->save();

        return Redirect::route('admin.vendor')->with(['msg' => 'Vendor Updated', 'msg_type' => 'success']);
    }

    public function deleteVendor(Request $request,$id)
    {
        if(isset($id)){
            $delete_vendor = VendorProfile::findOrfail($id)->delete();
            if ($delete_vendor) {
                return Redirect::route('admin.vendor')->with(['msg' => 'Vendor deleted', 'msg_type' => 'success']);
            }else{
                return Redirect::route('admin.vendor')->with(['msg' => 'Vendor does not deleted', 'msg_type' => 'error']);
            }
        }else{
            return Redirect::route('admin.vendor')->with(['msg' => 'Vendor does not exists', 'msg_type' => 'error']);
        }
    }


}
