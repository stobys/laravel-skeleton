<?php

namespace App\Rules;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Validation\Rule;

class NotCoreUsername implements Rule
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
        return ! in_array(strtolower($value), config('system.users.core-users', []));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('users.validation.username-cannot-be-core-username');
    }
}
