<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

// Controlador de servicios: catálogo público + CRUD admin
class ServicioController extends Controller
{
    // Catálogo público: muestra solo servicios activos
    public function index()
    {
        $servicios = Servicio::where('activo', 1)->get();
        return view('servicios.index', compact('servicios'));
    }

    // Panel admin: muestra todos los servicios (activos e inactivos)
    public function adminIndex()
    {
        $servicios = Servicio::all();
        return view('admin.servicios.index', compact('servicios'));
    }

    // Formulario para crear un nuevo servicio (solo admin)
    public function create()
    {
        return view('admin.servicios.create');
    }

    // Guarda un nuevo servicio en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tipo' => 'required|in:confeccion,arreglo',
        ], [
            'nombre.required' => 'Escribí el nombre del servicio.',
            'precio.required' => 'Escribí el precio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'tipo.required' => 'Elegí el tipo de servicio.',
        ]);

        Servicio::create($request->only('nombre', 'descripcion', 'precio', 'tipo'));

        return redirect()->route('admin.servicios.index')->with('exito', 'Servicio creado.');
    }

    // Formulario para editar un servicio existente
    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('admin.servicios.edit', compact('servicio'));
    }

    // Actualiza los datos de un servicio
    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tipo' => 'required|in:confeccion,arreglo',
        ], [
            'nombre.required' => 'Escribí el nombre del servicio.',
            'precio.required' => 'Escribí el precio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'tipo.required' => 'Elegí el tipo de servicio.',
        ]);

        $servicio->update($request->only('nombre', 'descripcion', 'precio', 'tipo'));

        return redirect()->route('admin.servicios.index')->with('exito', 'Servicio actualizado.');
    }

    // Desactiva un servicio (no lo borra, solo lo oculta)
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->update(['activo' => 0]);

        return redirect()->route('admin.servicios.index')->with('exito', 'Servicio desactivado.');
    }
}
