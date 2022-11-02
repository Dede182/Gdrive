<?php

namespace App\Http\Controllers;

use App\Models\Gfile;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
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
