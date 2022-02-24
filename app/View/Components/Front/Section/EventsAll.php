<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Event;
use App\Models\Pages;

class EventsAll extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $events;
    public $pageSlug;
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
        $this->pageSlug = Pages::where('template', 'events')->where('status', 'published')->value('slug');
        return view('components.front.section.events-all');
    }
}
