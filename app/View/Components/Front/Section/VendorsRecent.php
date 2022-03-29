<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
use App\Models\User;
use App\Models\VendorProfile;
class VendorsRecent extends Component
{
    public $vendors;
    public $fields;
    public function __construct()
    {
        //
    }


    public function render()
    {
        $component = Components::where('name', 'vendors-recent')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        $this->vendors = VendorProfile::latest()->limit(12)->get();
        if (count($this->vendors))
            return view('components.front.section.vendors-recent');
    }
}
