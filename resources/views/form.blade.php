@extends('layouts.app')

@section('content')
<h1 class="text-amber-600">CREER UN NOUVEAU POST</h1>

<form action="{{ route('post.save') }}" method="post">

@csrf
<input type="text" name="title" id="" class="border-amber-700">

<input type="text" name="content" id="">

<input type="submit" value="enregistrer">

</form>

@endsection
