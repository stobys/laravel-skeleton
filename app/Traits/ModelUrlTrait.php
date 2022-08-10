<?php

namespace App\Traits;

use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Support\Str;

trait ModelUrlTrait
{
    /**
     * Generate an url for the model. Especially useful
     * for models which are used as morphed models
     * since the actual model can be everything
     */
    public function url($action = 'show', $resource = null): string
    {
        $resource = $resource ?? Str::of(class_basename($this))->plural()->lower();

        try {
            return match ($action) {
                'index'     => route($resource . '.index'),
                'create'    => route($resource . '.create'),
                'edit'      => route($resource . '.edit', $this),
                'show'      => route($resource . '.show', $this),
                'delete'    => route($resource . '.destroy', $this),
                'destroy'   => route($resource . '.destroy', $this),
                'restore'   => route($resource . '.restore', $this),
                default     => route($resource . '.show', $this),
            };
        } catch (RouteNotFoundException $e) {
            return route($resource . '.index');
        }
    }
    
}
