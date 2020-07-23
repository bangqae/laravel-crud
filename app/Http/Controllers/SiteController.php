<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Supaya bisa pake helper Str::random

class SiteController extends Controller
{
    public function home()
    {
        $posts = Post::all();
        return view('sites.home', compact('posts'));
    }
    
    public function register()
    {
        return view('sites.register');
    }

    public function postregister(Request $request)
    {
        // Insert ke tabel users
        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        // Insert ke tabel siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = Siswa::create($request->all());

        return redirect('/')->with('sukses','Data pendaftaran berhasil dikirim!');
    }

    public function singlepost($slug)
    {
        $post = Post::where('slug','=',$slug)->first();
        return view('sites.singlepost', compact('post'));
    }
}
