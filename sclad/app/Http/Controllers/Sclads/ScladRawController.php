<?php

namespace App\Http\Controllers\Sclads;

use App\Http\Controllers\Controller;
use App\Models\Dryers;
use App\Models\Materials;
use App\Models\Sclad_of_raws;

class ScladRawController extends Controller
{
    public function index()
    {
       $raws = Materials::with('sclad_of_raws')
           ->whereHas('sclad_of_raws')
           ->get();
       $dryers = Dryers::get();
//           ->join('materials','materials.id','=','sclad_of_raws.id_materials');
       return view('sclad_raw.raws',compact('raws','dryers'));
    }
}
