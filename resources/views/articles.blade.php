@extends('layouts.app')
@section('content')
    <div>
        <h1 class="text-blue-900">Liste de mes articles</h1>
        @foreach ( $posts as $post )
        <h3>{{ $post }}</h3>
        @endforeach
    </div>
@endsection

