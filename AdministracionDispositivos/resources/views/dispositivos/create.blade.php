<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Nuevo Dispositivo</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('dispositivos.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipo</label>
                            <select name="tipo" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('tipo') border-red-500 @enderror" required>
                                <option value="">Seleccione...</option>
                                <option value="tablet" {{ old('tipo') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                <option value="telefono" {{ old('tipo') == 'telefono' ? 'selected' : '' }}>Teléfono</option>
                            </select>
                            @error('tipo')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Marca</label>
                            <input type="text" name="marca" value="{{ old('marca') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('marca') border-red-500 @enderror" required>
                            @error('marca')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Modelo</label>
                            <input type="text" name="modelo" value="{{ old('modelo') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('modelo') border-red-500 @enderror" required>
                            @error('modelo')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Número de Serie</label>
                            <input type="text" name="numero_serie" value="{{ old('numero_serie') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('numero_serie') border-red-500 @enderror" required>
                            @error('numero_serie')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">IMEI (opcional)</label>
                            <input type="text" name="imei" value="{{ old('imei') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('imei') border-red-500 @enderror">
                            @error('imei')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Estado</label>
                            <select name="estado" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="disponible" selected>Disponible</option>
                                <option value="asignado">Asignado</option>
                                <option value="en_reparacion">En Reparación</option>
                            </select>
                        </div>

                            <div class="flex items-center justify-between mt-6">
                                <button type="submit" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                    Crear Dispositivo
                                </button>
                                <a href="{{ route('dispositivos.index') }}" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                    Cancelar
                                </a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>