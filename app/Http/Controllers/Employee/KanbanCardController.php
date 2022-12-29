<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KanBanCard;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
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
            $tasks = new Task;
            $tasks->taskNo = $request->input('taskNo');
            $tasks->cardNo = $request->input('cardNo');
            $tasks->name = $request->input('name');
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
}
