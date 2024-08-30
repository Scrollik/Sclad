<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'sclad_id',
        'amount',
    ];

    public function scladMaterials(): BelongsTo
    {
        return $this->belongsTo(Sclad::class, 'sclad_id', 'id')->with('material');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}
