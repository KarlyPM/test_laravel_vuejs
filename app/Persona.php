<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Persona extends Authenticatable
{
    use HasApiTokens;
    
    protected $fillable = [
        'nombre','apellidos','cedula','celular','ciudad'
    ];

}
