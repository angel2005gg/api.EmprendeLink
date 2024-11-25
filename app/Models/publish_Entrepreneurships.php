<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class publish_Entrepreneurships extends Model
{
    use HasFactory;
    protected $table = "publish_Entrepreneurships" ;

    public function Entrepreneurships(){
        return $this->hasMany(Entrepreneurship::class);
    }

    public function entrepreneurs(){
        return $this->belongsTo(Entrepreneur::class);
    }


    //Campos que se van a asignacion masiva:

    protected $fillable = ['name','phone_number','email','description','location','url','expiration_date'];
    protected $allowIncluded = ['entrepreneurs'];//las posibles Querys que se pueden realizar

    protected $allowFilter = ['id', 'name','phone_number','email','description','location','url','expiration_date'];

    protected $allowSort = ['id', 'name','phone_number','email','description','location','url','expiration_date'];

    // Scope para incluir relaciones
    public function scopeIncluded(Builder $query)
    {

        if(empty($this->allowIncluded)||empty(request('included'))){
            // validamos que la lista blanca y la variable included enviada a travez de HTTP no este en vacia.
            return;
        }


        $relations = explode(',', request('included'));
         //['posts','relation2']//recuperamos el valor de la variable included y separa sus valores por una coma
         // return $relations;

        $allowIncluded = collect($this->allowIncluded);
         //colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']

        foreach ($relations as $key => $relationship) {
            //recorremos el array de relaciones

            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }
        $query->with($relations);
         //se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included

        //http://api.EmpredeLink/api/categories?included=posts


    }

    }




// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Builder;

// class publish_Entrepreneurships extends Model
// {
//     use HasFactory;
//     protected $table = "publish_Entrepreneurships";

//     public function Entrepreneurships()
//     {
//         return $this->hasMany(Entrepreneurship::class);
//     }

//     public function entrepreneurs()
//     {
//         return $this->belongsTo(Entrepreneur::class);
//     }

//     protected $fillable = ['name', 'phone_number', 'email', 'description', 'location', 'url', 'expiration_date'];
//     protected $allowIncluded = ['entrepreneurs'];
//     protected $allowFilter = ['id', 'name', 'phone_number', 'email', 'description', 'location', 'url', 'expiration_date'];
//     protected $allowSort = ['id', 'name', 'phone_number', 'email', 'description', 'location', 'url', 'expiration_date'];

//     // Scope para incluir relaciones
//     public function scopeIncluded(Builder $query)
//     {
//         if (empty($this->allowIncluded) || empty(request('included'))) {
//             return;
//         }

//         $relations = explode(',', request('included'));
//         $allowIncluded = collect($this->allowIncluded);

//         foreach ($relations as $key => $relationship) {
//             if (!$allowIncluded->contains($relationship)) {
//                 unset($relations[$key]);
//             }
//         }

//         $query->with($relations);
//     }

//     // Scope para filtrar resultados
//     public function scopeFilter(Builder $query)
//     {
//         // Recorre cada campo en allowFilter y verifica si hay un parámetro de consulta para él
//         foreach ($this->allowFilter as $filter) {
//             if (request()->has($filter)) {
//                 $query->where($filter, request($filter));
//             }
//         }
//     }
// }


