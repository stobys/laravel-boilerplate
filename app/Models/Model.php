<?php

namespace App\Models;

// use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

use Validator;

// use Mpociot\Versionable\VersionableTrait;

class Model extends Eloquent
{
    use SoftDeletes;

    // use Rememberable;
    // use VersionableTrait;
    // protected $versioningEnabled = true;
    // protected $dontVersionFields = [ 'last_login_at' ];

    // -- the database table used by the model.
    protected $table = 'generic';

    //  protected $path = '';

    //  protected $dateFormat = 'Y-m-d H:i';

    // -- the attributes that are not mass assignable.
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

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

        // -- jezeli jest, uruchamiamy metode inicjujaca
        if (method_exists($this, 'init')) {
            $this -> init();
        }
    }

    // -- return users login field name username/email or so
    public function username()
    {
        return 'username';
    }

    // -- boot model
    protected static function boot()
    {
        parent::boot();

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

        static::restoring(function ($model) {
            if (method_exists($model, 'onRestoring')) {
                $model->onRestoring();
            }
        });

        static::restored(function ($model) {
            if (method_exists($model, 'onRestored')) {
                $model->onRestored();
            }
        });
    }

    public static function restoring($callback)
    {
        static::registerModelEvent('restoring', $callback);
    }

    public static function restored($callback)
    {
        static::registerModelEvent('restored', $callback);
    }

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

    protected function parseSearchQueryString($q = null)
    {
        $search = [
            'include'   => [],
            'exclude'   => [],
        ];

        foreach (explode(' ', $q) as $string) {
            if (starts_with($string, '-')) {
                $search['exclude'][] = substr($string, 1);
            } else {
                $search['include'][] = $string;
            }
        }

        return $search;
    }

    public function scopeSearch($query, $q = null)
    {
        return $query;
    }

    public function fireEvent($event)
    {
        $this -> fireModelEvent($event);
    }

    public function action($action, $model = null)
    {
        // laravel helper:
        $baseClass = str_plural(strtolower(class_basename($this)));

        // generic solution
        // $reflection = new ReflectionClass($className);
        // $reflection->getShortName();

        switch ($action) {
            default:
                $action = 'index';
                // no break
            case 'index':
            case 'preview':
            case 'show':
            case 'create':
            case 'store':
            case 'edit':
            case 'update':
            case 'delete':
            case 'destroy':
            case 'restore':
                return route($baseClass .'-'. $action, $model);
            break;

        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDummyTimeFieldAttribute($input)
    {
        if ($input != null && $input != '') {
            $this -> attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)
                    -> format('Y-m-d H:i:s');
        } else {
            $this -> attributes['start_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDummyTimeFieldAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');
        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
}
