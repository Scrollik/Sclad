<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DryingMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'drying_history_id',
        'material_id',
        'amount',
    ];

    public function history(): BelongsTo
    {
        return $this->belongsTo(DryingHistory::class, 'drying_history_id', 'id');
    }

    public function materials(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }
}
