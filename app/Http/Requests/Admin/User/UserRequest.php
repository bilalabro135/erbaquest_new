<?php

namespace App\Http\Requests\Admin\User;


use Illuminate\Foundation\Http\FormRequest;
use Hash;
use App\Rules\Telephone;

class UserRequest extends FormRequest
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
            'profile_image' => 'max:10000',
            'username' => 'unique:users|required|max:255',
            'phone' => ['required', new Telephone()],
            'password' => 'required|max:255',
            'email_verified_at' => 'required',
            'role' => 'required',
            'address' => 'max:255',
        ];
    }

    public function getUserData()
    {
       $date = new \Datetime("now");
       return [
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'role' => $this->get('role'),
            'username' => $this->get('username'),
            'address' =>( $this->has('address')) ? $this->get('address') : null,
            'phone' => $this->get('phone'),
            'featured' => $this->get('featured'),
            'password' =>  Hash::make($this->get('password')),
            'email_verified_at' => ($this->get('email_verified_at') == 'verified') ?  $date->format('U') : null,
            'profile_image' =>( $this->has('profile_image')) ? $this->get('profile_image') : null,
       ];
    }
    public function shouldSendVerificationEmail()
    {
        if ($this->has('email_verified_at') && $this->get('email_verified_at') == 'send') {
            return true;
        }
        return false;
    }


}
