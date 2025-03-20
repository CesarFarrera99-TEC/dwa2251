<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $fillable = ['nombre','nombre_usuario', 'clave', 'tipo'];
}
