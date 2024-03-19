<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SpecialityController as ApiSpecialityController;
use App\Models\Speciality;


class SpecialityController extends Controller
{
    public function index() 
    {
        $apiSpecialityController = new ApiSpecialityController();
        $specialities = Speciality::orderBy('id', 'asc')->paginate(10);
        return view('admin/speciality.index', compact('specialities'));
    }

    public function create(Request $request) 
{
    $data = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
    ]);

    $speciality = Speciality::create([
        'name' => $data['name'],
        'description' => $data['description'],
    ]);

    if ($speciality) {
        $object = [
            "response" => 'Success. Item saved correctly.',
            "data" => $speciality,
        ];
        return redirect()->route('admin.speciality.index')->with('success', 'Especialidad registrada correctamente');
    } else {
        $object = [
            "response" => 'Error: Something went wrong, please try again.'
        ];
        return response()->json($object);
    }
}

public function update(Request $request)
{
    // Validar los datos del formulario
    $data = $request->validate([
        'id' => 'required|int',
        'name' => 'required|string',
        'description' => 'required|string'
    ]);

    // Actualizar la especialidad
    $speciality = Speciality::find($data['id']);
    if (!$speciality) {
        return redirect()->back()->with('error', 'Especialidad no encontrada');
    }

    $speciality->name = $data['name'];
    $speciality->description = $data['description'];

    if ($speciality->save()) {
        return redirect()->route('admin.speciality.index')->with('success', 'Especialidad actualizada correctamente');
    } else {
        return redirect()->back()->with('error', 'Error al actualizar la especialidad');
    }
}

public function destroy($id) {
    $speciality = Speciality::find($id);

    if (!$speciality) {
        return redirect()->route('admin.speciality.index')->with('error', '¡Especialidad no encontrada!');
    }

    if ($speciality->delete()) {
        return redirect()->route('admin.speciality.index')->with('success', '¡Especialidad eliminada correctamente!');
    } else {
        return redirect()->route('admin.speciality.index')->with('error', '¡Ups! Algo salió mal al eliminar la especialidad. Por favor, inténtalo de nuevo.');
    }
}







}
