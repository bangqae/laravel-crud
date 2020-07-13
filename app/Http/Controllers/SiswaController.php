<?php
//Semua data yang tampil pada view, disiapkan di controller
namespace App\Http\Controllers;

use App\Siswa; //$siswa = App\Siswa::find($idsiswa);
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Supaya bisa pake helper Str::random
use App\Exports\SiswaExport; // File export laravel-excel
use Maatwebsite\Excel\Facades\Excel; // Package laravel-excel
use PDF; // Facade PDF di app.php

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $data_siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        } else {
            $data_siswa = Siswa::all();
        }
        // return view('siswa.index',['data_siswa' => $data_siswa]);
        return view('siswa.index', compact('data_siswa'));
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
        $siswa = Siswa::create($request->all());

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
        $siswa = Siswa::find($id);
        // return view('siswa.edit', ['siswa' => $siswa]);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $siswa = Siswa::find($id);
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
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect('/siswa')->with('sukses','Data berhasil didelete!');
    }

    public function profile($id)
    {
        $siswa = Siswa::find($id);
        //dd($siswa);
        $matapelajaran = \App\Mapel::all();
        //dd($matapelajaran);
        // Menyiapkan data untuk chart
        $categories = [];
        $data = [];

        foreach ($matapelajaran as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }
        //dd($data);
        //dd($catergories);
        //return view('siswa.profile',['siswa' => $siswa, 'matapelajaran' => $matapelajaran, 'categories' => $categories, 'data' => $data]);
        return view('siswa.profile', compact('siswa', 'matapelajaran', 'categories', 'data'));
    }

    public function addnilai(Request $request, $idsiswa) //$idsiswa disini maksudnya id siswa yg di url, bisa juga ditulis $id
    {
        //dd($request->all());
        $siswa = Siswa::find($idsiswa);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists())
        {
            return redirect('siswa/'.$idsiswa.'/profile')->with('error','Nilai sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai]);
        return redirect('siswa/'.$idsiswa.'/profile')->with('sukses','Nilai tersimpan!');
    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = Siswa::find($idsiswa);
        // Perintah detach untuk melepaskan pivotnya
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses', 'Data berhasil dihapus');
    }

    public function exportExcel() 
    {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }
    
    public function exportPdf() 
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadView('export.siswapdf', compact('siswa'));
        return $pdf->download('siswa.pdf');
    }

    public function siswapdf()
    {
        $siswa = Siswa::all();
        return view('export.siswapdf', compact('siswa'));
    }
}
