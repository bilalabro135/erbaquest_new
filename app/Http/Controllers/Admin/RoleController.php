<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Validator;
use Redirect;
use Bouncer;
use Silber\Bouncer\Bouncer as BouncerBouncer;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index');
    }
    public function getRoles()
    {
  
        $model = Roles::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
            $actionBtn = "";
            // if($row->id != Session::get('id') && $row->id != 1){
                if(Bouncer::can('updateRoles') && $row->id != 1){
                    $actionBtn .='<a href="' . route('roles.edit', ['id' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteUsers') && $row->id != 1){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('roles.delete', ['id' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
            // }
        })
        ->rawColumns(['action'])
        ->toJson();
    }


    public function create()
    {
        return view('admin.roles.add');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        if ($request->has('permission') ) {  
            foreach($request->permission as $key => $value){  
               Bouncer::allow($request->name)->to($key);
            }  
        }
        else{
            Bouncer::allow($request->name)->to('noPermission');
        }
       return Redirect::route('roles')->with(['msg' => 'Roles Created', 'msg_type' => 'success']);
    }

    public function show($id)
    {
     
    }

    public function edit($id)
    {
        $role =Bouncer::role()->find($id);
        $abilitiesarray=$role->getAbilities()->pluck('name')->toArray();
        return view('admin.roles.edit',compact('role','abilitiesarray'));

    }

    public function update(Request $request, $id)
    {
        if ($id != 1):
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);      
        $role =Bouncer::role()->find($id);
        $role->name = $request->name;
        $role->title = $request->name;
        $role->save();
        Bouncer::sync($role)->abilities([]);
        if ($request->has('permission') ) {            
            foreach($request->permission as $key => $value){
                Bouncer::allow($role)->to($key);         
            }
        }
        else{
            Bouncer::allow($request->name)->to('noPermission');
        }
        return Redirect::route('roles')->with(['msg' => 'Roles Updated', 'msg_type' => 'success']);
        else:
            abort(404);
        endif;

    }

    public function destroy($id)
    {
        if ($id != 1) {
            Bouncer::role()->find($id)->delete();
            return Redirect::route('roles')->with(['msg' => 'Roles Deleted', 'msg_type' => 'success']);
        }
        else{
            abort(404);
        }

    }
}
