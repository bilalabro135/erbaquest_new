<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Hash;
use App\Rules\Telephone;
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


    protected function prepareForValidation()
    {
        if($this->get('old_email') != $this->get('email')){
            $this->merge(['email_verified_at' => 'unverified']);
        }

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
            'profile_image' => 'max:255',
            'username' => 'unique:users,username,'.$this->get('id').'|required|max:255',
            'email' => 'unique:users,email,'.$this->get('id').'|email|required|max:255',
            'phone' => ['required', new Telephone()],
            'address' => 'max:255',
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
            'username' => $this->get('username'),
            'address' =>( $this->has('address')) ? $this->get('address') : null,
            'profile_image' =>( $this->has('profile_image')) ? $this->get('profile_image') : null,
            'phone' => $this->get('phone'),
            'featured' => $this->get('featured'),
       ];
       if ($this->has('password') && $this->get('password') != null ) {        
             $data['password'] =  Hash::make($this->get('password'));
           
       }
       if ($this->has('email_verified_at') && $this->get('email_verified_at') != '') {
           $data ['email_verified_at'] = ($this->get('email_verified_at') == 'verified') ?  $date->format('U') : null;
       }

       return $data;
    }
    public function hasPassword(){
       return ($this->has('password') && $this->get('password') != null);
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
