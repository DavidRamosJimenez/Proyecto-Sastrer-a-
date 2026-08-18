<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    protected $servicios = [
        'Confección de Traje Masculino - Bs 600',
        'Confección de Traje Femenino - Bs 600',
        'Arreglo (depende el arreglo varía el precio) - Bs 15',
    ];

    public function index()
    {
        return view('sastreria.index');
    }

    public function procesar(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'mensaje' => 'required|string',
        ], [
            'nombre.required' => 'Completa tu nombre.',
            'correo.required' => 'Completa tu correo.',
            'correo.email' => 'Ese correo está mal escrito.',
            'mensaje.required' => 'Completa tu mensaje.',
        ]);

        return view('sastreria.resultado', [
            'datos' => $datos,
            'servicios' => $this->servicios,
        ]);
    }
}
