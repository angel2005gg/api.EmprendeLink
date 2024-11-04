<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connection extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_connection';
    protected $fillable = ['chat', 'entrepreneurs_id', 'investors_id'];
    protected $table = 'connections';

    // Define los campos que se pueden incluir en las relaciones
    protected $allowIncluded = ['entrepreneur', 'investor'];

    // Define los campos por los que se puede ordenar
    protected $allowSort = ['id_connection', 'chat', 'entrepreneurs_id', 'investors_id'];

    // Define los campos por los que se puede filtrar
    protected $allowFilter = ['chat', 'entrepreneurs_id', 'investors_id'];

    /**
     * Relación con el modelo Entrepreneur
     */
    public function entrepreneur(): BelongsTo
    {
        return $this->belongsTo(Entrepreneur::class, 'entrepreneurs_id');
    }

    /**
     * Relación con el modelo Investor
     */
    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class, 'investors_id');
    }

    /**
     * Scope para incluir relaciones
     */
    public function scopeIncluded(Builder $query)
    {
        if(empty($this->allowIncluded) || empty(request('included'))) {
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

    /**
     * Scope para ordenar resultados
     */
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

    /**
     * Scope para filtrar resultados
     */
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

    /**
     * Scope para obtener todos los registros o paginarlos
     */
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
