<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
use App\Models\Amenity;

class EventSearchAmenties extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $fields;
    public $amenities;
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

        $component = Components::where('name', 'event-search-amenties')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        $this->amenities = Amenity::all();
        if (count($this->amenities)) 
            return view('components.front.section.event-search-amenties');
    }
}
