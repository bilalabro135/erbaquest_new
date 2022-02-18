<?php

namespace App\View\Components\Front\Events;

use Illuminate\View\Component;
use App\Models\Event;
class Listing extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $featured;
    public $events;
    public function __construct($featured = false)
    {
        $this->featured = $featured;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $events = Event::where('status', 'published');
        if ($this->featured)
            $events->where('is_featured', true);
        $this->events = $events->get();
        if (count($this->events)) 
            return view('components.front.events.listing');
    }
}
