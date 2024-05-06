<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return  $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post_validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        if ($post_validator->fails()) {
            return response()->json(
                [
                    'validation_errors' => $post_validator->errors(),
                    'message' =>'please review your user form data',
                    'typealert'=>'danger'
                ], 422
            );
        }
        $request_parms = request()->all();
        $user = User::create($request_parms);
        $user->save();
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
