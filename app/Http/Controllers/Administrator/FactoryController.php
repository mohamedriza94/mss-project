<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class FactoryController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','string','max:10','unique:factories'],
            'name' => ['required','string','max:50'],
            'contact' => ['required','numeric','digits_between:9,10','unique:factories'],
            'address' => ['required'],
            
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
            $factories = new Factory;
            $factories->no = $request->input('no');
            $factories->name = $request->input('name');
            $factories->contact = $request->input('contact');
            $factories->address = $request->input('address');
            $factories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read($limit)
    {
        $factories = Factory::orderBy('id', 'DESC')->limit(5)->offSet($limit)->get();
        return response()->json([
            'factories'=>$factories,
        ]);
    }
    
    public function readOne($id)
    {
        $factories = Factory::find($id);
        return response()->json([
            'factories'=>$factories,
        ]);
    }
    
    public function readRelation($id)
    {
        $factories = Factory::where('id','=',$id)->orWhere('no','=',$id)->get();
        return response()->json([
            'factories'=>$factories,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            'name' => ['required','string','max:50'],
            'contact' => ['required','numeric','digits_between:9,10'],
            'address' => ['required'],
            
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
            $factories = Factory::find($request->input('id'));
            $factories->name = $request->input('name');
            $factories->contact = $request->input('contact');
            $factories->address = $request->input('address');
            $factories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        $factories = Factory::find($id);
        $factories->delete();
    }
}
