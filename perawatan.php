
<?php
// Include header
include 'header.php';
// Simulasi data dari database
$perawatans = [
    [
        'perawatan_id' => 1,
        'plot_id' => 101,
        'tahun_tanam' => 2023,
        'luas' => 5.0,
        'total_upah' => 1500000,
        'keterangan' => 'Perawatan rutin',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 1,
                'jenis_pekerjaan_id' => 1,
                'pekerja_id' => 1,
                'date' => '2023-09-10',
                'upah' => 500000,
                'jenis_lain' => 'Penyiangan',
                'jml' => 2,
            ],
            [
                'perawatan_detil_id' => 2,
                'jenis_pekerjaan_id' => 2,
                'pekerja_id' => 2,
                'date' => '2023-09-12',
                'upah' => 750000,
                'jenis_lain' => 'Pengairan',
                'jml' => 3,
            ],
        ],
    ],
    [
        'perawatan_id' => 2,
        'plot_id' => 102,
        'tahun_tanam' => 2023,
        'luas' => 6.0,
        'total_upah' => 2000000,
        'keterangan' => 'Perawatan intensif',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 3,
                'jenis_pekerjaan_id' => 3,
                'pekerja_id' => 3,
                'date' => '2023-09-15',
                'upah' => 800000,
                'jenis_lain' => 'Pemupukan',
                'jml' => 1,
            ],
            [
                'perawatan_detil_id' => 4,
                'jenis_pekerjaan_id' => 4,
                'pekerja_id' => 4,
                'date' => '2023-09-18',
                'upah' => 700000,
                'jenis_lain' => 'Penyemprotan',
                'jml' => 2,
            ],
        ],
    ],
    [
        'perawatan_id' => 3,
        'plot_id' => 101,
        'tahun_tanam' => 2022,
        'luas' => 5.0,
        'total_upah' => 1200000,
        'keterangan' => 'Perawatan musiman',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 5,
                'jenis_pekerjaan_id' => 1,
                'pekerja_id' => 2,
                'date' => '2022-08-10',
                'upah' => 600000,
                'jenis_lain' => 'Penyiangan',
                'jml' => 2,
            ],
            [
                'perawatan_detil_id' => 6,
                'jenis_pekerjaan_id' => 3,
                'pekerja_id' => 4,
                'date' => '2022-08-15',
                'upah' => 600000,
                'jenis_lain' => 'Pemupukan',
                'jml' => 1,
            ],
        ],
    ],
    [
        'perawatan_id' => 4,
        'plot_id' => 103,
        'tahun_tanam' => 2023,
        'luas' => 4.5,
        'total_upah' => 1800000,
        'keterangan' => 'Perawatan berkala',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 7,
                'jenis_pekerjaan_id' => 2,
                'pekerja_id' => 1,
                'date' => '2023-10-05',
                'upah' => 900000,
                'jenis_lain' => 'Pengairan',
                'jml' => 2,
            ],
            [
                'perawatan_detil_id' => 8,
                'jenis_pekerjaan_id' => 4,
                'pekerja_id' => 3,
                'date' => '2023-10-10',
                'upah' => 900000,
                'jenis_lain' => 'Penyemprotan',
                'jml' => 1,
            ],
        ],
    ],
    [
        'perawatan_id' => 5,
        'plot_id' => 102,
        'tahun_tanam' => 2022,
        'luas' => 6.0,
        'total_upah' => 2100000,
        'keterangan' => 'Perawatan khusus',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 9,
                'jenis_pekerjaan_id' => 3,
                'pekerja_id' => 2,
                'date' => '2022-09-20',
                'upah' => 700000,
                'jenis_lain' => 'Pemupukan',
                'jml' => 2,
            ],
            [
                'perawatan_detil_id' => 10,
                'jenis_pekerjaan_id' => 1,
                'pekerja_id' => 4,
                'date' => '2022-09-25',
                'upah' => 700000,
                'jenis_lain' => 'Penyiangan',
                'jml' => 3,
            ],
            [
                'perawatan_detil_id' => 11,
                'jenis_pekerjaan_id' => 4,
                'pekerja_id' => 1,
                'date' => '2022-09-30',
                'upah' => 700000,
                'jenis_lain' => 'Penyemprotan',
                'jml' => 1,
            ],
        ],
    ],
];
$lahan = [
    101 => ['name' => 'Lahan Blok A', 'farmer_name' => 'Petani Andi'],
    102 => ['name' => 'Lahan Blok B', 'farmer_name' => 'Petani Siti'],
    103 => ['name' => 'Lahan Blok C', 'farmer_name' => 'Petani Budi'],
];
$jenis_pekerjaan = [
    1 => ['name' => 'Penyiangan'],
    2 => ['name' => 'Pengairan'],
    3 => ['name' => 'Pemupukan'],
    4 => ['name' => 'Penyemprotan'],
];
$pekerja = [
    1 => ['name' => 'Budi Santoso'],
    2 => ['name' => 'Ani Putri'],
    3 => ['name' => 'Joko Widodo'],
    4 => ['name' => 'Siti Nurhaliza'],
];
// Menangani parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? intval($_GET['id']) : null;
// Filter parameters
$filter_jenis = isset($_GET['filter_jenis']) ? intval($_GET['filter_jenis']) : '';
$filter_lahan = isset($_GET['filter_lahan']) ? intval($_GET['filter_lahan']) : '';
$filter_tahun = isset($_GET['filter_tahun']) ? intval($_GET['filter_tahun']) : '';
// Apply filters
$filtered_perawatans = $perawatans;
if ($filter_jenis) {
    $filtered_perawatans = array_filter($filtered_perawatans, function($perawatan) use ($filter_jenis) {
        foreach ($perawatan['perawatan_detil'] as $detail) {
            if ($detail['jenis_pekerjaan_id'] == $filter_jenis) {
                return true;
            }
        }
        return false;
    });
}
if ($filter_lahan) {
    $filtered_perawatans = array_filter($filtered_perawatans, function($perawatan) use ($filter_lahan) {
        return $perawatan['plot_id'] == $filter_lahan;
    });
}
if ($filter_tahun) {
    $filtered_perawatans = array_filter($filtered_perawatans, function($perawatan) use ($filter_tahun) {
        return $perawatan['tahun_tanam'] == $filter_tahun;
    });
}
// Pagination
$itemsPerPage = 3;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalItems = count($filtered_perawatans);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = min($currentPage, $totalPages);
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedPerawatans = array_slice($filtered_perawatans, $startIndex, $itemsPerPage);
// Mendapatkan data spesifik berdasarkan ID
$selected_perawatan = null;
if ($action === 'view' || $action === 'edit') {
    foreach ($perawatans as $p) {
        if ($p['perawatan_id'] === $id) {
            $selected_perawatan = $p;
            break;
        }
    }
}
// Generate unique years for filter
$tahun_tanam_list = array_unique(array_column($perawatans, 'tahun_tanam'));
sort($tahun_tanam_list);
?>
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php if ($action === 'list'): ?>
                    Data Perawatan
                <?php elseif ($action === 'add'): ?>
                    Tambah Data Perawatan
                <?php elseif ($action === 'view'): ?>
                    Detail Perawatan #PRW-<?= $selected_perawatan['perawatan_id'] ?>
                <?php elseif ($action === 'edit'): ?>
                    Edit Data Perawatan #PRW-<?= $selected_perawatan['perawatan_id'] ?>
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action === 'list'): ?>
                <!-- Tombol Tambah Data -->
                <a href="perawatan.php?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </a>
            <?php elseif ($action === 'view'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="perawatan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <!-- Tombol Edit -->
                <a href="perawatan.php?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <!-- Tombol Hapus -->
                <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            <?php elseif ($action === 'edit'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="perawatan.php?action=view&id=<?= $id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php endif; ?>
        </div>
    </header>
    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action === 'list'): ?>
            <!-- Halaman Daftar Perawatan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" action="perawatan.php" class="flex flex-col gap-4">
                        <input type="hidden" name="action" value="list">
                        <!-- Search bar -->
                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari data perawatan...">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="filter_jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pekerjaan</label>
                                <select id="filter_jenis" name="filter_jenis" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Jenis</option>
                                    <?php foreach ($jenis_pekerjaan as $id => $jenis): ?>
                                        <option value="<?= $id ?>" <?= $filter_jenis == $id ? 'selected' : '' ?>><?= $jenis['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="filter_lahan" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan</label>
                                <select id="filter_lahan" name="filter_lahan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Lahan</option>
                                    <?php foreach ($lahan as $id => $data): ?>
                                        <option value="<?= $id ?>" <?= $filter_lahan == $id ? 'selected' : '' ?>><?= $data['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="filter_tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam</label>
                                <select id="filter_tahun" name="filter_tahun" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Tahun</option>
                                    <?php foreach ($tahun_tanam_list as $tahun): ?>
                                        <option value="<?= $tahun ?>" <?= $filter_tahun == $tahun ? 'selected' : '' ?>><?= $tahun ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Perawatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Tanam</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (ha)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Upah (Rp)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($paginatedPerawatans)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data perawatan</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedPerawatans as $index => $perawatan): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $startIndex + $index + 1 ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">PRW-<?= $perawatan['perawatan_id'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $lahan[$perawatan['plot_id']]['name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $perawatan['tahun_tanam'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $perawatan['luas'] ?> ha</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?= number_format($perawatan['total_upah'], 0, ',', '.') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="perawatan.php?action=view&id=<?= $perawatan['perawatan_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="perawatan.php?action=edit&id=<?= $perawatan['perawatan_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('<?= $perawatan['perawatan_id'] ?>')" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="perawatan.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="perawatan.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium"><?= $startIndex + 1 ?></span> sampai <span class="font-medium"><?= min($startIndex + $itemsPerPage, $totalItems) ?></span> dari <span class="font-medium"><?= $totalItems ?></span> hasil
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="perawatan.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <?php 
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                                if ($startPage > 1) {
                                    echo '<a href="perawatan.php?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="perawatan.php?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                                }
                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="perawatan.php?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>
                                <a href="perawatan.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($action === 'view' && $selected_perawatan): ?>
            <!-- Halaman Detail Perawatan - Semua dalam satu kolom -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Header Card -->
                <div class="p-6 bg-gray-50 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Detail Perawatan #PRW-<?= $selected_perawatan['perawatan_id'] ?></h1>
                        <p class="text-sm text-gray-600 mt-1">Tanggal dibuat: <?= date('d M Y', strtotime('2023-01-01')) ?></p> <!-- Ganti dengan tanggal sebenarnya -->
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full"><?= count($selected_perawatan['perawatan_detil']) ?> Kegiatan</span>
                        <span class="text-sm bg-green-100 text-green-800 px-3 py-1 rounded-full">Aktif</span> <!-- Status bisa dinamis -->
                    </div>
                </div>

                <!-- Informasi Utama Perawatan -->
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Utama Perawatan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm text-gray-500">ID Perawatan</p>
                            <p class="font-medium">PRW-<?= $selected_perawatan['perawatan_id'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Lahan</p>
                            <p class="font-medium"><?= $lahan[$selected_perawatan['plot_id']]['name'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Petani</p>
                            <p class="font-medium"><?= $lahan[$selected_perawatan['plot_id']]['farmer_name'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tahun Tanam</p>
                            <p class="font-medium"><?= $selected_perawatan['tahun_tanam'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Luas (ha)</p>
                            <p class="font-medium"><?= $selected_perawatan['luas'] ?> ha</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Upah (Rp)</p>
                            <p class="font-medium">Rp <?= number_format($selected_perawatan['total_upah'], 0, ',', '.') ?></p>
                        </div>
                        <div class="md:col-span-2 lg:col-span-3">
                            <p class="text-sm text-gray-500">Keterangan</p>
                            <p class="font-medium"><?= $selected_perawatan['keterangan'] ?: '-' ?></p>
                        </div>
                    </div>
                </div>

                <!-- Detail Kegiatan Perawatan -->
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Detail Kegiatan Perawatan</h2>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle"></i>
                            <span>Menampilkan <?= count($selected_perawatan['perawatan_detil']) ?> detail kegiatan</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pekerjaan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerja</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Upah (Rp)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Lain</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($selected_perawatan['perawatan_detil'] as $index => $detail): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#f0ab00] text-white">
                                                <?= $jenis_pekerjaan[$detail['jenis_pekerjaan_id']]['name'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pekerja[$detail['pekerja_id']]['name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d/m/Y', strtotime($detail['date'])) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp <?= number_format($detail['upah'], 0, ',', '.') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $detail['jenis_lain'] ?: '-' ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $detail['jml'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer Card dengan Tombol Aksi -->
                
        <?php elseif ($action === 'add'): ?>
            <!-- Form Tambah Perawatan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Data Perawatan</h2>
                    <form id="addForm" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="perawatan_id" class="block text-sm font-medium text-gray-700">ID Perawatan</label>
                                <input type="text" id="perawatan_id" name="perawatan_id" readonly 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="PRW-<?= count($perawatans) + 1 ?>">
                            </div>
                            <div>
                                <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                <select id="lahan_id" name="lahan_id" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lahan</option>
                                    <?php foreach ($lahan as $id => $data): ?>
                                        <option value="<?= $id ?>"><?= $data['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="petani-info" class="mt-2 text-sm text-gray-500 hidden">
                                    Petani: <span id="petani-name"></span>
                                </div>
                            </div>
                            <div>
                                <label for="tahun_tanam" class="block text-sm font-medium text-gray-700">Tahun Tanam</label>
                                <input type="number" id="tahun_tanam" name="tahun_tanam" min="1900" max="2100" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="luas" class="block text-sm font-medium text-gray-700">Luas (ha)</label>
                                <input type="number" step="0.01" id="luas" name="luas" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="total_upah" class="block text-sm font-medium text-gray-700">Total Upah (Rp)</label>
                                <input type="number" id="total_upah" name="total_upah" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Detail Kegiatan Perawatan</h3>
                        <div id="detail-container">
                            <!-- Kontainer untuk satu baris detail lengkap -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <!-- Baris 1: Jenis Pekerjaan & Pekerja -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
                                        <select name="jenis_pekerjaan_id[]" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis</option>
                                            <?php foreach ($jenis_pekerjaan as $id => $jenis): ?>
                                                <option value="<?= $id ?>"><?= $jenis['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Pekerja</label>
                                        <select name="pekerja_id[]" required onchange="updatePekerjaId(this)"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Pekerja</option>
                                            <?php foreach ($pekerja as $id => $data): ?>
                                                <option value="<?= $id ?>"><?= $data['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Baris 2: ID Pekerja & Tanggal -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">ID Pekerja</label>
                                        <input type="text" name="pekerja_id_display[]" readonly
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                        <input type="date" name="date[]" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <!-- Baris 3: Jenis Lain & Jumlah -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Lain</label>
                                        <input type="text" name="jenis_lain[]"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                        <input type="number" name="jml[]" min="1" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <!-- Baris 4: Upah & Tombol Hapus -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Upah (Rp)</label>
                                        <input type="number" name="upah[]" min="0" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <!-- Placeholder untuk tombol hapus jika diperlukan -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="tambahDetail()" class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-plus mr-2"></i> Tambah Detail
                        </button>
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="perawatan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Perawatan</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($action === 'edit' && $selected_perawatan): ?>
            <!-- Form Edit Perawatan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Perawatan #PRW-<?= $selected_perawatan['perawatan_id'] ?></h2>
                    <form id="editForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="perawatan_id" class="block text-sm font-medium text-gray-700">ID Perawatan</label>
                                <input type="text" id="perawatan_id" name="perawatan_id" readonly 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="PRW-<?= $selected_perawatan['perawatan_id'] ?>">
                            </div>
                            <div>
                                <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                <select id="lahan_id" name="lahan_id" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lahan</option>
                                    <?php foreach ($lahan as $id => $data): ?>
                                        <option value="<?= $id ?>" <?= ($id == $selected_perawatan['plot_id']) ? 'selected' : '' ?>><?= $data['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="petani-info" class="mt-2 text-sm text-gray-500">
                                    Petani: <span id="petani-name"><?= $lahan[$selected_perawatan['plot_id']]['farmer_name'] ?></span>
                                </div>
                            </div>
                            <div>
                                <label for="tahun_tanam" class="block text-sm font-medium text-gray-700">Tahun Tanam</label>
                                <input type="number" id="tahun_tanam" name="tahun_tanam" min="1900" max="2100" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['tahun_tanam'] ?>">
                            </div>
                            <div>
                                <label for="luas" class="block text-sm font-medium text-gray-700">Luas (ha)</label>
                                <input type="number" step="0.01" id="luas" name="luas" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['luas'] ?>">
                            </div>
                            <div>
                                <label for="total_upah" class="block text-sm font-medium text-gray-700">Total Upah (Rp)</label>
                                <input type="number" id="total_upah" name="total_upah" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['total_upah'] ?>">
                            </div>
                            <div>
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['keterangan'] ?>">
                            </div>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Detail Kegiatan Perawatan</h3>
                        <div id="detail-container">
                            <?php foreach ($selected_perawatan['perawatan_detil'] as $index => $detail): ?>
                                <!-- Kontainer untuk satu baris detail lengkap -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    <!-- Baris 1: Jenis Pekerjaan & Pekerja -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
                                            <select name="jenis_pekerjaan_id[]" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Pilih Jenis</option>
                                                <?php foreach ($jenis_pekerjaan as $id => $jenis): ?>
                                                    <option value="<?= $id ?>" <?= (isset($detail['jenis_pekerjaan_id']) && $id == $detail['jenis_pekerjaan_id']) ? 'selected' : '' ?>><?= $jenis['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Pekerja</label>
                                            <select name="pekerja_id[]" required onchange="updatePekerjaId(this)"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Pilih Pekerja</option>
                                                <?php foreach ($pekerja as $id => $data): ?>
                                                    <option value="<?= $id ?>" <?= (isset($detail['pekerja_id']) && $id == $detail['pekerja_id']) ? 'selected' : '' ?>><?= $data['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Baris 2: ID Pekerja & Tanggal -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">ID Pekerja</label>
                                            <input type="text" name="pekerja_id_display[]" readonly
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                value="<?= isset($detail['pekerja_id']) ? htmlspecialchars($detail['pekerja_id']) : '' ?>">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                                            <input type="date" name="date[]" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                value="<?= isset($detail['date']) ? htmlspecialchars($detail['date']) : '' ?>">
                                        </div>
                                    </div>
                                    <!-- Baris 3: Jenis Lain & Jumlah -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jenis Lain</label>
                                            <input type="text" name="jenis_lain[]"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                value="<?= isset($detail['jenis_lain']) ? htmlspecialchars($detail['jenis_lain']) : '' ?>">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                            <input type="number" name="jml[]" min="1" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                value="<?= isset($detail['jml']) ? htmlspecialchars($detail['jml']) : '' ?>">
                                        </div>
                                    </div>
                                    <!-- Baris 4: Upah & Tombol Hapus (jika bukan baris pertama) -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Upah (Rp)</label>
                                            <input type="number" name="upah[]" min="0" required
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                value="<?= isset($detail['upah']) ? htmlspecialchars($detail['upah']) : '' ?>">
                                        </div>
                                        <div>
                                            <?php if ($index > 0): ?>
                                                <button type="button" onclick="hapusDetail(this)" class="mt-6 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" onclick="tambahDetail()" class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-plus mr-2"></i> Tambah Detail
                        </button>
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="perawatan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Halaman tidak valid -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Halaman Tidak Ditemukan</h2>
                    <p class="text-gray-600">Maaf, halaman yang Anda cari tidak tersedia.</p>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>
<script>
    // Fungsi untuk menampilkan nama petani saat lahan dipilih
    document.getElementById('lahan_id')?.addEventListener('change', function() {
        const selectedLahanId = this.value;
        const petaniInfo = document.getElementById('petani-info');
        const petaniName = document.getElementById('petani-name');
        // Data lahan dari PHP ke JavaScript
        const lahanData = <?= json_encode($lahan) ?>;
        if (selectedLahanId !== '') {
            petaniInfo.classList.remove('hidden');
            petaniName.textContent = lahanData[selectedLahanId]['farmer_name'];
        } else {
            petaniInfo.classList.add('hidden');
            petaniName.textContent = '';
        }
    });
    // Fungsi untuk menampilkan ID pekerja saat pekerja dipilih
    function updatePekerjaId(selectElement) {
        const row = selectElement.closest('.grid').closest('.grid');
        const pekerjaIdInput = row.querySelector('input[name="pekerja_id_display[]"]');
        pekerjaIdInput.value = selectElement.value;
    }
    // Fungsi untuk menambah detail perawatan
    function tambahDetail() {
        const container = document.getElementById('detail-container');
        const newRow = document.createElement('div');
        newRow.className = 'grid grid-cols-1 md:grid-cols-2 gap-6 mb-4';
        newRow.innerHTML = `
            <!-- Baris 1: Jenis Pekerjaan & Pekerja -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Pekerjaan</label>
                    <select name="jenis_pekerjaan_id[]" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Jenis</option>
                        <?php foreach ($jenis_pekerjaan as $id => $jenis): ?>
                            <option value="<?= $id ?>"><?= $jenis['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pekerja</label>
                    <select name="pekerja_id[]" required onchange="updatePekerjaId(this)"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Pekerja</option>
                        <?php foreach ($pekerja as $id => $data): ?>
                            <option value="<?= $id ?>"><?= $data['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- Baris 2: ID Pekerja & Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Pekerja</label>
                    <input type="text" name="pekerja_id_display[]" readonly
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date[]" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <!-- Baris 3: Jenis Lain & Jumlah -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Lain</label>
                    <input type="text" name="jenis_lain[]"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="jml[]" min="1" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <!-- Baris 4: Upah & Tombol Hapus -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Upah (Rp)</label>
                    <input type="number" name="upah[]" min="0" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <button type="button" onclick="hapusDetail(this)" class="mt-6 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newRow);
    }
    // Fungsi untuk menghapus detail perawatan
    function hapusDetail(button) {
        const row = button.closest('.grid').closest('.grid');
        row.remove();
    }
    // Fungsi untuk konfirmasi hapus
    function confirmDelete(perawatanId) {
        if (confirm('Apakah Anda yakin ingin menghapus data perawatan ini?')) {
            window.location.href = 'perawatan.php?action=delete&id=' + perawatanId;
        }
    }
    // Fungsi untuk tab
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            // Update tab aktif
            document.querySelectorAll('.tab-link').forEach(t => {
                t.classList.remove('border-[#f0ab00]', 'text-[#f0ab00]');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-[#f0ab00]', 'text-[#f0ab00]');
            // Update konten aktif
            const target = this.getAttribute('href').substring(1);
            document.querySelectorAll('.tab-content').forEach(c => {
                c.classList.remove('active');
                c.classList.add('hidden');
            });
            document.getElementById(target + '-content').classList.remove('hidden');
            document.getElementById(target + '-content').classList.add('active');
        });
    });
    // Inisialisasi event listener untuk select pekerja yang sudah ada
    document.addEventListener('DOMContentLoaded', function() {
        const pekerjaSelects = document.querySelectorAll('select[name="pekerja_id[]"]');
        pekerjaSelects.forEach(select => {
            select.addEventListener('change', function() {
                updatePekerjaId(this);
            });
            // Update ID pekerja saat pertama kali load
            if (select.value) {
                const row = select.closest('.grid').closest('.grid');
                const pekerjaIdInput = row.querySelector('input[name="pekerja_id_display[]"]');
                pekerjaIdInput.value = select.value;
            }
        });
    });
</script>
<?php include 'footer.php'; ?>
```