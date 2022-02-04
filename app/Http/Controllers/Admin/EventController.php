<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EventRequest;

use App\Models\Event;
use DataTables;
use Bouncer;
use Redirect; 

class EventController extends Controller
{
    public function index(){
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

        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        return view('admin.events.add');
    }
}
