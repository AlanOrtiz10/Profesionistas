<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index() 
    {
        return view('admin/specialist.index');
    }
}
