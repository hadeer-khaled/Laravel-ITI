<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Resources\PostResource;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return  PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post_validator = Validator::make($request->all(),
        [
            'title' => 'required|unique:posts',
            'body' => 'required',
            'posted_by' => 'required',
        ]);
        if ($post_validator->fails()) {
            // return response()->json($post_validator->errors(), 422);
            return response()->json(
                [
                    'validation_errors' => $post_validator->errors(),
                    'message' =>'please review your post form data',
                    'typealert'=>'danger'
                ], 422
            );
        }

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
        return  new PostResource($post);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post_validator = Validator::make($request->all(),
        [
            'title' => 'required|unique:posts',
            'body' => 'required',
            'posted_by' => 'required',
        ]);
        if ($post_validator->fails()) {
            // return response()->json($post_validator->errors(), 422);
            return response()->json(
                [
                    'validation_errors' => $post_validator->errors(),
                    'message' =>'please review your post form data',
                    'typealert'=>'danger'
                ], 422
            );
        }

        $request_parms = request()->all();
        $file_path = $this->file_operations($request);
        if($file_path != null){
            $request_parms['image'] = $file_path;
        }
        $post->update($request_parms);
        return $post;
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
            $filepath=$image->store("posts","post_uploads" );
            return $filepath;

        }
        return null;
    }
}
