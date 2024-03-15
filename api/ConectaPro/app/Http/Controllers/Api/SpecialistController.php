<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialist;

class SpecialistController extends Controller
{
    

    public function list()
{
    $specialists = Specialist::with(['specialities:id,description', 'user:id,name,surname', 'category:id,name'])->get();
    
    $list = $specialists->map(function ($specialist) {
        return [
            "id" => $specialist->id,
            "Descripcion" => $specialist->description,
            "Imagen" => $specialist->image,
            "ID_Usuario" => [
                "id" => $specialist->user->id,
                "name" => $specialist->user->name,
                "surname" => $specialist->user->surname,
            ],
            "ID_Categoria" =>
                
               $specialist->category->name,
        
            "ID_Especialidades" => 
            $specialist->specialities->description,
           
            "Created" => $specialist->created_at,
            "Updated" => $specialist->updated_at
        ];
    });
    
    return $list;
}

    
    


    public function item($id) {
        $specialists =  Specialist::where('id', '=', $id)->first();
        $object = [
            "id" => $specialists->id,
            "Descripcion" => $specialists->description,
            "Imagen" => $specialists->image,
            "ID_Usuario" => $specialists->user_id,
            "ID_Categoria" => $specialists->category_id,
            "ID_Especialidades" => $specialists->specialities_id,
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
            'category_id' => 'required|integer',
            'specialities_id' => 'required|integer'


        ]);
        $specialist = Specialist::create([
            'description'=>$data['description'],
            'image'=>$data['image'],
            'user_id'=>$data['user_id'],
            'category_id'=>$data['category_id'],
            'specialities_id'=>$data['category_id']


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
