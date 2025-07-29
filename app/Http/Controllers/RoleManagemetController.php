<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManagemetController extends Controller
{
    public function roleManager()
    {
        $data['permissions'] = Permission::all();
        $data['roles'] = Role::where('name','!=','Super Admin')->get();
        return view('admin.rolemanagement.index',$data);
    }
    public function editRolePermissions($id)
    {
        $data['permissions'] = Permission::all();
        $data['roles'] = Role::find($id);
        return view('admin.rolemanagement.edit',$data);
    }

    public function storePermission(Request $request)
    {
        if(Permission::where('name', $request->permission)->exists())
        {
            return back()->with('error', 'Already Exists');
        }
        else{
            $permission = Permission::create(['name' => $request->permission]);
            if($permission)
            {
                return back()->with('success', 'Successful!');
            }
            else{
                return back()->with('error', 'Try again!');
            }
        }
    }
    public function storeRoleName(Request $request)
    {
        if(Role::where('name', $request->rolename)->exists())
        {
            return back()->with('error', 'Already Exists');
        }
        else{
            $role = Role::create(['name' => $request->rolename]);
            if($role)
            {
                return back()->with('success', 'Successful!');
            }
            else{
                return back()->with('error', 'Try again!');
            }
        }
    }
    public function assignPermToRole(Request $request)
    {
        if(Role::find($request->role)->permissions()->count() > 0)
        {
            return back()->with('error', 'Already Exists');
        }
        else{
            $role = Role::find($request->role)->syncPermissions($request->permissions);
            if($role)
            {
                return back()->with('success', 'Successful!');
            }
            else{
                return back()->with('error', 'Try again!');
            }
        }
    }
    public function UpdateAssignPermToRole(Request $request)
    {
        $role_name = Role::find($request->role_id)->update(['name' => $request->role_name]);
        $role_permissions = Role::find($request->role_id)->syncPermissions($request->permissions);

        if($role_name && $role_permissions)
        {
            return back()->with('success', 'Successful!');
        }
        else{
            return back()->with('error', 'Try again!');
        }
    }
    public function assignRoleToUser(Request $request)
    {
        $user = User::find($request->id);
        $roleUpdate = $user->syncRoles([$request->role]);

        if($roleUpdate)
        {
            echo json_encode(['status' => 'success', 'message' => 'User Role Updated Successfull.']);
        }
        else{
            echo json_encode(['error' => 'error', 'message' => 'Something went wrong please try again.']);
        }
    }
}
