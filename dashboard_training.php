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
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Training</p>
                    <h3 class="text-2xl font-bold">1,236</h3>
                    <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.5% dari bulan lalu</p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Sedang Berjalan</p>
                    <h3 class="text-2xl font-bold">3,504</h3>
                    <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.3% dari bulan lalu</p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-hourglass-half text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Selesai</p>
                    <h3 class="text-2xl font-bold">752,000</h3>
                    <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 5.2% dari bulan lalu</p>
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
                <h3 class="font-semibold text-lg">Grafik Data Training Bulanan</h3>
            </div>
            <canvas id="productionChart" height="150"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Aktivitas Training Terbaru</h3>
                <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
            </div>

            <div class="space-y-4">
                <!-- Training oleh ICS A -->
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-chalkboard-teacher text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Training GAP untuk 40 petani<br>
                            <span class="text-xs text-gray-500">
                                Diselenggarakan oleh: <span class="font-semibold">ICS A (Budi Supervisor)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">Hari ini, 09:00</p>
                    </div>
                </div>

                <!-- Training oleh ICS B -->
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-chalkboard-teacher text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Sosialisasi RSPO untuk 30 petani<br>
                            <span class="text-xs text-gray-500">
                                Diselenggarakan oleh: <span class="font-semibold">ICS B (Siti Rahma)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">Kemarin, 14:20</p>
                    </div>
                </div>

                <!-- Training oleh ICS C -->
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            Pelatihan Good Farming untuk 25 petani<br>
                            <span class="text-xs text-gray-500">
                                Diselenggarakan oleh: <span class="font-semibold">ICS C (Anton Pratama)</span>
                            </span>
                        </p>
                        <p class="text-xs text-gray-500">3 hari lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const dataTrainingICS = {
        'ICS A': [12, 14, 15, 20, 22, 25, 24, 27, 29, 30, 32, 33],
        'ICS B': [8, 11, 12, 16, 18, 21, 23, 22, 24, 26, 28, 29],
        'ICS C': [5, 7, 8, 10, 12, 14, 15, 16, 17, 18, 19, 21]
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
                    label: 'ICS A',
                    data: dataTrainingICS['ICS A'],
                    fill: false,
                    borderColor: '#2563eb', // Biru
                    backgroundColor: '#2563eb',
                    tension: 0.2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointHoverRadius: 6
                },
                {
                    label: 'ICS B',
                    data: dataTrainingICS['ICS B'],
                    fill: false,
                    borderColor: '#10b981', // Hijau
                    backgroundColor: '#10b981',
                    tension: 0.2,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointHoverRadius: 6
                },
                {
                    label: 'ICS C',
                    data: dataTrainingICS['ICS C'],
                    fill: false,
                    borderColor: '#f59e42', // Oranye
                    backgroundColor: '#f59e42',
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