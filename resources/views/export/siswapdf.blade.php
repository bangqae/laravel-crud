{{-- PDF --}}

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            height: 50px;
        }
    </style>
</head>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Kelamin</th>
            <th>Agama</th>
            <th>Alamat</th>
            <th>Rata-rata</th>
        </tr>
    </thead>

    @foreach($siswa as $s)

    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $s->namaLengkap() }}</td>
        <td>{{ $s->jenis_kelamin }}</td>
        <td>{{ $s->agama }}</td>
        <td>{{ $s->alamat }}</td>
        {{-- Untuk memanggil fungsi harus di dalam objek siswa --}}
        <td>{{ $s->rataRataNilai() }}</td>
    </tr>

    @endforeach

</table>
