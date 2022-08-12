<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Model extends Eloquent
{
    // -- the database table used by the model.
    protected $table = 'generic';

    public $sortable = ['id', 'created_at'];
    protected $defaultSortCriteria = ['created_at,desc'];

    // protected $defaultSortOrder = 'desc';
    // protected $sortParameterName = 'sortBy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    // -- the attributes that are not mass assignable.
    // protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];

    // -- error message bag
    protected $errors;

    // -- validator instance
    protected $validator;

    // -- custom validation messages
    protected $messages = [];

    // -- create a new Eloquent model instance.
    public function __construct(array $attributes = [], Validator $validator = null)
    {
        parent::__construct($attributes);

        $this -> validator = $validator ?: app()->make('validator');
    }

    // -- return users login field name username/email or so
    public function username()
    {
        return 'username';
    }

    // -- boot model
    protected static function booted()
    {
        parent::boot();

        // -- handle retrieved event
        static::retrieved(function ($model) {
            // -- if exists call init method
            // if (method_exists($model, 'init')) {
            //     $this -> init();
            // }

            if (method_exists($model, 'onRetrieved')) {
                $model -> onRetrieved();
            }
        });

        // -- handle creating event
        static::creating(function ($model) {
            if (method_exists($model, 'onCreating')) {
                $model->onCreating();
            }
        });

        // -- handle created event
        static::created(function ($model) {
            if (method_exists($model, 'onCreated')) {
                $model->onCreated();
            }
        });

        static::saving(function ($model) {
            if (method_exists($model, 'onSaving')) {
                $model->onSaving();

                return $model->validate();
            }
        });

        static::saved(function ($model) {
            if (method_exists($model, 'onSaved')) {
                $model->onSaved();
            }
        });

        static::updating(function ($model) {
            if (method_exists($model, 'onUpdating')) {
                $model->onUpdating();
            }
        });

        static::updated(function ($model) {
            if (method_exists($model, 'onUpdated')) {
                $model->onUpdated();
            }
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'onDeleting')) {
                $model->onDeleting();
            }
        });

        static::deleted(function ($model) {
            if (method_exists($model, 'onDeleted')) {
                $model->onDeleted();
            }
        });

        if( method_exists(__CLASS__, 'restoring') ) {
            static::restoring(function ($model) {
                if (method_exists($model, 'onRestoring')) {
                    $model->onRestoring();
                }
            });
        };

        if( method_exists(__CLASS__, 'restoring') ) {
            static::restored(function ($model) {
                if (method_exists($model, 'onRestored')) {
                    $model->onRestored();
                }
            });
        }
    }

    // public static function restoring($callback)
    // {
    //     static::registerModelEvent('restoring', $callback);
    // }

    // public static function restored($callback)
    // {
    //     static::registerModelEvent('restored', $callback);
    // }

    protected function rules()
    {
        return [];
    }

    // -- validates current attributes against rules
    public function validate()
    {
        $v = $this->validator->make($this->attributes, $this->rules(), $this->messages);

        if ($v->passes()) {
            return true;
        }

        $this->setErrors($v->messages());

        return false;
    }

    // -- set error message bag
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }

    // -- retrieve error message bag
    public function getErrors()
    {
        return $this->errors;
    }

    // -- inverse of wasSaved
    public function hasErrors()
    {
        return ! empty($this->errors);
    }

    public function scopeFilter($query)
    {
        return $query;
    }

    public function scopeOrder($query)
    {
        return $query;
    }

    public static function getSortOptions()
    {
        return [
            'default'       => 'Domyślne Sortowanie',
        ];
    }

    // public function scopeSort($query, $field = 'id', $order = 'asc')
    // {
    //     $sort = Sorter::sort($field, $order);

    //     $query -> orderBy($sort['field'], $sort['order']);

    //     return $query;
    // }

    public function fireEvent($event)
    {
        $this -> fireModelEvent($event);
    }

    public function deletable()
    {
        if( self::usesSoftDeleting() )
        {
            return auth() -> check() && ! $this -> trashed();
        }

        return auth() -> check();
    }

    public function restorable()
    {
        return self::usesSoftDeleting() && auth() -> check() && $this -> trashed();
    }

    public function editable()
    {
        return auth() -> check();
    }

    public function viewable()
    {
        return auth() -> check();
    }

    public static function usesSoftDeleting()
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses(get_called_class()));
    }

    public function loaded()
    {
        return is_int($this->id) && $this->id > 0;
    }

    /**
     * Generate an url for the model. Especially useful
     * for models which are used as morphed models
     * since the actual model can be everything
     */
    public function url($action = 'show'): string
    {
        $resource = Str::of(class_basename($this)) -> plural() -> lower();

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
        }
        catch (RouteNotFoundException $e) {
            return route($resource . '.index');
        }
    }

}
