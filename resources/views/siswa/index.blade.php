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
                      <th>Nama Depan</th>
                      <th>Nama Belakang</th>
                      <th>Kelamin</th>
                      <th>Agama</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  @foreach ($data_siswa as $siswa)
                  <tr>
                    <td>{{$siswa->nama_depan}}</td>
                    <td>{{$siswa->nama_belakang}}</td>
                    <td>{{$siswa->jenis_kelamin}}</td>
                    <td>{{$siswa->agama}}</td>
                    <td>{{$siswa->alamat}}</td>
                    <td>
                        <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')">Delete</a>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="panel-title" id="exampleModalLabel">Tambah Data</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                    {{-- <span aria-hidden="true">&times;</span> --}}
                {{-- </button> --}}
            </div>
                <div class="modal-body">
                     <form action="/siswa/create" method="POST"> {{-- route --}}
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Depan</label>
                            <input name="nama_depan" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Depan">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Belakang">
                        </div>
                        <div class="form-group">
                            <label for="">Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="">
                                <option selected value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Agama</label>
                            <input name="agama" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Agama">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="alamat" class="form-control" id="" rows="2"></textarea>
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

@section('content1')
            @if (session('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('sukses') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    <h1>Data Siswa</h1>
                </div>

                <div class="col-6">
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-primary btn-sm float-right mt-3" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data
                    </button>
                </div>
                {{-- {{ dd($data_siswa) }} --}}
                <div class="col-12 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Kelamin</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        
                        @foreach ($data_siswa as $siswa)
                        <tr>
                            <td>{{$siswa->nama_depan}}</td>
                            <td>{{$siswa->nama_belakang}}</td>
                            <td>{{$siswa->jenis_kelamin}}</td>
                            <td>{{$siswa->agama}}</td>
                            <td>{{$siswa->alamat}}</td>
                            <td>
                                <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')">Delete</a>
                            </td>
                        </tr>    
                        @endforeach
                        
                    </table>
                </div>
            </div>
            {{-- Modal delete data (Homework) --}}
@endsection
