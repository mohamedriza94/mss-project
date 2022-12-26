<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class InventoryController extends Controller
{
    //CRUD Kanban Card
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'inventoryNo' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'quantity' => ['required'],
            
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
            $inventories = new Inventory;
            $inventories->inventoryNo = $request->input('inventoryNo');
            $inventories->name = $request->input('name');
            $inventories->price = $request->input('price');
            $inventories->status = 'NA';
            $inventories->quantity = $request->input('quantity');
            $inventories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read()
    {
        $inventories = Inventory::orderBy('id', 'DESC')->get();
        return response()->json([
            'inventories'=>$inventories,
        ]);
    }
    
    public function readOne($id)
    {
        $inventories = Inventory::find($id);
        return response()->json([
            'inventories'=>$inventories,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'name' => ['required'],
            'price' => ['required'],
            
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
            $inventories = Inventory::find($id);
            $inventories->name = $request->input('name');
            $inventories->price = $request->input('price');
            $inventories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete(Request $request, $id)
    {
        $inventories = Inventory::find($id);
        $inventories->delete();
    }

    public function addNewStock(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'quantity' => ['required'],
            
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
            $inventories = Inventory::find($id);
            $inventories->status = 'available';
            $inventories->quantity = $request->input('quantity');
            $inventories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
