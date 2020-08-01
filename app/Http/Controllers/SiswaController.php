<?php
//Semua data yang tampil pada view, disiapkan di controller
namespace App\Http\Controllers;

use App\Siswa; //$siswa = App\Siswa::find($idsiswa);
use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Supaya bisa pake helper Str::random
use App\Exports\SiswaExport; // File export laravel-excel
use App\Imports\SiswaImport; // File import laravel-excel
use Maatwebsite\Excel\Facades\Excel; // Package laravel-excel
use PDF; // Facade PDF di app.php
// use DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // $limit = 20;
        // $num = num_row($request->input('page'), $limit); // Custom Helper num_row
        if($request->has('cari')){
            // Fungsi paginate digunakan untuk menggunakan pagination asli dari laravel
            // Jika ingin menggunakan datatable, jangan pakai paginate pada controller
            // $data_siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->paginate($limit);
            $data_siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->all();
        } else {
            // $data_siswa = Siswa::paginate($limit); 
            $data_siswa = Siswa::all();
        }
        // return view('siswa.index',['data_siswa' => $data_siswa]);
        // return view('siswa.index', compact('data_siswa','num'));
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

    public function edit(Siswa $siswa)
    {
        //dd($siswa);
        //$siswa = Siswa::find($id);
        // return view('siswa.edit', ['siswa' => $siswa]);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        // dd($request->all());
        $siswa->update($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses','Data berhasil diupdate!');
    }

    public function delete(Siswa $siswa) 
    {
        $siswa->mapel()->detach(); // Hapus relasi si siswa dengan mapel
        $siswa->delete();
        return redirect('/siswa')->with('sukses','Data berhasil didelete!');
    }

    public function profile(Siswa $siswa)
    {
        // dd($siswa);
        $matapelajaran = Mapel::all();
        // dd($matapelajaran);
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

    public function addnilai(Request $request, Siswa $siswa) // Route model binding
    {
        //dd($request->all());
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists())
        {
            return redirect('siswa/'.$siswa->id.'/profile')->with('error','Nilai sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        return redirect('siswa/'.$siswa->id.'/profile')->with('sukses','Nilai tersimpan!');
    }

    public function deletenilai(Siswa $siswa, $idmapel)
    {
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
  
    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*');

        return \DataTables::eloquent($siswa)
        ->addColumn('no', function($s){
            return $no = '0'; // Just passing a value to prevent error
        })
        ->addColumn('nama_lengkap', function($s){
            $profiletUrl = route('siswa.profile', $s->id);
            $nameLink = '<a href='.$profiletUrl.'>'.$s->namaLengkap().'</a>';
            return $nameLink;
        })
        ->addColumn('rata2_nilai', function($s){ // Disini $s adalah 1 row data siswa, sedangkan $siswa adalah seluruh data siswa
            return $s->rataRataNilai();
        })
        ->addColumn('aksi', function($s){
            $editUrl = route('siswa.edit', $s->id); // Advantage of using uses as route
            $button = '<a href='.$editUrl.' class="btn btn-warning btn-sm" style="margin-right:5px;margin-bottom:5px;">Edit</a>';
            $button .= '<a href="#" class="btn btn-danger btn-sm delete" siswa-id="'.$s->id.'" style="margin-right:5px;margin-bottom:5px;">Delete</a>';
            return $button;

        })
        ->rawColumns(['rata2_nilai','aksi','nama_lengkap','no'])
        ->toJson();
    }

    public function profilsaya()
    {
        $siswa = auth()->user()->siswa;
        $matapelajaran = Mapel::all();
        $categories = [];
        $data = [];

        foreach ($matapelajaran as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }
        return view('siswa.profilsaya', compact('siswa','matapelajaran', 'categories', 'data'));
    }

    public function importExcel(Request $request)
    {
        Excel::import(new SiswaImport, $request->file('data_siswa'));
        return redirect('siswa')->with('sukses','Data tersimpan!');
    }
}
