<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Bouncer;
use Redirect;

use App\Models\Amenity;
use App\Http\Requests\Admin\AmenitiesRequest;

class AmenitiesController extends Controller
{
    public function index(){
        return view('admin.amenities.index');
    }

    public function getamenities()
    {
        $model = Amenity::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updateAmenities')){
                    $actionBtn .='<a href="' . route('amenities.edit', ['amenity' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteAmenities')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('amenities.delete', ['amenity' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
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

    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(AmenitiesRequest $request, Amenity $amenity)
    {
        $amenity->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);
        return Redirect::route('amenities')->with(['msg' => 'Amenity Updated', 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $amenities = Amenity::where('id', $id)->delete();
        if ($amenities) {
            return Redirect::route('amenities')->with(['msg' => 'Amenity deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

}
