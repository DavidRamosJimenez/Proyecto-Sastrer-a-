<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Cita;
use App\Models\Servicio;
use App\Mail\CitaConfirmada;

// Controlador de citas: cliente agenda/cancela, admin gestiona estados
class CitaController extends Controller
{
    // Cliente ve sus propias citas (las más recientes primero)
    public function index()
    {
        $citas = Cita::where('usuario_id', session('usuario_id'))
            ->with('servicio')   // carga el nombre del servicio
            ->orderBy('fecha_cita', 'desc')
            ->get();

        return view('cliente.citas.index', compact('citas'));
    }

    // Formulario para agendar una cita con un servicio específico
    public function create($servicio_id)
    {
        $servicio = Servicio::findOrFail($servicio_id);
        return view('cliente.citas.create', compact('servicio'));
    }

    // Guarda la nueva cita con status 'pendiente' por defecto
    public function store(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'fecha_cita' => 'required|date|after:now',
            'notas' => 'nullable|string|max:500',
        ], [
            'servicio_id.required' => 'Servicio no válido.',
            'servicio_id.exists' => 'El servicio no existe.',
            'fecha_cita.required' => 'Elegí una fecha para la cita.',
            'fecha_cita.date' => 'La fecha no es válida.',
            'fecha_cita.after' => 'La fecha debe ser posterior a hoy.',
            'notas.max' => 'La nota puede tener máximo 500 caracteres.',
        ]);

        Cita::create([
            'usuario_id' => session('usuario_id'),
            'servicio_id' => $request->servicio_id,
            'fecha_cita' => $request->fecha_cita,
            'notas' => $request->notas,
        ]);

        return redirect()->route('cliente.citas.index')->with('exito', 'Cita agendada. Esperá confirmación.');
    }

    // Cliente cancela su propia cita (solo si está pendiente)
    public function cancel($id)
    {
        $cita = Cita::where('id', $id)
            ->where('usuario_id', session('usuario_id'))
            ->where('status', 'pendiente')
            ->firstOrFail();

        $cita->update(['status' => 'cancelada']);

        return redirect()->route('cliente.citas.index')->with('exito', 'Cita cancelada.');
    }

    // Página del carrito: muestra resumen de arreglos a reservar
    public function carrito()
    {
        return view('cliente.citas.carrito');
    }

    // Recibe el carrito JSON y crea una cita por cada servicio
    public function storeCarrito(Request $request)
    {
        $request->validate([
            'fecha_cita' => 'required|date|after:now',
            'carrito_json' => 'required|string',
            'notas' => 'nullable|string|max:500',
        ], [
            'fecha_cita.required' => 'Elegí una fecha para la cita.',
            'fecha_cita.date' => 'La fecha no es válida.',
            'fecha_cita.after' => 'La fecha debe ser posterior a hoy.',
            'carrito_json.required' => 'El carrito está vacío.',
        ]);

        // Decodifica el JSON del carrito
        $carrito = json_decode($request->carrito_json, true);

        if (!is_array($carrito) || count($carrito) === 0) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Crea una cita por cada servicio del carrito
        $cantidad = 0;
        foreach ($carrito as $item) {
            // Verifica que el servicio exista y esté activo
            $servicio = Servicio::where('id', $item['id'])->where('activo', 1)->first();
            if (!$servicio) {
                continue; // salta servicios inexistentes o inactivos
            }

            // Crea la cita con la cantidad en las notas si es > 1
            $notasExtra = ($item['cantidad'] > 1) ? "Cantidad: {$item['cantidad']} piezas. " : '';
            $notasFinales = $notasExtra . ($request->notas ?? '');

            Cita::create([
                'usuario_id' => session('usuario_id'),
                'servicio_id' => $servicio->id,
                'fecha_cita' => $request->fecha_cita,
                'notas' => $notasFinales,
            ]);

            $cantidad++;
        }

        // Limpia el carrito del localStorage después de reservar
        return redirect()->route('cliente.citas.index')
            ->with('exito', "Se reservaron {$cantidad} servicios. Esperá confirmación.");
    }

    // Admin ve todas las citas de todos los clientes
    public function adminIndex()
    {
        $citas = Cita::with(['usuario', 'servicio'])
            ->orderBy('fecha_cita', 'desc')
            ->get();

        return view('admin.citas.index', compact('citas'));
    }

    // Admin cambia el estado de una cita (confirmar, completar, cancelar)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmada,completada,cancelada',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update(['status' => $request->status]);

        // Si se confirma, envía correo de notificación al cliente
        if ($request->status === 'confirmada') {
            $cita->load(['usuario', 'servicio']);
            Mail::to($cita->usuario->email)->send(new CitaConfirmada($cita));
        }

        return redirect()->route('admin.citas.index')->with('exito', 'Estado de la cita actualizado.');
    }
}
