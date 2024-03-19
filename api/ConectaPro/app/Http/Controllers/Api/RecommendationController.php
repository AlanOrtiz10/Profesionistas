<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;

class RecommendationController extends Controller
{

    public function list() {
        $recommendations = Recommendation::with('user', 'specialist', 'service')->get();
        $list = [];
        foreach ($recommendations as $recommendation) {
            $user = $recommendation->user;
            $specialist = $recommendation->specialist;
    
            $object = [
                "id" => $recommendation->id,
                "ID_Usuario" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "surname" => $user->surname,
                ],
                "ID_Especialista" => [
                    "id" => $specialist->id,
                    "name" => $specialist->name,
                    "surname" => $specialist->surname,
                ],
                "Comentario" => $recommendation->comment,
                "Calificacion" => $recommendation->rating,
                "ID_Servicio" => $recommendation->service->name, 
                "Created" => $recommendation->created_at,
                "Updated" => $recommendation->updated_at
            ];
            array_push($list, $object);
        }
        return $list;
    }

    public function item($id) {
        $recommendation = Recommendation::with('user', 'specialist', 'service')->find($id);
    
        if (!$recommendation) {
            return response()->json(['error' => 'Recomendación no encontrada'], 404);
        }
    
        $user = $recommendation->user;
        $specialist = $recommendation->specialist;
    
        $object = [
            "id" => $recommendation->id,
            "ID_Usuario" => [
                "id" => $user->id,
                "name" => $user->name,
                "surname" => $user->surname,
            ],
            "ID_Especialista" => [
                "id" => $specialist->id,
                "name" => $specialist->name,
                "surname" => $specialist->surname,
            ],
            "Comentario" => $recommendation->comment,
            "Calificacion" => $recommendation->rating,
            "ID_Servicio" => $recommendation->service->name, 
            "Created" => $recommendation->created_at,
            "Updated" => $recommendation->updated_at
        ];
    
        return $object;
    }
    

    public function create(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'specialist_id' => 'required|integer',
            'comment' => 'required|string',
            'rating' => 'required|numeric',
            'service_id' => 'required|integer',


        ]);
        $recommendation = Recommendation::create([
            'user_id'=>$data['user_id'],
            'specialist_id'=>$data['specialist_id'],
            'comment'=>$data['comment'],
            'rating'=>$data['rating'],
            'service_id'=>$data['service_id'],


        ]);
        if ($recommendation) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $recommendation,
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
            'user_id' => 'required|int',
            'specialist_id' => 'required|int',
            'comment' => 'required|string',
            'rating' => 'required|numeric',
            'service_id' => 'required|int',
        ]);
    
        $recommendation = Recommendation::find($data['id']);
    
        if (!$recommendation) {
            return response()->json(['error' => 'Recomendación no encontrada'], 404);
        }
    
        $recommendation->user_id = $data['user_id'];
        $recommendation->specialist_id = $data['specialist_id'];
        $recommendation->comment = $data['comment'];
        $recommendation->rating = $data['rating'];
        $recommendation->service_id = $data['service_id'];
    
        if ($recommendation->save()) {
            $object = [
                "response" => 'Success. Item updated correctly.',
                "data" => $recommendation,
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
        $recommendation = Recommendation::find($id);
    
        if (!$recommendation) {
            $object = [
                "response" => 'Error: Recomendacion no encontrada.',
            ];
            return response()->json($object, 404);
        }
    
        if ($recommendation->delete()) {
            $object = [
                "response" => 'Éxito. Recomendacion eliminada correctamente.',
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Algo salió mal al eliminar la Recomendacion.',
            ];
            return response()->json($object, 500);
        }
    }
    

}
