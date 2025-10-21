<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Lista de Usuarios</h3>
                        <a href="{{ route('usuarios.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Nuevo Usuario
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
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">ID</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Nombre</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-700 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($usuarios as $usuario)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b">{{ $usuario->id }}</td>
                                        <td class="px-6 py-4 border-b">{{ $usuario->name }}</td>
                                        <td class="px-6 py-4 border-b">{{ $usuario->email }}</td>
                                        <td class="px-6 py-4 border-b">
                                            <a href="{{ route('usuarios.edit', $usuario) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay usuarios registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $usuarios->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>