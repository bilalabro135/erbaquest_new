<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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

    public function getRequest()
    {
        return [
            'comment_id' => $this->get('comment_id'),
            'comment' => $this->get('comment'),
        ];
    }
}
