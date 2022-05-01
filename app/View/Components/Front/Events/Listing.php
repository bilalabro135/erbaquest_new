<?php

namespace App\View\Components\Front\Events;

use Illuminate\View\Component;
use App\Models\Event;
use App\Models\Pages;
use App\Models\User;
class Listing extends Component
{
    public $events;
    public $featured;
    public $offset;
    public $limit;
    public $loadmore;
    public $upcoming;
    public $past;
    public $pageSlug;
    public function __construct($featured = false, $offset = 0, $limit = 9, $loadmore = false, $upcoming = false, $past = false)
    {
        $this->featured = $featured;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->loadmore = $loadmore;
        $this->upcoming = $upcoming;
        $this->past = $past;
    }

    public function render()
    {
        $events = Event::where('status', 'published');
        $now = date('Y-m-d');

        if($this->featured != false)
            $events->where('featured', "1");

        if($this->upcoming  != false)
            $events->whereDate('event_date', '>', $now) ;

        if($this->past  != false)
            $events->whereDate('event_date', '<', $now) ;

        $count = $events->count();

        if($this->offset)
            $events->offset($this->offset);

        if($this->limit)
            $events->limit($this->limit);

        if($count > ($this->offset + $this->limit))
            $this->loadmore = true;

        $this->pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');

        $this->events = $events->get();

        if (count($this->events))
            return view('components.front.events.listing');
    }
}
