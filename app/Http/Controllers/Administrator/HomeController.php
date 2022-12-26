<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('administrator.dashboard.home');
    }

    public function factory()
    {
        return view('administrator.dashboard.factory');
    }
    
    public function department()
    {
        return view('administrator.dashboard.department');
    }
    
    public function supervisor()
    {
        return view('administrator.dashboard.supervisor');
    }
}
