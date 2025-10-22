<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nueva Asignación</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('asignaciones.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Usuario</label>
                            <select name="user_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('user_id') border-red-500 @enderror" required>
                                <option value="">Seleccione un usuario...</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->name }} ({{ $usuario->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Dispositivo Disponible</label>
                            <select name="device_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('device_id') border-red-500 @enderror" required>
                                <option value="">Seleccione un dispositivo...</option>
                                @foreach($dispositivos as $dispositivo)
                                    <option value="{{ $dispositivo->id }}" {{ old('device_id') == $dispositivo->id ? 'selected' : '' }}>
                                        {{ ucfirst($dispositivo->tipo) }} - {{ $dispositivo->marca }} {{ $dispositivo->modelo }} (S/N: {{ $dispositivo->numero_serie }})
                                    </option>
                                @endforeach
                            </select>
                            @error('device_id')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Fecha de Asignación</label>
                            <input type="date" name="fecha_asignacion" value="{{ old('fecha_asignacion', date('Y-m-d')) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('fecha_asignacion') border-red-500 @enderror" required>
                            @error('fecha_asignacion')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Observaciones</label>
                            <textarea name="observaciones" rows="3" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('observaciones') }}</textarea>
                        </div>

                         <div class="flex items-center justify-between mt-6">
                             <button type="submit" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                 Crear Asignación
                             </button>
                             <a href="{{ route('asignaciones.index') }}" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                 Cancelar
                             </a>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>