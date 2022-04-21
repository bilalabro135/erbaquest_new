<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
class VendorBecomeSponsor extends Component
{
    public function __construct()
    {
        //
    }
    public $fields;
    public function render()
    {

        $component = Components::where('name', 'vendor-become-sponsor')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();

        if (!empty($component)) 
            return view('components.front.section.vendor-become-sponsor');
    }
}
