<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\rawMaterial;
use App\Models\Request as InventoryRequest;
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
            
            'inventoryNo' => ['required','unique:inventories'],
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
    
    public function readInventoryRequest($limit)
    {
        $requests = InventoryRequest::join('inventories', 'requests.inventoryNo', '=', 'inventories.inventoryNo')
        ->orderBy('requests.id', 'DESC')->limit(5)->offSet($limit)->get([
            'requests.requestNo AS no',
            'inventories.name AS name',
            'requests.date AS date',
            'requests.status AS status',
            'requests.quantity AS quantity',
            'requests.rawMaterial AS rawMaterial',
            ]
        );
        return response()->json([
            'requests'=>$requests,
        ]);
    }
    
    public function fillRequest(Request $request)
    {
        //get inventory number
        $rawMaterials = rawMaterial::where('no','=',$request->input('rawMaterial'))->first();
        $inventoryNo = $rawMaterials['inventoryNo'];
        
        //get requested quantity
        $inventoryRequests = InventoryRequest::where('rawMaterial','=',$request->input('rawMaterial'))->first();
        $requestedQuantity = $inventoryRequests['quantity'];
        
        //get available quantity
        $inventories = Inventory::where('inventoryNo','=',$inventoryNo)->first();
        $availableQuantity = $inventories['availableQuantity'];
        
        if($availableQuantity >= $requestedQuantity)
        {
            //update request status as completed
            $inventoryRequests->status = 'completed';
            $inventoryRequests->save();

            //update raw material quantity============================
            //calculate percentage of available quantity and round up
            $currentRawMaterialQuantity = $rawMaterials['quantity'];
            $newQuantity = $currentRawMaterialQuantity + $requestedQuantity;

            $rmMinimumQuantity = $rawMaterials['minimumQuantity'];
            $rmRepurchaseQuantity = $rawMaterials['repurchaseQuantity'];
            
            $totalQuantity = $rmMinimumQuantity + $rmRepurchaseQuantity;
            $availablePercentage = $newQuantity / $totalQuantity * 100;
            $availablePercentage = round($availablePercentage);

            $rawMaterials->availablePercentage = $availablePercentage;
            $rawMaterials->quantity = $newQuantity;
            $rawMaterials->save();

            //update inventory quantity
            $newInventoryQuantity = $availableQuantity - $requestedQuantity;
            if($newInventoryQuantity > 0)
            {
                $inventories->status = 'available';
                $inventories->availableQuantity = $newInventoryQuantity;
                $inventories->save();
            }
            else
            {
                $inventories->status = 'NA';
                $inventories->availableQuantity = $newInventoryQuantity;
                $inventories->save();
            }

            return response()->json([
                'status'=>200
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
                'message'=>'Insufficient Stock Available'
            ]);
        }
    }
}
