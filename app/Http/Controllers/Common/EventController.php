<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Requests\Admin\EventTypeRequest;
use App\Http\Requests\Common\FrontEventRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Pages;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Amenity;
use App\Models\EventAmenity;
use App\Models\Vendor;
use App\Models\Area;
use App\Models\WishLists;
use Validator;
use DataTables;
use Bouncer;
use Redirect; 
use View;
class EventController extends Controller
{
    public function index()
    {
        return view('admin.events.index');
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
        $tyoesOfEvents = EventType::all();
        $countries = Area::all();
        return view('admin.events.add', compact('users', 'vendors', 'amenities', 'tyoesOfEvents','countries'));
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

    public function edit(Event $event)
    {
        $users = User::whereIs('Admin', 'Organizer')->get();
        $vendors = User::whereIs('Vendor')->get();
        $amenities = Amenity::all();
        $tyoesOfEvents = EventType::all();
        $countries = Area::all();
        return view('admin.events.edit', compact('users', 'vendors', 'event', 'amenities', 'tyoesOfEvents','countries'));
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

    public function frontindex()
    {
        $events = Event::all();
        $pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        return view('components.front.section.events-all', compact('events', 'pageSlug'));
    }

    public function frontcreate()
    {
        $users = User::whereIs('Admin', 'Organizer')->get();
        $vendors = User::whereIs('Vendor')->get();
        $amenities = Amenity::all();
        $tyoesOfEvents = EventType::all();
        $countries = Area::all();
        return view('tempview/create-event', compact('users', 'vendors', 'amenities','tyoesOfEvents','countries'));
    }

    public function frontstore(FrontEventRequest $request)
    {
        $eventDetail = $request->getEventData();
        $gallery_img = array();
        $event = new Event();
        $event->name = $eventDetail['name'] ;
        $event->slug = $eventDetail['slug'] ;
         $fname = $request->file('featured_image')->getClientOriginalName();
            $request->file('featured_image')->move(public_path().'/uploads/', $fname);     
        $event->featured_image =  'uploads/' . $fname;
        
         $image_names = [];
        // loop through images and save to /uploads directory
        foreach ($request->file('gallery') as $image) {
            $name = $image->getClientOriginalName();
            $image->move(public_path().'/uploads/', $name);  
            $image_names[] = array('url' =>  'uploads/' . $name, 'alt' => '');
        }
        $event->gallery = serialize($image_names);

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

        //adding vendor id and event id in in vendor table
        if ($eventDetail['vendor_list']) {
            foreach ($eventDetail['vendor_list'] as $vendorId) {  //vendor_list
                $vendor = new Vendor();
                $vendor->event_id = $event->id;
                $vendor->user_id = $vendorId;
                $vendor->save();
            } 
        }

        if($request->has('amenities'))
            $event->amenities()->attach($request->amenities);

        if ($eventDetail['status'] == 'draft') {
            $baseUrl = config('app.url')."events/".$event->id;
            return redirect($baseUrl);
        }
        $pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        return Redirect::route('pages.show', ['pages' => $pageSlug])->with(['msg' => 'Event Inserted', 'msg_type' => 'success']);
    }

    public function frontedit(Event $event)
    {
        $events = Event::where('user_id', Auth::user()->id)->where('status',"=","published")->orderBy('event_date','ASC')->get();

        $user = Auth::user();
        
        if($user->profile_image){
            $profile_image = env('APP_URL') .$user['profile_image'];
        }else{
            $profile_image = "";
        }

        return view('tempview.edit-event', compact('events','profile_image'));
    }

    public function myevents(Event $event)
    {
        $events = Event::where('user_id', Auth::user()->id)->where('status',"=","published")->orderBy('event_date','ASC')->get();

        $user = Auth::user();
        
        if($user->profile_image){
            $profile_image = env('APP_URL') .$user['profile_image'];
        }else{
            $profile_image = "";
        }

        return view('tempview.my-event', compact('events','profile_image'));
    }

    public function updateevent($id)
    {
        $getevents  =  Event::findorFail($id);
        $data = array();
        if($getevents){
            $gallery_data = unserialize($getevents['gallery']);
            $data = array(
                'id' => $getevents['id'],
                'name' => $getevents['name'],
                'slug' => $getevents['slug'],
                'featured_image' => $getevents['featured_image'],
                'description' => $getevents['description'],
                'gallery' => $gallery_data,
                'event_date' => $getevents['event_date'],
                'address' => $getevents['address'],
                'type' => $getevents['type'],
                'door_dontation' => $getevents['door_dontation'],
                'vip_dontation' => $getevents['vip_dontation'],
                'vip_perk' => $getevents['vip_perk'],
                'charity' => $getevents['charity'],
                'cost_of_vendor' => $getevents['cost_of_vendor'],
                'vendor_space_available' => $getevents['vendor_space_available'],
                'area' => $getevents['area'],
                'height' => $getevents['height'],
                'capacity' => $getevents['capacity'],
                'ATM_on_site' => $getevents['ATM_on_site'],
                'tickiting_number' => $getevents['tickiting_number'],
                'vendor_number' => $getevents['vendor_number'],
                'user_number' => $getevents['user_number'],
                'website_link' => $getevents['website_link'],
                'facebook' => $getevents['facebook'],
                'twitter' => $getevents['twitter'],
                'linkedin' => $getevents['linkedin'],
                'instagram' => $getevents['instagram'],
                'youtube' => $getevents['youtube'],
                'status' => $getevents['status'],
                'user_id' => $getevents['user_id'],
                'created_at' => $getevents['created_at'],
                'updated_at' => $getevents['updated_at'],
                'deleted_at' => $getevents['deleted_at'],
            );
        };

        $getSelectedVendorIds = Vendor::where("event_id",$getevents['id'])->get();
        $setectedvendor = array();
        if(count($getSelectedVendorIds)){
            foreach ($getSelectedVendorIds as $getSelectedVendorId) {
                 $setectedvendor[] = $getSelectedVendorId['user_id'];
            }
        }

        $getvendors = User::whereIs('Vendor')->get();
        $vendors = array();
        if(count($getvendors)){
            foreach ($getvendors as $getvendor) {
                $selected = 0;
                if( in_array($getvendor['id'], $setectedvendor) ){
                    $selected = 1;
                } 
                $vendors[] = array(
                    'id'   => $getvendor['id'],
                    'name' => $getvendor['name'],
                    'selected' => $selected,
                );
            }
        }

        $getSelectedAmenities = EventAmenity::where("event_id",$getevents['id'])->get();
        //dd($getSelectedAmenities);
        $setectedameties = array();
        if(count($getSelectedAmenities)){
            foreach ($getSelectedAmenities as $getSelectedAmenity) {
                 $setectedameties[] = $getSelectedAmenity['amenity_id'];
            }
        }

        $allamanitis = Amenity::all();
        $amenities = array();
        if(count($allamanitis)){
            foreach ($allamanitis as $allamanity) {
                $selected = 0;
                if( in_array($allamanity['id'], $setectedameties) ){
                    $selected = 1;
                } 
                $amenities[] = array(
                    'id'   => $allamanity['id'],
                    'name' => $allamanity['name'],
                    'icon' => $allamanity['icon'],
                    'selected' => $selected,
                );
            }
        }

       // setectedameties    
        $tyoesOfEvents = EventType::all();
        $countries = Area::all();


        return view('tempview.update-event', compact('data', 'vendors', 'amenities', 'tyoesOfEvents','countries'));
    }
    public function frontupdate(FrontEventRequest $request, Event $event)
    {       
        $eventDetail = $request->getEventData();
        $featured_image = ($eventDetail['featured_image'] != '') ? str_replace(env('APP_URL'),"",$eventDetail['featured_image']) : $event->featured_image;

        $gallery = ($eventDetail['gallery'] != '') ? $eventDetail['gallery'] : $event->gallery;

        if($request->featured_image){
            $fname = time().".".$request->featured_image->extension();
            $request->file('featured_image')->move(public_path().'/uploads/', $fname);     
            $event->featured_image =  'uploads/' . $fname;
            $featured_image = 'uploads/' . $fname;
        }
        if($request->gallery){
            foreach ($request->file('gallery') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path().'/uploads/', $name);  
                $image_names[] = array('url' =>  'uploads/' . $name, 'alt' => '');
            }
            $gallery = serialize($image_names);
        }

        $event->update([
            'name' =>  $eventDetail['name'],
            'slug' =>  $eventDetail['slug'],
            'featured_image' =>  $featured_image,
            'gallery' =>  $gallery,
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
            'facebook' =>  $eventDetail['facebook'],
            'twitter' =>  $eventDetail['twitter'],
            'linkedin' =>  $eventDetail['linkedin'],
            'instagram' =>  $eventDetail['instagram'],
            'youtube' =>  $eventDetail['youtube'],
            'status' =>  $eventDetail['status'],
        ]);

        //adding vendor id and event id in in vendor table
        Vendor::where('event_id', $event->id)->delete();
        if ($eventDetail['vendor_list']) {
            foreach ($eventDetail['vendor_list'] as $vendorId) {  //vendor_list
                $vendor = new Vendor();
                $vendor->event_id = $event->id;
                $vendor->user_id = $vendorId;
                $vendor->save();
            } 
        }


        
        if($request->has('amenities'))
            $event->amenities()->sync($request->amenities);
        else
            $event->amenities()->sync(array());
        
        
        if ($eventDetail['status'] == 'draft') {
            $baseUrl = config('app.url')."events/".$event->id;
            return redirect($baseUrl);
        }

        return Redirect::route('pages.show', ['pages' => 'events'])->with(['msg' => 'Event Updated', 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)->delete();
        WishLists::where('event_id', $id)->delete();
        if ($event) {
            return Redirect::back()->with(['msg' => 'Event deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function frontdestroy($id)
    {
        $event = Event::where('id', $id)->delete();
        WishLists::where('event_id', $id)->delete();
        if ($event) {
            return Redirect::back()->with(['msg' => 'Event deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function loadmore(Request $request)
    {
        $now = date('Y-m-d');
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
        $pageSlug = Pages::where('template', 'event')->where('status', 'published')->value('slug');
        $data['html'] = view('components.front.events.listing',  compact('events', 'loadmore', 'pageSlug'))->render();
        return response()->json($data);
    }

    public function show(Pages $pages, $id)
    {
        $event = Event::where('id', $id)->first();

        $user = Auth::user();
        $InWishList = 0;
        if($user){
            $wishlistExist = WishLists::where('event_id', '=', $id)->where('user_id', '=', $user->id)->get();
            if(count($wishlistExist)){
                $InWishList = 1;
            }
        }
        $action_edit = url("/events/{$id}/edit");
        $action_status = url("/events/publish/{$id}");
        $action_delete = url("/events-draft/delete/{$id}");
        
        if ($event != null) {
            return view('front.event.show', compact('event', 'pages','action_edit','action_status','action_delete','InWishList'));
        }
        abort(404);
    }

    public function frontDraftDestroy($id)
    {
        $event = Event::where('id', $id)->delete();
        WishLists::where('event_id', $id)->delete();
        if ($event) {
            return Redirect::route('draft.account')->with(['msg' => 'Event deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function typeeventindex(){
        return view('admin.events.event-type');
    }

    public function geteventtype()
    {
        $model = EventType::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updateEventType')){
                    $actionBtn .='<a href="' . route('event.type.edit', ['event_type' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteEventType')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('event.type.delete', ['event_type' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function storeeventtype(EventTypeRequest $request)
    {
        $event_type = new EventType();
        $event_type->name = $request->name;
        $event_type->save();
        return back()->with(['msg' => 'Event Type Inserted', 'msg_type' => 'success']);
    }

    public function editeventtype(EventType $EventType)
    {
        return view('admin.events.edit-event-type', compact('event_type'));
    }

    public function updateeventtype(EventTypeRequest $request, EventType $EventType)
    {
        $event_type->update([
            'name' => $request->name,
        ]);
        return Redirect::route('event.type')->with(['msg' => 'Event Type Updated', 'msg_type' => 'success']);
    }
    public function destroyeeventtype($id)
    {
        $event_type = EventType::where('id', $id)->delete();
        if ($event_type) {
            return Redirect::route('event.type')->with(['msg' => 'Event Type deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function publishDraft($id)
    {
        Event::where('id', $id)
       ->update([
           'status' => 'published'
        ]);

        return Redirect("/events")->with(['msg' => 'Event Updated', 'msg_type' => 'success']);    
   }

   public function upcomingEvent()
   {
        $now = date('Y-m-d');
        $events = Event::where('status', 'published')->where('user_id', Auth::user()->id)->whereDate('event_date', '>', $now)->get();
        return view('tempview.upcoming-event', compact('events'));   
   }
   public function draftEvent()
   {
        $events = Event::where('status', 'draft')->where('user_id', Auth::user()->id)->get();
        return view('tempview.draft-event', compact('events',));   
   }
   public function pastEvent()
   {
        $now = date('Y-m-d');
        $events = Event::where('status', 'published')->where('user_id', Auth::user()->id)->whereDate('event_date', '<', $now)->get(); //
        return view('tempview.past-event', compact('events'));   
   }
}
