<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeran extends Model
{
    use HasFactory;

    protected $table = 'pemeran';

    protected $fillable = ['nama_pemeran'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_pemeran', 'id_pemeran', 'id_film');
    }
}
