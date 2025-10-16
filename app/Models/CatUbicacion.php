<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatUbicacion extends Model
{
    use HasFactory;
    protected $table = 'CatUbicaciones';
    protected $primaryKey = 'idUbicacion'; // <-- AÑADE ESTA LÍNEA
}