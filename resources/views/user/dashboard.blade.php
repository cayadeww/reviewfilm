<x-app-layout>
    {{-- <x-slot name="header"> --}}
        <form method="GET" action="{{ route('user.dashboard') }}" class="flex flex-wrap items-center gap-3 bg-white shadow-md p-4 rounded-lg">
            <input type="text" name="search" value="{{ request('search') }}" class="w-full md:w-1/3 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Cari judul...">
            
            <select name="genre" class="w-full md:w-1/4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->nama_genre }}</option>
                @endforeach
            </select>
    
            <select name="kategori" class="w-full md:w-1/4 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">Kategori Umur</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->kategori }}</option>
                @endforeach
            </select>
    
            <button type="submit" class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg transition duration-300">
                Cari
            </button>
        </form>
    {{-- </x-slot> --}}
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative">
                <div class="flex overflow-x-scroll hide-scrollbar space-x-4 p-4">
                    @foreach($films as $film)
                        <div class="min-w-[200px] max-w-[250px] flex-shrink-0">
                            <a href="{{ route('detail', $film->id) }}">
                                <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="rounded-lg shadow-lg w-full h-[350px] object-cover">
                            </a>
                            <p class="text-center font-semibold mt-2">{{ strtoupper($film->judul) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2">
                    <button class="bg-white p-2 rounded-full shadow-md">&#9665;</button>
                </div>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2">
                    <button class="bg-white p-2 rounded-full shadow-md">&#9655;</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
