<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrepreneur extends Model
{
    use HasFactory;

    /**
     * Fillable fields for the model.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'lastname', 
        'birth_date', 
        'password', 
        'phone', 
        'image', 
        'email', 
        'location', 
        'number'
    ];

    /**
     * The entrepreneur belongs to many investors.
     */
    public function investors()
    {
        return $this->belongsToMany(Investor::class);
    }

    /**
     * An entrepreneur can have many published projects.
     */
    public function publishedProjects()
    {
        return $this->hasMany(PublishedProject::class);
    }
}
