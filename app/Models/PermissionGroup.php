<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\AuthPermissionGroup
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AuthPermission[] $permissions
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Generic filter()
 * @mixin \Eloquent
 */
class PermissionGroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'position'];

    // -- The database table used by the model.
    protected $table = 'permissions_groups';

    public function permissions()
    {
        return $this->hasMany('App\Models\Permission', 'group_id');
    }
}
