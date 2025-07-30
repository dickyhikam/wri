<?php include 'header.php'; ?>
<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50 text-sm">
    <?php
    // Mode untuk menentukan tampilan
    $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    // Data Dummy Lahan
    $data_lahan = [
        'PL-001' => [
            'nama' => 'Kebun Sawit Utama',
            'petani' => 'Petani 3',
            'ics' => 'KMJ.14.08.06.2006.0003',
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
            'batas_utara' => ['type' => 'Sungai', 'detail' => 'Sungai Kerinci'],
            'batas_selatan' => ['type' => 'Jalan', 'detail' => 'Jalan Lintas Timur'],
            'batas_barat' => ['type' => 'Lahan', 'detail' => 'Milik PT. Sawit Makmur'],
            'batas_timur' => ['type' => 'Sungai', 'detail' => 'Sungai Tapung'],
            'koordinat' => [
                ['lat' => 0.678626965, 'lng' => 101.944025862],
                ['lat' => 0.678607038, 'lng' => 101.943115368],
                ['lat' => 0.680427524, 'lng' => 101.943115995],
                ['lat' => 0.680447523, 'lng' => 101.944022953]
            ],
            'status_history' => [
                ['date' => '2023-01-15', 'status' => 'Aktif', 'keterangan' => 'Pendaftaran awal'],
                ['date' => '2023-02-20', 'status' => 'Verifikasi', 'keterangan' => 'Proses verifikasi dokumen']
            ],
            'sejarah_lahan' => [
                ['date' => '2020-05-10', 'keterangan' => 'Pembukaan lahan baru', 'url_file' => 'documents/lahan1.pdf'],
                ['date' => '2021-08-15', 'keterangan' => 'Peremajaan tanaman', 'url_file' => 'documents/lahan1-remaja.pdf']
            ]
        ],
        // Tambahkan data lain jika diperlukan...
    ];
    // Filter data
    $kecamatans = array_unique(array_column($data_lahan, 'kecamatan'));
    $kabupatens = array_unique(array_column($data_lahan, 'kabupaten'));
    $statuses = array_unique(array_column($data_lahan, 'status'));
    $ics_list = array_unique(array_column($data_lahan, 'ics'));
    $filtered_lahan = $data_lahan;
    $filter_ics = isset($_GET['filter_ics']) ? $_GET['filter_ics'] : '';
    $filter_kecamatan = isset($_GET['filter_kecamatan']) ? $_GET['filter_kecamatan'] : '';
    $filter_kabupaten = isset($_GET['filter_kabupaten']) ? $_GET['filter_kabupaten'] : '';
    $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if ($filter_ics) {
        $filtered_lahan = array_filter($filtered_lahan, fn($l) => $l['ics'] == $filter_ics);
    }
    if ($filter_kecamatan) {
        $filtered_lahan = array_filter($filtered_lahan, fn($l) => $l['kecamatan'] == $filter_kecamatan);
    }
    if ($filter_kabupaten) {
        $filtered_lahan = array_filter($filtered_lahan, fn($l) => $l['kabupaten'] == $filter_kabupaten);
    }
    if ($filter_status) {
        $filtered_lahan = array_filter($filtered_lahan, fn($l) => $l['status'] == $filter_status);
    }
    if ($search) {
        $search = strtolower($search);
        $filtered_lahan = array_filter(
            $filtered_lahan,
            fn($l) =>
            strpos(strtolower($l['nama']), $search) !== false ||
                strpos(strtolower($l['petani']), $search) !== false ||
                strpos(strtolower($l['desa']), $search) !== false
        );
    }
    // Pagination
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
                    <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Lahan
                    </a>
                <?php elseif ($mode === 'view'): ?>
                    <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <a href="?mode=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                <?php elseif ($mode === 'edit' || $mode === 'add'): ?>
                    <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                <?php endif; ?>
            </div>
        </header>
        <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
            <?php if ($mode === 'list'): ?>
                <!-- Daftar Lahan -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b">
                        <form method="get" class="space-y-4">
                            <input type="hidden" name="mode" value="list">
                            <div class="mb-4">
                                <div class="relative">
                                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Cari data lahan...">
                                    <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <select id="filter_ics" name="filter_ics" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua ICS</option>
                                        <?php foreach ($ics_list as $ics): ?>
                                            <option value="<?= htmlspecialchars($ics) ?>" <?= ($filter_ics === $ics ? 'selected' : '') ?>>
                                                <?= htmlspecialchars($ics) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <select id="filter_kecamatan" name="filter_kecamatan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Kecamatan</option>
                                        <?php foreach ($kecamatans as $kecamatan): ?>
                                            <option value="<?= htmlspecialchars($kecamatan) ?>" <?= ($filter_kecamatan === $kecamatan ? 'selected' : '') ?>>
                                                <?= htmlspecialchars($kecamatan) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <select id="filter_kabupaten" name="filter_kabupaten" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Kabupaten</option>
                                        <?php foreach ($kabupatens as $kabupaten): ?>
                                            <option value="<?= htmlspecialchars($kabupaten) ?>" <?= ($filter_kabupaten === $kabupaten ? 'selected' : '') ?>>
                                                <?= htmlspecialchars($kabupaten) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <select id="filter_status" name="filter_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Status</option>
                                        <?php foreach ($statuses as $status): ?>
                                            <option value="<?= htmlspecialchars($status) ?>" <?= ($filter_status === $status ? 'selected' : '') ?>>
                                                <?= htmlspecialchars($status) ?>
                                            </option>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Lahan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lahan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Petani</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Luas (Ha)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (empty($paginatedLahan)): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($paginatedLahan as $id_lahan => $lahan):
                                        $rowNumber = $startIndex + array_search($id_lahan, array_keys($filtered_lahan)) + 1;
                                    ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm text-gray-500"><?= $rowNumber ?></td>
                                            <td class="px-6 py-4 font-medium"><?= $id_lahan ?></td>
                                            <td class="px-6 py-4"><?= $lahan['nama'] ?></td>
                                            <td class="px-6 py-4">
                                                <div><?= $lahan['petani'] ?></div>
                                                <div class="text-xs text-gray-500"><?= $lahan['ics'] ?></div>
                                            </td>
                                            <td class="px-6 py-4"><?= $lahan['luas'] ?></td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 text-xs rounded-full bg-blue-100 text-blue-800">
                                                    <?= $lahan['kabupaten'] ?>, <?= $lahan['provinsi'] ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php if ($lahan['status'] === 'Aktif'): ?>
                                                    <span class="px-2 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                                                <?php else: ?>
                                                    <span class="px-2 text-xs rounded-full bg-yellow-100 text-yellow-800">Proses</span>
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
                    <!-- Pagination -->
                    <div class="flex items-center justify-between px-4 py-3 bg-white border-t">
                        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium"><?= $startIndex + 1 ?></span> sampai
                                <span class="font-medium"><?= min($startIndex + $itemsPerPage, $totalItems) ?></span> dari
                                <span class="font-medium"><?= $totalItems ?></span>
                            </p>
                            <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium <?= $i == $currentPage ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php elseif ($mode === 'add'): ?>
                <!-- Form Tambah Lahan -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Lahan Baru</h2>
                        <form id="addForm" action="?mode=list" method="post">
                            <!-- Form Informasi Dasar & Teknis -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="nama_lahan" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan*</label>
                                        <input type="text" id="nama_lahan" name="nama_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kebun Sawit Utama" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="petani_pemilik" class="block text-sm font-medium text-gray-700 mb-1">Petani Pemilik*</label>
                                        <select id="petani_pemilik" name="petani_pemilik" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Petani</option>
                                            <option value="KMJ.14.08.06.2006.0001">Petani 1 (KMJ.14.08.06.2006.0001)</option>
                                            <option value="KMJ.14.08.06.2006.0002">Petani 2 (KMJ.14.08.06.2006.0002)</option>
                                            <option value="KMJ.14.08.06.2006.0003">Petani 3 (KMJ.14.08.06.2006.0003)</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="luas" class="block text-sm font-medium text-gray-700 mb-1">Luas (Ha)*</label>
                                        <input type="number" step="0.01" id="luas" name="luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 5.2" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah*</label>
                                        <select id="jenis_tanah" name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Jenis Tanah</option>
                                            <option value="mineral">Mineral</option>
                                            <option value="gambut">Gambut</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kedalaman_gambut" class="block text-sm font-medium text-gray-700 mb-1">Kedalaman Gambut (m)</label>
                                        <input type="text" id="kedalaman_gambut" name="kedalaman_gambut" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 0 m (Mineral)">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tahun_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam*</label>
                                        <input type="number" id="tahun_tanam" name="tahun_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2018" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status_kepemilikan" class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan*</label>
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
                                        <label for="asal_benih" class="block text-sm font-medium text-gray-700 mb-1">Asal Benih*</label>
                                        <select id="asal_benih" name="asal_benih" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Asal Benih</option>
                                            <option value="Pusat Pembibitan">Pusat Pembibitan</option>
                                            <option value="Distributor Lokal">Distributor Lokal</option>
                                            <option value="Belum Distributor">Belum Distributor</option>
                                            <option value="Tidak Diketahui">Tidak Diketahui</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah_pokok" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok*</label>
                                        <input type="number" id="jumlah_pokok" name="jumlah_pokok" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 260" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pola_tanam" class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam*</label>
                                        <select id="pola_tanam" name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Pola Tanam</option>
                                            <option value="Monokultur">Monokultur</option>
                                            <option value="Polikultur">Polikultur</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="usaha_lain" class="block text-sm font-medium text-gray-700 mb-1">Usaha Lain*</label>
                                        <select id="usaha_lain" name="usaha_lain" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Usaha Lain</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Ada (Kebun Sayur)">Ada (Kebun Sayur)</option>
                                            <option value="Ada (Peternakan Ayam)">Ada (Peternakan Ayam)</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_pupuk" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pupuk*</label>
                                        <select id="jenis_pupuk" name="jenis_pupuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Jenis Pupuk</option>
                                            <option value="Organik">Organik</option>
                                            <option value="Anorganik">Anorganik</option>
                                            <option value="Organik & Anorganik">Organik & Anorganik</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Data Administratif -->
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Administratif</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan*</label>
                                            <input type="text" id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Bukit Agung" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
                                            <input type="text" id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Pangkalan Kerinci" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota*</label>
                                            <input type="text" id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Pelalawan" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                            <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Riau" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kode_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Kode Wilayah*</label>
                                            <input type="text" id="kode_wilayah" name="kode_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 1408062006" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Data Surat Tanah -->
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Surat Tanah</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat*</label>
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
                                            <label for="no_surat" class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat*</label>
                                            <input type="text" id="no_surat" name="no_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 02812" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_stdb" class="block text-sm font-medium text-gray-700 mb-1">Nomor STDB</label>
                                            <input type="text" id="no_stdb" name="no_stdb" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2023/STDB/04567">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="luas_surat" class="block text-sm font-medium text-gray-700 mb-1">Luas Menurut Surat (Ha)*</label>
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
                            <!-- Batas Lahan -->
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Batas Lahan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_utara_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Utara*</label>
                                            <select id="batas_utara_type" name="batas_utara_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai">Sungai</option>
                                                <option value="Jalan">Jalan</option>
                                                <option value="Lahan">Lahan</option>
                                                <option value="Hutan">Hutan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_utara_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Utara*</label>
                                            <input type="text" id="batas_utara_detail" name="batas_utara_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Sungai Kerinci" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_selatan_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Selatan*</label>
                                            <select id="batas_selatan_type" name="batas_selatan_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai">Sungai</option>
                                                <option value="Jalan">Jalan</option>
                                                <option value="Lahan">Lahan</option>
                                                <option value="Hutan">Hutan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_selatan_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Selatan*</label>
                                            <input type="text" id="batas_selatan_detail" name="batas_selatan_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jalan Lintas Timur" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_barat_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Barat*</label>
                                            <select id="batas_barat_type" name="batas_barat_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai">Sungai</option>
                                                <option value="Jalan">Jalan</option>
                                                <option value="Lahan">Lahan</option>
                                                <option value="Hutan">Hutan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_barat_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Barat*</label>
                                            <input type="text" id="batas_barat_detail" name="batas_barat_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Milik PT. Sawit Makmur" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_timur_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Timur*</label>
                                            <select id="batas_timur_type" name="batas_timur_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai">Sungai</option>
                                                <option value="Jalan">Jalan</option>
                                                <option value="Lahan">Lahan</option>
                                                <option value="Hutan">Hutan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_timur_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Timur*</label>
                                            <input type="text" id="batas_timur_detail" name="batas_timur_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Sungai Tapung" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Koordinat Lahan*</label>
                                    <div id="map" class="h-64 w-full bg-gray-200 rounded-lg mb-2"></div>
                                    <button type="button" id="addCoordinate" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-2">
                                        <i class="fas fa-plus mr-2"></i> Tambah Titik Koordinat
                                    </button>
                                    <div id="coordinateList" class="space-y-2 mb-2"></div>
                                    <input type="hidden" id="koordinat" name="koordinat" required>
                                </div>
                            </div>

                            <!-- STATUS LAHAN MODAL -->
                            <div class="mt-6 border-t pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Status Lahan</h3>
                                    <button type="button" id="tambahStatusBtn" class="bg-[#ecad00] hover:bg-[#dcb100] text-white px-3 py-1 rounded-lg text-sm flex items-center">
                                        <i class="fas fa-plus mr-1"></i> Tambah Status
                                    </button>
                                </div>

                                <!-- Table Status Lahan -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Keterangan</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="statusTableBody">
                                            <!-- Data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- SEJARAH LAHAN MODAL -->
                            <div class="mt-6 border-t pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Sejarah Lahan</h3>
                                    <button type="button" id="tambahSejarahBtn" class="bg-[#ecad00] hover:bg-[#dcb100] text-white px-3 py-1 rounded-lg text-sm flex items-center">
                                        <i class="fas fa-plus mr-1"></i> Tambah Sejarah
                                    </button>
                                </div>

                                <!-- Table Sejarah Lahan -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Keterangan</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">File</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="sejarahTableBody">
                                            <!-- Data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
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
                <!-- Halaman View -->
                <?php $lahan = $data_lahan[$id]; ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800"><?= $lahan['nama'] ?></h2>
                            <p class="text-gray-600">ID Lahan: <?= $id ?></p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?= $lahan['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                            <?= $lahan['status'] ?>
                        </span>
                    </div>
                    <!-- Informasi Dasar & Teknis -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Dasar</h3>
                            <div class="space-y-2">
                                <div><span class="text-sm text-gray-500">Petani Pemilik:</span>
                                    <p class="text-sm font-medium"><?= $lahan['petani'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">ICS:</span>
                                    <p class="text-sm font-medium"><?= $lahan['ics'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Luas Lahan:</span>
                                    <p class="text-sm font-medium"><?= $lahan['luas'] ?> Ha</p>
                                </div>
                                <div><span class="text-sm text-gray-500">Lokasi:</span>
                                    <p class="text-sm font-medium"><?= $lahan['lokasi'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Teknis</h3>
                            <div class="space-y-2">
                                <div><span class="text-sm text-gray-500">Tahun Tanam:</span>
                                    <p class="text-sm font-medium"><?= $lahan['tahun_tanam'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Status Kepemilikan:</span>
                                    <p class="text-sm font-medium"><?= $lahan['status_kepemilikan'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Jenis Tanah:</span>
                                    <p class="text-sm font-medium"><?= $lahan['jenis_tanah'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Kedalaman Gambut:</span>
                                    <p class="text-sm font-medium"><?= $lahan['kedalaman_gambut'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Tanaman</h3>
                            <div class="space-y-2">
                                <div><span class="text-sm text-gray-500">Asal Benih:</span>
                                    <p class="text-sm font-medium"><?= $lahan['asal_benih'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Jumlah Pokok:</span>
                                    <p class="text-sm font-medium"><?= $lahan['jumlah_pokok'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Pola Tanam:</span>
                                    <p class="text-sm font-medium"><?= $lahan['pola_tanam'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Usaha Lain:</span>
                                    <p class="text-sm font-medium"><?= $lahan['usaha_lain'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Data Administratif & Surat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Data Administratif</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div><span class="text-sm text-gray-500">Desa:</span>
                                    <p class="text-sm font-medium"><?= $lahan['desa'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Kecamatan:</span>
                                    <p class="text-sm font-medium"><?= $lahan['kecamatan'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Kabupaten:</span>
                                    <p class="text-sm font-medium"><?= $lahan['kabupaten'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Provinsi:</span>
                                    <p class="text-sm font-medium"><?= $lahan['provinsi'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Kode Wilayah:</span>
                                    <p class="text-sm font-medium"><?= $lahan['kode_wilayah'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Data Surat Tanah</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div><span class="text-sm text-gray-500">Jenis Surat:</span>
                                    <p class="text-sm font-medium"><?= $lahan['jenis_surat'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">No. Surat:</span>
                                    <p class="text-sm font-medium"><?= $lahan['no_surat'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">No. STDB:</span>
                                    <p class="text-sm font-medium"><?= $lahan['no_stdb'] ?></p>
                                </div>
                                <div><span class="text-sm text-gray-500">Luas Surat:</span>
                                    <p class="text-sm font-medium"><?= $lahan['luas_surat'] ?> Ha</p>
                                </div>
                                <div><span class="text-sm text-gray-500">Selisih Luas:</span>
                                    <p class="text-sm font-medium"><?= $lahan['selisih_luas'] ?> Ha</p>
                                </div>
                                <div><span class="text-sm text-gray-500">Keterangan Selisih:</span>
                                    <p class="text-sm font-medium"><?= $lahan['keterangan_selisih'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Batas dan Koordinat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Batas Lahan</h3>
                            <div class="space-y-2">
                                <div><span class="text-sm text-gray-500">Utara:</span>
                                    <p class="text-sm font-medium"><?= $lahan['batas_utara']['type'] ?> (<?= $lahan['batas_utara']['detail'] ?>)</p>
                                </div>
                                <div><span class="text-sm text-gray-500">Selatan:</span>
                                    <p class="text-sm font-medium"><?= $lahan['batas_selatan']['type'] ?> (<?= $lahan['batas_selatan']['detail'] ?>)</p>
                                </div>
                                <div><span class="text-sm text-gray-500">Barat:</span>
                                    <p class="text-sm font-medium"><?= $lahan['batas_barat']['type'] ?> (<?= $lahan['batas_barat']['detail'] ?>)</p>
                                </div>
                                <div><span class="text-sm text-gray-500">Timur:</span>
                                    <p class="text-sm font-medium"><?= $lahan['batas_timur']['type'] ?> (<?= $lahan['batas_timur']['detail'] ?>)</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Koordinat Lahan</h3>
                            <div class="space-y-2">
                                <?php foreach ($lahan['koordinat'] as $coord): ?>
                                    <p class="text-sm font-medium"><?= $coord['lat'] ?>, <?= $coord['lng'] ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Peta -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Peta Lahan</h3>
                        <div id="map" class="h-64 w-full bg-gray-200 rounded-lg"></div>
                    </div>
                    <!-- Status Lahan -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-medium text-gray-900">Status Lahan</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($lahan['status_history'] as $status): ?>
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-600"><?= $status['date'] ?></td>
                                            <td class="px-4 py-2 text-sm">
                                                <span class="px-2 py-1 text-xs rounded-full 
                          <?= $status['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : ($status['status'] === 'Verifikasi' ? 'bg-yellow-100 text-yellow-800' : ($status['status'] === 'Nonaktif' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) ?>">
                                                    <?= $status['status'] ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-600"><?= $status['keterangan'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Sejarah Lahan -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-medium text-gray-900">Sejarah Lahan</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Keterangan</th>
                                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">File</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($lahan['sejarah_lahan'] as $sejarah): ?>
                                        <tr>
                                            <td class="px-4 py-2 text-sm text-gray-600"><?= $sejarah['date'] ?></td>
                                            <td class="px-4 py-2 text-sm text-gray-600"><?= $sejarah['keterangan'] ?></td>
                                            <td class="px-4 py-2 text-sm">
                                                <?php if ($sejarah['url_file']): ?>
                                                    <a href="<?= $sejarah['url_file'] ?>" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat File</a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                            <!-- Form Informasi Dasar & Teknis -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="nama_lahan" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan*</label>
                                        <input type="text" id="nama_lahan" name="nama_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                            value="<?= htmlspecialchars($lahan['nama']) ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="petani_pemilik" class="block text-sm font-medium text-gray-700 mb-1">Petani Pemilik*</label>
                                        <select id="petani_pemilik" name="petani_pemilik" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Petani</option>
                                            <option value="KMJ.14.08.06.2006.0001" <?= $lahan['ics'] == 'KMJ.14.08.06.2006.0001' ? 'selected' : '' ?>>Petani 1 (KMJ.14.08.06.2006.0001)</option>
                                            <option value="KMJ.14.08.06.2006.0002" <?= $lahan['ics'] == 'KMJ.14.08.06.2006.0002' ? 'selected' : '' ?>>Petani 2 (KMJ.14.08.06.2006.0002)</option>
                                            <option value="KMJ.14.08.06.2006.0003" <?= $lahan['ics'] == 'KMJ.14.08.06.2006.0003' ? 'selected' : '' ?>>Petani 3 (KMJ.14.08.06.2006.0003)</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="luas" class="block text-sm font-medium text-gray-700 mb-1">Luas (Ha)*</label>
                                        <input type="number" step="0.01" id="luas" name="luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                            value="<?= $lahan['luas'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah*</label>
                                        <select id="jenis_tanah" name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Jenis Tanah</option>
                                            <option value="mineral" <?= $lahan['jenis_tanah'] === 'Mineral' ? 'selected' : '' ?>>Mineral</option>
                                            <option value="gambut" <?= $lahan['jenis_tanah'] === 'Gambut' ? 'selected' : '' ?>>Gambut</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kedalaman_gambut" class="block text-sm font-medium text-gray-700 mb-1">Kedalaman Gambut (m)</label>
                                        <input type="text" id="kedalaman_gambut" name="kedalaman_gambut" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                            value="<?= htmlspecialchars($lahan['kedalaman_gambut']) ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="tahun_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam*</label>
                                        <input type="number" id="tahun_tanam" name="tahun_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                            value="<?= $lahan['tahun_tanam'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status_kepemilikan" class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan*</label>
                                        <select id="status_kepemilikan" name="status_kepemilikan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Milik Sendiri" <?= $lahan['status_kepemilikan'] === 'Milik Sendiri' ? 'selected' : '' ?>>Milik Sendiri</option>
                                            <option value="Milik Keluarga" <?= $lahan['status_kepemilikan'] === 'Milik Keluarga' ? 'selected' : '' ?>>Milik Keluarga</option>
                                            <option value="Sewa" <?= $lahan['status_kepemilikan'] === 'Sewa' ? 'selected' : '' ?>>Sewa</option>
                                            <option value="Lainnya" <?= $lahan['status_kepemilikan'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="asal_benih" class="block text-sm font-medium text-gray-700 mb-1">Asal Benih*</label>
                                        <select id="asal_benih" name="asal_benih" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Asal Benih</option>
                                            <option value="Pusat Pembibitan" <?= $lahan['asal_benih'] === 'Pusat Pembibitan' ? 'selected' : '' ?>>Pusat Pembibitan</option>
                                            <option value="Distributor Lokal" <?= $lahan['asal_benih'] === 'Distributor Lokal' ? 'selected' : '' ?>>Distributor Lokal</option>
                                            <option value="Belum Distributor" <?= $lahan['asal_benih'] === 'Belum Distributor' ? 'selected' : '' ?>>Belum Distributor</option>
                                            <option value="Tidak Diketahui" <?= $lahan['asal_benih'] === 'Tidak Diketahui' ? 'selected' : '' ?>>Tidak Diketahui</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah_pokok" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok*</label>
                                        <input type="number" id="jumlah_pokok" name="jumlah_pokok" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                            value="<?= $lahan['jumlah_pokok'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pola_tanam" class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam*</label>
                                        <select id="pola_tanam" name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Pola Tanam</option>
                                            <option value="Monokultur" <?= $lahan['pola_tanam'] === 'Monokultur' ? 'selected' : '' ?>>Monokultur</option>
                                            <option value="Polikultur" <?= $lahan['pola_tanam'] === 'Polikultur' ? 'selected' : '' ?>>Polikultur</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="usaha_lain" class="block text-sm font-medium text-gray-700 mb-1">Usaha Lain*</label>
                                        <select id="usaha_lain" name="usaha_lain" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Usaha Lain</option>
                                            <option value="Tidak Ada" <?= $lahan['usaha_lain'] === 'Tidak Ada' ? 'selected' : '' ?>>Tidak Ada</option>
                                            <option value="Ada (Kebun Sayur)" <?= $lahan['usaha_lain'] === 'Ada (Kebun Sayur)' ? 'selected' : '' ?>>Ada (Kebun Sayur)</option>
                                            <option value="Ada (Peternakan Ayam)" <?= $lahan['usaha_lain'] === 'Ada (Peternakan Ayam)' ? 'selected' : '' ?>>Ada (Peternakan Ayam)</option>
                                            <option value="Lainnya" <?= $lahan['usaha_lain'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_pupuk" class="block text-sm font-medium text-gray-700 mb-1">Jenis Pupuk*</label>
                                        <select id="jenis_pupuk" name="jenis_pupuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Jenis Pupuk</option>
                                            <option value="Organik" <?= $lahan['jenis_pupuk'] === 'Organik' ? 'selected' : '' ?>>Organik</option>
                                            <option value="Anorganik" <?= $lahan['jenis_pupuk'] === 'Anorganik' ? 'selected' : '' ?>>Anorganik</option>
                                            <option value="Organik & Anorganik" <?= $lahan['jenis_pupuk'] === 'Organik & Anorganik' ? 'selected' : '' ?>>Organik & Anorganik</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Data Administratif -->
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Administratif</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan*</label>
                                            <input type="text" id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['desa']) ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
                                            <input type="text" id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['kecamatan']) ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota*</label>
                                            <input type="text" id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['kabupaten']) ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                            <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['provinsi']) ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="kode_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Kode Wilayah*</label>
                                            <input type="text" id="kode_wilayah" name="kode_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['kode_wilayah']) ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Data Surat Tanah -->
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Data Surat Tanah</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="jenis_surat" class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat*</label>
                                            <select id="jenis_surat" name="jenis_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Surat</option>
                                                <option value="SHM" <?= $lahan['jenis_surat'] === 'SHM' ? 'selected' : '' ?>>SHM (Sertifikat Hak Milik)</option>
                                                <option value="SHGB" <?= $lahan['jenis_surat'] === 'SHGB' ? 'selected' : '' ?>>SHGB (Sertifikat Hak Guna Bangunan)</option>
                                                <option value="SPPT" <?= $lahan['jenis_surat'] === 'SPPT' ? 'selected' : '' ?>>SPPT (Surat Pemberitahuan Pajak Terutang)</option>
                                                <option value="SKT" <?= $lahan['jenis_surat'] === 'SKT' ? 'selected' : '' ?>>SKT (Surat Keterangan Tanah)</option>
                                                <option value="Lainnya" <?= $lahan['jenis_surat'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_surat" class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat*</label>
                                            <input type="text" id="no_surat" name="no_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['no_surat']) ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="no_stdb" class="block text-sm font-medium text-gray-700 mb-1">Nomor STDB</label>
                                            <input type="text" id="no_stdb" name="no_stdb" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['no_stdb']) ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="luas_surat" class="block text-sm font-medium text-gray-700 mb-1">Luas Menurut Surat (Ha)*</label>
                                            <input type="number" step="0.01" id="luas_surat" name="luas_surat" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= $lahan['luas_surat'] ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="selisih_luas" class="block text-sm font-medium text-gray-700 mb-1">Selisih Luas (Ha)</label>
                                            <input type="number" step="0.01" id="selisih_luas" name="selisih_luas" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= $lahan['selisih_luas'] ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="keterangan_selisih" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Selisih Luas</label>
                                            <input type="text" id="keterangan_selisih" name="keterangan_selisih" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['keterangan_selisih']) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Batas Lahan -->
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Batas Lahan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_utara_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Utara*</label>
                                            <select id="batas_utara_type" name="batas_utara_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai" <?= $lahan['batas_utara']['type'] === 'Sungai' ? 'selected' : '' ?>>Sungai</option>
                                                <option value="Jalan" <?= $lahan['batas_utara']['type'] === 'Jalan' ? 'selected' : '' ?>>Jalan</option>
                                                <option value="Lahan" <?= $lahan['batas_utara']['type'] === 'Lahan' ? 'selected' : '' ?>>Lahan</option>
                                                <option value="Hutan" <?= $lahan['batas_utara']['type'] === 'Hutan' ? 'selected' : '' ?>>Hutan</option>
                                                <option value="Lainnya" <?= $lahan['batas_utara']['type'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_utara_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Utara*</label>
                                            <input type="text" id="batas_utara_detail" name="batas_utara_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['batas_utara']['detail']) ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_selatan_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Selatan*</label>
                                            <select id="batas_selatan_type" name="batas_selatan_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai" <?= $lahan['batas_selatan']['type'] === 'Sungai' ? 'selected' : '' ?>>Sungai</option>
                                                <option value="Jalan" <?= $lahan['batas_selatan']['type'] === 'Jalan' ? 'selected' : '' ?>>Jalan</option>
                                                <option value="Lahan" <?= $lahan['batas_selatan']['type'] === 'Lahan' ? 'selected' : '' ?>>Lahan</option>
                                                <option value="Hutan" <?= $lahan['batas_selatan']['type'] === 'Hutan' ? 'selected' : '' ?>>Hutan</option>
                                                <option value="Lainnya" <?= $lahan['batas_selatan']['type'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_selatan_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Selatan*</label>
                                            <input type="text" id="batas_selatan_detail" name="batas_selatan_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['batas_selatan']['detail']) ?>" required>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="mb-4">
                                            <label for="batas_barat_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Barat*</label>
                                            <select id="batas_barat_type" name="batas_barat_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai" <?= $lahan['batas_barat']['type'] === 'Sungai' ? 'selected' : '' ?>>Sungai</option>
                                                <option value="Jalan" <?= $lahan['batas_barat']['type'] === 'Jalan' ? 'selected' : '' ?>>Jalan</option>
                                                <option value="Lahan" <?= $lahan['batas_barat']['type'] === 'Lahan' ? 'selected' : '' ?>>Lahan</option>
                                                <option value="Hutan" <?= $lahan['batas_barat']['type'] === 'Hutan' ? 'selected' : '' ?>>Hutan</option>
                                                <option value="Lainnya" <?= $lahan['batas_barat']['type'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_barat_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Barat*</label>
                                            <input type="text" id="batas_barat_detail" name="batas_barat_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['batas_barat']['detail']) ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_timur_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Batas Timur*</label>
                                            <select id="batas_timur_type" name="batas_timur_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                <option value="">Pilih Jenis Batas</option>
                                                <option value="Sungai" <?= $lahan['batas_timur']['type'] === 'Sungai' ? 'selected' : '' ?>>Sungai</option>
                                                <option value="Jalan" <?= $lahan['batas_timur']['type'] === 'Jalan' ? 'selected' : '' ?>>Jalan</option>
                                                <option value="Lahan" <?= $lahan['batas_timur']['type'] === 'Lahan' ? 'selected' : '' ?>>Lahan</option>
                                                <option value="Hutan" <?= $lahan['batas_timur']['type'] === 'Hutan' ? 'selected' : '' ?>>Hutan</option>
                                                <option value="Lainnya" <?= $lahan['batas_timur']['type'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="batas_timur_detail" class="block text-sm font-medium text-gray-700 mb-1">Detail Batas Timur*</label>
                                            <input type="text" id="batas_timur_detail" name="batas_timur_detail" class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                                value="<?= htmlspecialchars($lahan['batas_timur']['detail']) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Koordinat Lahan*</label>
                                    <div id="map" class="h-64 w-full bg-gray-200 rounded-lg mb-2"></div>
                                    <button type="button" id="addCoordinate" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mb-2">
                                        <i class="fas fa-plus mr-2"></i> Tambah Titik Koordinat
                                    </button>
                                    <div id="coordinateList" class="space-y-2 mb-2"></div>
                                    <input type="hidden" id="koordinat" name="koordinat" value='<?= json_encode($lahan['koordinat']) ?>' required>
                                </div>
                            </div>

                            <!-- STATUS LAHAN MODAL -->
                            <div class="mt-6 border-t pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Status Lahan</h3>
                                    <button type="button" id="tambahStatusBtn" class="bg-[#ecad00] hover:bg-[#dcb100] text-white px-3 py-1 rounded-lg text-sm flex items-center">
                                        <i class="fas fa-plus mr-1"></i> Tambah Status
                                    </button>
                                </div>

                                <!-- Table Status Lahan -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Keterangan</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="statusTableBody">
                                            <!-- Data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- SEJARAH LAHAN MODAL -->
                            <div class="mt-6 border-t pt-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">Sejarah Lahan</h3>
                                    <button type="button" id="tambahSejarahBtn" class="bg-[#ecad00] hover:bg-[#dcb100] text-white px-3 py-1 rounded-lg text-sm flex items-center">
                                        <i class="fas fa-plus mr-1"></i> Tambah Sejarah
                                    </button>
                                </div>

                                <!-- Table Sejarah Lahan -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tanggal</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Keterangan</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">File</th>
                                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200" id="sejarahTableBody">
                                            <!-- Data will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
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
            <?php endif; ?>
        </section>
    </main>
</section>

<!-- Modal for Status Lahan -->
<div id="statusModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Status Lahan</h3>
                        <form id="statusFormModal" class="mt-2">
                            <input type="hidden" id="modal_status_index" value="-1">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="modal_status_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal*</label>
                                    <input type="date" id="modal_status_date" name="modal_status_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <label for="modal_status_value" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                                    <select id="modal_status_value" name="modal_status_value" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Verifikasi">Verifikasi</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                        <option value="Sengketa">Sengketa</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="modal_status_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                    <input type="text" id="modal_status_keterangan" name="modal_status_keterangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveStatusBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#ecad00] text-base font-medium text-white hover:bg-[#dcb100] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ecad00] sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" id="cancelStatusBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Sejarah Lahan -->
<div id="sejarahModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Sejarah Lahan</h3>
                        <form id="sejarahFormModal" class="mt-2">
                            <input type="hidden" id="modal_sejarah_index" value="-1">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="modal_sejarah_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal*</label>
                                    <input type="date" id="modal_sejarah_date" name="modal_sejarah_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <label for="modal_sejarah_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan*</label>
                                    <input type="text" id="modal_sejarah_keterangan" name="modal_sejarah_keterangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <label for="modal_sejarah_file" class="block text-sm font-medium text-gray-700 mb-1">Sertifikat (Upload Foto)</label>
                                    <input type="file" id="modal_sejarah_file" name="modal_sejarah_file" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveSejarahBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#ecad00] text-base font-medium text-white hover:bg-[#dcb100] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ecad00] sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" id="cancelSejarahBtn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Validasi form tambah
    document.getElementById('addForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        if (this.checkValidity()) {
            alert('Data lahan berhasil ditambahkan!');
            window.location.href = '?mode=list';
        }
    });

    // Validasi form edit
    document.getElementById('editForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        if (this.checkValidity()) {
            alert('Perubahan berhasil disimpan!');
            window.location.href = '?mode=view&id=<?= $id ?>';
        }
    });

    // Reset modal forms
    function resetStatusModal() {
        document.getElementById('modal_status_date').value = '';
        document.getElementById('modal_status_value').value = '';
        document.getElementById('modal_status_keterangan').value = '';
        document.getElementById('modal_status_index').value = '-1';
        document.getElementById('modal-title').textContent = 'Tambah Status Lahan';
    }

    function resetSejarahModal() {
        document.getElementById('modal_sejarah_date').value = '';
        document.getElementById('modal_sejarah_keterangan').value = '';
        document.getElementById('modal_sejarah_file').value = '';
        document.getElementById('modal_sejarah_index').value = '-1';
        document.getElementById('modal-title').textContent = 'Tambah Sejarah Lahan';
    }

    // Toggle modal for status lahan
    document.getElementById('tambahStatusBtn')?.addEventListener('click', function() {
        document.getElementById('statusModal').classList.remove('hidden');
        resetStatusModal();
    });

    document.getElementById('cancelStatusBtn')?.addEventListener('click', function() {
        document.getElementById('statusModal').classList.add('hidden');
        resetStatusModal();
    });

    // Toggle modal for sejarah lahan
    document.getElementById('tambahSejarahBtn')?.addEventListener('click', function() {
        document.getElementById('sejarahModal').classList.remove('hidden');
        resetSejarahModal();
    });

    document.getElementById('cancelSejarahBtn')?.addEventListener('click', function() {
        document.getElementById('sejarahModal').classList.add('hidden');
        resetSejarahModal();
    });

    // Save Status Lahan
    document.getElementById('saveStatusBtn')?.addEventListener('click', function() {
        const date = document.getElementById('modal_status_date').value;
        const status = document.getElementById('modal_status_value').value;
        const keterangan = document.getElementById('modal_status_keterangan').value;
        const index = parseInt(document.getElementById('modal_status_index').value);

        if (!date || !status) {
            alert('Tanggal dan Status harus diisi!');
            return;
        }

        // Add to status_history array
        let statusHistory = [];
        try {
            statusHistory = JSON.parse(document.getElementById('koordinat').value) || [];
        } catch (e) {
            statusHistory = [];
        }

        const newStatus = {
            date,
            status,
            keterangan
        };

        if (index === -1) {
            // Add new status
            statusHistory.push(newStatus);
        } else {
            // Edit existing status
            statusHistory[index] = newStatus;
        }

        document.getElementById('koordinat').value = JSON.stringify(statusHistory);

        // Refresh status table
        refreshStatusTable(statusHistory);

        // Close modal
        document.getElementById('statusModal').classList.add('hidden');
        resetStatusModal();
    });

    // Save Sejarah Lahan
    document.getElementById('saveSejarahBtn')?.addEventListener('click', function() {
        const date = document.getElementById('modal_sejarah_date').value;
        const keterangan = document.getElementById('modal_sejarah_keterangan').value;
        const file = document.getElementById('modal_sejarah_file').files[0];
        const index = parseInt(document.getElementById('modal_sejarah_index').value);

        if (!date || !keterangan) {
            alert('Tanggal dan Keterangan harus diisi!');
            return;
        }

        // Add to sejarah_lahan array
        let sejarahLahan = [];
        try {
            sejarahLahan = JSON.parse(document.getElementById('sejarah_lahan').value) || [];
        } catch (e) {
            sejarahLahan = [];
        }

        const newSejarah = {
            date,
            keterangan,
            url_file: file ? URL.createObjectURL(file) : (index !== -1 ? sejarahLahan[index].url_file : '')
        };

        if (index === -1) {
            // Add new sejarah
            sejarahLahan.push(newSejarah);
        } else {
            // Edit existing sejarah
            sejarahLahan[index] = newSejarah;
        }

        document.getElementById('sejarah_lahan').value = JSON.stringify(sejarahLahan);

        // Refresh sejarah table
        refreshSejarahTable(sejarahLahan);

        // Close modal
        document.getElementById('sejarahModal').classList.add('hidden');
        resetSejarahModal();
    });

    // Refresh Status Table
    function refreshStatusTable(statusHistory) {
        const tableBody = document.getElementById('statusTableBody');
        tableBody.innerHTML = '';

        statusHistory.forEach((status, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
        <td class="px-4 py-2 text-sm text-gray-600">${status.date}</td>
        <td class="px-4 py-2 text-sm">
          <span class="px-2 py-1 text-xs rounded-full 
            ${status.status === 'Aktif' ? 'bg-green-100 text-green-800' :
             status.status === 'Verifikasi' ? 'bg-yellow-100 text-yellow-800' :
             status.status === 'Nonaktif' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'}">
            ${status.status}
          </span>
        </td>
        <td class="px-4 py-2 text-sm text-gray-600">${status.keterangan}</td>
        <td class="px-4 py-2 text-sm">
          <button type="button" onclick="editStatus(${index})" class="text-blue-600 hover:text-blue-800 mr-2">
            <i class="fas fa-edit"></i>
          </button>
          <button type="button" onclick="hapusStatus(${index})" class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      `;
            tableBody.appendChild(row);
        });
    }

    // Refresh Sejarah Table
    function refreshSejarahTable(sejarahLahan) {
        const tableBody = document.getElementById('sejarahTableBody');
        tableBody.innerHTML = '';

        sejarahLahan.forEach((sejarah, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
        <td class="px-4 py-2 text-sm text-gray-600">${sejarah.date}</td>
        <td class="px-4 py-2 text-sm text-gray-600">${sejarah.keterangan}</td>
        <td class="px-4 py-2 text-sm">
          ${sejarah.url_file ? `<a href="${sejarah.url_file}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat File</a>` : '-'}
        </td>
        <td class="px-4 py-2 text-sm">
          <button type="button" onclick="editSejarah(${index})" class="text-blue-600 hover:text-blue-800 mr-2">
            <i class="fas fa-edit"></i>
          </button>
          <button type="button" onclick="hapusSejarah(${index})" class="text-red-600 hover:text-red-800">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      `;
            tableBody.appendChild(row);
        });
    }

    // Edit Status
    function editStatus(index) {
        let statusHistory = [];
        try {
            statusHistory = JSON.parse(document.getElementById('koordinat').value) || [];
        } catch (e) {
            statusHistory = [];
        }

        if (index >= 0 && index < statusHistory.length) {
            const status = statusHistory[index];
            document.getElementById('modal_status_date').value = status.date;
            document.getElementById('modal_status_value').value = status.status;
            document.getElementById('modal_status_keterangan').value = status.keterangan;
            document.getElementById('modal_status_index').value = index;
            document.getElementById('modal-title').textContent = 'Edit Status Lahan';
            document.getElementById('statusModal').classList.remove('hidden');
        }
    }

    // Edit Sejarah
    function editSejarah(index) {
        let sejarahLahan = [];
        try {
            sejarahLahan = JSON.parse(document.getElementById('sejarah_lahan').value) || [];
        } catch (e) {
            sejarahLahan = [];
        }

        if (index >= 0 && index < sejarahLahan.length) {
            const sejarah = sejarahLahan[index];
            document.getElementById('modal_sejarah_date').value = sejarah.date;
            document.getElementById('modal_sejarah_keterangan').value = sejarah.keterangan;
            document.getElementById('modal_sejarah_index').value = index;
            document.getElementById('modal-title').textContent = 'Edit Sejarah Lahan';
            document.getElementById('sejarahModal').classList.remove('hidden');
        }
    }

    // Fungsi hapus status
    function hapusStatus(index) {
        if (confirm('Apakah Anda yakin ingin menghapus status ini?')) {
            // Get current status history
            let statusHistory = [];
            try {
                statusHistory = JSON.parse(document.getElementById('koordinat').value) || [];
            } catch (e) {
                statusHistory = [];
            }

            // Remove item at index
            statusHistory.splice(index, 1);

            // Update hidden field
            document.getElementById('koordinat').value = JSON.stringify(statusHistory);

            // Refresh table
            refreshStatusTable(statusHistory);

            alert('Status berhasil dihapus!');
        }
    }

    // Fungsi hapus sejarah
    function hapusSejarah(index) {
        if (confirm('Apakah Anda yakin ingin menghapus sejarah ini?')) {
            // Get current sejarah lahan
            let sejarahLahan = [];
            try {
                sejarahLahan = JSON.parse(document.getElementById('sejarah_lahan').value) || [];
            } catch (e) {
                sejarahLahan = [];
            }

            // Remove item at index
            sejarahLahan.splice(index, 1);

            // Update hidden field
            document.getElementById('sejarah_lahan').value = JSON.stringify(sejarahLahan);

            // Refresh table
            refreshSejarahTable(sejarahLahan);

            alert('Sejarah berhasil dihapus!');
        }
    }

    // Inisialisasi peta untuk tambah/edit
    document.addEventListener('DOMContentLoaded', function() {
        const mapElement = document.getElementById('map');
        if (mapElement) {
            const map = L.map('map').setView([0.6786, 101.9440], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            let markers = [];
            let coordinates = [];

            // Get coordinates from hidden field if editing
            try {
                const koordinatField = document.getElementById('koordinat');
                if (koordinatField && koordinatField.value) {
                    coordinates = JSON.parse(koordinatField.value);
                }
            } catch (e) {
                console.error('Error parsing coordinates:', e);
            }

            // Tampilkan koordinat yang sudah ada
            coordinates.forEach(coord => {
                const marker = L.marker([coord.lat, coord.lng]).addTo(map);
                markers.push(marker);
            });
            updateCoordinateList();

            document.getElementById('addCoordinate').addEventListener('click', function() {
                const center = map.getCenter();
                const lat = center.lat.toFixed(6);
                const lng = center.lng.toFixed(6);
                const marker = L.marker([lat, lng]).addTo(map);
                markers.push(marker);
                coordinates.push({
                    lat,
                    lng
                });
                updateCoordinateList();
                document.getElementById('koordinat').value = JSON.stringify(coordinates);
            });

            function updateCoordinateList() {
                const list = document.getElementById('coordinateList');
                list.innerHTML = '';
                coordinates.forEach((coord, index) => {
                    const div = document.createElement('div');
                    div.className = 'flex items-center justify-between p-2 border border-gray-300 rounded';
                    div.innerHTML = `
            <span>Titik ${index + 1}: ${coord.lat}, ${coord.lng}</span>
            <button type="button" onclick="removeCoordinate(${index})" class="text-red-600">
              <i class="fas fa-trash"></i>
            </button>
          `;
                    list.appendChild(div);
                });
            }

            window.removeCoordinate = function(index) {
                map.removeLayer(markers[index]);
                markers.splice(index, 1);
                coordinates.splice(index, 1);
                updateCoordinateList();
                document.getElementById('koordinat').value = JSON.stringify(coordinates);
            };

            // Initialize status and sejarah tables if in edit mode
            <?php if ($mode === 'edit' && isset($id) && isset($data_lahan[$id])): ?>
                const lahan = <?= json_encode($data_lahan[$id]) ?>;

                // Initialize status table
                if (lahan.status_history) {
                    refreshStatusTable(lahan.status_history);
                    // Store in hidden field
                    document.getElementById('koordinat').value = JSON.stringify(lahan.status_history);
                }

                // Initialize sejarah table
                if (lahan.sejarah_lahan) {
                    refreshSejarahTable(lahan.sejarah_lahan);
                    // Store in hidden field
                    document.getElementById('sejarah_lahan').value = JSON.stringify(lahan.sejarah_lahan);
                }
            <?php endif; ?>
        }
    });

    // Inisialisasi peta untuk view
    <?php if ($mode === 'view' && isset($lahan['koordinat'])): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const coords = <?= json_encode($lahan['koordinat']) ?>;
            if (coords.length > 0) {
                const map = L.map('map').setView([coords[0].lat, coords[0].lng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
                coords.forEach(coord => {
                    L.marker([coord.lat, coord.lng]).addTo(map);
                });
                if (coords.length > 1) {
                    L.polyline(coords.map(c => [c.lat, c.lng]), {
                        color: 'blue'
                    }).addTo(map);
                }
            }
        });
    <?php endif; ?>
</script>
<?php include 'footer.php'; ?>