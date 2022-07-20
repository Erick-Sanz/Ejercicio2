<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pets::join('users','users.id','=','pets.user_id')
            ->select('pets.name','pets.age','pets.id')
            ->where('users.id','=',auth()->user()->id)
            ->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|min:2|max:120',
            'age' => 'required|numeric|min:0|max:50',
        ]);
        return Pets::create([
            'name' => $request->name,
            'age' => $request->age,
            'user_id' => auth()->user()->id,
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
        $pet=Pets::find($id);
        if(isset($pet)){        
            $response=$pet;
            $code= 200;
        } else{
            $response=[
                'errors'=>'La mascota no existe',
            ];
            $code= 404; 
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
        $pet=Pets::find($id);
        $response=[];
        $code=500;
        if(isset($pet)){
            $request->validate([
                'name' =>'required|min:2|max:120',
                'age' => 'required|numeric|min:0|max:50',
            ]);       
            $pet->update([
                'name' => $request->name,
                'age' => $request->age,
            ]);
            $response=$pet;
            $code= 200;
        } else{
            $response=[
                'errors'=>'La mascota no existe',
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
        $response=[];
        $code=500;
        $resp=Pets::destroy($id);
        if($resp===1)
        {
            $response=[
            'message'=>'La mascota se elimino correctamente'
            ];
            $code= 200;
        }else{
            $response=[
            'message'=>'La mascota no se encontro'
            ];
            $code= 404;
        }    
        collect($response)->toJson();
        return response($response,$code)->header('Content-Type', 'application/json'); 
    }
}
