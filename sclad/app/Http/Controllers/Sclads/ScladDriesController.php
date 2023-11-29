<?php

namespace App\Http\Controllers\Sclads;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Illuminate\Http\Request;

class ScladDriesController extends Controller
{
    public function index(){
        $dries = Materials::with('sclad_of_dries')
            ->whereHas('sclad_of_dries')
            ->get();
        return view('sclad_drie.dries',compact('dries'));
    }
}
