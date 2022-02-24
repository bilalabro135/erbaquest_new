<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Event;

class EventsAll extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $events;
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
        $this->events = Event::where('status', 'published')->get();
        return view('components.front.section.events-all');
    }
}
