<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $view_data['title'] = 'Dashboard';
        return view('employee.dashboard.index')->with($view_data);
    }
}
