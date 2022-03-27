<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
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
            'email' => 'unique:users,email,'.$this->get('id').'|email|required|max:255',
        ];
    }

    public function getNewsletterData()
    {
        return [
            'email' => $this->get('email'),
        ];
    }
}
