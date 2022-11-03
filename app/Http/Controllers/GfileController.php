<?php

namespace App\Http\Controllers;

use App\Models\Gfile;
use App\Http\Requests\StoreGfileRequest;
use App\Http\Requests\UpdateGfileRequest;
use Illuminate\Support\Facades\Auth;

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
        return $request->fileName;
        $fileCollection = [];
        foreach($request->fileName as $key=> $afile){

            // return $afile;
            $Fname = $afile->getClientOriginalName();
            $Fname->store('public');
            $fileCollection[$key] = [
                'fileName' => $Fname,
                'user_id' => Auth::user()->id,
            ];
            $afile->store('public');
        }
        Gfile::insert($fileCollection);
        // return $fileCollection;
        return redirect()->route('dashboard')->with('status', 'files are uploaded');
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
