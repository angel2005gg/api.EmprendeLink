<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios_invercionistas extends Model
{
    use HasFactory;
    // protected $primaryKey = "id_usuario_invercionistas";

    // modelos usuarios_invercioinistas " User_inverstor" en el otro proyecto

    public function emprendedor (){
        return $this->belongsTo(Emprendedor::class);
    }

    public function emprendimieto (){
        return $this->belongsTo(Emprendimiento::class);
    }






    protected $fillable = ['inversionistas_id','emprendedors_id'];
}
