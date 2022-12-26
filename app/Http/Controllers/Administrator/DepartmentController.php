<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class DepartmentController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','unique:departments'],
            'factoryNo' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'contact' => ['required'],
            
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
            $departments = new Department;
            $departments->no = $request->input('no');
            $departments->factoryNo = $request->input('factoryNo');
            $departments->name = $request->input('name');
            $departments->location = $request->input('address');
            $departments->contact = $request->input('contact');
            $departments->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read($limit)
    {
        $departments = Department::orderBy('id', 'DESC')->limit(5)->offSet($limit)->get();
        return response()->json([
            'departments'=>$departments,
        ]);
    }
    
    public function readOne($id)
    {
        $departments = Department::find($id);
        return response()->json([
            'departments'=>$departments,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'contact' => ['required'],
            
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
            $departments = Department::find($request->input('id'));
            $departments->name = $request->input('name');
            $departments->location = $request->input('address');
            $departments->contact = $request->input('contact');
            $departments->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        $departments = Department::find($id);
        $departments->delete();
    }
}
