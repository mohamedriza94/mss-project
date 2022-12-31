<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Workshop;
use App\Models\Inventory;

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
    
    public function counts()
    {
        $factoryCount = Factory::count();
        $departmentCount = Department::count();
        $supervisorCount = Employee::where('role','=','supervisor')->count();
        $workerCount = Employee::where('role','=','worker')->count();
        $workshopCount = Workshop::where('status','=','active')->count();
        $inventoryCount = Inventory::where('status','=','available')->count();
        
        return response()->json([
            'factoryCount' => $factoryCount,
            'departmentCount' => $departmentCount,
            'supervisorCount' => $supervisorCount,
            'workerCount' => $workerCount,
            'workshopCount' => $workshopCount,
            'inventoryCount' => $inventoryCount,    
        ]);
    }
}
