<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\SpecialityController as ApiSpecialityController;


class SpecialityController extends Controller
{
    public function index() 
    {
        $apiSpecialityController = new ApiSpecialityController();
        $specialities = $apiSpecialityController->list();
        return view('admin/speciality.index', compact('specialities'));
    }
}
