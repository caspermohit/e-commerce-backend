<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ProductController extends Controller{
    public function index(){
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
    }
    public function store (Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json([
            'status' => 'success',
            'product' => $product,
        ]);
    }
}