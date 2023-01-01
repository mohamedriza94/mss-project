<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    //CRUD for Worker
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','unique:employees'],
            'workshop' => ['required'],
            'name' => ['required'],
            'dob' => ['required'],
            'address' => ['required'],
            'contact' => ['required','unique:employees'],
            'email' => ['required','unique:employees'],
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
            $employees->departmentNo = $request->input('workshop');
            $employees->name = $request->input('name');
            $employees->dob = $request->input('dob');
            $employees->address = $request->input('address');
            $employees->contact = $request->input('contact');
            $employees->email = $request->input('email');
            $employees->role = 'worker';

            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('staff','public'); //get image path
                $employees->photo = '/'.'storage/'.$photoPath;
            }

            $employees->password = Hash::make($request->input('password'));
            $employees->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read($limit)
    {
        //exploding a string to get factory number from the supervisor
        $explode_string  = auth()->guard('employee')->user()->departmentNo;
        $split_explode_string = explode(" ", $explode_string);
        $factoryNo = $split_explode_string[1]; //get 1st position of array
        $departmentNo = $split_explode_string[0]; //get 1st position of array

        $employees = Employee::where('departmentNo','LIKE','%'.$departmentNo.'%')->where('role','=','worker')->orderBy('id', 'DESC')->limit(4)->offSet($limit)->get();
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
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            'workshop' => ['required'],
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
            $employees = Employee::find($request->input('id'));
            $employees->departmentNo = $request->input('workshop');
            $employees->name = $request->input('name');
            $employees->dob = $request->input('dob');
            $employees->address = $request->input('address');
            $employees->contact = $request->input('contact');
            $employees->email = $request->input('email');

            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('staff','public'); //get image path
                $employees->photo = '/'.'storage/'.$photoPath;
            }

            If(request('password')!="")
            {
                $employees->password = Hash::make($request->input('password'));
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

    public function readRelation($departmentNo)
    {
        $departments = Department::where('no','=',$departmentNo)->get();
        return response()->json([
            'departments'=>$departments,
        ]);
    }
   
}
