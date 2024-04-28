<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    
    private  $posts=[
        ["id"=> "1","title"=>"Post 1" ,"content"=>"This is post 1"],
        ["id"=> "2","title"=>"Post 2" ,"content"=>"This is post 2"],
        ["id"=> "3","title"=>"Post 3" ,"content"=>"This is post 3"],
    ];

    function index (){
        return view("index", ["posts"=>$this->posts]);
    }
    function show ($id){
        if ($id <count($this->posts)){
            return $this->posts[$id-1];
        }
       return abort(404);
    }


}