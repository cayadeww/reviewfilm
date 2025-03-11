<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komen extends Model
{
    use HasFactory;

    protected $table = 'komens';
    protected $fillable = ['id_film', 'id_users', 'komen'];

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
    
    // Validasi agar komentar hanya bisa dibuat jika ada rating
    public static function boot()
    {
        parent::boot();

        static::creating(function ($komen) {
            $hasRating = Rating::where('id_film', $komen->id_film)
                                ->where('id_users', $komen->id_users)
                                ->exists();
            if (!$hasRating) {
                throw new \Exception('Kamu harus memberikan rating sebelum mengomentari film ini.');
            }
        });
    }
}
