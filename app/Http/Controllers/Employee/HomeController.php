<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->guard('employee')->user()->role == "supervisor")
        {
            return view('employee.dashboard.supervisor.home');
        }
        else if(auth()->guard('employee')->user()->role == "worker")
        {
            return view('employee.dashboard.worker.home');
        }
    }
}
