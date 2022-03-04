<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Page\PageRequest;
use App\Models\Pages;
use App\Models\User;
use Redirect;
use DataTables;
use App\Models\Settings;
use Bouncer;
use Route;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    public function getPages()
    {
        $model = Pages::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
            if (Route::has('pages.front')) {
            $actionBtn = '<a class="btn-circle btn btn-sm btn-primary mr-1" href="' .route('pages.front', ['slug' => $row->slug]). '"><i class="fas fa-eye"></i></a>';
            }
                if(Bouncer::can('updatePages')){
                    $actionBtn .='<a href="' . route('pages.edit', ['pages' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deletePages')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('pages.delete', ['pages' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })
        ->addColumn('author', function (Pages $page) {
                return $page->author->name;
        })
        ->rawColumns(['action'])
        ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $files = Storage::disk('templates')->files('');
       foreach($files as $fileIndex => $file){
            $files[$fileIndex] = str_replace(".blade.php","",$file);
       }
       $users = User::all();
       return view('admin.pages.add', compact('files','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $pageDetail = $request->getPageData();
        $page = new Pages;
        $page->name = $pageDetail['name'];
        $page->slug = $pageDetail['slug'];
        $page->template = $pageDetail['template'];
        $page->status = $pageDetail['status'];
        $page->description = $pageDetail['description'];
        $page->short_description = $pageDetail['short_description'];
        $page->meta_title = $pageDetail['meta_title'];
        $page->meta_keyword = $pageDetail['meta_keyword'];
        $page->meta_description = $pageDetail['meta_description'];
        $page->user_id = $pageDetail['user_id'];
        $page->featured_image = str_replace(env('APP_URL'),"",$pageDetail['featured_image']) ;
        $page->save();

         return Redirect::route('pages')->with(['msg' => 'Page added', 'msg_type' => 'success']);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pages $pages)
    {  
        $files = Storage::disk('templates')->files('');
        foreach($files as $fileIndex => $file){
            $files[$fileIndex] = str_replace(".blade.php","",$file);
        }
        $users = User::all();
        return view('admin.pages.edit', compact('pages', 'files','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Pages $pages)
    {
        $pageDetail = $request->getPageData();
        $pages->update([
            'name' => $pageDetail['name'],
            'slug' => $pageDetail['slug'],
            'template' => $pageDetail['template'],
            'status' => $pageDetail['status'],
            'description' => $pageDetail['description'],
            'short_description' => $pageDetail['short_description'],
            'meta_title' => $pageDetail['meta_title'],
            'meta_keyword' => $pageDetail['meta_keyword'],
            'meta_description' => $pageDetail['meta_description'],
            'user_id' => $pageDetail['user_id'],
            'featured_image' =>str_replace(env('APP_URL'),"",$pageDetail['featured_image'])  
        ]);
        return Redirect::route('pages')->with(['msg' => 'Page Updated', 'msg_type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Pages::where('id', $id)->delete();
        if ($page) {
            return Redirect::back()->with(['msg' => 'Page deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }
    public function home(){
        $Settings = Settings::get('general');
        if (isset($Settings['home_page']) && $Settings['home_page'] != 'default' && !empty($Settings['home_page'])) {
            $pages = Pages::where('slug', $Settings['home_page'])->first();

            if ($Settings['home_page'] == $Settings['blog_page']) 
                return view('front.index', compact('pages'));

            if(isset($pages->template) && view()->exists("templates.{$pages->template}"))
                return view("templates.{$pages->template}", compact('pages')); 
        }
        
        return view('front.index');
    }
    public function show(Pages $pages)
    {
        return view("templates.{$pages->template}", compact('pages'));
    }
}
