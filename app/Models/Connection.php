<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    


    use HasFactory;
    protected $primaryKey = 'id_connection';

    protected $fillable = ['chat', 'emprendedors_id', 'inversionistas_id'];
}
