<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class UdashboardController extends Controller
{
    public function index(){
        $films = Film::all();
        return view('user.dashboard', compact('films'));
    }   
    
    public function show($id)
    {
        $film = Film::findOrFail($id); // Pastikan hanya satu film yang dipanggil
        return view('user.detail', compact('film'));
    }
    

}
