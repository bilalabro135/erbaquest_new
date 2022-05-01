<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SponsorRequest;

use App\Models\Sponsor;
use DataTables;
use Bouncer;
use Redirect;


class SponsorController extends Controller
{
    public function index(){
        return view('admin.sponsors.index');
    }
    public function getsponsors()
    {
        $model = Sponsor::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updateSponsors')){
                    $actionBtn .='<a href="' . route('sponsors.edit', ['sponsor' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteSponsors')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('sponsors.delete', ['sponsor' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        return view('admin.sponsors.add');
    }

    public function store(SponsorRequest $request)
    {
        $sponsor = new Sponsor();
        $sponsor->name = $request->name;
        $sponsor->featured_image = str_replace(env('APP_URL'),"",$request->featured_image) ;
        $sponsor->order = $request->order;
        $sponsor->external_url = $request->url;
        $sponsor->save();
        return Redirect::route('sponsors')->with(['msg' => 'Sponsor Inserted', 'msg_type' => 'success']);
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.edit', compact('sponsor'));
    }

    public function update(SponsorRequest $request, Sponsor $sponsor)
    {
        $sponsor->update([
            'name' => $request->name,
            'featured_image' => str_replace(env('APP_URL'),"",$request->featured_image),
            'order' => $request->order,
        ]);

        return Redirect::route('sponsors')->with(['msg' => 'Sponsor Updated', 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $sponsor = Sponsor::where('id', $id)->delete();
        if ($sponsor) {
            return Redirect::back()->with(['msg' => 'Sponsor deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }
}
