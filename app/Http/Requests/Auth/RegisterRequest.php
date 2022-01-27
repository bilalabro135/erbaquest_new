<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Hash;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'email|unique:users|required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|same:password|max:255',
        ];
    }
    public function getUserData()
    {
       $date = new \Datetime("now");
        return [
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'password' => Hash::make($this->get('password')),
            'email_verified_at' => $date->format('U')
        ];
    }
}
