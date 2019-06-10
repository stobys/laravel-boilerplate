<?php namespace App\Models;

//use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\Model;
//use Mpociot\Versionable\VersionableTrait;

use Validator;

class Generic extends Model
{
    //use Rememberable;
    // use VersionableTrait;
    // protected $versioningEnabled = true;
    // protected $dontVersionFields = [ 'last_login_at' ];

    // -- the database table used by the model.
    protected $table = 'generic';

    //  protected $path = '';

    //  protected $dateFormat = 'Y-m-d H:i';

    // -- the attributes that are not mass assignable.
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

        // -- jezeli jest, uruchamiamy metode inicjujaca
        if (method_exists($this, 'init')) {
            $this -> init();
        }
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

                if ($model->autoValidate) {
                    return $model->validate();
                }
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

    public function fireEvent($event)
    {
        $this -> fireModelEvent($event);
    }
}
