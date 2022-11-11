<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gfile;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function dia(){
        // return "hi";
        $folderId = Folder::inRandomOrder()->first();
        $userId = User::findOrFail($folderId->user_id);

        return [$userId , $folderId];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFolderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFolderRequest $request)
    {
        // return $request;
        $folder = new Folder();
        $folder->folderName = $request->folderName;
        $folder->user_id = Auth::user()->id;
        $folder->save();
        return redirect()->route('dashboard')->with('status',$folder->folderName . " is created");
    }

    public function folderUpload(Request $request){
        // return $request;
        $folder = new Folder();
        $folder->folderName = $request->originalFolderName;
        $folder->user_id = Auth::user()->id;
        $folder->save();

        $fileCollection = [];
        foreach($request->folders as $key=> $afile){
            Storage::makeDirectory('public/'.Auth::user()->name);
            Storage::makeDirectory('public/'.Auth::user()->name.'/'.$folder->folderName);
            $keepFolderName =Auth::user()->name.'/'.$folder->folderName;
            $Fname = $afile->getClientOriginalName();

            $afile->storeAs('public/'.$keepFolderName.'/',$Fname);

                $fileCollection[$key] = [
                    'fileName' => $Fname,
                    'filePath' => $keepFolderName.'/'.$Fname,
                    'parentName' => $folder->folderName,
                    'fileSize' => Storage::size('public/'.$keepFolderName.'/'.$Fname),
                    'user_id' => Auth::user()->id,
                    'folder_id' => $folder->id,
                ];


        }
        Gfile::insert($fileCollection);

        return redirect()->route('dashboard')->with('status','folder was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        return view('Folder.show',compact('folder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFolderRequest  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //
    }
}
