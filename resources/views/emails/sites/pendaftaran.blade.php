@component('mail::message')
# Pendaftaran siswa

Selamat anda telah terdaftar di MTs N 2 Pontianak

@component('mail::button', ['url' => 'https://github.com/bangqae/laravel-crud'])
Klik disini
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
