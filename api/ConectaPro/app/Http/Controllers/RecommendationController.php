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
        // Obtener todas las recomendaciones
        $recommendations = Recommendation::paginate(10);
    
        // Obtener todos los usuarios
        $users = User::all();
    
        // Obtener todos los especialistas
        $specialists = Specialist::all();
        
        // Retornar la vista con las recomendaciones paginadas, los usuarios y los especialistas
        return view('admin.recommendation.index', compact('recommendations', 'users', 'specialists'));
    }
    


    public function create()
    {
        // Obtener todos los usuarios y especialistas
        $users = User::all();
        $specialists = Specialist::all();
        $services = Service::all();

        // Retornar la vista de creación con los datos necesarios
        return view('admin.recommendation.create', compact('users', 'specialists', 'services'));
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialist_id' => 'required|exists:specialists,id',
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'service_id' => 'required|exists:services,id',
        ]);

        // Crear una nueva recomendación
        Recommendation::create([
            'user_id' => $request->user_id,
            'specialist_id' => $request->specialist_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'service_id' => $request->service_id,
        ]);

        // Redireccionar a la página de administración de recomendaciones
        return redirect()->route('admin.recommendation.index')->with('success', 'Recomendación agregada correctamente.');
    }

    public function edit($id)
    {
        // Encontrar la recomendación por su ID
        $recommendation = Recommendation::findOrFail($id);
        
        // Obtener todos los usuarios, especialistas y servicios
        $users = User::all();
        $specialists = Specialist::all();
        $services = Service::all();

        // Retornar la vista de edición con los datos de la recomendación
        return view('admin.recommendation.edit', compact('recommendation', 'users', 'specialists', 'services'));
    }

    public function update(Request $request, $id)
    {
        // Encontrar la recomendación por su ID
        $recommendation = Recommendation::findOrFail($id);

        // Validar los datos recibidos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialist_id' => 'required|exists:specialists,id',
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'service_id' => 'required|exists:services,id',
        ]);

        // Actualizar la recomendación con los nuevos datos
        $recommendation->update([
            'user_id' => $request->user_id,
            'specialist_id' => $request->specialist_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'service_id' => $request->service_id,
        ]);

        // Redireccionar a la página de administración de recomendaciones
        return redirect()->route('admin.recommendation.index')->with('success', 'Recomendación actualizada correctamente.');
    }

    public function getServices($specialistId)
    {
        // Obtener todos los servicios relacionados con el especialista seleccionado
        $services = Service::where('specialist_id', $specialistId)->get();
        return response()->json($services);
    }

    public function getServiceName($id)
    {
    // Encontrar el servicio por su ID
    $service = Service::findOrFail($id);
    
    // Retornar el nombre del servicio
    return response()->json($service->name);
    }

    public function destroy($id) {
        $recommendation = Recommendation::find($id);
    
        if (!$recommendation) {
            return redirect()->route('admin.recommendation.index')->with('error', 'Recomendacion no encontrada!');
        }
    
        if ($recommendation->delete()) {
            return redirect()->route('admin.recommendation.index')->with('success', 'Recomendacion eliminada correctamente!');
        } else {
            return redirect()->route('admin.recommendation.index')->with('error', '¡Ups! Algo salió mal al eliminar la especialidad. Por favor, inténtalo de nuevo.');
        }
    }
    

}
