<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class investor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname', 'birth_date','investment_number', 'password',
        'document', 'phone', 'image','email','location'
    ];
     // Campos para asignación masiva.
     protected $allowIncluded = ['emprendedors']; // Relación permitida para incluir.
     protected $allowFilter = ['id', 'name', 'lastname', 'birth_date', 'investor_number', 'password', 'identity_document', 'investor_phone', 'profile_image', 'email', 'location']; // Campos permitidos para filtrar.
     protected $allowSort = ['id', 'name', 'lastname', 'birth_date', 'investor_number', 'password', 'identity_document', 'investor_phone', 'profile_image', 'email', 'location']; // Campos permitidos para ordenar.

    // // Relación muchos a muchos con Emprendedores


    
    public function entrepreneursLists(){
        return $this->hasMany(entrepreneursLists::class);
    }

    public function resenas(){
        return $this->hasMany(Resena::class);
    }

    // public function usuario_inversionistas (){
    //     return $this->hasMany(Usuario_inversionista::class);
    // }

   
    public function inversionistas(){
        return $this->belongsToMany(investor::class);
    }







    // public function emprendedors()
    // {
    //     return $this->belongsToMany(Emprendedor::class);
    // }

    // // Scope para incluir relaciones
    // public function scopeIncluded(Builder $query)
    // {
    //     if (empty($this->allowIncluded) || empty(request('included'))) {
    //         return;
    //     }

    //     $relations = explode(',', request('included'));
    //     $allowIncluded = collect($this->allowIncluded);

    //     foreach ($relations as $key => $relationship) {
    //         if (!$allowIncluded->contains($relationship)) {
    //             unset($relations[$key]);
    //         }
    //     }

    //     $query->with($relations);
    // }

    // // Scope para filtrar resultados
    // public function scopeFilter(Builder $query)
    // {
    //     if (empty($this->allowFilter) || empty(request('filter'))) {
    //         return;
    //     }

    //     $filters = request('filter');
    //     $allowFilter = collect($this->allowFilter);

    //     foreach ($filters as $filter => $value) {
    //         if ($allowFilter->contains($filter)) {
    //             $query->where($filter, 'LIKE', '%' . $value . '%');
    //         }
    //     }
    // }

    // // Scope para ordenar resultados
    // public function scopeSort(Builder $query)
    // {
    //     if (empty($this->allowSort) || empty(request('sort'))) {
    //         return;
    //     }

    //     $sortFields = explode(',', request('sort'));
    //     $allowSort = collect($this->allowSort);

    //     foreach ($sortFields as $sortField) {
    //         $direction = 'asc';

    //         if (substr($sortField, 0, 1) == '-') {
    //             $direction = 'desc';
    //             $sortField = substr($sortField, 1);
    //         }

    //         if ($allowSort->contains($sortField)) {
    //             $query->orderBy($sortField, $direction);
    //         }
    //     }
    // }

    // // Scope para obtener todos los registros o paginarlos
    // public function scopeGetOrPaginate(Builder $query)
    // {
    //     if (request('perPage')) {
    //         $perPage = intval(request('perPage'));

    //         if ($perPage) {
    //             return $query->paginate($perPage);
    //         }
    //     }

    //     return $query->get();
    // }
}
