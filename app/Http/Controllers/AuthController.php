<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller{
    public function register (Request $request){
      $NewUser =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|integer',
        ]);
        $user = User::create([
            'name' => $NewUser['name'],
            'email' => $NewUser['email'],
            'password' => bcrypt($NewUser['password']),
            'role' => $NewUser['0'],
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'token' => $token,
        ]);
       
}
    public function login (Request $request){
       $LoginUser =  $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
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