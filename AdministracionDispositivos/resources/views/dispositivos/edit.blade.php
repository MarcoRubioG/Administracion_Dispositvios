<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Dispositivo</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('dispositivos.update', $dispositivo) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipo</label>
                            <select name="tipo" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="tablet" {{ old('tipo', $dispositivo->tipo) == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                <option value="telefono" {{ old('tipo', $dispositivo->tipo) == 'telefono' ? 'selected' : '' }}>Teléfono</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Marca</label>
                            <input type="text" name="marca" value="{{ old('marca', $dispositivo->marca) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Modelo</label>
                            <input type="text" name="modelo" value="{{ old('modelo', $dispositivo->modelo) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Número de Serie</label>
                            <input type="text" name="numero_serie" value="{{ old('numero_serie', $dispositivo->numero_serie) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">IMEI</label>
                            <input type="text" name="imei" value="{{ old('imei', $dispositivo->imei) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Estado</label>
                            <select name="estado" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="disponible" {{ old('estado', $dispositivo->estado) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="asignado" {{ old('estado', $dispositivo->estado) == 'asignado' ? 'selected' : '' }}>Asignado</option>
                                <option value="en_reparacion" {{ old('estado', $dispositivo->estado) == 'en_reparacion' ? 'selected' : '' }}>En Reparación</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Dispositivo
                            </button>
                            <a href="{{ route('dispositivos.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>