<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Podcast\PodcastRequest;
use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Models\Category;
use App\Models\User;
use App\Models\Pages;
use DataTables;
use Bouncer;
use Redirect;
use Route;

use Carbon\Carbon;
class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.podcasts.index');
    }
    public function getPodcasts()
    {
       $model = Podcast::query();
        return DataTables::eloquent($model)
        ->addColumn('action', function($row){
            $actionBtn = '';
            // if (Route::has('podcasts.front')) {
               
            //  $actionBtn = '<a class="btn-circle btn btn-sm btn-primary mr-1" href="' .route('podcasts.front', ['slug' => $row->slug]). '"><i class="fas fa-eye"></i></a>';
            // }
                //if(Bouncer::can('updateBlogs')){
                    $actionBtn .='<a href="' . route('podcasts.edit', ['podcast' => $row->id]) . '" class="mr-1 btn btn-circle btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>';
                //}
                //if(Bouncer::can('deleteBlogs')){
                $actionBtn .= '<a class="btn-circle btn btn-sm btn-danger" href="' .route('podcasts.delete', ['podcast' => $row->id]). '"><i class="fas fa-trash-alt"></i></a>';
                //}
                return $actionBtn;
        })
        ->addColumn('author', function (Podcast $podcast) {
                return $podcast->author->name;
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
        $categories = Category::where('parent_id', null)->where("category_type","podcast")->get();
        return view('admin.podcasts.add', compact('users', 'categories'));//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PodcastRequest $request)
    {
        $podcastDetail = $request->getPodcastData();

        $array = unserialize($podcastDetail['gallery']);
        $podcast = new Podcast;
        $podcast->name = $podcastDetail['name'];
        $podcast->sub_heading = $podcastDetail['subhead'];
        $podcast->slug = $podcastDetail['slug'];
        $podcast->featured_image =  str_replace(env('APP_URL'),"",$podcastDetail['featured_image']) ;
        $podcast->status = $podcastDetail['status'];
        $podcast->description = $podcastDetail['description'];
        $podcast->short_description = $podcastDetail['short_description'];
        $podcast->gallery = $podcastDetail['gallery'];
        $podcast->meta_title = $podcastDetail['meta_title'];
        $podcast->meta_keyword = $podcastDetail['meta_keyword'];
        $podcast->meta_description = $podcastDetail['meta_description'];
        $podcast->user_id = $podcastDetail['user_id'];

        $podcast->itune = $podcastDetail['itunes_link'];
        $podcast->spotify = $podcastDetail['spotify_link'];
        $podcast->google_music = $podcastDetail['gm_link'];
        $podcast->stitcher_link = $podcastDetail['stitcher_link'];

        $podcast->patreon_message = $podcastDetail['pt_message'];

        $podcast->save();

         if($request->has('cat'))
             $podcast->categories()->attach($request->cat);

        return Redirect::route('podcasts')->with(['msg' => 'Podcast added', 'msg_type' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Podcast $podcast)
    {
        $users = User::all();
        $categories = Category::where('parent_id', null)->where("category_type","podcast")->get();
        $galleries = unserialize($podcast['gallery']);

        return view('admin.podcasts.edit', compact('podcast', 'users', 'categories','galleries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PodcastRequest $request, Podcast $podcast)
    {
        $podcastDetail = $request->getPodcastData();
    
        $podcast->update([
            'name' => $podcastDetail['name'],
            'slug' => $podcastDetail['slug'],
            'sub_heading' => $podcastDetail['subhead'],
            'featured_image' =>  str_replace(env('APP_URL'),"",$podcastDetail['featured_image']),
            'status' => $podcastDetail['status'],
            'description' => $podcastDetail['description'],
            'short_description' => $podcastDetail['short_description'],
            'gallery' => $podcastDetail['gallery'],
            'meta_title' => $podcastDetail['meta_title'],
            'meta_keyword' => $podcastDetail['meta_keyword'],
            'meta_description' => $podcastDetail['meta_description'],
            'itune' => $podcastDetail['itunes_link'],
            'spotify' => $podcastDetail['spotify_link'],
            'google_music' => $podcastDetail['gm_link'],
            'stitcher_link' => $podcastDetail['stitcher_link'],
            'patreon_message' => $podcastDetail['pt_message'],
        ]);
        if($request->has('cat'))
            $podcast->categories()->sync($request->cat);
        else
            $podcast->categories()->sync(array());

        return Redirect::route('podcasts')->with(['msg' => 'Podcast Updated', 'msg_type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $podcast = Podcast::where('id', $id)->delete();
        if ($podcast) {
            return Redirect::back()->with(['msg' => 'Podcast deleted', 'msg_type' => 'success']);
        }
        abort(404);
    }

    public function frontView()
    {
        $getPodcasts = Podcast::all();
        $pages = Pages::all();
        $pageSlug = Pages::where('template', 'blog')->where('status', 'published')->value('slug');
        return view('templates.blog', compact('getPodcasts', 'pageSlug', 'pages'));
    }
    public function show($id, request $request)
    {
        $podcastsData = Podcast::where('id',$id)->first();
        $user_info = User::where("id",$podcastsData['user_id'])->first();
        
        $additional_info = array(
            "username"  => $user_info->username,
            "duration"  => $this->time_elapsed_string($podcastsData['created_at']),
            'gallery'   => unserialize($podcastsData['gallery']),

        );
        $current = ($request->input('episode')) ?  $request->input('episode') - 1 : 0;

        return view('front.podcast.index', compact('podcastsData','additional_info','current'));
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new Carbon;
        $ago = new Carbon($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


}

