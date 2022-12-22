<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rawMaterial;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RawMaterialController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required'],
            'inventoryNo' => ['required'],
            
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
            $rawMaterials = new rawMaterial;
            $rawMaterials->no = $request->input('no');
            $rawMaterials->inventoryNo = $request->input('inventoryNo');
            $rawMaterials->status = 'NA';
            $rawMaterials->quantity = '0';
            $rawMaterials->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function inventoryRequest()
    {
        $rawMaterials_Checking = rawMaterial::where('checkingStatus','=','unchecked')->orderBy('id', 'DESC')->first(); 

        $inventoryNo = $rawMaterials_Checking['inventoryNo'];
        $quantity = $rawMaterials_Checking['quantity'];

        if($quantity < 300)
        {
            $requests = new Request;
            $requests->no = rand(1515,9999);
            $requests->date = NOW();
            $requests->time = NOW();
            $requests->status = 'pending';
            $requests->inventoryNo = $inventoryNo;
            $requests->save();
        }
    }
}
