<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['kode','nama','semester'];

    public function siswa() //Relasi tabel siswa dengan mapel
    {
        return $this->belongsToMany(Siswa::class)->withPivot(['nilai']);//Dari tabel pivot mapel_siswa
    }
}
