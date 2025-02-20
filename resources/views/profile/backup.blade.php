<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Film') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <button onclick="openAddGenreModal()" class="bg-purple-500 text-white hover:bg-purple-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                    Tambah Genre
                </button>
                
                <button onclick="openAddCategoryModal()" class="bg-[#B6248D] text-white hover:bg-[#B6248D] px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                    Tambah Kategori
                </button>
                
                <button onclick="openAddFilmModal()" class="bg-pink-500 text-white hover:bg-pink-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                    Tambah Film
                </button>
            </div>
            <table class="w-full mt-8 border border-gray-400 rounded-lg shadow-lg table-auto">
                <thead class="bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                    <tr>
                        <th class="border border-gray-400 px-4 py-2">ID</th>
                        <th class="border border-gray-400 px-4 py-2">Judul</th>
                        <th class="border border-gray-400 px-4 py-2">Sinopsis</th>
                        <th class="border border-gray-400 px-4 py-2">URL Trailer</th>
                        <th class="border border-gray-400 px-4 py-2">Tahun Rilis</th>
                        <th class="border border-gray-400 px-4 py-2">Durasi</th>
                        <th class="border border-gray-400 px-4 py-2">Sutradara</th>
                        <th class="border border-gray-400 px-4 py-2">Genre</th>
                        <th class="border border-gray-400 px-4 py-2">Kategori</th>
                        <th class="border border-gray-400 px-4 py-2">Gambar</th> <!-- Kolom baru untuk gambar -->
                        <th class="border border-gray-400 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($films as $film)
                    <tr>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->id }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->judul }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->sinopsis }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">
                            @if($film->url_trailer)
                                <a href="{{ $film->url_trailer }}" target="_blank">Lihat Trailer</a>
                            @else
                                Tidak tersedia
                            @endif
                        </td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->tahun_rilis }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->durasi }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->sutradara }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->genre[0]->nama_genre }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->kategori->kategori }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">
                            <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" style="width: 100px; height: auto;">
                        </td>
                         <td class="border border-gray-400 px-6 py-4 text-center">
                            <button class="bg-purple-500 text-white hover:bg-purple-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150" data-toggle="modal" data-target="#editFilmModal" data-id="{{ $film->id }}" data-judul="{{ $film->judul }}" data-sinopsis="{{ $film->sinopsis }}" data-tahun="{{ $film->tahun_rilis }}" data-durasi="{{ $film->durasi }}" data-sutradara="{{ $film->sutradara }}" data-genre="{{ $film->id_genre }}" data-kategori="{{ $film->id_kategori }}" data-gambar="{{ $film->gambar }}">Edit</button>
                            <form action="{{ route('film.destroy', $film->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method ('DELETE')
                                <button class="bg-pink-500 text-white hover:bg-pink-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal Form Tambah Genre -->
            <div id="addGenreModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-purple-100 p-6 rounded-lg shadow-lg w-96">
                    <h3 class="text-xl font-semibold mb-4">Tambah Genre Baru</h3>
                    <form action="{{ route('genre.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="genre_name" class="block text-gray-700">Nama Genre</label>
                            <input type="text" name="nama_genre" id="genre_name" class="w-full px-4 py-2 border rounded-md" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeAddGenreModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Batal</button>
                            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Form Tambah Kategori -->
            <div id="addCategoryModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-pink-100 p-6 rounded-lg shadow-lg w-96">
                    <h3 class="text-xl font-semibold mb-4">Tambah Kategori Baru</h3>
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori" class="block text-gray-700">Kategori Umur</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeAddCategoryModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Batal</button>
                            <button type="submit" class="bg-[#B6248D] text-white px-4 py-2 rounded-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Tambah Film -->
<div id="addFilmModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-pink-100 p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Tambah Film Baru</h3>
        <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex space-x-4">
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul</label>
                <input type="text" name="judul" id="judul" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="sinopsis" class="block text-gray-700">Sinopsis</label>
                <textarea name="sinopsis" id="sinopsis" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            </div>
            <div class="mb-4 flex space-x-4">
            <div class="mb-4">
                <label for="url_trailer" class="block text-gray-700">URL Trailerr</label>
                <input type="url" name="url_trailer" id="url_trailer" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="tahun_rilis" class="block text-gray-700">Tahun Rilis</label>
                <input type="number" name="tahun_rilis" id="tahun_rilis" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            </div>
            <div class="mb-4">
                <label for="durasi" class="block text-gray-700">Durasi (menit)</label>
                <input type="number" name="durasi" id="durasi" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="sutradara" class="block text-gray-700">Sutradara</label>
                <input type="text" name="sutradara" id="sutradara" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
            </div>
            <div class="mb-4">
                <label for="id_genre" class="block text-gray-700">Genre</label>
                <select name="id_genre" id="id_genre" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <!-- Tambahkan opsi genre di sini -->
                    <option value="">Pilih Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->nama_genre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="id_kategori" class="block text-gray-700">Kategori</label>
                <select name="id_kategori" id="id_kategori" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <!-- Tambahkan opsi kategori di sini -->
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="id_users" value="{{ auth()->user()->id }}">
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeAddFilmModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">
                    Batal
                </button>
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    function openAddGenreModal() {
        document.getElementById('addGenreModal').classList.remove('hidden');
    }
    function closeAddGenreModal() {
        document.getElementById('addGenreModal').classList.add('hidden');
    }

    function openAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }
    function closeAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    
    function openAddFilmModal() {
        document.getElementById('addFilmModal').classList.remove('hidden');
    }
    function closeAddFilmModal() {
        document.getElementById('addFilmModal').classList.add('hidden');
    }

</script>

</x-app-layout>

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    // Menampilkan semua film untuk admin
    Route::get('/films', [FilmController::class, 'adminIndex'])->name('admin.film.index');
    // Rute untuk menyimpan film baru
    Route::post('/films', [FilmController::class, 'store'])->name('admin.film.store');
    // Rute untuk menghapus film
    Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('admin.film.destroy');
});

// Rute untuk author
Route::prefix('author')->middleware(['auth', 'role:author'])->group(function () {
    // Menampilkan film berdasarkan user yang login (author)
    Route::get('/films', [FilmController::class, 'authorIndex'])->name('author.film.index');
    // Rute untuk menyimpan film baru
    Route::post('/films', [FilmController::class, 'store'])->name('author.film.store');
    // Rute untuk menghapus film
    Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('author.film.destroy');
});