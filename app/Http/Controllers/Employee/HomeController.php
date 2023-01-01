<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rawMaterial;
use App\Models\Task;
use App\Models\Employee;
use App\Models\Slot;
use App\Models\Workshop;
use App\Models\Request as InventoryRequest;
use App\Models\KanBanCard;
use Illuminate\Support\Facades\DB;

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
    
    public function counts()
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        $rawMaterialsCount = rawMaterial::where('factory','=',$factoryNo)->where('status','=','available')->count();
        $slotsCount = Slot::where('factory','=',$factoryNo)->where('status','!=','occupied')->count();
        $workersCount = Employee::where('role','=','worker')->where('departmentNo','LIKE','%'.$departmentNo.'%')->count();
        $kanbanCardsCount = KanBanCard::where('factoryNo','=',$factoryNo)->where('status','=','pending')->count();
        $workshopsCount = Workshop::where('status','=','active')->where('departmentNo','LIKE','%'.$departmentNo.'%')->count();
        $tasksCount = Task::where('factory','=',$factoryNo)->where('status','=','pending')->count();
        
        return response()->json([
            'rawMaterialsCount' => $rawMaterialsCount,
            'slotsCount' => $slotsCount,
            'workersCount' => $workersCount,
            'kanbanCardsCount' => $kanbanCardsCount,
            'workshopsCount' => $workshopsCount,
            'tasksCount' => $tasksCount,    
        ]);
    }
    
    public function IR($limit, $type)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        if($type == 'limit')
        {
            $data = InventoryRequest::join('inventories','inventories.inventoryNo', '=', 'requests.inventoryNo')
            ->where('requests.factory','LIKE','%'.$factoryNo.'%')->orderBy('requests.id','DESC')
            ->limit(5)->offSet($limit)->get([
                'inventories.name AS name',
                'requests.date AS date',
                'requests.time AS time',
                'requests.quantity AS quantity',
                'requests.status AS status'
            ]);
        }
        else
        {
            $data = InventoryRequest::join('inventories','inventories.inventoryNo', '=', 'requests.inventoryNo')
            ->where('requests.factory','LIKE','%'.$factoryNo.'%')->orderBy('requests.id','DESC')
            ->get([
                'inventories.name AS name',
                'requests.date AS date',
                'requests.time AS time',
                'requests.quantity AS quantity',
                'requests.status AS status',
            ]);
        }
        
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function AI($limit, $type)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        if($type == 'limit')
        {
            $data = rawMaterial::join('inventories','inventories.inventoryNo', '=', 'raw_materials.inventoryNo')
            ->where('raw_materials.factory','LIKE','%'.$factoryNo.'%')->orderBy('raw_materials.id','DESC')
            ->where('raw_materials.status','=','available')
            ->limit(5)->offSet($limit)->get([
                'inventories.name AS name',
                'raw_materials.availablePercentage AS availablePercentage',
            ]);
        }
        else
        {
            $data = rawMaterial::join('inventories','inventories.inventoryNo', '=', 'raw_materials.inventoryNo')
            ->where('raw_materials.factory','LIKE','%'.$factoryNo.'%')->orderBy('raw_materials.id','DESC')
            ->where('raw_materials.status','=','available')
            ->get([
                'inventories.name AS name',
                'raw_materials.availablePercentage AS availablePercentage',
            ]);
        }
        
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function WI($limit, $type)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        if($type == 'limit')
        {
            $data = DB::table('tasks')
            ->join('employees', 'tasks.worker', '=', 'employees.no')
            ->select('employees.name', 'employees.no', DB::raw('count(tasks.worker) as task_count'))
            ->groupBy('employees.name', 'employees.no')->where('tasks.status','=','completed')
            ->where('tasks.factory','LIKE','%'.$factoryNo.'%')->orderBy('tasks.id','DESC')
            ->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = DB::table('tasks')
            ->join('employees', 'tasks.worker', '=', 'employees.no')
            ->select('employees.name', 'employees.no', DB::raw('count(tasks.worker) as task_count'))
            ->groupBy('employees.name', 'employees.no')->where('tasks.status','=','completed')
            ->where('tasks.factory','LIKE','%'.$factoryNo.'%')->orderBy('tasks.id','DESC')
            ->get();
        }
        
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function WI_CurrentTask($worker)
    {
        $taskData = Task::where('worker','=',$worker)->where('status','=','started')->first();
        $taskFCT = Task::where('worker','=',$worker)->min('duration');
        
        if($taskData)
        {
            $taskData = $taskData;
        }
        else
        {
            $taskData = 'N/A';
        }

        return response()->json([
            'taskData' => $taskData,
            'taskFCT' => $taskFCT
        ]);
    }
    
    public function T($limit, $type, $status)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        if($type == 'limit')
        {
            $data = Task::join('employees','employees.no','=','tasks.worker')
            ->where('tasks.factory','=',$factoryNo)
            ->where('tasks.status','=',$status)->limit(5)->offSet($limit)->get([
                'tasks.taskNo AS taskNo',
                'tasks.name AS name',
                'tasks.startDate AS start',
                'tasks.endDate AS end',
                'tasks.duration AS duration',
                'employees.name AS worker',
            ]);
        }
        else
        {
            $data = Task::join('employees','employees.no','=','tasks.worker')
            ->where('tasks.factory','=',$factoryNo)
            ->where('tasks.status','=',$status)->get([
                'tasks.taskNo AS taskNo',
                'tasks.name AS name',
                'tasks.startDate AS start',
                'tasks.endDate AS end',
                'tasks.duration AS duration',
                'employees.name AS worker',
            ]);
        }
        
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function KBC($limit, $type, $status)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        if($type == 'limit')
        {
            $data = KanBanCard::where('status','=',$status)
            ->where('factoryNo','=',$factoryNo)   
            ->limit(5)->offSet($limit)->get();
        }
        else
        {
            $data = KanBanCard::where('status','=',$status)
            ->where('factoryNo','=',$factoryNo)   
            ->get();
        }
        
        return response()->json([
            'data' => $data
        ]);
    }
    
    public function S($limit, $type, $status)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        $departmentNo = $split_factory_string[0]; //get 0th position of array
        
        if($type == 'limit')
        {
            $data = Slot::join('workshops','workshops.no','=','slots.workshopNo')
            ->join('tasks','tasks.taskNo','=','slots.task')
            ->where('slots.factory','=',$factoryNo)
            ->where('slots.status','=',$status)->limit(5)->offSet($limit)->get([
                'slots.slotNo AS slotNo',
                'workshops.name AS workshopNo',
                'tasks.name AS task',
            ]);
        }
        else
        {
            $data = Slot::join('workshops','workshops.no','=','slots.workshopNo')
            ->join('tasks','tasks.taskNo','=','slots.task')
            ->where('slots.factory','=',$factoryNo)
            ->where('slots.status','=',$status)->get([
                'slots.slotNo AS slotNo',
                'workshops.name AS workshopNo',
                'tasks.name AS task',
            ]);
        }
        
        return response()->json([
            'data' => $data
        ]);
    }
    
}
