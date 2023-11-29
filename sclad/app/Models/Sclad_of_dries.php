<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sclad_of_dries extends Model
{
    protected $fillable = [
        'materials_id',
        'amount',
    ];
    use HasFactory;
}
