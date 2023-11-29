<?php

namespace App\Http\Controllers\delivery;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\delivery_materials;
use App\Models\Materials;
use App\Models\Sclad_of_dries;
use App\Models\Sclad_of_raws;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Materials::get();
        $delivery = Delivery::orderBy('date','DESC')->get();
        return view('delivery.delivery',compact('delivery','materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material = Materials::get();
        return response()->json($material);
    }

    /**
     * Store a newly created resource in storage.
     */
//    Сохранение поставки
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'date'=>['required'],
            'material.*.material_id' => ['required'],
            'material.*.amount'=> ['required'],
        ]);
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $delivery = Delivery::create([
                'date' => $request->date,
            ]);
            if ($delivery){
                foreach ($request->input('material') as $materials){
                    $delivery->materials()->attach($materials['material_id'],['amount'=>$materials['amount']]);
//                    Сохранение количества материала в Склад Сырой
                    if (Sclad_of_raws::where('materials_id',$materials['material_id'])->exists())
                    {
                        $material_amount = Sclad_of_raws::where('materials_id',$materials['material_id'])->value('amount');
                        $material_amount+=$materials['amount'];
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
//    Передача данных в модальное окно с таблицей состава поставки
    public function show(string $id)
    {
       $delivery_table= Delivery_materials::where('delivery_id',$id)
           ->join('deliveries','deliveries.id_delivery','=','delivery_materials.delivery_id')
           ->join('materials','materials.id','=','delivery_materials.materials_id')
           ->get();
        return response()->json($delivery_table);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
//    Удаление поставки из истории поставок
    public function destroy(string $id)
    {
      if ($id == 0){
          Delivery::query()->delete();
      }else{
          Delivery::where('id_delivery',$id)->delete();
      }
      return redirect('delivery/supplies');

    }
}
