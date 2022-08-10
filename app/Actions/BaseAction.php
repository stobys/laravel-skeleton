<?php

namespace App\Actions;

use Illuminate\Support\Fluent;

class BaseAction
{
    /**
     * @return static
     */
    public static function make()
    {
        return app(static::class);
    }

    /**
     * @see static::handle()
     * @param mixed ...$arguments
     * @return mixed
     */
    public function __invoke(...$arguments)
    {
        return $this->handle(...$arguments);
    }
    
    /**
     * @see static::handle()
     * @param mixed ...$arguments
     * @return mixed
     */
    public static function run(...$arguments)
    {
        return static::make()->handle(...$arguments);
        // return static::make()->__invoke(...$arguments);
    }

    /**
     * @param $boolean
     * @param ...$arguments
     * @return mixed|\Illuminate\Support\Fluent
     */
    public static function runIf($boolean, ...$arguments)
    {
        return $boolean ? static::run(...$arguments) : new Fluent;
    }

    /**
     * @param $boolean
     * @param ...$arguments
     * @return mixed|\Illuminate\Support\Fluent
     */
    public static function runUnless($boolean, ...$arguments)
    {
        return static::runIf(!$boolean, ...$arguments);
    }

}
