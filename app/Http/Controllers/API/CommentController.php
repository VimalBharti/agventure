<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->id;
        $comment->body = $request->body;
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment added' 
        ]);
    }

    public function update(Request $request)
    {
        $comment = Comment::find($request->id);
        // check if user is editing his own comment
        if($comment->id != Auth::user()->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorize access'
            ]);
        }

        $comment->body = $request->body;
        $comment->update();

        return response()->json([
            'success' => true,
            'message' => 'Comment Edited'
        ]);
    }

    public function delete(Request $request)
    {
        $comment = Comment::find($request->id);
        // check if user is editing his own comment
        if($comment->id != Auth::user()->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorize access'
            ]);
        }

        $comment->body = $request->body;
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment Deleted'
        ]);    
    }

    public function comments(Request $request)
    {
        $comments = Comment::where('post_id', $request->id)->get();
        // show user of each comment
        foreach($comments as $comment){
            $comment->user;
        }

        return response()->json([
            'success' => true,
            'message' => $comments
        ]);  
    }

}
