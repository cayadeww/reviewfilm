<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FilmPemeran;
use App\Models\Film;

class FilmPemeranController extends Controller
{
    // Menampilkan daftar film dan form tambah pemeran
    public function index()
    {
        $films = Film::all();
        $pemerans = FilmPemeran::with('film')->get();
        return view('admin.film.index', compact('films', 'pemerans'));
    }



    public function store(Request $request)
    {
        // Validasi dan simpan data
        $request->validate([
            'id_film' => 'required',
            'nama.*' => 'required|string',
            'pemeran.*' => 'required|string',
        ]);
    
        // Simpan data pemeran
        foreach ($request->nama as $key => $nama) {
            FilmPemeran::create([
                'id_film' => $request->id_film,
                'nama' => $nama,
                'pemeran' => $request->pemeran[$key],
            ]);
        }
    
        // Redirect ke halaman admin.film.index
        return redirect()->route('admin.film.index')->with('success', 'Pemeran berhasil ditambahkan.');
    }
    
    
    // Menghapus pemeran tertentu
    public function destroy($id)
    {
        $pemeran = FilmPemeran::findOrFail($id);
        $pemeran->delete();

        return response()->json();
    }
}
