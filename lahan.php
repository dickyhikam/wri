<?php include 'header.php'; ?>
<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <?php
    // Mode untuk menentukan tampilan
    $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Data Dummy Lahan
    $data_lahan = [
        'PL-001' => [
            'nama' => 'Kebun Sawit Utama',
            'petani' => 'Ahmad Fauzi',
            'ics' => 'ICS-12',
            'luas' => 5.2,
            'lokasi' => 'Pelalawan, Riau',
            'status' => 'Aktif',
            'tahun_tanam' => 2018,
            'status_kepemilikan' => 'Milik Sendiri',
            'desa' => 'Bukit Agung',
            'kecamatan' => 'Pangkalan Kerinci',
            'kabupaten' => 'Pelalawan',
            'provinsi' => 'Riau',
            'jenis_tanah' => 'Mineral',
            'kedalaman_gambut' => '0 m (Mineral)',
            'asal_benih' => 'Belum Distributor',
            'jumlah_pokok' => 260,
            'pola_tanam' => 'Monokultur',
            'usaha_lain' => 'Tidak Ada',
            'jenis_pupuk' => 'Organik & An-Organik',
            'jenis_surat' => 'SHM',
            'no_surat' => '02812',
            'no_stdb' => 'Belum Terbit',
            'luas_surat' => 20.00,
            'selisih_luas' => 2.04,
            'keterangan_selisih' => 'Eks. PIR Trans Tahun 1985',
            'kode_wilayah' => '1408062006',
            'batas_utara' => 'Sungai (Sungai Kerinci)',
            'batas_selatan' => 'Jalan (Jalan Lintas Timur)',
            'batas_barat' => 'Lahan Lain (Milik PT. Sawit Makmur)',
            'batas_timur' => 'Sungai (Sungai Tapung)',
            'koordinat' => '101.944025862, 0.678626965;101.943115368, 0.678607038;101.943115995, 0.680427524;101.944022953, 0.680447523;101.944025862, 0.678626965'
        ],
        'PL-002' => [
            'nama' => 'Kebun Sawit Baru',
            'petani' => 'Siti Rahma',
            'ics' => 'ICS-08',
            'luas' => 3.8,
            'lokasi' => 'Inhu, Riau',
            'status' => 'Proses Verifikasi',
            'tahun_tanam' => 2019,
            'status_kepemilikan' => 'Milik Sendiri',
            'desa' => 'Sialang Pandan',
            'kecamatan' => 'Kerinci Kanan',
            'kabupaten' => 'Indragiri Hulu',
            'provinsi' => 'Riau',
            'jenis_tanah' => 'Gambut',
            'kedalaman_gambut' => '1.5 m',
            'asal_benih' => 'Distributor Lokal',
            'jumlah_pokok' => 190,
            'pola_tanam' => 'Monokultur',
            'usaha_lain' => 'Ada (Kebun Sayur)',
            'jenis_pupuk' => 'Organik',
            'jenis_surat' => 'SPPT',
            'no_surat' => '04567',
            'no_stdb' => '2023/STDB/04567',
            'luas_surat' => 4.0,
            'selisih_luas' => 0.2,
            'keterangan_selisih' => 'Perubahan batas lahan',
            'kode_wilayah' => '1408062007',
            'batas_utara' => 'Jalan Desa',
            'batas_selatan' => 'Sungai Kecil',
            'batas_barat' => 'Lahan Kosong',
            'batas_timur' => 'Kebun Tetangga',
            'koordinat' => '102.123456, 0.987654;102.123400, 0.987600;102.123300, 0.987500;102.123200, 0.987400;102.123456, 0.987654'
        ],
        'PL-003' => [
            'nama' => 'Kebun Sawit Makmur',
            'petani' => 'Budi Santoso',
            'ics' => 'ICS-15',
            'luas' => 7.5,
            'lokasi' => 'Siak, Riau',
            'status' => 'Aktif',
            'tahun_tanam' => 2017,
            'status_kepemilikan' => 'Sewa',
            'desa' => 'Dayun',
            'kecamatan' => 'Dayun',
            'kabupaten' => 'Siak',
            'provinsi' => 'Riau',
            'jenis_tanah' => 'Mineral',
            'kedalaman_gambut' => '0 m (Mineral)',
            'asal_benih' => 'Pusat Pembibitan',
            'jumlah_pokok' => 375,
            'pola_tanam' => 'Polikultur',
            'usaha_lain' => 'Ada (Peternakan Ayam)',
            'jenis_pupuk' => 'Anorganik',
            'jenis_surat' => 'SKT',
            'no_surat' => '07891',
            'no_stdb' => '2022/STDB/07891',
            'luas_surat' => 7.5,
            'selisih_luas' => 0.0,
            'keterangan_selisih' => '-',
            'kode_wilayah' => '1408062008',
            'batas_utara' => 'Jalan Utama',
            'batas_selatan' => 'Sungai Besar',
            'batas_barat' => 'Hutan',
            'batas_timur' => 'Kebun Kelapa',
            'koordinat' => '101.876543, 0.765432;101.876500, 0.765400;101.876400, 0.765300;101.876300, 0.765200;101.876543, 0.765432'
        ],
        'ID084d862d5' => [
            'nama' => 'Kebun Petani 1',
            'petani' => 'Petani 1',
            'ics' => 'KMJ.14.08.06.2006.0001',
            'luas' => 2.04,
            'lokasi' => 'Dayun, Siak',
            'status' => 'Aktif',
            'tahun_tanam' => 1986,
            'status_kepemilikan' => 'Milik Sendiri',
            'desa' => 'Berumbung Baru',
            'kecamatan' => 'Dayun',
            'kabupaten' => 'Siak',
            'provinsi' => 'Riau',
            'jenis_tanah' => 'Mineral',
            'kedalaman_gambut' => '0 m (Mineral)',
            'asal_benih' => 'Tidak Diketahui',
            'jumlah_pokok' => 102,
            'pola_tanam' => 'Monokultur',
            'usaha_lain' => 'Tidak Ada',
            'jenis_pupuk' => 'Organik',
            'jenis_surat' => 'SHM',
            'no_surat' => '12345',
            'no_stdb' => 'Belum Terbit',
            'luas_surat' => 2.04,
            'selisih_luas' => 0.0,
            'keterangan_selisih' => '-',
            'kode_wilayah' => '1408062009',
            'batas_utara' => 'Jalan Desa',
            'batas_selatan' => 'Sungai Kecil',
            'batas_barat' => 'Lahan Kosong',
            'batas_timur' => 'Kebun Tetangga',
            'koordinat' => '101.111111, 0.222222;101.111100, 0.222200;101.111000, 0.222000;101.110900, 0.221900;101.111111, 0.222222'
        ],
        'ID114da4c49' => [
            'nama' => 'Kebun Petani 2 (Persil 1)',
            'petani' => 'Petani 2',
            'ics' => 'KMJ.14.08.06.2006.0002',
            'luas' => 1.13,
            'lokasi' => 'Dayun, Siak',
            'status' => 'Aktif',
            'tahun_tanam' => 1985,
            'status_kepemilikan' => 'Milik Sendiri',
            'desa' => 'Berumbung Baru',
            'kecamatan' => 'Dayun',
            'kabupaten' => 'Siak',
            'provinsi' => 'Riau',
            'jenis_tanah' => 'Mineral',
            'kedalaman_gambut' => '0 m (Mineral)',
            'asal_benih' => 'Tidak Diketahui',
            'jumlah_pokok' => 57,
            'pola_tanam' => 'Monokultur',
            'usaha_lain' => 'Tidak Ada',
            'jenis_pupuk' => 'Organik',
            'jenis_surat' => 'SHM',
            'no_surat' => '54321',
            'no_stdb' => 'Belum Terbit',
            'luas_surat' => 1.13,
            'selisih_luas' => 0.0,
            'keterangan_selisih' => '-',
            'kode_wilayah' => '1408062010',
            'batas_utara' => 'Jalan Desa',
            'batas_selatan' => 'Sungai Kecil',
            'batas_barat' => 'Lahan Kosong',
            'batas_timur' => 'Kebun Tetangga',
            'koordinat' => '101.222222, 0.333333;101.222200, 0.333300;101.222000, 0.333000;101.221900, 0.332900;101.222222, 0.333333'
        ],
        'ID114dc3aa6' => [
            'nama' => 'Kebun Petani 2 (Persil 2)',
            'petani' => 'Petani 2',
            'ics' => 'KMJ.14.08.06.2006.0002',
            'luas' => 0.67,
            'lokasi' => 'Dayun, Siak',
            'status' => 'Aktif',
            'tahun_tanam' => 1985,
            'status_kepemilikan' => 'Milik Keluarga',
            'desa' => 'Berumbung Baru',
            'kecamatan' => 'Dayun',
            'kabupaten' => 'Siak',
            'provinsi' => 'Riau',
            'jenis_tanah' => 'Mineral',
            'kedalaman_gambut' => '0 m (Mineral)',
            'asal_benih' => 'Tidak Diketahui',
            'jumlah_pokok' => 34,
            'pola_tanam' => 'Monokultur',
            'usaha_lain' => 'Tidak Ada',
            'jenis_pupuk' => 'Organik',
            'jenis_surat' => 'SHM',
            'no_surat' => '67890',
            'no_stdb' => 'Belum Terbit',
            'luas_surat' => 0.67,
            'selisih_luas' => 0.0,
            'keterangan_selisih' => '-',
            'kode_wilayah' => '1408062011',
            'batas_utara' => 'Jalan Desa',
            'batas_selatan' => 'Sungai Kecil',
            'batas_barat' => 'Lahan Kosong',
            'batas_timur' => 'Kebun Tetangga',
            'koordinat' => '101.333333, 0.444444;101.333300, 0.444400;101.333000, 0.444000;101.332900, 0.443900;101.333333, 0.444444'
        ]
    ];

    // Data unik untuk filter
    $kecamatans = array_unique(array_column($data_lahan, 'kecamatan'));
    $kabupatens = array_unique(array_column($data_lahan, 'kabupaten'));
    $statuses = array_unique(array_column($data_lahan, 'status'));
    $ics_list = array_unique(array_column($data_lahan, 'ics'));

    // Initialize filtered data with all data first
    $filtered_lahan = $data_lahan;

    // Get filter parameters
    $filter_ics = isset($_GET['filter_ics']) ? $_GET['filter_ics'] : '';
    $filter_kecamatan = isset($_GET['filter_kecamatan']) ? $_GET['filter_kecamatan'] : '';
    $filter_kabupaten = isset($_GET['filter_kabupaten']) ? $_GET['filter_kabupaten'] : '';
    $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Apply filters
    if ($filter_ics) {
        $filtered_lahan = array_filter($filtered_lahan, function ($lahan) use ($filter_ics) {
            return $lahan['ics'] == $filter_ics;
        });
    }

    if ($filter_kecamatan) {
        $filtered_lahan = array_filter($filtered_lahan, function ($lahan) use ($filter_kecamatan) {
            return $lahan['kecamatan'] == $filter_kecamatan;
        });
    }

    if ($filter_kabupaten) {
        $filtered_lahan = array_filter($filtered_lahan, function ($lahan) use ($filter_kabupaten) {
            return $lahan['kabupaten'] == $filter_kabupaten;
        });
    }

    if ($filter_status) {
        $filtered_lahan = array_filter($filtered_lahan, function ($lahan) use ($filter_status) {
            return $lahan['status'] == $filter_status;
        });
    }

    if ($search) {
        $search = strtolower($search);
        $filtered_lahan = array_filter($filtered_lahan, function ($lahan) use ($search) {
            return (strpos(strtolower($lahan['nama']), $search) !== false ||
                strpos(strtolower($lahan['petani']), $search) !== false ||
                strpos(strtolower($lahan['desa']), $search) !== false);
        });
    }

    // Konfigurasi Pagination
    $itemsPerPage = 5;
    $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $totalItems = count($filtered_lahan);
    $totalPages = ceil($totalItems / $itemsPerPage);
    $currentPage = min($currentPage, $totalPages);
    $startIndex = ($currentPage - 1) * $itemsPerPage;
    $paginatedLahan = array_slice($filtered_lahan, $startIndex, $itemsPerPage, true);
    ?>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 shadow-sm flex items-center justify-between px-8">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800">
                    <?php if ($mode === 'list'): ?>
                        Manajemen Lahan
                    <?php elseif ($mode === 'add'): ?>
                        Tambah Lahan Baru
                    <?php elseif ($mode === 'view'): ?>
                        Detail Lahan
                    <?php elseif ($mode === 'edit'): ?>
                        Edit Data Lahan
                    <?php endif; ?>
                </h1>
            </div>
            <div class="flex items-center space-x-6">
                <?php if ($mode === 'list'): ?>
                    <!-- Tombol Tambah Data -->
                    <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Lahan
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
                <!-- Halaman Daftar Lahan -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b">
                        <form method="get" class="space-y-4">
                            <input type="hidden" name="mode" value="list">
                            <div class="mb-4">
                                <div class="relative">
                                    <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Cari data lahan...">
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
                                            <option value="<?= htmlspecialchars($ics) ?>" <?= $filter_ics === $ics ? 'selected' : '' ?>><?= htmlspecialchars($ics) ?></option>
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

                                <!-- Filter Kabupaten -->
                                <div>
                                    <select id="filter_kabupaten" name="filter_kabupaten" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Kabupaten</option>
                                        <?php foreach ($kabupatens as $kabupaten): ?>
                                            <option value="<?= htmlspecialchars($kabupaten) ?>" <?= $filter_kabupaten === $kabupaten ? 'selected' : '' ?>><?= htmlspecialchars($kabupaten) ?></option>
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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Lahan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani Pemilik</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (Ha)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (empty($paginatedLahan)): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data lahan</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($paginatedLahan as $id_lahan => $lahan):
                                        $rowNumber = $startIndex + array_search($id_lahan, array_keys($filtered_lahan)) + 1;
                                    ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $id_lahan ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $lahan['nama'] ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div><?= $lahan['petani'] ?></div>
                                                <div class="text-xs text-gray-500"><?= $lahan['ics'] ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $lahan['luas'] ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    <?= $lahan['kabupaten'] ?>, <?= $lahan['provinsi'] ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if ($lahan['status'] === 'Aktif'): ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                                <?php else: ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses Verifikasi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="?mode=view&id=<?= $id_lahan ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                                                <a href="?mode=edit&id=<?= $id_lahan ?>" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                                                <button onclick="confirmDelete('<?= $id_lahan ?>')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
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
                <!-- Form Tambah Lahan -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Lahan Baru</h2>
                        <form id="addForm" action="?mode=list" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="nama_lahan" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan<span class="text-red-500">*</span></label>
                                        <input type="text" id="nama_lahan" name="nama_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kebun Sawit Utama" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="petani_pemilik" class="block text-sm font-medium text-gray-700 mb-1">Petani Pemilik<span class="text-red-500">*</span></label>
                                        <select id="petani_pemilik" name="petani_pemilik" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Petani</option>
                                            <option value="1">Ahmad Fauzi (ICS-12)</option>
                                            <option value="2">Siti Rahma (ICS-08)</option>
                                            <option value="3">Budi Santoso (ICS-15)</option>
                                            <option value="petani1">Petani 1 (KMJ.14.08.06.2006.0001)</option>
                                            <option value="petani2">Petani 2 (KMJ.14.08.06.2006.0002)</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="luas" class="block text-sm font-medium text-gray-700 mb-1">Luas (Ha)<span class="text-red-500">*</span></label>
                                        <input type="number" step="0.01" id="luas" name="luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 5.2" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah (Gambut/Mineral)<span class="text-red-500">*</span></label>
                                        <select id="jenis_tanah" name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Jenis Tanah</option>
                                            <option value="mineral">Mineral</option>
                                            <option value="gambut">Gambut</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kedalaman_gambut" class="block text-sm font-medium text-gray-700 mb-1">Kedalaman Tanah Gambut (m)</label>
                                        <input type="text" id="kedalaman_gambut" name="kedalaman_gambut" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 0 m (Mineral)">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tahun_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam<span class="text-red-500">*</span></label>
                                        <input type="number" id="tahun_tanam" name="tahun_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2018" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status_kepemilikan" class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan<span class="text-red-500">*</span></label>
                                        <select id="status_kepemilikan" name="status_kepemilikan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Milik Sendiri">Milik Sendiri</option>
                                            <option value="Milik Keluarga">Milik Keluarga</option>
                                            <option value="Sewa">Sewa</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="asal_benih" class="block text-sm font-medium text-gray-700 mb-1">Asal Benih<span class="text-red-500">*</span></label>
                                        <select id="asal_benih" name="asal_benih" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Asal Benih</option>
                                            <option value="Pusat Pembibitan">Pusat Pembibitan</option>
                                            <option value="Distributor Lokal">Distributor Lokal</option>
                                            <option value="Belum Distributor">Belum Distributor</option>
                                            <option value="Tidak Diketahui">Tidak Diketahui</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah_pokok" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok<span class="text-red-500">*</span></label>
                                        <input type="number" id="jumlah_pokok" name="jumlah_pokok" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 260" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pola_tanam" class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam<span class="text-red-500">*</span></label>
                                        <select id="pola_tanam" name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Pola Tanam</option>
                                            <option value="Monokultur">Monokultur</option>
                                            <option value="Polikultur">Polikultur</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="usaha_lain" class="block text-sm font-medium text-gray-700 mb-1">Usaha Lain<span class="text-red-500">*</span></label>
                                        <select id="usaha_lain" name="usaha_lain" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Usaha Lain</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Ada (Kebun Sayur)">Ada (Kebun Sayur)</option>
                                            <option value="Ada (Peternakan Ayam)">Ada (Peternakan Ayam)</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_pupuk" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pupuk<span class="text-red-500">*</span></label>
                                        <select id="jenis_pupuk" name="jenis_pupuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Jenis Pupuk</option>
                                            <option value="Organik">Organik</option>
                                            <option value="Anorganik">Anorganik</option>
                                            <option value="Organik & Anorganik">Organik & Anorganik</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Administratif</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan<span class="text-red-500">*</span></label>
                                            <input type="text" id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Bukit Agung" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan<span class="text-red-500">*</span></label>
                                            <input type="text" id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Pangkalan Kerinci" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota<span class="text-red-500">*</span></label>
                                            <input type="text" id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Pelalawan" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi<span class="text-red-500">*</span></label>
                                            <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Riau" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kode_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Kode Wilayah<span class="text-red-500">*</span></label>
                                            <input type="text" id="kode_wilayah" name="kode_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 1408062006" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Surat Tanah</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat<span class="text-red-500">*</span></label>
                                            <select id="jenis_surat" name="jenis_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Surat</option>
                                                <option value="SHM">SHM (Sertifikat Hak Milik)</option>
                                                <option value="SHGB">SHGB (Sertifikat Hak Guna Bangunan)</option>
                                                <option value="SPPT">SPPT (Surat Pemberitahuan Pajak Terutang)</option>
                                                <option value="SKT">SKT (Surat Keterangan Tanah)</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_surat" class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat<span class="text-red-500">*</span></label>
                                            <input type="text" id="no_surat" name="no_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 02812" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_stdb" class="block text-sm font-medium text-gray-700 mb-1">Nomor STDB</label>
                                            <input type="text" id="no_stdb" name="no_stdb" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2023/STDB/04567">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="luas_surat" class="block text-sm font-medium text-gray-700 mb-1">Luas Menurut Surat (Ha)<span class="text-red-500">*</span></label>
                                            <input type="number" step="0.01" id="luas_surat" name="luas_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 20.00" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="selisih_luas" class="block text-sm font-medium text-gray-700 mb-1">Selisih Luas (Ha)</label>
                                            <input type="number" step="0.01" id="selisih_luas" name="selisih_luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2.04">
                                        </div>
                                        <div class="mb-4">
                                            <label for="keterangan_selisih" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Selisih Luas</label>
                                            <input type="text" id="keterangan_selisih" name="keterangan_selisih" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Eks. PIR Trans Tahun 1985">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Batas Lahan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_utara" class="block text-sm font-medium text-gray-700 mb-1">Batas Utara<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_utara" name="batas_utara" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Sungai (Sungai Kerinci)" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_selatan" class="block text-sm font-medium text-gray-700 mb-1">Batas Selatan<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_selatan" name="batas_selatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jalan (Jalan Lintas Timur)" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_barat" class="block text-sm font-medium text-gray-700 mb-1">Batas Barat<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_barat" name="batas_barat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Lahan Lain (Milik PT. Sawit Makmur)" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_timur" class="block text-sm font-medium text-gray-700 mb-1">Batas Timur<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_timur" name="batas_timur" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Sungai (Sungai Tapung)" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="koordinat" class="block text-sm font-medium text-gray-700 mb-1">Koordinat (Format: Long,Lat;Long,Lat;...)<span class="text-red-500">*</span></label>
                                    <textarea id="koordinat" name="koordinat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 101.944025862, 0.678626965;101.943115368, 0.678607038;..." required></textarea>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end space-x-4">
                                <button type="button" onclick="window.location.href='?mode=list'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                    Simpan Data Lahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php elseif ($mode === 'view' && isset($id) && isset($data_lahan[$id])): ?>
                <!-- Halaman Detail Lahan -->
                <?php $lahan = $data_lahan[$id]; ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800"><?= $lahan['nama'] ?></h2>
                                <p class="text-gray-600">ID Lahan: <?= $id ?></p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium <?= $lahan['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= $lahan['status'] ?>
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Dasar</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Petani Pemilik:</span>
                                        <p class="text-sm font-medium"><?= $lahan['petani'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">ICS:</span>
                                        <p class="text-sm font-medium"><?= $lahan['ics'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Luas Lahan:</span>
                                        <p class="text-sm font-medium"><?= $lahan['luas'] ?> Ha</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Lokasi:</span>
                                        <p class="text-sm font-medium"><?= $lahan['lokasi'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Teknis</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Tahun Tanam:</span>
                                        <p class="text-sm font-medium"><?= $lahan['tahun_tanam'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Status Kepemilikan:</span>
                                        <p class="text-sm font-medium"><?= $lahan['status_kepemilikan'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Jenis Tanah:</span>
                                        <p class="text-sm font-medium"><?= $lahan['jenis_tanah'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Kedalaman Gambut:</span>
                                        <p class="text-sm font-medium"><?= $lahan['kedalaman_gambut'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Tanaman</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Asal Benih:</span>
                                        <p class="text-sm font-medium"><?= $lahan['asal_benih'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Jumlah Pokok:</span>
                                        <p class="text-sm font-medium"><?= $lahan['jumlah_pokok'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Pola Tanam:</span>
                                        <p class="text-sm font-medium"><?= $lahan['pola_tanam'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Usaha Lain:</span>
                                        <p class="text-sm font-medium"><?= $lahan['usaha_lain'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Data Administratif</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="text-sm text-gray-500">Desa:</span>
                                        <p class="text-sm font-medium"><?= $lahan['desa'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Kecamatan:</span>
                                        <p class="text-sm font-medium"><?= $lahan['kecamatan'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Kabupaten:</span>
                                        <p class="text-sm font-medium"><?= $lahan['kabupaten'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Provinsi:</span>
                                        <p class="text-sm font-medium"><?= $lahan['provinsi'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Kode Wilayah:</span>
                                        <p class="text-sm font-medium"><?= $lahan['kode_wilayah'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Data Surat Tanah</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="text-sm text-gray-500">Jenis Surat:</span>
                                        <p class="text-sm font-medium"><?= $lahan['jenis_surat'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">No. Surat:</span>
                                        <p class="text-sm font-medium"><?= $lahan['no_surat'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">No. STDB:</span>
                                        <p class="text-sm font-medium"><?= $lahan['no_stdb'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Luas Surat:</span>
                                        <p class="text-sm font-medium"><?= $lahan['luas_surat'] ?> Ha</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Selisih Luas:</span>
                                        <p class="text-sm font-medium"><?= $lahan['selisih_luas'] ?> Ha</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Keterangan Selisih:</span>
                                        <p class="text-sm font-medium"><?= $lahan['keterangan_selisih'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Batas Lahan</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Utara:</span>
                                        <p class="text-sm font-medium"><?= $lahan['batas_utara'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Selatan:</span>
                                        <p class="text-sm font-medium"><?= $lahan['batas_selatan'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Barat:</span>
                                        <p class="text-sm font-medium"><?= $lahan['batas_barat'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Timur:</span>
                                        <p class="text-sm font-medium"><?= $lahan['batas_timur'] ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Koordinat Lahan</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Koordinat:</span>
                                        <p class="text-sm font-medium break-all"><?= $lahan['koordinat'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Peta akan ditampilkan di sini -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-8">
                            <h3 class="font-medium text-gray-900 mb-2">Peta Lahan</h3>
                            <div id="map" class="h-64 w-full bg-gray-200 rounded-lg flex items-center justify-center">
                                <p class="text-gray-500">Peta akan ditampilkan di sini</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif ($mode === 'edit' && isset($id) && isset($data_lahan[$id])): ?>
                <!-- Form Edit Lahan -->
                <?php $lahan = $data_lahan[$id]; ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Lahan</h2>
                        <form id="editForm" action="?mode=view&id=<?= $id ?>" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="nama_lahan" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan<span class="text-red-500">*</span></label>
                                        <input type="text" id="nama_lahan" name="nama_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['nama'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="petani_pemilik" class="block text-sm font-medium text-gray-700 mb-1">Petani Pemilik<span class="text-red-500">*</span></label>
                                        <select id="petani_pemilik" name="petani_pemilik" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="1" <?= $lahan['petani'] === 'Ahmad Fauzi' ? 'selected' : '' ?>>Ahmad Fauzi (ICS-12)</option>
                                            <option value="2" <?= $lahan['petani'] === 'Siti Rahma' ? 'selected' : '' ?>>Siti Rahma (ICS-08)</option>
                                            <option value="3" <?= $lahan['petani'] === 'Budi Santoso' ? 'selected' : '' ?>>Budi Santoso (ICS-15)</option>
                                            <option value="petani1" <?= $lahan['petani'] === 'Petani 1' ? 'selected' : '' ?>>Petani 1 (KMJ.14.08.06.2006.0001)</option>
                                            <option value="petani2" <?= $lahan['petani'] === 'Petani 2' ? 'selected' : '' ?>>Petani 2 (KMJ.14.08.06.2006.0002)</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="luas" class="block text-sm font-medium text-gray-700 mb-1">Luas (Ha)<span class="text-red-500">*</span></label>
                                        <input type="number" step="0.01" id="luas" name="luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['luas'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah (Gambut/Mineral)<span class="text-red-500">*</span></label>
                                        <select id="jenis_tanah" name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="mineral" <?= $lahan['jenis_tanah'] === 'Mineral' ? 'selected' : '' ?>>Mineral</option>
                                            <option value="gambut" <?= $lahan['jenis_tanah'] === 'Gambut' ? 'selected' : '' ?>>Gambut</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kedalaman_gambut" class="block text-sm font-medium text-gray-700 mb-1">Kedalaman Tanah Gambut (m)</label>
                                        <input type="text" id="kedalaman_gambut" name="kedalaman_gambut" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['kedalaman_gambut'] ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tahun_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam<span class="text-red-500">*</span></label>
                                        <input type="number" id="tahun_tanam" name="tahun_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['tahun_tanam'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status_kepemilikan" class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan<span class="text-red-500">*</span></label>
                                        <select id="status_kepemilikan" name="status_kepemilikan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Milik Sendiri" <?= $lahan['status_kepemilikan'] === 'Milik Sendiri' ? 'selected' : '' ?>>Milik Sendiri</option>
                                            <option value="Milik Keluarga" <?= $lahan['status_kepemilikan'] === 'Milik Keluarga' ? 'selected' : '' ?>>Milik Keluarga</option>
                                            <option value="Sewa" <?= $lahan['status_kepemilikan'] === 'Sewa' ? 'selected' : '' ?>>Sewa</option>
                                            <option value="Lainnya" <?= $lahan['status_kepemilikan'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="asal_benih" class="block text-sm font-medium text-gray-700 mb-1">Asal Benih<span class="text-red-500">*</span></label>
                                        <select id="asal_benih" name="asal_benih" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Pusat Pembibitan" <?= $lahan['asal_benih'] === 'Pusat Pembibitan' ? 'selected' : '' ?>>Pusat Pembibitan</option>
                                            <option value="Distributor Lokal" <?= $lahan['asal_benih'] === 'Distributor Lokal' ? 'selected' : '' ?>>Distributor Lokal</option>
                                            <option value="Belum Distributor" <?= $lahan['asal_benih'] === 'Belum Distributor' ? 'selected' : '' ?>>Belum Distributor</option>
                                            <option value="Tidak Diketahui" <?= $lahan['asal_benih'] === 'Tidak Diketahui' ? 'selected' : '' ?>>Tidak Diketahui</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah_pokok" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok<span class="text-red-500">*</span></label>
                                        <input type="number" id="jumlah_pokok" name="jumlah_pokok" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['jumlah_pokok'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pola_tanam" class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam<span class="text-red-500">*</span></label>
                                        <select id="pola_tanam" name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Monokultur" <?= $lahan['pola_tanam'] === 'Monokultur' ? 'selected' : '' ?>>Monokultur</option>
                                            <option value="Polikultur" <?= $lahan['pola_tanam'] === 'Polikultur' ? 'selected' : '' ?>>Polikultur</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="usaha_lain" class="block text-sm font-medium text-gray-700 mb-1">Usaha Lain<span class="text-red-500">*</span></label>
                                        <select id="usaha_lain" name="usaha_lain" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Tidak Ada" <?= $lahan['usaha_lain'] === 'Tidak Ada' ? 'selected' : '' ?>>Tidak Ada</option>
                                            <option value="Ada (Kebun Sayur)" <?= $lahan['usaha_lain'] === 'Ada (Kebun Sayur)' ? 'selected' : '' ?>>Ada (Kebun Sayur)</option>
                                            <option value="Ada (Peternakan Ayam)" <?= $lahan['usaha_lain'] === 'Ada (Peternakan Ayam)' ? 'selected' : '' ?>>Ada (Peternakan Ayam)</option>
                                            <option value="Lainnya" <?= $lahan['usaha_lain'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_pupuk" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pupuk<span class="text-red-500">*</span></label>
                                        <select id="jenis_pupuk" name="jenis_pupuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Organik" <?= $lahan['jenis_pupuk'] === 'Organik' ? 'selected' : '' ?>>Organik</option>
                                            <option value="Anorganik" <?= $lahan['jenis_pupuk'] === 'Anorganik' ? 'selected' : '' ?>>Anorganik</option>
                                            <option value="Organik & Anorganik" <?= $lahan['jenis_pupuk'] === 'Organik & Anorganik' ? 'selected' : '' ?>>Organik & Anorganik</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status<span class="text-red-500">*</span></label>
                                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Aktif" <?= $lahan['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="Proses Verifikasi" <?= $lahan['status'] === 'Proses Verifikasi' ? 'selected' : '' ?>>Proses Verifikasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Administratif</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan<span class="text-red-500">*</span></label>
                                            <input type="text" id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['desa'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan<span class="text-red-500">*</span></label>
                                            <input type="text" id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['kecamatan'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota<span class="text-red-500">*</span></label>
                                            <input type="text" id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['kabupaten'] ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi<span class="text-red-500">*</span></label>
                                            <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['provinsi'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kode_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Kode Wilayah<span class="text-red-500">*</span></label>
                                            <input type="text" id="kode_wilayah" name="kode_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['kode_wilayah'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Surat Tanah</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat<span class="text-red-500">*</span></label>
                                            <select id="jenis_surat" name="jenis_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="SHM" <?= $lahan['jenis_surat'] === 'SHM' ? 'selected' : '' ?>>SHM (Sertifikat Hak Milik)</option>
                                                <option value="SHGB" <?= $lahan['jenis_surat'] === 'SHGB' ? 'selected' : '' ?>>SHGB (Sertifikat Hak Guna Bangunan)</option>
                                                <option value="SPPT" <?= $lahan['jenis_surat'] === 'SPPT' ? 'selected' : '' ?>>SPPT (Surat Pemberitahuan Pajak Terutang)</option>
                                                <option value="SKT" <?= $lahan['jenis_surat'] === 'SKT' ? 'selected' : '' ?>>SKT (Surat Keterangan Tanah)</option>
                                                <option value="Lainnya" <?= $lahan['jenis_surat'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_surat" class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat<span class="text-red-500">*</span></label>
                                            <input type="text" id="no_surat" name="no_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['no_surat'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_stdb" class="block text-sm font-medium text-gray-700 mb-1">Nomor STDB</label>
                                            <input type="text" id="no_stdb" name="no_stdb" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['no_stdb'] ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="luas_surat" class="block text-sm font-medium text-gray-700 mb-1">Luas Menurut Surat (Ha)<span class="text-red-500">*</span></label>
                                            <input type="number" step="0.01" id="luas_surat" name="luas_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['luas_surat'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="selisih_luas" class="block text-sm font-medium text-gray-700 mb-1">Selisih Luas (Ha)</label>
                                            <input type="number" step="0.01" id="selisih_luas" name="selisih_luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['selisih_luas'] ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="keterangan_selisih" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Selisih Luas</label>
                                            <input type="text" id="keterangan_selisih" name="keterangan_selisih" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['keterangan_selisih'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Batas Lahan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_utara" class="block text-sm font-medium text-gray-700 mb-1">Batas Utara<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_utara" name="batas_utara" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['batas_utara'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_selatan" class="block text-sm font-medium text-gray-700 mb-1">Batas Selatan<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_selatan" name="batas_selatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['batas_selatan'] ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_barat" class="block text-sm font-medium text-gray-700 mb-1">Batas Barat<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_barat" name="batas_barat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['batas_barat'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_timur" class="block text-sm font-medium text-gray-700 mb-1">Batas Timur<span class="text-red-500">*</span></label>
                                            <input type="text" id="batas_timur" name="batas_timur" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $lahan['batas_timur'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="koordinat" class="block text-sm font-medium text-gray-700 mb-1">Koordinat (Format: Long,Lat;Long,Lat;...)<span class="text-red-500">*</span></label>
                                    <textarea id="koordinat" name="koordinat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required><?= $lahan['koordinat'] ?></textarea>
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
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Data Lahan</h2>
                        <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
                    </div>
                </div>
            <?php endif; ?>
    </main>
</section>

<script>
    // Script untuk menangani form tambah lahan
    document.getElementById('tambahForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Validasi form sebelum submit
        if (this.checkValidity()) {
            // Simulasi penyimpanan data
            alert('Data lahan berhasil ditambahkan!');
            window.location.href = '?mode=list';
        }
    });

    // Script untuk menangani form edit lahan
    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        // Validasi form sebelum submit
        if (this.checkValidity()) {
            // Simulasi penyimpanan data
            alert('Perubahan data lahan berhasil disimpan!');
            window.location.href = '?mode=view&id=<?= $id ?>';
        }
    });

    // Script untuk menangani pencarian
    document.getElementById('searchButton').addEventListener('click', function() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#lahanTable tbody tr');

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchTerm) ? '' : 'none';
        });
    });

    // Script untuk reset pencarian
    document.getElementById('resetButton').addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        const rows = document.querySelectorAll('#lahanTable tbody tr');
        rows.forEach(row => {
            row.style.display = '';
        });
    });
</script>
<?php include 'footer.php'; ?>