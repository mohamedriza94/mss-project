<?php

namespace App\Http\Controllers\Administrator\Auth;

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

    protected $redirectTo = RouteServiceProvider::ADMINISTRATOR;
    
    public function __construct()
    {
        $this->middleware('guest:administrator')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('administrator');
    }
    public function showLoginForm()
    {
        $view_data['title'] = 'Administrator Login';
        return view('administrator.auth.login', $view_data);
    }

    public function validateLogin(Request $request)
    {
        // Attempt to log the user in
        if ($this->guard()->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended(route('administrator.dashboard'));
        } 

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username'))->withErrors([
            'password' => 'Invalid Username or Password!'
        ]);
    }

    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/administrator/dashboard';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        Session::flush();
        $request->session()->regenerate(true);
        return redirect()->route('administrator.login');
    }
}
