@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-6">
                    <h1>Edit Data</h1>
                </div>

                <div class="col-lg-12">
                    <form action="/siswa/{{$siswa->id}}/update" method="POST"> {{-- route --}}
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Depan</label>
                        <input name="nama_depan" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Depan"
                        value="{{$siswa->nama_depan}}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Belakang</label>
                            <input name="nama_belakang" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Nama Belakang"
                            value="{{$siswa->nama_belakang}}">
                        </div>
                        <div class="form-group">
                            <label for="">Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="">
                                <option value="L" @if ($siswa->jenis_kelamin == 'L')
                                    selected
                                @endif>Laki-laki</option>
                                <option value="P" @if ($siswa->jenis_kelamin == 'P')
                                    selected
                                @endif>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Agama</label>
                            <input name="agama" type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Agama"
                            value="{{$siswa->agama}}">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="alamat" class="form-control" id="" rows="3">{{$siswa->alamat}}</textarea>
                        </div>
                        <a href={{ url("/siswa") }} class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
@endsection