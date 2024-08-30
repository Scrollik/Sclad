<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dryer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'dryers_name',
    ];

    public function dryingMaterials(): HasMany
    {
        return $this->hasMany(dryingHistory::class, 'dryer_id', 'id');
    }
}
