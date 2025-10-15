<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Muestra la lista de permisos.
     */
    public function index()
    {
        // 1. Usa el modelo de Spatie para obtener todos los permisos.
        $permissions = Permission::all();

        // 2. Devuelve la vista (que crearemos a continuación) y le pasa los datos.
        return view('admin.permissions.index', [
            'permissions' => $permissions
        ]);
    }
    /**
 * Guarda un nuevo permiso en la base de datos.
 */
public function store(Request $request)
{
    // 1. Validar que el nombre del permiso sea único y requerido.
    $validated = $request->validate([
        'name' => 'required|unique:permissions,name'
    ]);

    // 2. Crear el permiso usando el modelo de Spatie.
    Permission::create($validated);

    // 3. Redirigir de vuelta con un mensaje de éxito.
    return redirect()->route('admin.permissions.index')->with('success', 'Permiso creado exitosamente.');
}
}