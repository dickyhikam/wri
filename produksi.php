<?php
// Include header
include 'header.php';

// Data simulasi petani dan pekerja dari database
$petani_list = [
    ['id' => 201, 'nama' => 'Petani Andi'],
    ['id' => 202, 'nama' => 'Petani Budi'],
    ['id' => 203, 'nama' => 'Petani Siti'],
    ['id' => 204, 'nama' => 'Petani Rina'],
    ['id' => 205, 'nama' => 'Petani Joko'],
    ['id' => 206, 'nama' => 'Petani Dodi']
];

$pekerja_list = [
    ['id' => 301, 'nama' => 'Pekerja Siti'],
    ['id' => 302, 'nama' => 'Pekerja Rina'],
    ['id' => 303, 'nama' => 'Pekerja Joko'],
    ['id' => 304, 'nama' => 'Pekerja Wati'],
    ['id' => 305, 'nama' => 'Pekerja Dodi'],
    ['id' => 306, 'nama' => 'Pekerja Ani'],
    ['id' => 307, 'nama' => 'Pekerja Bayu'],
    ['id' => 308, 'nama' => 'Pekerja Dina']
];

// Data simulasi produksi
$produksi_data = [
    [
        'id' => 1,
        'plot_id' => 101,
        'date' => '2023-09-15',
        'jumlah_panen' => 500,
        'luas' => 2.5,
        'keterangan' => 'Hasil panen pertama',
        'upah' => 2500000,
        'petani' => [
            ['id' => 201, 'nama' => 'Petani Andi'],
            ['id' => 202, 'nama' => 'Petani Budi']
        ],
        'pekerja' => [
            ['id' => 301, 'nama' => 'Pekerja Siti'],
            ['id' => 302, 'nama' => 'Pekerja Rina']
        ]
    ],
    [
        'id' => 2,
        'plot_id' => 102,
        'date' => '2023-09-20',
        'jumlah_panen' => 600,
        'luas' => 3.0,
        'keterangan' => 'Hasil panen kedua',
        'upah' => 3000000,
        'petani' => [
            ['id' => 203, 'nama' => 'Petani Siti']
        ],
        'pekerja' => [
            ['id' => 303, 'nama' => 'Pekerja Joko'],
            ['id' => 304, 'nama' => 'Pekerja Wati']
        ]
    ],
    [
        'id' => 3,
        'plot_id' => 103,
        'date' => '2023-09-25',
        'jumlah_panen' => 450,
        'luas' => 2.0,
        'keterangan' => 'Hasil panen ketiga',
        'upah' => 2250000,
        'petani' => [
            ['id' => 204, 'nama' => 'Petani Budi']
        ],
        'pekerja' => [
            ['id' => 305, 'nama' => 'Pekerja Dodi']
        ]
    ],
    [
        'id' => 4,
        'plot_id' => 104,
        'date' => '2023-10-01',
        'jumlah_panen' => 700,
        'luas' => 3.5,
        'keterangan' => 'Hasil panen keempat',
        'upah' => 3500000,
        'petani' => [
            ['id' => 205, 'nama' => 'Petani Rina']
        ],
        'pekerja' => [
            ['id' => 306, 'nama' => 'Pekerja Ani'],
            ['id' => 307, 'nama' => 'Pekerja Bayu']
        ]
    ],
    [
        'id' => 5,
        'plot_id' => 105,
        'date' => '2023-10-05',
        'jumlah_panen' => 550,
        'luas' => 2.8,
        'keterangan' => 'Hasil panen kelima',
        'upah' => 2750000,
        'petani' => [
            ['id' => 206, 'nama' => 'Petani Joko']
        ],
        'pekerja' => [
            ['id' => 308, 'nama' => 'Pekerja Dina']
        ]
    ]
];

