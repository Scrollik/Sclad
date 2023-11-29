<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_materials extends Model
{
    protected $fillable = [
        'delivery_id',
        'materials_id',
        'amount',
    ];
    use HasFactory;
}
