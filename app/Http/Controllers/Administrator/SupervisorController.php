<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class SupervisorController extends Controller
{
    //CRUD for Supervisor
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','unique:employees'],
            'department' => ['required'],
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
            $employees->departmentNo = $request->input('department');
            $employees->name = $request->input('name');
            $employees->dob = $request->input('dob');
            $employees->address = $request->input('address');
            $employees->contact = $request->input('contact');
            $employees->email = $request->input('email');
            $employees->role = 'supervisor';

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
        $employees = Employee::where('role','=','supervisor')->orderBy('id', 'DESC')->limit(4)->offSet($limit)->get();
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
            'department' => ['required'],
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
            $employees->departmentNo = $request->input('department');
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
}
