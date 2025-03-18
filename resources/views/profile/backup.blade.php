<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Film') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4 space-x-2">
                <div class="flex items-center space-x-2">
                    <button onclick="openAddGenreModal()" class="bg-purple-500 text-white hover:bg-purple-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                        Tambah Genre
                    </button>
                    <button onclick="showAllGenre()" class="text-gray-600 hover:text-gray-800 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            
                <div class="flex items-center space-x-2">
                    <button onclick="openAddCategoryModal()" class="bg-purple-700 text-white hover:bg-purple-800 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                        Tambah Kategori
                    </button>
                    <button onclick="showAllKategoris()" class="text-gray-600 hover:text-gray-800 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            
                <button onclick="openAddFilmModal()" class="bg-pink-500 text-white hover:bg-pink-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                    Tambah Film
                </button>
            
                <button onclick="openAddFilmPemeranModal()" class="bg-blue-700 text-white px-4 py-2 rounded">
                    Tambah Pemeran
                </button>
            </div>
            
            <table class="w-full mt-8 border border-gray-400 rounded-lg shadow-lg table-auto">
                <thead class="bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                    <tr>
                        <th class="border border-gray-400 px-4 py-2">ID</th>
                        <th class="border border-gray-400 px-4 py-2">Judul</th>
                        <th class="border border-gray-400 px-4 py-2">Genre</th>
                        <th class="border border-gray-400 px-4 py-2">Kategori</th>
                        <th class="border border-gray-400 px-4 py-2">Gambar</th> 
                        <th class="border border-gray-400 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($films as $film)
                    <tr>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->id }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->judul }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->genre->nama_genre }}</td>
                         <td class="border border-gray-400 px-6 py-4 text-center">{{ $film->kategori->kategori }}</td>
                         <td class="border border-gray-400 px-6 py-4 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" style="width: 50px; height: auto;">
                        </td>
                        <td class="border border-gray-400 px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('film.show', $film->id) }}" 
                                   class="flex items-center bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                                    Detail
                                </a>
                                
                                <button class="flex items-center bg-purple-500 text-white hover:bg-purple-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                                    Edit
                                </button>
                                
                                <form action="{{ route('film.destroy', $film->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method ('DELETE')
                                    <button class="flex items-center bg-pink-500 text-white hover:bg-pink-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </div>
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
    </div>
<!-- Modal Tambah Pemeran -->
<div id="addFilmPemeranModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Tambah Pemeran Film</h3>
        <form id="filmPemeranForm"action="{{ route('pemeran.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_film" class="block text-gray-700">Pilih Film</label>
                <select name="id_film" id="id_film" class="w-full px-4 py-2 border rounded-md">
                    @foreach($films as $film)
                        <option value="{{ $film->id }}">{{ $film->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div id="pemeranContainer">
                <div class="mb-4 pemeran-input">
                    <label for="nama_pemeran" class="block text-gray-700">Nama Pemeran</label>
                    <input type="text" name="nama_pemeran[]" class="w-full px-4 py-2 border rounded-md" required>
                </div>
            </div>

            <button type="button" onclick="addPemeranInput()" class="bg-blue-500 text-white px-2 py-1 rounded">+ Tambah Pemeran</button>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeAddFilmPemeranModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Popup -->
<div id="genreModal" class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-xl font-bold">Detail Genre</h2>
        <p id="genreName" class="text-lg mt-2"></p>
        <button onclick="closeModal()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Tutup</button>
    </div>
</div>

<script>
    function showGenre() {
        fetch('/genre')
            .then(response => response.json())
            .then(data => {
                let genreList = document.getElementById('genreList');
                genreList.innerHTML = ''; // Kosongkan daftar sebelum diisi ulang

                data.forEach(genre => {
                    let li = document.createElement('li');
                    li.textContent = genre.nama_genre; // Ambil nama genre
                    genreList.appendChild(li);
                });

                // Tampilkan modal
                document.getElementById('genreModal').classList.remove('hidden');
            });
    }

    function closeModal() {
        document.getElementById('genreModal').classList.add('hidden');
    }

    function openAddGenreModal() {
        document.getElementById('addGenreModal').classList.remove('hidden');
    }
    function closeAddGenreModal() {
        document.getElementById('addGenreModal').classList.add('hidden');
    }
    function openAddFilmPemeranModal() {
        document.getElementById('addFilmPemeranModal').classList.remove('hidden');
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
    function openAddFilmPemeranModal() {
        document.getElementById('addFilmPemeranModal').classList.remove('hidden');
    }
    
    function closeAddFilmPemeranModal() {
        document.getElementById('addFilmPemeranModal').classList.add('hidden');
    }
    
    function addPemeranInput() {
        let container = document.getElementById('pemeranContainer');
        let div = document.createElement('div');
        div.classList.add('flex', 'space-x-2', 'mb-2');
        div.innerHTML = `
            <input type="text" name="pemeran[]" class="w-full p-2 border rounded">
            <button type="button" onclick="removePemeranInput(this)" class="bg-red-500 text-white px-2 py-1 rounded">-</button>
        `;
        container.appendChild(div);
    }
    
    function removePemeranInput(button) {
        button.parentElement.remove();
    }


    function openModal(title, content) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalContent').innerHTML = content;
        document.getElementById('dataModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('dataModal').classList.add('hidden');
    }

</script>
</x-app-layout>
