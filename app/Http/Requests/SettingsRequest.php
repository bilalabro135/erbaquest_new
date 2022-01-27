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
            'value.default_role'=> 'exclude_unless:name,registration|required',
            // EMAIL
            'value.MAIL_MAILER'=> 'exclude_unless:name,email|required',
            'value.MAIL_HOST'=> 'exclude_unless:name,email|required',
            'value.MAIL_PORT'=> 'exclude_unless:name,email|required',
            'value.MAIL_USERNAME'=> 'exclude_unless:name,email|email|required',
            'value.MAIL_PASSWORD'=> 'exclude_unless:name,email|required',
            'value.MAIL_ENCRYPTION'=> 'exclude_unless:name,email|required',
            'value.MAIL_FROM_ADDRESS'=> 'exclude_unless:name,email|email|required',
            'value.MAIL_FROM_NAME'=> 'exclude_unless:name,email|required',

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
