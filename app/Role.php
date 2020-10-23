<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Permission;

class Role extends Model
{

    public const ACTIVE_DEFAULT = 1;

    public function staffs()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function grantPermission(Permission $permission)
    {
    	return $this->permissions()->save($permission);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_role');
    }

    public function createOrUpdateFormat(array $data)
    {
        $this->name = $data['name'];
        $this->label = Str::slug($data['name']);
        $this->active = isset($data['active']) ? $data['active'] : self::ACTIVE_DEFAULT;
        if ($this->save() && isset($data['permissions'])) {
            $this->grantRolePermissions($data['permissions']);
        }

        return $this;
    }

    protected function grantRolePermissions(array $permissions)
    {
        foreach ($permissions as $permission) {
            if ($permission !== null) {
                $p = $this->verifyPermission($permission);
                if ($p && !in_array($p->id, $this->currentPermissions())) {
                    $this->grantPermission($p);
                }
            }
        }

        return true;
    }

    public function currentPermissions()
    {
        return $this->permissions->pluck('id')->toArray();
    }

    protected function verifyPermission($value)
    {
        return Permission::find($value);
    }
}
