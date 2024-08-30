<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RevisionMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'revision_id',
        'material_id',
        'type',
        'amount',
        'old_amount',
    ];

    public function materials(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }
    public function revisions(): BelongsTo
    {
        return $this->belongsTo(Revision::class, 'revision_id', 'id');
    }
}
