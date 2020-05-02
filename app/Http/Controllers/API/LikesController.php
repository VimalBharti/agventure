<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Like;

class LikesController extends Controller
{
    public function like(Request $request)
    {
        $like = Like::where('post_id', $request->post_id)->where('user_id', Auth::user()->id)->get();

        // check if it return 0 then this post is not liked by this user and should be liked or unlike
        if(count($like)>0){
            $like[0]->delete();
            return response()->json([
                'success' => true,
                'message' => 'unliked'
            ]);
        }
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->id;
        $like->save();

        return response()->json([
            'success' => true,
            'message' => 'liked'
        ]);
    }
}
