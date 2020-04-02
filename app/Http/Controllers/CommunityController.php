<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\Post;
use Auth;

class CommunityController extends Controller
{
    public function get_community()
    {
        $communities = Community::all();
        return response()->json($communities);
    }
    public function all_community()
    {
        $user = Auth::user();
        $communities = Community::all();
        return view('community.all', compact('communities', 'user'));

    }
    public function single($slug)
    {   
        $user = Auth::user();
        $community = Community::where('slug', '=', $slug)->first();
        $counts = Post::where('community_id', '=', $community->id)->get();
        $posts = Post::where('community_id', '=', $community->id)->with('postdetails')->paginate(8);
        return view('community.single', compact('community', 'posts', 'user', 'counts'));
    }
}
