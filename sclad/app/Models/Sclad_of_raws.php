<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sclad_of_raws extends Model
{
    protected $fillable = [
        'materials_id',
        'amount',
    ];
    use HasFactory;
}
