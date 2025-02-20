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

    
    // Menyimpan pemeran baru
    public function store(Request $request)
    {

        
        $request->validate([
            'id_film' => 'required|exists:films,id',
            'nama_pemeran' => 'required|array',
            'nama_pemeran.*' => 'required|string|max:255'
        ]);

        foreach ($request->nama_pemeran as $nama) {
            FilmPemeran::create([
                'id_film' => $request->id_film,
                'nama_pemeran' => $nama
            ]);
        }

        return redirect()->route('admin.film.index')->with('success', 'Genre berhasil ditambahkan!');
    }

    // Menghapus pemeran tertentu
    public function destroy($id)
    {
        $pemeran = FilmPemeran::findOrFail($id);
        $pemeran->delete();

        return response()->json();
    }
}
