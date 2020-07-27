<?php // Custom Helper

use App\Siswa;
use App\Guru;

function rankingLimaBesar()
{
    $siswa = Siswa::all();
    $siswa->map(function($s){
    $s->rataRataNilai = $s->rataRataNilai();        
        return $s;
    });
    $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
    return $siswa;    
}

function totalSiswa()
{
    return Siswa::count();
}

function totalGuru()
{
    return Guru::count();
}

if (! function_exists('num_row')) // Custom Helper num_row in pagination table
{
    function num_row($page, $limit)
    {
        if (is_null($page)) 
        {
            $page = 1;
        }
        $num = ($page * $limit) - ($limit - 1);
        return $num;
    }
}
