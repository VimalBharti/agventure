
@extends('layouts.app')

@section('content')
<div>
    <div class="main-container boxed-layout">
        <image-upload :user="{{ Auth::user() }}"></image-upload>
    </div>
</div>

@endsection
