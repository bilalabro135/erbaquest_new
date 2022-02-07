<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Telephone;
use App\Rules\GalleryRule;

class EventRequest extends FormRequest
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
            'featured_image' => 'required|max:255',
            'gallery' => [
                new GalleryRule()
            ],
            'event_date' => 'required|date',
            'door_dontation' => 'required',
            'vip_dontation' => 'required',
            'vip_perk' => 'required',
            'charity' => 'required',
            'area' => 'max:100',
            'capacity' => 'max:255',
            'ATM_on_site' => 'max:255',
            'tickiting_number' => 'max:255',
            'vendor_number' => ['required', new Telephone()],
            'user_number' => ['required', new Telephone()],
            'website_link' => 'max:255',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'linkedin' => 'max:255',
            'instagram' => 'max:255',
            'youtube' => 'max:255',
            'status' => 'required',
            'user_id' => 'required',
        ];
    }

    public function getEventData()
    {
        if (($this->has('old_slug') && $this->get('old_slug') != $this->get('slug')) || !$this->has('old_slug')) {
            $this->merge(['slug' => prepareSlug(app('App\Models\Event'), $this->get('slug'))]);
        }


        return [
            'name' => $this->get('name'),
            'slug' =>  \Str::slug($this->get('slug')),
            'featured_image' => $this->get('featured_image'),
            'description' => ($this->has('description')) ? $this->get('description') : null ,
            'gallery' => ($this->has('gallery')) ? serialize(array_values($this->get('gallery'))) : null,
            'event_date' => $this->get('event_date'),
            'door_dontation' => $this->get('door_dontation'),
            'vip_dontation' => $this->get('vip_dontation'),
            'area' => ($this->has('area')) ? $this->get('area') : null ,
            'capacity' => ($this->has('capacity')) ? $this->get('capacity') : null ,
            'ATM_on_site' => ($this->has('ATM_on_site')) ? $this->get('ATM_on_site') : null ,
            'tickiting_number' => ($this->has('tickiting_number')) ? $this->get('tickiting_number') : null ,
            'vendor_number' => ($this->has('vendor_number')) ? $this->get('vendor_number') : null ,
            'user_number' => ($this->has('user_number')) ? $this->get('user_number') : null ,
            'website_link' => ($this->has('website_link')) ? $this->get('website_link') : null ,
            'facebook' => ($this->has('facebook')) ? $this->get('facebook') : null ,
            'twitter' => ($this->has('twitter')) ? $this->get('twitter') : null ,
            'linkedin' => ($this->has('linkedin')) ? $this->get('linkedin') : null ,
            'address' => ($this->has('address')) ? $this->get('address') : null ,
            'vendor_space_available' => ($this->has('vendor_space_available')) ? $this->get('vendor_space_available') : null ,
            'cost_of_vendor' => ($this->has('cost_of_vendor')) ? $this->get('cost_of_vendor') : null ,
            'height' => ($this->has('height')) ? $this->get('height') : null ,
            'instagram' => ($this->has('instagram')) ? $this->get('instagram') : null ,
            'type' => ($this->has('type')) ? $this->get('type') : null ,
            'youtube' => ($this->has('youtube')) ? $this->get('youtube') : null ,
            'status' => ($this->has('status')) ? $this->get('status') : null ,
            'vip_perk' => $this->get('vip_perk'),
            'charity' => $this->get('charity'),
            'user_id' => $this->get('user_id') ,
        ];
    }
}
