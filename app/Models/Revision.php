<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Revision extends Model
{
    protected $fillable = [
        'id',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function revisionMaterials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'revision_materials')
            ->withPivot('amount', 'old_amount', 'type');
    }
}
