<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function list() {
        $users =  User::all();
        $list = [];
        foreach($users as $user) {
            $object = [
                "id" => $user->id,
                "Nombre" => $user->name,
                "Apellido" => $user->surname,
                "Email" => $user->email,
                "Telefono" => $user->phone,
                "Correo_Verificado" => $user->email_verified_at,
                "Password" => $user->password,
                "Nivel"=> $user->level,
                "Imagen" => $user->image,
                "Recordar_sesion" => $user->remember_token,
                "Created" => $user->updated_at,
                "Updated" => $user->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $users =  User::where('id', '=', $id)->first();
        $object = [
            "id" => $users->id,
                "Nombre" => $users->name,
                "Apellido" => $users->surname,
                "Email" => $users->email,
                "Telefono" => $users->phone,
                "Correo_Verificado" => $users->email_verified_at,
                "Password" => $users->password,
                "Nivel"=> $users->level,
                "Imagen" => $users->image,
                "Recordar_sesion" => $users->remember_token,
                "Created" => $users->updated_at,
                "Updated" => $users->updated_at
        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|numeric',
            'password' => 'required|string',
            
           
           
        ]);
        $user = User::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'password' => bcrypt($data['password']), // Encriptar la contraseña con bcrypt
            
        ]);
        if ($user) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $user,
            ];
            return response()->json($object);
        }else{
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }



}
