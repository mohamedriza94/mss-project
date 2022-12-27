<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::EMPLOYEE;
    
    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('employee');
    }
    public function showLoginForm()
    {
        $view_data['title'] = 'Employee Login';
        return view('employee.auth.login', $view_data);
    }

    public function validateLogin(Request $request)
    {
        // Attempt to log the user in
        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('employee.dashboard'));
        } 

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'password' => 'Invalid Email or Password!'
        ]);
    }

    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/employee/dashboard';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        Session::flush();
        $request->session()->regenerate(true);
        return redirect()->route('employee.login');
    }
}
