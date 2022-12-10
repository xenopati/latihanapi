<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
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
}
