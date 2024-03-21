<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SpecialistController as ApiSpecialistController;
use App\Models\Category;
use App\Models\Speciality;
use App\Models\User; 
use App\Models\Specialist;

class SpecialistController extends Controller
{
    public function index() 
    {
        // Obtener todas las categorías
        $categories = Category::all();
        
        // Obtener todas las especialidades
        $specialties = Speciality::all();
        
        // Obtener todos los usuarios
        $users = User::all();
        
        $apiSpecialistController = new ApiSpecialistController();
        $specialists = $apiSpecialistController->list();
        
        // Pasar $specialists, $categories, $specialties y $users a la vista
        return view('admin/specialist.index', compact('specialists', 'categories', 'specialties', 'users'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'specialities_id' => 'required',
            'description' => 'required|max:190',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Asegúrate de que la imagen sea válida
        ]);
    
        // Procesar la imagen cargada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/specialists'), $imageName); // Mover la imagen a la ruta deseada
        }
    
        // Crear un nuevo especialista con los datos validados
        $specialist = new Specialist();
        $specialist->user_id = $request->input('user_id');
        $specialist->category_id = $request->input('category_id');
        $specialist->specialities_id = $request->input('specialities_id');
        $specialist->description = $request->input('description');
        $specialist->image = $imageName; // Guardar el nombre de la imagen en la base de datos
        $specialist->save();
    
        // Redirigir a la página de inicio o a donde desees
        return redirect()->route('admin.specialist.index')->with('success', 'Especialista creado correctamente');
    }

    public function destroy($id)
{
    // Buscar la categoría por su ID
    $specialist = Specialist::findOrFail($id);

    // Verificar si la categoría existe y eliminarla
    if ($specialist->delete()) {
        // Eliminar la imagen asociada si no es "placeholder.jpg"
        if ($specialist->image != 'placeholder.jpg') {
            // Construir la ruta completa de la imagen
            $imagePath = public_path('assets/specialists/') . $specialist->image;

            // Verificar si el archivo de imagen existe antes de intentar eliminarlo
            if (file_exists($imagePath)) {
                // Eliminar la imagen
                unlink($imagePath);
            }
        }

        // Redirigir a la página de índice de categorías con un mensaje de éxito
        return redirect()->route('admin.specialist.index')->with('success', 'Especialista eliminado correctamente.');
    } else {
        // Manejar el error si la eliminación falla
        // Esto podría incluir la visualización de un mensaje de error al usuario
        // y redirigir a la página anterior o a una página de error.
        return back()->withErrors(['error' => 'Error al eliminar la categoría.']);
    }
}


public function update(Request $request, $id) {
    // Validar los datos de entrada
    $validatedData = $request->validate([
        'user_id' => 'required|int',
        'category_id' => 'required|int',
        'specialities_id' => 'required|int',
        'description' => 'required|string|max:190',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Buscar al especialista por su ID
    $specialist = Specialist::find($id);

    // Verificar si el especialista existe
    if (!$specialist) {
        return response()->json(['error' => 'Especialista no encontrado'], 404);
    }

    // Actualizar los campos del especialista
    $specialist->user_id = $validatedData['user_id'];
    $specialist->category_id = $validatedData['category_id'];
    $specialist->specialities_id = $validatedData['specialities_id'];
    $specialist->description = $validatedData['description'];

    // Procesar y actualizar la imagen si se proporciona una nueva
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/specialists'), $imageName);

        // Eliminar la imagen anterior si no es la imagen de marcador de posición
        if ($specialist->image !== 'placeholder.jpg') {
            $oldImagePath = public_path('assets/specialists/') . $specialist->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $specialist->image = $imageName;
    }

   // Guardar los cambios
if ($specialist->save()) {
    // Redirigir a la página de índice de especialistas con un mensaje de éxito
    return redirect()->route('admin.specialist.index')->with('success', 'Especialista actualizado correctamente.');
} else {
    // En caso de error al guardar los cambios, mostrar un mensaje de error
    return back()->withErrors(['error' => 'Error: Algo salió mal, por favor inténtalo de nuevo.']);
}

}









    
}
