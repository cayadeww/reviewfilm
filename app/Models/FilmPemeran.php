<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmPemeran extends Model
{
    use HasFactory;

    protected $table = 'film_pemeran';

    protected $fillable = ['id_film', 'nama', 'pemeran']; // Sesuai dengan kolom di tabel film_pemeran

    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }
}
