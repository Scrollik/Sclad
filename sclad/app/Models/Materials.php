<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected $fillable = [
        'id',
        'name_materials',
        'height',
        'width',
    ];
    use HasFactory;
    public function sclad_of_dries()
    {
        return $this->hasOne(Sclad_of_dries::class);
    }
    public function sclad_of_raws()
    {
        return $this->hasOne(Sclad_of_raws::class);
    }
    public function drying_materials(){
        return $this->belongsToMany(Drying_materials::class,'drying_materials','raw_materials_id');
    }
    public function delivery_materials(){
        return $this->hasMany(delivery_materials::class);
    }
}
