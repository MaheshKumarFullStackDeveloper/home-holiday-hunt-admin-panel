<?php
namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Hash;
class AdminsController extends Controller {
    //Admin List
    public function adminsList() {
        if (Auth::user()->can('view_admin')) {
            $adminsList = Admin::where('role_id','!=',1)->get();
            return view('admins/admins_list', compact('adminsList'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //Add Admin
    public function addAdmin() {
        if (Auth::user()->can('add_admin')) {
            $roles = Role::orderBy('name')->where('id', '!=', 1)->get();
            return view('admins/add_admin', ['roles' => $roles]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //Admins Email check
    public function checkAdminEmail(Request $request) {
        $email = Admin::where('email', $request->email)->get();
        if (count($email) > 0) {
            $res = 1;
            return response()->json(['msg' => $res]);
        } else {
            $res = 0;
            return response()->json(['msg' => $res]);
        }
    }
    //Save Admin
    public function saveAdmin(Request $request) {
        if (Auth::user()->can('edit_admin')) {
            $name_split = explode(' ', $request->name, 2);
            if (count($name_split) == 1) {
                $name = $name_split[0];
                $last_name = '';
            } else {
                $name = $name_split[0];
                $last_name = $name_split[1];
            }
            Admin::create(['first_name' => $request->name, 'last_name' => $last_name, 'name' => $name, 'role_id' => $request->role_id, 'email' => $request->email, 'phone_number' => $request->phone_number, 'password' => \Hash::make($request->password), ]);
            return redirect()->route('admins_list')->with('success', 'Admin Created Successfully!');
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //View Admin
    public function viewAdmin($id) {
        if (Auth::user()->can('view_admin')) {
            $viewAdmin = Admin::where('id', $id)->get();
            return view('admins/view_admin', compact('viewAdmin'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //Edit Admin
    public function editAdmin($id) {
        if (Auth::user()->can('edit_admin')) {
            $roles = Role::orderBy('name')->where('id', '!=', 1)->get();
            $admin = Admin::where('id', $id)->get();
            return view('admins/edit_admin', ['roles' => $roles, 'admin' => $admin]);
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //Update Admin
    public function updateAdmin(Request $request) {
        if (Auth::user()->can('edit_admin')) {
            if ($request->password != null) {
                $dataToUpdate = ['name' => $request->name, 'email' => $request->email, 'role_id' => $request->role_id, 'password' => \Hash::make($request->password) ];
            } else {
                $dataToUpdate = ['name' => $request->name, 'email' => $request->email, 'role_id' => $request->role_id];
            }
            $updateAdmin = Admin::where('id', $request->id)->update($dataToUpdate);
            return redirect()->route('admins_list')->with('success', 'Admin Updated Successfully!');
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //Delete Admin
    public function deleteAdmin(Request $request) {
        $deleteAdmin = Admin::where('id', $request->id)->delete();
        if ($deleteAdmin) {
            $res['success'] = 1;
            return json_encode($res);
        } else {
            $res['success'] = 0;
            return json_encode($res);
        }
    }
    //Deleted Admins List
    public function deletedAdminsList() {
        if (Auth::user()->can('view_deleted_admin')) {
            $adminsList = Admin::onlyTrashed()->get();
            return view('admins/deleted_admins_list', compact('adminsList'));
        } else {
            return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
        }
    }
    //Restore Deleted Admin
    public function restoreAdmin(Request $request) {
        $adminsList = Admin::withTrashed()->find($request->id)->restore();
        return "success";
    }
    //Permanent Delete Admin
    public function permanentDeleteAdmin(Request $request) {
        $AdminList = Admin::onlyTrashed()->find($request->id)->forceDelete();
        return "success";
    }


    public function changepassword(){
        if(auth()->user()->role_id==1){
            return view('admins.change_password');
        }
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');

    }


    public function updatePassword(Request $request){

        $user = Auth::user();
        $user->password = Hash::make($request->confirm_password);
        $user->save();
        $toggleText = 'Show/Hide password';

        $string = $request->confirm_password;

        $length = strlen($string);

  // Determine the middle index of the string
  $middle = ceil($length / 2);

        $firstHalf = substr($string, 0, $middle);

  $secondHalf = substr($string, $middle);

      // echo $maskedString; 
        $message = "Password successfully changed and here's the updated credentials:<br><br><b>Email ID:</b> <span class='ml-4'>".Auth::user()->email."</span><br><b>Password:</b> <input type='password' class='ml-4' id='password_message' value=".$string." disabled>   <a href='#'' id='toggle-link'>" . $toggleText . "</a>";
        Auth::logout();
        session()->flash('message', $message);
        session()->flash('class', 'alert-success');
        session()->flash('secondhalfstring', $secondHalf);
       return redirect()->route('login');
       //superadmin@holidayhomehunt.com
       //Sup3r@dm!n
    }

  
}
