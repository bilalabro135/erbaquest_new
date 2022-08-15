<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorProfileReq extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'public_profile_name'   => 'required',
                'email'                 => 'required',
                'featured_picture'      => 'required|max:10000',
                'phone'                 => 'required',
                'description'           => 'required',
                'user_id'               => 'required'
            ];
    }
}
