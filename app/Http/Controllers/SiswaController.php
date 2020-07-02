<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // Supaya bisa pake helper Str::random

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_siswa = \App\Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        } else {
            $data_siswa = \App\Siswa::all();
        }
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nama_depan' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'avatar' => 'image|mimes:jpeg,png',
        ]);
        
        // Insert ke tabel users
        $user = new  \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60);
        $user->save();
        
        // Insert ke tabel siswa
        // Bagian ini diletakkan di bawah agar
        // field user_id di tabel siswa mendapat nilai dari id di tabel user
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());

        // Insert gambar
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('sukses','Data berhasil diinput!');
    }

    public function edit($id)
    {
        $siswa = \App\Siswa::find($id);
        return view('siswa.edit',['siswa' => $siswa]);
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data berhasil diupdate!');
    }

    public function delete($id) 
    {
        $siswa = \App\Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('sukses','Data berhasil didelete!');
    }

    public function profile($id)
    {
        $siswa = \App\Siswa::find($id);
        $matapelajaran = \App\Mapel::all();
        //dd($matapelajaran);
        return view('siswa.profile',['siswa' => $siswa,'matapelajaran' => $matapelajaran]);
    }

    public function addnilai(Request $request, $idsiswa) //$idsiswa disini maksudnya id siswa yg di url, bisa juga ditulis $id
    {
        //dd($request->all());
        $siswa = \App\Siswa::find($idsiswa);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists())
        {
            return redirect('siswa/'.$idsiswa.'/profile')->with('error','Nilai sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);

        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Nilai tersimpan!');
    }
}
