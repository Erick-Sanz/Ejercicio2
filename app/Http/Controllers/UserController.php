<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return User::paginate(5);
        return User::join('pets','pets.user_id','=','users.id')
                    ->join('pet_vaccines','pet_vaccines.pet_id','=','pets.id')
                    ->join('vaccines','vaccines.id','=','pet_vaccines.vaccine_id')
                    ->select('users.id','users.name as user_name','users.surname','users.email',
                    'pets.name as pet_name','pets.age','vaccines.name as vaccines_name')
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
        $user=User::find($id);
        $response=[];
        $code=500;
        if(isset($user)){
            $response=$user;
            $code=200;
        } else{
            $response=[
                'errors'=>'El usuario no existe',
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
        $user=User::find($id);
        if(isset($user)){
        $fields=$request->validate([
        'name' => 'required|string|min:3|max:50',
        'surname' => 'required|string|min:3|max:50',
        'email' => ['required','string','unique:users,email,'.$user->id,'regex:/(.*)@(gmail|yahoo|outlook)\.com/i'],
        ]);  
        $newPassword="";
        if($request['password']!==""){
            $fields=$request->validate(['password' =>  ['required',Password::defaults()]]);
            $newPassword=Hash::make($fields['password']);
        }
        else {
            $newPassword=$user->password;
        }
        $user->update([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' =>$newPassword,
        ]);
            $response=$user;
            $code= 200;
        } else{
            $response=[
                'errors'=>'El usuario no existe',
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
        $resp=User::destroy($id);
        $response=[];
        $code=500;
        if($resp===1)
        {
            auth()->user()->tokens()->delete();   
            $response=[
            'message'=>'El usuario y sus datos fueron eliminados'
            ];
            $code= 200;
        }else{
            $response=[
            'message'=>'El usuario no se encontro'
            ];
            $code= 404;
        }
        collect($response)->toJson();
        return response($response,$code)->header('Content-Type', 'application/json');      
    }
}
