<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardadmin(){

        $totalUsers = User::where('role', 'user')->count();
        $totalAuthors = User::where('role', 'author')->count();
        $totalFilms = Film::count();
        return view('admin.dashboard', compact('totalUsers', 'totalAuthors', 'totalFilms'));
    }
    public function dashboardauthor(){

        return view('author.dashboard');
    }
}
