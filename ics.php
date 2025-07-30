<?php include 'header.php'; ?>
<!-- Mode untuk menentukan tampilan -->
<?php
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Data Dummy ICS - Enhanced with SOP and Map functionality
$data_ics = [
    'ICS-2023-001' => [
        'nama' => 'Lembaga Sawit Kampar',
        'no_badan_hukum' => '123/KPR/2023',
        'jumlah_petani' => 50,
        'tgl_berdiri' => '2023-01-15',
        'tgl_legalitas' => '2023-02-20',
        'pic' => [
            'nama' => 'Budi Santoso',
            'kontak' => '08123456789',
            'email' => 'budi@sawitkampar.com'
        ],
        'alamat' => 'Jl. Sawit Makmur No. 12, Dusun Sejahtera',
        'provinsi' => 'Riau',
        'kabupaten' => 'Kampar',
        'kecamatan' => 'Bangkinang',
        'desa' => 'Bangkinang Kota',
        'lokasi' => '-0.335987, 101.025543', // Format: lat, lng
        'area_wilayah' => 'Kawasan Perkebunan Sawit Kampar',
        'dokumen' => [
            ['nama' => 'Akta Pendirian', 'file' => 'akta_pendirian.pdf'],
            ['nama' => 'SIUP', 'file' => 'siup.pdf']
        ],
        'logo' => 'https://via.placeholder.com/150',
        'sop' => [
            [
                'sop_id' => 'SOP-001',
                'nama' => 'SOP Pengelolaan Kebun',
                'file' => 'sop_pengelolaan.pdf',
                'versi' => '1.0',
                'tanggal_efektif' => '2023-03-01',
                'status' => 'Aktif',
                'sosialisasi' => [
                    [
                        'sosialisasi_id' => 'SOC-001',
                        'tanggal' => '2023-03-15',
                        'peserta' => 25,
                        'dokumen' => 'berita_acara_sosialisasi.pdf'
                    ]
                ]
            ],
            [
                'sop_id' => 'SOP-002',
                'nama' => 'SOP Panen Kelapa Sawit',
                'file' => 'sop_panen.pdf',
                'versi' => '2.1',
                'tanggal_efektif' => '2023-04-10',
                'status' => 'Aktif',
                'sosialisasi' => []
            ]
        ],
        'fasilitas' => [
            ['fasilitas' => 'Traktor', 'jumlah' => 2, 'keterangan' => 'Kondisi baik'],
            ['fasilitas' => 'Gudang', 'jumlah' => 1, 'keterangan' => 'Kapasitas 100 ton']
        ],
        'pengurus' => [
            'Ketua' => [
                ['nama' => 'Budi Santoso', 'status' => 'Aktif']
            ],
            'Bendahara' => [
                ['nama' => 'Ani Wijaya', 'status' => 'Aktif']
            ],
            'Anggota' => [
                ['nama' => 'Joko Susilo', 'status' => 'Aktif'],
                ['nama' => 'Siti Rahayu', 'status' => 'Aktif']
            ]
        ],
        'kelompok_tani' => [
            ['nama' => 'Kelompok Tani Makmur', 'jumlah_anggota' => 15],
            ['nama' => 'Kelompok Tani Sejahtera', 'jumlah_anggota' => 20]
        ],
        'status' => 'Aktif',
        'created_by' => 'admin1',
        'created_at' => '2023-01-10',
        'updated_by' => 'admin1',
        'updated_at' => '2023-03-15'
    ],
    'ICS-2023-002' => [
        'nama' => 'Koperasi Rokan Hulu',
        'no_badan_hukum' => '456/RHU/2023',
        'jumlah_petani' => 35,
        'tgl_berdiri' => '2023-03-10',
        'tgl_legalitas' => '2023-04-05',
        'pic' => [
            'nama' => 'Ani Wijaya',
            'kontak' => '08234567890',
            'email' => 'ani@koperasirh.com'
        ],
        'alamat' => 'Jl. Koperasi No. 45, Dusun Makmur',
        'provinsi' => 'Riau',
        'kabupaten' => 'Rokan Hulu',
        'kecamatan' => 'Pasir Pengaria',
        'desa' => 'Pasir Pengaria',
        'lokasi' => '0.596672, 100.751798',
        'area_wilayah' => 'Wilayah Rokan Hulu',
        'dokumen' => [
            ['nama' => 'Akta Notaris', 'file' => 'akta_notaris.pdf']
        ],
        'logo' => 'https://via.placeholder.com/150',
        'sop' => [
            [
                'sop_id' => 'SOP-003',
                'nama' => 'SOP Koperasi',
                'file' => 'sop_koperasi.pdf',
                'versi' => '1.2',
                'tanggal_efektif' => '2023-05-01',
                'status' => 'Aktif',
                'sosialisasi' => []
            ]
        ],
        'fasilitas' => [
            ['fasilitas' => 'Alat Penyemprot', 'jumlah' => 5, 'keterangan' => 'Kondisi baru']
        ],
        'pengurus' => [
            'Sekretaris' => [
                ['nama' => 'Siti Rahayu', 'status' => 'Aktif']
            ]
        ],
        'kelompok_tani' => [
            ['nama' => 'Kelompok Tani Rokan', 'jumlah_anggota' => 12]
        ],
        'status' => 'Proses Verifikasi',
        'created_by' => 'operator1',
        'created_at' => '2023-03-05',
        'updated_by' => 'operator1',
        'updated_at' => '2023-04-12'
    ]
];

// Data unik untuk filter
$kabupatens = array_unique(array_column($data_ics, 'kabupaten'));
$kecamatans = array_unique(array_column($data_ics, 'kecamatan'));
$statuses = array_unique(array_column($data_ics, 'status'));

// Initialize filtered data with all data first
$filtered_ics = $data_ics;

// Get filter parameters
$filter_kabupaten = isset($_GET['filter_kabupaten']) ? $_GET['filter_kabupaten'] : '';
$filter_kecamatan = isset($_GET['filter_kecamatan']) ? $_GET['filter_kecamatan'] : '';
$filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Apply filters
if ($filter_kabupaten) {
    $filtered_ics = array_filter($filtered_ics, function ($ics) use ($filter_kabupaten) {
        return $ics['kabupaten'] == $filter_kabupaten;
    });
}
if ($filter_kecamatan) {
    $filtered_ics = array_filter($filtered_ics, function ($ics) use ($filter_kecamatan) {
        return $ics['kecamatan'] == $filter_kecamatan;
    });
}
if ($filter_status) {
    $filtered_ics = array_filter($filtered_ics, function ($ics) use ($filter_status) {
        return $ics['status'] == $filter_status;
    });
}
if ($search) {
    $search = strtolower($search);
    $filtered_ics = array_filter($filtered_ics, function ($ics) use ($search) {
        return (strpos(strtolower($ics['nama']), $search) !== false ||
            strpos(strtolower($ics['pic']['nama']), $search) !== false ||
            strpos(strtolower($ics['pic']['kontak']), $search) !== false);
    });
}

