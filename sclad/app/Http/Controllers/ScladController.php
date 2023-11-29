<?php

namespace App\Http\Controllers;

use App\Models\Drying_history;
use App\Models\Drying_materials;
use App\Models\Materials;
use Illuminate\Http\Request;

class ScladController extends Controller
{
   public function allmaterial()
   {
       $raws = Materials::with('sclad_of_raws')
           ->whereHas('sclad_of_raws')
           ->get();
       $dries = Materials::with('sclad_of_dries')
           ->whereHas('sclad_of_dries')
           ->get();
       $suhs = Drying_history::where('status',0)
           ->join('drying_materials','drying_materials.history_id','=','drying_histories.id')
           ->join('materials','materials.id','=','drying_materials.raw_materials_id')
           ->selectRaw('materials.height,materials.width,materials.name_materials,drying_materials.raw_materials_id,SUM(amount) as sum')
           ->groupBy('raw_materials_id')
           ->get();

//       $suhs = Drying_history::select('*')
//       ->where('status',0)
//           ->with('materials_raws')
//           ->join('drying_materials','drying_materials.history_id','=','drying_histories.id_history')
//           ->join('materials','materials.id','=','drying_materials.raw_materials_id')
//           ->get();

       return view('dashboard',compact('raws','dries','suhs'));
   }
}
