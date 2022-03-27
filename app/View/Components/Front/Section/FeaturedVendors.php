<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Auth;
use App\Models\VendorProfile;
use App\Models\User;
use App\Models\Pages;
use DB;

class FeaturedVendors extends Component
{
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
        
        $featuredUsers = DB::select('SELECT *,u.id as user_id FROM `users` u LEFT JOIN `assigned_roles` ar on(u.id = ar.entity_id) where ar.role_id = 2');
        $sendUser = array();
        foreach ($featuredUsers as $featuredUser) {
            $getUsers = VendorProfile::where("user_id",$featuredUser->user_id)->first();
            if($getUsers){
                $sendUser[] = array(
                    'featured_picture' => $getUsers['featured_picture'],
                    'public_profile_name' => $getUsers['public_profile_name'],
                    'id' => $getUsers['id'],

                );
            }    
        }

        $this->vendors = $sendUser;

        $this->pageSlug = Pages::where('template', 'vendor')->where('status', 'published')->value('slug');
        // dd($vendors);
        return view('components.front.section.featured-vendors');
    }
}
