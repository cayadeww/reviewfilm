<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::all(); // Ambil semua data genre
        
        if ($request->ajax()) {
            return response()->json($genres);
        }
    
        return view('admin.film.index', compact('genres')); // Kirim data ke Blade
    }

    public function getAllGenres()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama_genre' => 'required|string|max:255',
        ]);

        Genre::create([
            'nama_genre' => $request->nama_genre,
        ]);

        return redirect()->route('admin.film.index')->with('success', 'Genre berhasil ditambahkan!');
    }
}
