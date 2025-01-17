<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        return response()->json(Product::all());
    }

    public function show($id){
        return response()->json(Product::find($id));
    }

    public function store(Request $request){
        $item = new Product();
        $item->type_id = $request->type_id;
        $item->date = $request->date;
                
        $item->save();
    }

    public function update(Request $request, $id){
        $item = Product::find($id);
        $item->type_id = $request->type_id;
        $item->date = $request->date;

        $item->save();
    }

    public function destroy($id){
        Product::find($id)->delete();
    }

    public function productUserdata(){
        $user = Auth::user();
        $product = DB::table('products as p')
        ->join('baskets as b', 'p.item_id', 'b.item_id')
        ->where ('user_id','=',$user)
        ->get();
        return $product;
    }
    

    public function costproductUserdata(){
        $user = Auth::user();
        $product = DB::table('products as p')
        ->join('product_types as pr', 'p.type_id', 'pr.type_id')
        ->where ('user_id','=',$user)
        ->get();
        return $product;
    }
    
}
