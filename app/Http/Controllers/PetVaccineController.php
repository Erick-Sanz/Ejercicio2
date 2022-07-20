<?php

namespace App\Http\Controllers;

use App\Models\PetVaccine;
use Illuminate\Http\Request;

class PetVaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request)
    {        
        $request->validate([
            'pet_id' =>'required|numeric|min:1',
            'vaccine_id' => 'required|numeric|min:1',
        ]);
        return PetVaccine::create([
            'pet_id' => $request->pet_id,
            'vaccine_id' => $request->vaccine_id,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
