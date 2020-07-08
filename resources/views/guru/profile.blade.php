@extends('layouts.master')

@section('header')
{{-- X-EDITABLE --}}
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet" />
@endsection

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            @if (session('sukses'))
            <div class="alert alert-success" role="alert">
                {{session('sukses')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                {{-- Method getAvatar() dari model Siswa --}}
                                <img src="" class="img-circle" alt="Avatar" height="90px">
                                <h3 class="name">{{ $guru->nama }}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{ $guru->mapel->count() }} <span>Mata Pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        0 <span>Awards</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        0 <span>Points</span>
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
                                    {{-- <li>Kelamin <span>{{$siswa->jenis_kelamin }}</span></li> --}}
                                    {{-- <li>Email <span>{{$siswa->email }}</span></li> --}}
                                    <li>Alamat <span>{{ $guru->alamat }}</span></li>
                                    <li>Telpon <span>{{ $guru->telpon }}</span></li>
                                    {{-- <li>Website <span><a href="https://www.themeineed.com">www.themeineed.com</a></span></li> --}}
                                </ul>
                            </div>
                            <div class="text-center">
                                <a href={{ url()->previous() }} class="btn btn-secondary">Back</a>
                                <a href={{ url("guru/{$guru->id}/edit") }} class="btn btn-warning">Edit Profie</a>
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
                                <h3 class="panel-title">Mata pelajaran yang diajar oleh guru {{ $guru->nama }}</h3>
                            </div>
                            <div class="panel-body table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Semester</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Disini mapel adalah relasi guru ke tabel mapel  --}}
                                        {{-- Untuk setiap data $guru yang ada di tabel mapel, lakukan : --}}
                                        @foreach($guru->mapel as $mapel)
                                        <tr>
                                            <td>{{ $mapel->kode }}</td>
                                            <td>{{ $mapel->nama }}</td>
                                            <td>{{ $mapel->semester }}</td>
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

{{-- Modal add new data --}}
{{-- End of modal --}}
@endsection

@section('footer')

@endsection