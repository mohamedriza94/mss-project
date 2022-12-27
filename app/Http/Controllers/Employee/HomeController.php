<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->guard('employee')->user()->role == 'supervisor')
        {
            return view('employee.dashboard.supervisor.home');
        }
        else if(auth()->guard('employee')->user()->role == 'worker')
        {
            return view('employee.dashboard.worker.home');
        }
    }
    
    public function workshop(Request $request)
    {
        if(auth()->guard('employee')->user()->role == 'supervisor')
        {
            return view('employee.dashboard.supervisor.workshop');
        }
        else if(auth()->guard('employee')->user()->role == 'worker')
        {
            return back();
        }
    }
    
    public function kanbanCard(Request $request)
    {
        if(auth()->guard('employee')->user()->role == 'supervisor')
        {
            return view('employee.dashboard.supervisor.kanbanCard');
        }
        else if(auth()->guard('employee')->user()->role == 'worker')
        {
            return back();
        }
    }
    
    public function worker(Request $request)
    {
        if(auth()->guard('employee')->user()->role == 'supervisor')
        {
            return view('employee.dashboard.supervisor.worker');
        }
        else if(auth()->guard('employee')->user()->role == 'worker')
        {
            return back();
        }
    }
    
    public function inventory(Request $request)
    {
        if(auth()->guard('employee')->user()->role == 'supervisor')
        {
            return view('employee.dashboard.supervisor.inventory');
        }
        else if(auth()->guard('employee')->user()->role == 'worker')
        {
            return back();
        }
    }
}
