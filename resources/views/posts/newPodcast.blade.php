
@extends('layouts.app')

@section('content')
<div>
    <div class="main-container boxed-layout">
        <new-podcast :user="{{ Auth::user() }}"></new-podcast>
    </div>
</div>

@endsection
