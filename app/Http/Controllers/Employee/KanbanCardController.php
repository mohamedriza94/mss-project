<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KanbanCard;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class KanbanCardController extends Controller
{
    //CRUD Kanban Card
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'cardNo' => ['required'],
            'providedBy' => ['required'],
            'factoryNo' => ['required'],
            'status' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
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
            $kanbanCards = new KanbanCard;
            $kanbanCards->cardNo = $request->input('cardNo');
            $kanbanCards->providedBy = $request->input('providedBy');
            $kanbanCards->factoryNo = $request->input('factoryNo');
            $kanbanCards->status = $request->input('status');
            $kanbanCards->date = $request->input('date');
            $kanbanCards->time = $request->input('time');
            $kanbanCards->title = $request->input('title');
            $kanbanCards->description = $request->input('description');
            $kanbanCards->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read()
    {
        $kanbanCards = KanbanCard::orderBy('id', 'DESC')->get();
        return response()->json([
            'kanbanCards'=>$kanbanCards,
        ]);
    }
    
    public function readOne($id)
    {
        $kanbanCards = KanbanCard::find($id);
        return response()->json([
            'kanbanCards'=>$kanbanCards,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
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
            $kanbanCards = KanbanCard::find($id);
            $kanbanCards->title = $request->input('title');
            $kanbanCards->description = $request->input('description');
            $kanbanCards->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        $kanbanCards = KanBanCard::find($id);
        $kanbanCards->delete();
    }

    //CRUD Task
    public function createTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'taskNo' => ['required'],
            'cardNo' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'status' => ['required'],
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
            $tasks->date = $request->input('date');
            $tasks->time = $request->input('time');
            $tasks->startDate = $request->input('startDate');
            $tasks->endDate = $request->input('endDate');
            $tasks->duration = $request->input('duration');
            $tasks->status = $request->input('status');
            $tasks->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function readOneTask($cardNo)
    {
        $tasks = Task::where('cardNo','=',$cardNo)->get();
        return response()->json([
            'tasks'=>$tasks,
        ]);
    }

    public function updateTask(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'title' => ['required'],
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
            $tasks = Task::find($id);
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
    
    public function delete(Request $request, $id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
    }
}
