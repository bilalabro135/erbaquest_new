<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use Hash;
use App\Rules\Telephone;

class VendorProfileRequest extends FormRequest 
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'public_profile_name' => 'required',
            'email' => 'unique:users,email,'.$this->get('id').'|email|required|max:255',
            'phone' => ['required', new Telephone()],
            'featured_picture' => 'image|required',
            'picture' => 'image|required',
            'descreption' => 'max:255',
            'website' => 'max:255',
            'instagram' => 'max:255',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'youtube' => 'max:255',
            'linkedin' => 'max:255',
        ];
    }
    public function getUserData()
    {
       $date = new \Datetime("now");
       $data = [
            'public_profile_name' => $this->get('public_profile_name'),
            'email' => $this->get('email'),
            'phone' => $this->get('phone'),
            'featured_picture' => $this->get('featured_picture'),
            'picture' => $this->get('picture'),
            'descreption' =>( $this->has('descreption')) ? $this->get('descreption') : null,
            'website' =>( $this->has('website')) ? $this->get('website') : null,
            'instagram' =>( $this->has('instagram')) ? $this->get('instagram') : null,
            'facebook' =>( $this->has('facebook')) ? $this->get('facebook') : null,
            'twitter' =>( $this->has('twitter')) ? $this->get('twitter') : null,
            'youtube' =>( $this->has('youtube')) ? $this->get('youtube') : null,
            'linkedin' =>( $this->has('linkedin')) ? $this->get('linkedin') : null,
            
       ];
       return $data;
    }
}