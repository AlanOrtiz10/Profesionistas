<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RecommendationController as ApiRecommendationController;
use App\Models\User;
use App\Models\Specialist;
use App\Models\Service;

class RecommendationController extends Controller
{
    public function index() 
    {
        $apiRecommendationController = new ApiRecommendationController();
        $recommendations = $apiRecommendationController->list();
        return view('admin.recommendation.index', compact('recommendations'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $data = $request->validate([
            'user_id' => 'required|integer',
            'specialist_id' => 'required|integer',
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'service_id' => 'required|integer',
        ]);

        // Crear una nueva recomendación
        $recommendation = new \App\Models\Recommendation();
        $recommendation->user_id = $data['user_id'];
        $recommendation->specialist_id = $data['specialist_id'];
        $recommendation->comment = $data['comment'];
        $recommendation->rating = $data['rating'];
        $recommendation->service_id = $data['service_id'];

        // Guardar la recomendación en la base de datos
        $recommendation->save();

        // Redirigir a la página de índice de recomendaciones
        return redirect()->route('admin.recommendation.index');
    }

    public function create()
    {
        // Obtener usuarios, especialistas y servicios para llenar los select
        $users = User::all();
        $specialists = Specialist::all();
        $services = Service::all();
        
        return view('admin.recommendation.create', compact('users', 'specialists', 'services'));
    }
}
