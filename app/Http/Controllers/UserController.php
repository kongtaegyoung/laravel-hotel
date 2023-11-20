<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        return view('frontend.index');
    }// End Method
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }// End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function UserStore(Request $request)
    {
        //
        $id = Auth::user()->id;
        $data = User::find($id);
        $messages = [
            'email.unique' => '이미 등록된 이메일 주소입니다.',
            'email.required' => '이메일은 필수 입력 항목입니다.',
            'email.email' => '유효한 이메일 주소를 입력해주세요.',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users'
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstErrors = $errors->first();
        $notification = array(
            'message' => '이메일 변경에 실패하였습니다. ' . $firstErrors,
            'alert-type'=> 'error'
        );
        return back()->withErrors($validator)->withInput()->with($notification);
    }
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;



        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type'=> 'success'
        );
        return redirect('/login')->with($notification);
    }

    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('.frontend.dashboard.user_change_password');
    }//End Method

    public function ChangePasswordStore(Request $request)
    {
        //validate
        $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed'
        ]);
        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message' => 'Old Password Does not Mathc!',
                'alert-type'=> 'error'
            );
            return back()->with($notification);

        }

        ///update The New Password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_passowrd)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type'=> 'success'
        );
        return back()->with($notification);
    }//End Method
}
