<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <input type="text" class="form-control w-50" placeholder="Search">
        </h2>
    </x-slot>

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
