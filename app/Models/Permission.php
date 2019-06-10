<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\Models\Permission
 *
 * @property-read \App\Models\AuthPermissionGroup $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AuthRole[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 */
class Permission extends SpatiePermission
{
    use SoftDeletes;

    use PresentableTrait;
    protected $presenter = 'App\Presenters\AuthPermissionPresenter';

    protected $fillable = ['name', 'group_id', 'guard_name'];

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
    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this -> belongsToMany(
            config('permission.models.role'),
            config('permission.table_names.role_has_permissions'),
            'role_id',
            'permission_id'
        );
    }

    public function group()
    {
        return $this->belongsTo('App\Models\PermissionGroup', 'group_id');
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
}
