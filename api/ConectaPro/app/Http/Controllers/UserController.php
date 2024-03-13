<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController as ApiUserController;

class UserController extends Controller
{
    public function index() 
    {
        $apiUserController = new ApiUserController();
        $users = $apiUserController->list();
        return view('admin/user.index', compact('users'));
    }

    public function create()
    {
        return view('admin/user.create');
    }

    public function store(Request $request) 
{
    // Validación de datos
    $data = $request->validate([
        'name' => 'required|string',
        'surname' => 'required|string',
        'email' => 'required|string',
        'phone' => 'required|numeric',
        'password' => 'required|string',
    ]);

    // Encriptar la contraseña con bcrypt
    $hashedPassword = bcrypt($data['password']);

    // Crear el usuario
    $user = User::create([
        'name' => $data['name'],
        'surname' => $data['surname'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'password' => $hashedPassword,
    ]);

    // Redirigir o mostrar un mensaje según sea necesario
    if ($user) {
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    } else {
        return back()->with('error', 'Error al crear el usuario. Por favor, inténtalo de nuevo.');
    }
}


    // Puedes agregar más funciones según sea necesario para otras operaciones CRUD
}
