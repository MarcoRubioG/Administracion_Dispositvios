<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    
    public function index()
    {
        $dispositivos = Device::latest()->paginate(10);
        return view('dispositivos.index', compact('dispositivos'));
    }

   
    public function create()
    {
        return view('dispositivos.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:tablet,telefono',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:devices,numero_serie',
            'imei' => 'nullable|string|unique:devices,imei',
            'estado' => 'required|in:disponible,asignado,en_reparacion',
        ]);

        Device::create($request->all());

        return redirect()->route('dispositivos.index')->with('success', 'Dispositivo creado exitosamente');
    }

    public function edit(Device $dispositivo)
    {
        return view('dispositivos.edit', compact('dispositivo'));
    }

   
    public function update(Request $request, Device $dispositivo)
    {
        $request->validate([
            'tipo' => 'required|in:tablet,telefono',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:devices,numero_serie,' . $dispositivo->id,
            'imei' => 'nullable|string|unique:devices,imei,' . $dispositivo->id,
            'estado' => 'required|in:disponible,asignado,en_reparacion',
        ]);

        $dispositivo->update($request->all());

        return redirect()->route('dispositivos.index')->with('success', 'Dispositivo actualizado exitosamente');
    }

    
    public function updateEstado(Request $request, Device $dispositivo)
    {
        $request->validate([
            'estado' => 'required|in:disponible,asignado,en_reparacion',
        ]);

        $dispositivo->update(['estado' => $request->estado]);

        return redirect()->route('dispositivos.index')->with('success', 'Estado actualizado exitosamente');
    }

    
    public function destroy(Device $dispositivo)
    {
        $dispositivo->delete();
        return redirect()->route('dispositivos.index')->with('success', 'Dispositivo eliminado exitosamente');
    }
}