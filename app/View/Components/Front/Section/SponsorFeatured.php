<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Sponsor;
use App\Models\Components;


class SponsorFeatured extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $fields;
    public $sponsors;
    public function __construct()
    {

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
        $this->sponsors = Sponsor::orderBy('order', 'ASC')->get();
        if (count($this->sponsors)) 
            return view('components.front.section.sponsor-featured');
    }
}
