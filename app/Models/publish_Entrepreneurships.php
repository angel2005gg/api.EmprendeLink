<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publish_Entrepreneurships extends Model
{
    use HasFactory;

    protected $table = "publish_Entrepreneurships";

    // Campos que se van a asignación masiva:
    protected $fillable = [
        'name',
        'slogan',
        'category',
        'general_description',
        'logo_path',
        'background',
        'name_products',
        'product_images',
        'product_descriptions',
        'entrepreneurs_id'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'entrepreneurs_id');
}

    // Mutadores para asegurar que product_images, product_descriptions y name_products se guarden como string
    public function setProductImagesAttribute($value)
    {
        $this->attributes['product_images'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setProductDescriptionsAttribute($value)
    {
        $this->attributes['product_descriptions'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setNameProductsAttribute($value)
    {
        $this->attributes['name_products'] = is_array($value) ? json_encode($value) : $value;
    }

    // Métodos para acceder a los campos JSON como arrays
    public function getProductImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getProductDescriptionsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getNameProductsAttribute($value)
    {
        return json_decode($value, true);
    }
}
