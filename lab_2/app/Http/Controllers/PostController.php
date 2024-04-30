<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#  to use database builder
use Illuminate\Support\Facades\DB;

# to use model
use App\Models\Post;

class PostController extends Controller
{
    
    function index (){
        # 1. Using DataBase Builder
            // $posts = DB::table('posts')->get();
            // return $posts;

        # 2. Using model

            $posts = Post::all();
            // return $posts;
            return view('index', ["posts"=>$posts]);
    }

    function show ($id){
        $post = Post::find($id);
        return view('details', ["post"=>$post]);
     
    }

    function create(){
   
       return view("createPost");
    }

    // function edit($id){
    //     if ($id <=count($this->posts)){
    //         $post =$this->posts[$id-1];
    //         return view('editPost', ["post"=>$post]);
    //     }
    //     return abort(404);

    // }
     
    // function delete($id){
    //     if ($id <=count($this->posts)){
    //         $post =$this->posts[$id-1];
    //         return view('deletePost', ["post"=>$post]);
    //     }
    //     return abort(404);
    //  }
}