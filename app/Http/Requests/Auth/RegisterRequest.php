<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Hash;
use App\Rules\Telephone;
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
            'role' => 'required',
            'terms_and_condition' => 'required',
            'phone' => ['required', new Telephone()],
            'email' => 'email|unique:users|required|max:255',
            'username' => 'unique:users|required|max:255',
            'address' => 'max:255',
            'password' => 'required|min:6|confirmed',
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
            'username' => $this->get('username'),
            'email_verified_at' => $date->format('U'),
            'role' =>$this->get('role'),
            'address' =>( $this->has('address')) ? $this->get('address') : null,
            'phone' => $this->get('phone'),
            'package_id' => $this->get('package_id') ? $this->get('package_id') : null,
        ];
    }
}
