<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //Laravel mengetahui bila database adalah bentuk jamak dari model
    //Contoh: Model Student => Tabel students
    //Bila mengikuti aturan tersebut tidak perlu membuat properti seperti dibawah
    //Kalo Model Siswa => Tabel siswas kan jadi aneh
    protected $table = 'siswa';
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat'];
}
