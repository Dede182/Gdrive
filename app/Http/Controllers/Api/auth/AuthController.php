<?php

namespace App\Http\Controllers\Api\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => "required|min:3",
            'email'=> "required|email|unique:users",
            'password' => "required|min:6|confirmed"
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        if($request->hasFile('userPhoto')){
            $fileName = uniqid().'_userPhoto.'.$request->file('userPhoto')->extension();
             Storage::makeDirectory('public/'.$request->name);
             $request->file('userPhoto')->storeAs('public/'.$request->name.'/',$fileName);
            $user->userPhoto = $fileName;
        }
        $user->save();
        if(Auth::attempt($request->only(['email','password']))){
            $tokens = Auth::user()->createToken('phone')->plainTextToken;
            return response()->json(['message' => "Register successful",'token'=>$tokens,'success' =>true],200);
        }


       }
       public function login(Request $request){
        $request->validate([
            'email'=> "required|email",
            'password' => "required|min:6"
        ]);

        if(Auth::attempt($request->only(['email','password']))){
            $tokens = Auth::user()->createToken('tk')->plainTextToken;
            return response()->json([
                'message'=> 'login successful',
                'token' => $tokens,
                'auth' => Auth::user(),
                'success' => true
            ]);
        }
        return response()->json(['message' => "user not found",'success' => false],403);
       }

       public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout successfully']);
       }

       public function logoutAll(){
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'all Tokens are removed']);
       }

}
