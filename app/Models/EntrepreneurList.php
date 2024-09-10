<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepreneurList extends Model
{
    use HasFactory;

    // Entrepreneur user models "User_enterprising" in the other project

    public function investor(){
        return $this->belongsTo(Inversionista::class);
    }

    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }

    protected $fillable = ['investors_id', 'entrepreneurs_id'];
}
