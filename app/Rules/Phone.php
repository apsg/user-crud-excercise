<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
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
     * Determine if the phone number is correct.
     * We only accept numbers separated by spaces or dashes. 
     * The number can also start with a plus sign.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(\+)?[\d\s\-]+$/', $value);    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please provide phone number in correct form. Use only numbers, spaces and dashes (-). Phone number can also start with plus sign (+).';
    }
}
