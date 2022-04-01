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

        $getAllPodCasts = Podcast::all();
        $sendAllPodCasts = array();
        foreach ($getAllPodCasts as $getPodcast) {

            $sendAllPodCasts[] = array(
                "id"                 => $getPodcast['id'],
                "cat_featured_image" => $getPodcast['featured_image'],
                "name"               => $getPodcast['name'],
                "total"              => (isset($getPodcast['gallery'])) ? count(unserialize($getPodcast['gallery'])) : '',
                "description"        => $getPodcast['short_description'],
                "gallery"            => unserialize($getPodcast['gallery']),
            );    
  
        }

        $this->podcasts = $sendAllPodCasts;

        $this->pageSlug = Pages::where('template', 'blog')->where('status', 'published')->value('slug');
        return view('components.front.section.podcast-all');
    }
}
