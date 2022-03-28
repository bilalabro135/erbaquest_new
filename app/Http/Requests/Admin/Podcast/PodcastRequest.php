<?php

namespace App\Http\Requests\Admin\Podcast;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ShortDescription;
use App\Rules\GalleryRule;
class PodcastRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    protected function prepareForValidation()
    {
        if(!$this->has('slug')){
            $this->merge(['slug' => \Str::slug($this->get('name'))]);
        }        

    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'slug' => 'max:255',
            'meta_title' => 'max:100',
            'meta_keyword' => 'max:255',
            'meta_description' => 'max:200',
            'status' => 'required',
            'user_id' => 'required',
            'gallery' => [
                new GalleryRule()
            ],
            'short_description' => [
                new ShortDescription(),
            ]
        ];
    }

    public function getPodcastData()
    {
        if (($this->has('old_slug') && $this->get('old_slug') != $this->get('slug')) || !$this->has('old_slug')) {
            $this->merge(['slug' => prepareSlug(app('App\Models\Blog'), $this->get('slug'))]);
        }
        $gallery = array();
        if($this->has('gallery')){
            foreach($this->get('gallery') as $k => $g){
                $gallery[$k]['alt'] = $g['alt'];
                $gallery[$k]['url'] =  str_replace(env('APP_URL'),'',$g['url']);
            }
            $this->merge(['gallery' => $gallery]);
        }

        return [
            'name' => $this->get('name'),
            'slug' =>  \Str::slug($this->get('slug')),
            'template' => $this->get('template'),
            'status' => $this->get('status'),
            'description' => ($this->has('description')) ? $this->get('description') : null ,
            'short_description' => ($this->has('short_description')) ? $this->get('short_description') : null,
            'gallery' => ($this->has('gallery')) ? serialize(array_values($this->get('gallery'))) : null,
            'user_id' => $this->get('user_id') ,

            'itunes_link' => $this->get('itunes_link') ,
            'spotify_link' => $this->get('spotify_link') ,
            'gm_link' => $this->get('gm_link') ,
            'stitcher_link' => $this->get('stitcher_link') ,
            'episode_number' => $this->get('episode_number') ,
            'episode_timeline' => $this->get('episode_timeline') ,
            'pt_message' => $this->get('pt_message') ,
            
            'featured_image' => ($this->has('featured_image')) ? $this->get('featured_image') : null ,
            'meta_title' => ($this->has('meta_title')) ? $this->get('meta_title') : null ,
            'meta_keyword' => ($this->has('meta_keyword')) ? $this->get('meta_keyword') : null ,
            'meta_description' => ($this->has('meta_description')) ? $this->get('meta_description') : null ,
        ];
    }
}
