<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostDetail;
use App\Video;
use Auth;
use Storage;
use DB;

class PostController extends Controller
{

    // Main Home Page
    public function home(){
        // $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::with('postdetails')->orderBy('created_at', 'desc')->get();
        return view('welcome', compact('posts', 'details'));
    }

    public function createPost(Request $request)
    {
        $rules = [
            'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000'
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
        $posts = Post::with('postdetails', 'user')->orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }
    public function imageUpload(Request $request){

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'body' => $request->body
        ]);

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

    // Likes system
    public function isLikedByMe($id)
    {
        $post = Post::findOrFail($id)->first();
        if (Like::whereUserId(Auth::id())->wherePostId($post->id)->exists()){
            return 'true';
        }
        return 'false';
    }

    public function like(Post $post)
    {
        $existing_like = Like::withTrashed()->wherePostId($post->id)->whereUserId(Auth::id())->first();

        if (is_null($existing_like)) {
            Like::create([
                'post_id' => $post->id,
                'user_id' => Auth::id()
            ]);
        } else {
            if (is_null($existing_like->deleted_at)) {
                $existing_like->delete();
            } else {
                $existing_like->restore();
            }
        }
        return redirect()->back();
    }
}
