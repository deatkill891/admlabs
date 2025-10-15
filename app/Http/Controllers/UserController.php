<?php

namespace App\Http\Controllers;

// Imports necesarios para todas las funcionalidades del CRUD
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
    public function index()
    {
        // Obtiene todos los usuarios de la tabla 'users' usando el modelo
        $users = User::all();

        // Devuelve la vista y le pasa la variable $users
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos que vienen del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'puesto' => ['nullable', 'string', 'max:255'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. Crear el nuevo usuario si la validación pasa
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'puesto' => $request->puesto,
            'ubicacion' => $request->ubicacion,
        ]);

        // 3. Redirigir de vuelta a la página de usuarios con un mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(User $user)
    {
        // Gracias al Route Model Binding, Laravel ya nos entrega el objeto User.
        // Simplemente lo pasamos a la vista.
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Actualiza un usuario en la base de datos.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validar los datos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'puesto' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->puesto = $request->puesto;

        // Solo actualiza la contraseña si se proporcionó una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // Guarda los cambios

        // 3. Redirigir de vuelta a la lista con un mensaje
        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        // Medida de seguridad para evitar que un usuario se elimine a sí mismo.
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'No puedes eliminar a tu propio usuario.');
        }

        $user->delete();

        // Redirige de vuelta a la lista con un mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}