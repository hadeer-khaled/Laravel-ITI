<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//     2- show --> id --> return with post
//     3- create --> return view contains form 00> used in create
//     4- edit ---> return view contains edit form --> display post info
//     5- destroy --> ask me are you want to delete post
//  to construct these routes

// get: /posts/id ===> show
// get: /posts/create ==> 
// get:  /posts/id/edit ===> edit page
// delete: /posts/id ===> delete page

Route::get('/', function () {
    return view('welcome');
});

Route::get( "/posts" ,function(){
    $posts=[
        ["id"=> "1","title"=>"Post 1" ,"content"=>"This is post 1"],
        ["id"=> "2","title"=>"Post 2" ,"content"=>"This is post 2"],
        ["id"=> "3","title"=>"Post 3" ,"content"=>"This is post 3"],
    ];
    return view("index" , ["posts"=>$posts]);
});

Route::get("/posts/{id}", function ($id){
    $posts=[
        ["id"=> "1","title"=>"Post 1" ,"content"=>"This is post 1"],
        ["id"=> "2","title"=>"Post 2" ,"content"=>"This is post 2"],
        ["id"=> "3","title"=>"Post 3" ,"content"=>"This is post 3"],
    ];
    if ($id <count($posts)){
        return $posts[$id-1];
    }
   return abort(404);
})->where('id', '[0-9]+');
