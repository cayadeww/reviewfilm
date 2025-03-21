<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    // Menampilkan semua film untuk admin
    public function adminIndex()
    {
        $films = Film::all(); // Menampilkan semua film
        $genres = Genre::all();
        $kategoris = Kategori::all();
        $openModal = true; // Atur sesuai kebutuhan Anda, bisa true atau false
    
        return view('admin.film.index', compact('films', 'genres', 'kategoris'));
    }
    
    public function show($id)
    {
        $film = Film::with(['genre', 'kategori','pemeran'])->findOrFail($id);
        return view('admin.film.show', compact('film'));
    }

    public function showModals()
    {
        $films = Film::with(['genre', 'kategori'])->get();
        $genres = Genre::all();
        $kategories = Kategori::all(); // Tambahkan ini jika belum ada
    
        return view('admin.film.modals', compact('films', 'genres', 'kategories'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $film = Film::findOrFail($id);
        $genres = Genre::all();
        $kategoris = Kategori::all();
        return view('admin.film.edit', compact('film', 'genres', 'kategoris'));
    }

    // Menyimpan film baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'sinopsis' => 'required',
            'url_trailer' => 'nullable|url',
            'tahun_rilis' => 'required|integer',
            'durasi' => 'required|integer',
            'sutradara' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
            'id_genre' => 'required',
            'id_kategori' => 'required',
        ]);

        $gambarPath = $request->file('gambar')->store('film_images', 'public');

        Film::create([
            'judul' => $request->judul,
            'sinopsis' => $request->sinopsis,
            'url_trailer' => $request->url_trailer,
            'tahun_rilis' => $request->tahun_rilis,
            'durasi' => $request->durasi,
            'sutradara' => $request->sutradara,
            'gambar' => $gambarPath,
            'id_genre' => $request->id_genre,
            'id_kategori' => $request->id_kategori,
            'id_users' => Auth::id(), // Menyimpan berdasarkan user yang sedang login
        ]);

        return redirect()->back()->with('success', 'Film berhasil ditambahkan!');
    }

    // Memperbarui film
    public function update(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'sinopsis' => 'required',
            'url_trailer' => 'nullable|url',
            'tahun_rilis' => 'required|integer',
            'durasi' => 'required|integer',
            'sutradara' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'id_genre' => 'required',
            'id_kategori' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            if ($film->gambar) {
                Storage::disk('public')->delete($film->gambar);
            }
            $film->gambar = $request->file('gambar')->store('film_images', 'public');
        }

        $film->update($request->except(['gambar']));

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil diperbarui!');
    }

    // Menghapus film
    public function destroy($id)
    {
        $film = Film::findOrFail($id);

        // Pastikan hanya pemilik atau admin yang bisa menghapus
        if (Auth::user()->role == 'admin' || $film->id_users == Auth::id()) {
            // Hapus gambar dari penyimpanan lokal
            if ($film->gambar) {
                if (Storage::exists('public/' . $film->gambar)) {
                    Storage::delete('public/' . $film->gambar);
                }
            }

            // Hapus data film dari database
            $film->delete();

            return redirect()->back()->with('success', 'Film berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus film ini!');
        }
    }
}
