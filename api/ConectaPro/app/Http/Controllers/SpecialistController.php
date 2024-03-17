<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Specialist;
USE App\Models\Speciality;

class SpecialistController extends Controller
{
    public function index() 
    {
        $categories = Category::all();
        $specialties = Speciality::all();
        return view('admin.specialist.index', compact('categories', 'specialties'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'required|integer',
            'specialty' => 'required|integer',
            'description' => 'required|string',
            'image' => 'required|image', // Asegurarse de que la imagen sea un archivo de imagen válido
        ]);

        // Obtener el nombre del archivo de imagen y guardarlo en la carpeta "public/assets/images"
        $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('assets/images'), $imageName);

        // Crear un nuevo especialista con los datos proporcionados
        $specialist = Specialist::create([
            'name' => $data['name'],
            'category_id' => $data['category'],
            'specialty_id' => $data['specialty'],
            'description' => $data['description'],
            'image' => $imageName, // Guardar el nombre del archivo de imagen
        ]);

        if ($specialist) {
            return redirect()->route('admin.specialist.index')->with('success', '¡El especialista se ha creado correctamente!');
        } else {
            return redirect()->route('admin.specialist.index')->with('error', '¡Error al crear el especialista!');
        }
    }
}
