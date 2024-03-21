<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|int',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'phone' => 'required|string|max:10',
            'password' => 'nullable|string', // La contraseña es opcional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Imagen opcional, hasta 2MB
        ]);
    
        $user = User::findOrFail($request->id);
    
        $userData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone' => $request->phone,
            // Conserva la imagen actual si no se proporciona una nueva
            'image' => $user->image,
        ];
    
        // Si se proporciona una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/users'), $imageName);
            $userData['image'] = $imageName;
        }
    
        // Verificar si se proporcionó una nueva contraseña y actualizarla si es así
        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }
    
        $user->update($userData);
    
        return redirect()->back()->with('success', '¡Usuario actualizado correctamente!');
    }
    
}
