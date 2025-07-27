<?php
// Simulasi data dummy untuk modul NKT/HCV

// Data master jenis NKT
$dummyJenisNKT = [
    ['jenis_id' => 1, 'nama_jenis' => 'NKT 1 & 4', 'keterangan' => 'Monitoring biodiversitas', 'order' => 1],
    ['jenis_id' => 2, 'nama_jenis' => 'Patok Sempadan', 'keterangan' => 'Perbatasan kawasan konservasi', 'order' => 2],
    ['jenis_id' => 3, 'nama_jenis' => 'Potensi Kebakaran', 'keterangan' => 'Deteksi awal area rawan api', 'order' => 3],
];

// Data master parameter
$dummyParameter = [
    ['parameter_id' => 1, 'kode' => 'BIO-001', 'nama_parameter' => 'Biodiversity', 'jenis_id' => 1, 'tipe' => 'pilihan', 'order' => 1],
    ['parameter_id' => 2, 'kode' => 'BIO-002', 'nama_parameter' => 'Vegetasi', 'jenis_id' => 1, 'tipe' => 'text', 'order' => 2],
    ['parameter_id' => 3, 'kode' => 'PAT-001', 'nama_parameter' => 'Kondisi Patok', 'jenis_id' => 2, 'tipe' => 'pilihan', 'order' => 1],
    ['parameter_id' => 4, 'kode' => 'FIRE-001', 'nama_parameter' => 'Potensi Api', 'jenis_id' => 3, 'tipe' => 'pilihan', 'order' => 1],
];

// Data master pertanyaan
$dummyPertanyaan = [
    ['pertanyaan_id' => 1, 'parameter_id' => 1, 'jenis_id' => 1, 'pertanyaan' => 'Apakah terdapat keanekaragaman hayati?', 'tipe_jawaban' => 'pilihan', 'order' => 1],
    ['pertanyaan_id' => 2, 'parameter_id' => 1, 'jenis_id' => 1, 'pertanyaan' => 'Jenis keanekaragaman hayati yang ditemukan', 'tipe_jawaban' => 'text', 'order' => 2],
    ['pertanyaan_id' => 3, 'parameter_id' => 3, 'jenis_id' => 2, 'pertanyaan' => 'Apakah patok sempadan masih utuh?', 'tipe_jawaban' => 'pilihan', 'order' => 1],
    ['pertanyaan_id' => 4, 'parameter_id' => 4, 'jenis_id' => 3, 'pertanyaan' => 'Terdapat bahan mudah terbakar dalam radius 5m?', 'tipe_jawaban' => 'pilihan', 'order' => 1],
];

// Data master pilihan jawaban
$dummyPilihanJawaban = [
    ['pilihan_id' => 1, 'pertanyaan_id' => 1, 'jawaban' => 'Ya', 'order' => 1],
    ['pilihan_id' => 2, 'pertanyaan_id' => 1, 'jawaban' => 'Tidak', 'order' => 2],
    ['pilihan_id' => 3, 'pertanyaan_id' => 3, 'jawaban' => 'Utuh', 'order' => 1],
    ['pilihan_id' => 4, 'pertanyaan_id' => 3, 'jawaban' => 'Rusak', 'order' => 2],
    ['pilihan_id' => 5, 'pertanyaan_id' => 3, 'jawaban' => 'Hilang', 'order' => 3],
    ['pilihan_id' => 6, 'pertanyaan_id' => 4, 'jawaban' => 'Ya', 'order' => 1],
    ['pilihan_id' => 7, 'pertanyaan_id' => 4, 'jawaban' => 'Tidak', 'order' => 2],
];

// Data plot kebun
$dummyPlotKebun = [
    ['plot_id' => 'PLOT-001', 'nama_plot' => 'Blok A - Plot 01'],
    ['plot_id' => 'PLOT-002', 'nama_plot' => 'Blok A - Plot 02'],
    ['plot_id' => 'PLOT-003', 'nama_plot' => 'Blok B - Plot 01'],
];

// Data tim lapangan
$dummyTimLapangan = [
    ['tim_id' => 'TIM-A', 'nama_tim' => 'Tim Monitoring A'],
    ['tim_id' => 'TIM-B', 'nama_tim' => 'Tim Patroli B'],
];

