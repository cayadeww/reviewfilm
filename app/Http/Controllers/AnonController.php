<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kategori;
use App\Models\Komen;
use App\Models\Rating;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class AnonController extends Controller
{
    // Menampilkan halaman utama dengan daftar film
    public function index(Request $request)
    {
       
        $query = Film::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('genre') && $request->genre != '') {
            $query->whereHas('genre', function ($q) use ($request) {
                $q->where('id_genre', $request->genre);
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('id_kategori', $request->kategori);
        }

        $films = $query->paginate(10);

        // Jika tidak ada filter, tampilkan semua data
        if (!$request->has('search') && !$request->has('genre') && !$request->has('kategori')) {
            $films = Film::paginate(10);
        }

        $genres = Genre::all();
        $kategoris = Kategori::all();
        return view('welcome', compact('films', 'genres', 'kategoris'));
    }

    // Menampilkan detail film
    public function show($id)
    {
        $film = Film::with('genre')->findOrFail($id);
        $komentar = $film->komens()->latest()->get();
        $averageRating = $film->ratings()->avg('rating');
        
        // Konversi URL YouTube ke format embed
        $url_trailer = $film->url_trailer;
        $embed_url = $url_trailer;
    
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url_trailer, $match)) {
            $embed_url = "https://www.youtube.com/embed/" . $match[1];
        } elseif (preg_match('/youtube\.com\/watch\\?v=([a-zA-Z0-9_-]+)/', $url_trailer, $match)) {
            $embed_url = "https://www.youtube.com/embed/" . $match[1];
        }
    
        return view('detail', compact('film', 'komentar', 'averageRating', 'embed_url'));
    }
    public function storeRating(Request $request, $film_id)
    {
        $request->validate([
            'rating' => 'required|in:1,2,3,4,5',
            'komen' => 'required|string|max:500',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk memberi rating!');
        }

        // Cek apakah user sudah memberi rating
        if (Rating::where('id_film', $film_id)->where('id_users', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memberi rating untuk film ini!');
        }

        // Simpan rating
        Rating::create([
            'id_film' => $film_id,
            'id_users' => Auth::id(),
            'rating' => $request->rating,
        ]);

        // Simpan komentar
        Komen::create([
            'id_film' => $film_id,
            'id_users' => Auth::id(),
            'komen' => $request->komen,
        ]);

        return redirect()->back()->with('success', 'Rating dan komentar berhasil dikirim!');
    }
}

