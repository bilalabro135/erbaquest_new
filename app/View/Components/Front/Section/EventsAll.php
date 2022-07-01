<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;
use App\Models\Pages;
use App\Models\User;
use App\Models\WishLists;
use DB;

class EventsAll extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $events;
    public $pageSlug;
    public $selectedParameter;
    public $past;
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
        $now = date('Y-m-d');
        $user = Auth::user();
        $search    = (app('request')->input('search')) ? app('request')->input('search') : '';
        $location    = (app('request')->input('location')) ? app('request')->input('location') : '';
        $sort    = (app('request')->input('sort')) ? app('request')->input('sort') : 'event_date';
        $amenities    = (app('request')->input('amenities')) ? app('request')->input('amenities') : '';
        $event = Event::where('status', 'published');

        //$event->whereDate('event_date', '>', $now);

        if($this->past  != false)
            

        if ($search != '')
            $event->where('name', 'LIKE', "%{$search}%");

        if ($location != '')
            $event->where('area', $location);

        if ($sort != '') {
            if($sort == 'latest'){
                $event->orderBy('id', 'DESC');
            }
            else{
                $event->orderBy($sort, 'ASC');
            }
        }
        $explodeAm = array();

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

        $getevents = $event->get();

        $events = array();
        if( count($getevents) ){
            foreach ($getevents as $getevent) {
                if($getevent['event_date'] > $now || $getevent['is_recurring']){
                    $isWishList = 0;
                    if($user){
                        $wishlistExist = WishLists::where('event_id', '=', $getevent['id'])->where('user_id', '=', $user->id)->first();
                        if ($wishlistExist !== null) {
                            $isWishList = 1;
                        }
                    }
                    $user_data = User::where("id","=",$getevent['user_id'])->first();
                    if(isset($user_data['profile_image'])){
                        $profile_image = env('APP_URL') .$user_data['profile_image'];
                    }else{
                        $profile_image = "";
                    }
                    $events[] = array(
                        'id' => $getevent['id'],
                        'name' => $getevent['name'],
                        'slug' => $getevent['slug'],
                        'isWishList' => $isWishList,
                        'featured_image' => $getevent['featured_image'],
                        'description' => $getevent['description'],
                        'event_date' => $getevent['event_date'],
                        'area' => $getevent['area'],
                        'user_profile' => $profile_image,
                        'is_recurring' => $getevent['is_recurring'],
                        'day_dropdown' => $getevent['day_dropdown'],
                        'recurring_type' => $getevent['recurring_type'],
                        'featured'     =>   $getevent['featured'],
                    );       
                }
            }
        }
        $this->selectedParameter = $explodeAm;
        $this->events = $events;
        $this->pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        // dd($events);
        return view('components.front.section.events-all');
    }
}
