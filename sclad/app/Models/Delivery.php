<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'id',
        'date',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function materials()
    {
        return $this->belongsToMany(Materials::class,'delivery_materials','delivery_id','materials_id');
    }
    public function materials_raws()
    {
        return $this->belongsToMany(Sclad_of_raws::class,'sclad_of_raws','materials_id');
    }

    use HasFactory;
}
