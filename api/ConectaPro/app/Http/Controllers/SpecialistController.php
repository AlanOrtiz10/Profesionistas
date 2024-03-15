<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SpecialistController as ApiSpecialistController;


class SpecialistController extends Controller
{
    public function index() 
    {
        $apiSpecialistController = new ApiSpecialistController();
        $specialists = $apiSpecialistController->list();
        return view('admin/specialist.index', compact('specialists'));
    }
}
