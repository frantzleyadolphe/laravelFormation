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
}
