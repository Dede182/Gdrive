<?php

namespace App\Http\Controllers;

use App\Models\Gfile;
use App\Models\Folder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGfileRequest;
use App\Http\Requests\UpdateGfileRequest;

class GfileController extends Controller
{
    public function store(StoreGfileRequest $request)
    {
        $fileCollection = [];
        foreach($request->fileName as $key=> $afile){
            Storage::makeDirectory(Auth::user()->name);
            $folderName = Auth::user()->name;
            $Fname = $afile->getClientOriginalName();
            $filepath = $folderName.'/'.$Fname;

                $fileCollection[$key] = [
                    'fileName' => $Fname,
                    'filepath' => $filepath,
                    'user_id' => Auth::user()->id,
                ];

                $afile->storeAs('public/'.$folderName.'/',$Fname);

        }
        Gfile::insert($fileCollection);
        // return $fileCollection;
        return redirect()->back()->with('status', 'files are uploaded');
    }


    public function download(){
        return "hi";
    }

    public function destroy(Request $request)
    {


    }

    public function bulkDelete(Request $request){
        // return $request;
            if(isset($request['files'])){
            $checks = $request["files"];
            $ids = [];
            $files = [];
            foreach($checks as $key=> $check){
                $ids[$key] = (int)$check;
            }
            foreach($ids as $key=>$id){
                $files[$key] = Gfile::findOrFail($id);
            }

            foreach($files as $file){
                Storage::delete('public/'.Auth::user()->name.'/'.$file->fileName);
            }
            // return "storage deleted";
            Gfile::destroy($ids);
        }

        if(isset($request['folders'])){
            $checks = $request["folders"];
            $ids = [];
            $folders = [];
            foreach($checks as $key=> $check){
                $ids[$key] = (int)$check;
            }
            foreach($ids as $key=>$id){
                $folders[$key] = Folder::findOrFail($id);
            }
                foreach($folders as $folder){
                    Storage::deleteDirectory('public/'.Auth::user()->name.'/'.$folder->folderName);
                }
                Folder::destroy($ids);
        }


        return redirect()->route('dashboard')->with('status','files are deleted');
    }
    // bulk copy
    public function bulkCopy(Request $request){
        if(isset($request['files'])){
            return 'files';
        }

        // folder copy
        if(isset($request['folders'])){
            $checks = $request["folders"];
            $ids = [];
            $folders = [];
            foreach($checks as $key=> $check){
                $ids[$key] = (int)$check;
            }
            foreach($ids as $key=>$id){
                $folders[$key] = Folder::findOrFail($id);
            }
            foreach($folders as $dc){
                $newfolder = $dc->replicate();
                $newfolder->folderName = $dc->folderName."_copy".Str::random(6);
                $newfolder->created_at = Carbon::now();
                Storage::makeDirectory('public/'.Auth::user()->name.'/'.$newfolder->folderName);
                $newfolder->save();


                $newfiles = $dc->files;
                $newfilesId = [];

                foreach($newfiles as $key => $newfile){
                    $newfilesId[$key] = $newfile->replicate();
                    $newfilesId[$key]->folder_id = $newfolder->id;
                    $newfilesId[$key]->filePath = Auth::user()->name.'/'.$newfolder->folderName.'/'.$newfilesId[$key]->fileName;
                    $fromCopy = 'public/'.Auth::user()->name.'/'.$dc->folderName.'/'.$newfile->fileName;
                    $toCopy ='public/'.Auth::user()->name.'/'.$newfolder->folderName .'/'.$newfile->fileName;
                    Storage::copy($fromCopy,$toCopy);
                    $newfilesId[$key]->save();
                    // return $newfilesId[$key];
                }
            }




            return redirect()->route('dashboard')->with('status','files are duplicated');
        }
    }
}
