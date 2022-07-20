<?php

namespace App\Http\Controllers;

use App\Models\Vaccines;
use Illuminate\Http\Request;


class VaccineController extends Controller
{
    private $rules=[
        'name' =>'required|min:3|max:120|unique:vaccines',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vaccines::paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);
        return Vaccines::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response=[];
        $code=500;
        $vaccine=Vaccines::find($id);
        if(isset($vaccine)){            
            $response=$vaccine;
            $code= 200; 
        } else{
            $response=[
                'errors'=>'La vacuna no existe',
            ];
            $code=404; 
        }
        collect($response)->toJson();
        return response($response,$code)->header('Content-Type', 'application/json');
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
        $response=[];
        $code=500;
        $vaccine=Vaccines::find($id);
        if(isset($vaccine)){
            $request->validate($this->rules);       
            $vaccine->update([
                'name' => $request->name,
            ]);
            $response=$vaccine;
            $code=200; 
        } else{
            $response=[
                'errors'=>'La vacuna no existe',
            ];
            $code=404; 
        }
        collect($response)->toJson();
        return response($response,$code)->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response=['message'=>""];
        $code=500;
        try {
            $resp=Vaccines::destroy($id);
            if($resp===1)
            {
                $response['message']='La vacuna se elimino correctamente';
                $code=200;
            }else{
                $response['message']='La mascota no se encontro';
                $code=404;
            }  
        } catch (\Illuminate\Database\QueryException $e) {
            $response['message']='La vacuna no puede ser eliminada porque generaria incongruencia en los datos';
            $code=409;
        }
        collect($response)->toJson();
        return response($response,$code)->header('Content-Type', 'application/json');
    }
}