// Data respon NKT
$dummyResponNKT = [
    [
        'respon_id' => 'NKT-001',
        'jenis_id' => 1,
        'plot_id' => 'PLOT-001',
        'tim_id' => 'TIM-A',
        'tanggal' => '2025-07-24',
        'catatan_umum' => 'Tidak ditemukan masalah signifikan',
        'detail_respon' => [
            [
                'detail_id' => 1,
                'pertanyaan_id' => 1,
                'jawaban' => 'Ya',
                'catatan' => 'Ditemukan 3 jenis burung'
            ],
            [
                'detail_id' => 2,
                'pertanyaan_id' => 2,
                'jawaban' => 'Burung, kupu-kupu, dan tanaman langka',
                'catatan' => ''
            ]
        ]
    ],
    [
        'respon_id' => 'NKT-002',
        'jenis_id' => 3,
        'plot_id' => 'PLOT-003',
        'tim_id' => 'TIM-B',
        'tanggal' => '2025-07-25',
        'catatan_umum' => 'Area perlu pembersihan',
        'detail_respon' => [
            [
                'detail_id' => 3,
                'pertanyaan_id' => 4,
                'jawaban' => 'Ya',
                'catatan' => 'Banyak ranting kering menumpuk'
            ]
        ]
    ]
];

// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$submodule = isset($_GET['submodule']) ? $_GET['submodule'] : 'respon';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Pagination configuration
$perPage = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage);

// Filter variables
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$jenisFilter = isset($_GET['jenis_filter']) ? $_GET['jenis_filter'] : '';
$plotFilter = isset($_GET['plot_filter']) ? $_GET['plot_filter'] : '';
$tanggalFilter = isset($_GET['tanggal_filter']) ? $_GET['tanggal_filter'] : '';

// Data yang akan ditampilkan
$currentData = [];
$totalItems = 0;

switch ($submodule) {
    case 'respon':
        $currentData = $dummyResponNKT;
        $totalItems = count($currentData);
        break;
    case 'pertanyaan':
        $currentData = $dummyPertanyaan;
        $totalItems = count($currentData);
        break;
    case 'jenis':
        $currentData = $dummyJenisNKT;
        $totalItems = count($currentData);
        break;
    case 'parameter':
        $currentData = $dummyParameter;
        $totalItems = count($currentData);
        break;
    case 'pilihan':
        $currentData = $dummyPilihanJawaban;
        $totalItems = count($currentData);
        break;
}

// Apply filters if needed
if ($searchTerm !== '') {
    $currentData = array_filter($currentData, function($item) use ($searchTerm, $submodule) {
        if ($submodule === 'respon') {
            return stripos($item['respon_id'], $searchTerm) !== false;
        } elseif ($submodule === 'pertanyaan') {
            return stripos($item['pertanyaan'], $searchTerm) !== false;
        } elseif ($submodule === 'jenis') {
            return stripos($item['nama_jenis'], $searchTerm) !== false;
        } elseif ($submodule === 'parameter') {
            return stripos($item['nama_parameter'], $searchTerm) !== false;
        } elseif ($submodule === 'pilihan') {
            return stripos($item['jawaban'], $searchTerm) !== false;
        }
        return false;
    });
    $totalItems = count($currentData);
}

if ($jenisFilter !== '' && $submodule === 'respon') {
    $currentData = array_filter($currentData, function($item) use ($jenisFilter) {
        return $item['jenis_id'] == $jenisFilter;
    });
    $totalItems = count($currentData);
}

if ($plotFilter !== '' && $submodule === 'respon') {
    $currentData = array_filter($currentData, function($item) use ($plotFilter) {
        return $item['plot_id'] === $plotFilter;
    });
    $totalItems = count($currentData);
}

if ($tanggalFilter !== '' && $submodule === 'respon') {
    $currentData = array_filter($currentData, function($item) use ($tanggalFilter) {
        return $item['tanggal'] === $tanggalFilter;
    });
    $totalItems = count($currentData);
}

// Pagination logic
$totalPages = ceil($totalItems / $perPage);
$currentPage = min($currentPage, $totalPages);
$offset = ($currentPage - 1) * $perPage;
$currentPageData = array_slice($currentData, $offset, $perPage);

