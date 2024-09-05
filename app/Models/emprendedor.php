<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class emprendedor extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'lastname', 'fecha_nacimiento', 'password', 'telefono', 'imagen', 'correo', 'ubicacion', 'numero'
    ];

    public function inversionistas()
    {
        return $this->belongsToMany(Inversionista::class);
    }

    public function publicar_emprendimiento (){
        return $this->hasMany(publicar_emprendimiento::class);
    }
}
