<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;
class CatDepth implements Rule
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
            $cat = Category::where('id', $value)->first(); 
            $count = $cat->parent()->count();
            if ($count > 0) {
                $subcat = $cat->parent()->first();
                $subcount = $subcat->parent()->count();
                if ($subcount > 0) {
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
        return "Hirarchy Limit exceeded.";
    }
}
