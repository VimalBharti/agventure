
@extends('layouts.app')

@section('content')
<div>
    <image-upload :user="{{ Auth::user() }}"></image-upload>
</div>

@endsection
