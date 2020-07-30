@extends('layouts.master')

@section('header')
<title>Profile&nbsp;{{ $siswa->nama_depan }}</title>
{{-- X-EDITABLE --}}
@endsection

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                {{-- Method getAvatar() dari model Siswa --}}
                                <img src="{{ $siswa->getAvatar() }}" class="img-circle" alt="Avatar" height="90px"
                                    width="90px">
                                <h3 class="name">
                                    {{ $siswa->nama_depan }}&nbsp;{{ $siswa->nama_belakang }}
                                </h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{ $siswa->mapel->count() }} <span>Mata Pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        {{ $siswa->rataRataNilai() }} <span>Rata-rata</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        2174 <span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Info</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Kelamin
                                        <span>{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki':'Perempuan' }}</span>
                                    </li>
                                    <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                                    <li>Agama <span>{{ $siswa->agama }}</span></li>
                                    {{-- <li>Email <span>{{ $siswa->user->email }}</span></li> --}}
                                </ul>
                            </div>
                            <div class="text-center">
                                <a href={{ route('dashboard') }} class="btn btn-secondary">Back</a>
                                <a href="#" class="btn btn-warning">Edit Profie</a>
                            </div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        {{-- PANEL NILAI --}}
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mata Pelajaran</h3>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Mapel</th>
                                            <th>Semester</th>
                                            <th>Nilai</th>
                                            <th>Guru</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Untuk setiap data $siswa yang ada di tabel pivot, lakukan : --}}
                                        @foreach($siswa->mapel as $mapel)
                                        {{-- Disini mapel adalah relasi $siswa ke pivot,  --}}
                                        <tr>
                                            <td>{{ $mapel->kode }}</td>
                                            <td>{{ $mapel->nama }}</td>
                                            <td>{{ $mapel->semester }}</td>
                                            <td>{{ $mapel->pivot->nilai }}</td>
                                            <td><a
                                                    href="/guru/{{ $mapel->guru_id }}/profile">{{ $mapel->guru->nama }}</a>
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- END PANEL NILAI --}}
                        {{-- PANEL CHART --}}
                        <div class="panel">
                            {{-- <div class="panel-heading">

                            </div> --}}
                            <div class="panel-body" id="chartNilai">

                            </div>
                        </div>
                        {{-- END PANEL CHART --}}
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
@endsection

@section('footer')
{{-- HIGHCHARTS --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    // ss
    Highcharts.chart('chartNilai', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Chart Nilai Siswa'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: {!!json_encode($categories)!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rentang Nilai'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            // pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            //     '<td style="padding:0"><b>{point.y:.1f}mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Nilai',
            data: {!!json_encode($data)!!}
        }]
    });
</script>
@endsection
