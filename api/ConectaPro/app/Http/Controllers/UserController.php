<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Http\Controllers\Api\UserController as ApiUserController;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index() 
{
    $apiUserController = new ApiUserController();
    $users = $apiUserController->list();
    $levels = Level::all(); // Obtener todos los niveles de la tabla levels
    return view('admin/user.index', compact('users', 'levels'));
}


    public function create()
{
    $levels = Level::all(); // Obtener todos los niveles de la tabla levels
    return view('admin/user.create', compact('levels'));
}


public function store(Request $request) 
{
    $data = $request->validate([
        'name' => 'required|string',
        'surname' => 'required|string',
        'email' => 'required|string',
        'phone' => 'required|string',
        'level' => 'required|exists:levels,id', // Verificar que el nivel seleccionado exista en la tabla levels
        'image' => 'required|image', // Validación para la imagen
        'password' => 'required|string', // Validación para la contraseña
    ]);

    // Procesamiento de la imagen
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('assets/users'), $imageName); // Guardar la imagen en la ruta especificada

    // Encriptar la contraseña con bcrypt
    $hashedPassword = bcrypt($data['password']);

    $user = new User;
    $user->name = $data['name'];
    $user->surname = $data['surname'];
    $user->email = $data['email'];
    $user->phone = $data['phone'];
    $user->level_id = $data['level'];
    $user->image = $imageName; // Asigna el nombre de la imagen procesada aquí
    $user->password = $hashedPassword; // Asigna la contraseña encriptada
    $user->save();

    // Redirigir o mostrar un mensaje según sea necesario
    return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
}


public function destroy($id)
{
    // Buscar la categoría por su ID
    $user = User::findOrFail($id);

    // Verificar si la categoría existe y eliminarla
    if ($user->delete()) {
        // Eliminar la imagen asociada si no es "placeholder.jpg"
        if ($user->image != 'placeholder.jpg') {
            // Construir la ruta completa de la imagen
            $imagePath = public_path('assets/users/') . $user->image;

            // Verificar si el archivo de imagen existe antes de intentar eliminarlo
            if (file_exists($imagePath)) {
                // Eliminar la imagen
                unlink($imagePath);
            }
        }

        // Redirigir a la página de índice de categorías con un mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    } else {
        // Manejar el error si la eliminación falla
        // Esto podría incluir la visualización de un mensaje de error al usuario
        // y redirigir a la página anterior o a una página de error.
        return back()->withErrors(['error' => 'Error al eliminar el usuario.']);
    }
}




    // Otros métodos del controlador...
}
