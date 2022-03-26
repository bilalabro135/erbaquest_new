<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\VendorProfile;
use App\Models\Pages;
use App\Models\User;

class AllVendors extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $vendors;
    public $pageSlug;
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $user = Auth::user();
        $vendor = VendorProfile::where('status', 'published');
        $vendors = array();
        $getvendors = $vendor->get();

        if( count($getvendors) ){
            foreach ($getvendors as $getvendor) {
                
                $user_data = User::where("id","=",$getvendor['user_id'])->first();
                if($user_data['profile_image']){
                    $profile_image = env('APP_URL') .$user_data['profile_image'];
                }else{
                    $profile_image = "";
                }
                
                $vendors[] = array(
                    'id' => $getvendor['id'],
                    'name' => $getvendor['name'],
                    'slug' => $getvendor['slug'],
                    'isWishList' => $isWishList,
                    'featured_image' => $getvendor['featured_image'],
                    'description' => $getvendor['description'],
                    'event_date' => $getvendor['event_date'],
                    'area' => $getvendor['area'],
                    'user_profile' => $profile_image,
                );
            }
        }
        
        $this->vendors = 'nsadas';
        $this->pageSlug = Pages::where('template', 'vendor')->where('status', 'published')->value('slug');
        // dd($vendors);
        return view('components.front.section.vendor-all');
    }
}
