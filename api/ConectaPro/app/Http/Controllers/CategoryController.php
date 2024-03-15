<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index() 
    {
        $apiCategoryController = new ApiCategoryController();
        $categories = $apiCategoryController->list();
        return view('admin.category.index', compact('categories'));
    }

    

public function store(Request $request)
{
    // Validar los datos del formulario si es necesario

    // Crear una nueva categoría
    $category = new Category();
    $category->name = $request->input('name');
    $category->description = $request->input('description');

    // Verificar si se ha enviado un archivo de imagen
    if ($request->hasFile('image')) {
        // Obtener el archivo de imagen
        $image = $request->file('image');
        
        // Generar un nombre único para la imagen
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Mover la imagen a la ubicación deseada
        $image->move('assets/categories', $imageName);

        // Guardar el nombre de la imagen en el campo correspondiente de la categoría
        $category->image = $imageName;
    }

    // Guardar la categoría en la base de datos
    $category->save();

    // Redirigir a la página de índice de categorías u otra página según sea necesario
    return redirect()->route('admin.category.index');
}


}
