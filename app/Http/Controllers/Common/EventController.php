<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Requests\Common\FrontEventRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Pages;
use App\Models\Event;
use App\Models\Amenity;
use Validator;
use DataTables;
use Bouncer;
use Redirect; 
use View;
class EventController extends Controller
{
    public function index(){
        return view('admin.events.index');
    }
    public function frontindex(){
        return view('components.front.section.events-all');
    }

    public function getevents()
    {
        $model = Event::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updatePackages')){
                    $actionBtn .='<a href="' . route('events.edit', ['event' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteevents')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('events.delete', ['event' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })
        ->addColumn('organizer', function($row){
            return $row->organizer->value('name');
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        $users = User::whereIs('Admin', 'Organizer')->get();
        $vendors = User::whereIs('Vendor')->get();
        $amenities = Amenity::all();
        return view('admin.events.add', compact('users', 'vendors', 'amenities'));
    }

    public function frontcreate()
    {
        $users = User::whereIs('Admin', 'Organizer')->get();
        $vendors = User::whereIs('Vendor')->get();
        $amenities = Amenity::all();
        return view('tempview/create-event', compact('users', 'vendors', 'amenities'));
    }

    public function store(EventRequest $request)
    {
        $eventDetail = $request->getEventData();
        $event = new Event();
        $event->name = $eventDetail['name'] ;
        $event->slug = $eventDetail['slug'] ;
        $event->featured_image =  str_replace(env('APP_URL'),"",$eventDetail['featured_image']) ;
        $event->gallery = $eventDetail['gallery'];
        $event->description = $eventDetail['description'];
        $event->event_date = $eventDetail['event_date'];
        $event->address = $eventDetail['address'];
        $event->type = $eventDetail['type'];
        $event->door_dontation = $eventDetail['door_dontation'];
        $event->vip_dontation = $eventDetail['vip_dontation'];
        $event->vip_perk = $eventDetail['vip_perk'];
        $event->charity = $eventDetail['charity'];
        $event->cost_of_vendor = $eventDetail['cost_of_vendor'];
        $event->vendor_space_available = $eventDetail['vendor_space_available'];
        $event->area = $eventDetail['area'];
        $event->height = $eventDetail['height'];
        $event->capacity = $eventDetail['capacity'];
        $event->ATM_on_site = $eventDetail['ATM_on_site'];
        $event->tickiting_number = $eventDetail['tickiting_number'];
        $event->vendor_number = $eventDetail['vendor_number'];
        $event->user_number = $eventDetail['user_number'];
        $event->website_link = $eventDetail['website_link'];
        $event->user_id = $eventDetail['user_id'];
        $event->facebook = $eventDetail['facebook'];
        $event->twitter = $eventDetail['twitter'];
        $event->linkedin = $eventDetail['linkedin'];
        $event->instagram = $eventDetail['instagram'];
        $event->youtube = $eventDetail['youtube'];
        $event->status = $eventDetail['status'];
        $event->save();

        if($request->has('vendors'))
            $event->vendors()->attach($request->vendors);

        if($request->has('amenities'))
            $event->amenities()->attach($request->amenities);

        return Redirect::route('events')->with(['msg' => 'Event Inserted', 'msg_type' => 'success']);
    }

    public function frontstore(FrontEventRequest $request)
    {
        $eventDetail = $request->getEventData();
        // dd($eventDetail);
        $gallery_img = array();
        $event = new Event();
        $event->name = $eventDetail['name'] ;
        $event->slug = $eventDetail['slug'] ;
        $event->featured_image = $request->file('featured_image')->store('public/images');

        // $event->gallery[] = $request->file('gallery')->store('public/images');
        // dd($gallery);

        $event->description = $eventDetail['description'];
        $event->event_date = $eventDetail['event_date'];
        $event->address = $eventDetail['address'];
        $event->type = $eventDetail['type'];
        $event->door_dontation = $eventDetail['door_dontation'];
        $event->vip_dontation = $eventDetail['vip_dontation'];
        $event->vip_perk = $eventDetail['vip_perk'];
        $event->charity = $eventDetail['charity'];
        $event->cost_of_vendor = $eventDetail['cost_of_vendor'];
        $event->vendor_space_available = $eventDetail['vendor_space_available'];
        $event->area = $eventDetail['area'];
        $event->height = $eventDetail['height'];
        $event->capacity = $eventDetail['capacity'];
        $event->ATM_on_site = $eventDetail['ATM_on_site'];
        $event->tickiting_number = $eventDetail['tickiting_number'];
        $event->vendor_number = $eventDetail['vendor_number'];
        $event->user_number = $eventDetail['user_number'];
        $event->website_link = $eventDetail['website_link'];
        $event->facebook = $eventDetail['facebook'];
        $event->twitter = $eventDetail['twitter'];
        $event->linkedin = $eventDetail['linkedin'];
        $event->instagram = $eventDetail['instagram'];
        $event->youtube = $eventDetail['youtube'];
        $event->status = $eventDetail['status'];

        $user = Auth::user();
        $event->user_id = $user->id;
        $event->save();

        // echo '<pre>'; print_r($request->vendors); echo '</pre>'; exit;

        if($request->has('vendors'))
            $event->vendors()->attach($request->vendors);

        if($request->has('amenities'))
            $event->amenities()->attach($request->amenities);

        return Redirect::route('front.events')->with(['msg' => 'Event Inserted', 'msg_type' => 'success']);
    }

    public function edit(Event $event)
    {
        $users = User::whereIs('Admin', 'Organizer')->get();
        $vendors = User::whereIs('Vendor')->get();
        $amenities = Amenity::all();
        return view('admin.events.edit', compact('users', 'vendors', 'event', 'amenities'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $eventDetail = $request->getEventData();
        $event->update([
            'name' =>  $eventDetail['name'],
            'slug' =>  $eventDetail['slug'],
            'featured_image' =>  str_replace(env('APP_URL'),"",$eventDetail['featured_image'])  ,
            'gallery' =>  $eventDetail['gallery'],
            'description' =>  $eventDetail['description'],
            'event_date' =>  $eventDetail['event_date'],
            'address' =>  $eventDetail['address'],
            'type' =>  $eventDetail['type'],
            'door_dontation' =>  $eventDetail['door_dontation'],
            'vip_dontation' =>  $eventDetail['vip_dontation'],
            'vip_perk' =>  $eventDetail['vip_perk'],
            'charity' =>  $eventDetail['charity'],
            'cost_of_vendor' =>  $eventDetail['cost_of_vendor'],
            'vendor_space_available' =>  $eventDetail['vendor_space_available'],
            'area' =>  $eventDetail['area'],
            'height' =>  $eventDetail['height'],
            'capacity' =>  $eventDetail['capacity'],
            'ATM_on_site' =>  $eventDetail['ATM_on_site'],
            'tickiting_number' =>  $eventDetail['tickiting_number'],
            'vendor_number' =>  $eventDetail['vendor_number'],
            'user_number' =>  $eventDetail['user_number'],
            'website_link' =>  $eventDetail['website_link'],
            'user_id' =>  $eventDetail['user_id'],
            'facebook' =>  $eventDetail['facebook'],
            'twitter' =>  $eventDetail['twitter'],
            'linkedin' =>  $eventDetail['linkedin'],
            'instagram' =>  $eventDetail['instagram'],
            'youtube' =>  $eventDetail['youtube'],
            'status' =>  $eventDetail['status'],
        ]);

        if($request->has('vendors'))
            $event->vendors()->sync($request->vendors);
        else
            $event->vendors()->sync(array());
        
        if($request->has('amenities'))
            $event->amenities()->sync($request->amenities);
        else
            $event->amenities()->sync(array());
        
        return Redirect::route('events')->with(['msg' => 'Event Updated', 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)->delete();
        if ($event) {
            return Redirect::back()->with(['msg' => 'Event deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function loadmore(Request $request)
    {
        $validation = Validator::make($request->all(),[
          'offset' => 'required|integer',
          'limit' => 'integer',
        ]);
        if ($validation->fails())
        {
            return response()->json(['error', 'Paramaters Validation Failed']);
        }
        $events = Event::where('status', 'published');

        if (isset($request->featured) && $request->featured != 'false') {
            $events->where('is_featured', 1);
        }
        if(isset($request->upcoming) && $request->upcoming  != 'false')
            $events->whereDate('event_date', '>', $now) ;

        if(isset($request->past) && $request->past  != 'false')
            $events->whereDate('event_date', '<', $now) ;


        $count = $events->count();
        $request->limit = ($request->limit) ? $request->limit : 9; 
        $events = $events->offset($request->offset)->limit($request->limit)->get();
        $loadmore = false;
        $data['loadmore'] = false;
        if ($count > ($request->offset + $request->limit)) {
            $data['loadmore'] = true;
        }
        $pageSlug = Pages::where('template', 'events')->where('status', 'published')->value('slug');
        $data['html'] = view('components.front.events.listing',  compact('events', 'loadmore', 'pageSlug'))->render();
        return response()->json($data);
    }
    public function show(Pages $pages, $id)
    {
        $event = Event::where('id', $id)->first();
        if ($event != null) {
            return view('front.event.show', compact('event', 'pages'));
        }
        abort(404);
    }
}
