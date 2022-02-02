<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest
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
          'title' => 'required',
          'body' => 'required',
          'action' => 'required',
          'to' => 'required',
          'users' => 'exclude_unless:to,user|required',
          'roles' => 'exclude_unless:to,role|required',
        ];
    }

    public function getNotification()
    {        
        return [
          'title' => $this->get('title'),
          'body' => $this->get('body'),
          'action' => $this->get('action'),
          'featured_image' => ($this->has('featured_image')) ? $this->get('featured_image') : '',
          'to' => $this->get('to'),        
      ];
    }

}
