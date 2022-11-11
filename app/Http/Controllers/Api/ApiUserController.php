<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function user(){
        $user = User::where('id',Auth::user()->id)->with(['gfile','folders'])->get();
        return $user;
    }
}
