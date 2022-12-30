<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KanBanCard;
use App\Models\Task;
use App\Models\rawMaterial;
use App\Models\UsedRawMaterial;
use App\Models\Slot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Request as inventoryRequest;
use Illuminate\Support\Facades\DB;
class KanBanCardController extends Controller
{
    //CRUD Kanban Card
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'cardNo' => ['required','unique:kan_ban_cards'],
            'title' => ['required'],
            'description' => ['required'],
            
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $KanBanCards = new KanBanCard;
            $KanBanCards->cardNo = $request->input('cardNo');
            $KanBanCards->providedBy = auth()->guard('employee')->user()->id;
            
            //exploding a string to get factory number from the supervisor
            $factory_string  = auth()->guard('employee')->user()->departmentNo;
            $split_factory_string = explode(" ", $factory_string);
            $factoryNo = $split_factory_string[1]; //get 1st position of array
            
            $KanBanCards->factoryNo = $factoryNo;
            $KanBanCards->status = 'pending';
            $KanBanCards->date = NOW();
            $KanBanCards->time = NOW();
            $KanBanCards->title = $request->input('title');
            $KanBanCards->description = $request->input('description');
            $KanBanCards->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read($limit)
    {
        $cards = KanBanCard::orderBy('id', 'DESC')->limit(5)->offSet($limit)->get();
        return response()->json([
            'cards'=>$cards,
        ]);
    }
    
