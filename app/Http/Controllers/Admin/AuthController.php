<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function do_login(Request $request)
    {
        $email = $request->email;
        $password =$request->password;
        if(auth('admin')->attempt(['email'=>$email,'password'=>$password])){
            session()->flash('success', 'تم تسجيل الدخول بنجاح admin');
            return redirect()->route('admin.home');
        }elseif(auth('user')->attempt(['email'=>$email,'password'=>$password])){
            session()->flash('success', 'تم تسجيل الدخول بنجاح user');
            return redirect()->route('user.home');
        }else{
            session()->flash('error', 'البريد الالكتروني او كلمة المرور غير صحيحة');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        if(auth('admin')->check()){
            auth('admin')->logout();
            session()->flash('success', 'تم تسجيل الخروج بنجاح admin');
            return redirect()->route('admin.login');
        }
        else{
        auth('user'    )->logout();
        session()->flash('success', 'تم تسجيل الخروج بنجاح user');
        return redirect()->route('admin.login');
    }
}
}
