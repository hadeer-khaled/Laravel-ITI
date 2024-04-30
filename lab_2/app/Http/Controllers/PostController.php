<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    
    // private  $posts=[
    //     ["id"=> "1","title"=>"Post 1" ,"body"=>"This is post 1"],
    //     ["id"=> "2","title"=>"Post 2" ,"body"=>"This is post 2"],
    //     ["id"=> "3","title"=>"Post 3" ,"body"=>"This is post 3"],
    // ];

    function index (){
        $posts = DB::table('posts')->get();
            return $posts;


    }
    // function show ($id){
    //     if ($id <count($this->posts)){
    //         $post = $this->posts[$id-1];
    //         return view('details', ["post"=>$post]);
    //     }
    //    return abort(404);
    // }

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