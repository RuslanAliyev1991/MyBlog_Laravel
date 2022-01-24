<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContactRule implements Rule
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
        return preg_match('/^((\+994|994)?([0])?(50|51|77|99|55|70|10)([0-9]){7})$/m', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'phone number is not correct format for Azerbaijan';
    }
}