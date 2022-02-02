<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AreaRequest;

use App\Models\Area;
use DataTables;
use Bouncer;
use Redirect;

class AreaController extends Controller
{
    public function index(){
        return view('admin.area.index');
    }

    public function getareas()
    {
        $model = Area::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updateAreas')){
                    $actionBtn .='<a href="' . route('areas.edit', ['area' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteAreas')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('areas.delete', ['area' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function store(AreaRequest $request)
    {
        $area = new Area();
        $area->name = $request->name;
        $area->save();
        return back()->with(['msg' => 'Area Inserted', 'msg_type' => 'success']);
    }

    public function edit(Area $area)
    {
        return view('admin.area.edit', compact('area'));
    }

    public function update(AreaRequest $request, Area $areas)
    {
        $areas->update([
            'name' => $request->name,
        ]);
        return Redirect::route('areas')->with(['msg' => 'Area Updated', 'msg_type' => 'success']);
    }

    public function destroy($id)
    {
        $area = Area::where('id', $id)->delete();
        if ($area) {
            return Redirect::route('areas')->with(['msg' => 'Area deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

}
