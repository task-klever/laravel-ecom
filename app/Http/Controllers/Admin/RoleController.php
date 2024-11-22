<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Role_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;
use Hash;

class RoleController extends Controller
{
    public function user()
    {
        $admin_users = DB::table('admins')
            ->join('roles', 'admins.role_id', '=', 'roles.id')
            ->select('admins.*', 'roles.role_name')
            ->get();

        return view('admin.role.user', compact('admin_users'));
    }

    public function user_create()
    {
        $roles = Role::all();
        return view('admin.role.user_create', compact('roles'));
    }

    public function user_store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $admin = new Admin();
        $data = $request->only($admin->getFillable());

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:admins',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required',
                're_password' => 'required|same:password'
            ],
            [],
            [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                're_password' => 'Retype Password'
            ]
        );

        $statement = DB::select("SHOW TABLE STATUS LIKE 'admins'");
        $ai_id = $statement[0]->Auto_increment;
        $ext = $request->file('photo')->extension();
        $final_name = 'user-'.$ai_id.'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'), $final_name);
        $data['photo'] = $final_name;

        $data['password'] = Hash::make($request->password);
        $data['token'] = '';

        $admin->fill($data)->save();
        return redirect()->route('admin.role.user')->with('success', 'Admin User is added successfully!');
    }


    public function user_edit($id)
    {
        $roles = Role::all();
        $admin_user = Admin::findOrFail($id);
        return view('admin.role.user_edit', compact('admin_user','roles'));
    }

    public function user_update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $admin = Admin::findOrFail($id);
        $data = $request->only($admin->getFillable());

        if($request->hasFile('photo')) {
            $request->validate([
                'name'   =>  [
                    'required'
                ],
                'email'   =>  [
                    Rule::unique('admins')->ignore($id),
                ],
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            unlink(public_path('uploads/'.$admin->photo));
            $ext = $request->file('photo')->extension();
            $final_name = 'user-'.$id.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'), $final_name);
            $data['photo'] = $final_name;
        } else {
            $request->validate([
                'name'   =>  [
                    'required'
                ],
                'email'   =>  [
                    Rule::unique('admins')->ignore($id),
                ]
            ]);
            $data['photo'] = $admin->photo;
        }

        $admin->fill($data)->save();
        return redirect()->route('admin.role.user')->with('success', 'Admin User is updated successfully!');
    }

    public function user_edit_password($id)
    {
        $admin_user = Admin::findOrFail($id);
        return view('admin.role.user_edit_password', compact('admin_user'));
    }

    public function user_update_password(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $request->validate([
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($request->password);
        Admin::where('id',$id)->update($data);

        return redirect()->route('admin.role.user')->with('success', 'Admin User Password is updated successfully!');
    }

    public function user_destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $admin = Admin::findOrFail($id);
        unlink(public_path('uploads/'.$admin->photo));
        $admin->delete();
        return Redirect()->back()->with('success', 'Admin User is deleted successfully!');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $role = new Role();
        $data = $request->only($role->getFillable());

        $request->validate([
            'role_name' => 'required|unique:roles'
        ]);

        $statement = DB::select("SHOW TABLE STATUS LIKE 'roles'");
        $ai_id = $statement[0]->Auto_increment;

        $role->fill($data)->save();

        $role_pages_data = DB::table('role_pages')->get();
        foreach($role_pages_data as $row)
        {
            echo $row->id;
            DB::table('role_permissions')->insert([
                'role_id' => $ai_id,
                'role_page_id' => $row->id,
                'access_status' => 0
            ]);
        }
        return redirect()->route('admin.role.index')->with('success', 'Role is added successfully!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $role = Role::findOrFail($id);
        $data = $request->only($role->getFillable());

        $request->validate([
            'role_name'   =>  [
                'required',
                Rule::unique('roles')->ignore($id),
            ]
        ]);

        $role->fill($data)->save();
        return redirect()->route('admin.role.index')->with('success', 'Role is updated successfully!');
    }

    public function access_setup($id)
    {
        $role = Role::findOrFail($id);

        $role_permissions = DB::table('role_permissions')
            ->where('role_id',$id)
            ->get();

        return view('admin.role.access_setup', compact('role','role_permissions'));
    }

    public function access_setup_update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        foreach($request->role_permission_ids as $val)
        {
            $arr1[] = $val;
        }

        foreach($request->access_status_arr as $val)
        {
            $arr2[] = $val;
        }

        for($i=0;$i<count($arr1);$i++)
        {
            //Role_permission::where('id',$arr1[$i])->update(['access_status'=>$arr2[$i]]);
            DB::table('role_permissions')
                ->where('id', $arr1[$i])
                ->update(['access_status' => $arr2[$i]]);
        }

        return redirect()->route('admin.role.index')->with('success', 'Access Setup is updated successfully!');
    }

    public function destroy($id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $role = Role::findOrFail($id);
        $check_admin = DB::table('admins')
            ->where('role_id', $role->id)
            ->first();
        if($check_admin) {
            return Redirect()->back()->with('error', 'You can not delete this role, because there is user under this role.');
        }
        else {
            // Delete the role
            DB::table('roles')->where('id', '=', $id)->delete();
            DB::table('role_permissions')->where('role_id', '=', $id)->delete();
            return Redirect()->back()->with('success', 'Role is deleted successfully!');
        }

    }
}
