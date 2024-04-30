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
        $post = Post::findOrFail($id);
        return view('details', ["post"=>$post]);
     
    }

    function create(){
        return view('createPost');
    }

    function store(){
        // dd("store function");

        $request_params = request()->all();
       
        $post = new Post();

        $post->title = $request_params["title"];
        $post->body = $request_params["body"];

        // dd($post);

        $post->save();
        return to_route('post.show' , $post->id);
    }


    function edit($id){
        $post = Post::findOrFail($id);
        return view('editPost ', ["post"=>$post]);
        

    }
    function update($id){
        $post = Post::findOrFail($id);
        $updated_data = request()->all();
        // dd($post, $updated_data);

        $post->title = $updated_data["title"];
        $post->body = $updated_data["body"];

        $post->save();

        return to_route('post.show' , $post->id);


     }
 
     
    function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route("post.index");

    }

}