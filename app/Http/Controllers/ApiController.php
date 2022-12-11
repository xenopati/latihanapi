<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ApiController extends Controller
{
    protected $successStatus = 200;

    public function index(){
        $data = \DB::table('tests')->get();
        return response()->json($data);
    }

    public function store(Request $request){
        \DB::table('tests')->insert([
            'keterangan' => $request->inputan_keterangan
        ]);

        return response()->json([
            'status' => true,
            'message' => 'success'
        ]);
    }

    public function update(Request $request, $id){
        \DB::table('tests')->where('id', $id,)->update([
            'keterangan' => $request->inputan_keterangan
        ]);

        return response()->json([
            'status' => true,
            'message' => 'update success'
        ]);
    }

    public function delete($id){
        \DB::table('tests')->where('id', $id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'delete success'
        ]);
    }

    public function filter(Request $request){
        $keyword = $request->keyword;
        $data = \DB::table('tests')->where('keterangan', 'like', '%'.$keyword.'%')->get();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data_filter' => $data
        ]);
    }

    public function index_paging(){
        $data = \DB::table('tests')->paginate(3);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data_filter' => $data
        ]);
    }

    public function register(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        };
             
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('nApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }
}
