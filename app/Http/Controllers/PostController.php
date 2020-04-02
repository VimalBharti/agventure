<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostDetail;
use App\Video;
use App\Like;
use App\Community;
use Auth;
use Storage;
use DB;

class PostController extends Controller
{

    // Main Home Page
    public function home(){
        // $posts = Post::orderBy('created_at', 'desc')->get();
        $user = Auth::user();
        $communities = Community::with('posts')->paginate(4);
        $posts = Post::with('postdetails', 'community')->orderBy('created_at', 'desc')->paginate(25);
        return view('welcome', compact('posts', 'details', 'communities', 'user'));
    }

    public function newPost()
    {
        $user = Auth::user();
        $communities = Community::all();
        return view('posts.new', compact('communities', 'user'));
    }

    public function createPost(Request $request)
    {
        $rules = [
            'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000',
            'body'    => 'required'
        ];
        $this->validate($request, $rules);

        $id = Auth::user()->id;
        $request['user_id'] = $id;
        $post = Post::create($request->all());

        if($request->hasFile('photos')){
            foreach($request->photos as $photo) {
                $filename = $photo->store('', ['disk' => 'uploads']);
                PostDetail::create([
                    'post_id' => $post->id,
                    'filename' => $filename
                ]);
            }
        }

        if($request->hasFile('videos')){
            foreach($request->videos as $video) {
                $filename = $video->store('', ['disk' => 'uploads']);
                Video::create([
                    'post_id' => $post->id,
                    'filename' => $filename
                ]);
            }
        }

        return redirect()->back();
    }

    // Post save by axios
    public function getAllPosts(){
        $posts = Post::with('postdetails', 'user', 'community')->orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }
    public function imageUpload(Request $request){

        $rules = [
            'filename'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000',
            'body'    => 'required'
        ];
        $this->validate($request, $rules);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'body' => $request->body,
            'community_id' => $request->community,
        ]);
        if($request->hasFile('audio')){
            $filename = $request->file('audio')->getClientOriginalName();
            $fileNameToStore = $filename;
            $path = $request->file('audio')->storeAs('', $fileNameToStore, ['disk' => 'audio']);
            $post->audio = $fileNameToStore;
            $post->save();
        }

        if (count($request->photos)){
            foreach($request->photos as $photo) {
                $filename = $photo->store('', ['disk' => 'uploads']);
                PostDetail::create([
                    'post_id' => $post->id,
                    'filename' => $filename
                ]);
            }
        }

        return redirect()->back();
    }
    public function single($slug)
    {   
        $user = Auth::user();
        $post = Post::where('slug', '=', $slug)->first();
        $images = PostDetail::where('post_id', '=' , $post->id)->get();
        return view('posts.single', compact('post', 'images', 'user'));
    }

    public function ApiPodcast(){
        $posts = Post::where('audio', '!=', '')->get();
        return response()->json($posts);
    }
    public function getPodcast(){
        $user = Auth::user();
        return view('posts.podcast', compact('user'));
    }


    // Likes system / Favourite Post
    public function favoritePost(Post $post)
    {   
        Auth::user()->likes()->attach($post->id);
        return back();
    }    
    public function unFavoritePost(Post $post)
    {
        Auth::user()->likes()->detach($post->id);
        return back();
    }

}
