<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dryers;
use App\Models\Materials;
use App\Models\Role;
use App\Models\User;
//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\UseStatementPass;
use function Laravel\Prompts\error;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        $materials = Materials::get();
        $dryers = Dryers::get();
        return view('admin.admin_panel',compact('users','roles','materials','dryers'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $validator = Validator::make($request->all(),[
         'email'=> ['required','string','email','unique:users'],
         'name_sotr' => ['required','string'],
         'password'=> ['required','confirmed','min:8'],
         'role_rab'=>['sometimes','required'],
     ]);
       if (!$validator->passes()){
           return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
       }else{
           $user = User::create([
               'name' => $request->name_sotr,
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'role' => $request->role_rab,
           ]);
           if ($user){
               return response()->json(['status'=>1,'msg'=>'Новый сотрудник добавлен']);
           }
       }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(),[
            'email'=> ['required','string','email'],
            'name_sotr' => ['required','string'],
            'password'=> ['nullable','min:8'],
            'role_rab'=>['sometimes','required'],
        ]);
        $data = [
            'name' => $request->name_sotr,
            'email' => $request->email,
            'password' => ($request->password),
            'role' => $request->role_rab,
        ];
        if (!$data['password'])
        {
            unset($data['password']);
        }
        else
        {
            $data['password'] = Hash::make($data['password']);
        }
        if (!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $update = User::where('id',$id)->update($data);
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
        User::destroy($id);
        return redirect('admin/admin_panel');
    }
}


