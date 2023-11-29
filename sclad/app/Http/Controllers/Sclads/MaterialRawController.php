<?php

namespace App\Http\Controllers\Sclads;

use App\Http\Controllers\Controller;
use App\Models\Dryers;
use App\Models\Drying_history;
use App\Models\Drying_materials;
use App\Models\Materials;
use App\Models\Sclad_of_raws;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialRawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $raw_materials = Materials::with('sclad_of_raws')
            ->whereHas('sclad_of_raws')
            ->get();
        return response()->json($raw_materials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->input('raw_materials') as $materials){
            $amounts = Sclad_of_raws::where('materials_id',$materials['material_id'])->value('amount');
            $validator = Validator::make($request->all(),[
                'date'=>['required'],
                'id_dryers'=>['required'],
                'raw_materials.*.material_id' => ['required'],
                'raw_materials.*.amount'=> ['required','numeric','min:1',"max:$amounts"],
            ]);
        }
//        $validator = Validator::make($request->all(),[
//            'date'=>['required'],
//            'id_dryers'=>['required'],
//            'raw_materials.*.material_id' => ['required'],
//            'raw_materials.*.amount'=> ['required','numeric','min:2',"max:$zopa"],
//        ]);
            if (!$validator->passes()){
                return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
            }else{
                $drying = Drying_history::create([
                    'date' => $request->date,
                    'id_dryers'=> $request->id_dryers,
                ]);
                if ($drying){
                    foreach ($request->input('raw_materials') as $materials){
                        $drying->materials_raws()->attach($materials['material_id'],['amount'=>$materials['amount']] );
//                    Сохранение количества материала в Склад Сырой
                        if (Sclad_of_raws::where('materials_id',$materials['material_id'])->exists())
                        {
                            $material_amount = Sclad_of_raws::where('materials_id',$materials['material_id'])->value('amount');
                            $material_amount-=$materials['amount'];
                            Sclad_of_raws::where('materials_id',$materials['material_id'])->update(['amount'=>$material_amount]);
                        }else{
                            Sclad_of_raws::create([
                                'materials_id'=>$materials['material_id'],
                                'amount'=>$materials['amount'],
                            ]);
                        }
                    }

                }
                return response()->json(['status'=>1,'msg'=>'Новая доставка добавлена']);
            }
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
        $amount = Sclad_of_raws::where('materials_id',$id)->get();
        return response()->json($amount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id_material = $request->id;
        $validator = Validator::make($request->all(),[
            'amount_material' =>['required'],

        ]);
        $data = [
            'amount' => $request->amount_material,
        ];
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $update = Sclad_of_raws::where('materials_id',$id_material)->update($data);
            if ($update){
                return response()->json(['status'=>1,'msg'=>'Все ок']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
