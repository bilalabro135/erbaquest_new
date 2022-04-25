<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;

class ContactUs extends Component
{
    public $fields;
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $component = Components::where('name', 'contact-us')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        // dd($component->fields);

        if (!empty($component)) 
            return view('components.front.section.contact-us');
    }
}
