<?php

namespace App\Classes;

use Illuminate\Support\Str;
use App\Permission;
use App\Role;
use Carbon\Carbon;

class Base
{

    public const ADMINISTRATOR = 'administrator';

	public static function getActions()
	{
		return ['browse', 'read', 'edit', 'add', 'delete', 'manage', 'approve'];
	}

	public static function generatePermissions($name, $type, $table=null)
    {
    	$actions = self::getActions();

    	foreach ($actions as $action) {
    		$app_name = $action . " " . $name;
            $label = Str::slug($app_name);

            if (! self::checkIfPermissionExists($label)) {
                if ($permission = self::savePermission($app_name, $label, $type, $table, $name)) {
                    self::grantAdministratorAccess($permission);
                }
            }
    	}

    	return true;
    }

    public static function dateParse($date)
    {
        return Carbon::parse($date);
    }

    public static function diffDays($start, $end) : int
    {
        $begin = self::dateParse($start);
        $end = self::dateParse($end);

        return $begin->diffInDays($end) + 1;
    }

    public static function checkIfPermissionExists($label)
    {
        return Permission::where('label', $label)->first();
    }

    public static function savePermission($name, $label, $type, $table, $source)
    {
        return Permission::create([
            'name' => $name,
            'label' => $label,
            'type' => $type,
            'type_name' => $source,
            'table_name' => $table,
        ]);
    }

    public static function checkPermissions($oldName, $name, $table=null, $type="application")
    {

        if ($oldName !== $name) {
            $permissions = Permission::where('type_name', $oldName)->get();

            if ($permissions) {
                foreach ($permissions as $permission) {
                    $permission->delete();
                }
            }
        }

        return self::generatePermissions($name, $type, $table);

    }

    public static function grantAdministratorAccess(Permission $permission)
    {
        $role = Role::where('label', self::ADMINISTRATOR)->first();

        if (! $role) {
            return false;
        }

        return $role->grantPermission($permission);
    }
}
