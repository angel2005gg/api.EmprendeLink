<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrepreneursLists extends Model
{
    use HasFactory;

    protected $fillable = ['investors_id', 'entrepreneurs_id'];

    public function investor(){
        return $this->belongsTo(investor::class);
    }

    public function entrepreneur(){
        return $this->belongsTo(Entrepreneur::class);
    }

}
