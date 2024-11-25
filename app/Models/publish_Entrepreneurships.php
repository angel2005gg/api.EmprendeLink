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

    public function Myentrepreneurships(){
        return $this->hasMany(Myentrepreneurship::class);
    }

    public function entrepreneurs(){
        return $this->belongsTo(Entrepreneur::class);
    }


    //Campos que se van a asignacion masiva:

       // Campos para asignación masiva
       protected $fillable = [
        'name',
        'phone_number',
        'email',
        'description',
        'location',
        'url',
        'category',
        'expiration_date',
        'specifications',
        'general_description',
        'logo_path',
        'cover_path',
        'product_images',
        'product_descriptions',
        'entrepreneurs_id'
    ];

    // Relaciones permitidas para incluir en queries
    protected $allowIncluded = [
        'entrepreneurs',
        'Entrepreneurships',
        'Myentrepreneurship'
    ];

    // Campos permitidos para filtrar
    protected $allowFilter = [
        'id', 
        'name',
        'phone_number',
        'email',
        'description',
        'location',
        'url',
        'category',
        'expiration_date',
        'specifications',
        'general_description'
    ];

    // Campos permitidos para ordenar
    protected $allowSort = [
        'id', 
        'name',
        'phone_number',
        'email',
        'description',
        'location',
        'url',
        'category',
        'expiration_date'
    ];
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

    // Mutador para asegurar que product_images se guarde como JSON
    public function setProductImagesAttribute($value)
    {
        $this->attributes['product_images'] = is_array($value) ? json_encode($value) : $value;
    }

    // Mutador para asegurar que product_descriptions se guarde como JSON
    public function setProductDescriptionsAttribute($value)
    {
        $this->attributes['product_descriptions'] = is_array($value) ? json_encode($value) : $value;
    }

    // Accesor para obtener product_images como array
    public function getProductImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    // Accesor para obtener product_descriptions como array
    public function getProductDescriptionsAttribute($value)
    {
        return json_decode($value, true);
    }

    // Scope para filtrar por categoría
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope para obtener emprendimientos activos (no expirados)
    public function scopeActive($query)
    {
        return $query->where('expiration_date', '>', now());
    }

    // Método para obtener la URL completa del logo
    public function getLogoUrlAttribute()
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    // Método para obtener la URL completa de la portada
    public function getCoverUrlAttribute()
    {
        return $this->cover_path ? asset('storage/' . $this->cover_path) : null;
    }

    // Método para obtener las URLs completas de las imágenes de productos
    public function getProductImageUrlsAttribute()
    {
        if (!$this->product_images) return [];
        
        return collect($this->product_images)->map(function($path) {
            return asset('storage/' . $path);
        })->toArray();
    }
}
