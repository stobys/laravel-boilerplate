<?php

namespace App\Models;

// use Illuminate\Auth\Authenticatable;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Foundation\Auth\Access\Authorizable;

// use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
// use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Spatie\Permission\Traits\HasRoles;
use Laracasts\Presenter\PresentableTrait;
use App\Events\UserPasswordChanged;

use Carbon\Carbon;
use Request;
use Session;
use Hash;

//class User extends Authenticatable
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;

    use PresentableTrait;
    protected $presenter = 'App\Presenters\UserPresenter';

    protected $table = 'users';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'last_login_at'];

    // -- error message bag
    protected $errors;

    // -- validator instance
    protected $validator;

    // -- custom validation messages
    protected $messages = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'password', 'logins', 'last_login_at', 'first_name', 'last_name',
        'email', 'created_at', 'updated_at', 'deleted_at'
    ];

    // protected $quarded = [
    //     'id', 'username', 'password', 'last_login_at', 'created_at', 'updated_at', 'deleted_at'
    // ];

    // -- Validation rules
    // -- validation is made via UserFormRequest

    // -- user exposed observable events.
    protected $observables = ['hashing', 'login', 'logout'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'preferences' => 'array',
    ];

    public function loaded()
    {
        return is_int($this->id) && $this->id > 0;
    }

    public function reserved()
    {
        return (int) $this->id < 11;
    }

    /**
     * Hash password by default, if empty do nothing.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if (! empty($value)) {
            $this->attributes['password'] = Hash::make($value);

            $this -> fireModelEvent('hashing');
        }
    }

    public function scopeWithoutRoot($query)
    {
        return $query->where('username', '!=', 'root');
    }

    public function scopeFilter($query)
    {
        session()->forget('usersFiltered');

        if (request()->isMethod('POST')) {
            // -- check "username"
            if (request()->has('username') && trim(request()->get('username')) !== '') {
                session()->put('usersUsername', request()->get('username'));
            } else {
                session()->forget('usersUsername');
            }

            // -- check "*_name"
            if (request()->has('name') && trim(request()->get('name')) !== '') {
                session()->put('usersName', request()->get('name'));
            } else {
                session()->forget('usersName');
            }

            // -- check "email"
            if (request()->has('email') && trim(request()->get('email')) !== '') {
                session()->put('usersEmail', request()->get('email'));
            } else {
                session()->forget('usersEmail');
            }
        }


        // -- filtrowanie kolekcji
        if (session()->has('usersUsername')) {
            $query -> where('username', 'LIKE', '%'. session()->get('usersUsername') .'%');
            session()->put('usersFiltered', true);
        }

        if (session()->has('usersName')) {
            $query -> where(function ($q) {
                $q
                    -> where('given_name', 'LIKE', '%'. session()->get('usersName') .'%')
                    -> orWhere('family_name', 'LIKE', '%'. session()->get('usersName') .'%');
            });

            session()->put('usersFiltered', true);
        }

        if (session()->has('usersEmail')) {
            $query -> where('email', 'LIKE', '%'. session()->get('usersEmail') .'%');
            session()->put('usersFiltered', true);
        }

        return $query;
    }

    public function verifyPassword($password)
    {
        // $credentials = ['username' => $this->username, 'password' => $password];
        $credentials = [$this->username() => $this->username, 'password' => $password];

        return auth()->validate($credentials);
    }

    public function setPassword($password)
    {
        $this -> password = $password;
        $this -> password_changed_at = Carbon::now();

        if ($this -> save()) {
            // fire UserPasswordChanged event
            event(new UserPasswordChanged($this, auth()->user()));
        }
    }

    public function isRoot()
    {
        return $this -> username == 'root';
    }

    public function avatar()
    {
        if (self::isRoot()) {
            return 'user-root.png';
        } else {
            return 'user-male.png';
        }
    }

    public function getFullNameAttribute()
    {
        return $this->last_name .', '. $this->first_name;
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
}
