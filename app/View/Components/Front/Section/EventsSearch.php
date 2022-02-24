<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;

class EventsSearch extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $fields;
    public $isEvent;
    public function __construct($isEvent = false)
    {
        $this->isEvent = $isEvent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $component = Components::where('name', 'events-search')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        if (!empty($component)) 
            return view('components.front.section.events-search');
    }
}
