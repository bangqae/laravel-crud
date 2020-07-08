<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['kode','nama','semester'];

    public function siswa() //Relasi tabel mapel dengan siswa
    {
        return $this->belongsToMany(Siswa::class)->withPivot(['nilai'])->withTimeStamps();//Dari tabel pivot mapel_siswa
    }

    public function guru() //Relasi tabel mapel dengan guru
    {
        return $this->belongsTo(Guru::class);
    }
}
