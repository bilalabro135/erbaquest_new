<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;

class EventsUpcoming extends Component
{
    public $fields;
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
        $component = Components::where('name', 'events-upcoming')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();

        if (!empty($component)) 
            return view('components.front.section.events-upcoming');
    }
}
