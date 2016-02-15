<?php

namespace MPOproperty\Mpouspehm\Models;

use Bican\Roles\Models\Role;

class RoleCustom extends Role
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Each role can have many permissions.
     */
    public function permissions()
    {
        return $this->belongsToMany('MPOproperty\Mpouspehm\Models\PermissionCustom', 'permission_role', 'permission_id', 'role_id');
    }
}
