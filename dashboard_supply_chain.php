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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Transaksi Supply Chain</p>
                    <h3 class="text-2xl font-bold">2,563</h3>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
                    <i class="fas fa-exchange-alt text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm text-gray-500">Jumlah Mills</p>
                    <h3 class="text-2xl font-bold">12</h3>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <i class="fas fa-industry text-xl"></i>
                </div>
            </div>
        </div>
        <!-- Tambah score lain sesuai kebutuhan -->
    </div>

    <!-- ICS Statistics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Production Chart -->
        <div class="bg-white rounded-xl shadow-md p-6 col-span-2 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Grafik Data Petani Bulanan</h3>
            </div>
            <canvas id="supplyChainChart" height="150"></canvas>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-1">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Aktivitas Penilaian HCV</h3>
                <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-truck text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">Pengiriman TBS dari Kebun 7 ke Mills A (42 ton)</p>
                        <p class="text-xs text-gray-500">Oleh: <span class="font-semibold">Andi (SCM)</span> - 2 jam lalu</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-industry text-green-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">CPO Batch #116 siap dikirim ke rester</p>
                        <p class="text-xs text-gray-500">Oleh: <span class="font-semibold">Supervisor Mills B</span> - 1 jam lalu</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    const dataSupplyChain = {
        labelBulan: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        transaksi: [210, 220, 198, 230, 250, 255, 265, 280, 299, 310, 320, 330],
        mills: [11, 12, 12, 13, 12, 12, 12, 12, 12, 12, 12, 12]
    };

    const ctx = document.getElementById('supplyChainChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataSupplyChain.labelBulan,
            datasets: [{
                    label: 'Total Transaksi Produksi',
                    data: dataSupplyChain.transaksi,
                    backgroundColor: '#2563eb'
                },
                {
                    label: 'Jumlah Mills',
                    data: dataSupplyChain.mills,
                    backgroundColor: '#059669'
                }
            ]
        },
        options: {
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