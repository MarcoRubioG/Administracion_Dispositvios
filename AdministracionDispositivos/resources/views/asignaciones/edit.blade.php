<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Asignación</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('asignaciones.update', $asignacione) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Usuario</label>
                            <input type="text" value="{{ $asignacione->user->name }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Dispositivo</label>
                            <input type="text" value="{{ $asignacione->device->marca }} {{ $asignacione->device->modelo }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Asignación</label>
                            <input type="text" value="{{ $asignacione->fecha_asignacion->format('d/m/Y') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-gray-100" disabled>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Devolución</label>
                            <input type="date" name="fecha_devolucion" value="{{ old('fecha_devolucion', $asignacione->fecha_devolucion?->format('Y-m-d')) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                            <p class="text-gray-600 text-xs mt-1">Ingrese fecha para marcar la devolución del dispositivo</p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Observaciones</label>
                            <textarea name="observaciones" rows="3" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('observaciones', $asignacione->observaciones) }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Asignación
                            </button>
                            <a href="{{ route('asignaciones.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>