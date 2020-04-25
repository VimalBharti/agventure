<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Response;
use App\Post;
use App\PostDetail;
use App\Video;
use App\Like;
use App\Community;
use App\Update;
use Auth;
use Storage;
use DB;
use Image;

class PostController extends Controller
{

    // Main Home Page
    public function home(){
        $communities = Community::with('posts')->paginate(4);
        $updates = Update::orderBy('created_at', 'desc')->paginate(4);
        $posts = Post::with('postdetails', 'community')->orderBy('created_at', 'desc')->paginate(20);

        return view('welcome', compact('posts', 'details', 'communities', 'user', 'updates'));
    }

    public function newPost()
    {
        $communities = Community::all();
        return view('posts.new', compact('communities'));
    }
    
    public function newMobilePost()
    {
        $communities = Community::all();
        return view('posts.newMobile', compact('communities', 'user'));
    }

    public function createPost(Request $request)
    {
        $rules = [
            'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000',
            'about'    => 'required'
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
            'filename'   => 'image|mimes:jpeg,png,jpg|max:6000',
            'about'    => 'required'
        ];
        $this->validate($request, $rules);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'about' => $request->about,
            'community_id' => $request->community,
        ]);

        if (count($request->photos)){
            foreach($request->photos as $photo) {
                
                // Create thumbnail
                $image_name = $photo->getClientOriginalName();
                $destinationPath = storage_path('app/public/thumbnails');
                $resize_image = Image::make($photo->getRealPath());
                $resize_image->fit(600, 360, function($constraint){
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);

                
                $filename = $photo->store('articles', ['disk' => 's3']);
                
                PostDetail::create([
                    'post_id' => $post->id,
                    'filename' => $filename,
                    'thumb' => $image_name,
                ]);
            }
        }

        return redirect()->back();
    }
    // Single Post Desktop
    public function single($slug)
    {   
        $post = Post::where('slug', '=', $slug)->first();
        $images = PostDetail::where('post_id', '=' , $post->id)->get();
        return view('posts.single', compact('post', 'images', 'user'));
    }

    // Single Post Mobile
    public function singleMobile($slug)
    {   
        $post = Post::where('slug', '=', $slug)->first();
        $images = PostDetail::where('post_id', '=' , $post->id)->get();
        return view('posts.singleMobile', compact('post', 'images', 'user'));
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


    // Search Filter
    public function search(Request $request)
    {
        $search = $request->get('q');
        return Post::where('about', 'like', '%'.$search.'%')->with('user')->get();
    }
    public function DesktopSearch(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('about', 'like', '%' .$search. '%')->with('postdetails', 'user')->paginate(20);
        
        if(count($posts) > 0)
            return view('result', ['posts' => $posts]);
        else
            $request->session()->flash('error', 'We did not find results for this search.');
            return redirect()->back();
    }

}
