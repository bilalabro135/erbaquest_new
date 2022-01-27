<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use DataTables;
use Bouncer;
use Redirect;
use Route;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogs.index');
    }
    public function getBlogs()
    {
       $model = Blog::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
            $actionBtn = '';
            if (Route::has('blogs.front')) {
               
             $actionBtn = '<a class="btn-circle btn btn-sm btn-primary mr-1" href="' .route('blogs.front', ['slug' => $row->slug]). '"><i class="fas fa-eye"></i></a>';
            }
                if(Bouncer::can('updateBlogs')){
                    $actionBtn .='<a href="' . route('blogs.edit', ['blog' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                }
                if(Bouncer::can('deleteBlogs')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('blogs.delete', ['blog' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                }
                return $actionBtn;
        })
        ->addColumn('author', function (Blog $blog) {
                return $blog->author->name;
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
        $users = User::all();
        $categories = Category::where('parent_id', null)->get();
        return view('admin.blogs.add', compact('users', 'categories'));//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blogDetail = $request->getBlogData();
        $blog = new Blog;
        $blog->name = $blogDetail['name'];
        $blog->slug = $blogDetail['slug'];
        $blog->featured_image = $blogDetail['featured_image'];
        $blog->status = $blogDetail['status'];
        $blog->description = $blogDetail['description'];
        $blog->short_description = $blogDetail['short_description'];
        $blog->meta_title = $blogDetail['meta_title'];
        $blog->meta_keyword = $blogDetail['meta_keyword'];
        $blog->meta_description = $blogDetail['meta_description'];
        $blog->user_id = $blogDetail['user_id'];
        $blog->save();
        if($request->has('cat'))
            $blog->categories()->attach($request->cat);
        return Redirect::route('blogs')->with(['msg' => 'Blog added', 'msg_type' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $users = User::all();
        $categories = Category::where('parent_id', null)->get();
        return view('admin.blogs.edit', compact('blog', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blogDetail = $request->getBlogData();
        $blog->update([
            'name' => $blogDetail['name'],
            'slug' => $blogDetail['slug'],
            'featured_image' => $blogDetail['featured_image'],
            'status' => $blogDetail['status'],
            'description' => $blogDetail['description'],
            'short_description' => $blogDetail['short_description'],
            'meta_title' => $blogDetail['meta_title'],
            'meta_keyword' => $blogDetail['meta_keyword'],
            'meta_description' => $blogDetail['meta_description'],
            'user_id' => $blogDetail['user_id']
        ]);
        if($request->has('cat'))
            $blog->categories()->sync($request->cat);
        else
            $blog->categories()->sync(array());

        return Redirect::route('blogs')->with(['msg' => 'Blog Updated', 'msg_type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->delete();
        if ($blog) {
            return Redirect::back()->with(['msg' => 'Blog deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }
}
