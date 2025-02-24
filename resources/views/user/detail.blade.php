<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<x-app-layout>
    <div class="py-12 bg-pink-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Gambar Film -->
            <div>
                <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}" class="rounded-lg shadow-lg w-full">
            </div>

            <!-- Detail Film -->
            <div class="col-span-2">
                <h1 class="text-4xl font-bold">{{ strtoupper($film->judul) }}</h1>
                <p class="mt-5 text-lg">{{ $film->sinopsis }}</p>

                <!-- Konversi URL YouTube ke format embed -->
                @php
                    $url_trailer = $film->url_trailer;
                    
                    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url_trailer, $match)) {
                        $embed_url = "https://www.youtube.com/embed/" . $match[1];
                    } elseif (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url_trailer, $match)) {
                        $embed_url = "https://www.youtube.com/embed/" . $match[1];
                    } else {
                        $embed_url = $url_trailer; // Jika bukan URL yang dikenali
                    }
                @endphp

                <!-- Tombol Trailer -->
                @if ($film->url_trailer)
                <div class="mt-6" x-data="{ open: false }">
                    <button @click="open = true" class="flex items-center space-x-2 bg-white text-black px-5 py-3 rounded-lg hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11.5v5l4-2.5-4-2.5z" clip-rule="evenodd" />
                        </svg>
                        <span>WATCH THE TRAILER</span>
                    </button>

                    <!-- Modal Trailer -->
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
                        <div class="bg-white p-5 rounded-lg shadow-lg w-3/4 max-w-3xl relative">
                            <button @click="open = false" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe class="w-full h-96"
                                    src="{{ $embed_url }}"
                                    frameborder="0"
                                    allowfullscreen
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Informasi Film -->
                <div class="mt-6 flex items-center space-x-3 text-black-400">
                    <span>{{ $film->durasi }} min</span>
                    <span>|</span>
                    <span>
                    @if ($averageRating)
                        IMDB Rating: <span class="text-yellow-500">{{ number_format($averageRating, 1) }}/5 ★</span>
                    @endif
                    </span>
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
            
            <!-- Daftar Komentar -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold">Komentar & Rating</h2>
                @if ($komentar->count() > 0)
                    <div class="mt-4 space-y-4">
                        @foreach ($komentar as $komen)
                            <div class="bg-white p-4 rounded shadow">
                                <div class="flex items-center space-x-2">
                                    <span class="font-semibold">{{ $komen->user->nama }}</span>
                                </div>
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
