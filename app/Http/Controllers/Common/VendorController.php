<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VendorCategory;
use App\Models\User;
use App\Models\AssignRoles;
use App\Models\VendorProfile;
use App\Models\Pages;
use App\Models\Reviews;

use App\Http\Requests\Common\VendorProfileRequest;
use App\Http\Requests\Common\SubmitReviewRequest;

use Auth;
use Carbon\Carbon;

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
        if (isset($vendorData->category_id) && !empty($vendorData->category_id)) {
            $vendorData->category_id = explode(',',$vendorData->category_id);
        }
        $category   = VendorCategory::pluck('name','id')->all();
        $users->public_profile_name = (isset($vendorData['public_profile_name'])) ? $vendorData['public_profile_name'] : '';

        $users->email = (isset($vendorData['email'])) ? $vendorData['email'] : '';
        $users->website = (isset($vendorData['website'])) ? $vendorData['website'] : '';
        $users->instagram = (isset($vendorData['instagram'])) ? $vendorData['instagram'] : '';
        $users->facebook = (isset($vendorData['facebook'])) ? $vendorData['facebook'] : '';
        $users->twitter = (isset($vendorData['twitter'])) ? $vendorData['twitter'] : '';
        $users->youtube = (isset($vendorData['youtube'])) ? $vendorData['youtube'] : '';
        $users->linkedin = (isset($vendorData['linkedin'])) ? $vendorData['linkedin'] : '';
        $users->telegram = (isset($vendorData['telegram'])) ? $vendorData['telegram'] : '';
        $users->discord = (isset($vendorData['discord'])) ? $vendorData['discord'] : '';
        $users->featured_picture = (isset($vendorData['featured_picture'])) ? $vendorData['featured_picture'] : '';
        $users->picture = (isset($vendorData['picture'])) ? unserialize($vendorData['picture']) : '';
        $users->show_picture = (isset($vendorData['picture'])) ? $vendorData['picture'] : '';
        $users->phone = (isset($vendorData['phone'])) ? $vendorData['phone'] : '';
        $users->descreption = (isset($vendorData['descreption'])) ? $vendorData['descreption'] : '';
        $users->user_id = (isset($vendorData['id'])) ? $vendorData['id'] : '';
        $users->role = $userRole['role_id'];

        return view('tempview/public-profile', compact('vendorData','users','category'));
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
            $vendor->telegram = $request['telegram'];
            $vendor->discord = $request['discord'];
            $vendor->phone = $request['phone'];
            $vendor->descreption = $request['descreption'];
            $vendor->featured_picture = $featured_picture;
            $vendor->picture = $gallery;
            $vendor->user_id = $currentuser['id'];
            $vendor->category_id = ((isset($request['category_id']))  && ((count($request['category_id'])>0))) 
                                    ? implode(",",$request['category_id'])
                                    : null;
            // $cat_id = isset($request['category_id']) ? $request['category_id'] : null;
            // $vendor->category_id = implode(",",$cat_id);
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
                'telegram' => $request['telegram'],
                'discord' => $request['discord'],
                'featured_picture' => $featured_picture,
                'picture' => $gallery,
                'category_id' => ((isset($request['category_id']))  && ((count($request['category_id'])>0))) 
                        ? implode(",",$request['category_id'])
                        : null,
                // 'category_id' => implode(",",$request['category_id']),
            ]);
        }
        return back()->with(['msg' => 'Profile Updated', 'msg_type' => 'success']);
    }
    public function show($pages,$id){

        $vendorData = VendorProfile::where('id',$id)->first();
        $reviews =  Reviews::where('rel_id',$id)->where('type','vendor')->orderBy('created_at', 'desc')->get();
        
        $sendReviews = array();
        foreach ($reviews as $review) {
            if($review['user_id']){
               $getUsers = User::where("id",$review['user_id'])->first();

                if($getUsers['profile_image']){
                    $profile_image = env('APP_URL') .$getUsers['profile_image'];
                }else{
                    $profile_image = "";
                } 

               $sendReviews[] = array(
                    'id'    => $review['id'],
                    'profile_image' => $profile_image,
                    'name' => $getUsers['name'],
                    'comment' => $review['comment'],
                    'speed_rating' => $review['speed_rating'],
                    'quality_rating' => $review['quality_rating'],
                    'price_rating' => $review['price_rating'],
                    'date'         => $this->time_elapsed_string($review['created_at']),
                );        
             
            }else{
                
                if($review['featured_image']){
                    $profile_image = env('APP_URL') .$review['featured_image'];
                }else{
                    $profile_image = "";
                } 
                $sendReviews[] = array(
                    'id'    => $review['id'],
                    'profile_image' => $profile_image,
                    'name' => $review['name'],
                    'comment' => $review['comment'],
                    'speed_rating' => $review['speed_rating'],
                    'quality_rating' => $review['quality_rating'],
                    'price_rating' => $review['price_rating'],
                    'date'         => $this->time_elapsed_string($review['created_at']),
                );
            }
        }

        return view('front.vendor.index', compact('vendorData', 'pages','sendReviews'));
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new Carbon;
        $ago = new Carbon($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function submitReviwes( SubmitReviewRequest $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $reviews = new Reviews();
        $reviews->rel_id = $request['rel_id'];
        $reviews->user_id = $user_id;
        $reviews->type = "vendor";
        $reviews->speed_rating = $request['speed'];
        $reviews->quality_rating = $request['quality'];
        $reviews->price_rating = $request['price'];
        $reviews->comment = $request['comment'];
        $reviews->save();

        return back()->with(['msg' => 'Review Posted', 'msg_type' => 'success']);
    }

   //  public function search(Request $request)
   //  {
   //      $event_data = "?category=".$request->checkedData;
        
   //      return response()->json($event_data);
   // }
    public function VendorCategoryFilter(Request $data)
    {
        $pageSlug   = Pages::where('template', 'vendor')->where('status', 'published')->value('slug');
        if (!isset($data->keys) || $data->keys == null || preg_match_all("/all/i", $data, $matches)) {
            $vendors = VendorProfile::limit(20)->get();
        }else{
            $vendors = VendorProfile::where('category_id','LIKE','%'.$data->keys.'%')->paginate(20);
        }
        if($vendors){
            foreach($vendors as $vendor){?>
                <div class="col-md-3 existingRecord">
                    <div class="vendor_box">
                        <a href="<?php echo route('posts.show', ['pages' => $pageSlug, 'id' => $vendor['id']])?>">
                            <img src="<?php echo asset($vendor['featured_picture'])?>" alt="<?php echo $vendor['public_profile_name']?>">
                        </a>
                        <a href="<?php echo route('posts.show', ['pages' => $pageSlug, 'id' => $vendor['id']])?>"><h3><?php echo $vendor['public_profile_name']?></h3></a>
                    </div>
                </div>
                <?php 
            }
        }else{
            "<h2 class='text-center text-secondary'>NO VENDOR FOUND..!!</h2>";
        }
        return;
    }
}
