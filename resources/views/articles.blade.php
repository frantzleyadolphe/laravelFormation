@extends('layouts.app')
@section('content')
    <div>
        <h1 class="text-amber-500 px-10">Liste de mes articles</h1>
        @foreach ( $posts as $post )
        <h3><a href="{{route('post.show',['id' => $post->id])}}">{{ $post->title }}</a></h3>
        @endforeach
    </div>
@endsection

