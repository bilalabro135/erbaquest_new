<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
class HomeBanner extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $sponsors;
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
        $component = Components::where('name', 'home-banner')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        if (!empty($component)) 
            return view('components.front.section.home-banner');
    }
}
