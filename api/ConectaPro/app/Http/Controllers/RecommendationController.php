<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RecommendationController as ApiRecommendationController;
use App\Models\User;
use App\Models\Specialist;
use App\Models\Service;
use App\Models\Recommendation;


class RecommendationController extends Controller
{
    public function index() 
    {
        $apiRecommendationController = new ApiRecommendationController();
        $apiRecommendations = $apiRecommendationController->list();
        $users = User::all(); // Obtener todos los usuarios
        $specialists = Specialist::all(); // Obtener todos los especialistas
        $recommendations = Recommendation::paginate(10);
    
        return view('admin.recommendation.index', compact('recommendations', 'users', 'specialists', 'apiRecommendations'));
    }
    

    


    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id', // Asegúrate de que se proporcione un user_id válido
        'specialist_id' => 'required|exists:specialists,id',
        'comment' => 'required',
        'rating' => 'required|integer|between:1,5',
        'service_id' => 'required',
    ]);

    Recommendation::create([
        'user_id' => $request->user_id,
        'specialist_id' => $request->specialist_id,
        'comment' => $request->comment,
        'rating' => $request->rating,
        'service_id' => $request->service_id,
    ]);

    return redirect()->route('admin.recommendation.index')->with('success', 'Recomendación agregada correctamente.');
}


    public function create()
{
    // Obtener todos los usuarios y especialistas
    $users = User::all();
    $specialists = Specialist::with('user')->get();
    return view('admin.recommendation.create', compact('users', 'specialists'));
}

    
    


    public function getServices($specialistId)
    {
        // Obtener todos los servicios relacionados con el especialista seleccionado
        $services = Service::where('specialist_id', $specialistId)->get();
        return response()->json($services);
    }
    

    


    
}
