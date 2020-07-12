@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Siswa</h3>
                            <div class="right">
                                {{-- Button trigger modal --}}
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                    <i class="lnr lnr-plus-circle"></i>&nbsp; Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Depan</th>
                                        <th>Nama Belakang</th>
                                        <th>Kelamin</th>
                                        <th>Agama</th>
                                        <th>Alamat</th>
                                        <th>Rata-rata</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                @foreach($data_siswa as $siswa)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="/siswa/{{ $siswa->id }}/profile">{{ $siswa->nama_depan }}</a>
                                    </td>
                                    <td><a href="/siswa/{{ $siswa->id }}/profile">{{ $siswa->nama_belakang }}</a>
                                    </td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td>{{ $siswa->agama }}</td>
                                    <td>{{ $siswa->alamat }}</td>
                                    {{-- Untuk memanggil fungsi test harus di dalam objek siswa --}}
                                    <td>{{ $siswa->rataRataNilai() }}</td>
                                    <td>
                                        <a href="/siswa/{{ $siswa->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="/siswa/{{ $siswa->id }}/delete" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin mau dihapus ?')">Delete</a>
                                    </td>

                                </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Modal add new data --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="panel-title" id="exampleModalLabel">Tambah Data</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                {{-- <span aria-hidden="true">&times;</span> --}}
                {{-- </button> --}}
            </div>
            <div class="modal-body">
                <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                    {{-- multipart/form-data allows user to upload a file --}}
                    @csrf

                    <div class="row">

                        <div class="col-md-6 form-group {{ $errors->has('nama_depan') ? 'has-error' : '' }}">
                            <label for="">Nama Depan</label>
                            <input name="nama_depan" type="text" class="form-control" id="" aria-describedby="emailHelp"
                                placeholder="Nama Depan" value="{{ old('nama_depan') }}">
                            @if($errors->has('nama_depan'))
                            <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id=""
                                aria-describedby="emailHelp" placeholder="Nama Belakang"
                                value="{{ old('nama_belakang') }}">
                        </div>

                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="">Email</label>
                        <input name="email" type="email" class="form-control" id="" aria-describedby="emailHelp"
                            placeholder="Email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                        <label for="">Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="">
                            <option selected value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @if($errors->has('jenis_kelamin'))
                        <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('agama') ? 'has-error' : '' }}">
                        <label for="">Agama</label>
                        <input name="agama" type="text" class="form-control" id="" aria-describedby="emailHelp"
                            placeholder="Agama" value="{{ old('agama') }}">
                        @if($errors->has('agama'))
                        <span class="help-block">{{ $errors->first('agama') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" id="" rows="2">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                        <label for="">Avatar</label>
                        <input type="file" name="avatar" id="avatar" value="">
                        @if($errors->has('avatar'))
                        <span class="help-block">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End of modal --}}
@stop

{{-- Gak dipake --}}
@section('content1')
@if(session('sukses'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('sukses') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
{{-- Modal delete data (Homework) --}}
@endsection