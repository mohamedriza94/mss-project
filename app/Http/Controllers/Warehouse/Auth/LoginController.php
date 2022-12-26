<?php

namespace App\Http\Controllers\Warehouse\Auth;

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

    protected $redirectTo = RouteServiceProvider::WAREHOUSE;
    
    public function __construct()
    {
        $this->middleware('guest:warehouse')->except('logout');
    }
    
    protected function guard()
    {
        return Auth::guard('warehouse');
    }
    public function showLoginForm()
    {
        $view_data['title'] = 'Employee Login';
        return view('warehouse.auth.login', $view_data);
    }

    public function validateLogin(Request $request)
    {
        // Attempt to log the user in
        if ($this->guard()->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended(route('warehouse.dashboard'));
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
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/warehouse/dashboard';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        Session::flush();
        $request->session()->regenerate(true);
        return redirect()->route('warehouse.login');
    }
}
