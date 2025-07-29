<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function PHPUnit\Framework\fileExists;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // User Logout
    function logout()
    {
        auth()->logout();
        return redirect()->route('loginForm');
    }
    // User Register Data Store
    function userRegister(Request $request)
    {
        publishSchedulePost();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'nullable|numeric|digits_between:10,15',
            'password' => 'required|string|min:1|confirmed',
            'password_confirmation' => 'required|string|min:1',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'email.max' => 'The email may not be greater than 255 characters.',

            'phone.numeric' => 'The phone number must be a valid number.',
            'phone.digits_between' => 'The phone number must be between 10 and 15 digits.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 1 characters.',
            'password.confirmed' => 'The password confirmation does not match.',

            'password_confirmation.required' => 'The password confirmation field is required.',
            'password_confirmation.string' => 'The confirmation password must be a string.',
            'password_confirmation.min' => 'The confirmation password must be at least 1 characters.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $username = strtolower(str_replace(' ', '_', $request->name));
        if (User::where('username', $username)->exists()) {
            $username = $username . rand(10, 99);
        }
        $data['username']   = $username;
        $data['type']       = 1;
        $data['password']   = bcrypt($request->password);
        $data['created_at'] = Carbon::now();
        try
        {
            $id = User::create($data)->id;
            // User::find($id)->assignRole($request->role_id);
            return back()->with('success','Registration Successful');

        }
        catch (Exception $ex)
        {
            $e = 'Something went wrong pleaser try again';
            return back()->with('error',$e);
        }
    }
    // User Lists Page View
    function userList()
    {
        publishSchedulePost();
            $role = role::where('name', '!=', 'Super Admin')->get();
            $user = User::where('id','!=', 1)->where('id','!=', Auth::id())->get();
            return view('admin/user/userList', [
                'user' => $user,
                'role' => $role,
            ]);
    }
    // User Profile Page View
    function userAccount($user_id)
    {
        publishSchedulePost();
        $user_info = user::find($user_id);
        return view('admin/user/userAccount',[
            'user_info' => $user_info,
        ]);
    }
    // User username update
    function userUpdateUsername(Request $request)
    {
        publishSchedulePost();
        if (User::where('username', $request->username)->exists()) {
            return back()->with('error', 'username already exists!');
        }
        $userUpdate = user::find($request->id)->update([
            'username' => $request->username,
            'updated_at' => Carbon::now(),
        ]);

        if($userUpdate)
        {
            return back()->with('success','User Information Updated Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }
    // User name update
    function userUpdateName(Request $request)
    {
        publishSchedulePost();
        $userUpdate = user::find($request->id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ]);

        if($userUpdate)
        {
            return back()->with('success','User Information Updated Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }
    // User number update
    function userUpdatePhone(Request $request)
    {
        publishSchedulePost();
        $userUpdate = user::find($request->id)->update([
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        if($userUpdate)
        {
            return back()->with('success','User Information Updated Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }
    // user confirm password view
    function userConfirmPassword($user_id , $type)
    {
        publishSchedulePost();
        $user = user::find($user_id);

        if(Auth::id() == $user_id)
        {
            return view('admin/user/userConfirmPass', [
                'user' => $user,
                'type' => $type,
            ]);
        }
        else
        {
            return redirect()->route('viewUserChangePassOrMail',[$user_id,$type]);
        }
    }
    // user confirm password or email view
    function userUpdatePassOrMail(Request $request)
    {
        publishSchedulePost();
        $request->validate([
            'password' => "required",
        ]);
        $user = user::find($request->id);
        if(Hash::check($request->password, $user->password))
        {
            return redirect()->route('viewUserChangePassOrMail',[$request->id,$request->type]);
        }
        else
        {
            return back()->with('error','Incorrect Password');
        }
    }
    // User email or pass update view
    function viewUserChangePassOrMail($user_id , $type)
    {
        publishSchedulePost();
        $user = user::find($user_id);
        return view('admin/user/userChangeMailOrPass', [
            'user' => $user,
            'type' => $type,
        ]);
    }
    // user pass or mail update
    function userChangePassOrMail(Request $request)
    {
        publishSchedulePost();
        if($request->type == 1)
        {
            $request->validate([
                'newemail' => "required",
            ]);
            $user = user::find($request->id)->update([
                'email' => $request->newemail,
            ]);
            if($user)
            {
                return redirect()->route('userAccount',$request->id)->with('success','Email Address Updated Successfully');
            }
            else
            {
                return back()->with('error','Something went wrong please try again');
            }
        }
        else
        {
            $request->validate([
                'newpass' => "required",
                'confirmpass' => "required",
            ]);

            if($request->newpass == $request->confirmpass)
            {
                $user = user::find($request->id)->update([
                    'password' => bcrypt($request->newpass),
                ]);
                if($user)
                {
                    return redirect()->route('userAccount',$request->id)->with('success','Password Updated Successfully');
                }
                else
                {
                    return redirect()->route('viewUserChangePassOrMail',[$request->id,$request->type])->with('error','Something went wrong please try again');
                }
            }
            else
            {
                return redirect()->route('viewUserChangePassOrMail',[$request->id,$request->type])->with('error','Password did not matched');
            }
        }

    }
    // user photo view
    function userPhoto($id)
    {
        publishSchedulePost();
        $user = user::find($id);
        return view('admin/user/userPhoto', [
            'user' => $user,
        ]);
    }
    // user photo update
    function updateUserPhoto(Request $request)
    {
        publishSchedulePost();
        $request->validate([
            'userPhoto' => 'required',
        ]);

        $user = user::find($request->id);
        $user_image = $request->userPhoto;
        $extension = $user_image->getClientOriginalExtension();
        $file_name = "User-".$user->id.".".$extension;
        Image::make($user_image)->resize(128, 128)->save(public_path('uploads/images/users/'.$file_name));
        if($user->photo != Null)
        {
            $delete_previous_image_from = public_path('uploads/images/users/').$file_name;
            if(fileExists($delete_previous_image_from))
            {
                unlink($delete_previous_image_from);
            }
        }

        $userUpdateSuccess = user::find($request->id)->update([
            'image' => $file_name,
            'updated_at' => Carbon::now(),
        ]);

        if($userUpdateSuccess)
        {
            return back()->with('success','User Information Updated Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }
    //  user soft delete
    function userDelete($id)
    {
        publishSchedulePost();
        $user_delete = user::find($id)->delete();
        if($user_delete)
        {
            return back()->with('success','User Deleted Successful');
        }
        else{
            return back()->with('error','Something went wrong try again');
        }
    }

}
