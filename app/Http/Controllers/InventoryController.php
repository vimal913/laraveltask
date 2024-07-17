<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sold;
use App\Models\Product;

class InventoryController extends Controller
{
    public function index()
    {
        
        return view('sold.index');
    }

    public function create()
    {
        $collection = Product::get();
        return view('sold.create',compact('collection'));
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
            return redirect()->route('soldindex')
            ->with('failure', 'There is no stock !!!');
        }else{
            if($request->stock > $product->stock){
                return redirect()->route('soldindex')
                ->with('failure', 'we have only '.$product->stock.' stock');
            }else{
            $input['name'] = $product->name;
            $input['stock'] =$request->stock;
            $input['price'] =$request->stock * $request->price;
            $input['product_id'] =$request->name;
            Sold::create($input);
    
            $product->stock = $product->stock - $request->stock;
            $product->save();
    
            return redirect()->route('soldindex')
                ->with('success', 'Product sold successfully.');
            }
        }
        
    }
    public function search(Request $request)
    {
        $Product = Sold::all();
      if($request->keyword != ''){
      $Product = Sold::where('name','LIKE','%'.$request->keyword.'%')->get();
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
