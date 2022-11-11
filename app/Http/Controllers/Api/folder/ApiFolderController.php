<?php

namespace App\Http\Controllers\api\folder;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiFolderController extends Controller
{
    public function folders(){
        $folders =Folder::where('user_id',Auth::user()->id)->get();
        // return $files;
        return $folders;
    }
    public function create(Request $request){
           // return $request;
           $folder = new Folder();
           $folder->folderName = $request->folderName;
           $folder->user_id = Auth::user()->id;
           $folder->save();
           return response()->json([
            'message' => "success",
            'created Folder' => $folder,
            'status'  => true,
           ]);
    }

    public function show(Folder $folder)
    {
        return response()->json([
            'message' => 'success',
            'folder' => $folder,
            'status' => true,
        ]);
    }
}
