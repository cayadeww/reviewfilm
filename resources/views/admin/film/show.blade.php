<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Film') }} - {{ $film->judul }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6 items-start">
            <!-- Gambar Film -->
            <div class="w-full md:w-1/3">
                <div class="relative group h-full">
                    <img src="{{ asset('storage/' . $film->gambar) }}" alt="{{ $film->judul }}"
                        class="w-full h-full object-contain rounded-lg shadow-lg">
                </div>
            </div>
        
            <!-- Detail Film -->
            <div class="w-full md:w-2/3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $film->judul }}</h3>
                    <a href="{{ route('admin.film.index') }}"
                       class="bg-pink-600 text-white px-5 py-3 rounded-full shadow-md hover:bg-pink-800 transition-all duration-200">
                       Kembali
                    </a>
                </div>
                
                <!-- Video Trailer -->
                <div class="flex justify-between items-center mb-5">
                    <div class=" md:w-3/4">
                        @if (strpos($film->url_trailer, 'youtu.be') !== false)
                            <iframe width="100%" height="250"
                                src="https://www.youtube.com/embed/{{ basename(parse_url($film->url_trailer, PHP_URL_PATH)) }}"
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                                gyroscope; picture-in-picture" allowfullscreen
                                class="rounded-lg shadow-md"></iframe>
                        @else
                            <video controls class="w-full h-56 md:h-64 rounded-lg shadow-md">
                                <source src="{{ $film->url_trailer }}" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        @endif
                    </div>
                </div>
        
                <p class="text-gray-700 mb-3"><strong>Sinopsis:</strong> {{ $film->sinopsis }}</p>
                <p class="text-gray-700"><strong>Genre:</strong> {{ $film->genre->nama_genre }}</p>
                <p class="text-gray-700"><strong>Kategori:</strong> {{ $film->kategori->kategori }}</p>
                <p class="text-gray-700"><strong>Tahun Rilis:</strong> {{ $film->tahun_rilis }}</p>
                <p class="text-gray-700"><strong>Durasi:</strong> {{ $film->durasi }} menit</p>
                <p class="text-gray-700"><strong>Sutradara:</strong> {{ $film->sutradara }}</p>
                
            </div>
        </div>
    </div>
</x-app-layout>
