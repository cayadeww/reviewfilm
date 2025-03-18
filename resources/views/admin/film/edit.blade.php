<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Edit Film</h3>
                <form action="{{ route('film.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ $film->judul }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="sinopsis" class="block text-gray-700">Sinopsis</label>
                        <textarea name="sinopsis" id="sinopsis" class="w-full px-4 py-2 border rounded-md" required>{{ $film->sinopsis }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="url_trailer" class="block text-gray-700">URL Trailer</label>
                        <input type="url" name="url_trailer" id="url_trailer" value="{{ $film->url_trailer }}" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    
                    <div class="mb-4">
                        <label for="tahun_rilis" class="block text-gray-700">Tahun Rilis</label>
                        <input type="number" name="tahun_rilis" id="tahun_rilis" value="{{ $film->tahun_rilis }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="durasi" class="block text-gray-700">Durasi (menit)</label>
                        <input type="number" name="durasi" id="durasi" value="{{ $film->durasi }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="sutradara" class="block text-gray-700">Sutradara</label>
                        <input type="text" name="sutradara" id="sutradara" value="{{ $film->sutradara }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="gambar" class="block text-gray-700">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2 border rounded-md" accept="image/*">
                        <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="mt-2" style="width: 100px; height: auto;">
                    </div>
                    
                    <div class="mb-4">
                        <label for="id_genre" class="block text-gray-700">Genre</label>
                        <select name="id_genre" id="id_genre" class="w-full px-4 py-2 border rounded-md" required>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $film->id_genre == $genre->id ? 'selected' : '' }}>{{ $genre->nama_genre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="id_kategori" class="block text-gray-700">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="w-full px-4 py-2 border rounded-md" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $film->id_kategori == $kategori->id ? 'selected' : '' }}>{{ $kategori->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.film.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded-md">Batal</a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
