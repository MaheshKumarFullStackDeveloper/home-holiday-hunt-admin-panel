<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Admin;
use Auth;

class RolesController extends Controller
{
    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function list(Request $request)
    {
        if (Auth::user()->can('view_role')) {
            $roles = Role::orderBy('name')
                ->where('id', '!=', 1)
                ->get();
            return view('roles.list', ['roles' => $roles]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function view($id)
    {
        if (Auth::user()->can('view_role')) {
            $role = Role::find($id);
            $permissions = \DB::table('permission_role')
                ->where('role_id', $role->id)
                ->get();
            return view('roles.view', [
                'role' => $role,
                'permissions' => $permissions
            ]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function add(Request $request)
    {
        if (Auth::user()->can('add_role')) {
            return view('roles.add');
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function save(Request $request)
    {
        if (Auth::user()->can('edit_role')) {
            $nameToLowercase = strtolower($request->role_name);
            $roleTag = $name = str_replace(' ', '_', $nameToLowercase);
            $role = Role::where("tag", $roleTag)->get();
            if (count($role) <= 0) {
                $role = new Role();
                $role->name = $request->role_name;
                $role->tag = $roleTag;
                $role->status = 1;
                $role->role_type = '2';
                if ($role->save()) {
                    $roles = Role::where('id', '!=', 1)->get();
                    return redirect()
                        ->route('role.list', ['roles' => $roles])
                        ->with('success', 'Role Added successfully!');
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'Something went wrong!');
                }
            } else {
                $roles = Role::where('id', '!=', 1)->get();
                return redirect()
                    ->route('list', ['roles' => $roles])
                    ->with(
                        'error',
                        'The Role already exists! Please edit the Role if you want to make any changes.'
                    );
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function edit($id)
    {
        if (Auth::user()->can('edit_role')) {
            $role = Role::find($id);
            return view('roles.edit', [
                'role' => $role
            ]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Update Role
     */
    public function update(Request $request)
    {
        if (Auth::user()->can('edit_role')) {
            $updateRole = Role::where('id', $request->id)->update([
                'name' => $request->name
            ]);
            if ($updateRole) {
                $roles = Role::orderByDesc('id')->get();
                return redirect()
                    ->route('role.list', ['roles' => $roles])
                    ->with('success', 'Role Updated successfully!');
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function getRolePermissions(Request $request)
    {
        $rolePermissions = \DB::table('permission_role')
            ->where('role_id', $request->role_id)
            ->get();
        return json_encode($rolePermissions);
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function permissions(Request $request)
    {
        if (Auth::user()->can('view_permission')) {
            $roles = Role::orderBy('name')
                ->where('id', '!=', 1)
                ->get();
            if ($roles->isNotEmpty()) {
                $appUsersPermissions = Permission::where(
                    'module_slug',
                    'manage_user'
                )->get();
                $adminPermissions = Permission::where(
                    'module_slug',
                    'manage_admin'
                )->get();
                $marketingUserPermissions = Permission::where(
                    'module_slug',
                    'manage_marketing_user'
                )->get();
                $VoterPermissions = Permission::where(
                    'module_slug',
                    'manage_voter'
                )->get();
                $ChampionPermissions = Permission::where(
                    'module_slug',
                    'manage_champion'
                )->get();
                $productPermissions = Permission::where(
                    'module_slug',
                    'manage_product'
                )->get();
                $orderPermissions = Permission::where(
                    'module_slug',
                    'manage_order'
                )->get();
                 $transactionPermissions = Permission::where(
                    'module_slug',
                    'payment_transaction'
                )->get();

                $mobileContentPermissions = Permission::where(
                    'module_slug',
                    'manage_mobile_content'
                )->get();
                $contactUSPermissions = Permission::where(
                    'module_slug',
                    'manage_contact_us'
                )->get();
                $reviewPermissions = Permission::where(
                    'module_slug',
                    'manage_review'
                )->get();
                $subscriptionPermissions = Permission::where(
                    'module_slug',
                    'manage_plans'
                )->get();
                $interestsPermissions = Permission::where(
                    'module_slug',
                    'manage_interests'
                )->get();
                $ethinicityPermissions = Permission::where(
                    'module_slug',
                    'manage_destinations'
                )->get();
                 $destinationsPermissions = Permission::where(
                    'module_slug',
                    'manage_ethinicity'
                )->get();
                $rolesPermissions = Permission::where(
                    'module_slug',
                    'manage_roles'
                )->get();

                $permissionPermissions = Permission::where(
                    'module_slug',
                    'manage_permission'
                )->get();
                $recycle_binPermissions = Permission::where(
                    'module_slug',
                    'recycle_bin'
                )->get();

                return view('roles.role_permissions', [
                    'roles' => $roles,
                    'appUsersPermissions' => $appUsersPermissions,
                    'adminPermissions' => $adminPermissions,
                    'marketingUserPermissions' => $marketingUserPermissions,
                    'productPermissions' => $productPermissions,
                    'orderPermissions' => $orderPermissions,
                    'transactionPermissions' => $transactionPermissions,
                    'mobileContentPermissions' => $mobileContentPermissions,
                    'contactUSPermissions' => $contactUSPermissions,
                    'reviewPermissions' => $reviewPermissions,
                    'subscriptionPermissions' => $subscriptionPermissions,
                    'interestsPermissions' => $interestsPermissions,
                    'ethinicityPermissions' => $ethinicityPermissions,
                    'destinationsPermissions' => $destinationsPermissions,
                    'rolesPermissions' => $rolesPermissions,
                    'permissionPermissions' => $permissionPermissions,
                    'recycle_binPermissions' => $recycle_binPermissions,
                    'voter_permissions' => $VoterPermissions,
                    'champion_permissions' => $ChampionPermissions,
                    
                    
                ]);
            } else {
                return redirect()
                    ->route('add_role')
                    ->with(
                        'warning',
                        'No Roles Found! Please add a Role first.'
                    );
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function savePermissions(Request $request)
    {
        if (Auth::user()->can('edit_permission')) {
            $role = Role::find($request->role_id);
            $updatePermissions = $role
                ->permissions()
                ->sync($request->permissions);
            if ($updatePermissions) {
                $roles = Role::where('id', '!=', 1)->get();
                return back()->with(
                    'success',
                    'Role Permissions Added successfully!'
                );
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Permanent Delete Role
     */
    public function permanentDeleteRole(Request $request)
    {
        $role = Role::where('id', $request->id)
            ->onlyTrashed()
            ->first();
        $role->permissionRoles()->forceDelete();
        $role->admins()->forceDelete();
        $deleteRole = $role->forceDelete();
        if ($deleteRole) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            $res['message'] = "Something went wrong! Please try again.";
            return json_encode($res);
        }
    }

    /**
     * This function is used to Show Saved Jobs Listing
     */
    public function deleteRole(Request $request)
    {
        $admin = Admin::where('role_id', $request->id)->first();
        if ($admin != null) {
            $res['success'] = 0;
            $res['message'] =
                "You cannot delete this record as it's being used.";
            return json_encode($res);
        } else {
            $role = Role::where('id', $request->id)->first();
            $role->permissionRoles()->delete();
            $role->admins()->delete();
            $deleteRole = $role->delete();
            if ($deleteRole) {
                $res['success'] = 1;
                return json_encode($res);
            } else {
                $res['success'] = 0;
                $res['message'] = "Something went wrong! Please try again.";
                return json_encode($res);
            }
        }
    }

    /**
     * This function is used to Show deleted Roles
     */
    public function deletedRoles()
    {
        if (Auth::user()->can('view_deleted_role')) {
            $deletedRoles = Role::onlyTrashed()
                ->orderByDesc('id')
                ->get();

            return view('roles.deleted_roles_list', [
                'deletedRoles' => $deletedRoles
            ]);
        } else {
            return redirect()
                ->route('dashboard')
                ->with(
                    'warning',
                    'You do not have permission for this action!'
                );
        }
    }

    /**
     * This function is used to Restore Roles
     */
    public function restoreRole(Request $request)
    {
        $role = Role::where('id', $request->id)
            ->onlyTrashed()
            ->first();
        $role->permissionRoles()->restore();
        $role->admins()->restore();
        $restoreRole = $role->restore();
        if ($restoreRole) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            $res['message'] = "Something went wrong! Please try again.";
            return json_encode($res);
        }
    }

    public function getAllPermissions(Request $request)
    {
        $permissions = Permission::orderBy('name')->get();
        for ($i = 0; $i < count($permissions); $i++) {
            echo $permissions[$i]->id . ' : ' . $permissions[$i]->slug . "<br>";
            echo "\n";
        }
    }

    public function getUserPermissions(Request $request)
    {
        $user = $request->user();
        $permissions = $user->role->permissions;
        for ($i = 0; $i < count($permissions); $i++) {
            echo $permissions[$i]->id . ' : ' . $permissions[$i]->slug . "<br>";
            echo "\n";
        }
    }
}
