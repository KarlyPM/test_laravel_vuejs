<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class UserController extends Controller
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

            return response()->json($validator->errors(), 400);
        }

        $user = User::create($request->all() );
        $token = $user->createToken('token')->accessToken;

        return response()->json(['token' => $token, 'user' => $user ], 200);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellidos' => 'required',            
            'cedula' => ["required",Rule::unique('users')->ignore($id)],
            'celular' => 'required',
            'ciudad' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);

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

