<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Siswa;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function collection(Collection $collection)
    {
        // dd($collection);
        // $semua_tanggal = [];
        // $tanggal_lahir;
        foreach ($collection as $key => $row) { // Pada setiap $row atau baris di dalam $collection
            if($key >= 3) { // Agar skip ke $row ke-3, karena row pertama kosong, row kedua adalah table head
                // $tanggal_lahir = $this->transformDate($row[5]);
                Siswa::create([
                    'user_id' => 100,
                    'nama_depan' => $row[1],
                    'nama_belakang' => ' ',
                    'jenis_kelamin' => $row[2],
                    'agama' => $row[3],
                    'alamat' => $row[4],
                    'tgl_lahir' => $this->transformDate($row[5]),
                ]);
                // $tangal_lahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
                // $semua_tanggal[] = $tanggal_lahir;
            }
        }
        // dd($semua_tanggal);
    }
}
