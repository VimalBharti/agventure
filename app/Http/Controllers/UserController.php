<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Auth;
use App\Update;
use App\Event;

class UserController extends Controller
{

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
    public function allUpdatesMobile()
    {
        $updates = Update::orderBy('created_at', 'desc')->get();
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('updates.allMobile', compact('updates', 'events'));
    }
    public function singleUpdate($slug)
    {
        $update = Update::where('slug', '=', $slug)->firstOrFail();
        return view('updates.single', compact('update'));
    }
}

