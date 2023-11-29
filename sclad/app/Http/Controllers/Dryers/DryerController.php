<?php

namespace App\Http\Controllers\Dryers;

use App\Http\Controllers\Controller;
use App\Models\Dryers;
use App\Models\Drying_materials;
use App\Models\Sclad_of_dries;
use Illuminate\Http\Request;
use App\Models\Drying_history;

class DryerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $dryers=Dryers::get();
        $dryers_table= Drying_history::where('status',0)
            ->join('drying_materials','drying_materials.history_id','=','drying_histories.id')
            ->join('materials','materials.id','=','drying_materials.raw_materials_id')
            ->get();
        return view('dryers.dryers',compact('dryers','dryers_table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
      $id =$request->id;
        $material= Drying_history::where('id_dryers',$id)
            ->Where('status',0)
            ->join('drying_materials','drying_materials.history_id','=','drying_histories.id')
            ->get();
        Drying_history::where('id_dryers',$id)->update(['status'=>1]);
        foreach ($material as $item){
            if (Sclad_of_dries::where('materials_id',$item['raw_materials_id'])->exists()){
                $amount = Sclad_of_dries::where('materials_id',$item['raw_materials_id'])->value('amount');
                $amount += $item['amount'];
                Sclad_of_dries::where('materials_id',$item->raw_materials_id)->update(['amount'=>$amount]);

            }else{
                Sclad_of_dries::create([
                    'materials_id'=>$item['raw_materials_id'],
                    'amount'=>$item['amount'],
                ]);
            }
        }
          return redirect('sclad_dryers/dryer');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
