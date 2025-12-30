<?php
 namespace App\Http\Controllers;
 use App\Models\Category;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;

 class CategoryController extends Controller{

    public function index(){
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'categories' => $categories,
        ]);
    }
    public function store (Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'status' => 'success',
            'category' => $category,
        ]);
    }
 }