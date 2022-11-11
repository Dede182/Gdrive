<?php

namespace App\Http\Controllers\api;

use App\Models\Gfile;
use App\Models\Folder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BulkActionController extends Controller
{
    public function bulkCopy(Request $request){
        // return $request;-
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
            $copyFiles = [];
            foreach($files as $key=>$file){
                $copyFiles[$key] = $file->replicate();
                $copyFiles[$key]->fileName =    Str::random(3)."_copy_". $file->fileName ;
                $copyFiles[$key]->filePath = Auth::user()->name.'/'.$file->ParentName.'/'.$copyFiles[$key]->fileName;
                $fromCopy = 'public/'.Auth::user()->name.'/'.$file->ParentName.'/'.$file->fileName;
                $toCopy ='public/'.Auth::user()->name.'/'.$copyFiles[$key]->ParentName.'/'. $copyFiles[$key]->fileName;
                Storage::copy($fromCopy,$toCopy);
                $copyFiles[$key]->save();
                // return $copyFiles[$key];
            }
        }
        // return $copyFiles;
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
                $newfolder->folderName = $dc->folderName."_copy_`".Str::random(6);
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
                return response()->json([
                    'message' => "success",
                    "response" => 'process is success',
                    'status' => true,
                ]);

               }

              }

    // bulk delete
    public function bulkDelete(Request $request){
        if(isset($request['files'])){
            $checks = $request["files"];
            // return $checks;
            $ids = [];
            $files = [];
            foreach($checks as $key=> $check){
                $ids[$key] = (int)$check;
            }
            // return Gfile::findOrFail(1);
            foreach($ids as $key=>$id){
                $files[$key] = Gfile::withTrashed()->findOrFail($id);
            }
            // return $files;
            // method filter
            if(request('delete')==="soft"):
                Gfile::withTrashed()->whereIn('id',$ids)->delete();
                $message ="files are moved to trash";

            elseif(request('delete')==="restore"):

                Gfile::withTrashed()->whereIn('id',$ids)->restore();
            $message ="files are restored";

            else:
            foreach($files as $file){
                Storage::delete('public/'.Auth::user()->name.'/'.$file->fileName);
            }
            // return "storage deleted";
            Gfile::withTrashed()->whereIn('id',$ids)->forceDelete();
            $message ="files are deleted permantely!";
            endif;
            // return redirect()->back()->with('status',$message);
        }

        if(isset($request['folders'])){
            $checks = $request["folders"];
            $ids = [];
            $folders = [];
            $fileIds = [];
            $files = [];
            foreach($checks as $key=> $check){
                $ids[$key] = (int)$check;
            }
            foreach($ids as $key=>$id){
                $folders[$key] = Folder::withTrashed()->findOrFail($id);
            }
            // return $folders;

           foreach($folders as $folder){
                // foreach($folder->files as $key=>$file)
                // {
                //     $fileIds[$key] = $file->id;
                // }
                for($i=0;$i<count($folder->files);$i++){
                    $fileIds[$i] = $folder->files[$i]->id;
                }
           }


            // return $fileIds;


            foreach($fileIds as $key=>$id){
                $files[$key] = Gfile::withTrashed()->findOrFail($id);
            }
            // return $files;
            if(request('delete')==="soft"):
                GFile::withTrashed()->whereIn('id',$fileIds)->delete();
                Folder::withTrashed()->whereIn('id',$ids)->delete();
            $message ="folders are moved to trash";

            elseif(request('delete')==="restore"):
                GFile::withTrashed()->whereIn('id',$fileIds)->restore();
                $restoreFiles = [];
                foreach($ids as $key=>$id){
                    $files = Gfile::withTrashed()->where('folder_id','=',"$id")->get();
                    foreach($files as $key=>$file){
                        $restoreFiles[$key] = $file->id;
                    }
                }
                GFile::withTrashed()->whereIn('id',$restoreFiles)->restore();
                Folder::withTrashed()->whereIn('id',$ids)->restore();
            $message ="folders are restored";

            else:
            foreach($folders as $folder){
                Storage::delete('public/'.Auth::user()->name.'/'.$folder->folderName);
            }
            // return "storage deleted";
            GFile::withTrashed()->whereIn('id',$fileIds)->forceDelete();

            Folder::withTrashed()->whereIn('id',$ids)->forceDelete();
            $message ="folders are deleted permanently!";
            endif;
            // return redirect()->back()->with('status',$message);
        }


        return response()->json([
            'message' => 'success',
            'status' => $message,
        ]);
    }

    public function download(Gfile $file){
        return   response()->download(storage_path('app/public/'.$file->filePath));
    }
}
