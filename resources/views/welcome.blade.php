<x-app-layout>
    <form method="GET" action="{{ route('home') }}" class="w-full max-w-7xl mx-auto bg-pink-100 shadow-md p-4 rounded-lg">
        <div class="flex flex-wrap md:flex-nowrap items-center gap-3">
    
            <input type="text" name="search" value="{{ request('search') }}" 
                class="flex-grow p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
                placeholder="Cari judul...">
            
            <div class="relative w-1/4 md:w-auto">
                <select name="genre"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 appearance-none bg-none">
                    <option value="">Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->nama_genre }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none"></div>
            </div>
            
            <div class="relative w-1/4 md:w-auto">
                <select name="kategori"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 appearance-none bg-none">
                    <option value="">Kategori Umur</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->kategori }}
                        </option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none"></div>
            </div>
    
            <button type="submit" 
                class="w-1/4 md:w-auto bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 px-5 rounded-md transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>                  
            </button>
        </div>
    </form>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="relative overflow-hidden">
                <div class="flex overflow-x-auto hide-scrollbar space-x-4 p-4">
                    @foreach($films as $film)
                        <div class="min-w-[220px] max-w-[250px] flex-shrink-0 relative group">
                            <a href="{{ route('anondetail', $film->id) }}">
                                <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="rounded-lg shadow-lg w-full h-[350px] object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                            <p class="text-center font-semibold mt-2 text-gray-800">{{ strtoupper($film->judul) }}</p>
    
                            <div class="absolute top-2 right-2 bg-white-100 text-white text-sm font-bold px-2 py-1 rounded-lg shadow-md">
                                ⭐ {{ number_format($film->ratings->avg('rating'), 1) }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2">
                    <button class="bg-gray-200 hover:bg-gray-300 p-3 rounded-full shadow-md transition">&#9665;</button>
                </div>
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2">
                    <button class="bg-gray-200 hover:bg-gray-300 p-3 rounded-full shadow-md transition">&#9655;</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
