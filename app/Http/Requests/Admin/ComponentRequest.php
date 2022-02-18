<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\GalleryRule;

class ComponentRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:225',
            // Home Banner
            'fields.heading' => 'exclude_unless:name,home-banner|required|max:150',
            'fields.cta_action' => 'exclude_unless:name,home-banner|required|max:255',
            'fields.cta_text' => 'exclude_unless:name,home-banner|required|max:60',
            'fields.background' => 'exclude_unless:name,home-banner|required|max:255',
        ];
    }

    public function getComponentSettings()
    {
        return [
            'name' => $this->get('name'),
            'fields' => ($this->has('fields')) ? serialize($this->get('fields')) : null,
        ];
    }
}
