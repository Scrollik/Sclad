<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use App\Models\Sclad_of_dries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name_materials' => ['required','string'],
            'height' =>['required'],
            'width' => ['required'],

        ]);
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);

        }else{
            $material = Materials::create([
                'name_materials' => $request->name_materials,
                'height' => $request->height,
                'width'=>$request->width,
            ]);
            if ($material){
                return response()->json(['status'=>1,'msg'=>'Новый материал добавлен']);
            }
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $material = Materials::find($id);
        return response()->json($material);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(),[
            'name_mat' => ['required','string'],
            'height' =>['required'],
            'width' => ['required'],
        ]);
        $data = [
            'name_materials' => $request->name_mat,
            'height' => $request->height,
            'width'=>$request->width,
        ];
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $update = Materials::where('id',$id)->update($data);
            if ($update){
                return response()->json(['status'=>1]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Materials::destroy($id);
        return redirect('admin/admin_panel');
    }
}