// Konfigurasi Pagination
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalItems = count($filtered_ics);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = min($currentPage, $totalPages);
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedICS = array_slice($filtered_ics, $startIndex, $itemsPerPage, true);
?>
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php if ($mode === 'list'): ?>
                    Manajemen ICS
                <?php elseif ($mode === 'add'): ?>
                    Tambah ICS Baru
                <?php elseif ($mode === 'view'): ?>
                    Detail ICS
                <?php elseif ($mode === 'edit'): ?>
                    Edit Data ICS
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($mode === 'list'): ?>
                <!-- Tombol Tambah Data -->
                <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah ICS
                </a>
            <?php elseif ($mode === 'view'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <!-- Tombol Edit -->
                <a href="?mode=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            <?php elseif ($mode === 'edit' || $mode === 'add'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>
    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($mode === 'list'): ?>
            <!-- Halaman Daftar ICS -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="space-y-4">
                        <input type="hidden" name="mode" value="list">
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Cari data ICS...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Filter Kabupaten -->
                            <div>
                                <select id="filter_kabupaten" name="filter_kabupaten" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kabupaten</option>
                                    <?php foreach ($kabupatens as $kabupaten): ?>
                                        <option value="<?= htmlspecialchars($kabupaten) ?>" <?= $filter_kabupaten === $kabupaten ? 'selected' : '' ?>><?= htmlspecialchars($kabupaten) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Filter Kecamatan -->
                            <div>
                                <select id="filter_kecamatan" name="filter_kecamatan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kecamatan</option>
                                    <?php foreach ($kecamatans as $kecamatan): ?>
                                        <option value="<?= htmlspecialchars($kecamatan) ?>" <?= $filter_kecamatan === $kecamatan ? 'selected' : '' ?>><?= htmlspecialchars($kecamatan) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Filter Status -->
                            <div>
                                <select id="filter_status" name="filter_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <?php foreach ($statuses as $status): ?>
                                        <option value="<?= htmlspecialchars($status) ?>" <?= $filter_status === $status ? 'selected' : '' ?>><?= htmlspecialchars($status) ?></option>
                                    <?php endforeach; ?>
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID ICS</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama ICS</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PIC</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($paginatedICS)): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data ICS</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedICS as $id_ics => $ics):
                                    $rowNumber = $startIndex + array_search($id_ics, array_keys($filtered_ics)) + 1;
                                ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $id_ics ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $ics['nama'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div><?= $ics['pic']['nama'] ?></div>
                                            <div class="text-xs text-gray-500"><?= $ics['pic']['kontak'] ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $ics['jumlah_petani'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <?= $ics['kabupaten'] ?>, <?= $ics['provinsi'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($ics['status'] === 'Aktif'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                            <?php elseif ($ics['status'] === 'Proses Verifikasi'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses Verifikasi</span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="?mode=view&id=<?= $id_ics ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                                            <a href="?mode=edit&id=<?= $id_ics ?>" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                                            <button onclick="confirmDelete('<?= $id_ics ?>')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Controls -->
                <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
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
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Previous</span>
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
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
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
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium <?= $i == $currentPage ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' ?>">
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
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <?= $totalPages ?>
                                    </a>
                                <?php
                                }
                                ?>
                                <!-- Next Page Link -->
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($mode === 'add'): ?>
            <!-- Form Tambah ICS -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah ICS Baru</h2>
                    <form id="addForm" action="?mode=list" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="nama_ics" class="block text-sm font-medium text-gray-700 mb-1">Nama ICS*</label>
                                    <input type="text" id="nama_ics" name="nama_ics" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Lembaga Sawit Makmur" required>
                                </div>
                                <div class="mb-4">
                                    <label for="no_badan_hukum" class="block text-sm font-medium text-gray-700 mb-1">No. Badan Hukum</label>
                                    <input type="text" id="no_badan_hukum" name="no_badan_hukum" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 123/XYZ/2023">
                                </div>
                                <div class="mb-4">
                                    <label for="jumlah_petani" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Petani*</label>
                                    <input type="number" id="jumlah_petani" name="jumlah_petani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 50" required>
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_berdiri" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berdiri</label>
                                    <input type="date" id="tgl_berdiri" name="tgl_berdiri" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_legalitas" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Legalitas</label>
                                    <input type="date" id="tgl_legalitas" name="tgl_legalitas" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <h3 class="text-md font-medium text-gray-700 border-b pb-2 mb-4">Informasi PIC</h3>
                                <div class="mb-4">
                                    <label for="nama_pic" class="block text-sm font-medium text-gray-700 mb-1">Nama PIC*</label>
                                    <input type="text" id="nama_pic" name="nama_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Budi Santoso" required>
                                </div>
                                <div class="mb-4">
                                    <label for="kontak_pic" class="block text-sm font-medium text-gray-700 mb-1">Kontak PIC*</label>
                                    <input type="text" id="kontak_pic" name="kontak_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 08123456789" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email_pic" class="block text-sm font-medium text-gray-700 mb-1">Email PIC*</label>
                                    <input type="email" id="email_pic" name="email_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: pic@example.com" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi*</label>
                                    <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Proses Verifikasi">Proses Verifikasi</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Dokumen & Logo & SOP -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen & Logo & SOP</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Legalitas (Maks. 10 file)</label>
                                    <div class="flex items-center">
                                        <input type="file" multiple class="hidden" id="file-upload">
                                        <label for="file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-upload mr-2"></i>Unggah Dokumen
                                        </label>
                                        <span class="ml-2 text-sm text-gray-500">PDF, JPG, PNG (Maks. 5MB/file)</span>
                                    </div>
                                    <div id="file-list" class="mt-2 space-y-2"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                                    <div class="flex items-center">
                                        <input type="file" accept="image/*" class="hidden" id="logo-upload">
                                        <label for="logo-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-image mr-2"></i>Unggah Logo
                                        </label>
                                        <span class="ml-2 text-sm text-gray-500">JPG, PNG (Maks. 2MB)</span>
                                    </div>
                                    <div id="logo-preview" class="mt-2"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SOP (Maks. 5 file)</label>
                                    <div class="flex items-center">
                                        <input type="file" multiple class="hidden" id="sop-upload" accept=".pdf,.doc,.docx">
                                        <label for="sop-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-file-alt mr-2"></i>Unggah SOP
                                        </label>
                                        <span class="ml-2 text-sm text-gray-500">PDF, DOC (Maks. 5MB/file)</span>
                                    </div>
                                    <div id="sop-preview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Alamat & Lokasi -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat & Lokasi</h3>
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat (Jalan/Dusun)*</label>
                                <input type="text" id="alamat" name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jl. Sawit Makmur No. 12, Dusun Sejahtera" required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                        <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Riau" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten*</label>
                                        <select id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kabupaten</option>
                                            <option value="Kampar">Kampar</option>
                                            <option value="Rokan Hulu">Rokan Hulu</option>
                                            <option value="Indragiri Hulu">Indragiri Hulu</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
                                        <select id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa*</label>
                                        <select id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Desa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
                                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Koordinat)</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="text" id="lokasi" name="lokasi" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: -6.175392, 106.827153">
                                        <button type="button" onclick="showMapPicker()" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            <i class="fas fa-map-marker-alt"></i> Pilih di Peta
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="area_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Area Wilayah</label>
                                    <input type="text" id="area_wilayah" name="area_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kawasan Perkebunan Sawit">
                                </div>
                            </div>
                        </div>
                        <!-- Fasilitas -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Fasilitas</h3>
                                <button type="button" onclick="tambahFasilitas()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah Fasilitas
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="fasilitas-list">
                                        <!-- Data fasilitas akan diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Struktur Organisasi -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Struktur Organisasi</h3>
                                <div class="flex space-x-2">
                                    <button type="button" onclick="tambahJabatan()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jabatan
                                    </button>
                                    <button type="button" onclick="tambahAnggota()" class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-user-plus mr-1"></i>Tambah Anggota
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="struktur-list">
                                        <!-- Data struktur akan diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Kelompok Tani -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Kelompok Tani</h3>
                                <div class="flex space-x-2">
                                    <button type="button" onclick="tambahKelompokTani()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-plus mr-1"></i>Tambah Kelompok
                                    </button>
                                    <button type="button" onclick="pilihKelompokTani()" class="text-sm bg-[#2463ec] hover:bg-green-700 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-link mr-1"></i>Hubungkan Kelompok
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelompok</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anggota</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="kelompok-tani-list">
                                        <!-- Data kelompok tani akan diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="window.location.href='?mode=list'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                Simpan Data ICS
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($mode === 'view' && isset($id) && isset($data_ics[$id])): ?>
            <!-- Halaman Detail ICS -->
            <?php $ics = $data_ics[$id]; ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800"><?= $ics['nama'] ?></h2>
                            <p class="text-gray-600">ID ICS: <?= $id ?></p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?= $ics['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : ($ics['status'] === 'Proses Verifikasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') ?>">
                            <?= $ics['status'] ?>
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Dasar</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">No. Badan Hukum:</span>
                                    <p class="text-sm font-medium"><?= $ics['no_badan_hukum'] ?: '-' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Jumlah Petani:</span>
                                    <p class="text-sm font-medium"><?= $ics['jumlah_petani'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Berdiri:</span>
                                    <p class="text-sm font-medium"><?= $ics['tgl_berdiri'] ? date('d F Y', strtotime($ics['tgl_berdiri'])) : '-' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Legalitas:</span>
                                    <p class="text-sm font-medium"><?= $ics['tgl_legalitas'] ? date('d F Y', strtotime($ics['tgl_legalitas'])) : '-' ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi PIC</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Nama PIC:</span>
                                    <p class="text-sm font-medium"><?= $ics['pic']['nama'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Kontak PIC:</span>
                                    <p class="text-sm font-medium"><?= $ics['pic']['kontak'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Email PIC:</span>
                                    <p class="text-sm font-medium"><?= $ics['pic']['email'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Administratif</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Dibuat Oleh:</span>
                                    <p class="text-sm font-medium"><?= $ics['created_by'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Dibuat:</span>
                                    <p class="text-sm font-medium"><?= date('d F Y', strtotime($ics['created_at'])) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Diperbarui Oleh:</span>
                                    <p class="text-sm font-medium"><?= $ics['updated_by'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Terakhir Diperbarui:</span>
                                    <p class="text-sm font-medium"><?= date('d F Y', strtotime($ics['updated_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Alamat Lengkap</h3>
                            <div class="space-y-2">
                                <p class="text-sm font-medium"><?= $ics['alamat'] ?></p>
                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Provinsi</span>
                                        <p class="text-sm"><?= $ics['provinsi'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Kabupaten</span>
                                        <p class="text-sm"><?= $ics['kabupaten'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Kecamatan</span>
                                        <p class="text-sm"><?= $ics['kecamatan'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Desa</span>
                                        <p class="text-sm"><?= $ics['desa'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Peta Lokasi -->
                        <div class="bg-gray-50 p-4 rounded-lg col-span-2">
                            <h3 class="font-medium text-gray-900 mb-2">Lokasi & Area</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Area Wilayah:</span>
                                    <p class="text-sm font-medium"><?= $ics['area_wilayah'] ?: '-' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Lokasi Peta:</span>
                                    <div id="map" class="mt-2 rounded-lg border border-gray-300" style="height: 250px;"></div>
                                    <p class="text-xs text-gray-500 mt-1">Koordinat: <?= $ics['lokasi'] ?: '-' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dokumen & Logo & SOP -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Dokumen & Logo & SOP</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Dokumen Legalitas</h4>
                                <div class="space-y-2">
                                    <?php if (!empty($ics['dokumen'])): ?>
                                        <?php foreach ($ics['dokumen'] as $doc): ?>
                                            <div class="flex items-center justify-between bg-gray-100 p-2 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                                    <span class="text-sm"><?= $doc['nama'] ?></span>
                                                </div>
                                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-sm text-gray-500">Tidak ada dokumen</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Logo</h4>
                                <?php if ($ics['logo']): ?>
                                    <img src="<?= $ics['logo'] ?>" alt="Logo ICS" class="h-32 rounded-lg border border-gray-200">
                                <?php else: ?>
                                    <p class="text-sm text-gray-500">Tidak ada logo</p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">SOP</h4>
                                <div class="space-y-2">
                                    <?php if (!empty($ics['sop'])): ?>
                                        <?php foreach ($ics['sop'] as $sop): ?>
                                            <div class="flex items-center justify-between bg-gray-100 p-2 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                                                    <span class="text-sm"><?= $sop['nama'] ?></span>
                                                </div>
                                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-sm text-gray-500">Tidak ada SOP</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fasilitas -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Fasilitas</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($ics['fasilitas'])): ?>
                                        <?php foreach ($ics['fasilitas'] as $index => $fasilitas): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['fasilitas'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['jumlah'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['keterangan'] ?: '-' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada fasilitas</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Struktur Organisasi -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Struktur Organisasi</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($ics['pengurus'])): ?>
                                        <?php
                                        $counter = 1;
                                        foreach ($ics['pengurus'] as $jabatan => $anggota): ?>
                                            <?php foreach ($anggota as $index => $pengurus): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $counter ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $jabatan ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengurus['nama'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $pengurus['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                            <?= $pengurus['status'] ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php $counter++; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengurus</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Kelompok Tani -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Kelompok Tani</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelompok</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anggota</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($ics['kelompok_tani'])): ?>
                                        <?php foreach ($ics['kelompok_tani'] as $index => $kelompok): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $kelompok['nama'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $kelompok['jumlah_anggota'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada kelompok tani</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- SOP Detail -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-4">Standar Operasional Prosedur (SOP)</h3>
                        <div class="space-y-6">
                            <?php if (!empty($ics['sop'])): ?>
                                <?php foreach ($ics['sop'] as $sop): ?>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-lg font-medium text-gray-900"><?= $sop['nama'] ?></h4>
                                                <div class="flex items-center space-x-4 mt-1">
                                                    <span class="text-sm text-gray-500">Versi: <?= $sop['versi'] ?></span>
                                                    <span class="text-sm text-gray-500">Tanggal Efektif: <?= date('d F Y', strtotime($sop['tanggal_efektif'])) ?></span>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $sop['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                        <?= $sop['status'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <a href="#" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-download mr-1"></i> Unduh SOP
                                            </a>
                                        </div>

                                        <?php if (!empty($sop['sosialisasi'])): ?>
                                            <div class="mt-4">
                                                <h5 class="text-sm font-medium text-gray-700 mb-2">Riwayat Sosialisasi</h5>
                                                <div class="space-y-2">
                                                    <?php foreach ($sop['sosialisasi'] as $sosialisasi): ?>
                                                        <div class="flex items-center justify-between bg-gray-100 p-2 rounded-lg">
                                                            <div>
                                                                <span class="text-sm font-medium"><?= date('d F Y', strtotime($sosialisasi['tanggal'])) ?></span>
                                                                <span class="text-xs text-gray-500 ml-2"><?= $sosialisasi['peserta'] ?> peserta</span>
                                                            </div>
                                                            <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">
                                                                <i class="fas fa-file-pdf mr-1"></i> Berita Acara
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="mt-4 text-sm text-gray-500">
                                                Belum ada sosialisasi dilakukan
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-sm text-gray-500">Tidak ada SOP yang tercatat</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <a href="?mode=list" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        <?php elseif ($mode === 'edit' && isset($id) && isset($data_ics[$id])): ?>
            <!-- Form Edit ICS -->
            <?php $ics = $data_ics[$id]; ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data ICS</h2>
                    <form id="editForm" action="?mode=view&id=<?= $id ?>" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="nama_ics" class="block text-sm font-medium text-gray-700 mb-1">Nama ICS*</label>
                                    <input type="text" id="nama_ics" name="nama_ics" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['nama'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="no_badan_hukum" class="block text-sm font-medium text-gray-700 mb-1">No. Badan Hukum</label>
                                    <input type="text" id="no_badan_hukum" name="no_badan_hukum" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['no_badan_hukum'] ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="jumlah_petani" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Petani*</label>
                                    <input type="number" id="jumlah_petani" name="jumlah_petani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['jumlah_petani'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_berdiri" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berdiri</label>
                                    <input type="date" id="tgl_berdiri" name="tgl_berdiri" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['tgl_berdiri'] ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_legalitas" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Legalitas</label>
                                    <input type="date" id="tgl_legalitas" name="tgl_legalitas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['tgl_legalitas'] ?>">
                                </div>
                            </div>
                            <div>
                                <h3 class="text-md font-medium text-gray-700 border-b pb-2 mb-4">Informasi PIC</h3>
                                <div class="mb-4">
                                    <label for="nama_pic" class="block text-sm font-medium text-gray-700 mb-1">Nama PIC*</label>
                                    <input type="text" id="nama_pic" name="nama_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['pic']['nama'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="kontak_pic" class="block text-sm font-medium text-gray-700 mb-1">Kontak PIC*</label>
                                    <input type="text" id="kontak_pic" name="kontak_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['pic']['kontak'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email_pic" class="block text-sm font-medium text-gray-700 mb-1">Email PIC*</label>
                                    <input type="email" id="email_pic" name="email_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['pic']['email'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi*</label>
                                    <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="Aktif" <?= $ics['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="Proses Verifikasi" <?= $ics['status'] === 'Proses Verifikasi' ? 'selected' : '' ?>>Proses Verifikasi</option>
                                        <option value="Nonaktif" <?= $ics['status'] === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Dokumen & Logo & SOP -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen & Logo & SOP</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Legalitas</label>
                                    <div class="flex items-center">
                                        <input type="file" multiple class="hidden" id="file-upload">
                                        <label for="file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-upload mr-2"></i>Unggah Dokumen
                                        </label>
                                    </div>
                                    <div id="file-list" class="mt-2 space-y-2">
                                        <?php if (!empty($ics['dokumen'])): ?>
                                            <?php foreach ($ics['dokumen'] as $doc): ?>
                                                <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                                        <span class="text-sm"><?= $doc['nama'] ?></span>
                                                    </div>
                                                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeDocument(this)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                                    <div class="flex items-center">
                                        <input type="file" accept="image/*" class="hidden" id="logo-upload">
                                        <label for="logo-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-image mr-2"></i>Unggah Logo
                                        </label>
                                    </div>
                                    <div id="logo-preview" class="mt-2">
                                        <?php if ($ics['logo']): ?>
                                            <div class="relative">
                                                <img src="<?= $ics['logo'] ?>" alt="Logo Preview" class="h-32 rounded-lg border border-gray-200">
                                                <button type="button" onclick="removeLogo()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transform translate-x-1 -translate-y-1">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SOP</label>
                                    <div class="flex items-center">
                                        <input type="file" multiple class="hidden" id="sop-upload" accept=".pdf,.doc,.docx">
                                        <label for="sop-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-file-alt mr-2"></i>Unggah SOP
                                        </label>
                                    </div>
                                    <div id="sop-preview" class="mt-2">
                                        <?php if (!empty($ics['sop'])): ?>
                                            <?php foreach ($ics['sop'] as $sop): ?>
                                                <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                                                        <span class="text-sm"><?= $sop['nama'] ?></span>
                                                    </div>
                                                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSOP(this)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Alamat & Lokasi -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat & Lokasi</h3>
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat (Jalan/Dusun)*</label>
                                <input type="text" id="alamat" name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['alamat'] ?>" required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                        <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['provinsi'] ?>" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten*</label>
                                        <select id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kabupaten</option>
                                            <option value="Kampar" <?= $ics['kabupaten'] === 'Kampar' ? 'selected' : '' ?>>Kampar</option>
                                            <option value="Rokan Hulu" <?= $ics['kabupaten'] === 'Rokan Hulu' ? 'selected' : '' ?>>Rokan Hulu</option>
                                            <option value="Indragiri Hulu" <?= $ics['kabupaten'] === 'Indragiri Hulu' ? 'selected' : '' ?>>Indragiri Hulu</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
                                        <select id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kecamatan</option>
                                            <?php
                                            // Kecamatan berdasarkan kabupaten
                                            $kecamatan_options = [];
                                            if ($ics['kabupaten'] === 'Kampar') {
                                                $kecamatan_options = ['Bangkinang', 'Kampar', 'Tapung'];
                                            } elseif ($ics['kabupaten'] === 'Rokan Hulu') {
                                                $kecamatan_options = ['Pasir Pengaraian', 'Rambah', 'Kunto Darussalam'];
                                            } elseif ($ics['kabupaten'] === 'Indragiri Hulu') {
                                                $kecamatan_options = ['Rengat', 'Kelayang', 'Siberida'];
                                            }
                                            foreach ($kecamatan_options as $kec): ?>
                                                <option value="<?= $kec ?>" <?= $ics['kecamatan'] === $kec ? 'selected' : '' ?>><?= $kec ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa*</label>
                                        <select id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Desa</option>
                                            <?php
                                            // Desa berdasarkan kecamatan
                                            $desa_options = [];
                                            if ($ics['kecamatan'] === 'Bangkinang') {
                                                $desa_options = ['Bangkinang Kota', 'Pulau Lawas'];
                                            } elseif ($ics['kecamatan'] === 'Pasir Pengaraian') {
                                                $desa_options = ['Pasir Pengaraian', 'Rambah'];
                                            } elseif ($ics['kecamatan'] === 'Rengat') {
                                                $desa_options = ['Rengat', 'Pematang Reba'];
                                            }
                                            foreach ($desa_options as $desa): ?>
                                                <option value="<?= $desa ?>" <?= $ics['desa'] === $desa ? 'selected' : '' ?>><?= $desa ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
                                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Koordinat)</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="text" id="lokasi" name="lokasi" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['lokasi'] ?>">
                                        <button type="button" onclick="showMapPicker()" class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            <i class="fas fa-map-marker-alt"></i> Pilih di Peta
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="area_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Area Wilayah</label>
                                    <input type="text" id="area_wilayah" name="area_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['area_wilayah'] ?>">
                                </div>
                            </div>
                        </div>
                        <!-- Fasilitas -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Fasilitas</h3>
                                <button type="button" onclick="tambahFasilitas()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah Fasilitas
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="fasilitas-list">
                                        <?php if (!empty($ics['fasilitas'])): ?>
                                            <?php foreach ($ics['fasilitas'] as $index => $fasilitas): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['fasilitas'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['jumlah'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['keterangan'] ?: '-' ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button type="button" onclick="editFasilitas(<?= $index ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                                                        <button type="button" onclick="hapusFasilitas(<?= $index ?>)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada fasilitas</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Struktur Organisasi -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Struktur Organisasi</h3>
                                <div class="flex space-x-2">
                                    <button type="button" onclick="tambahJabatan()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jabatan
                                    </button>
                                    <button type="button" onclick="tambahAnggota()" class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-user-plus mr-1"></i>Tambah Anggota
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="struktur-list">
                                        <?php
                                        $counter = 1;
                                        if (!empty($ics['pengurus'])): ?>
                                            <?php foreach ($ics['pengurus'] as $jabatan => $anggota): ?>
                                                <?php foreach ($anggota as $index => $pengurus): ?>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $counter ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $jabatan ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengurus['nama'] ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $pengurus['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                                <?= $pengurus['status'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            <button type="button" onclick="editAnggota('<?= $jabatan ?>', <?= $index ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                                                            <button type="button" onclick="hapusAnggota('<?= $jabatan ?>', <?= $index ?>)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php $counter++; ?>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengurus</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Kelompok Tani -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Kelompok Tani</h3>
                                <div class="flex space-x-2">
                                    <button type="button" onclick="tambahKelompokTani()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-plus mr-1"></i>Tambah Kelompok
                                    </button>
                                    <button type="button" onclick="pilihKelompokTani()" class="text-sm bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg">
                                        <i class="fas fa-link mr-1"></i>Hubungkan Kelompok
                                    </button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelompok</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anggota</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="kelompok-tani-list">
                                        <?php if (!empty($ics['kelompok_tani'])): ?>
                                            <?php foreach ($ics['kelompok_tani'] as $index => $kelompok): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $kelompok['nama'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $kelompok['jumlah_anggota'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button type="button" onclick="editKelompokTani(<?= $index ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                                                        <button type="button" onclick="hapusKelompokTani(<?= $index ?>)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada kelompok tani</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- SOP Management -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Standar Operasional Prosedur (SOP)</h3>
                                <button type="button" onclick="tambahSOP()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah SOP
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama SOP</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Versi</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Efektif</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="sop-list">
                                        <?php if (!empty($ics['sop'])): ?>
                                            <?php foreach ($ics['sop'] as $index => $sop): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $sop['nama'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $sop['versi'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d M Y', strtotime($sop['tanggal_efektif'])) ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $sop['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                            <?= $sop['status'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button type="button" onclick="editSOP(<?= $index ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                                                        <button type="button" onclick="hapusSOP(<?= $index ?>)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                                        <button type="button" onclick="tambahSosialisasi(<?= $index ?>)" class="text-blue-600 hover:text-blue-900"><i class="fas fa-users"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada SOP</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="window.location.href='?mode=view&id=<?= $id ?>'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Halaman Default (Jika mode tidak dikenali) -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Data ICS</h2>
                    <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>
<!-- Modal Konfirmasi Hapus -->
<div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
            <button onclick="hideDeleteModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="mb-6">Yakin ingin menghapus ICS ini? Data tidak bisa dikembalikan.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="hideDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                Batal
            </button>
            <button onclick="proceedDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>
<!-- Modal Fasilitas -->
<div id="fasilitas-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="fasilitas-modal-title">Tambah Fasilitas</h3>
            <button onclick="hideFasilitasModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="fasilitas-form">
            <input type="hidden" id="fasilitas-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas*</label>
                    <input type="text" id="fasilitas-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Traktor" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah*</label>
                    <input type="number" id="fasilitas-jumlah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea id="fasilitas-keterangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kondisi baik"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideFasilitasModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Jabatan -->
<div id="jabatan-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="jabatan-modal-title">Tambah Jabatan</h3>
            <button onclick="hideJabatanModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="jabatan-form">
            <input type="hidden" id="jabatan-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jabatan*</label>
                    <input type="text" id="jabatan-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Ketua" required>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideJabatanModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Anggota -->
<div id="anggota-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="anggota-modal-title">Tambah Anggota</h3>
            <button onclick="hideAnggotaModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="anggota-form">
            <input type="hidden" id="anggota-id">
            <input type="hidden" id="anggota-jabatan-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan*</label>
                    <select id="anggota-jabatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Pilih Jabatan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Anggota*</label>
                    <input type="text" id="anggota-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Budi Santoso" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                    <select id="anggota-status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideAnggotaModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Kelompok Tani -->
<div id="kelompok-tani-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="kelompok-tani-modal-title">Tambah Kelompok Tani</h3>
            <button onclick="hideKelompokTaniModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="kelompok-tani-form">
            <input type="hidden" id="kelompok-tani-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kelompok*</label>
                    <input type="text" id="kelompok-tani-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kelompok Tani Makmur" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Anggota*</label>
                    <input type="number" id="kelompok-tani-jumlah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 15" required>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideKelompokTaniModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Pilih Kelompok Tani -->
<div id="pilih-kelompok-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-2xl w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Pilih Kelompok Tani</h3>
            <button onclick="hidePilihKelompokModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mb-4">
            <div class="relative">
                <input type="text" id="search-kelompok" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari kelompok tani...">
                <button type="button" onclick="searchKelompok()" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="overflow-y-auto max-h-96">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelompok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anggota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="daftar-kelompok">
                    <!-- Data kelompok tani akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <button onclick="hidePilihKelompokModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                Batal
            </button>
            <button onclick="tambahkanKelompokTerpilih()" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                Tambahkan
            </button>
        </div>
    </div>
</div>
<!-- Modal Peta -->
<div id="map-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-4xl w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Pilih Lokasi di Peta</h3>
            <button onclick="hideMapModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="map-picker" style="height: 400px; width: 100%;" class="rounded-lg border border-gray-300"></div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                <input type="text" id="map-lat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                <input type="text" id="map-lng" class="w-full px-3 py-2 border border-gray-300 rounded-lg" readonly>
            </div>
        </div>
        <div class="flex justify-end space-x-3 mt-6">
            <button onclick="hideMapModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                Batal
            </button>
            <button onclick="simpanLokasiPeta()" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                Simpan Lokasi
            </button>
        </div>
    </div>
</div>
<!-- Modal SOP -->
<div id="sop-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="sop-modal-title">Tambah SOP</h3>
            <button onclick="hideSOPModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="sop-form">
            <input type="hidden" id="sop-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama SOP*</label>
                    <input type="text" id="sop-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: SOP Pengelolaan Kebun" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Versi*</label>
                    <input type="text" id="sop-versi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 1.0" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Efektif*</label>
                    <input type="date" id="sop-tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                    <select id="sop-status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">File SOP*</label>
                    <div class="flex items-center">
                        <input type="file" class="hidden" id="sop-file-upload" accept=".pdf,.doc,.docx">
                        <label for="sop-file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                            <i class="fas fa-file-upload mr-2"></i>Unggah File
                        </label>
                        <span class="ml-2 text-xs text-gray-500">PDF, DOC (Maks. 5MB)</span>
                    </div>
                    <div id="sop-file-preview" class="mt-2"></div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideSOPModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Sosialisasi SOP -->
<div id="sosialisasi-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="sosialisasi-modal-title">Tambah Sosialisasi SOP</h3>
            <button onclick="hideSosialisasiModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="sosialisasi-form">
            <input type="hidden" id="sosialisasi-sop-id">
            <input type="hidden" id="sosialisasi-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Sosialisasi*</label>
                    <input type="date" id="sosialisasi-tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Peserta*</label>
                    <input type="number" id="sosialisasi-peserta" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 25" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Berita Acara</label>
                    <div class="flex items-center">
                        <input type="file" class="hidden" id="sosialisasi-file-upload" accept=".pdf,.doc,.docx">
                        <label for="sosialisasi-file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                            <i class="fas fa-file-upload mr-2"></i>Unggah Berita Acara
                        </label>
                    </div>
                    <div id="sosialisasi-file-preview" class="mt-2"></div>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideSosialisasiModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Data untuk wilayah
    const wilayahData = {
        kabupaten: ['Kampar', 'Rokan Hulu', 'Indragiri Hulu'],
        kecamatan: {
            'Kampar': ['Bangkinang', 'Kampar', 'Tapung'],
            'Rokan Hulu': ['Pasir Pengaraian', 'Rambah', 'Kunto Darussalam'],
            'Indragiri Hulu': ['Rengat', 'Kelayang', 'Siberida']
        },
        desa: {
            'Bangkinang': ['Bangkinang Kota', 'Pulau Lawas'],
            'Kampar': ['Kampar', 'Muara Takus'],
            'Tapung': ['Tapung Hilir', 'Tapung Hulu'],
            'Pasir Pengaraian': ['Pasir Pengaraian', 'Rambah'],
            'Rambah': ['Rambah Hilir', 'Rambah Samo'],
            'Kunto Darussalam': ['Kunto Darussalam', 'Sedinginan'],
            'Rengat': ['Rengat', 'Pematang Reba'],
            'Kelayang': ['Kelayang', 'Sei Pasir Putih'],
            'Siberida': ['Siberida', 'Petalongan']
        }
    };

    // Variabel untuk menyimpan data sementara
    let currentFasilitas = [];
    let currentPengurus = {}; // Struktur: { jabatan: [ {nama, status} ] }
    let currentKelompokTani = [];
    let currentSOP = [];
    let currentEditingFasilitasId = null;
    let currentEditingJabatanId = null;
    let currentEditingAnggotaId = null;
    let currentEditingKelompokTaniId = null;
    let currentEditingSOPId = null;
    let currentEditingSosialisasiId = null;
    let icsToDelete = null;
    let map = null;
    let marker = null;
    let selectedKelompokTani = [];

    // Data dummy kelompok tani
    const kelompokTaniData = [{
            id: 1,
            nama: 'Kelompok Tani Makmur',
            jumlah_anggota: 15,
            lokasi: 'Kampar'
        },
        {
            id: 2,
            nama: 'Kelompok Tani Sejahtera',
            jumlah_anggota: 20,
            lokasi: 'Kampar'
        },
        {
            id: 3,
            nama: 'Kelompok Tani Rokan',
            jumlah_anggota: 12,
            lokasi: 'Rokan Hulu'
        },
        {
            id: 4,
            nama: 'Kelompok Tani Indragiri',
            jumlah_anggota: 18,
            lokasi: 'Indragiri Hulu'
        },
        {
            id: 5,
            nama: 'Kelompok Tani Bangkinang',
            jumlah_anggota: 10,
            lokasi: 'Kampar'
        }
    ];

    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi peta di halaman detail
        <?php if ($mode === 'view' && isset($id) && isset($data_ics[$id])): ?>
            const lokasi = '<?= $data_ics[$id]['lokasi'] ?>';
            const nama = '<?= $data_ics[$id]['nama'] ?>';
            if (lokasi) {
                const coords = lokasi.split(',').map(coord => parseFloat(coord.trim()));
                if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
                    // Load Leaflet CSS and JS dynamically
                    const loadLeaflet = () => {
                        // Check if Leaflet is already loaded
                        if (typeof L !== 'undefined') {
                            initDetailMap(coords[0], coords[1], nama);
                            return;
                        }

                        // Load Leaflet CSS
                        const leafletCSS = document.createElement('link');
                        leafletCSS.rel = 'stylesheet';
                        leafletCSS.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
                        leafletCSS.integrity = 'sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==';
                        leafletCSS.crossOrigin = '';
                        document.head.appendChild(leafletCSS);

                        // Load Leaflet JS
                        const leafletJS = document.createElement('script');
                        leafletJS.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
                        leafletJS.integrity = 'sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==';
                        leafletJS.crossOrigin = '';
                        leafletJS.onload = () => initDetailMap(coords[0], coords[1], nama);
                        document.head.appendChild(leafletJS);
                    };

                    loadLeaflet();
                } else {
                    document.getElementById('map').innerHTML = '<p class="text-red-500">Format koordinat salah</p>';
                }
            } else {
                document.getElementById('map').innerHTML = '<p class="text-red-500">Koordinat tidak tersedia</p>';
            }
        <?php endif; ?>

        // Inisialisasi form
        document.getElementById('fasilitas-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveFasilitas();
        });

        document.getElementById('jabatan-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveJabatan();
        });

        document.getElementById('anggota-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveAnggota();
        });

        document.getElementById('kelompok-tani-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveKelompokTani();
        });

        document.getElementById('sop-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveSOP();
        });

        document.getElementById('sosialisasi-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveSosialisasi();
        });

        // Handle perubahan kabupaten
        document.getElementById('kabupaten').addEventListener('change', function() {
            const kabupaten = this.value;
            const kecamatanSelect = document.getElementById('kecamatan');
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kecamatanSelect.disabled = !kabupaten;
            if (kabupaten && wilayahData.kecamatan[kabupaten]) {
                wilayahData.kecamatan[kabupaten].forEach(kec => {
                    const option = document.createElement('option');
                    option.value = kec;
                    option.textContent = kec;
                    kecamatanSelect.appendChild(option);
                });
            }
            // Reset desa
            const desaSelect = document.getElementById('desa');
            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            desaSelect.disabled = true;
        });

        // Handle perubahan kecamatan
        document.getElementById('kecamatan').addEventListener('change', function() {
            const kecamatan = this.value;
            const desaSelect = document.getElementById('desa');
            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            desaSelect.disabled = !kecamatan;
            if (kecamatan && wilayahData.desa[kecamatan]) {
                wilayahData.desa[kecamatan].forEach(desa => {
                    const option = document.createElement('option');
                    option.value = desa;
                    option.textContent = desa;
                    desaSelect.appendChild(option);
                });
            }
        });

        // Handle upload dokumen
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            const fileList = document.getElementById('file-list');
            if (files.length > 10) {
                showToast('Maksimal 10 file yang dapat diunggah', 'error');
                return;
            }
            for (let i = 0; i < Math.min(files.length, 10); i++) {
                const file = files[i];
                if (file.size > 5 * 1024 * 1024) {
                    showToast(`File ${file.name} melebihi ukuran maksimal 5MB`, 'error');
                    continue;
                }
                const docItem = document.createElement('div');
                docItem.className = 'flex items-center justify-between bg-gray-50 p-2 rounded-lg';
                docItem.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                        <span class="text-sm">${file.name}</span>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeDocument(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                fileList.appendChild(docItem);
            }
        });

        // Handle upload logo
        document.getElementById('logo-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const logoPreview = document.getElementById('logo-preview');
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Ukuran logo maksimal 2MB', 'error');
                    return;
                }
                if (!file.type.match('image.*')) {
                    showToast('File harus berupa gambar', 'error');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.innerHTML = `
                        <div class="relative">
                            <img src="${e.target.result}" alt="Logo Preview" class="h-32 rounded-lg border border-gray-200">
                            <button type="button" onclick="removeLogo()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transform translate-x-1 -translate-y-1">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle upload SOP
        document.getElementById('sop-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            const sopPreview = document.getElementById('sop-preview');
            if (files.length > 5) {
                showToast('Maksimal 5 file SOP yang dapat diunggah', 'error');
                return;
            }
            sopPreview.innerHTML = '';
            for (let i = 0; i < Math.min(files.length, 5); i++) {
                const file = files[i];
                if (file.size > 5 * 1024 * 1024) {
                    showToast(`File ${file.name} melebihi ukuran maksimal 5MB`, 'error');
                    continue;
                }
                if (!file.type.match('application/pdf') && !file.type.match('application/msword') && !file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                    showToast(`File ${file.name} harus berupa PDF atau DOC`, 'error');
                    continue;
                }
                const sopItem = document.createElement('div');
                sopItem.className = 'flex items-center justify-between bg-gray-50 p-2 rounded-lg';
                sopItem.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                        <span class="text-sm">${file.name}</span>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSOP(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                sopPreview.appendChild(sopItem);
            }
        });

        // Handle upload file SOP
        document.getElementById('sop-file-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const sopFilePreview = document.getElementById('sop-file-preview');
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    showToast('Ukuran file maksimal 5MB', 'error');
                    return;
                }
                if (!file.type.match('application/pdf') && !file.type.match('application/msword') && !file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                    showToast('File harus berupa PDF atau DOC', 'error');
                    return;
                }
                sopFilePreview.innerHTML = `
                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                            <span class="text-sm">${file.name}</span>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSOPFile()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            }
        });

        // Handle upload file sosialisasi
        document.getElementById('sosialisasi-file-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const sosialisasiFilePreview = document.getElementById('sosialisasi-file-preview');
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    showToast('Ukuran file maksimal 5MB', 'error');
                    return;
                }
                if (!file.type.match('application/pdf') && !file.type.match('application/msword') && !file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                    showToast('File harus berupa PDF atau DOC', 'error');
                    return;
                }
                sosialisasiFilePreview.innerHTML = `
                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            <span class="text-sm">${file.name}</span>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSosialisasiFile()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            }
        });

        // Jika mode edit, isi data yang ada
        <?php if ($mode === 'edit' && isset($id) && isset($data_ics[$id])): ?>
            currentFasilitas = <?= json_encode($data_ics[$id]['fasilitas']) ?>;
            currentPengurus = <?= json_encode($data_ics[$id]['pengurus']) ?>;
            currentKelompokTani = <?= json_encode($data_ics[$id]['kelompok_tani']) ?>;
            currentSOP = <?= json_encode($data_ics[$id]['sop']) ?>;

            renderFasilitasList();
            renderStrukturList();
            renderKelompokTaniList();
            renderSOPList();

            // Isi koordinat peta jika ada
            const lokasi = '<?= $data_ics[$id]['lokasi'] ?>';
            if (lokasi) {
                const coords = lokasi.split(',').map(coord => coord.trim());
                if (coords.length === 2) {
                    document.getElementById('lokasi').value = lokasi;
                }
            }
        <?php endif; ?>
    });

    // Fungsi untuk inisialisasi peta di halaman detail
    function initDetailMap(lat, lng, nama) {
        const mapElement = document.getElementById('map');
        if (!mapElement) return;

        const latitude = parseFloat(lat);
        const longitude = parseFloat(lng);
        if (isNaN(latitude) || isNaN(longitude)) {
            mapElement.innerHTML = '<p class="text-red-500">Koordinat tidak valid</p>';
            return;
        }

        const map = L.map('map').setView([latitude, longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker dengan popup
        const marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup(`<b>${nama}</b><br>${latitude}, ${longitude}`)
            .openPopup();

        // Tambahkan kontrol pencarian lokasi
        const searchControl = new L.Control.Search({
            position: 'topright',
            layer: L.layerGroup([marker]),
            propertyName: 'name',
            initial: false,
            zoom: 15,
            marker: false,
            autoType: false,
            autoCollapse: true
        });

        map.addControl(searchControl);
    }

    // Fungsi untuk menampilkan modal peta
    function showMapPicker() {
        document.getElementById('map-modal').classList.remove('hidden');

        // Inisialisasi peta jika belum ada
        if (!map) {
            // Load Leaflet CSS and JS dynamically if not already loaded
            const loadLeaflet = () => {
                // Check if Leaflet is already loaded
                if (typeof L !== 'undefined') {
                    initMapPicker();
                    return;
                }

                // Load Leaflet CSS
                const leafletCSS = document.createElement('link');
                leafletCSS.rel = 'stylesheet';
                leafletCSS.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
                leafletCSS.integrity = 'sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==';
                leafletCSS.crossOrigin = '';
                document.head.appendChild(leafletCSS);

                // Load Leaflet JS
                const leafletJS = document.createElement('script');
                leafletJS.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
                leafletJS.integrity = 'sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==';
                leafletJS.crossOrigin = '';
                leafletJS.onload = initMapPicker;
                document.head.appendChild(leafletJS);
            };

            loadLeaflet();
        } else {
            initMapPicker();
        }
    }

    function initMapPicker() {
        // Initialize the map
        map = L.map('map-picker').setView([-0.335987, 101.025543], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add search control
        const searchControl = new L.Control.Search({
            position: 'topright',
            provider: new L.Control.Search.OpenStreetMapProvider(),
            propertyName: 'display_name',
            autoType: false,
            autoCollapse: true,
            minLength: 2,
            zoom: 15,
            marker: {
                icon: new L.Icon.Default(),
                draggable: true
            }
        });

        map.addControl(searchControl);

        // Event when search is completed
        searchControl.on('search:locationfound', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = e.marker;
            document.getElementById('map-lat').value = e.latlng.lat.toFixed(6);
            document.getElementById('map-lng').value = e.latlng.lng.toFixed(6);
        });

        // Event when map is clicked
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng, {
                draggable: true
            }).addTo(map);
            document.getElementById('map-lat').value = e.latlng.lat.toFixed(6);
            document.getElementById('map-lng').value = e.latlng.lng.toFixed(6);

            // Event when marker is dragged
            marker.on('dragend', function(e) {
                const newPos = marker.getLatLng();
                document.getElementById('map-lat').value = newPos.lat.toFixed(6);
                document.getElementById('map-lng').value = newPos.lng.toFixed(6);
            });
        });

        // Check if there's already a saved location
        const lokasiInput = document.getElementById('lokasi').value;
        if (lokasiInput) {
            const coords = lokasiInput.split(',').map(coord => parseFloat(coord.trim()));
            if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
                map.setView([coords[0], coords[1]], 15);
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker([coords[0], coords[1]], {
                    draggable: true
                }).addTo(map);

                // Event when marker is dragged
                marker.on('dragend', function(e) {
                    const newPos = marker.getLatLng();
                    document.getElementById('map-lat').value = newPos.lat.toFixed(6);
                    document.getElementById('map-lng').value = newPos.lng.toFixed(6);
                });
            }
        }
    }

    function hideMapModal() {
        document.getElementById('map-modal').classList.add('hidden');
    }

    function simpanLokasiPeta() {
        const lat = document.getElementById('map-lat').value;
        const lng = document.getElementById('map-lng').value;
        if (lat && lng) {
            document.getElementById('lokasi').value = `${lat}, ${lng}`;
            hideMapModal();
            showToast('Lokasi berhasil disimpan', 'success');
        } else {
            showToast('Silakan pilih lokasi di peta terlebih dahulu', 'error');
        }
    }

    // Fungsi untuk manajemen SOP
    function showSOPModal(sopId = null) {
        document.getElementById('sop-modal').classList.remove('hidden');
        if (sopId !== null) {
            document.getElementById('sop-modal-title').textContent = 'Edit SOP';
            const sop = currentSOP[sopId];
            document.getElementById('sop-id').value = sopId;
            document.getElementById('sop-nama').value = sop.nama;
            document.getElementById('sop-versi').value = sop.versi;
            document.getElementById('sop-tanggal').value = sop.tanggal_efektif;
            document.getElementById('sop-status').value = sop.status;

            // Tampilkan preview file jika ada
            const sopFilePreview = document.getElementById('sop-file-preview');
            if (sop.file) {
                sopFilePreview.innerHTML = `
                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                            <span class="text-sm">${sop.file}</span>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSOPFile()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            } else {
                sopFilePreview.innerHTML = '';
            }
        } else {
            document.getElementById('sop-modal-title').textContent = 'Tambah SOP';
            document.getElementById('sop-form').reset();
            document.getElementById('sop-id').value = '';
            document.getElementById('sop-file-preview').innerHTML = '';
        }
    }

    function hideSOPModal() {
        document.getElementById('sop-modal').classList.add('hidden');
    }

    function saveSOP() {
        const sopId = document.getElementById('sop-id').value;
        const isEditMode = sopId !== '';
        const sopData = {
            nama: document.getElementById('sop-nama').value,
            versi: document.getElementById('sop-versi').value,
            tanggal_efektif: document.getElementById('sop-tanggal').value,
            status: document.getElementById('sop-status').value,
            file: document.querySelector('#sop-file-preview .text-sm')?.textContent || '',
            sosialisasi: isEditMode ? currentSOP[sopId].sosialisasi || [] : []
        };

        if (isEditMode) {
            currentSOP[sopId] = sopData;
        } else {
            currentSOP.push(sopData);
        }

        renderSOPList();
        hideSOPModal();
        showToast(`SOP berhasil ${isEditMode ? 'diperbarui' : 'ditambahkan'}`, 'success');
    }

    function renderSOPList() {
        const tbody = document.getElementById('sop-list');
        tbody.innerHTML = '';

        if (currentSOP.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada SOP</td>
                </tr>
            `;
            return;
        }

        currentSOP.forEach((sop, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sop.nama}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${sop.versi}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formatDate(sop.tanggal_efektif)}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${sop.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        ${sop.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button type="button" onclick="editSOP(${index})" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                    <button type="button" onclick="hapusSOP(${index})" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                    <button type="button" onclick="tambahSosialisasi(${index})" class="text-blue-600 hover:text-blue-900"><i class="fas fa-users"></i></button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    function editSOP(index) {
        showSOPModal(index);
    }

    function hapusSOP(index) {
        if (confirm('Yakin ingin menghapus SOP ini?')) {
            currentSOP.splice(index, 1);
            renderSOPList();
            showToast('SOP berhasil dihapus', 'success');
        }
    }

    function tambahSOP() {
        showSOPModal();
    }

    function removeSOPFile() {
        document.getElementById('sop-file-preview').innerHTML = '';
        document.getElementById('sop-file-upload').value = '';
    }

    // Fungsi untuk manajemen sosialisasi SOP
    function showSosialisasiModal(sopIndex, sosialisasiId = null) {
        document.getElementById('sosialisasi-modal').classList.remove('hidden');
        document.getElementById('sosialisasi-sop-id').value = sopIndex;

        if (sosialisasiId !== null) {
            document.getElementById('sosialisasi-modal-title').textContent = 'Edit Sosialisasi SOP';
            const sosialisasi = currentSOP[sopIndex].sosialisasi[sosialisasiId];
            document.getElementById('sosialisasi-id').value = sosialisasiId;
            document.getElementById('sosialisasi-tanggal').value = sosialisasi.tanggal;
            document.getElementById('sosialisasi-peserta').value = sosialisasi.peserta;

            // Tampilkan preview file jika ada
            const sosialisasiFilePreview = document.getElementById('sosialisasi-file-preview');
            if (sosialisasi.dokumen) {
                sosialisasiFilePreview.innerHTML = `
                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            <span class="text-sm">${sosialisasi.dokumen}</span>
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSosialisasiFile()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            } else {
                sosialisasiFilePreview.innerHTML = '';
            }
        } else {
            document.getElementById('sosialisasi-modal-title').textContent = 'Tambah Sosialisasi SOP';
            document.getElementById('sosialisasi-form').reset();
            document.getElementById('sosialisasi-id').value = '';
            document.getElementById('sosialisasi-file-preview').innerHTML = '';
        }
    }

    function hideSosialisasiModal() {
        document.getElementById('sosialisasi-modal').classList.add('hidden');
    }

    function saveSosialisasi() {
        const sopIndex = document.getElementById('sosialisasi-sop-id').value;
        const sosialisasiId = document.getElementById('sosialisasi-id').value;
        const isEditMode = sosialisasiId !== '';

        const sosialisasiData = {
            tanggal: document.getElementById('sosialisasi-tanggal').value,
            peserta: parseInt(document.getElementById('sosialisasi-peserta').value),
            dokumen: document.querySelector('#sosialisasi-file-preview .text-sm')?.textContent || ''
        };

        if (isEditMode) {
            currentSOP[sopIndex].sosialisasi[sosialisasiId] = sosialisasiData;
        } else {
            if (!currentSOP[sopIndex].sosialisasi) {
                currentSOP[sopIndex].sosialisasi = [];
            }
            currentSOP[sopIndex].sosialisasi.push(sosialisasiData);
        }

        renderSOPList();
        hideSosialisasiModal();
        showToast(`Sosialisasi SOP berhasil ${isEditMode ? 'diperbarui' : 'ditambahkan'}`, 'success');
    }

    function tambahSosialisasi(sopIndex) {
        showSosialisasiModal(sopIndex);
    }

    function removeSosialisasiFile() {
        document.getElementById('sosialisasi-file-preview').innerHTML = '';
        document.getElementById('sosialisasi-file-upload').value = '';
    }

    // Fungsi untuk format tanggal
    function formatDate(dateString) {
        if (!dateString) return '';
        const options = {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    // Fungsi-fungsi lainnya (fasilitas, struktur organisasi, kelompok tani) tetap sama seperti sebelumnya
    // ... (kode sebelumnya untuk fasilitas, struktur organisasi, kelompok tani)

    // Fungsi untuk menampilkan toast notifikasi
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-4 py-2 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
</script>

<?php include 'footer.php'; ?>