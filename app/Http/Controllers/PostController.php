<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        //avec cette fonction static j ai pu recuperer  toutes les donnees presentes en base de donnee en faisant ::all()
        $posts= Post::all();
        return view('articles', [
            'posts'=> $posts
        ]);
    }

    public function show($id)
    {
        $post =Post::findOrFail($id);
        //avec findOrFail, eloquent me permet de renvoyer une erreur 404 au cas ou il n y aura pas de donnees correspondantes
        //$post=Post::where('title','Nobis amet qui architecto eos quia labore.')->firstOrFail();

        return view ('post', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('form');
    }

    public function saved(Request $request)
    {
        //pour enregistrer des donnees dans ma base de donnee
        Post::create([
            'title'=>$request->title,
            'content'=>$request->content
        ]);
        dd('Post créé !');
    }

    public function contact()
    {
        return view('contact');
    }


}
