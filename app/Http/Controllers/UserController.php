<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Auth;

class UserController extends Controller
{
    public function profile($id_or_username){
        $user = User::where('id', '=', $id_or_username)->orWhere('username', $id_or_username)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(4);
        return view('profile', compact('user', 'posts'));
    }

    public function myFavorites()
    {
        $user = Auth::user();
        $counts = Auth::user()->likes;
        $myFavorites = Auth::user()->likes()->orderBy('created_at', 'desc')->paginate(15);
        return view('auth.saved', compact('myFavorites', 'user', 'counts'));
    }
}
