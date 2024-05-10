<?php

namespace App\Http\Controllers;

use App\Models\Aliments;
use Illuminate\Http\Request;

class AlimentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aliments = Aliments::all();
        return response()->json($aliments);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aliments  $aliments
     * @return \Illuminate\Http\Response
     */
    public function show(Aliments $aliments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aliments  $aliments
     * @return \Illuminate\Http\Response
     */
    public function edit(Aliments $aliments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aliments  $aliments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aliments $aliments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aliments  $aliments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aliments $aliments)
    {
        //
    }
}
