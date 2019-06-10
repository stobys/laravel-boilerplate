<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

use App\Traits\ModelValidationAtSaveTrait;

class Role extends SpatieRole
{
    use SoftDeletes, ModelValidationAtSaveTrait;

    protected $fillable = ['name'];

    /**
     * Custom validation messages
     *
     * @var Array
     */
    protected $messages = [];

    // -- Validation rules
    protected function rules()
    {
        return [
            'name' => 'required|unique:roles,name,'. $this->id
        ];
    }

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this -> belongsToMany(
            config('permission.models.permission'),
            config('permission.table_names.role_has_permissions'),
            'role_id',
            'permission_id'
        );
    }

    /**
     * A role may be assigned to various users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): MorphToMany
    {
        return $this->belongsToMany(
            config('auth.model') ?: config('auth.providers.users.model'),
            config('permission.table_names.user_has_roles'),
            'role_id',
            'user_id'
        );
    }

    public function scopeFilter($query)
    {
        return $query;
    }
}
