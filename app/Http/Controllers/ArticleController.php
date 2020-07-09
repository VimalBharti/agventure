<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use DB;
use Auth;

class ArticleController extends Controller
{
    public function create()
    {
        return view('Article.create');
    }

    public function addArticle(Request $request)
    {
        if($request->isMethod('post')){
            $title =  $request->title;
            $content =  $request->content;
            $community_id = $request->community;

            $add = DB::table('articles')->insert([
                'title' => $title,
                'content' => $content,
                'community_id' => $community_id,
                'user_id' => Auth::user()->id
            ]);
            if($add){
                return "Article Saved Successfully";
            } else {
                return "Article not saved";
            }
        } else {
            return view('Article.create');
        }
    }

    public function allArticle()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return response()->json($articles, 200);
    }
    public function getAllArticles()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('Article.index', compact('articles'));
    }
}
