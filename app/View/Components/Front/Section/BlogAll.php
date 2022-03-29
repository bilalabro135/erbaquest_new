<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Auth;
use App\Models\Blog;
use App\Models\User;
use App\Models\Pages;

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
        $this->blogs = Blog::paginate(1);
        $this->pageSlug = Pages::where('template', 'blog')->where('status', 'published')->value('slug');
        return view('components.front.section.blog-all');
    }
}
