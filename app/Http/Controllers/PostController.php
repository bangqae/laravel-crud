<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $users = User::all();
        return view('posts.index', compact('posts', 'users'));
    }

    public function add()
    {
        return view('posts.add');
    }

    public function create(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'thumbnail' => $request->thumbnail
        ]);
        return redirect()->route('posts.index')->with('sukses','Post berhasil disubmit!');
    }

    public function edit(Post $post)
    {
        //dd($post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        
    }

    public function delete(Siswa $siswa) 
    {
        
    }
}
