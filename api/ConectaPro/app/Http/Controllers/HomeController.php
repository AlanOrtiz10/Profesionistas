<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener solo los primeros 8 registros de la tabla services
        $services = Service::take(8)->get();
        $recommendations = Recommendation::take(6)->get();

        return view('home', compact('services', 'recommendations'));
    }
}
