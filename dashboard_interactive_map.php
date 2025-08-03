<?php
include 'header.php';


// Cek apakah role bukan 'Super Admin'
if ($user['akun']['role'] == 'User') {
    // Menampilkan alert menggunakan SweetAlert
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Anda tidak memiliki akses untuk halaman ini.',
                confirmButtonText: 'OK',
                background: '#f3f4f6',
                backdrop: 'rgba(0, 0, 0, 1)'
            }).then(function() {
                // Setelah alert ditutup, arahkan pengguna ke halaman login
                window.history.back(); // Kembali ke halaman sebelumnya
            });
          </script>";
}
?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <div class="grid grid-cols-2 gap-6 mb-4">
        <div class="bg-white rounded-xl shadow-md p-5 border border-gray-100 flex items-center">
            <div>
                <p class="text-sm text-gray-500">Total Lokasi di Peta</p>
                <h3 class="text-2xl font-bold">162</h3>
            </div>
            <div class="bg-green-100 text-green-600 p-3 rounded-lg ml-auto">
                <i class="fas fa-map-marker-alt text-xl"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-5 border border-gray-100 flex items-center">
            <div>
                <p class="text-sm text-gray-500">Titik Baru Bulan Ini</p>
                <h3 class="text-2xl font-bold">8</h3>
            </div>
            <div class="bg-blue-100 text-blue-600 p-3 rounded-lg ml-auto">
                <i class="fas fa-calendar-plus text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mt-8">
        <h3 class="font-semibold text-lg mb-4">Peta Interaktif Supply Chain & Production</h3>
        <div id="interactiveMap" style="width:100%;height:400px;border-radius:.75rem;overflow:hidden;"></div>
    </div>
</section>

<script>
    var map = L.map('interactiveMap').setView([-0.789275, 113.921327], 5); // Center Indonesia
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Contoh marker kebun/mills
    L.marker([-0.339, 102.971]).addTo(map).bindPopup("<b>Mills A</b><br>Transaksi: 1,200<br>Status: Aktif");
    L.marker([-0.439, 102.771]).addTo(map).bindPopup("<b>Kebun 7</b><br>Panen: 42 ton");
    L.marker([-0.139, 102.991]).addTo(map).bindPopup("<b>Site HCV</b><br>Status: Good");
    // Tambah marker lain sesuai data
</script>
<!-- Pastikan sudah include leaflet.js & leaflet.css -->

<?php include 'footer.php'; ?>