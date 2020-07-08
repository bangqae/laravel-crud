<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['nama','telpon','alamat'];

    //Deklarasi relasi one to many dengan mapel
    //Usahakan namanya mengikuti nama tabel relasinya

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
