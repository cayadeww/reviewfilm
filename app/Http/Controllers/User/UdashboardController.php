<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use App\Models\Kategori;
use App\Models\Rating;
use App\Models\Komen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UdashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::query();
    
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('genre')) {
            $query->whereHas('genre', function ($q) use ($request) {
                $q->where('id', $request->genre);
            });
        }
        
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
    
        $films = $query->get();
        $genres = Genre::all();
        $kategoris = Kategori::all();
        
        return view('user.dashboard', compact('films', 'genres', 'kategoris'));
    }

    public function show($id)
    {
        $film = Film::with(['genre', 'kategori', 'komens.user'])->findOrFail($id);
        $komentar = $film->komens()->latest()->get();
        $averageRating = $film->ratings()->avg('rating');
        
        $url_trailer = $film->url_trailer;
        $embed_url = $url_trailer;
    
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url_trailer, $match)) {
            $embed_url = "https://www.youtube.com/embed/" . $match[1];
        } elseif (preg_match('/youtube\.com\/watch\\?v=([a-zA-Z0-9_-]+)/', $url_trailer, $match)) {
            $embed_url = "https://www.youtube.com/embed/" . $match[1];
        }
    
        $userHasRated = Rating::where('id_film', $id)->where('id_users', Auth::id())->exists();
    
        return view('user.detail', compact('film', 'komentar', 'averageRating', 'embed_url', 'userHasRated'));
    }

    public function storeRating(Request $request, $film_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komen' => 'required|string|max:500',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk memberi rating!');
        }

        if (Rating::where('id_film', $film_id)->where('id_users', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memberi rating untuk film ini!');
        }

        Rating::create([
            'id_film' => $film_id,
            'id_users' => Auth::id(),
            'rating' => $request->rating,
        ]);

        Komen::create([
            'id_film' => $film_id,
            'id_users' => Auth::id(),
            'komen' => $request->komen,
        ]);

        return redirect()->back()->with('success', 'Rating dan komentar berhasil dikirim!');
    }
}
