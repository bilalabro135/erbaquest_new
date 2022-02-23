<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
class EventsPast extends Component
{

    public $fields;
    public function __construct()
    {
    }


    public function render()
    {
        $component = Components::where('name', 'events-past')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();

        if (!empty($component))
            return view('components.front.section.events-past');
    }
}
