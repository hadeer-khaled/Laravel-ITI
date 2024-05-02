<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
#  to use database builder
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;


# to use model
use App\Models\Post;
use App\Models\User;


use Illuminate\Support\Facades\Gate;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    function __construct(){
        # all routes associated to all functions in this controller must use the auth middleware
     $this->middleware('auth');
    //  $this->middleware('auth')->only('store','update','destroy');
        // $this->middleware('auth')->except(['index', 'show']);
    }
    private function  authorize_user($post){
        if (! Gate::allows('post_update_delete', $post)) {
            abort(403);
        }
    }
   
    function index (){
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

        $validated = request()->validate([
            'title' => 'required|unique:posts|min:3',
            'body' => 'required|min:10',
            'posted_by'=>'required'
        ]);
    
        $file_path = $this->file_handler(request());
        $request_params= request()->all();

        $user = Auth::user();
        // dd($user->id);
        if($user){
            $request_params["posted_by"]=$user->id;
        }

        $post = new Post();

        $post->title = $request_params["title"];
        $post->body = $request_params["body"];
        $post->posted_by = $request_params["posted_by"];
        $post->image = $file_path;

        // dd($post);

        $post->save();
        return to_route('post.show' , $post->id);
    }


    function edit($id){
        
        $users = User::all();
        $post = Post::findOrFail($id);
        $this->authorize_user($post);
        return view('editPost ', ["post"=>$post , 'users' => $users]);
        

    }
    function update($id){

        $post = Post::findOrFail($id);

        $validated = request()->validate([
            'title' => [
                'required',
                Rule::unique('posts')->ignore($post->id),'min:3'],
            'body' => ['required','min:10'],
            'posted_by'=>['required']
        ]);

        
        $updated_data = request()->all();

        $file_path = $this->file_handler(request());

        $post->title = $updated_data["title"];
        $post->title_slug = Str::slug($post->title);
        $post->body = $updated_data["body"];
        $post->posted_by = Auth::user()->id;
        $post->image = $file_path;

        $post->save();

        return to_route('post.show' , $post->id);


     }
 
     
    function destroy($id){
        $post = Post::findOrFail($id);
        $this->authorize_user($post);
       
        $post->delete();
        return to_route("post.index");

    }

    public function restore()
        {
            $restoredCount = Post::onlyTrashed()->restore();

            return redirect()->back()->with('success', $restoredCount . ' soft deleted posts restored successfully');
        }



}