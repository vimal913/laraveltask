<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;

class purchaseController extends Controller
{
    public function index()
    {
        
        return view('purchase.index');
    }

    public function create()
    {
        $collection = Product::get();
        return view('purchase.create',compact('collection'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
        ]);
        $product = Product::where('id',$request->name)->first();
        if($product->stock === 0){
            return redirect()->route('purchaseindex')
            ->with('failure', 'There is no stock !!!');
        }else{
                $input['name'] = $product->name;
            $input['stock'] =$request->stock;
            $input['price'] =$request->stock * $request->price;
            $input['product_id'] =$request->name;
            Purchase::create($input);
    
            $product->stock = $product->stock + $request->stock;
            $product->save();
    
            return redirect()->route('purchaseindex')
                ->with('success', 'Product purchase successfully.');
        }
        
    }
    public function search(Request $request)
    {
        $Product = Purchase::all();
      if($request->keyword != ''){
      $Product = Purchase::where('name','LIKE','%'.$request->keyword.'%')->get();
      }
      return response()->json([
         'product' => $Product
      ]);
    }
    public function searchstock(Request $request)
    {
      if($request->keyword != ''){
      $Product = Product::where('id',$request->keyword)->first();
      }
      return response()->json([
         'product' => $Product
      ]);
    }
}
