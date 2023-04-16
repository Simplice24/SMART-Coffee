<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DB;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function SystemRoles(){
        $no=0;
        $roles=Role::all();
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $users=User::count();
        $naeb=User::where('role','Naeb')->count();
        $rab=User::where('role','Rab')->count();
        $district_agro=User::where('role','District-agro')->count();
        $Sector_agro=User::where('role','Sector-agro')->count();
        $manager=User::where('role','Manager')->count();
        $sedo=User::where('role','SEDO')->count();
        $admin=User::where('role','Super-Admin')->count();
        return view('All-roles',['roles'=>$roles,'profileImg'=>$profileImg,'no'=>$no,'naeb'=>$naeb,
        'rab'=>$rab,'district_agro'=>$district_agro,'sector_agro'=>$Sector_agro,'manager'=>$manager,
        'sedo'=>$sedo,'admin'=>$admin,'users'=>$users]);
    }

    public function RegisterRolePage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $permission = Permission::get();
        return view('Register-role',['permission'=>$permission,'profileImg'=>$profileImg]);
    }

    public function SystemPermissions(){
        $no=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $permissions=Permission::all();
        return view('All-permissions',['permissions'=>$permissions,'profileImg'=>$profileImg,'no'=>$no]);
    }

    public function RegisterPermissionPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Register-permission',['profileImg'=>$profileImg]);
    }

    public function storeRole(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect('Allroles');
    }

    public function storePermission(Request $request){
        $permission=Permission::create(['name' => $request->input('name')]);
        return redirect('Allpermissions');
    }

    public function Roledetails($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return view('Role-details',['role'=>$role,'rolePermissions'=>$rolePermissions,'profileImg'=>$profileImg]);
    }
    public function RoleUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $role = Role::find($id);
        $permissions = Permission::get();
        return view('Role-update',['role'=>$role,'permissions'=>$permissions,'profileImg'=>$profileImg]);
    }

    public function RoleUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect('Allroles');
    }

    public function deleterole($id){
        DB::table("roles")->where('id',$id)->delete();
        return redirect('Allroles');
    }
    public function PermissionUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $permission=Permission::find($id);
        return view('Permission-detail',['permission'=>$permission,'profileImg'=>$profileImg]);
    }
    public function PermissionUpdate($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $permission=Permission::find($id);
        return view('Permission-update',['permission'=>$permission,'profileImg'=>$profileImg]);
    }

    public function Updatepermission(Request $request, $id){
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->update();
        return redirect('Allpermissions');
    }
    public function deletepermission($id){
        Permission::find($id)->delete();
        return redirect('Allpermissions');
    }


}