    public function readOne($no)
    {
        $cards = KanBanCard::where('cardNo','=',$no)->first();
        return response()->json([
            'cards'=>$cards,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $KanBanCards = KanBanCard::find($request->input('id'));
            $KanBanCards->title = $request->input('title');
            $KanBanCards->description = $request->input('description');
            $KanBanCards->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete($no)
    {
        $KanBanCards = KanBanCard::where('cardNo','=',$no);
        $KanBanCards->delete();
        
        $tasks = Task::where('cardNo','=',$no);
        $tasks->delete();
    }
    
    public function readTask($cardNo, $limit_arrow)
    {
        $tasks = Task::where('cardNo','=',$cardNo)->orderBy('id', 'DESC')->limit(5)->offSet($limit_arrow)->get();
        return response()->json([
            'tasks'=>$tasks,
        ]);
    }
    
    //CRUD Task
    public function createTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'taskNo' => ['required','unique:tasks'],
            'cardNo' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'startDate' => ['required'],
            'endDate' => ['required'],
            'duration' => ['required'],
            
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $explode_string  = auth()->guard('employee')->user()->departmentNo;
            $split_explode_string = explode(" ", $explode_string);
            $factoryNo = $split_explode_string[1]; //get 1st position of array
            
            $tasks = new Task;
            $tasks->taskNo = $request->input('taskNo');
            $tasks->cardNo = $request->input('cardNo');
            $tasks->name = $request->input('name');
            $tasks->factory = $factoryNo;
            $tasks->description = $request->input('description');
            $tasks->date = NOW();
            $tasks->time = NOW();
            $tasks->startDate = $request->input('startDate');
            $tasks->endDate = $request->input('endDate');
            $tasks->duration = $request->input('duration');
            $tasks->status = 'pending';
            
            //occupy a slot for the task
            $slot_check = Slot::where('factory','=',$factoryNo)->where('status','=','available')->take(1)->first();
            
            if($slot_check)
            {
                $slot_number = $slot_check['id']; //get a slot
                $slot_workshopNumber = $slot_check['workshopNo']; //get workshop number
                
                $slot_update = Slot::find($slot_number);
                $slot_update->task = $request->input('taskNo');
                $slot_update->status = 'occupied';
                $slot_update->save();
                
                $tasks->workshop = $slot_workshopNumber;
            }
            
            $tasks->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function readOneTask($no)
    {
        $tasks = Task::where('taskNo','=',$no)->first();
        return response()->json([
            'tasks'=>$tasks,
        ]);
    }
    
    public function updateTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'taskId' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'startDate' => ['required'],
            'endDate' => ['required'],
            'duration' => ['required'],
            
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $tasks = Task::find($request->input('taskId'));
            $tasks->name = $request->input('name');
            $tasks->description = $request->input('description');
            $tasks->startDate = $request->input('startDate');
            $tasks->endDate = $request->input('endDate');
            $tasks->duration = $request->input('duration');
            $tasks->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function deleteTask($no)
    {
        $slot_update = Slot::where('task','=',$no)->first();
        $slot_update->task = '-';
        $slot_update->status = 'available';
        $slot_update->update();
        
        $tasks = Task::where('taskNo','=',$no);
        $tasks->delete();
    }
    
    public function autoSchedule()
    {
        $explode_string  = auth()->guard('employee')->user()->departmentNo;
        $split_explode_string = explode(" ", $explode_string);
        $factoryNo = $split_explode_string[1]; //get 1st position of array
        
        //get available work slot in factory
        $slot_check = Slot::where('factory','=',$factoryNo)->where('status','=','available')->first();
        
        $slot_number = "";
        $raw_material_status = "";
        if($slot_check)
        {
            $slot_number = $slot_check['slotNo']; //get a slot
        }
        else
        {
            $slot_number = "-"; //no slots available
        }
        
        //get available raw material data
        $rawMaterial_check = rawMaterial::where('factory','=',$factoryNo)->where('availablePercentage','<','30')->first();
        
        if($rawMaterial_check)
        {
            $raw_material_status = "0"; //insufficient
        }
        else
        {
            $raw_material_status = "1"; //sufficient
        }
        
        if($slot_number != "-") //if slot exists
        {
            if($raw_material_status != "0")
            {
                //check if records exist in task table
                $getTaskCount = Task::where('factory','=',$factoryNo)->where('status','=','completed')->count();
                
                if($getTaskCount >= 2)
                {
                    //check work completion duration
                    $duration_check = DB::table('tasks')->select('duration', DB::raw('COUNT(*) as count'))
                    ->groupBy('duration')->where('factory','=',$factoryNo)->orderBy('count', 'desc')->get();
                    
                    if($duration_check)
                    {
                        $first_data = $duration_check->skip(0)->take(1)->first()->duration; //first most repeated
                        $second_data = $duration_check->skip(1)->take(1)->first()->duration; //second most repeated
                        
                        $firstCalculation = $first_data - $second_data;
                        $secondCalculation = $second_data - $first_data;
                        $randNumber = 0;
                        
                        if ( $firstCalculation < 0 )
                        {
                            $randNumber = $secondCalculation;
                        }
                        else
                        {
                            $randNumber = $firstCalculation;
                        }
                        
                        
                        $days = $first_data + $randNumber + rand(1,5);
                        
                        return response()->json([
                            'days'=>$days,
                            'status'=>200
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'message'=>'Insufficient Data to Auto Schedule!',
                            'status'=>400
                        ]);
                    }
                }
                else
                {
                    return response()->json([
                        'message'=>'Insufficient Data to Auto Schedule!',
                        'status'=>400
                    ]);
                }
                
            }
            else
            {
                return response()->json([
                    'message'=>'Insufficient Raw Materials to Auto Schedule!',
                    'status'=>400
                ]);
            }
        }
        else
        {
            return response()->json([
                'message'=>'Slots Unavailable',
                'status'=>400
            ]);
        }
    }
    
    public function getWorkerTask()
    {
        //get workshop number of worker
        $workshopNo_string  = auth()->guard('employee')->user()->departmentNo;
        $split_workshopNo_string = explode(" ", $workshopNo_string);
        $workshopNo = $split_workshopNo_string[0]; //get 0th position of array
        
        $task = Task::where('status','=','pending')->where('workshop','LIKE','%'.$workshopNo.'%')->first();
        
        if($task)
        {
            return response()->json([
                'status'=>200,
                'task'=>$task,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
                'message'=>'No Tasks At This Time!',
            ]);
        }
        
    }
    
    public function useRawMaterial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'task' => ['required'],
            'card' => ['required'],
            'factory' => ['required'],
            'rawMaterial' => ['required'],
            'workshop' => ['required'],
            'worker' => ['required'],
            'quantity' => ['required'],
            
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>'Something is Missing!'
            ]);
        }
        else
        {
            //check if inputted quantity is bigger than 0
            if($request->input('quantity') > 0)
            {
                //get current quantity details AND check if raw materials are available
                $updateQuantity = rawMaterial::where('no','=',$request->input('rawMaterial'))->first();
                $quantity = $updateQuantity['quantity'];

                if($quantity > 0)
                {
                    $minimumQuantity = $updateQuantity['minimumQuantity'];
                    $repurchaseQuantity = $updateQuantity['repurchaseQuantity'];
                    $inventoryNo = $updateQuantity['inventoryNo'];
                    
                    //calculate new current quantity
                    $newQuantity = $quantity - $request->input('quantity');
                    
                    //calculate percentage of new available quantity and round up
                    $totalQuantity = $minimumQuantity + $repurchaseQuantity;
                    $availablePercentage = $newQuantity / $totalQuantity * 100;
                    $availablePercentage = round($availablePercentage);
    
                    //check if a row with same raw and same task exist
                    $check_usedRM = UsedRawMaterial::where('task','=',$request->input('task'))->where('rawMaterial','=',$request->input('rawMaterial'))->first();
                    
                    if($check_usedRM)
                    {
                        $usedRM_quantity = $check_usedRM['quantity'];
                        
                        $new_usedRM_quantity = $request->input('quantity') + $usedRM_quantity;
                        
                        //update used raw materials
                        $check_usedRM->quantity = $new_usedRM_quantity;
                        $check_usedRM->save();
                    }
                    else
                    {
                        //store used raw materials
                        $usedRM = New UsedRawMaterial;
                        $usedRM->task = $request->input('task');
                        $usedRM->card = $request->input('card');
                        $usedRM->factory = $request->input('factory');
                        $usedRM->rawMaterial = $request->input('rawMaterial');
                        $usedRM->workshop = $request->input('workshop');
                        $usedRM->quantity = $request->input('quantity');
                        $usedRM->worker = $request->input('worker');
                        $usedRM->inventory = $inventoryNo;
                        $usedRM->save();
                    }
                    
                    //update quantity
                    $rawMaterials = rawMaterial::where('no','=',$request->input('rawMaterial'))->first();
                    $rawMaterials->quantity = $newQuantity;
                    $rawMaterials->minimumQuantity = $minimumQuantity;
                    $rawMaterials->availablePercentage = $availablePercentage;
                    $rawMaterials->repurchaseQuantity = $repurchaseQuantity;
                    $rawMaterials->save();
                    
                    //if condition is fulfilled, send an inventory restock request
                    if($newQuantity <= $minimumQuantity)
                    {
                        //check if a pending inventory request of the same raw material already exists
                        $isExist_requests = inventoryRequest::where('rawMaterial','=',$request->input('rawMaterial'))->where('status','=','pending')->count();
                        
                        if($isExist_requests > 0)
                        {
                            return response()->json([
                                'status'=>200,
                                'message'=>'Done!'
                            ]);
                        }
                        else if($isExist_requests == 0)
                        {
                            $requests = new inventoryRequest;
                            $requests->requestNo = rand(1515,9999);
                            $requests->date = NOW();
                            $requests->time = NOW();
                            $requests->status = 'pending';
                            $requests->quantity = $repurchaseQuantity;
                            $requests->inventoryNo = $inventoryNo;
                            $requests->rawMaterial = $request->input('rawMaterial');
                            $requests->factory = $request->input('factory');
                            $requests->save();
                            
                            return response()->json([
                                'status'=>200,
                                'message'=>'Raw Material running out of stock, inventory request Sent!'
                            ]);
                        }
                    }
                    else
                    {
                        return response()->json([
                            'status'=>200,
                            'message'=>'Done!'
                        ]);
                    }
                }
                else
                {
                    return response()->json([
                        'status'=>400,
                        'message'=>'Out of Stock!'
                    ]);
                }
                
            }
            else
            {
                return response()->json([
                    'status'=>400,
                    'message'=>'Quantity cannot be 0!'
                ]);
            }
        }
    }

    public function readUsedRawMaterial($taskNo)
    {
        $used_RM = UsedRawMaterial::join('inventories', 'used_raw_materials.inventory', '=', 'inventories.inventoryNo')
        ->where('used_raw_materials.task','LIKE','%'.$taskNo.'%')->orderBy('used_raw_materials.id', 'DESC')->get([
            'inventories.name AS name',
            'used_raw_materials.quantity AS quantity',
            ]
        );

        if($used_RM)
        {
            return response()->json([
                'usedRM'=>$used_RM
            ]);
        }
    }
}
