<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('author/dashboard'); // referring to the blade view 'resources/views/author/dashboard.blade.php'
    }

}
