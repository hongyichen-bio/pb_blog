<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductImageRule implements Rule
{
    private $name;
    private $msg;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //
        $this->msg = $msg;
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
        $this->name = $attribute;
        // 'regex:/^images\/\w+\.(png|jpe?g)$/i'
        return preg_match('/^images\/\w+\.(png|jpe?g)$/i',$value); 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return "The validation for $this->name is failed.";
        return $this->msg;
    }
}
