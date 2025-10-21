<?php

namespace App\Http\Controllers;

use App\Models\DeviceAssignment;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\SimpleQrCode\Facades\QrCode as QrCodeFacade;
use Barryvdh\DomPDF\Facade\Pdf;

class DeviceAssignmentController extends Controller
{
    // Listar asignaciones
    public function index()
    {
        $asignaciones = DeviceAssignment::with(['user', 'device'])->latest()->paginate(10);
        return view('asignaciones.index', compact('asignaciones'));
    }

    // Mostrar formulario de crear
    public function create()
    {
        $usuarios = User::all();
        $dispositivos = Device::where('estado', 'disponible')->get();
        return view('asignaciones.create', compact('usuarios', 'dispositivos'));
    }

    // Guardar nueva asignación
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'fecha_asignacion' => 'required|date',
            'observaciones' => 'nullable|string',
        ]);

        // Crear asignación
        DeviceAssignment::create($request->all());

        // Actualizar estado del dispositivo a "asignado"
        Device::find($request->device_id)->update(['estado' => 'asignado']);

        return redirect()->route('asignaciones.index')->with('success', 'Asignación creada exitosamente');
    }

    // Mostrar formulario de editar
    public function edit(DeviceAssignment $asignacione)
    {
        $usuarios = User::all();
        $dispositivos = Device::all();
        return view('asignaciones.edit', compact('asignacione', 'usuarios', 'dispositivos'));
    }

    // Actualizar asignación
    public function update(Request $request, DeviceAssignment $asignacione)
    {
        $request->validate([
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_asignacion',
            'observaciones' => 'nullable|string',
        ]);

        $asignacione->update($request->all());

        // Si hay fecha de devolución, cambiar estado del dispositivo a disponible
        if ($request->filled('fecha_devolucion')) {
            $asignacione->device->update(['estado' => 'disponible']);
        }

        return redirect()->route('asignaciones.index')->with('success', 'Asignación actualizada exitosamente');
    }

    // Eliminar asignación
    public function destroy(DeviceAssignment $asignacione)
    {
        // Cambiar estado del dispositivo a disponible
        $asignacione->device->update(['estado' => 'disponible']);
        
        $asignacione->delete();
        return redirect()->route('asignaciones.index')->with('success', 'Asignación eliminada exitosamente');
    }

    // Generar carta poder con PDF y QR
    public function generarCartaPoder(DeviceAssignment $assignment)
    {
        // Cargar relaciones
        $assignment->load(['user', 'device']);
        
        // Generar código QR con información de la asignación
        $qrData = "Asignación ID: {$assignment->id}\n";
        $qrData .= "Usuario: {$assignment->user->name}\n";
        $qrData .= "Dispositivo: {$assignment->device->marca} {$assignment->device->modelo}\n";
        $qrData .= "Serie: {$assignment->device->numero_serie}\n";
        $qrData .= "Fecha: {$assignment->fecha_asignacion->format('d/m/Y')}";
        
        $qrCode = base64_encode(\QrCode::format('svg')->size(200)->generate($qrData));
        
        // Generar PDF
        $pdf = Pdf::loadView('asignaciones.carta-poder', compact('assignment', 'qrCode'));
        
        return $pdf->download('carta-poder-' . $assignment->id . '.pdf');
    }
}