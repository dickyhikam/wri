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
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Area HCV</p>
                    <h3 class="text-2xl font-bold">125 Ha</h3>
                    <p class="text-xs text-green-500 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i> 5% penambahan area tahun ini
                    </p>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-leaf text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jumlah Site HCV</p>
                    <h3 class="text-2xl font-bold">7 lokasi</h3>
                    <p class="text-xs text-blue-500 mt-1">
                        <i class="fas fa-map-marker-alt mr-1"></i> 2 site baru tahun ini
                    </p>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-map-signs text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Penilaian Terakhir</p>
                    <h3 class="text-2xl font-bold">Juni 2025</h3>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-calendar-check mr-1"></i> 3 site “Good”, 1 “Cukup”
                    </p>
                </div>
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
                    <i class="fas fa-clipboard-list text-xl"></i>
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
            <canvas id="hcvChart" height="150"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Aktivitas Penilaian HCV</h3>
                <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-search-location text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            <span class="font-semibold">Site Sungai Putih</span>: dinilai GOOD oleh <span class="font-semibold">Tim HCV (Siti Rahma)</span>
                        </p>
                        <p class="text-xs text-gray-500">Hari ini, 09:10</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-search-location text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            <span class="font-semibold">Site Riparian A</span>: dinilai CUKUP, butuh pengelolaan ulang (<span class="font-semibold">Budi Supervisor</span>)
                        </p>
                        <p class="text-xs text-gray-500">Kemarin, 14:20</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-red-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-search-location text-red-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">
                            <span class="font-semibold">Area Buffer Zone</span>: status KURANG, monitoring ulang diperlukan
                        </p>
                        <p class="text-xs text-gray-500">5 hari lalu</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    const dataHCV = {
        Good: [2, 2, 3, 3, 3, 4],
        Cukup: [3, 3, 3, 2, 1, 1],
        Kurang: [2, 2, 1, 1, 1, 0]
    };
    const labelTahun = ["2020", "2021", "2022", "2023", "2024", "2025"];
    new Chart(document.getElementById('hcvChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: labelTahun,
            datasets: [{
                    label: 'Good',
                    data: dataHCV.Good,
                    backgroundColor: '#16a34a'
                },
                {
                    label: 'Cukup',
                    data: dataHCV.Cukup,
                    backgroundColor: '#f59e42'
                },
                {
                    label: 'Kurang',
                    data: dataHCV.Kurang,
                    backgroundColor: '#ef4444'
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