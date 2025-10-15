<?php

namespace App\Http\Controllers;

use App\Models\CatMaterial; // Importa el modelo
use Illuminate\Http\Request;  // Importa la clase Request
use Illuminate\Validation\Rule; // Importa la clase Rule para validaciones avanzadas

class MaterialController extends Controller
{
    /**
     * Muestra la lista de materiales.
     */
    public function index()
    {
        // Usa el modelo 'CatMaterial' para obtener todos los registros de la tabla.
        $materiales = CatMaterial::all();

        // Devuelve una vista y le pasa los datos.
        return view('admin.materials.index', [
            'materials' => $materiales
        ]);
    }

    /**
     * Guarda un nuevo material en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos que vienen del formulario.
        $request->validate([
            'nombre' => 'required|string|max:255|unique:CatMateriales,nombre',
            'estatus' => 'required|boolean',
        ]);

        // 2. Crear el nuevo material usando el modelo y los datos validados.
        CatMaterial::create([
            'nombre' => $request->nombre,
            'estatus' => $request->estatus,
        ]);

        // 3. Redirigir de vuelta a la lista de materiales con un mensaje de éxito.
        return redirect()->route('admin.materials.index')->with('success', 'Material creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un material existente.
     * @param CatMaterial $material Gracias al Route Model Binding, Laravel inyecta el modelo automáticamente.
     */
    public function edit(CatMaterial $material)
    {
        // Pasamos el material encontrado a una nueva vista de edición.
        return view('admin.materials.edit', [
            'material' => $material
        ]);
    }

    /**
     * Actualiza un material en la base de datos.
     */
    public function update(Request $request, CatMaterial $material)
    {
        // 1. Validar los datos.
        $request->validate([
            // La regla 'unique' debe ignorar el registro actual que estamos editando.
            'nombre' => ['required', 'string', 'max:255', Rule::unique('CatMateriales')->ignore($material->id)],
            'estatus' => 'required|boolean',
        ]);

        // 2. Actualizar los datos del material.
        $material->update([
            'nombre' => $request->nombre,
            'estatus' => $request->estatus,
        ]);

        // 3. Redirigir de vuelta a la lista con un mensaje de éxito.
        return redirect()->route('admin.materials.index')->with('success', 'Material actualizado exitosamente.');
    }

    /**
    * Elimina un material de la base de datos.
    */
    public function destroy(CatMaterial $material)
    {
    // Usa el método delete() del modelo para eliminar el registro.
    $material->delete();

    // Redirige de vuelta a la lista con un mensaje de éxito.
    return redirect()->route('admin.materials.index')->with('success', 'Material eliminado exitosamente.');
}

}