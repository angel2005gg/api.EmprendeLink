<?php

namespace App\Models;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crear_resenas extends Model
{
    use HasFactory;
    public function inversionista()
    {
        return $this->belongsTo(Inversionista::class);
    }


    public function emprendimiento()
    {
        return $this->belongsTo(Emprendimiento::class);
    }


    protected $fillable = ['qualification', 'comment'];

    // Lista blanca de relaciones permitidas para incluir en las consultas
    protected $allowIncluded = ['emprendimiento', 'inversionista'];
        protected $allowFilter = ['id', 'nombre_emprendimineto', 'descripcion', 'especificaciones', 'categoria','emprendedor_id'];
        // protected $allowSort = ['id', 'name', 'latname', 'Nacimineto', 'telefono','contraseña','correo ','ubicacion'];
    // Alcance personalizado para incluir relaciones en las consultas
    public function scopeIncluded( $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included')); // Separar las relaciones de la URL
        $allowIncluded = collect($this->allowIncluded); // Colección de relaciones permitidas

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]); // Eliminar relaciones no permitidas
            }
        }

        return $query->with($relations); // Incluir relaciones permitidas en la consulta
    }


       // http://api.Empredelink/api/cear_resena?included=emprendimiento
}
