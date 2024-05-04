<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file_path = $this->file_operations($request);
        $request_parms = request()->all();
        $request_parms['image'] = $file_path;
        $post = Post::create($request_parms);
        $post->save();
        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }


    private function file_operations($request){
        if($request->hasFile('image')){

            $image = $request->file('image');
            $filepath=$image->store("images","post_uploads" );
            return $filepath;

        }
        return null;
    }
}
