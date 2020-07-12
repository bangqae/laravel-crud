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
