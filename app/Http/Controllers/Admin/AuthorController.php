<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::where('role', 'author')->get();
        return view('admin.author.index', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'author',
            'password' => Hash::make($request->password), // Hash password
        ]);
    
        return redirect()->back()->with('success', 'Author berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $author = User::findOrFail($id);
        return view('admin.author.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6'
        ]);
        
        $author = User::findOrFail($id);
        $author->name = $request->name;
        $author->email = $request->email;
        
        if ($request->filled('password')) {
            $author->password = Hash::make($request->password);
        }
        
        $author->save();
        
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');        
        
    }

    public function destroy($id)
    {
        // Menghapus user berdasarkan ID
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.author.index')->with('success', 'User berhasil dihapus!');
    }
}
