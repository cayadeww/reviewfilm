<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Rating;
use App\Models\Komen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UdashboardController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('user.dashboard', compact('films'));
    }
    public function show($id)
    {
        $film = Film::findOrFail($id);

        // Menghitung rata-rata rating
        $averageRating = Rating::where('id_film', $id)->avg('rating');

        // Mengambil semua komentar
        $komentar = Komen::where('id_film', $id)->with('user')->latest()->get();

        // Cek apakah user sudah memberi rating
        $userHasRated = false;
        if (Auth::check()) {
            $userHasRated = Rating::where('id_film', $id)
                                  ->where('id_users', Auth::id())
                                  ->exists();
        }

        return view('user.detail', compact('film', 'averageRating', 'komentar', 'userHasRated'));
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
