<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjetas principales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Usuarios -->
                <a href="{{ route('usuarios.index') }}" class="block">
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Usuarios</h3>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <p class="text-4xl font-semibold text-gray-900">{{ \App\Models\User::count() }}</p>
                    </div>
                </a>

                <!-- Dispositivos -->
                <a href="{{ route('dispositivos.index') }}" class="block">
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Dispositivos</h3>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-4xl font-semibold text-gray-900">{{ \App\Models\Device::count() }}</p>
                        <p class="text-sm text-gray-500 mt-2">
                            <span class="text-green-600 font-medium">{{ \App\Models\Device::where('estado', 'disponible')->count() }}</span> disponibles
                        </p>
                    </div>
                </a>

                <!-- Asignaciones -->
                <a href="{{ route('asignaciones.index') }}" class="block">
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-sm font-medium text-gray-500">Asignaciones Activas</h3>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <p class="text-4xl font-semibold text-gray-900">{{ \App\Models\DeviceAssignment::whereNull('fecha_devolucion')->count() }}</p>
                    </div>
                </a>

            </div>

            <!-- Tabla de estado de dispositivos -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Estado de Dispositivos</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $total = \App\Models\Device::count();
                                $disponibles = \App\Models\Device::where('estado', 'disponible')->count();
                                $asignados = \App\Models\Device::where('estado', 'asignado')->count();
                                $reparacion = \App\Models\Device::where('estado', 'en_reparacion')->count();
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                                        <span class="text-sm text-gray-900">Disponibles</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $disponibles }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $total > 0 ? round(($disponibles / $total) * 100) : 0 }}%
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="h-2 w-2 rounded-full bg-blue-500 mr-2"></span>
                                        <span class="text-sm text-gray-900">Asignados</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $asignados }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $total > 0 ? round(($asignados / $total) * 100) : 0 }}%
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="h-2 w-2 rounded-full bg-orange-500 mr-2"></span>
                                        <span class="text-sm text-gray-900">En Reparación</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reparacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $total > 0 ? round(($reparacion / $total) * 100) : 0 }}%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>