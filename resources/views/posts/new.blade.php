
@extends('layouts.app')

@section('content')

<div class="main-container new-post-page">
    <div class="bg-img">
        <img src="{{asset('images/post.png')}}" />
    </div>

    <image-upload :user="{{ Auth::user() }}"></image-upload>
</div>

@endsection
