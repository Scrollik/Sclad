<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DryingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'status',
        'dryer_id',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->format('d.m.Y'),
        );
    }

    public function dryer(): BelongsTo
    {
        return $this->belongsTo(Dryer::class, 'dryer_id', 'id');
    }

    public function dryingMaterials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'drying_materials')->withPivot('amount');
    }

}
