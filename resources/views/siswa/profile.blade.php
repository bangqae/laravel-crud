@extends('layouts.master')

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
                                <img src="{{ $siswa->getAvatar() }}" class="img-circle" alt="Avatar" height="90px">
                                <h3 class="name">{{ $siswa->nama_depan }}&nbsp;{{ $siswa->nama_belakang }}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{ $siswa->mapel->count() }} <span>Mata Pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        15 <span>Awards</span>
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
                                    {{-- <li>Kelamin <span>{{$siswa->jenis_kelamin }}</span></li> --}}
                                    {{-- <li>Email <span>{{$siswa->email }}</span></li> --}}
                                    <li>Kelamin
                                        <span>{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki':'Perempuan' }}</span>
                                    </li>
                                    <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                                    <li>Agama <span>{{ $siswa->agama }}</span></li>
                                    {{-- <li>Website <span><a href="https://www.themeineed.com">www.themeineed.com</a></span></li> --}}
                                </ul>
                            </div>
                            <div class="text-center">
                                <a href={{ url()->previous() }} class="btn btn-secondary">Back</a>
                                <a href={{ url("siswa/{$siswa->id}/edit") }} class="btn btn-warning">Edit Profie</a>
                            </div>
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                            <i class="lnr lnr-plus-circle"></i>&nbsp; Tambah Nilai
                        </button>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mata Pelajaran</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Mapel</th>
                                            <th>Semester</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($siswa->mapel as $mapel)

                                        <tr>
                                            <td>{{ $mapel->kode }}</td>
                                            <td>{{ $mapel->nama }}</td>
                                            <td>{{ $mapel->semester }}</td>
                                            <td>{{ $mapel->pivot->nilai }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>

{{-- Modal add new data --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="panel-title" id="exampleModalLabel">Tambah Nilai</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                {{-- <span aria-hidden="true">&times;</span> --}}
                {{-- </button> --}}
            </div>
            <div class="modal-body">
                <form action="/siswa/{{ $siswa->id }}/addnilai" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                        <select name="mapel" class="form-control" id="mapel">

                            @foreach($matapelajaran as $mp)
                            <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group {{ $errors->has('nilai') ? 'has-error' : '' }}">
                        <label for="nilai">Nilai</label>
                        <input name="nilai" type="number" class="form-control" id="" aria-describedby="emailHelp"
                            placeholder="Nilai" value="{{ old('nilai') }}">
                        @if($errors->has('nilai'))
                        <span class="help-block">{{ $errors->first('nilai') }}</span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of modal --}}
@endsection