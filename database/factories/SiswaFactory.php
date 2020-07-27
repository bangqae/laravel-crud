<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Siswa;
use Faker\Generator as Faker;

$factory->define(Siswa::class, function (Faker $faker) {
    return [
        'user_id' => 100,
        'nama_depan' => $faker->firstName($gender = null|'male'|'female'),
        'nama_belakang' => $faker->lastName,
        'jenis_kelamin' => $faker->randomElement(['L','P']),
        'agama' => $faker->randomElement(['Islam','Kristen','Katolik','Hindu','Budha']),
        'alamat' => $faker->address,
    ];
});
