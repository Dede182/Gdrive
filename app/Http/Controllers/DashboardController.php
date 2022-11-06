<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Folder;
use App\Models\Gfile;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\MbCalculate;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(){
        $folders = Folder::where('user_id','=',Auth::user()->id)
        ->latest('id')
        ->limit(8)
        ->get();

        $files = Gfile::where('user_id','=',Auth::user()->id)
        ->latest('id')
        ->get();


        // return $value;
        return view('dashboard',compact(['folders','files']));
    }


    public  function sidebar(){
        $user= User::where('id','=',Auth::user()->id)->with('gfile')->first();
        $allfiles = $user->gfile;
        $fileSizes =[];
        foreach($allfiles as $key=>$file){
            $size = Storage::size('public/'.$file->filePath);
            $fileSizes[$key] = $size;
        }
        $total =  array_sum($fileSizes) ;
        $value = MbCalculate::bytesToHuman($total ) ;
        // return View::share('value',$value);
        return view('layouts.sidebar','value');
    }
}
