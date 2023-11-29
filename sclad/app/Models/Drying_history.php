<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drying_history extends Model
{protected $fillable = [
    'id',
    'date',
    'id_dryers',
];
    protected $casts = [
        'date' => 'datetime',
    ];
    use HasFactory;
    public function materials_raws()
    {
//        return $this->belongsToMany(Drying_materials::class,'drying_materials','history_id','raw_materials_id');
        return $this->belongsToMany(Drying_history::class,'drying_materials','history_id','raw_materials_id');
    }
}
