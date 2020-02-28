<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class UserController extends Controller
{
    public function profile($id){
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(4);
        return view('profile', compact('user', 'posts'));
    }
}
