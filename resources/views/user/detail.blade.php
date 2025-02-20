<x-app-layout>
    <div class="max-w-6xl mx-auto py-12 px-6 text-white bg-black">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Gambar Film -->
            <div>
                <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="rounded-lg shadow-lg w-full">
            </div>

            <!-- Detail Film -->
            <div class="col-span-2">
                <h1 class="text-4xl font-bold">{{ strtoupper($film->judul) }}</h1>
                
                <div class="flex items-center space-x-2 mt-3">
                    <span class="bg-yellow-600 text-white px-3 py-1 rounded-md">XXI</span>
                    <span class="bg-red-600 text-white px-3 py-1 rounded-md">CGV</span>
                    <span class="bg-blue-600 text-white px-3 py-1 rounded-md">Cinépolis</span>
                </div>
    
                <p class="mt-5 text-lg">{{ $film->sinopsis }}</p>

                <!-- Tombol Trailer -->
                @if ($film->url_trailer)
                <div class="mt-6">
                    <a href="{{ $film->url_trailer }}" target="_blank" class="flex items-center space-x-2 bg-white text-black px-5 py-3 rounded-lg hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11.5v5l4-2.5-4-2.5z" clip-rule="evenodd" />
                        </svg>
                        <span>WATCH THE TRAILER</span>
                    </a>
                </div>
                @endif

                <!-- Informasi Film -->
                <div class="mt-6 flex items-center space-x-3 text-gray-400">
                    <span>{{ $film->durasi }} min</span>
                    <span>|</span>
                    <span>IMDB Rating: ⭐⭐⭐⭐☆</span>
                </div>

                <!-- Tombol Buy Tickets -->
                <div class="mt-6">
                    <button class="bg-yellow-500 text-black px-6 py-3 rounded-lg font-bold hover:bg-yellow-400">BUY TICKETS</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
