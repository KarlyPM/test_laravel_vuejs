<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class PersonaController extends Controller
{
    public function index()
    {
        $persons = User::all();
        return response()->json($persons, 200);

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellidos' => 'required',
            'cedula' => 'required|unique:users',
            'celular' => 'required',
            'ciudad' => 'required',
        ]);


        if ($validator->fails()) {

            return response()->json($validator->errors());

        }
        $user = User::create($request->all() );

        $token = $user->createToken('token')->accessToken;

        return response()->json(['token' => $token, 'persona' => $user ], 200);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellidos' => 'required',
            'cedula' => 'required|unique:users',
            'celular' => 'required',
            'ciudad' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors());

        }

        $person=User::find($id);

        $person->update($request->all());
        return response()->json($person, 200);
    }


    public function destroy($id)
    {

        DB::table('users')->where('id', $id)->delete();
        return response()->json('Eliminado satisfactoriamente', 200);
    }


    public function show($id)
    {

        $user=User::find($id);
        return response()->json($user, 200);
    }


}
