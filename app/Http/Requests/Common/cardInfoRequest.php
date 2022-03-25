<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class CardInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cardName' => 'required',
            'lname'    => 'required',
            'cardName' => 'required',
            'cardNumber' => 'required',
            'expMonth' => 'required',
            'expYear' => 'required',
            'cardCode' => 'required',
        ];
    }

    public function getCardInfo()
    {
        return [
            'cardName'    => $this->get('cardName'),
            'lname'    => $this->get('lname'),
            'cardName' => $this->get('cardName'),
            'expMonth' => $this->get('expMonth'),
            'expYear' => $this->get('expYear'),
            'cardCode' => $this->get('cardCode'),
        ];
    }
}
