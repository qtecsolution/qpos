<?php

namespace App\Http\Controllers\Backend\RolePermission;

use app;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    // show roles page
    public function index()
    { 
       abort_if(!auth()->user()->can('role_view'), 403);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.settings.role.index', compact('roles', 'permissions'));
    }

    // create new role
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('role_create'), 403);
        $request->validate([
            'name' => 'required|unique:roles'
        ]);

        if (Role::create($request->only('name'))) {
            return back()->with('success', 'Role created successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    // update a role
    public function update(Request $request, $id)
    {
       abort_if(!auth()->user()->can('currency_update'), 403);
        $request->validate([
            'name' => "required|unique:roles,name," . $id
        ]);

        if ($role = Role::findOrFail($id)) {
            $role->update([
                'name' => $request->name
            ]);
            return back()->with('success', 'Role has been updated');
        } else {
            return back()->with('error', 'Role with id ' . $id . ' note found');
        }
    }

    // show permissions
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('backend.settings.role.permissions', compact('permissions', 'role'));
    }

    // delete a role
    public function destroy($id)
    {
         abort_if(!auth()->user()->can('role_delete'), 403);
        if ($id != 1) {
            $data = Role::findOrFail($id);
            $data->delete();

            return back()->with('success', 'Role is deleted');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    // update permissions of a role
    public function updatePermission(Request $request, $id)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        if ($role = Role::findOrFail($id)) {
            // admin role has everything
            if ($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return to_route('backend.admin.roles')->with('warning', 'Admin role has all permissions');
            }
            
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            return back()->with('success', $role->name . ' permissions has been updated');
        } else {
            return back()->with('error', 'Role with id ' . $id . ' note found');
        }
    }

    // show permissions according to role
    public function roleWisePermissions($id)
    {
        if ($id != '') {
            $data = Role::findOrFail($id);
            return response()->json($data->permissions, 200);
        }
        return response()->json('', 200);
    }
}
