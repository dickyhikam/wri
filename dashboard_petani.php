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
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Petani</p>
                    <h3 class="text-2xl font-bold">1,236</h3>
                    <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.5% dari bulan lalu</p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-user text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Register</p>
                    <h3 class="text-2xl font-bold">3,504</h3>
                    <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.3% dari bulan lalu</p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-user-plus text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Unregister</p>
                    <h3 class="text-2xl font-bold">752,000</h3>
                    <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 5.2% dari bulan lalu</p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
                    <i class="fas fa-user-times text-xl"></i>
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

        <!-- Recent Activities: Dengan Nama Pelaku -->
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Aktivitas Terkini</h3>
                <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
            </div>

            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-certificate text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            2 ICS baru tersertifikasi RSPO<br>
                            <span class="text-xs text-gray-500">Oleh: <span class="font-semibold">Admin (Andi Saputra)</span></span>
                        </p>
                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-user-plus text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            15 petani baru terdaftar<br>
                            <span class="text-xs text-gray-500">Didaftarkan oleh: <span class="font-semibold">Petugas Wilayah (Siti Rahma)</span></span>
                        </p>
                        <p class="text-xs text-gray-500">Kemarin, 15:42</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-map-marked-alt text-purple-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            45 Ha lahan baru ditambahkan<br>
                            <span class="text-xs text-gray-500">Oleh: <span class="font-semibold">Anton Pratama</span></span>
                        </p>
                        <p class="text-xs text-gray-500">Kemarin, 10:15</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-graduation-cap text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Pelatihan GAP untuk 30 petani<br>
                            <span class="text-xs text-gray-500">Diselenggarakan oleh: <span class="font-semibold">Budi Supervisor</span></span>
                        </p>
                        <p class="text-xs text-gray-500">3 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const dataBulanan = {
        Regis: [500, 600, 750, 800, 850, 950, 1000, 1100, 1200, 1300, 1400, 1500],
        Unregist: [50, 80, 60, 40, 70, 60, 50, 40, 30, 25, 35, 30]
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
                    label: 'Regis',
                    data: dataBulanan.Regis,
                    fill: false,
                    borderColor: '#2563eb', // Biru
                    backgroundColor: '#2563eb',
                    tension: 0.2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointHoverRadius: 6
                },
                {
                    label: 'Unregist',
                    data: dataBulanan.Unregist,
                    fill: false,
                    borderColor: '#ef4444', // Merah
                    backgroundColor: '#ef4444',
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
                    display: true // Tampilkan label legend
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