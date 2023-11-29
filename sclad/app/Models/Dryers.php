<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dryers extends Model
{
    protected $fillable = [
        'id',
        'dryers_name',
    ];
    use HasFactory;
    public function drying_materials()
    {
        return $this->hasMany(Drying_history::class,'id_dryers','id');
    }
}
