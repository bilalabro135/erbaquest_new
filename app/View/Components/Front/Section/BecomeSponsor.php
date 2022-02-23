<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
class BecomeSponsor extends Component
{
    public function __construct()
    {
        //
    }
    public $fields;
    public function render()
    {

        $component = Components::where('name', 'become-sponsor')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();

        if (!empty($component)) 
            return view('components.front.section.become-sponsor');
    }
}
