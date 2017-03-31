<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;


class AdminController extends controller
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function redirectTo()
    {
        return '/admin';
    }
    
    protected function showLoginForm()
    {
        return view('admin.auth.login');
    }  

    public function username()
    {
        return 'name';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin/login');
    }


}