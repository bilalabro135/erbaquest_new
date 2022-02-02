<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Telephone implements Rule
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



   public  function isValidTelephoneNumber(string $telephone, int $minDigits = 9, int $maxDigits = 14): bool {
        if (preg_match('/^[+][0-9]/', $telephone)) {
            $count = 1;
            $telephone = str_replace(['+'], '', $telephone, $count); //remove +
        }
        
        $telephone = str_replace([' ', '.', '-', '(', ')'], '', $telephone); 

        return is_numeric($telephone); 
    }





    public function passes($attribute, $value)
    {
        if (!empty($value)) {
            return $this->isValidTelephoneNumber($value);
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
        return 'The :attribute is not valid phone number.';
    }
}
