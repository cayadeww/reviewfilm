<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Gambar Film -->
            <div>
                <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="rounded-lg shadow-lg w-full">
            </div>

            <!-- Detail Film -->
            <div class="col-span-2 bg-white p-6 rounded-lg shadow">
                <h1 class="text-4xl font-bold text-gray-800">{{ strtoupper($film->judul) }}</h1>
                <p class="mt-3 text-gray-600 text-lg">{{ $film->sinopsis }}</p>
                
                <!-- Informasi Film -->
                <div class="mt-6 space-y-2 text-gray-700">
                    <p><strong>🎬 Genre:</strong> {{ $film->genre->nama_genre }}</p>
                    <p><strong>📌 Kategori:</strong> {{ $film->kategori->kategori }}</p>
                    @if ($averageRating)
                        <p><strong>⭐ IMDb:</strong> {{ number_format($averageRating, 1) }}/5</p>
                    @endif
                    <p><strong>🎥 Durasi:</strong> {{ floor($film->durasi / 60) }} jam {{ $film->durasi % 60 }} menit</p>
                </div> 
                
                <!-- Trailer -->
                @if ($film->url_trailer)
                <div class="mt-6" x-data="{ open: false }">
                    <button @click="open = true" class="flex items-center space-x-2 bg-blue-500 text-white px-5 py-3 rounded-lg hover:bg-blue-600">
                        <span>🎬 Tonton Trailer</span>
                    </button>
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
                        <div class="bg-white p-5 rounded-lg shadow-lg w-3/4 max-w-3xl relative">
                            <button @click="open = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe class="w-full h-96" src="{{ $embed_url }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Komentar & Rating -->
        <div class="max-w-6xl mx-auto px-6 mt-10 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold text-gray-800">Komentar & Rating</h2>
            @if ($komentar->count() > 0)
            <div class="mt-4 space-y-4">
                @foreach ($komentar as $komen)
                    <div class="bg-white p-4 rounded shadow">
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">{{ $komen->user->name  }}</span>
                        </div>
                        
                        <!-- Tampilkan rating yang diberikan oleh user -->
                        @php
                        $userRating = $komen->user->ratings()->where('id_film', $film->id)->first();
                    @endphp
                    
                        @if ($userRating)
                            <p class="mt-1 text-yellow-500 text-lg">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $userRating->rating ? 'text-yellow-500' : 'text-gray-400' }}">★</span>
                                @endfor
                                ({{ $userRating->rating }}/5)
                            </p>
                        @endif
    
                        <p class="mt-2 text-gray-700">{{ $komen->komen }}</p>
                        <p class="text-sm text-gray-400">{{ $komen->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="mt-2 text-gray-500">Belum ada komentar.</p>
        @endif
    </div>
    </div>
</x-app-layout>
