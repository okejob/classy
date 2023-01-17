<?php

namespace App\Http\Controllers;

use App\Models\Permission\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function permissionList()
    {
        $permission = Permission::get();
        $list = $permission->pluck('name');
        return $list;
    }

    public function rolesPermissionList(Role $role)
    {
        return $role->permissions->pluck('name');
    }

    public function syncPermission(Request $request, Role $role)
    {
        return $request;
        $role->syncPermissions($request->list);
        return [
            'status' => 200,
        ];
    }
}
