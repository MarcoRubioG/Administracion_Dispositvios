<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestión de Asignaciones</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Lista de Asignaciones</h3>
                        <a href="{{ route('asignaciones.create') }}" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                            Nueva Asignación
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Usuario</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Dispositivo</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Fecha Asignación</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Fecha Devolución</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($asignaciones as $asignacion)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b">{{ $asignacion->user->name }}</td>
                                        <td class="px-6 py-4 border-b">{{ $asignacion->device->marca }} {{ $asignacion->device->modelo }}</td>
                                        <td class="px-6 py-4 border-b">{{ $asignacion->fecha_asignacion->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 border-b">
                                            @if($asignacion->fecha_devolucion)
                                                {{ $asignacion->fecha_devolucion->format('d/m/Y') }}
                                            @else
                                                <span class="text-green-600 font-semibold">Activa</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            <a href="{{ route('asignaciones.cartaPoder', $asignacion) }}" class="text-purple-600 hover:text-purple-900 mr-3">Carta Poder</a>
                                            <a href="{{ route('asignaciones.edit', $asignacion) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                            <form action="{{ route('asignaciones.destroy', $asignacion) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay asignaciones registradas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $asignaciones->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>