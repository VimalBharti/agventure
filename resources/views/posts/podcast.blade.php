@extends('layouts.app')

@section('content')
<div class="main-container boxed-layout">
    <all-podcast></all-podcast>
</div>

<div class="mobile-container">
    <mobile-podcast></mobile-podcast>
    <!-- footer link bar -->
    @include('mobile.footer')
</div>

@endsection

