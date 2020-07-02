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
    //Properti fillable untuk memungkinkan mass assignment
    protected $fillable = ['user_id','nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar'];

    public function getAvatar()
    {
        if(!$this->avatar){
            return asset('images/default.jpg');
        }
        //Kalo ada gambarnya tampilkan
        return asset('images/'.$this->avatar);
    }

    public function mapel() //Relasi tabel siswa dengan mapel
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();//Dari tabel pivot mapel_siswa
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
