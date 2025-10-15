<?php

namespace App\Http\Controllers;

use App\Models\Correo;      // Importa el modelo que creamos
use Illuminate\Http\Request;

class CorreoController extends Controller
{
    /**
     * Muestra la lista de correos.
     */
    public function index()
    {
        // Obtiene todos los registros de la tabla 'CatCorreosADM'
        $correos = Correo::all();

        // Devuelve la vista 'index' dentro de la carpeta 'admin/mails'
        // y le pasa la variable $correos.
        return view('admin.mails.index', [
            'correos' => $correos
        ]);
    }

    // Dejaremos espacio aquí para los futuros métodos store, edit, update y destroy.
}