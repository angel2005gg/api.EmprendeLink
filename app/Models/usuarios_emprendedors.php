<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios_emprendedors extends Model
{
    use HasFactory;
// modelos de usuario emprendedor "User_enterprising" en el otro proyecto

public function inversionista(){
    return $this->belongsTo(Inversionista::class);
}

public function emprendedor (){
    return $this->belongsTo(Emprendedor::class);
}

    protected $fillable = ['inversionistas_id','emprendedors_id'];


}
