<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use App\Update;
use App\Podcast;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $user = User::all();
        $post = Post::all();
        $podcast = Podcast::all();
        $updates = Update::orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('user', 'post', 'podcast', 'updates'));
    }

    public function newUpdate(Request $request){

        $update = new Update;

        $update->title = $request->title;
        $update->about = $request->about;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $new_name = $image->getClientOriginalName();
            $image->move(public_path("uploads/updates/"), $new_name);
            $update->image = $new_name;
        }
  
        $update->save();
        return redirect()->back();
    }
}
