<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';
    protected $fillable = ['id_film', 'id_users', 'rating'];

    // Relasi ke Film
    public function film()
    {
        return $this->belongsTo(Film::class, 'id_film');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
