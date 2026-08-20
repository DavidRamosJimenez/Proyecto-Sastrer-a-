<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

// Controlador principal: muestra la página de inicio con servicios activos
class HomeController extends Controller
{
    public function index()
    {
        $servicios = Servicio::where('activo', 1)->get();
        return view('home', compact('servicios'));
    }
}
