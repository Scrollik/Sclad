<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'customer',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function orderMaterials(): BelongsToMany
    {
        return $this->belongsToMany(Sclad::class, 'order_materials')->with('material');
    }
}
