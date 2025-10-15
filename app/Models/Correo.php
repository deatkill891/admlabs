<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'CatCorreosADM'; // Apunta a tu tabla existente

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // Define los campos del formulario
        'nombre',
        'correo',
        'planta',
        'estatus',
    ];
}