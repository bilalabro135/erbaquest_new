<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [];
    }

    public function getContactData()
    {
        return [
            'first_name' => $this->get('email'),
            'last_name' => $this->get('last_name'),
            'email' => $this->get('email'),
            'subject' => $this->get('subject'),
            'message' => $this->get('message'),
        ];
    }
}
