<?php

namespace App\Models;

use Illuminate\Support\Str;

class NullModel
{
    public function __construct()
    {
        return $this;
    }

    public function __get($_str_key)
    {
        return null;
    }

    public function __set($_str_key, $_mix_value)
    {

    }

    public function __call($_str_method, $_arr_attr)
    {
        $method = strtolower($_str_method);

        if ( Str::startsWith($method, 'can') )
        {
            return false;
        }

        if ( Str::startsWith($method, 'is') )
        {
            return false;
        }

        return $this;
    }

    public function __isset($_str_key)
    {
        return FALSE;
    }

    public function __unset($_str_key)
    {
        return TRUE;
    }

    public function __toString()
    {
        return '';
    }

    public function loaded()
    {
        return FALSE;
    }
}
