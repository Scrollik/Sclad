<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name_materials',
        'height',
        'width',
    ];

    public function sclad(): HasMany
    {
        return $this->hasMany(Sclad::class, 'material_id', 'id');
    }
}
