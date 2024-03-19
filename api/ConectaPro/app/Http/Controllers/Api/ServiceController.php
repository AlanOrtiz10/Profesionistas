<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function list() {
        $services = Service::with('user', 'specialist', 'category')->get();
        $list = [];
        foreach($services as $service) {
            $categoryID = $service->category ? $service->category->id : null;
            $categoryName = $service->category ? $service->category->name : null;
            $object = [
                "id" => $service->id,
                "Nombre" => $service->name,
                "Descripcion" => $service->description,
                "ID_Categoria" => [
                    "id" => $categoryID,
                    "name" => $categoryName,
                ],
                "Imagen" => $service->image,
                "Disponibilidad" => $service->availability,
                "ID_Especialista" => [
                    "id" => $service->specialist->id,
                    "name" => $service->specialist->name,
                    "surname" => $service->specialist->surname,
                ],
                "ID_Usuario" => $service->user_id,
                "Created" => $service->updated_at,
                "Updated" => $service->updated_at
            ];
            array_push($list, $object);
        }
        return $list;
    }
    
    

    public function item($id) {
        $service = Service::with('user', 'specialist', 'category')->findOrFail($id);
    
        $categoryName = $service->category ? $service->category->name : null;
        $categoryID = $service->category ? $service->category->id : null;

        $object = [
            "id" => $service->id,
            "Nombre" => $service->name,
            "Descripcion" => $service->description,
            "ID_Categoria" => [
                "id" => $categoryID,
                "name" => $categoryName,
            ],
            "Imagen" => $service->image,
            "Disponibilidad" => $service->availability,
            "ID_Especialista" => [
                "id" => $service->specialist->id,
                "name" => $service->specialist->name,
                "surname" => $service->specialist->surname,
            ],
            "ID_Usuario" => $service->user_id,
            "Created" => $service->updated_at,
            "Updated" => $service->updated_at
        ];
    
        return $object;
    }
    


    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|string',
            'availability' => 'required|string',
            'user_id' => 'required|integer',
            'specialist_id' => 'required|integer',


        ]);
        $service = Service::create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'category_id'=>$data['category_id'],
            'image'=>$data['image'],
            'availability'=>$data['availability'],
            'user_id'=>$data['user_id'],
            'specialist_id'=>$data['specialist_id'],

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


    public function update(Request $request) {
        $data = $request->validate([
            'id' => 'required|int',
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|string',
            'availability' => 'required|string',
            'user_id' => 'int',
            'specialist_id' => 'int',
        ]);
    
        $service = Service::find($data['id']);
    
        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }
    
        $service->name = $data['name'];
        $service->description = $data['description'];
        $service->category_id = $data['category_id'];
        $service->image = $data['image'];
        $service->availability = $data['availability'];
        $service->user_id = $data['user_id'];
        $service->specialist_id = $data['specialist_id'];
    
        if ($service->save()) {
            $object = [
                "response" => 'Success. Item updated correctly.',
                "data" => $service,
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }

    public function delete($id) {
        $service = Service::find($id);
    
        if (!$service) {
            $object = [
                "response" => 'Error: Service not found.',
            ];
            return response()->json($object, 404);
        }
    
        if ($service->delete()) {
            $object = [
                "response" => 'Success. Service deleted successfully.',
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Something went wrong while deleting the Service.',
            ];
            return response()->json($object, 500);
        }
    }
    
    

}
