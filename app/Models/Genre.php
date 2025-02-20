<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    
    protected $table = 'genre'; // Pastikan nama tabel sesuai dengan database
    protected $fillable = ['nama_genre'];


    public function film(){
        return $this->hasMany(Film::class);
    }
}
