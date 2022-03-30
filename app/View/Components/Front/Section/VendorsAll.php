<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Auth;
use App\Models\VendorProfile;
use App\Models\User;
use App\Models\Pages;

class VendorsAll extends Component
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
        // $vendor = new VendorProfile();
        // $vendors = array();
         $this->vendors = VendorProfile::paginate(1);


        $this->pageSlug = Pages::where('template', 'vendor')->where('status', 'published')->value('slug');
        // dd($vendors);
        return view('components.front.section.vendors-all');
    }
}
