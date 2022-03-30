<?php

namespace App\View\Components\Front\Section;

use Illuminate\View\Component;
use Auth;
use App\Models\Podcast;
use App\Models\User;
use App\Models\Pages;
use App\Models\Category;

class PodcastAll extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $podcasts;
    public $pageSlug;
    public $Categories;
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

        $this->podcasts = Podcast::select('*','categories.name as catname','categories.featured_image as cat_featured_image')
        ->leftJoin('podcasts_cats', 'podcasts.id', '=', 'podcasts_cats.podcast_id')
        ->leftJoin('categories', 'podcasts_cats.cat_id', '=', 'categories.id')->get();
        // dd($this->podcasts);
        $this->pageSlug = Pages::where('template', 'blog')->where('status', 'published')->value('slug');
        return view('components.front.section.podcast-all');
    }
}
