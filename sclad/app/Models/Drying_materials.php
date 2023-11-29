<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drying_materials extends Model
{
    protected $fillable = [
        'history_id',
        'raw_materials_id',
        'amount',
    ];
    use HasFactory;
    public function history()
    {
//        return $this->belongsToMany(Drying_history::class,'drying_histories','raw_materials_id','id_history');

        return $this->hasMany(Drying_materials::class,'id_history');
    }
    public function materials()
    {
        return $this->hasMany(Materials::class,'id');
    }
}
