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
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Produksi (ton)</p>
                    <h3 class="text-2xl font-bold">7,800</h3>
                    <p class="text-xs text-green-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 15% dari bulan lalu
                    </p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-seedling text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Perawatan</p>
                    <h3 class="text-2xl font-bold">1,364</h3>
                    <p class="text-xs text-green-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 10% dari bulan lalu
                    </p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-tools text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Kebun Terawat</p>
                    <h3 class="text-2xl font-bold">952</h3>
                    <p class="text-xs text-green-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 8% dari bulan lalu
                    </p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- ICS Statistics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Production Chart -->
        <div class="bg-white rounded-xl shadow-md p-6 col-span-2 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Grafik Data Petani Bulanan</h3>
            </div>
            <canvas id="productionChart" height="150"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Aktivitas BMP Terbaru</h3>
                <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
            </div>
            <div class="space-y-4">
                <!-- Produksi Panen -->
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-seedling text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Panen TBS: 15 ton dari plot 12<br>
                            <span class="text-xs text-gray-500">
                                Oleh: <span class="font-semibold">ICS A (Budi Supervisor)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">Hari ini, 08:50</p>
                    </div>
                </div>
                <!-- Kegiatan Perawatan -->
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-tools text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Pengendalian gulma di blok D<br>
                            <span class="text-xs text-gray-500">
                                Oleh: <span class="font-semibold">Petugas Lapangan (Andi Saputra)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">Kemarin, 11:04</p>
                    </div>
                </div>
                <!-- Input Pupuk -->
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-flask text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Pemupukan NPK ke 58 petak<br>
                            <span class="text-xs text-gray-500">
                                Oleh: <span class="font-semibold">ICS B (Siti Rahma)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">3 hari lalu</p>
                    </div>
                </div>
                <!-- Lainnya: perbaikan saluran dsb -->
                <div class="flex items-start">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-water text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Perbaikan saluran irigasi blok A<br>
                            <span class="text-xs text-gray-500">
                                Oleh: <span class="font-semibold">Anton Pratama</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">5 hari lalu</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    const dataBulanan = {
        Produksi: [600, 650, 700, 750, 800, 820, 850, 900, 930, 950, 1000, 1050], // ton
        Perawatan: [90, 100, 110, 120, 110, 105, 115, 120, 130, 140, 145, 150] // kegiatan perawatan
    };
    const labelBulan = [
        "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
    ];

    const ctx = document.getElementById('productionChart').getContext('2d');
    const productionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labelBulan,
            datasets: [{
                    label: 'Produksi (ton)',
                    data: dataBulanan.Produksi,
                    fill: false,
                    borderColor: '#2563eb',
                    backgroundColor: '#2563eb',
                    tension: 0.2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointHoverRadius: 6
                },
                {
                    label: 'Aktivitas Perawatan',
                    data: dataBulanan.Perawatan,
                    fill: false,
                    borderColor: '#16a34a',
                    backgroundColor: '#16a34a',
                    tension: 0.2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php include 'footer.php'; ?>