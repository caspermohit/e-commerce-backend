<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller{
    public function register (Request $request){
       $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        $user= User::create(
            [
                'name' =>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)

            ]
            );
            $token= $user->createToken('app_token')->plainTextToken;
            return response()->json(['message'=>'User registered successfully','token'=>$token,'user'=> $user],201);



       
}
    public function login (Request $request){
       $LoginUser =  $request->validate([
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:8',
        ]);
        $user = User::where('email', $LoginUser['email'])->first();
        if ($user && Hash::check($LoginUser['password'], $user->password)) {
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'token' => $token,
            ]);
        }
        return response()->json([
            'status' => 'failed',
        ]);
    } 
}