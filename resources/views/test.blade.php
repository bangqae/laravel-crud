{{-- Part 35 --}}

{{-- 1 --}}
{{-- @foreach ($siswa as $s)
<li>{{$s->nama_depan}}</li>
@endforeach --}}

{{-- 2 --}}
{{-- {{$siswa->nama_depan}} --}}

{{-- {{dd($siswa)}} --}}

@foreach ($siswa as $s)
<li>{{$s->user->name}}</li>
@endforeach
