<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FavIcon;
class SettingsRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name' => 'required|max:255',
            // General
            'value.site_name' => 'exclude_unless:name,general|required|max:255',
            'value.site_title' => 'exclude_unless:name,general|required|max:255',
            'value.home_page' => 'exclude_unless:name,general|required|max:255',
            'value.site_fav' => [
                'exclude_unless:name,general',
                'max:255',
                new FavIcon()
            ],
            // Regestration
            'value.page_title' => 'exclude_unless:name,registration|required|max:255',
            'value.signup_banner' => 'exclude_unless:name,registration|required|max:255',

        ];
    }

    public function getSettings()
    {
        return [
            'name' => $this->get('name'),
            'value' => serialize($this->get('value'))
        ];
    }
}
