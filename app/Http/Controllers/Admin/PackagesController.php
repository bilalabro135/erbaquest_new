<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Package;
use DataTables;
use Bouncer;
use Redirect;

class PackagesController extends Controller
{
    public function index(){
        return view('admin.packages.index');
    }

    public function getpackages()
    {
        $model = Package::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
                if(Bouncer::can('updatePackages')){
                    $actionBtn .='<a href="' . route('packages.edit', ['package' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deletePackages')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('packages.delete', ['package' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })

        ->rawColumns(['action'])
        ->toJson();
    }

    public function create()
    {
        return view('admin.packages.add');
    }
}
