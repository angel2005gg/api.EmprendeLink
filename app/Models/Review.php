<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['qualification', 'comment','Entrepreneurship_id', 'investor_id', 'entrepreneur_id']; //Campos que se van a asignacion masiva:


    protected $allowIncluded = ['entrepreneur','Entrepreneurship', 'investor']; // Relación permitida para incluir.

    protected $allowFilter = ['qualification', 'comment','entrepreneur_id','Entrepreneurship_id', 'investor_id' ];
    protected $allowSort = ['id', 'name', 'lastname', 'correo','Entrepreneurship_id', 'investor_id','entrepreneur_id']; // Campos permitidos para ordenar.

    // // Relación muchos a muchos con Emprendedores
    public function entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class);
    }

    public function entrepreneurship()
{
    return $this->belongsTo(Entrepreneurship::class, 'Entrepreneurships_id'); // Asegúrate de que el nombre sea correcto
}


    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    // // Scope para incluir relaciones
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    // // Scope para filtrar resultados
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    // // Scope para ordenar resultados
    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    // // Scope para obtener todos los registros o paginarlos
    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}



