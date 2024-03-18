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
        // Obtener las categorías de la API
        $apiCategoryController = new ApiCategoryController();
        $apiCategories = $apiCategoryController->list();
        
        // Paginar las categorías de la base de datos
        $categories = Category::paginate(10);

        return view('admin.category.index', compact('apiCategories', 'categories'));
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

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
{
    // Validar los datos de entrada si es necesario
    $data = $request->validate([
        'name' => 'string',
        'description' => 'string',
        'image' => 'image', // Cambiado a 'image'
    ]);

    // Buscar la categoría por su ID
    $category = Category::findOrFail($id);

    // Actualizar los campos de la categoría con los nuevos datos
    $category->name = $data['name'] ?? $category->name;
    $category->description = $data['description'] ?? $category->description;

    // Verificar si se ha enviado una nueva imagen
    if ($request->hasFile('image')) {
        // Obtener el archivo de imagen
        $image = $request->file('image');
        
        // Generar un nombre único para la imagen
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Mover la imagen a la ubicación deseada
        $image->move(public_path('assets/categories'), $imageName);

        // Eliminar la imagen anterior si existe
        if ($category->image) {
            Storage::delete('public/assets/categories/' . $category->image);
        }

        // Actualizar el nombre de la imagen en el campo de la categoría
        $category->image = $imageName;
    }

    // Guardar los cambios en la base de datos
    if ($category->save()) {
        // Redirigir a la página de índice de categorías
        return redirect()->route('admin.category.index');
    } else {
        // Manejar el error si la categoría no se puede guardar correctamente
        // Esto podría incluir la visualización de un mensaje de error al usuario
        // y redirigir a la página anterior o a una página de error.
    }
}



}
