<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Department;
use App\Models\Slot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class WorkShopController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','unique:workshops'],
            'name' => ['required'],
            'status' => ['required'],
            'slot' => ['required'],
            
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
            //explode supervisor department number column and get department number of supervisor
            $department_string  = auth()->guard('employee')->user()->departmentNo;
            $split_department_string = explode(" ", $department_string);
            $departmentNo = $split_department_string[0]; //get 0th position of array
            
            $workshops = new Workshop;
            $workshops->no = $request->input('no');
            $workshops->departmentNo = $departmentNo;
            $workshops->name = $request->input('name');
            $workshops->status = $request->input('status');
            $workshops->save();
            
            //repeat until loop to save number of work slots
            $thresholdSlotCount = $request->input('slot');

            if($thresholdSlotCount != 0)
            {
                $slotCount = 1;

                do {
                    
                    $slots = new Slot;
                    $slots->slotNo = rand(1000,9999);
                    $slots->workshopNo = $request->input('no');
                    $slots->status = 'available';
                    $slots->save();
                    
                    $slotCount++;
                    
                } while ($slotCount <= $thresholdSlotCount);
            }
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
            'slot' => ['required'],
            
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
            
            $workshops = Workshop::find($request->input('id'));
            $workshops->name = $request->input('name');
            $workshops->status = $request->input('status');
            $workshops->save();
            
            //repeat until loop to save number of work slots
            $thresholdSlotCount = $request->input('slot');

            if($thresholdSlotCount != 0)
            {
                $slotCount = 1;

                do {
                    
                    $slots = new Slot;
                    $slots->slotNo = rand(1000,9999);
                    $slots->workshopNo = $request->input('no');
                    $slots->status = 'available';
                    $slots->save();
                    
                    $slotCount++;
                    
                } while ($slotCount <= $thresholdSlotCount);
            }
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read($limit)
    {
        //explode supervisor department number column and get department number of supervisor
        $department_string  = auth()->guard('employee')->user()->departmentNo;
        $split_department_string = explode(" ", $department_string);
        $departmentNo = $split_department_string[0]; //get 0th position of array

        $workshops = Workshop::where('departmentNo','=',$departmentNo)->orderBy('id', 'DESC')->limit(5)->offSet($limit)->get();
        return response()->json([
            'workshops'=>$workshops,
        ]);
    }
    
    public function readToSelect()
    {
        $workshops = Workshop::orderBy('id', 'DESC')->get();
        return response()->json([
            'workshops'=>$workshops,
        ]);
    }
    
    public function readSlot($workshopNo, $limit_arrow)
    {
        $slots = Slot::where('workshopNo','=',$workshopNo)->orderBy('id', 'DESC')->limit(5)->offSet($limit_arrow)->get();
        return response()->json([
            'slots'=>$slots,
        ]);
    }
    
    public function readOne($workshopNo)
    {
        $workshops = Workshop::where('no','=',$workshopNo)->first();
        $slots = Slot::where('workshopNo','=',$workshopNo)->count();
        return response()->json([
            'workshops'=>$workshops,
            'slots'=>$slots,
        ]);
    }
    
    public function delete($no)
    {
        $workshops = Workshop::where('no','=',$no);
        $workshops->delete();
        
        $slots = Slot::where('workshopNo','=',$no);
        $slots->delete();
    }
    
    public function deleteSlot($id)
    {
        $slots = Slot::find($id);
        $slots->delete();
    }
    
    public function updateStatus($id, $status)
    {
        $workshops = Workshop::find($id);
        $workshops->status = $status;
        $workshops->update();
    }
}
