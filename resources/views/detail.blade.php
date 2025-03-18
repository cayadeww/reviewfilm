<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<x-app-layout>
    <div class="py-12 bg-gray-100" x-data="{ openPopup: false }">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="rounded-lg shadow-lg w-full">
            </div>

            <div class="col-span-2 bg-white p-6 rounded-lg shadow">
                <h1 class="text-4xl font-bold text-gray-800">{{ strtoupper($film->judul) }}</h1>
                <p class="mt-3 text-gray-600 text-lg">{{ $film->sinopsis }}</p>
                
                <div class="mt-6 space-y-2 text-gray-700">
                    <p><strong>🎮 Genre:</strong> {{ $film->genre->nama_genre }}</p>
                    <p><strong>📌 Kategori:</strong> {{ $film->kategori->kategori }}</p>
                    @if ($averageRating)
                        <p><strong>⭐ IMDb:</strong> {{ number_format($averageRating, 1) }}/5</p>
                    @endif
                    <p><strong>🎥 Durasi:</strong> {{ floor($film->durasi / 60) }} jam {{ $film->durasi % 60 }} menit</p>
                </div>

                @if ($film->url_trailer)
                <div class="mt-6" x-data="{ open: false, embedUrl: '' }">
                    <button @click="open = true; embedUrl = '{{ $embed_url }}?autoplay=1&rel=0'" 
                        class="flex items-center space-x-2 bg-pink-600 text-white px-5 py-3 rounded-lg hover:bg-pink-500 transition duration-300">
                        <span>🎬 Tonton Trailer</span>
                    </button>
                
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
                        <div class="relative w-full max-w-4xl bg-gradient-to-b from-purple-900 to-pink-900 rounded-lg shadow-lg overflow-hidden">
                            <div class="flex items-center justify-between bg-pink-600 px-4 py-5">
                                <div class="flex space-x-2">
                                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                </div>
                                <button @click="open = false; embedUrl = ''" 
                                    class="absolute top-2 right-2 text-gray-300 hover:text-white text-2xl transition duration-300">
                                    &times;
                                </button>
                            </div>
                            <div class="relative w-full pt-[56.25%] bg-black">
                                <iframe class="absolute top-0 left-0 w-full h-full rounded-lg"
                                    :src="embedUrl"
                                    frameborder="0"
                                    allow="autoplay; encrypted-media"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                                <!-- Menampilkan Pemeran -->
                                <div class="mt-6">
                                    <h2 class="text-2xl font-semibold text-gray-800">Pemeran:</h2>
                                    <ul class="mt-2 space-y-2">
                                        @foreach ($film->pemeran as $pemeran)
                                            <li class="text-gray-700">
                                                <strong>{{ $pemeran->nama }}</strong> sebagai {{ $pemeran->pemeran }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                
                <!-- Rating dan Komentar -->
                <div class="mt-6">
                    <label class="block font-semibold">Rating:</label>
                    <div class="flex space-x-2 mt-2">
                        <template x-for="n in 5">
                            <span class="text-3xl cursor-pointer text-gray-400" :data-value="n" @click.prevent="openPopup = true">★</span>
                        </template>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold">Komentar:</label>
                    <textarea rows="3" class="w-full border rounded px-3 py-2" required @click.prevent="openPopup = true"></textarea>
                </div>

                <button class="mt-4 bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600" @click.prevent="openPopup = true">
                    Kirim
                </button>
            </div>
        </div>

        <!-- Pop-up Login -->
        <div x-show="openPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            <div class="bg-white p-5 rounded-lg shadow-lg w-80 text-center relative">
                <button @click="openPopup = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
                <p class="text-lg font-semibold">Anda harus login terlebih dahulu</p>
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Login</a>
                    <button @click="openPopup = false" class="ml-2 bg-gray-400 text-white px-4 py-2 rounded-lg">Batal</button>
                </div>
            </div>
        </div>

        <!-- Komentar dan Rating -->
        <div class="max-w-6xl mx-auto px-6 mt-10 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold text-gray-800">Komentar & Rating</h2>
            @if ($komentar->count() > 0)
            <div class="mt-4 space-y-4">
                @foreach ($komentar as $komen)
                    <div class="bg-white p-4 rounded shadow">
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold">{{ $komen->user->name }}</span>
                        </div>
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
