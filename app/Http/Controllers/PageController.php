<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\User;
use App\Post;
use App\Event;
use App\EventResponse;

class PageController extends Controller
{
    public function privacy()
    {
        return view('pages.privacy');
    }
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        $contacts = Contact::all();
        return view('pages.contact', compact('contacts'));
    }
    public function SendMessage(Request $request){

        $request->validate([
            'name' => 'required',
            'body' => 'required',
            'email' => 'required|email',
        ]);

        $contact = new Contact([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'body' => $request->get('body'),
        ]);
        $contact->save();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function profile($id){
        $auth = User::findOrFail($id);
        $posts = Post::where('user_id', $auth->id)->orderBy('created_at', 'desc')->get();
        $events = Event::where('user_id', $auth->id)->orderBy('created_at', 'desc')->get();
        // dd($auth);
        return view('users.profile', compact('posts', 'events', 'auth'));
    }

    // EVENTS

    public function singleEvent($slug)
    {
        $event = Event::where('slug', $slug)->first();
        return view('events.desktopSingle', compact('event'));
    }
    public function mobileSingleEvent($slug)
    {
        $event = Event::where('slug', $slug)->first();
        return view('events.mobileSingle', compact('event'));
    }

    public function eventEnrollForm(Request $request)
    {
        $enroll = new EventResponse([
            'auth_id' => $request->get('auth_id'),
            'event_id' => $request->get('event_id'),
            'title' => $request->get('title'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
        ]);
        $enroll->save();
        return back()->with('success','Details sent successfully.');
    }
}
