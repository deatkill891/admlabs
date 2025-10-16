<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatTipoUsuario extends Model
{
    use HasFactory;
    protected $table = 'CatTipoUsuarios';
    protected $primaryKey = 'idTipoUsuario'; // <-- AÑADE ESTA LÍNEA
}