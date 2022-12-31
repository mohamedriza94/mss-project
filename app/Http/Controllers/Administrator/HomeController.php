<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Workshop;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

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
    
    public function PKBC($limit, $type) //pending kanban card count of each factory
    {
        if($type == 'limit')
        {
            $data = DB::table('kan_ban_cards')
            ->join('factories', 'kan_ban_cards.factoryNo', '=', 'factories.no')
            ->select('factories.name', 'kan_ban_cards.factoryNo', DB::raw('count(*) as count'))
            ->groupBy('kan_ban_cards.factoryNo', 'factories.name')->where('status','=','pending')
            ->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = DB::table('kan_ban_cards')
            ->join('factories', 'kan_ban_cards.factoryNo', '=', 'factories.no')
            ->select('factories.name', 'kan_ban_cards.factoryNo', DB::raw('count(*) as count'))
            ->groupBy('kan_ban_cards.factoryNo', 'factories.name')->where('status','=','pending')
            ->get();
        }
        
        return response()->json([
            'data'=>$data
        ]);
    }
    
    public function PTT($limit, $type) //pending task count of each factory
    {
        if($type == 'limit')
        {
            $data = DB::table('tasks')
            ->join('factories', 'tasks.factory', '=', 'factories.no')
            ->select('factories.name', 'tasks.factory', DB::raw('count(*) as count'))
            ->groupBy('tasks.factory', 'factories.name')->where('status','=','pending')
            ->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = DB::table('tasks')
            ->join('factories', 'tasks.factory', '=', 'factories.no')
            ->select('factories.name', 'tasks.factory', DB::raw('count(*) as count'))
            ->groupBy('tasks.factory', 'factories.name')->where('status','=','pending')
            ->get();
        }
        
        return response()->json([
            'data'=>$data
        ]);
    }
    
    public function CTT($limit, $type) //completed task count of each factory
    {
        if($type == 'limit')
        {
            $data = DB::table('tasks')
            ->join('factories', 'tasks.factory', '=', 'factories.no')
            ->select('factories.name', 'tasks.factory', DB::raw('count(*) as count'))
            ->groupBy('tasks.factory', 'factories.name')->where('status','=','completed')
            ->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = DB::table('tasks')
            ->join('factories', 'tasks.factory', '=', 'factories.no')
            ->select('factories.name', 'tasks.factory', DB::raw('count(*) as count'))
            ->groupBy('tasks.factory', 'factories.name')->where('status','=','completed')
            ->get();
        }
        
        return response()->json([
            'data'=>$data
        ]);
    }
    
    public function AIT($limit, $type)
    {
        if($type == 'limit')
        {
            $data = DB::table('requests')
            ->join('factories', 'requests.factory', '=', 'factories.no')
            ->select('factories.name', 'requests.factory', DB::raw('count(*) as count'))
            ->groupBy('requests.factory', 'factories.name')
            ->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = DB::table('requests')
            ->join('factories', 'requests.factory', '=', 'factories.no')
            ->select('factories.name', 'requests.factory', DB::raw('count(*) as count'))
            ->groupBy('requests.factory', 'factories.name')
            ->get();
        }
        
        return response()->json([
            'data'=>$data
        ]);
    }
    
    public function FT($limit, $type)
    {
        if($type == 'limit')
        { 
            $data = Inventory::where('status','=','available')->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = Inventory::where('status','=','available')->get();
        }
        
        return response()->json([
            'data'=>$data
        ]);
    }
}
