<?php

use App\Models\Comment;
use App\Models\Twit;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/{user:username}', function($username) {
        return view('user-page', [
            'username' => $username
        ]);
    });
    Route::get('/{user:username}/followers', function($username) {
        return view('followers', [
            'username' => $username
        ]);
    });
    Route::get('/{user:username}/following', function($username) {
        return view('following', [
            'username' => $username
        ]);
    });
    Route::get('/{user:username}/status/{twit}', function($username, $twitId) {
        $twit = Twit::findOrFail($twitId);
        return view('twit-page', [
            'username' => $username,
            'twit' => $twit
        ]);
    });
    Route::get('/{user:username}/status/{twit}/{comment}', function($username, $twitId, $commentId) {
        $twit = Twit::findOrFail($twitId);
        $comment = Comment::findOrFail($commentId);
        return view('twit-page', [
            'username' => $username,
            'twit' => $twit,
            'comment' => $comment
        ]);
    });
});
