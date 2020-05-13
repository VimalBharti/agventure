@extends('layouts.app')

@section('content')
    
<div class="mobile-container">

    <div>
        @include('posts.allMobile')
    </div>

    @include('mobile.footer')
</div>

@endsection
