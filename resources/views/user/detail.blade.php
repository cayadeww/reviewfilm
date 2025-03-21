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
                @if ($film->url_trailer)
                <div class="mt-6" x-data="{ open: false, embedUrl: '' }">
                    <button @click="open = true; embedUrl = '{{ $embed_url }}?autoplay=1&rel=0'" 
                        class="flex items-center space-x-2 bg-pink-600 text-white px-5 py-3 rounded-lg hover:bg-pink-500 transition duration-300">
                        <span>🎬 Tonton Trailer</span>
                    </button>
                
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
                        <div class="relative w-full max-w-4xl bg-gradient-to-b from-purple-900 to-pink-900 rounded-lg shadow-lg overflow-hidden">
                            
                            <!-- Header Mirip Browser -->
                            <div class="flex items-center justify-between bg-pink-600 px-4 py-5">
                                <div class="flex space-x-2">
                                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                </div>
                                <!-- Tombol Close -->
                                <button @click="open = false; embedUrl = ''" 
                                    class="absolute top-2 right-2 text-gray-300 hover:text-white text-2xl transition duration-300">
                                    &times;
                                </button>
                            </div>
                    
                            <!-- Video Trailer -->
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
                
        @if (Auth::check() && !$userHasRated)
                <form action="{{ route('rating.store', $film->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mt-4">
                        <label for="rating" class="block font-semibold">Rating:</label>
                        <div id="rating-stars" class="flex space-x-2 mt-2">
                            <span class="star text-3xl cursor-pointer text-gray-400" data-value="1">★</span>
                            <span class="star text-3xl cursor-pointer text-gray-400" data-value="2">★</span>
                            <span class="star text-3xl cursor-pointer text-gray-400" data-value="3">★</span>
                            <span class="star text-3xl cursor-pointer text-gray-400" data-value="4">★</span>
                            <span class="star text-3xl cursor-pointer text-gray-400" data-value="5">★</span>
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
            
                    <div class="mt-4">
                        <label class="block font-semibold">Komentar:</label>
                        <textarea name="komen" rows="3" class="w-full border rounded px-3 py-2" required></textarea>
                    </div>
            
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                        Kirim
                    </button>
                </form>
            @else
                <p class="mt-4 text-gray-500">Anda sudah memberikan rating untuk film ini.</p>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
           let stars = document.querySelectorAll(".star");
           let ratingInput = document.getElementById("rating");

           if (stars.length > 0) { // Pastikan elemen ada sebelum diproses
               stars.forEach(star => {
                   star.addEventListener("click", function () {
                       let rating = this.getAttribute("data-value");
                       ratingInput.value = rating;

                       stars.forEach(s => {
                           s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= rating);
                           s.classList.toggle("text-gray-400", s.getAttribute("data-value") > rating);
                       });
                   });
               });

               let savedRating = ratingInput.value;
               if (savedRating > 0) {
                   stars.forEach(s => {
                       s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= savedRating);
                       s.classList.toggle("text-gray-400", s.getAttribute("data-value") > savedRating);
                   });
               }
           }
       });
   </script>  
</x-app-layout>
