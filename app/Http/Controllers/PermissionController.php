<?php

namespace App\Http\Controllers;

use App\Models\Permission\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        $role->syncPermissions($request->list);
        $user = User::find(Auth::id());
        $permission = $user->getPermissionsViaRoles()->pluck('name')->toArray();
        Session::forget('permissions');
        Session::put('permissions', $permission);
        return [
            'status' => 200,
        ];
    }
}
