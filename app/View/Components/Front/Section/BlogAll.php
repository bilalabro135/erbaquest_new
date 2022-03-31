<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Auth;
use App\Models\Blog;
use App\Models\User;
use App\Models\Pages;
use App\Models\Category;

class BlogAll extends Component
{
    public $blogs;
    public $pageSlug;
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = Auth::user();
        $this->blogs = Blog::select('*','categories.name as catname','categories.featured_image as cat_featured_image','categories.description as cat_description','blogs.name as podcast_name')->leftJoin('blogs_cats', 'blogs.id', '=', 'blogs_cats.blog_id')->leftJoin('categories', 'blogs_cats.cat_id', '=', 'categories.id')->toSql();
        //->paginate(6)
        // dd($this->blogs);
        $this->pageSlug = Pages::where('template', 'blog')->where('status', 'published')->value('slug');
        return view('components.front.section.blog-all');
    }
}
