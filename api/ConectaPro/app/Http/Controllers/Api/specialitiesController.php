<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\specialities;

class specialitiesController extends Controller
{
    public function list() {
        $specialities =  specialities::all();
        $list = [];
        foreach($specialities as $speciality) {
            $object = [
                "id" => $speciality->id,
                "Nombre" => $speciality->name,
                "Descripcion" => $speciality->description,
                "Created" => $speciality->updated_at,
                "Updated" => $speciality->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $specialities =  specialities::where('id', '=', $id)->first();
        $object = [
            "id" => $specialities->id,
            "Nombre" => $specialities->name,
            "Descripcion" => $specialities->description,
            "Created" => $specialities->updated_at,
            "Updated" => $specialities->updated_at
        ];
        return response()->json($object);
    }


    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
           
        ]);
        $speciality = specialities::create([
            'name'=>$data['name'],
            'description'=>$data['description']
            
        ]);
        if ($speciality) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $speciality,
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
