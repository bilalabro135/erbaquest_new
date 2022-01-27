<?php

namespace App\Http\Requests\Admin\User;


use Illuminate\Foundation\Http\FormRequest;
use Hash;

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
            'password' => 'required|max:255',
            'email_verified_at' => 'required',
            'role' => 'required',
        ];
    }

    public function getUserData()
    {
       $date = new \Datetime("now");
       return [
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'role' => $this->get('role'),
            'password' =>  Hash::make($this->get('password')),
            'email_verified_at' => ($this->get('email_verified_at') == 'verified') ?  $date->format('U') : null,
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
