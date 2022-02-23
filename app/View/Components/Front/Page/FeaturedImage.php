<?php

namespace App\View\Components\Front\Page;

use Illuminate\View\Component;

class FeaturedImage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title;
    public $image;
    public function __construct($title, $image)
    {
        $this->title = $title;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.page.featured-image');
    }
}
