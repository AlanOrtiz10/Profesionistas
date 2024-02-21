<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function list() {
        $categories =  Category::all();
        $list = [];
        foreach($categories as $category) {
            $object = [
                "id" => $category->id,
                "Nombre" => $category->name,
                "Descripcion" => $category->description,
                "Imagen" => $category->image,
                "Created" => $category->updated_at,
                "Updated" => $category->updated_at

            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }

    public function item($id) {
        $categories =  Category::where('id', '=', $id)->first();
        $object = [
            "id" => $categories->id,
            "Nombre" => $categories->name,
            "Descripcion" => $categories->description,
            "Imagen" => $categories->image,
            "Created" => $categories->updated_at,
            "Updated" => $categories->updated_at
        ];
        return response()->json($object);
    }


    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string'
        ]);
        $category = Category::create([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'image'=>$data['image']
        ]);
        if ($category) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $category,
            ];
            return response()->json($object);
        }else{
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }

    public function update( Request $request){
        $data = $request->validate([
            'id' => 'required|int',
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
        ]);

        $category =  Category::where('id', '=', $data['id'])->first();

        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->image = $data['image'];

        if ($category->update()) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $category,
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
