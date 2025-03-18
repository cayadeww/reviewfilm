<script>
    // Fungsi untuk membuka modal Tambah Genre
    function openAddGenreModal() {
        document.getElementById('addGenreModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal Tambah Genre
    function closeAddGenreModal() {
        document.getElementById('addGenreModal').classList.add('hidden');
    }

    // Fungsi untuk membuka modal Tambah Kategori
    function openAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal Tambah Kategori
    function closeAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    // Fungsi untuk membuka modal Tambah Film
    function openAddFilmModal() {
        document.getElementById('addFilmModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal Tambah Film
    function closeAddFilmModal() {
        document.getElementById('addFilmModal').classList.add('hidden');
    }

    // Menutup modal dengan klik di luar area modal
    window.onclick = function(event) {
        if (event.target.classList.contains('bg-gray-500')) {
            closeAddGenreModal();
            closeAddCategoryModal();
            closeAddFilmModal();
        }
    };
</script>