// Data lahan
$lahan = [
    101 => [
        'name' => 'Lahan Blok A', 
        'farmer_name' => 'Petani Andi',
        'ics_name' => 'ICS Maju Jaya',
        'kecamatan' => 'Dayun',
        'kabupaten' => 'Siak',
        'alamat' => 'Jl. Pertanian No. 10'
    ],
    102 => [
        'name' => 'Lahan Blok B', 
        'farmer_name' => 'Petani Siti',
        'ics_name' => 'ICS Sejahtera',
        'kecamatan' => 'Dayun',
        'kabupaten' => 'Siak',
        'alamat' => 'Jl. Perkebunan No. 5'
    ],
    103 => [
        'name' => 'Lahan Blok C', 
        'farmer_name' => 'Petani Budi',
        'ics_name' => 'ICS Makmur',
        'kecamatan' => 'Kerinci Kanan',
        'kabupaten' => 'Siak',
        'alamat' => 'Jl. Sawit No. 8'
    ],
    104 => [
        'name' => 'Lahan Blok D', 
        'farmer_name' => 'Petani Rina',
        'ics_name' => 'ICS Maju Jaya',
        'kecamatan' => 'Kerinci Kanan',
        'kabupaten' => 'Siak',
        'alamat' => 'Jl. Kelapa Sawit No. 12'
    ],
    105 => [
        'name' => 'Lahan Blok E', 
        'farmer_name' => 'Petani Joko',
        'ics_name' => 'ICS Sejahtera',
        'kecamatan' => 'Dayun',
        'kabupaten' => 'Siak',
        'alamat' => 'Jl. Kebun Sawit No. 3'
    ]
];

// Data unik untuk filter
$kecamatans = array_unique(array_column($lahan, 'kecamatan'));
$kabupatens = array_unique(array_column($lahan, 'kabupaten'));
$ics_list = array_unique(array_column($lahan, 'ics_name'));

// Handle parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Filter data
$filter_ics = isset($_GET['filter_ics']) ? $_GET['filter_ics'] : '';
$filter_kecamatan = isset($_GET['filter_kecamatan']) ? $_GET['filter_kecamatan'] : '';
$filter_kabupaten = isset($_GET['filter_kabupaten']) ? $_GET['filter_kabupaten'] : '';
$filter_sort = isset($_GET['filter_sort']) ? $_GET['filter_sort'] : '';

// Filter data produksi
$filtered_produksi = $produksi_data;

if ($filter_ics) {
    $filtered_produksi = array_filter($filtered_produksi, function($p) use ($lahan, $filter_ics) {
        return isset($lahan[$p['plot_id']]) && $lahan[$p['plot_id']]['ics_name'] == $filter_ics;
    });
}

if ($filter_kecamatan) {
    $filtered_produksi = array_filter($filtered_produksi, function($p) use ($lahan, $filter_kecamatan) {
        return isset($lahan[$p['plot_id']]) && $lahan[$p['plot_id']]['kecamatan'] == $filter_kecamatan;
    });
}

if ($filter_kabupaten) {
    $filtered_produksi = array_filter($filtered_produksi, function($p) use ($lahan, $filter_kabupaten) {
        return isset($lahan[$p['plot_id']]) && $lahan[$p['plot_id']]['kabupaten'] == $filter_kabupaten;
    });
}

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = strtolower(trim($_GET['search']));
    $filtered_produksi = array_filter($filtered_produksi, function($p) use ($search, $lahan) {
        if (!isset($lahan[$p['plot_id']])) {
            return false;
        }
        return (strpos(strtolower($p['plot_id']), $search) !== false) || 
               (strpos(strtolower($lahan[$p['plot_id']]['ics_name']), $search) !== false);
    });
}

// Sorting data
if ($filter_sort == 'highest') {
    usort($filtered_produksi, function($a, $b) {
        return $b['jumlah_panen'] - $a['jumlah_panen'];
    });
} elseif ($filter_sort == 'lowest') {
    usort($filtered_produksi, function($a, $b) {
        return $a['jumlah_panen'] - $b['jumlah_panen'];
    });
}

