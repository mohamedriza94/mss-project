<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('warehouse.dashboard.home');
    }

    public function inventory(Request $request)
    {
        return view('warehouse.dashboard.inventory');
    }

    //CRUD Kanban Card
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'inventoryNo' => ['required'],
            'name' => ['required'],
            'price' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            
        ]); //validate all the data
        
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        else
        {
            $inventories = new Inventory;
            $inventories->inventoryNo = $request->input('inventoryNo');
            $inventories->name = $request->input('name');
            $inventories->price = $request->input('price');

            if($request->input('quantity')>0)
            {
                $inventories->status = 'available';
            }
            else
            {
                $inventories->status = 'NA';
            }
            
            $inventories->availableQuantity = $request->input('quantity');
            $inventories->save();
            
            return redirect()->back()->with('message', 'SUCCESS!');
        }
    }

    public function read($limit)
    {
        $inventories = Inventory::orderBy('id', 'DESC')->limit(5)->offSet($limit)->get();
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
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            'name' => ['required'],
            'price' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            
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
            $inventories = Inventory::find($request->input('id'));
            $inventories->name = $request->input('name');
            $inventories->price = $request->input('price');
            $inventories->availableQuantity = $request->input('quantity');
            
            if($request->input('quantity')>0)
            {
                $inventories->status = 'available';
            }
            else
            {
                $inventories->status = 'NA';
            }

            $inventories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete($id)
    {
        $inventories = Inventory::find($id);
        $inventories->delete();
    }

    public function addQuantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            
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
            $inventories = Inventory::find($request->input('id'));
            
            $quantity = $inventories['availableQuantity'];

            $newQuantity = $quantity + 1;

            $inventories->status = 'available';
            $inventories->availableQuantity = $newQuantity;
            $inventories->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
