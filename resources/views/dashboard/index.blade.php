@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    {{-- PANEL --}}
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ranking 5 besar</h3>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Fungsi rankingLimaBesar() dari custom helper (Global.php) --}}
                                    @foreach(rankingLimaBesar() as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->namaLengkap() }}</td>
                                        <td>{{ $s->rataRataNilai }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- END PANEL --}}
                </div>

                <div class="col-md-3">
                    {{-- METRIC TOTAL SISWA --}}
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ totalSiswa() }}</span>
                            <span class="title">Total Siswa</span>
                        </p>
                    </div>
                </div>

                <div class="col-md-3">
                    {{-- METRIC TOTAL GURU --}}
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{ totalGuru() }}</span>
                            <span class="title">Total Guru</span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection