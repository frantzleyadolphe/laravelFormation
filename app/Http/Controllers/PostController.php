<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts=[
            "Mon premier titre",
            "mon second titre"
        ];
        return view('articles', compact('posts'));
    }

    public function show($id)
    {
        $posts= [
            1 => 'Mon Premier identifiant',
            2 => 'Mon second identifiant'
        ];

        $post=$posts[$id];

        return view ('post', [
            'post' => $post
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
