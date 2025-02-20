<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all(); // Ambil semua data kategori
        
        if ($request->ajax()) {
            return response()->json($kategoris);
        }
    
        return view('admin.film.index', compact('kategoris')); // Kirim data ke Blade
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.film.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
}
