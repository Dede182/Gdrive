<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Folder;
use App\Models\Gfile;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        // return $user;
        return view('dashboard',compact(['folders','files']));
    }

}
