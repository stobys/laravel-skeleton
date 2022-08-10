<?php

namespace App\Traits;

trait ModelValidationAtSaveTrait
{
    /**
     * Error message bag
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Validator instance
     *
     * @var Illuminate\Validation\Validators
     */
    protected $validator;

    public function __construct(array $attributes = array(), Validator $validator = null)
    {
        parent::__construct($attributes);

        $this -> validator = $validator ?: app()->make('validator');
    }

    // -- Listen for save event
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            return $model -> validate();
        });
    }

    // -- Validates current attributes against rules
    public function validate()
    {
        $v = $this -> validator -> make($this->attributes, $this->rules(), $this->messages);

        if ( $v -> passes() )
        {
            return true;
        }

        $this -> setErrors( $v->messages() );
        return false;
    }

    /**
     * Set error message bag
     *
     * @var Illuminate\Support\MessageBag
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }

    // -- Retrieve error message bag
    public function getErrors()
    {
        return $this->errors;
    }

    // -- Inverse of wasSaved
    public function hasErrors()
    {
        return ! empty($this->errors);
    }

}
