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
        $recommendations =  Recommendation::where('id', '=', $id)->first();
        $object = [
            "id" => $recommendations->id,
            "ID_Usuario" => $recommendations->user,
            "ID_Especialista" => $recommendations->user,
            "Comentario" => $recommendations->comment,
            "Calificacion" => $recommendations->rating,
            "ID_Servicio" => $recommendations->service_id,
            "Created" => $recommendations->updated_at,
            "Updated" => $recommendations->updated_at


        ];
        return response()->json($object);
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






}
