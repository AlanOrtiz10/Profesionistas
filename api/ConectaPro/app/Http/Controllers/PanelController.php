<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function config()
    {
        return view('admin.config');
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    $results = [];

    // Definir rutas para cada tarjeta
    $cardRoutes = [
        'Servicios' => route('admin.service.index'),
    ];

    // Si el usuario es de nivel 1, mostrar todas las tarjetas
    if (auth()->user()->level_id == 1) {
        $cardRoutes = [
            'Categorías' => route('admin.category.index'),
            'Recomendaciones' => route('admin.recommendation.index'),
            'Servicios' => route('admin.service.index'),
            'Especialistas' => route('admin.specialist.index'),
            'Usuarios' => route('admin.users.index'),
            'Especialidades' => route('admin.speciality.index')
        ];
    }

    // Buscar coincidencia por el título de la tarjeta
    $cards = array_keys($cardRoutes);

    foreach ($cards as $card) {
        if (stripos($card, $query) !== false) {
            $results[$card] = $cardRoutes[$card];
        }
    }

    return view('admin.search_results', ['query' => $query, 'results' => $results]);
}

}