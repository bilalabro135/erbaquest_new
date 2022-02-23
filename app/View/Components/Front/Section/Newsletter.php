<?php

namespace App\View\Components\Front\Section;

use App\Models\Components;
use Illuminate\View\Component;

class Newsletter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $component = Components::where('name', 'newsletter')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        if (!empty($component)) 
            return view('components.front.section.newsletter');
    }
}
