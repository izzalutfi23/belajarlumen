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

}