// Get data spesifik berdasarkan ID untuk view/edit
$selected_produksi = null;
if ($action === 'view' || $action === 'edit') {
    foreach ($produksi_data as $data) {
        if ($data['id'] == $id) {
            $selected_produksi = $data;
            break;
        }
    }
}

// Konfigurasi pagination
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalItems = count($filtered_produksi);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = min($currentPage, $totalPages);
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedProduksi = array_slice($filtered_produksi, $startIndex, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Produksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-20 shadow-sm flex items-center justify-between px-8">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-800">
                        <?php if ($action === 'list'): ?>
                            Manajemen Data Produksi
                        <?php elseif ($action === 'add'): ?>
                            Tambah Data Produksi
                        <?php elseif ($action === 'view'): ?>
                            Detail Produksi
                        <?php elseif ($action === 'edit'): ?>
                            Edit Data Produksi
                        <?php endif; ?>
                    </h1>
                </div>
                <div class="flex items-center space-x-6">
                    <?php if ($action === 'list'): ?>
                        <a href="produksi.php?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Data
                        </a>
                    <?php elseif ($action === 'view'): ?>
                        <a href="produksi.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                        <a href="produksi.php?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                    <?php elseif ($action === 'edit' || $action === 'add'): ?>
                        <a href="produksi.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    <?php endif; ?>
                </div>
            </header>

            <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
                <?php if ($action === 'list'): ?>
                    <!-- Halaman Daftar Produksi -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-4 bg-gray-50 border-b">
                            <form method="get" class="space-y-4">
                                <input type="hidden" name="action" value="list">
                                <div class="mb-4">
                                    <div class="relative">
                                        <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                               placeholder="Cari berdasarkan ICS...">
                                        <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <!-- Filter ICS -->
                                    <div>
                                        <select id="filter_ics" name="filter_ics" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Semua ICS</option>
                                            <?php foreach ($ics_list as $ics): ?>
                                                <option value="<?= $ics ?>" <?= $filter_ics == $ics ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($ics) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Filter Kecamatan -->
                                    <div>
                                        <select id="filter_kecamatan" name="filter_kecamatan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Semua Kecamatan</option>
                                            <?php foreach ($kecamatans as $kec): ?>
                                                <option value="<?= $kec ?>" <?= $filter_kecamatan == $kec ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($kec) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Filter Kabupaten -->
                                    <div>
                                        <select id="filter_kabupaten" name="filter_kabupaten" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Semua Kabupaten</option>
                                            <?php foreach ($kabupatens as $kab): ?>
                                                <option value="<?= $kab ?>" <?= $filter_kabupaten == $kab ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($kab) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <!-- Filter Urutan -->
                                    <div>
                                        <select id="filter_sort" name="filter_sort" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Default</option>
                                            <option value="highest" <?= $filter_sort == 'highest' ? 'selected' : '' ?>>Hasil Tertinggi</option>
                                            <option value="lowest" <?= $filter_sort == 'lowest' ? 'selected' : '' ?>>Hasil Terendah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3">
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
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Produksi</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petani</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ICS</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Panen</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil (kg)</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (ha)</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (empty($paginatedProduksi)): ?>
                                        <tr>
                                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data produksi yang ditemukan</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($paginatedProduksi as $index => $data): 
                                            $rowNumber = $startIndex + $index + 1;
                                            $lahan_info = $lahan[$data['plot_id']] ?? null;
                                        ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PROD-<?= $data['id'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $lahan_info ? $lahan_info['name'] : 'Lahan Tidak Dikenal' ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $lahan_info ? $lahan_info['farmer_name'] : '-' ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $lahan_info ? $lahan_info['ics_name'] : '-' ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d/m/Y', strtotime($data['date'])) ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= number_format($data['jumlah_panen'], 0, ',', '.') ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $data['luas'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="produksi.php?action=view&id=<?= $data['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="produksi.php?action=edit&id=<?= $data['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Navigasi Halaman -->
                        <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                            <div class="flex-1 flex justify-between sm:hidden">
                                <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Sebelumnya
                                </a>
                                <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Berikutnya
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
                                        <!-- Previous Page Link -->
                                        <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                            <span class="sr-only">Sebelumnya</span>
                                            <i class="fas fa-chevron-left"></i>
                                        </a>

                                        <!-- Page Numbers -->
                                        <?php 
                                        $startPage = max(1, $currentPage - 2);
                                        $endPage = min($totalPages, $currentPage + 2);
                                        
                                        if ($currentPage <= 3) {
                                            $endPage = min(5, $totalPages);
                                        }
                                        
                                        if ($currentPage >= $totalPages - 2) {
                                            $startPage = max(1, $totalPages - 4);
                                        }
                                        
                                        if ($startPage > 1) {
                                            ?>
                                            <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                1
                                            </a>
                                            <?php if ($startPage > 2): ?>
                                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                    ...
                                                </span>
                                            <?php endif; ?>
                                            <?php
                                        }
                                        
                                        for ($i = $startPage; $i <= $endPage; $i++) {
                                            ?>
                                            <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium <?= $i == $currentPage ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' ?>">
                                                <?= $i ?>
                                            </a>
                                            <?php
                                        }
                                        
                                        if ($endPage < $totalPages) {
                                            ?>
                                            <?php if ($endPage < $totalPages - 1): ?>
                                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                    ...
                                                </span>
                                            <?php endif; ?>
                                            <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                <?= $totalPages ?>
                                            </a>
                                            <?php
                                        }
                                        ?>

                                        <!-- Next Page Link -->
                                        <a href="produksi.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                            <span class="sr-only">Berikutnya</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif ($action === 'view' && $selected_produksi): ?>
                    <!-- Halaman Detail Produksi -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Detail Produksi</h2>
                                    <p class="text-sm text-gray-500">PROD-<?= $selected_produksi['id'] ?></p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <!-- Informasi Dasar -->
                                <div class="space-y-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="font-medium text-gray-700 mb-3">Informasi Dasar</h3>
                                        <div class="space-y-3">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Nama Lahan</label>
                                                <p class="mt-1 text-sm text-gray-900 font-medium"><?= $lahan[$selected_produksi['plot_id']]['name'] ?? 'Lahan Tidak Dikenal' ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Petani</label>
                                                <p class="mt-1 text-sm text-gray-900"><?= $lahan[$selected_produksi['plot_id']]['farmer_name'] ?? 'Petani Tidak Dikenal' ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">ICS</label>
                                                <p class="mt-1 text-sm text-gray-900"><?= $lahan[$selected_produksi['plot_id']]['ics_name'] ?? '-' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="font-medium text-gray-700 mb-3">Lokasi Lahan</h3>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Alamat</label>
                                            <p class="mt-1 text-sm text-gray-900">
                                                <?= $lahan[$selected_produksi['plot_id']]['alamat'] ?? '-' ?>, 
                                                <?= $lahan[$selected_produksi['plot_id']]['kecamatan'] ?? '-' ?>, 
                                                <?= $lahan[$selected_produksi['plot_id']]['kabupaten'] ?? '-' ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Detail Produksi -->
                                <div class="space-y-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="font-medium text-gray-700 mb-3">Detail Produksi</h3>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Tanggal Panen</label>
                                                <p class="mt-1 text-sm text-gray-900"><?= date('d F Y', strtotime($selected_produksi['date'])) ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Hasil (kg)</label>
                                                <p class="mt-1 text-sm text-gray-900"><?= number_format($selected_produksi['jumlah_panen'], 0, ',', '.') ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Luas Lahan (ha)</label>
                                                <p class="mt-1 text-sm text-gray-900"><?= $selected_produksi['luas'] ?></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Hasil per Hektar</label>
                                                <p class="mt-1 text-sm text-gray-900">
                                                    <?= $selected_produksi['luas'] > 0 ? number_format($selected_produksi['jumlah_panen'] / $selected_produksi['luas'], 2) : '0' ?> kg/ha
                                                </p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500">Upah (Rp)</label>
                                                <p class="mt-1 text-sm text-gray-900"><?= number_format($selected_produksi['upah'], 0, ',', '.') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="font-medium text-gray-700 mb-3">Catatan</h3>
                                        <p class="text-sm text-gray-900"><?= $selected_produksi['keterangan'] ?: 'Tidak ada catatan' ?></p>
                                    </div>
                                </div>
                                
                                <!-- Orang yang Terlibat -->
                                <div class="md:col-span-2 space-y-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <h3 class="font-medium text-gray-700 mb-3">Orang yang Terlibat</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500 mb-2">Petani</label>
                                                <div class="space-y-2">
                                                    <?php if (!empty($selected_produksi['petani'])): ?>
                                                        <?php foreach ($selected_produksi['petani'] as $petani): ?>
                                                            <div class="flex items-center p-2 bg-white rounded border">
                                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                                    <i class="fas fa-user text-blue-600"></i>
                                                                </div>
                                                                <div class="ml-3">
                                                                    <p class="text-sm font-medium text-gray-900"><?= $petani['nama'] ?></p>
                                                                    <p class="text-xs text-gray-500">ID: <?= $petani['id'] ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p class="text-sm text-gray-500">Tidak ada data petani</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-500 mb-2">Pekerja</label>
                                                <div class="space-y-2">
                                                    <?php if (!empty($selected_produksi['pekerja'])): ?>
                                                        <?php foreach ($selected_produksi['pekerja'] as $pekerja): ?>
                                                            <div class="flex items-center p-2 bg-white rounded border">
                                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                                    <i class="fas fa-hard-hat text-green-600"></i>
                                                                </div>
                                                                <div class="ml-3">
                                                                    <p class="text-sm font-medium text-gray-900"><?= $pekerja['nama'] ?></p>
                                                                    <p class="text-xs text-gray-500">ID: <?= $pekerja['id'] ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p class="text-sm text-gray-500">Tidak ada data pekerja</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif ($action === 'add'): ?>
                    <!-- Form Tambah Produksi -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Data Produksi</h2>
                            <form id="addForm" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="id_produksi" class="block text-sm font-medium text-gray-700">ID Produksi</label>
                                        <input type="text" id="id_produksi" name="id_produksi" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="PROD-<?= count($produksi_data) + 1 ?>">
                                    </div>
                                    <div>
                                        <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                        <select id="lahan_id" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Lahan</option>
                                            <?php foreach ($lahan as $id_lahan => $data_lahan): ?>
                                                <option value="<?= $id_lahan ?>"><?= $data_lahan['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- Info tambahan -->
                                        <div class="mt-2 space-y-1 text-sm text-gray-500">
                                            <div id="petani-info-add" class="hidden">
                                                Petani: <span id="petani-name-add" class="font-medium"></span>
                                            </div>
                                            <div id="ics-info-add" class="hidden">
                                                ICS: <span id="ics-name-add" class="font-medium"></span>
                                            </div>
                                            <div id="lokasi-info-add" class="hidden">
                                                Lokasi: <span id="lokasi-add" class="font-medium"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Panen</label>
                                        <input type="date" id="date" name="date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="jumlah_panen" class="block text-sm font-medium text-gray-700">Hasil (kg)</label>
                                        <input type="number" id="jumlah_panen" name="jumlah_panen" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="luas" class="block text-sm font-medium text-gray-700">Luas Lahan (ha)</label>
                                        <input type="number" step="0.01" id="luas" name="luas" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="upah" class="block text-sm font-medium text-gray-700">Upah (Rp)</label>
                                        <input type="number" id="upah" name="upah" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Petani yang Terlibat</label>
                                        <div id="petani-container" class="mt-2 space-y-2">
                                            <div class="flex space-x-2">
                                                <select name="petani_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Pilih Petani</option>
                                                    <?php foreach ($petani_list as $petani): ?>
                                                        <option value="<?= $petani['id'] ?>"><?= $petani['nama'] ?> (ID: <?= $petani['id'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="button" onclick="tambahPetani()" class="bg-green-500 text-white px-3 rounded-md">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Pekerja yang Terlibat</label>
                                        <div id="pekerja-container" class="mt-2 space-y-2">
                                            <div class="flex space-x-2">
                                                <select name="pekerja_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Pilih Pekerja</option>
                                                    <?php foreach ($pekerja_list as $pekerja): ?>
                                                        <option value="<?= $pekerja['id'] ?>"><?= $pekerja['nama'] ?> (ID: <?= $pekerja['id'] ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="button" onclick="tambahPekerja()" class="bg-green-500 text-white px-3 rounded-md">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Catatan</label>
                                        <textarea id="keterangan" name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end space-x-3">
                                    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                                    <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php elseif ($action === 'edit' && $selected_produksi): ?>
                    <!-- Form Edit Produksi -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Produksi #PROD-<?= $selected_produksi['id'] ?></h2>
                            <form id="editForm" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="id_produksi_edit" class="block text-sm font-medium text-gray-700">ID Produksi</label>
                                        <input type="text" id="id_produksi_edit" name="id_produksi" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="PROD-<?= $selected_produksi['id'] ?>">
                                    </div>
                                    <div>
                                        <label for="lahan_id_edit" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                        <select id="lahan_id_edit" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Lahan</option>
                                            <?php foreach ($lahan as $id_lahan => $data_lahan): ?>
                                                <option value="<?= $id_lahan ?>" <?= ($id_lahan == $selected_produksi['plot_id']) ? 'selected' : '' ?>><?= $data_lahan['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- Info tambahan -->
                                        <div class="mt-2 space-y-1 text-sm text-gray-500">
                                            <div id="petani-info-edit">
                                                Petani: <span id="petani-name-edit"><?= $lahan[$selected_produksi['plot_id']]['farmer_name'] ?? '' ?></span>
                                            </div>
                                            <div id="ics-info-edit">
                                                ICS: <span id="ics-name-edit"><?= $lahan[$selected_produksi['plot_id']]['ics_name'] ?? '' ?></span>
                                            </div>
                                            <div id="lokasi-info-edit">
                                                Lokasi: <span id="lokasi-edit">
                                                    <?= $lahan[$selected_produksi['plot_id']]['alamat'] ?? '' ?>, 
                                                    <?= $lahan[$selected_produksi['plot_id']]['kecamatan'] ?? '' ?>, 
                                                    <?= $lahan[$selected_produksi['plot_id']]['kabupaten'] ?? '' ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="date_edit" class="block text-sm font-medium text-gray-700">Tanggal Panen</label>
                                        <input type="date" id="date_edit" name="date" value="<?= $selected_produksi['date'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="jumlah_panen_edit" class="block text-sm font-medium text-gray-700">Hasil (kg)</label>
                                        <input type="number" id="jumlah_panen_edit" name="jumlah_panen" value="<?= $selected_produksi['jumlah_panen'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="luas_edit" class="block text-sm font-medium text-gray-700">Luas Lahan (ha)</label>
                                        <input type="number" step="0.01" id="luas_edit" name="luas" value="<?= $selected_produksi['luas'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="upah_edit" class="block text-sm font-medium text-gray-700">Upah (Rp)</label>
                                        <input type="number" id="upah_edit" name="upah" value="<?= $selected_produksi['upah'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Petani yang Terlibat</label>
                                        <div id="petani-container-edit" class="mt-2 space-y-2">
                                            <?php foreach ($selected_produksi['petani'] as $index => $petani): ?>
                                                <div class="flex space-x-2">
                                                    <select name="petani_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                        <option value="">Pilih Petani</option>
                                                        <?php foreach ($petani_list as $p): ?>
                                                            <option value="<?= $p['id'] ?>" <?= $p['id'] == $petani['id'] ? 'selected' : '' ?>>
                                                                <?= $p['nama'] ?> (ID: <?= $p['id'] ?>)
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php if ($index === 0): ?>
                                                        <button type="button" onclick="tambahPetaniEdit()" class="bg-green-500 text-white px-3 rounded-md">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" onclick="hapusBaris(this)" class="bg-red-500 text-white px-3 rounded-md">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Pekerja yang Terlibat</label>
                                        <div id="pekerja-container-edit" class="mt-2 space-y-2">
                                            <?php foreach ($selected_produksi['pekerja'] as $index => $pekerja): ?>
                                                <div class="flex space-x-2">
                                                    <select name="pekerja_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                        <option value="">Pilih Pekerja</option>
                                                        <?php foreach ($pekerja_list as $p): ?>
                                                            <option value="<?= $p['id'] ?>" <?= $p['id'] == $pekerja['id'] ? 'selected' : '' ?>>
                                                                <?= $p['nama'] ?> (ID: <?= $p['id'] ?>)
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php if ($index === 0): ?>
                                                        <button type="button" onclick="tambahPekerjaEdit()" class="bg-green-500 text-white px-3 rounded-md">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" onclick="hapusBaris(this)" class="bg-red-500 text-white px-3 rounded-md">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="keterangan_edit" class="block text-sm font-medium text-gray-700">Catatan</label>
                                        <textarea id="keterangan_edit" name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $selected_produksi['keterangan'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end space-x-3">
                                    <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                                    <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Halaman Tidak Ditemukan -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Halaman Tidak Ditemukan</h2>
                            <p class="text-gray-600">Maaf, halaman yang Anda cari tidak tersedia.</p>
                            <a href="produksi.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Kembali ke Daftar Produksi</a>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <script>
        // Fungsi untuk menampilkan info tambahan saat lahan dipilih di form tambah
        document.getElementById('lahan_id')?.addEventListener('change', function() {
            const selectedLahanId = this.value;
            const lahanData = <?= json_encode($lahan) ?>;
            
            const petaniInfoDiv = document.getElementById('petani-info-add');
            const petaniNameSpan = document.getElementById('petani-name-add');
            const icsInfoDiv = document.getElementById('ics-info-add');
            const icsNameSpan = document.getElementById('ics-name-add');
            const lokasiInfoDiv = document.getElementById('lokasi-info-add');
            const lokasiSpan = document.getElementById('lokasi-add');
            
            if (selectedLahanId && lahanData[selectedLahanId]) {
                petaniInfoDiv.classList.remove('hidden');
                petaniNameSpan.textContent = lahanData[selectedLahanId]['farmer_name'];
                
                icsInfoDiv.classList.remove('hidden');
                icsNameSpan.textContent = lahanData[selectedLahanId]['ics_name'];
                
                lokasiInfoDiv.classList.remove('hidden');
                lokasiSpan.textContent = `${lahanData[selectedLahanId]['alamat']}, ${lahanData[selectedLahanId]['kecamatan']}, ${lahanData[selectedLahanId]['kabupaten']}`;
            } else {
                petaniInfoDiv.classList.add('hidden');
                icsInfoDiv.classList.add('hidden');
                lokasiInfoDiv.classList.add('hidden');
            }
        });

        // Fungsi untuk menampilkan info tambahan saat lahan dipilih di form edit
        document.getElementById('lahan_id_edit')?.addEventListener('change', function() {
            const selectedLahanId = this.value;
            const lahanData = <?= json_encode($lahan) ?>;
            
            const petaniNameSpan = document.getElementById('petani-name-edit');
            const icsNameSpan = document.getElementById('ics-name-edit');
            const lokasiSpan = document.getElementById('lokasi-edit');
            
            if (selectedLahanId && lahanData[selectedLahanId]) {
                petaniNameSpan.textContent = lahanData[selectedLahanId]['farmer_name'];
                icsNameSpan.textContent = lahanData[selectedLahanId]['ics_name'];
                lokasiSpan.textContent = `${lahanData[selectedLahanId]['alamat']}, ${lahanData[selectedLahanId]['kecamatan']}, ${lahanData[selectedLahanId]['kabupaten']}`;
            } else {
                petaniNameSpan.textContent = '';
                icsNameSpan.textContent = '';
                lokasiSpan.textContent = '';
            }
        });

        // Untuk form edit, jika sudah ada lahan yang dipilih, tampilkan info petani
        document.addEventListener('DOMContentLoaded', function() {
            const editSelect = document.getElementById('lahan_id_edit');
            if (editSelect && editSelect.value !== '') {
                const event = new Event('change');
                editSelect.dispatchEvent(event);
            }
        });

        // Fungsi untuk menambah input petani di form tambah
        function tambahPetani() {
            const container = document.getElementById('petani-container');
            const div = document.createElement('div');
            div.className = 'flex space-x-2';
            div.innerHTML = `
                <select name="petani_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Petani</option>
                    <?php foreach ($petani_list as $petani): ?>
                        <option value="<?= $petani['id'] ?>"><?= $petani['nama'] ?> (ID: <?= $petani['id'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="hapusBaris(this)" class="bg-red-500 text-white px-3 rounded-md">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(div);
        }

        // Fungsi untuk menambah input pekerja di form tambah
        function tambahPekerja() {
            const container = document.getElementById('pekerja-container');
            const div = document.createElement('div');
            div.className = 'flex space-x-2';
            div.innerHTML = `
                <select name="pekerja_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Pekerja</option>
                    <?php foreach ($pekerja_list as $pekerja): ?>
                        <option value="<?= $pekerja['id'] ?>"><?= $pekerja['nama'] ?> (ID: <?= $pekerja['id'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="hapusBaris(this)" class="bg-red-500 text-white px-3 rounded-md">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(div);
        }

        // Fungsi untuk menambah input petani di form edit
        function tambahPetaniEdit() {
            const container = document.getElementById('petani-container-edit');
            const div = document.createElement('div');
            div.className = 'flex space-x-2';
            div.innerHTML = `
                <select name="petani_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Petani</option>
                    <?php foreach ($petani_list as $petani): ?>
                        <option value="<?= $petani['id'] ?>"><?= $petani['nama'] ?> (ID: <?= $petani['id'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="hapusBaris(this)" class="bg-red-500 text-white px-3 rounded-md">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(div);
        }

        // Fungsi untuk menambah input pekerja di form edit
        function tambahPekerjaEdit() {
            const container = document.getElementById('pekerja-container-edit');
            const div = document.createElement('div');
            div.className = 'flex space-x-2';
            div.innerHTML = `
                <select name="pekerja_id[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Pekerja</option>
                    <?php foreach ($pekerja_list as $pekerja): ?>
                        <option value="<?= $pekerja['id'] ?>"><?= $pekerja['nama'] ?> (ID: <?= $pekerja['id'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <button type="button" onclick="hapusBaris(this)" class="bg-red-500 text-white px-3 rounded-md">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(div);
        }

        // Fungsi untuk menghapus baris input
        function hapusBaris(button) {
            button.parentElement.remove();
        }

        // Fungsi konfirmasi hapus
        function confirmDelete(id) {
            return confirm('Apakah Anda yakin ingin menghapus data produksi PROD-' + id + '?');
        }
    </script>

    <?php include 'footer.php'; ?>
