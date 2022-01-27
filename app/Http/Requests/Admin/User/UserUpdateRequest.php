<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Hash;
class UserUpdateRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required|max:255',
            'email' => 'email|required|max:255',
            'role' => 'required',
        ];
    }
    public function getUserData()
    {
       $date = new \Datetime("now");
       $data = [
            'id' => $this->get('id'),
            'name' => $this->get('name'),
            'role' => $this->get('role'),
            'email' => $this->get('email'),
       ];
       if ($this->has('password')) {        
             $data['password'] =  Hash::make($this->get('password'));
           
       }
       if ($this->has('email_verified_at') && $this->get('email_verified_at') != '') {
           $data ['email_verified_at'] = ($this->get('email_verified_at') == 'verified') ?  $date->format('U') : null;
       }

       return $data;
    }
    public function hasPassword(){
       return $this->has('password');
    }
    public function shouldUpdateVerifiacation(){
       return ($this->has('email_verified_at') && $this->get('email_verified_at') != '' ) ? true : false;
    }
    public function shouldSendVerificationEmail()
    {
        if ($this->has('email_verified_at') && $this->get('email_verified_at') == 'send') {
            return true;
        }
        return false;
    }
}
