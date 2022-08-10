<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait CacheForSelect
{
    protected static function forSelectCacheKey()
    {
        return Str::of(class_basename(static::class))->plural()->lower() . ':for-select';
    }

    public static function forSelect($field = 'name', $id = 'id', $prepend = null, $append = null)
    {
        return cache()->remember(static::forSelectCacheKey(), 60*60, function() use ($field, $id, $prepend, $append) {
            return static::select([$field, $id])
                    -> get()
                    -> pluck($field, $id)
                    -> mapWithKeys(function($name, $id) use ($prepend, $append) {
                            return [$id => $prepend . $name . $append];
                        });
        });
    }

    public static function forSelectWithTranslations($field = 'name', $id = 'id', $prepend = null, $append = null) {
        return static::forSelect($field, $id, $prepend, $append)
                        -> mapWithKeys(function ($name, $id) {
                            return [$id => __($name)];
                        });
    }

    public static function forgetForSelect()
    {
        return cache()->forget(static::forSelectCacheKey());
    }
}
