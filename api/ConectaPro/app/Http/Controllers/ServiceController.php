<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ServiceController as ApiServiceController;
use App\Models\Service;
use App\Models\Category;
use App\Models\Specialist;

class ServiceController extends Controller
{ 

    public function index() 
    {
        $apiServiceController = new ApiServiceController();
        $services = $apiServiceController->list();
        $categories = Category::all();
        $specialists = Specialist::with('user')->get();
        
        return view('admin.service.index', compact('services', 'categories', 'specialists'));
    }

    public function create(Request $request) 
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|image',
            'availability' => 'required|string',
            'user_id' => 'required|integer', // Asegúrate de que el campo user_id esté presente en el formulario
            'specialist_id' => 'required|integer',
        ]);
    
        $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('assets/services'), $imageName);
    
        $service = Service::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'image' => $imageName,
            'availability' => $data['availability'],
            'user_id' => $data['user_id'],
            'specialist_id' => $data['specialist_id'],
        ]);
    
        if ($service) {
            $object = [
                "response" => 'Success. Item saved correctly.',
                "data" => $service,
            ];
            return response()->json($object);
        } else {
            $object = [
                "response" => 'Error: Something went wrong, please try again.'
            ];
            return response()->json($object);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|image',
            'availability' => 'required|string',
            'specialist_id' => 'required|integer',
        ]);

        $imageName = uniqid() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('assets/services'), $imageName);

        $service = new Service();
        $service->name = $data['name'];
        $service->description = $data['description'];
        $service->category_id = $data['category_id'];
        $service->image = $imageName;
        $service->availability = $data['availability'];
        $service->specialist_id = $data['specialist_id'];
        $service->user_id = $data['specialist_id']; // Asignar el mismo valor que specialist_id al user_id

        $service->save();

        return redirect()->route('admin.service.index')->with('success', '¡El servicio se ha creado correctamente!');
    }
}
