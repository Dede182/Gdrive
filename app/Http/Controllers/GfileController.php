<?php

namespace App\Http\Controllers;

use App\Models\Gfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreGfileRequest;
use App\Http\Requests\UpdateGfileRequest;

class GfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGfileRequest $request)
    {
        // return $request->fileName;
        $fileCollection = [];
        foreach($request->fileName as $key=> $afile){
            Storage::makeDirectory(Auth::user()->name);
            $folderName = Auth::user()->name;
            $Fname = $afile->getClientOriginalName();

            $fileCollection[$key] = [
                'fileName' => $Fname,
                'user_id' => Auth::user()->id,
            ];
            $afile->storeAs('public/'.$folderName.'/',$Fname);
        }
        Gfile::insert($fileCollection);
        // return $fileCollection;
        return redirect()->route('dashboard')->with('status', 'files are uploaded');
    }

    public function download(){
        return "hi";
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gfile  $gfile
     * @return \Illuminate\Http\Response
     */
    public function show(Gfile $gfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gfile  $gfile
     * @return \Illuminate\Http\Response
     */
    public function edit(Gfile $gfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGfileRequest  $request
     * @param  \App\Models\Gfile  $gfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGfileRequest $request, Gfile $gfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gfile  $gfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gfile $gfile)
    {
        //
    }
}
