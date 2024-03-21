<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admi';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }

    protected function authenticated(Request $request, $user)
    {
        // Verificar si el usuario tiene un level_id válido
        if ($user->level_id != 3 && $user->level_id != 1) {
            // Si el nivel no es válido, cerrar la sesión y redirigir con un mensaje de error
            Auth::logout();
            return redirect('/login')->with('error', 'No tienes permiso para acceder.');
        }

        // Si el usuario tiene un nivel válido, redirigir según corresponda
        if ($user->level_id != 3) {
            return redirect()->intended('/admi');
        } elseif ($user->level_id != 1) {
            return redirect()->intended('/admi');
        }

        // Si el usuario no tiene un nivel válido, se puede redirigir a una ruta predeterminada
        return redirect()->intended('/');
    }
}
