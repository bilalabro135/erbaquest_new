<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Bouncer;
use Redirect;

use App\Models\Contact;
use Mail; 
use App\Http\Requests\Common\ContactRequest;

class ContactController extends Controller
{
    public function index(){

        return view('admin.contact.index');
    }

    public function getContact()
    {
        $model = Contact::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                //if(Bouncer::can('updateAmenities')){
                   // $actionBtn .='<a href="' . route('amenities.edit', ['amenity' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
               // }
               // if(Bouncer::can('deleteAmenities')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('contact.delete', ['contact' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
              //  }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function store(AmenitiesRequest $request)
    {
        $amenity = new Amenity();
        $amenity->name = $request->name;
        $amenity->icon = $request->icon;
        $amenity->save();
        return back()->with(['msg' => 'Amenity Inserted', 'msg_type' => 'success']);
    }

    // public function edit(Amenity $amenity)
    // {
    //     return view('admin.amenities.edit', compact('amenity'));
    // }

    // public function update(AmenitiesRequest $request, Amenity $amenity)
    // {
    //     $amenity->update([
    //         'name' => $request->name,
    //         'icon' => $request->icon,
    //     ]);
    //     return Redirect::route('amenities')->with(['msg' => 'Amenity Updated', 'msg_type' => 'success']);
    // }

    public function destroy($id)
    {
        $newsletter = Contact::where('id', $id)->delete();
        if ($newsletter) {
            return Redirect::route('admin.contact')->with(['msg' => 'Contact Message deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function contactForm() 
    { 
        return view('tempview.contact'); 
    } 

    public function sendEmail(ContactRequest $request)
    {
        $input = $request->all(); 
        Contact::create($input); 

        //  Send mail to admin 
        Mail::send('tempview/contactMail', array( 
            'first_name' => $input['first_name'], 
            'last_name' => $input['last_name'], 
            'email' => $input['email'], 
            'subject' => $input['subject'], 
            'message' => $input['message'], 
        ), function($message) use ($request){ 
            $message->from($request->email); 
            $message->to('areeb.ghouri@geeksroot.com', 'Admin')->subject($request->get('subject')); 
        }); 
        return redirect()->back()->with(['msg' => 'Contact Form Submit Successfully']);
    }

}
