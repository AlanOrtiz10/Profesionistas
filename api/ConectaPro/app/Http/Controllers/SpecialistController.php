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
    
}
