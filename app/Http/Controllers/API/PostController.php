<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function create(Request $request)
    {
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

        return response()->json([
            'success' => true,
            'message' => 'posted',
            'post' => $post
        ]);
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        // check if userediting its own post
        if(Auth::user()->id != $request->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $post->about = $request->about;
        $post->update();
        return response()->json([
            'success' => true,
            'message' => 'Post Edited'
        ]);
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        // check if userediting its own post
        if(Auth::user()->id != $request->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorized access'
            ]);
        }
        
        // check if post has images to delete
        // if($post->postdetails != ''){
        //     Storage::delete('uploads/' . $post->postdetails);
        // }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post Deleted'
        ]);
    }

    public function posts()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        foreach($posts as $post){
            // get user of post
            $post->user;
            // Comment count
            $post['commentsCount'] = count($post->comments);
            // check if user liked his own post
            $post['selfLike'] = false;
            foreach($post->likes as $like){
                if($like->user_id == Auth::user()->id){
                    $post['selfLike']  = true;
                }
            }
        }

        return response()->json([
            'success' => true,
            'posts' => $posts
        ]);
    }

}
