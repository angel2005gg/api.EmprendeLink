<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Myentrepreneurship extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'entrepreneur_id', 'publish_Entrepreneurships_id', 'investor_id', 'Review_id'
    ];

    protected $allowIncluded = [
        'entrepreneur', 'publish_Entrepreneurships', 'investor', 'Review',
    ];

    protected $allowFilter = ['id', 'entrepreneur_id', 'publish_Entrepreneurships_id', 'investor_id', 'Review_id'];

    protected $allowSort = ['id', 'entrepreneur_id', 'publish_Entrepreneurships_id', 'investor_id', 'Review_id'];

    // Relaciones

    public function entrepreneur()
    {
        return $this->belongsTo(Entrepreneur::class);
    }

    public function publish_Entrepreneurships()
    {
        return $this->belongsTo(Publish_Entrepreneurships::class, 'publish_Entrepreneurships_id');
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

   public function Review()
{
    return $this->belongsTo(Review::class, 'Review_id', 'id');
}


// In Myentrepreneurship model
// public function publish_Entrepreneurships()
// {
//     return $this->belongsTo(Publish_Entrepreneurships::class, 'publish_Entrepreneurships_id', 'id');
// }

// public function review()
// {
//     return $this->belongsTo(Review::class, 'review_id', 'id');
// }


    // Scope para incluir relaciones
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

    // Scope para filtrar resultados
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

    // Scope para ordenar resultados
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

    // Scope para obtener todos los registros o paginarlos
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
