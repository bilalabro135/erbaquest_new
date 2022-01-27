<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ShortDescription;
use App\Rules\CatDepth;
class CategoryRequest extends FormRequest
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
            'slug' => 'required|max:255',
            'featured_image' => 'max:255',
            'description' => [
                'max:255',
                new ShortDescription(),
            ],
            'parent_id' => [
                new CatDepth(),
            ]
        ];
    }
    public function getCategoryData()
    {
        if (($this->has('old_slug') && $this->get('old_slug') != $this->get('slug')) || !$this->has('old_slug')) {
            $this->merge(['slug' => prepareSlug(app('App\Models\Category'), $this->get('slug'))]);
        }


        return [
            'name' => $this->get('name'),
            'slug' =>  \Str::slug($this->get('slug')),
            'description' => ($this->has('description')) ? $this->get('description') : null ,
            'featured_image' => ($this->has('featured_image')) ? $this->get('featured_image') : null ,
            'parent_id' => ($this->has('parent_id')) ? $this->get('parent_id') : null ,
        ];
    }
}
