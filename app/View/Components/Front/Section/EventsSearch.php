<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
use App\Models\Pages;
use App\Models\Event;

class EventsSearch extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $fields;
    public $isEvent;
    public $action;
    public $search;
    public $location;
    public $sort;
    public $events_count;
    public function __construct($isEvent = false)
    {
        $this->isEvent = $isEvent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->search    = (app('request')->input('search')) ? app('request')->input('search') : '';
        $this->location    = (app('request')->input('location')) ? app('request')->input('location') : '';
        
        $event = Event::where('status', 'published');
        if ($this->search != '') 
            $event->where('name', 'LIKE', "%{$this->search}%");

        if ($this->location != '') 
            $event->where('area', $this->location);

        $this->events_count = $event->count();

        $this->sort    = (app('request')->input('sort')) ? app('request')->input('sort') : '';
        $component = Components::where('name', 'events-search')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        $this->action = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        if (!empty($component)) 
            return view('components.front.section.events-search');
    }
}
