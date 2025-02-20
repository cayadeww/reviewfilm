<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';

    protected $fillable = [
        'id_users',
        'judul',
        'sinopsis', 
        'url_trailer', 
        'tahun_rilis', 
        'durasi', 
        'gambar',
        'sutradara',
        'id_genre',
        'id_kategori'

    ];

    // Relasi ke pengguna (user)
    public function users()
    {
        return $this->belongsTo(User::class, 'id_users'); // id_users adalah foreign key di tabel films
    }

    // Relasi ke Film_Genre (genre film)
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'id_genre', 'id'); 
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

//     public function FilmPemeran()
// {
//     return $this->hasMany(FilmPemeran::class, 'id');
// }

}
