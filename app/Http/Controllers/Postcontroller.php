<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Postcontroller extends Controller{

    public function index(){
        $post = Post::latest()->paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'List semua post',
            'data' => $post,
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'data' => $validator->errors()
            ]);
        }
        else{
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content
            ]);

            if($post){
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil disimpan',
                    'data' => $post
                ], 201);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data gagal disimpan'
                ], 400);
            }
        }
    }

    public function show($id){
        $post = Post::find($id); 
        if($post){
            return response()->json([
                'success' => true,
                'message' => 'Detail Post',
                'data' => $post
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Harap cek kembali inputan anda!',
                'data' => $validator->errors()
            ]);
        }
        else{
            $post = Post::whereId($id)->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
            
            if($post){
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diubah',
                    'data' => $post
                ], 201);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data gagal diubah!'
                ], 400);
            }
        }
    }

    public function destroy($id){
        $post = Post::destroy('id', $id);
        if($post){
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data gagal dihapus'
            ], 400);
        }
    }

}