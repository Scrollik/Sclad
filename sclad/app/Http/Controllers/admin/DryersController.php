<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dryers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DryersController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name_dryers' => ['required','string'],

        ]);
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);

        }else{
            $material = Dryers::create([
                'dryers_name' => $request->name_dryers,

            ]);
            if ($material){
                return response()->json(['status'=>1,'msg'=>'Новый материал добавлен']);
            }
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
        $dryers_edit = Dryers::find($id);
        return response()->json($dryers_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(),[
            'name_dry' => ['required','string'],
        ]);
        $data = [
            'dryers_name' => $request->name_dry,
        ];
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $update = Dryers::where('id',$id)->update($data);
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
       Dryers::destroy($id);
        return redirect('admin/admin_panel');
    }
}
