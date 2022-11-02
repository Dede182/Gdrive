<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(){

        // $path = "https://www.itsolutionstuff.com/assets/images/logo-it.png";
        // $content = file_get_contents('http://example.com/image.php');
        // file_put_contents('/my/folder/flower.jpg', $content);

        // return response()->download($path);


        $user= User::where('id','=',Auth::user()->id)->with(['folders','gfile'])->get();
        $user = $user[0];
        // return $user;
        return view('dashboard',compact('user'));
    }
}
