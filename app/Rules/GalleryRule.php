<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GalleryRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public $msg = '';

    public function passes($attribute, $value)
    {
        $ret = true;
        if (!empty($value)) {
            foreach ($value as $image){
                if (isset($image['url']) && strlen($image['url']) > 255) {
                    $this->msg = 'Image Url Too Long.';
                    $ret = false;
                    break;
                }
                else if (isset($image['alt']) && strlen($image['alt']) > 100) {
                    $this->msg = 'Image Alt Too Long.';
                    $ret = false;
                    break;
                }
                else{
                    $ret = true;
                }
            }
        }
        else{
            $ret = true;
        }
        return $ret;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
