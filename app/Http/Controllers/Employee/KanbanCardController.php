<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KanBanCard;
use App\Models\Task;
use App\Models\rawMaterial;
use App\Models\Slot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
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
                $isExistTasks = Task::where('factory','=',$factoryNo)->first();
                
                if($isExistTasks)
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
                            'message'=>'Not enough Data to Auto Schedule!',
                            'status'=>400
                        ]);
                    }
                }
                else
                {
                    return response()->json([
                        'message'=>'Not enough Data to Auto Schedule!',
                        'status'=>400
                    ]);
                }
                
            }
            else
            {
                return response()->json([
                    'message'=>'Raw Materials Not Sufficient',
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
}
