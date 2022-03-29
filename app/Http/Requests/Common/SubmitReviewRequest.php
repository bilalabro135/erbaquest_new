<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class SubmitReviewRequest extends FormRequest
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
            'speed' => 'required|min:1',
            'quality' => 'required|min:1',
            'price' => 'required|min:1',
            'comment' => 'required|max:255',
        ];
    }

    public function getRequest()
    {
        return [
            'speed' => $this->get('speed'),
            'quality' => $this->get('quality'),
            'price' => $this->get('price'),
            'comment' => $this->get('comment'),
        ];
    }
}
