@extends('layouts.master')

@section('header')
<title>Siswa</title>
@endsection

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

                            </div>
                        </div>
                        <div class="panel-body ">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="/siswa/siswapdf" target="_blank" class="btn btn-primary btn-block" type="">
                                        <span class="lnr lnr-eye"></span>
                                        &nbsp; Preview PDF</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="/siswa/exportpdf" class="btn btn-primary btn-block" type="">Export Siswa
                                        PDF</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="/siswa/exportexcel" class="btn btn-primary btn-block" type="">Export Siswa
                                        Excel</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="" class="btn btn-light btn-block" data-toggle="modal"
                                        data-target="#exampleModal" type=""><i class="fa fa-plus-square"></i>&nbsp;
                                        Tambah
                                        Data </i></a>
                                </div>
                            </div>
                            {{-- <p class="demo-button">
                                <a href="/siswa/siswapdf" target="_blank" class="btn btn-primary" type="">
                                    <span class="lnr lnr-eye"></span>
                                    &nbsp; Preview PDF</a>
                                <a href="/siswa/exportpdf" class="btn btn-primary" type="">Export Siswa
                                    PDF</a>
                                <a href="/siswa/exportexcel" class="btn btn-primary" type="">Export Siswa
                                    Excel</a>
                                <a href="" class="btn btn-light" data-toggle="modal" data-target="#exampleModal"
                                    type=""><i class="fa fa-plus-square"></i>&nbsp; Tambah
                                    Data </i></a>
                            </p> --}}
                            <p class="demo-button">
                                <div class="table-responsive">
                                    {{-- Where datatable used --}}
                                    <table class="table table-hover" id="datatable">
                                        <thead>
                                            <tr>
                                                {{-- <th>No</th> --}}
                                                {{-- <th>Nama Depan</th> --}}
                                                <th>Nama Lengkap</th>
                                                <th>Kelamin</th>
                                                <th>Agama</th>
                                                <th style="width: 200px;">Alamat</th>
                                                <th>Rata-rata</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </p>
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
                            <input name="nama_depan" type="text" class="form-control" id="nama_depan"
                                aria-describedby="emailHelp" placeholder="Nama Depan" value="{{ old('nama_depan') }}">
                            @if($errors->has('nama_depan'))
                            <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id="nama_belakang"
                                aria-describedby="emailHelp" placeholder="Nama Belakang"
                                value="{{ old('nama_belakang') }}">
                        </div>

                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="">Email</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                        <label for="">Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
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
                        <input name="agama" type="text" class="form-control" id="agama" aria-describedby="emailHelp"
                            placeholder="Agama" value="{{ old('agama') }}">
                        @if($errors->has('agama'))
                        <span class="help-block">{{ $errors->first('agama') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" rows="2">{{ old('alamat') }}</textarea>
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
@endsection

@section('footer')
<script>
    // document ready akan dijalankan ketika semua document sudah ter-load
    $(document).ready(function(){ 
        // Datatable
        $('#datatable').DataTable({
            processing:true,
            serverside:true,
            ajax:"{{route('ajax.get.data.siswa')}}", // Where the data retrieve
            columns:[
                // {data:'nama_depan',name:'nama_depan'},
                // {data:'nama_belakang',name:'nama_belakang'},
                {data:'nama_lengkap',name:'nama_lengkap'},
                {data:'jenis_kelamin',name:'jenis_kelamin'},
                {data:'agama',name:'agama'},
                {data:'alamat',name:'alamat'},
                {data:'rata2_nilai',name:'rata2_nilai'},
                {data:'aksi',name:'aksi'},
            ],
        });
        
        // Swal
        // $('.delete').click(function(){
        $('body').on('click','.delete',function(){
            var siswa_id = $(this).attr('siswa-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/siswa/"+ siswa_id +"/delete";
                }
            });
        }); 
    });
</script>
@stop

{{-- Gak dipake --}}
@section('contentbackup')
@if(session('sukses'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('sukses') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{{-- Looping tabel siswa dengan pagination bawaan dan js datatables.net --}}
@foreach($data_siswa as $siswa)
<tr>
    {{-- Custom Helper num_row, prepared in controller--}}
    {{-- <td>{{ $num++ }}</td> --}}
    <td>{{ $loop->iteration }}</td>
    <td><a href="/siswa/{{ $siswa->id }}/profile">{{ $siswa->nama_depan }}</a>
    </td>
    <td><a href="/siswa/{{ $siswa->id }}/profile">{{ $siswa->nama_belakang }}</a>
    </td>
    <td>{{ $siswa->jenis_kelamin }}</td>
    <td>{{ $siswa->agama }}</td>
    <td style="width:250px">{{ $siswa->alamat }}</td>
    {{-- Untuk memanggil fungsi test harus di dalam objek siswa --}}
    <td>{{ $siswa->rataRataNilai() }}</td>
    <td style="width:150px">
        {{-- <a href="/siswa/{{ $siswa->id }}/edit" --}}
        <a href={{ url("/siswa/{$siswa->id}/edit") }} class="btn btn-warning btn-sm">Edit</a>
        <a href="#" class="btn btn-danger btn-sm delete" siswa-id="{{ $siswa->id }}">Delete</a>
    </td>
</tr>
@endforeach

{{-- Pagination bawaan laravel, letakkan diluar tag table --}}
{{-- {{ $data_siswa->links() }} --}}





@endsection
