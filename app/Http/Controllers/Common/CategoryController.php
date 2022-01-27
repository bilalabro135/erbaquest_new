<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\Category\CategoryRequest;
use DataTables;
use Redirect;
use Bouncer;
use Route;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_cats = Category::all();
        return view('admin.category.index', compact('parent_cats'));
    }
    public function getCategory()
    {
        $model = Category::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
             $actionBtn = '';
            if (Route::has('pages.front')) {
            $actionBtn = '<a class="btn-circle btn btn-sm btn-primary mr-1" href="' .route('categories.front', ['slug' => $row->slug]). '"><i class="fas fa-eye"></i></a>';
        }
                if(Bouncer::can('updateCategories')){
                    $actionBtn .='<a href="' . route('categories.edit', ['category' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteCategories')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('categories.delete', ['category' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })
        ->addColumn('parent', function($row){
            $par = $row->parent()->select('name')->first();
            return $par['name'];
        })
        ->rawColumns(['action'])
        ->toJson();
    }


    public function store(CategoryRequest $request)
    {
        $CategoryRequest = $request->getCategoryData();        
        $Category = new Category;
        $Category->name = $CategoryRequest['name'];
        $Category->slug = $CategoryRequest['slug'];
        $Category->description = $CategoryRequest['description'];
        $Category->featured_image = $CategoryRequest['featured_image'];
        $Category->parent_id = $CategoryRequest['parent_id'];
        $Category->save();
        return Redirect::route('categories')->with(['msg' => 'Category added', 'msg_type' => 'success']);
    }

    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $parent_cats = Category::all();
        return view('admin.category.edit', compact('category', 'parent_cats'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $CategoryRequest = $request->getCategoryData();
        $category->update([
            'name' => $CategoryRequest['name'],
            'slug' => $CategoryRequest['slug'],
            'description' => $CategoryRequest['description'],
            'featured_image' => $CategoryRequest['featured_image'],
        ]);
        return Redirect::route('categories')->with(['msg' => 'Category Updated', 'msg_type' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->delete();
        if ($category) {
            return Redirect::route('categories')->with(['msg' => 'Category deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }
}
