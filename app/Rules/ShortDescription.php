<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ShortDescription implements Rule
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
         return str_word_count($value) <= 50;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
         return 'The :attribute cannot be longer than 50 words.';
    }
}
