<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sclad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'material_id',
        'type',
        'amount',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
