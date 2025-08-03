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
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Insiden K3</p>
                    <h3 class="text-2xl font-bold">5</h3>
                    <p class="text-xs text-red-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 2 kasus dari bulan lalu
                    </p>
                </div>
                <div class="bg-red-100 text-red-600 p-3 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Inspeksi K3</p>
                    <h3 class="text-2xl font-bold">23</h3>
                    <p class="text-xs text-green-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 15% dari bulan lalu
                    </p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-clipboard-check text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pelatihan K3</p>
                    <h3 class="text-2xl font-bold">120</h3>
                    <p class="text-xs text-green-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 8% dari bulan lalu
                    </p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-hard-hat text-xl"></i>
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
                <h3 class="font-semibold text-lg">Aktivitas K3 Terkini</h3>
                <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
            </div>
            <div class="space-y-4">
                <!-- Insiden -->
                <div class="flex items-start">
                    <div class="bg-red-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Kecelakaan ringan di blok B (petani: Syaiful)<br>
                            <span class="text-xs text-gray-500">
                                Ditangani oleh: <span class="font-semibold">ICS A (Budi Supervisor)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">Hari ini, 09:45</p>
                    </div>
                </div>
                <!-- Inspeksi K3 -->
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-clipboard-check text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Inspeksi APD dan SOP alat panen<br>
                            <span class="text-xs text-gray-500">
                                Oleh: <span class="font-semibold">Petugas K3 (Siti Rahma)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">Kemarin, 11:10</p>
                    </div>
                </div>
                <!-- Pelatihan K3 -->
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-hard-hat text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Pelatihan K3 & APD untuk 25 petani<br>
                            <span class="text-xs text-gray-500">
                                Diselenggarakan oleh: <span class="font-semibold">ICS B (Anton Pratama)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">2 hari lalu</p>
                    </div>
                </div>
                <!-- Simulasi Tanggap Darurat -->
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-people-carry text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Simulasi evakuasi tanggap darurat<br>
                            <span class="text-xs text-gray-500">
                                Oleh: <span class="font-semibold">Budi Supervisor</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">4 hari lalu</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    const dataBulananK3 = {
        Insiden: [1, 0, 2, 1, 0, 1, 2, 1, 0, 0, 1, 0],
        Pelatihan: [10, 8, 12, 7, 9, 11, 10, 13, 9, 8, 10, 12]
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
                    label: 'Insiden K3',
                    data: dataBulananK3.Insiden,
                    fill: false,
                    borderColor: '#ef4444',
                    backgroundColor: '#ef4444',
                    tension: 0.2,
                    pointRadius: 4
                },
                {
                    label: 'Pelatihan K3',
                    data: dataBulananK3.Pelatihan,
                    fill: false,
                    borderColor: '#16a34a',
                    backgroundColor: '#16a34a',
                    tension: 0.2,
                    pointRadius: 4
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