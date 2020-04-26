<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Podcast;

class PodcastController extends Controller
{
    
    public function ApiPodcast(){
        $podcasts = Podcast::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($podcasts);
    }
    public function SinglePodcast($id){
        $podcast = Podcast::where('id', '=', $id)->with('user')->firstOrFail();
        return view('podcast.singlePodcast', compact('podcast'));
    }
    public function SinglePodcastDesktop($slug){
        $podcast = Podcast::where('slug', '=', $slug)->with('user')->firstOrFail();
        return view('podcast.singleDesktop', compact('podcast'));
    }
    public function getPodcast(){
        $podcasts = Podcast::with('user')->orderBy('created_at', 'desc')->get();
        return view('podcast.index', compact('podcasts'));
    }

    public function newPodcast()
    {
        return view('podcast.newPodcast');
    }

    // Create new Podcast
    public function createPodcast(Request $request)
    {
        $rules = [
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:6000',
            'about'    => 'required',
            'audio'    => 'required'
        ];
        $this->validate($request, $rules);

        $podcast = new Podcast;
        $podcast->about = $request->about;
        $podcast->user_id = Auth::user()->id;

        // Image Upload
        if($request->hasFile('image')){
            $imagePath = request()->file('image')->store('podcast', 's3');
        }
        // Audio Upload
        if($request->hasFile('audio')){
            $audioPath = request()->file('audio')->store('podcast', 's3');
        }
        $podcast->image = $imagePath;
        $podcast->audio = $audioPath;
        $podcast->save();

        return redirect()->back();
    }
}
