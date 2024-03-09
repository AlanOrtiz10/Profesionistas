<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function list() {
        $services =  Service::all();
        $list = [];
        foreach($services as $service) {
            $object = [
                "id" => $service->id,
                "Nombre" => $service->name,
                "Descripcion" => $service->description,
                "ID_Categoria" => $service->category_id,
                "Imagen" => $service->image,
                "Disponibilidad" => $service->availability,
                "ID_Especialista" => $service->specialist_id,
                "ID_Usuario" => $service->user_id,
                "Created" => $service->updated_at,
                "Updated" => $service->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $services =  Service::where('id', '=', $id)->first();
        $object = [
            "id" => $services->id,
            "Nombre" => $services->name,
            "Descripcion" => $services->description,
            "ID_Categoria" => $services->category_id,
            "Imagen" => $services->image,
            "Disponibilidad" => $services->availability,
            "ID_Especialista" => $services->specialist_id,
            "ID_Usuario" => $services->user_id,
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
            'image' => 'required|string',
            'availability' => 'required|string',
            'user_id' => 'required|integer',
            'service_id' => 'required|integer',


        ]);
        $service = Service::create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'category_id'=>$data['category_id'],
            'image'=>$data['image'],
            'availability'=>$data['availability'],
            'user_id'=>$data['user_id'],
            'service_id'=>$data['service_id'],




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
