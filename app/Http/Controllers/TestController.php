<?php
// Part 35
namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        // 1
        // $siswa = Siswa::all();
        // 2
        // $siswa = Siswa::find(1);
        // $siswa = Siswa::all();
        $siswa = Siswa::take(5)->get();

        return view('test', compact('siswa'));
    }

}
