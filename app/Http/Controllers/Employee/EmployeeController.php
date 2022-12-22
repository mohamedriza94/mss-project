<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    //CRUD for Supervisor
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required'],
            'departmentNo' => ['required'],
            'name' => ['required'],
            'dob' => ['required'],
            'address' => ['required'],
            'contact' => ['required'],
            'email' => ['required'],
            'photo' => ['required','image'],
            'password' => ['min:6','required'],
            
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
            $employees = new Employee;
            $employees->no = $request->input('no');
            $employees->departmentNo = $request->input('departmentNo');
            $employees->name = $request->input('name');
            $employees->dob = $request->input('dob');
            $employees->address = $request->input('address');
            $employees->contact = $request->input('contact');
            $employees->email = $request->input('email');
            $employees->role = 'supervisor';
            $employees->photo = $request->input('photo');
            $employees->password = Hash::make($request->input('password'));
            $employees->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return response()->json([
            'employees'=>$employees,
        ]);
    }
    
    public function readOne($id)
    {
        $employees = Employee::find($id);
        return response()->json([
            'employees'=>$employees,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'departmentNo' => ['required'],
            'name' => ['required'],
            'dob' => ['required'],
            'address' => ['required'],
            'contact' => ['required'],
            'email' => ['required'],
            
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
            $employees = Employee::find($id);
            $employees->no = $request->input('no');
            $employees->departmentNo = $request->input('departmentNo');
            $employees->name = $request->input('name');
            $employees->dob = $request->input('dob');
            $employees->address = $request->input('address');
            $employees->contact = $request->input('contact');
            $employees->email = $request->input('email');

            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('photos','public'); //get image path
                $employees->photo = '/'.'storage/'.$photoPath;
            }

            $employees->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        $employees = Employee::find($id);
        $employees->delete();
    }

    //create worker account
    public function createWorker(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required'],
            'departmentNo' => ['required'],
            'name' => ['required'],
            'dob' => ['required'],
            'address' => ['required'],
            'contact' => ['required'],
            'email' => ['required'],
            'photo' => ['required','image'],
            'password' => ['min:6','required'],
            
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
            $worker = new Employee;
            $worker->no = $request->input('no');
            $worker->departmentNo = $request->input('departmentNo');
            $worker->name = $request->input('name');
            $worker->dob = $request->input('dob');
            $worker->address = $request->input('address');
            $worker->contact = $request->input('contact');
            $worker->email = $request->input('email');
            $worker->role = 'worker';
            $worker->photo = $request->input('photo');
            $worker->password = Hash::make($request->input('password'));
            $worker->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
