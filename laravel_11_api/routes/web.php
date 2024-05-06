<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
####################lOGIN WITH GITHUB####################
 
Route::get('/auth/redirect', function () {
    // return "hiiiiiiiiiiiiiiiiii";
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
   
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
        'password'=>$githubUser->token
    ]);
 
     dd($user);
    // Auth::login($user);
 
    // return redirect('/');
    // $user->token
});
