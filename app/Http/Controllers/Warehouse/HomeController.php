<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $view_data['title'] = 'Dashboard';
        return view('warehouse.dashboard.index')->with($view_data);
    }
}
