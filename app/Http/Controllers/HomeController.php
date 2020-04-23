<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Inbox;
use App\Post;
use App\PostDetail;
use Auth;
use App\Events\NewMessage;
use Session;
use Storage;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function myAccount()
    {
        return view('auth.account', compact('user'));
    }
    public function editAccount()
    {
        return view('auth.edit', compact('user'));
    }
    public function updateAccount(Request $request, $id)
    {
        $user = User::find($id);
        $user->name   = $request->input('name');
        $user->email   = $request->input('email');
        $user->mobile   = $request->input('mobile');
        $user->city   = $request->input('city');
        $user->state   = $request->input('state');
        $user->country   = $request->input('country');
        $user->about   = $request->input('about');

        $user->save();
        return redirect()->back();
    }
    public function avatar_update(Request $request){
        
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('', $avatarName, ['disk' => 'avatar']);

        $user->image = $avatarName;
        $user->save();
  
        return redirect()->back();
    }
    public function myPost()
    {
        return view('auth.mypost', compact('user'));
    }
    public function postDelete($id)
    {
        $post = Post::findOrFail($id);

        $images = PostDetail::where('post_id', $post->id);

        $post->delete();
        $images->delete();
        return redirect()->back();
    }
    // Events
    public function myEvents()
    {
        return view('auth.myevents', compact('user'));
    }
    public function singleEvent()
    {
        return view('auth.singleEvent', compact('user'));
    }



    //** */
    // Messages Functions
    //** */
    public function inbox()
    {
        $user = Auth::user();
        $inbox = Inbox::where('receiver_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('auth.inbox', compact('inbox', 'user'));
    }
    public function sendMessage(Request $request){
        $user = Auth::user();
        $inbox = new Inbox;
        $inbox->sender_id = $user->id;
        $inbox->message = $request->message;
        $inbox->receiver_id = $request->receiver_id;
        $inbox->save();

        session()->flash('notify', 'Message sent');

        return redirect()->back();
    }

    // Message App Start
    public function get(){
        // get all user except the Auth user
        $contacts = User::where('id', '!=', auth()->id())->get();

        $unreadIds = Inbox::select(\DB::raw('`sender_id` as sender_id, count(`sender_id`) as messages_count '))
                    ->where('receiver_id', auth()->id())
                    ->where('status', false)
                    ->groupBy('sender_id')
                    ->get();
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }
    public function getMessageFor($id){

        // mark all msgs with all selected contatc as read
        Inbox::where('sender_id', $id)->where('receiver_id', auth()->id())->update(['status' => true]);

        $messages = Inbox::where(function($q) use($id) {
            $q->where('sender_id', auth()->id());
            $q->where('receiver_id', $id);
        })->orWhere(function($q) use($id){
            $q->where('sender_id', $id);
            $q->where('receiver_id', auth()->id());
        })
        ->get(); 

        return response()->json($messages);
    }
    public function send(Request $request){
        $message = Inbox::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->contact_id,
            'message' => $request->message
        ]);

        broadcast(new NewMessage($message));
        return response()->json($message);
    }
}
