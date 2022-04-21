<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use App\Models\Components;
use App\Models\Pages;
use App\Models\Event;
use App\Models\Area;

use DB;

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
    public $countries;
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
        $amenities    = (app('request')->input('amenities')) ? app('request')->input('amenities') : '';
        
        $event = Event::where('status', 'published');
        if ($this->search != '') 
            $event->where('name', 'LIKE', "%{$this->search}%");

        if ($this->location != '') 
            $event->where('area', $this->location);

        if($amenities != ""){
          $explodeAm = explode(",",$amenities);
          $ids = join("','",$explodeAm);

          $getfilteedrDatas =   DB::select("SELECT DISTINCT event_id FROM `amenities`  a LEFT JOIN `event_amenities` ea on(a.id = ea.amenity_id) where name IN ('$ids')");

           $getIds = array();
           foreach ($getfilteedrDatas as $getfilteedrData){
                $getIds[] = $getfilteedrData->event_id;
            }
            if($getIds){
                $event->whereIn('id', $getIds);
            }  
        }

        $this->events_count = $event->count();

        $this->countries = Area::orderBy('name')->get();

        $this->sort    = (app('request')->input('sort')) ? app('request')->input('sort') : '';
        $component = Components::where('name', 'events-search')->first();
        $this->fields = (isset($component->fields)) ? unserialize($component->fields) : array();
        $this->action = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        if (!empty($component)) 
            return view('components.front.section.events-search');
    }
}
