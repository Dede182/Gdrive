<?php

namespace App\Http\Controllers\Api\file;

use App\Models\Gfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use Illuminate\Support\Facades\Auth;

class ApiFileController extends Controller
{
    public function files(){
        $files =Gfile::where('user_id',Auth::user()->id)->first();
        return new FileResource($files);
    }
}
