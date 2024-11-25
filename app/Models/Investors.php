<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investors extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'lastname', 'birth_date', 'investment_number', 'password',
        'document', 'phone', 'image', 'email', 'location'
    ];
    protected $allowIncluded = [ 'entrepreneursLists', 'entrepreneurs' ];
    protected $allowFilter = ['id', 'name', 'lastname', 'birth_date', 'investment_number', 'password', 'document', 'phone', 'image', 'email', 'location'];
    protected $allowSort = ['id', 'name', 'lastname', 'birth_date', 'investment_number', 'password', 'document', 'phone', 'image', 'email', 'location'];

    public function entrepreneursLists():HasMany
    {
        return $this->hasMany(EntrepreneursList::class);
    }


    public function resenas()
    {
        return $this->hasMany(Review::class);
    }

    public function inversionistas()
    {
        return $this->belongsToMany(Investors::class);
    }



      public function entrepreneurs()
      {
          return $this->belongsToMany(Entrepreneur::class, 'connections', 'investors_id', 'entrepreneurs_id')
                      ->withPivot('chat') // Incluye el campo 'chat' de la tabla intermedia
                      ->withTimestamps(); // Incluye las marcas de tiempo
      }
    public function scopeIncluded(Builder $query): void
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

    // Scope para filtrar resultados
    public function scopeFilter(Builder $query): void
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

    // Scope para ordenar resultados
    public function scopeSort(Builder $query): void
    {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            if (substr($sortField, 0, 1) === '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    // Scope para obtener o paginar resultados
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
