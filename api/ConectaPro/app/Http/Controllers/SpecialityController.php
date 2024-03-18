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
        $specialities = $apiSpecialityController->list();
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
        return redirect()->route('admin.speciality.index'); // Redireccionar al usuario a la ruta admin.speciality.index
    } else {
        $object = [
            "response" => 'Error: Something went wrong, please try again.'
        ];
        return response()->json($object);
    }
}


}
