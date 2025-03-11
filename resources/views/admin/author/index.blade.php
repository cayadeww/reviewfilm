<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Author ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-end items-center mb-4">
                    <button onclick="openModal()" class="bg-pink-500 text-white hover:bg-pink-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150">
                        Tambah Data
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full mt-8 border border-gray-400 rounded-lg shadow-lg table-auto">
                        <thead class="bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                            <tr>
                                <th class="border border-gray-400 px-4 py-2">Nama</th>
                                <th class="border border-gray-400 px-4 py-2">Email</th>
                                <th class="border border-gray-400 px-4 py-2">Password</th>
                                <th class="border border-gray-400 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-pink-100">
                            @foreach ($authors as $author)
                            <tr>
                                <td class="border border-gray-400 px-6 py-4 font-medium text-gray-700 text-center">{{ $author->name }}</td>
                                <td class="border border-gray-400 px-6 py-4 text-gray-600 text-center">{{ $author->email }}</td>
                                <td class="border border-gray-400 px-6 py-4 text-gray-600 text-center">********</td> <!-- Sembunyikan Password -->
                                <td class="border border-gray-400 px-6 py-4 text-center">
                                    <button onclick="openEditModal({{ $author->id }}, '{{ $author->name }}', '{{ $author->email }}')" class="bg-purple-500 text-white hover:bg-purple-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150 text-center">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.author.destroy', $author->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus author ini?')" class="bg-pink-500 text-white hover:bg-pink-600 px-4 py-2 rounded-md shadow-sm transition-all duration-150 text-center">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Data -->
<div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-pink-100 p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Tambah Author Baru</h3>
        <form action="{{ route('admin.author.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">
                    Batal
                </button>
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

    <!-- Modal Form Edit Data -->
    <div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-pink-100 p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-xl font-semibold mb-4">Edit Author</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
               
                <div class="mb-4">
                    <label for="edit_name" class="block text-gray-700">Nama</label>
                    <input type="text" name="name" id="edit_name" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="edit_email" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="edit_password" class="block text-gray-700">Password (Opsional)</label>
                    <input type="password" name="password" id="edit_password" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-300 text-black px-4 py-2 rounded-md">Batal</button>
                    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function openEditModal(id, name, email) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('editForm').action = "{{ route('admin.author.update', '') }}/" + id;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

