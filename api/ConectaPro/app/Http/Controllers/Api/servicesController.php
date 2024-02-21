<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\services;

class servicesController extends Controller
{
    
    public function list() {
        $services =  services::all();
        $list = [];
        foreach($services as $service) {
            $object = [
                "id" => $service->id,
                "Nombre" => $service->name,
                "Descripcion" => $service->description,
                "ID_Categoria" => $service->category_id,
                "Imagen" => $service->image,
                "Created" => $service->updated_at,
                "Updated" => $service->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $services =  services::where('id', '=', $id)->first();
        $object = [
            "id" => $services->id,
            "Nombre" => $services->name,
            "Descripcion" => $services->description,
            "ID_Categoria" => $services->category_id,
            "Imagen" => $services->image,
            "Created" => $services->updated_at,
            "Updated" => $services->updated_at
        ];
        return response()->json($object);
    }


    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|string'

        ]);
        $service = services::create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'category_id'=>$data['category_id'],
            'image'=>$data['image']

        ]);
        if ($service) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $service,
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
