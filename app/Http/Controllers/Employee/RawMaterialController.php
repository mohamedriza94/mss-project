<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rawMaterial;
use App\Models\Inventory;
use App\Models\Request as inventoryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RawMaterialController extends Controller
{
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','unique:raw_materials'],
            'inventoryNo' => ['required'],
            'quantity' => ['required'],
            'minimumQuantity' => ['required'],
            'repurchaseQuantity' => ['required'],
            
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
            $rawMaterials->quantity = $request->input('quantity');
            $rawMaterials->repurchaseQuantity = $request->input('repurchaseQuantity');
            $rawMaterials->checkingStatus = '-';
            $rawMaterials->minimumQuantity = $request->input('minimumQuantity');
            
            //exploding a string to get factory number from the supervisor
            $factory_string  = auth()->guard('employee')->user()->departmentNo;
            $split_factory_string = explode(" ", $factory_string);
            $factoryNo = $split_factory_string[1]; //get 1st position of array
            
            $rawMaterials->factory = $factoryNo;
            
            if($request->input('quantity') > 0)
            {
                $rawMaterials->status = 'available';
            }
            else 
            {
                $rawMaterials->status = 'NA';
            }
            
            $rawMaterials->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function read($limit)
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        
        $rawMaterials = rawMaterial::join('inventories', 'raw_materials.inventoryNo', '=', 'inventories.inventoryNo')
        ->where('raw_materials.factory','LIKE','%'.$factoryNo.'%')->orderBy('raw_materials.id', 'DESC')->limit(5)->offSet($limit)->get([
            'raw_materials.status AS status',
            'raw_materials.no AS no',
            'raw_materials.id AS id',
            'raw_materials.quantity AS quantity',
            'inventories.name AS name',
            ]
        );
        
        return response()->json([
            'rawMaterials'=>$rawMaterials,
        ]);
    }
    
    public function readInventoryRequest($inventoryNo, $limit_arrow)
    {
        $inventoryRequests = inventoryRequest::where('inventoryNo','=',$inventoryNo)->orderBy('id', 'DESC')->limit(5)->offSet($limit_arrow)->get();
        return response()->json([
            'inventoryRequests'=>$inventoryRequests,
        ]);
    }
    
    public function readOne($inventoryNo)
    {
        $rawMaterials = rawMaterial::join('inventories', 'raw_materials.inventoryNo', '=', 'inventories.inventoryNo')
        ->where('raw_materials.no','=',$inventoryNo)
        ->first([
            'raw_materials.no AS no',
            'raw_materials.inventoryNo AS inventoryNo',
            'raw_materials.quantity AS quantity',
            'raw_materials.minimumQuantity AS minimumQuantity',
            'raw_materials.repurchaseQuantity AS repurchaseQuantity',
            'inventories.name AS name',
            'raw_materials.id AS id',
            ]
        );
        return response()->json([
            'rawMaterials'=>$rawMaterials,
        ]);
        
    }
    
    public function readWarehouseInventory()
    {
        //exploding a string to get factory number from the supervisor
        $factory_string  = auth()->guard('employee')->user()->departmentNo;
        $split_factory_string = explode(" ", $factory_string);
        $factoryNo = $split_factory_string[1]; //get 1st position of array
        
        //return all rows form inventories table where raw materials belonging to factory number does not exist in 
        //raw material table already
        $inventories = DB::table('inventories')
        ->whereNotExists(function ($query) use ($factoryNo) {
            $query->select(DB::raw(1))
            ->from('raw_materials')
            ->whereRaw('raw_materials.inventoryNo = inventories.inventoryNo')
            ->where('raw_materials.factory', $factoryNo);
        })->orderBy('id','DESC')
        ->get(['inventories.inventoryNo AS no','inventories.name AS name',]);
        
        return response()->json([
            'inventories'=>$inventories,
        ]);
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'id' => ['required'],
            'minimumQuantity' => ['required'],
            'repurchaseQuantity' => ['required'],
            
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
            $rawMaterials = rawMaterial::find($request->input('id'));
            $rawMaterials->minimumQuantity = $request->input('minimumQuantity');
            $rawMaterials->repurchaseQuantity = $request->input('repurchaseQuantity');
            $rawMaterials->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function delete($no)
    {
        $rawMaterials = rawMaterial::where('no','=',$no);
        $rawMaterials->delete();
        
        $inventoryRequests = inventoryRequest::where('inventoryNo','=',$no);
        $inventoryRequests->delete();
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
            $rawMaterials = rawMaterial::find($request->input('id'));
            
            $quantity = $rawMaterials['quantity'];
            
            $quantity = $quantity + 1;
            
            $rawMaterials->status = 'available';
            $rawMaterials->quantity = $quantity;
            $rawMaterials->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    // public function inventoryRequest()
    // {
        //     $rawMaterials_Checking = rawMaterial::where('checkingStatus','=','unchecked')->orderBy('id', 'DESC')->first(); 
        
        //     $inventoryNo = $rawMaterials_Checking['inventoryNo'];
        //     $quantity = $rawMaterials_Checking['quantity'];
        
        //     if($quantity < 300)
        //     {
            //         $requests = new Request;
            //         $requests->no = rand(1515,9999);
            //         $requests->date = NOW();
            //         $requests->time = NOW();
            //         $requests->status = 'pending';
            //         $requests->inventoryNo = $inventoryNo;
            //         $requests->save();
            //     }
            // }
        }
