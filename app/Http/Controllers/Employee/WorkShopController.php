<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Slot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class WorkShopController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required'],
            'departmentNo' => ['required'],
            'status' => ['required'],
            
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
            $workshops = new Workshop;
            $workshops->no = $request->input('no');
            $workshops->departmentNo = $request->input('departmentNo');
            $workshops->status = $request->input('status');
            $workshops->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read()
    {
        $workshops = Workshop::orderBy('id', 'DESC')->get();
        return response()->json([
            'workshops'=>$workshops,
        ]);
    }
    
    public function readOne($id)
    {
        $workshops = Workshop::find($id);
        return response()->json([
            'workshops'=>$workshops,
        ]);
    }
    
    public function delete(Request $request, $id)
    {
        $workshops = Workshop::find($id);
        $workshops->delete();
    }
    
    public function addSlot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'slotNo' => ['required'],
            'workshopNo' => ['required'],
            
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
            $slots = new Slot;
            $slots->slotNo = $request->input('slotNo');
            $slots->workshopNo = $request->input('workshopNo');
            $slots->status = 'available';
            $slots->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function deleteSlot(Request $request, $id)
    {
        $slots = Slot::find($id);
        $slots->delete();
    }
}
