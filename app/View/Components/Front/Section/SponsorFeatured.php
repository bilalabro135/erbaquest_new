<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Sponsor;

class SponsorFeatured extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $this->sponsors = Sponsor::orderBy('order', 'ASC')->get();
        if (count($this->sponsors)) 
            return view('components.front.section.sponsor-featured');
    }
}
