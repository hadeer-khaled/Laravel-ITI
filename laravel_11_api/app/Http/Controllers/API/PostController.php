<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

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
            'creator_id' => 'required',
        ]);
        if ($post_validator->fails()) {
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
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::all();
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post_validator = Validator::make($request->all(),
        [
           'title' => [
                'required',
                Rule::unique('posts')->ignore($post->id),
            ],
            'body' => 'required',
            'posted_by' => 'required',
        ]);
        $request_parms = request()->all();
        $file_path = $this->file_operations($request);
        if($file_path != null){
            $request_parms['image'] = $file_path;
        }
        $post->update($request_parms);
        return new PostResource($post);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('deleted successfully' , 200)  ;
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
