@extends('layouts.app')

@section('content')
<div class="mobile-container">
    <new-post-mobile :user="{{ Auth::user() }}"></new-post-mobile>
    @include('mobile.footer')
</div>

@endsection