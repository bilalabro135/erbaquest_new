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
        $search    = (app('request')->input('search')) ? app('request')->input('search') : '';
        $location    = (app('request')->input('location')) ? app('request')->input('location') : '';
        $sort    = (app('request')->input('sort')) ? app('request')->input('sort') : '';
        $event = Event::where('status', 'published');
        if ($search != '') 
            $event->where('name', 'LIKE', "%{$search}%");

        if ($location != '') 
            $event->where('area', $location);

        if ($sort != '') {
            if($sort == 'latest'){
                $event->orderBy('id', 'ASC');
            }
            else{
                $event->orderBy($sort, 'ASC');
            }
        }
        
        $this->events = $event->get();
        $this->pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        return view('components.front.section.events-all');
    }
}
