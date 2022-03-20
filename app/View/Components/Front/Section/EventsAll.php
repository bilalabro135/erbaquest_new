<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;
use App\Models\Pages;
use App\Models\User;
use App\Models\WishLists;

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
        $user = Auth::user();
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
        $events = array();
        $getevents = $event->get();

        if( count($getevents) ){
            foreach ($getevents as $getevent) {
                $isWishList = 0;
                if($user){
                    $wishlistExist = WishLists::where('event_id', '=', $getevent['id'])->where('user_id', '=', $user->id)->first();
                    if ($wishlistExist !== null) {
                        $isWishList = 1;
                    }
                }
                $user_data = User::where("id","=",$getevent['user_id'])->first();
                if($user_data['profile_image']){
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
                );
            }
        }
        
        $this->events = $events;
        $this->pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        // dd($events);
        return view('components.front.section.events-all');
    }
}
