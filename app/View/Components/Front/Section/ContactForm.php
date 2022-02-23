<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;

class ContactForm extends Component
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
        $component = Components::where('name', 'contact-form')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();

        if (!empty($component))
            return view('components.front.section.contact-form');
    }
}
