<?php

namespace App\Http\Controllers\Api\file;

use App\Models\Gfile;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FileCollection;
use Illuminate\Support\Facades\Storage;

class ApiFileController extends Controller
{
    public function files(){
        $files =Gfile::where('user_id',Auth::user()->id)->get();
        // return $files;
        return $files;
    }
    public function create(Request $request){
        // return $request;
        $fileCollection = [];
        foreach($request->fileName as $key=> $afile){
            Storage::makeDirectory(Auth::user()->name);
            $folderName = Auth::user()->name;
            $Fname = $afile->getClientOriginalName();
            $filepath = $folderName.'/'.$Fname;

            if($request->id){
                $parentFolder = Folder::findOrFail($request->id);
                $afile->storeAs('public/'.$folderName.'/',$Fname);

                $fileCollection[$key] = [
                    'fileName' => $Fname,
                    'user_id' => Auth::user()->id,
                    'filepath' => $filepath,
                    'parentName' => $parentFolder->folderName,
                    'fileSize' => Storage::size('public/'.$filepath),
                    'folder_id' => $request->id,
                ];

            }
            else{
                $afile->storeAs('public/'.$folderName.'/',$Fname);
                $fileCollection[$key] = [
                    'fileName' => $Fname,
                    'filepath' => $filepath,
                    'fileSize' => Storage::size('public/'.$filepath),

                    'user_id' => Auth::user()->id,
                ];

            }



        }
        $response = Gfile::insert($fileCollection);
        // return $fileCollection;
        return response()->json([
            'message' => 'success',
            'createdFiles' => $fileCollection,
            'status' => true,
        ]);
    }
}
