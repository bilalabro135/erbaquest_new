<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Image;
class FavIcon implements Rule
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
    public function passes($attribute, $value)
    {
        if (!empty($value)) {
            $val = explode('storage/', $value);
            $path =\Storage::disk('public')->path($val[1]);
            $image = file_get_contents($path);
            $height = Image::make($image)->height();
            $width = Image::make($image)->width();
            if ($height != $width) {
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The fav icon height and width should be same, Best dimesion is 16x16';
    }
}
