<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatMaterial extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'CatMateriales'; // <-- Agrega esta línea

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // <-- Agrega este arreglo
        'nombre', // Asumo que tienes una columna 'nombre'
        'estatus', // Y una columna 'estatus'
        // Agrega aquí otras columnas que quieras poder llenar desde un formulario
    ];
}