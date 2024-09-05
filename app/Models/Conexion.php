<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conexion extends Model
{
    


    use HasFactory;
    protected $primaryKey = 'id_conexion';

    protected $fillable = ['chat', 'emprendedors_id', 'inversionistas_id'];
}
