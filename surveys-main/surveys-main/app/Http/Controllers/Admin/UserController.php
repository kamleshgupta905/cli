<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\ValidationController;
use App\Models\admin\Menu;
use App\Models\admin\MenuPermission;
use App\Models\admin\Role;
use App\Models\admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data['userList'] = User::whereDoesntHave('role', function ($query) {
            $query->where('role', 'Developer');
        })->with('role')->get();
        $body['bodyView'] = view('admin/user_management/userlist', $data);
        return LayoutController::loadAdmin($body);
    }

    public function addEdit(Request $request, $id = '')
    {
        $data['title'] = $request->post('title');
        $data = LayoutController::addEditCommon($id, $data);
        $data['usereditData'] = [];
        if ($id > 0) {
            $data['usereditData'] = User::find($id);
        }

        $data['roleList'] = Role::where('is_active', 1)->where('role', '<>', 'Developer')->where('role', '<>', 'Customer')->get();
        return view('admin/user_management/addedit_user', $data)->render();
    }


    public function addEditAction(Request $request)
    {
        $userId = $request->post('user_id');
        $mode = $request->post('mode');
        $validator = ValidationController::inputValidate($request, User::class, "", $userId);
        $customValidator = Validator::make($request->all(), [
            'imagefile' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'mobile_no' => 'required',
            'confirm_password' => ($mode == "Add") ? 'required|same:password' : '',
        ]);
        if ($validator['msg_status'] == 0 || $customValidator->fails()) {
            $error = $validator['errors']->merge($customValidator->errors());
            return response()->json(['msg_status' => 0, 'errors' => $error]);
        } else {

            try {

                DB::beginTransaction();

                $name = $request->post('name');
                $username = $request->post('username');
                $password = $request->post('password');
                $role_id = $request->post('role_id');
                $mobile_no = $request->post('mobile_no');
                $email = $request->post('email');

                if ($userId > 0) {
                    $model = User::find($userId);
                    $msg = "Update successfully";
                } else {
                    $model = new User();
                    $model->password = Hash::make($password);
                    $msg = "Save successfully";
                }

                if ($request->hasFile('imagefile')) {
                    $image = $request->file('imagefile');
                    $imageName = "AN" . time() . 'IL.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/users', $imageName);
                    $model->profile_image = $imageName;
                }

                $model->name = $name;
                $model->username = $username;
                $model->email = $email;
                $model->role_id = $role_id;
                $model->mobile_no = $mobile_no;
                if ($model->save()) {
                    if ($userId <= 0) {
                        $user_id = $model->id;
                        $allmenus = Menu::select('id')->get();
                        foreach ($allmenus as $menus) {
                            if ($menus->id == 1 || $menus->id == 2 || $menus->id == 5) {
                                $permission = new MenuPermission();
                                $permission->user_id = $user_id;
                                $permission->menu_id = $menus->id;
                                $permission->save();
                            }
                        }
                    }
                }

                DB::commit();
                return response()->json(['errors' => [], 'msg_status' => 1, 'msg_data' => $msg]);
            } catch (\Exception $e) {
                DB::rollback();
                $error = $e->getMessage();
                $msg = 'Refresh your page,Try Again';
                return response()->json(['msg_status' => 2, 'msg_data' => $error]);
            }
        }
    }

    public function status(Request $request, $status, $id)
    {
        $model = User::find($id);
        $model->is_active = $status;
        $model->save();
        $request->session()->flash('message', 'User status update successfully');
        return redirect('admin/user');
    }

    public function getloginLogoutDetailByUserId(Request $request)
    {


        $userid = $request->input('userid');
        $table = "";
        $userActivity = DB::table('user_account_activitys')->where(['user_id' => $userid])->get();

        $table = "<div class='formblock-box'><div class='table-responsive'>
        <table id='loginLogoutTable' class='table customTbl table-bordered table-hover dataTable'>
           <thead>
               <tr>
                   <th>Login Date & Time</th>

                   <th>Logout Date & Time</th>

                   <th>Browser</th>

                   <th>Device OS</th>
               </tr>
           </thead>

           <tbody>
               ";
        foreach ($userActivity as $Activity) {
            $logout_time = "";
            if ($Activity->logout_time != "") {
                $logout_time = date('d-m-Y h:i A', strtotime($Activity->logout_time));
            }
            $table .= "
               <tr>
                   <td>" . date('d-m-Y h:i A', strtotime($Activity->login_time)) . "</td>

                   <td>" . $logout_time . "</td>

                   <td>" . $Activity->user_browser . "</td>

                   <td>" . $Activity->user_platform . "</td>
               </tr>
               ";
        }
        $table .= "
           </tbody>
       </table></div></div>
       ";
        echo $table;
    }
}
