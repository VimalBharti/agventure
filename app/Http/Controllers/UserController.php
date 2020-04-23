<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Auth;
use App\Update;

class UserController extends Controller
{
    public function profile($id_or_username){
        $user = User::where('id', '=', $id_or_username)->orWhere('username', $id_or_username)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(4);
        return view('profile', compact('user', 'posts'));
    }

    public function myFavorites()
    {
        $counts = Auth::user()->likes;
        $myFavorites = Auth::user()->likes()->orderBy('created_at', 'desc')->paginate(15);
        return view('auth.saved', compact('myFavorites', 'counts'));
    }

    // All Updates Page
    public function allUpdates()
    {
        $updates = Update::orderBy('created_at', 'desc')->get();
        return view('updates.all', compact('updates'));
    }
    public function singleUpdate($slug)
    {
        $update = Update::where('slug', '=', $slug)->firstOrFail();
        return view('updates.single', compact('update'));
    }
}

