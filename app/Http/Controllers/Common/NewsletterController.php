<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Bouncer;
use Redirect;

use App\Models\Newsletter;

use App\Http\Requests\Common\NewsletterRequest;

class NewsletterController extends Controller
{
    public function index(){

        return view('admin.newsletter.index');
    }

    public function getNewsletter()
    {
        $model = Newsletter::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                //if(Bouncer::can('updateAmenities')){
                   // $actionBtn .='<a href="' . route('amenities.edit', ['amenity' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
               // }
               // if(Bouncer::can('deleteAmenities')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('newsletter.delete', ['newsletter' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
              //  }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function store(NewsletterRequest $request)
    {
        $checkNewsletter = Newsletter::where("email",$request->email)->get();
        if(count($checkNewsletter)){
            $message = 'You have already subscribed to the newsletter';
        }else{
            $newsletter = new Newsletter();
            $newsletter->email = $request->email;
            $newsletter->save();
            $message = 'You have successfully subscribed to the newsletter';
        }
        return response()->json(['msg' => $message, 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::where('id', $id)->delete();
        if ($newsletter) {
            return Redirect::route('newsletter')->with(['msg' => 'Newsletter deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

}
