<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#  to use database builder
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

# to use model
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    
    function index (){
        # 1. Using DataBase Builder
            // $posts = DB::table('posts')->get();
            // return $posts;

        # 2. Using model
// 
            // $posts = Post::all();
            // return $posts;

            $posts = Post::paginate($perPage = 5, $columns = ['*'], $pageName = 'posts');;
            return view('index', ["posts"=>$posts]);
    }

    function show ($id){
        $post = Post::findOrFail($id);
        return view('details', ["post"=>$post]);
     
    }

    function create(){
        $users = User::all();

        return view('createPost',  ['users' => $users]);
    }

    private function file_handler($request){

        if($request->hasFile('image')){

            $image = $request->file('image');

            # store in the post_uploads
            $filepath=$image->store("posts","post_uploads" );
            return $filepath;
     

        }

    }
    function store(){
        // dd("store function");

        // dd(request());

    
        $file_path = $this->file_handler(request());
        //  dd($file_path);

        $request_params= request()->all();
         // dd($request_params);
         
        $post = new Post();
        $post->title = $request_params["title"];
        $post->body = $request_params["body"];
        $post->posted_by = $request_params["user_name"];
        $post->image = $file_path;

        // dd($post);

        $post->save();
        return to_route('post.show' , $post->id);
    }


    function edit($id){
        $users = User::all();
        $post = Post::findOrFail($id);
        return view('editPost ', ["post"=>$post , 'users' => $users]);
        

    }
    function update($id){
        $post = Post::findOrFail($id);
        $updated_data = request()->all();
        // dd($post, $updated_data);

        $file_path = $this->file_handler(request());

        $post->title = $updated_data["title"];
        $post->body = $updated_data["body"];
        $post->posted_by = $updated_data["user_name"];
        $post->image = $file_path;

        $post->save();

        return to_route('post.show' , $post->id);


     }
 
     
    function destroy($id){
        $post = Post::findOrFail($id);
        // if ($post->image) {
        //     $directory = '../public/images/';
        //     $imageName= $post->image;
        //     $filePath = $directory .  $imageName;

        //     $deleted = Storage::delete($filePath);
        // }
        $post->delete();
        return to_route("post.index");

    }

}