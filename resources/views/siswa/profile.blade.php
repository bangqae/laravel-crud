@extends('layouts.master')

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
                  <img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar" height="90px">
                  <h3 class="name">{{$siswa->nama_depan}}&nbsp;{{$siswa->nama_belakang}}</h3>
                  <span class="online-status status-available">Available</span>
                </div>
                <div class="profile-stat">
                  <div class="row">
                    <div class="col-md-4 stat-item">
                      {{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
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
                    {{-- <li>Kelamin <span>{{$siswa->jenis_kelamin}}</span></li> --}}
                    {{-- <li>Email <span>{{$siswa->email}}</span></li> --}}
                    <li>Kelamin <span>{{$siswa->jenis_kelamin === 'L' ? 'Laki-laki':'Perempuan'}}</span></li>
                    <li>Alamat <span>{{$siswa->alamat}}</span></li>
                    <li>Agama <span>{{$siswa->agama}}</span></li>
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

                      @foreach ($siswa->mapel as $mapel)

                      <tr>
												<td>{{$mapel->kode}}</td>
												<td>{{$mapel->nama}}</td>
												<td>{{$mapel->semester}}</td>
												<td>{{$mapel->pivot->nilai}}</td>
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
@endsection