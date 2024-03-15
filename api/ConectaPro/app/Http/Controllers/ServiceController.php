<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ServiceController as ApiServiceController;


class ServiceController extends Controller
{ 

    public function index() 
    {
        $apiServiceController = new ApiServiceController();
        $services = $apiServiceController->list();
        return view('admin/service.index', compact('services'));
    }

}
