<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AssignRoles;
use App\Models\VendorCategory;
use App\Models\Settings;
use App\Models\Pages;

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
        $users      = User::pluck('name','id')->all();
        $category   = VendorCategory::pluck('name','id')->all();
        return view('admin.vendors.add', compact('users','category'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
                'public_profile_name'   => 'required',
                'email'                 => 'required|email',
                'featured'              => 'required',
                'phone'                 => 'required|regex:/^[0-9]+$/',
                'descreption'           => 'required',
                'user_id'               => 'required|regex:/^[0-9]+$/',
                'category_id'           => 'required'
        ]);

        if (isset($request['featured'])) {
            $request['featured'] = str_replace(env('APP_URL'),"",$request['featured']);
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
            'featured_picture'      => $request->featured,
            'phone'                 => $request->phone,
            'descreption'           => $request->descreption,
            'user_id'               => $request->user_id,
            'category_id'           => $request->category_id,
        ]);

        return Redirect::route('admin.vendor')->with(['msg' => 'Vendor added', 'msg_type' => 'success']);
    }

    public function editUsers(Request $user,$id)
    {
        $vendor     = VendorProfile::where('id',$id)->first();
        $users      = User::pluck('name','id')->all();
        $category   = VendorCategory::pluck('name','id')->all();
        if (isset($vendor['picture'],$vendor['featured_picture'])) {
            $vendor['picture']  = ($vendor['picture']) ? env('APP_URL')."/".$vendor['picture'] : '';
            $vendor['featured_picture'] = ($vendor['featured_picture']) ? env('APP_URL')."/".$vendor['featured_picture'] : '';
        }
        // dd($vendor);
        return view('admin.vendors.edit',compact('vendor','users','category'));
    }

    public function updateUser(Request $request,$id)
    {
        $validated = $request->validate([
                'public_profile_name'   => 'required',
                'email'                 => 'required|email',
                'featured'              => 'required',
                'phone'                 => 'required|regex:/^[0-9]+$/',
                'descreption'           => 'required',
                'user_id'               => 'required|regex:/^[0-9]+$/',
                'category_id'            => 'required'
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
        $vendor->category_id            = $request->category_id;
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

    public function Vendorindex(){
        return view('admin.vendors.categoryindex');
    }
    public function GetVendorCategory(request $ajaxrequest){
        $data = VendorCategory::query()->select('id','name');
        // $data = json_encode($data);

        // return compact('data');
        
        return DataTables::eloquent($data)
        ->addColumn('action', function($row){
                $user_id =  auth()->user()->id;
                $actionBtn ='<a href="'.route('admin.vendor.category.edit.id', ['categoryEdit' => $row->id]).'" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                 $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="'.route('admin.vendor.category.delete.id', ['categoryDelete' => $row->id]).'"><i class="fas fa-trash-alt"></i></a>';
                
                return $actionBtn;
        })
        ->rawColumns(['action'])

        ->toJson();
    }
    public function editCategoryUsers($id)
    {
        $category = VendorCategory::findOrfail($id);
        return view('admin.vendors.editcategory',compact('category'));
    }
    public function updateCategoryUsers(request $request,$id)
    {
        $validated = $request->validate([
            'name'               => 'required|min:3|max:100'
        ]);

        $category           = VendorCategory::where('id',$id)->first();
        $category->name     = $request->name;
        $category->save();

        return Redirect::route('admin.vendor.categories')->with(['msg' => 'Vendor Category Updated', 'msg_type' => 'success']);
    }
    public function deleteVendorCategory(VendorCategory $category,$id)
    {
        $category           = VendorCategory::findOrfail($id)->delete();
        if ($category) {
            return Redirect::route('admin.vendor.categories')->with(['msg' => 'Vendor Category Deleted', 'msg_type' => 'success']);
        }
    }
    public function addVendorCategory()
    {
        return view('admin.vendors.addcategory');
    }
    public function storeCategoryUser(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|min:3|max:100'
        ]);
        $vendor = VendorCategory::create([
            'name'   => $request->name,
        ]);
        return Redirect::route('admin.vendor.categories')->with(['msg' => 'Vendor category added', 'msg_type' => 'success']);
    }
    public function VendorCategoryFilter(request $data)
    {
        $pageSlug   = Pages::where('template', 'vendor')->where('status', 'published')->value('slug');
        if (!is_numeric($data->cat_id)) {
            $vendor     = VendorProfile::paginate(20);
            foreach($vendor as $vendorItem){?>
            <div class="col-md-3">
                <div class="vendor_box">
                    <a href="
                    <?php echo route('posts.show', ['pages' => $pageSlug, 'id' => $vendorItem['id']]) ?>">
                        <img src="<?php echo asset($vendorItem['featured_picture'])?>" alt="<?php echo $vendorItem['public_profile_name'] ?>">
                    </a>
                    <a href="<?php echo route('posts.show', ['pages' => $pageSlug, 'id' => $vendorItem['id']]) ?>"><h3><?php echo $vendorItem['public_profile_name'] ?></h3></a>
                </div>
            </div>
        <?php }
        return;
        }else{
            $vendor     = VendorProfile::where('category_id',$data->cat_id)->paginate(20);
            // dd($vendor);
            foreach($vendor as $vendorItem){?>
                <div class="col-md-3">
                    <div class="vendor_box">
                        <a href="
                        <?php echo route('posts.show', ['pages' => $pageSlug, 'id' => $vendorItem['id']]) ?>">
                            <img src="<?php echo asset($vendorItem['featured_picture'])?>" alt="<?php echo $vendorItem['public_profile_name'] ?>">
                        </a>
                        <a href="<?php echo route('posts.show', ['pages' => $pageSlug, 'id' => $vendorItem['id']]) ?>"><h3><?php echo $vendorItem['public_profile_name'] ?></h3></a>
                    </div>
                </div>
            <?php }
            return;
        }
        
    }
}

