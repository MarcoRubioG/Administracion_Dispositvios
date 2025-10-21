<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $usuarios = User::latest()->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    
    public function create()
    {
        return view('usuarios.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

   
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

    
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente');
    }
}