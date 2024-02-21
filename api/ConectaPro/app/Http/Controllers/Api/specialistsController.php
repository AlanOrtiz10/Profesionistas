<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\specialists;

class specialistsController extends Controller
{
    

    public function list() {
        $specialists =  specialists::all();
        $list = [];
        foreach($specialists as $specialist) {
            $object = [
                "id" => $specialist->id,
                "Descripcion" => $specialist->description,
                "Imagen" => $specialist->image,
                "ID_Usuario" => $specialist->user_id,
                "ID_Categoria" => $specialist->category_id,
                "Created" => $specialist->updated_at,
                "Updated" => $specialist->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $specialists =  specialists::where('id', '=', $id)->first();
        $object = [
            "id" => $specialists->id,
            "Descripcion" => $specialists->description,
            "Imagen" => $specialists->image,
            "ID_Usuario" => $specialists->user_id,
            "ID_Categoria" => $specialists->category_id,
            "Created" => $specialists->updated_at,
            "Updated" => $specialists->updated_at

        ];
        return response()->json($object);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'description' => 'required|string',
            'image' => 'required|string',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer'

        ]);
        $specialist = specialists::create([
            'description'=>$data['description'],
            'image'=>$data['image'],
            'user_id'=>$data['user_id'],
            'category_id'=>$data['category_id']

        ]);
        if ($specialist) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $specialist,
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