// Data untuk form edit/detail
$selectedItem = null;
if ($id !== '' && $action !== 'list') {
    foreach ($currentData as $item) {
        if (($item['respon_id'] ?? $item['pertanyaan_id'] ?? $item['jenis_id'] ?? $item['parameter_id'] ?? $item['pilihan_id'] ?? '') == $id) {
            $selectedItem = $item;
            break;
        }
    }
}

include 'header.php';
?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <div class="">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold mb-2">Manajemen NKT/HCV</h2>
            </div>
        </div>
    </div>
    
    <!-- Submodule Navigation -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-100">
        <nav class="flex space-x-4" aria-label="Tabs">
            <a href="?submodule=respon" class="<?= $submodule === 'respon' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Respon NKT
            </a>
            <a href="?submodule=pertanyaan" class="<?= $submodule === 'pertanyaan' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Pertanyaan
            </a>
            <a href="?submodule=jenis" class="<?= $submodule === 'jenis' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Jenis NKT
            </a>
            <a href="?submodule=parameter" class="<?= $submodule === 'parameter' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Parameter
            </a>
            <a href="?submodule=pilihan" class="<?= $submodule === 'pilihan' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Pilihan Jawaban
            </a>
        </nav>
    </div>

    <?php if ($action === 'list'): ?>
        <!-- List View -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    <?php 
                    switch($submodule) {
                        case 'respon': echo 'Daftar Respon NKT/HCV'; break;
                        case 'pertanyaan': echo 'Daftar Pertanyaan NKT'; break;
                        case 'jenis': echo 'Daftar Jenis NKT'; break;
                        case 'parameter': echo 'Daftar Parameter'; break;
                        case 'pilihan': echo 'Daftar Pilihan Jawaban'; break;
                    }
                    ?>
                </h2>
                <?php if ($submodule !== 'pilihan'): ?>
                    <a href="?action=add&submodule=<?= $submodule ?>" class="px-4 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#d69500] focus:outline-none focus:ring-2 focus:ring-[#F0AB00] flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah
                    </a>
                <?php endif; ?>
            </div>

            <!-- Filter Section -->
            <div class="p-4 bg-gray-50 border-b">
                <form method="get" class="flex flex-col gap-4">
                    <input type="hidden" name="action" value="list">
                    <input type="hidden" name="submodule" value="<?= $submodule ?>">

                    <!-- Global Search -->
                    <div class="flex-1">
                        <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Cari <?php 
                                switch($submodule) {
                                    case 'respon': echo 'ID Respon'; break;
                                    case 'pertanyaan': echo 'Pertanyaan'; break;
                                    case 'jenis': echo 'Jenis NKT'; break;
                                    case 'parameter': echo 'Parameter'; break;
                                    case 'pilihan': echo 'Pilihan Jawaban'; break;
                                }
                            ?>..."
                            value="<?= htmlspecialchars($searchTerm) ?>">
                    </div>

                    <!-- Additional Filters -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php if ($submodule === 'respon'): ?>
                            <div>
                                <select name="jenis_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Jenis</option>
                                    <?php foreach ($dummyJenisNKT as $jenis): ?>
                                        <option value="<?= $jenis['jenis_id'] ?>" <?= $jenisFilter == $jenis['jenis_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($jenis['nama_jenis']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <select name="plot_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Plot</option>
                                    <?php foreach ($dummyPlotKebun as $plot): ?>
                                        <option value="<?= $plot['plot_id'] ?>" <?= $plotFilter === $plot['plot_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($plot['nama_plot']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <input type="date" name="tanggal_filter" value="<?= htmlspecialchars($tanggalFilter) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        <?php elseif ($submodule === 'pertanyaan'): ?>
                            <div>
                                <select name="jenis_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Jenis</option>
                                    <?php foreach ($dummyJenisNKT as $jenis): ?>
                                        <option value="<?= $jenis['jenis_id'] ?>">
                                            <?= htmlspecialchars($jenis['nama_jenis']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <select name="parameter_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Parameter</option>
                                    <?php foreach ($dummyParameter as $param): ?>
                                        <option value="<?= $param['parameter_id'] ?>">
                                            <?= htmlspecialchars($param['nama_parameter']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php elseif ($submodule === 'parameter'): ?>
                            <div>
                                <select name="jenis_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Jenis</option>
                                    <?php foreach ($dummyJenisNKT as $jenis): ?>
                                        <option value="<?= $jenis['jenis_id'] ?>">
                                            <?= htmlspecialchars($jenis['nama_jenis']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php elseif ($submodule === 'pilihan'): ?>
                            <div>
                                <select name="pertanyaan_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Pertanyaan</option>
                                    <?php foreach ($dummyPertanyaan as $pertanyaan): ?>
                                        <option value="<?= $pertanyaan['pertanyaan_id'] ?>">
                                            <?= htmlspecialchars($pertanyaan['pertanyaan']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <?php if ($submodule === 'respon'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Respon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plot Kebun</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diisi Oleh</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pertanyaan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'pertanyaan'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Jawaban</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'jenis'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'parameter'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Parameter</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'pilihan'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jawaban</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($currentPageData)): ?>
                            <tr>
                                <td colspan="<?= $submodule === 'respon' ? 8 : ($submodule === 'pertanyaan' ? 6 : ($submodule === 'jenis' ? 5 : ($submodule === 'parameter' ? 6 : 5))) ?>" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data ditemukan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($currentPageData as $index => $item): ?>
                                <tr>
                                    <?php if ($submodule === 'respon'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 + $offset ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['respon_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $jenisName = '';
                                                foreach ($dummyJenisNKT as $jenis) {
                                                    if ($jenis['jenis_id'] === $item['jenis_id']) {
                                                        $jenisName = $jenis['nama_jenis'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($jenisName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $plotName = '';
                                                foreach ($dummyPlotKebun as $plot) {
                                                    if ($plot['plot_id'] === $item['plot_id']) {
                                                        $plotName = $plot['nama_plot'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($plotName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['tanggal']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $timName = '';
                                                foreach ($dummyTimLapangan as $tim) {
                                                    if ($tim['tim_id'] === $item['tim_id']) {
                                                        $timName = $tim['nama_tim'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($timName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= count($item['detail_respon']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=detail&submodule=respon&id=<?= urlencode($item['respon_id']) ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?action=edit&submodule=respon&id=<?= urlencode($item['respon_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'pertanyaan'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 + $offset ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $paramName = '';
                                                foreach ($dummyParameter as $param) {
                                                    if ($param['parameter_id'] === $item['parameter_id']) {
                                                        $paramName = $param['nama_parameter'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($paramName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $jenisName = '';
                                                foreach ($dummyJenisNKT as $jenis) {
                                                    if ($jenis['jenis_id'] === $item['jenis_id']) {
                                                        $jenisName = $jenis['nama_jenis'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($jenisName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($item['pertanyaan']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $item['tipe_jawaban'] === 'pilihan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' ?>">
                                                <?= $item['tipe_jawaban'] === 'pilihan' ? 'Pilihan' : 'Text Bebas' ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=pertanyaan&id=<?= urlencode($item['pertanyaan_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <?php if ($item['tipe_jawaban'] === 'pilihan'): ?>
                                                <a href="?submodule=pilihan&pertanyaan_filter=<?= $item['pertanyaan_id'] ?>" class="text-purple-600 hover:text-purple-900" title="Kelola Pilihan">
                                                    <i class="fas fa-list-ul"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    <?php elseif ($submodule === 'jenis'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['jenis_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['nama_jenis']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($item['keterangan']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=jenis&id=<?= urlencode($item['jenis_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'parameter'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['kode']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['nama_parameter']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $jenisName = '';
                                                foreach ($dummyJenisNKT as $jenis) {
                                                    if ($jenis['jenis_id'] === $item['jenis_id']) {
                                                        $jenisName = $jenis['nama_jenis'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($jenisName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $item['tipe'] === 'pilihan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' ?>">
                                                <?= $item['tipe'] === 'pilihan' ? 'Pilihan' : 'Text Bebas' ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=parameter&id=<?= urlencode($item['parameter_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'pilihan'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['pilihan_id']) ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <?php 
                                                $pertanyaanText = '';
                                                foreach ($dummyPertanyaan as $pertanyaan) {
                                                    if ($pertanyaan['pertanyaan_id'] === $item['pertanyaan_id']) {
                                                        $pertanyaanText = $pertanyaan['pertanyaan'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars(substr($pertanyaanText, 0, 50)) . (strlen($pertanyaanText) > 50 ? '...' : '');
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['jawaban']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=pilihan&id=<?= urlencode($item['pilihan_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                        Sebelumnya
                    </a>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                        Selanjutnya
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium"><?= $offset + 1 ?></span>
                            sampai
                            <span class="font-medium"><?= min($offset + $perPage, $totalItems) ?></span>
                            dari
                            <span class="font-medium"><?= $totalItems ?></span>
                            data
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                <span class="sr-only">Sebelumnya</span>
                                <i class="fas fa-chevron-left"></i>
                            </a>

                            <?php
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);

                            if ($startPage > 1) {
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                if ($startPage > 2) {
                                    echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                }
                            }

                            for ($i = $startPage; $i <= $endPage; $i++) {
                                $activeClass = ($i == $currentPage) ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $activeClass . '">' . $i . '</a>';
                            }

                            if ($endPage < $totalPages) {
                                if ($endPage < $totalPages - 1) {
                                    echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                }
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                            }
                            ?>

                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                <span class="sr-only">Selanjutnya</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($action === 'add' || $action === 'edit'): ?>
        <!-- Form Add/Edit -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    <?= $action === 'add' ? 'Tambah' : 'Edit' ?> 
                    <?php 
                    switch($submodule) {
                        case 'respon': echo 'Respon NKT/HCV'; break;
                        case 'pertanyaan': echo 'Pertanyaan NKT'; break;
                        case 'jenis': echo 'Jenis NKT'; break;
                        case 'parameter': echo 'Parameter'; break;
                        case 'pilihan': echo 'Pilihan Jawaban'; break;
                    }
                    ?>
                </h2>
                <a href="?action=list&submodule=<?= $submodule ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </a>
            </div>

            <form>
                <?php if ($submodule === 'respon'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="jenis_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis NKT/HCV</label>
                                <select id="jenis_id" name="jenis_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Jenis NKT/HCV</option>
                                    <?php foreach ($dummyJenisNKT as $jenis): ?>
                                        <option value="<?= $jenis['jenis_id'] ?>" <?= ($selectedItem && $selectedItem['jenis_id'] === $jenis['jenis_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($jenis['nama_jenis']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="plot_id" class="block text-sm font-medium text-gray-700 mb-1">Plot Kebun</label>
                                <select id="plot_id" name="plot_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Plot Kebun</option>
                                    <?php foreach ($dummyPlotKebun as $plot): ?>
                                        <option value="<?= $plot['plot_id'] ?>" <?= ($selectedItem && $selectedItem['plot_id'] === $plot['plot_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($plot['nama_plot']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="tim_id" class="block text-sm font-medium text-gray-700 mb-1">Tim Lapangan</label>
                                <select id="tim_id" name="tim_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Tim Lapangan</option>
                                    <?php foreach ($dummyTimLapangan as $tim): ?>
                                        <option value="<?= $tim['tim_id'] ?>" <?= ($selectedItem && $selectedItem['tim_id'] === $tim['tim_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($tim['nama_tim']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" value="<?= $selectedItem ? htmlspecialchars($selectedItem['tanggal']) : date('Y-m-d') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label for="catatan_umum" class="block text-sm font-medium text-gray-700 mb-1">Catatan Umum</label>
                                <textarea id="catatan_umum" name="catatan_umum" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"><?= $selectedItem ? htmlspecialchars($selectedItem['catatan_umum']) : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pertanyaan Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pertanyaan dan Jawaban</h3>
                        
                        <?php 
                        $pertanyaanToShow = [];
                        if ($selectedItem) {
                            // Jika edit, tampilkan pertanyaan yang sudah dijawab
                            foreach ($selectedItem['detail_respon'] as $detail) {
                                foreach ($dummyPertanyaan as $pertanyaan) {
                                    if ($pertanyaan['pertanyaan_id'] === $detail['pertanyaan_id']) {
                                        $pertanyaanToShow[] = [
                                            'pertanyaan' => $pertanyaan,
                                            'jawaban' => $detail['jawaban'],
                                            'catatan' => $detail['catatan']
                                        ];
                                        break;
                                    }
                                }
                            }
                        } else {
                            // Jika add, tampilkan semua pertanyaan berdasarkan jenis yang dipilih
                            $jenisId = $_GET['jenis_id'] ?? ($selectedItem['jenis_id'] ?? null);
                            if ($jenisId) {
                                foreach ($dummyPertanyaan as $pertanyaan) {
                                    if ($pertanyaan['jenis_id'] == $jenisId) {
                                        $pertanyaanToShow[] = [
                                            'pertanyaan' => $pertanyaan,
                                            'jawaban' => '',
                                            'catatan' => ''
                                        ];
                                    }
                                }
                            }
                        }
                        ?>
                        
                        <?php if (!empty($pertanyaanToShow)): ?>
                            <div class="space-y-6">
                                <?php foreach ($pertanyaanToShow as $index => $item): ?>
                                    <div class="p-4 border rounded-lg">
                                        <div class="mb-3">
                                            <label class="block text-sm font-medium text-gray-700 mb-1"><?= $index + 1 ?>. <?= htmlspecialchars($item['pertanyaan']['pertanyaan']) ?></label>
                                            
                                            <?php if ($item['pertanyaan']['tipe_jawaban'] === 'pilihan'): ?>
                                                <div class="mt-2 space-y-2">
                                                    <?php 
                                                    $pilihanForThisQuestion = array_filter($dummyPilihanJawaban, function($pilihan) use ($item) {
                                                        return $pilihan['pertanyaan_id'] === $item['pertanyaan']['pertanyaan_id'];
                                                    });
                                                    ?>
                                                    <?php foreach ($pilihanForThisQuestion as $pilihan): ?>
                                                        <div class="flex items-center">
                                                            <input type="radio" id="jawaban_<?= $item['pertanyaan']['pertanyaan_id'] ?>_<?= $pilihan['pilihan_id'] ?>" 
                                                                   name="jawaban[<?= $item['pertanyaan']['pertanyaan_id'] ?>]" 
                                                                   value="<?= htmlspecialchars($pilihan['jawaban']) ?>"
                                                                   <?= $item['jawaban'] === $pilihan['jawaban'] ? 'checked' : '' ?>
                                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                                            <label for="jawaban_<?= $item['pertanyaan']['pertanyaan_id'] ?>_<?= $pilihan['pilihan_id'] ?>" class="ml-2 block text-sm text-gray-700">
                                                                <?= htmlspecialchars($pilihan['jawaban']) ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else: ?>
                                                <input type="text" name="jawaban[<?= $item['pertanyaan']['pertanyaan_id'] ?>]" 
                                                       value="<?= htmlspecialchars($item['jawaban']) ?>" 
                                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                                            <textarea name="catatan[<?= $item['pertanyaan']['pertanyaan_id'] ?>]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"><?= htmlspecialchars($item['catatan']) ?></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500">Pilih jenis NKT/HCV terlebih dahulu untuk menampilkan pertanyaan.</p>
                        <?php endif; ?>
                    </div>
                    
                <?php elseif ($submodule === 'pertanyaan'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="parameter_id" class="block text-sm font-medium text-gray-700 mb-1">Parameter</label>
                            <select id="parameter_id" name="parameter_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Parameter</option>
                                <?php foreach ($dummyParameter as $param): ?>
                                    <option value="<?= $param['parameter_id'] ?>" <?= ($selectedItem && $selectedItem['parameter_id'] === $param['parameter_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($param['nama_parameter']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="jenis_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis NKT/HCV</label>
                            <select id="jenis_id" name="jenis_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Jenis NKT/HCV</option>
                                <?php foreach ($dummyJenisNKT as $jenis): ?>
                                    <option value="<?= $jenis['jenis_id'] ?>" <?= ($selectedItem && $selectedItem['jenis_id'] === $jenis['jenis_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($jenis['nama_jenis']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                            <textarea id="pertanyaan" name="pertanyaan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required><?= $selectedItem ? htmlspecialchars($selectedItem['pertanyaan']) : '' ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Jawaban</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" id="tipe_pilihan" name="tipe_jawaban" value="pilihan" 
                                           <?= ($selectedItem && $selectedItem['tipe_jawaban'] === 'pilihan') ? 'checked' : '' ?> 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="tipe_pilihan" class="ml-2 block text-sm text-gray-700">Pilihan</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="tipe_text" name="tipe_jawaban" value="text" 
                                           <?= (!$selectedItem || $selectedItem['tipe_jawaban'] === 'text') ? 'checked' : '' ?> 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="tipe_text" class="ml-2 block text-sm text-gray-700">Text Bebas</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php elseif ($submodule === 'jenis'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="nama_jenis" class="block text-sm font-medium text-gray-700 mb-1">Nama Jenis</label>
                            <input type="text" id="nama_jenis" name="nama_jenis" value="<?= $selectedItem ? htmlspecialchars($selectedItem['nama_jenis']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"><?= $selectedItem ? htmlspecialchars($selectedItem['keterangan']) : '' ?></textarea>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php elseif ($submodule === 'parameter'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="kode" class="block text-sm font-medium text-gray-700 mb-1">Kode Parameter</label>
                            <input type="text" id="kode" name="kode" value="<?= $selectedItem ? htmlspecialchars($selectedItem['kode']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="nama_parameter" class="block text-sm font-medium text-gray-700 mb-1">Nama Parameter</label>
                            <input type="text" id="nama_parameter" name="nama_parameter" value="<?= $selectedItem ? htmlspecialchars($selectedItem['nama_parameter']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="jenis_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis NKT/HCV</label>
                            <select id="jenis_id" name="jenis_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Jenis NKT/HCV</option>
                                <?php foreach ($dummyJenisNKT as $jenis): ?>
                                    <option value="<?= $jenis['jenis_id'] ?>" <?= ($selectedItem && $selectedItem['jenis_id'] === $jenis['jenis_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($jenis['nama_jenis']) ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Jawaban</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" id="tipe_pilihan" name="tipe" value="pilihan" 
                                           <?= ($selectedItem && $selectedItem['tipe'] === 'pilihan') ? 'checked' : '' ?> 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="tipe_pilihan" class="ml-2 block text-sm text-gray-700">Pilihan</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="tipe_text" name="tipe" value="text" 
                                           <?= (!$selectedItem || $selectedItem['tipe'] === 'text') ? 'checked' : '' ?> 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <label for="tipe_text" class="ml-2 block text-sm text-gray-700">Text Bebas</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php elseif ($submodule === 'pilihan'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="pertanyaan_id" class="block text-sm font-medium text-gray-700 mb-1">Pertanyaan</label>
                            <select id="pertanyaan_id" name="pertanyaan_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Pertanyaan</option>
                                <?php foreach ($dummyPertanyaan as $pertanyaan): ?>
                                    <?php if ($pertanyaan['tipe_jawaban'] === 'pilihan'): ?>
                                        <option value="<?= $pertanyaan['pertanyaan_id'] ?>" <?= ($selectedItem && $selectedItem['pertanyaan_id'] === $pertanyaan['pertanyaan_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($pertanyaan['pertanyaan']) ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="jawaban" class="block text-sm font-medium text-gray-700 mb-1">Jawaban</label>
                            <input type="text" id="jawaban" name="jawaban" value="<?= $selectedItem ? htmlspecialchars($selectedItem['jawaban']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200">
                    <a href="?action=list&submodule=<?= $submodule ?>" class="px-5 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#d69500] focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                        <?= $action === 'add' ? 'Simpan' : 'Update' ?>
                    </button>
                </div>
            </form>
        </div>
    <?php elseif ($action === 'detail'): ?>
        <!-- Detail View -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    Detail 
                    <?php 
                    switch($submodule) {
                        case 'respon': echo 'Respon NKT/HCV'; break;
                        case 'pertanyaan': echo 'Pertanyaan NKT'; break;
                        case 'jenis': echo 'Jenis NKT'; break;
                        case 'parameter': echo 'Parameter'; break;
                        case 'pilihan': echo 'Pilihan Jawaban'; break;
                    }
                    ?>
                </h2>
                <a href="?action=list&submodule=<?= $submodule ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </a>
            </div>

            <?php if ($selectedItem): ?>
                <?php if ($submodule === 'respon'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">ID Respon</label>
                                <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['respon_id']) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Jenis NKT/HCV</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $jenisName = '';
                                        foreach ($dummyJenisNKT as $jenis) {
                                            if ($jenis['jenis_id'] === $selectedItem['jenis_id']) {
                                                $jenisName = $jenis['nama_jenis'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($jenisName);
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Plot Kebun</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $plotName = '';
                                        foreach ($dummyPlotKebun as $plot) {
                                            if ($plot['plot_id'] === $selectedItem['plot_id']) {
                                                $plotName = $plot['nama_plot'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($plotName);
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal</label>
                                <p class="text-gray-900"><?= htmlspecialchars($selectedItem['tanggal']) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Diisi Oleh</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $timName = '';
                                        foreach ($dummyTimLapangan as $tim) {
                                            if ($tim['tim_id'] === $selectedItem['tim_id']) {
                                                $timName = $tim['nama_tim'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($timName);
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Catatan Umum</label>
                                <p class="text-gray-900 whitespace-pre-line"><?= htmlspecialchars($selectedItem['catatan_umum']) ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detail Jawaban Section -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Jawaban</h3>
                        
                        <div class="space-y-6">
                            <?php foreach ($selectedItem['detail_respon'] as $index => $detail): 
                                $pertanyaan = null;
                                foreach ($dummyPertanyaan as $p) {
                                    if ($p['pertanyaan_id'] === $detail['pertanyaan_id']) {
                                        $pertanyaan = $p;
                                        break;
                                    }
                                }
                                if (!$pertanyaan) continue;
                            ?>
                                <div class="p-4 border rounded-lg">
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Pertanyaan</label>
                                        <p class="text-gray-900"><?= htmlspecialchars($pertanyaan['pertanyaan']) ?></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Jawaban</label>
                                        <p class="text-gray-900"><?= htmlspecialchars($detail['jawaban']) ?></p>
                                    </div>
                                    <?php if (!empty($detail['catatan'])): ?>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Catatan</label>
                                            <p class="text-gray-900 whitespace-pre-line"><?= htmlspecialchars($detail['catatan']) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php elseif ($submodule === 'pertanyaan'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['pertanyaan_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Parameter</label>
                            <p class="text-gray-900">
                                <?php 
                                    $paramName = '';
                                    foreach ($dummyParameter as $param) {
                                        if ($param['parameter_id'] === $selectedItem['parameter_id']) {
                                            $paramName = $param['nama_parameter'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($paramName);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jenis NKT/HCV</label>
                            <p class="text-gray-900">
                                <?php 
                                    $jenisName = '';
                                    foreach ($dummyJenisNKT as $jenis) {
                                        if ($jenis['jenis_id'] === $selectedItem['jenis_id']) {
                                            $jenisName = $jenis['nama_jenis'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($jenisName);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Pertanyaan</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['pertanyaan']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tipe Jawaban</label>
                            <p class="text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $selectedItem['tipe_jawaban'] === 'pilihan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' ?>">
                                    <?= $selectedItem['tipe_jawaban'] === 'pilihan' ? 'Pilihan' : 'Text Bebas' ?>
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php elseif ($submodule === 'jenis'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['jenis_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Jenis</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['nama_jenis']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Keterangan</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['keterangan']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php elseif ($submodule === 'parameter'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Kode</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['kode']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Parameter</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['nama_parameter']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jenis NKT/HCV</label>
                            <p class="text-gray-900">
                                <?php 
                                    $jenisName = '';
                                    foreach ($dummyJenisNKT as $jenis) {
                                        if ($jenis['jenis_id'] === $selectedItem['jenis_id']) {
                                            $jenisName = $jenis['nama_jenis'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($jenisName);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tipe</label>
                            <p class="text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $selectedItem['tipe'] === 'pilihan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' ?>">
                                    <?= $selectedItem['tipe'] === 'pilihan' ? 'Pilihan' : 'Text Bebas' ?>
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php elseif ($submodule === 'pilihan'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['pilihan_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Pertanyaan</label>
                            <p class="text-gray-900">
                                <?php 
                                    $pertanyaanText = '';
                                    foreach ($dummyPertanyaan as $pertanyaan) {
                                        if ($pertanyaan['pertanyaan_id'] === $selectedItem['pertanyaan_id']) {
                                            $pertanyaanText = $pertanyaan['pertanyaan'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($pertanyaanText);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jawaban</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['jawaban']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-gray-500">Data tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>