<?php

namespace App\Http\Controllers;

use App\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function profile(Guru $guru)
    {
        // $guru = Guru::find($id);
        return view('guru.profile', compact('guru'));
        //return view('guru.profile', ['guru' => $guru]);
    }
}
