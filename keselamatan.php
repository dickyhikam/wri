<?php include 'header.php'; ?>
<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <?php
    // Enhanced dummy data with more complete records
    $dummyK3Incidents = [
        [
            'kcl_kerja_id' => 1,
            'farmer_gr_id' => 'KMJ.14.08.06.2006.0001',
            'periode' => '2024-05-15',
            'jumlah_korban' => 1,
            'lokasi_utama' => 'Blok Perkebunan A5',
            'kategori_utama' => 'Terjatuh',
            'korban' => [
                [
                    'kcl_kerja_korban_id' => 1,
                    'user_id' => '',
                    'type_user' => 'petani',
                    'nama' => 'Budi Santoso',
                    'lokasi_kejadian' => 'Kebun Kelapa Sawit Blok A5',
                    'kategori' => 'Terjatuh dari Tangga Panen',
                    'kerugian' => 'Patah tulang lengan kanan',
                    'keterangan' => 'Terjatuh saat memetik TBS dari ketinggian 4 meter'
                ]
            ],
            'tindakan' => 'Dibawa ke Puskesmas terdekat',
            'pencegahan' => 'Penggunaan tangga yang lebih stabil dan pelatihan keselamatan'
        ],
        [
            'kcl_kerja_id' => 2,
            'farmer_gr_id' => 'KMJ.14.08.06.2006.0002',
            'periode' => '2024-05-20',
            'jumlah_korban' => 2,
            'lokasi_utama' => 'Gudang Pestisida',
            'kategori_utama' => 'Keracunan',
            'korban' => [
                [
                    'kcl_kerja_korban_id' => 2,
                    'user_id' => 'KAR.001',
                    'type_user' => 'karyawan',
                    'nama' => 'Ahmad Fauzi',
                    'lokasi_kejadian' => 'Gudang Penyimpanan Pestisida',
                    'kategori' => 'Paparan Kimia',
                    'kerugian' => 'Gangguan pernapasan dan iritasi kulit',
                    'keterangan' => 'Tidak menggunakan APD saat menangani pestisida'
                ],
                [
                    'kcl_kerja_korban_id' => 3,
                    'user_id' => 'KAR.002',
                    'type_user' => 'karyawan',
                    'nama' => 'Dewi Ratnasari',
                    'lokasi_kejadian' => 'Gudang Penyimpanan Pestisida',
                    'kategori' => 'Paparan Kimia',
                    'kerugian' => 'Pusing dan mual',
                    'keterangan' => 'Tidak menggunakan masker saat bekerja'
                ]
            ],
            'tindakan' => 'Pertolongan pertama dan rujukan ke rumah sakit',
            'pencegahan' => 'Pelatihan penanganan bahan kimia dan pengadaan APD lengkap'
        ],
        [
            'kcl_kerja_id' => 3,
            'farmer_gr_id' => 'ICS-08',
            'periode' => '2024-06-01',
            'jumlah_korban' => 1,
            'lokasi_utama' => 'Workshop Mekanik',
            'kategori_utama' => 'Tertimpa',
            'korban' => [
                [
                    'kcl_kerja_korban_id' => 4,
                    'user_id' => 'KAR.003',
                    'type_user' => 'karyawan',
                    'nama' => 'Joko Prasetyo',
                    'lokasi_kejadian' => 'Area Perbaikan Traktor',
                    'kategori' => 'Tertimpa Peralatan',
                    'kerugian' => 'Memar di punggung dan lengan',
                    'keterangan' => 'Traktor tergelincir saat perbaikan'
                ]
            ],
            'tindakan' => 'Pertolongan pertama di klinik perusahaan',
            'pencegahan' => 'Pemasangan rambu keselamatan dan standar prosedur perbaikan'
        ],
        [
            'kcl_kerja_id' => 4,
            'farmer_gr_id' => 'KMJ.14.08.06.2006.0003',
            'periode' => '2024-06-10',
            'jumlah_korban' => 1,
            'lokasi_utama' => 'Kebun Kelapa Sawit',
            'kategori_utama' => 'Gigitan Hewan',
            'korban' => [
                [
                    'kcl_kerja_korban_id' => 5,
                    'user_id' => '',
                    'type_user' => 'petani',
                    'nama' => 'Siti Rahayu',
                    'lokasi_kejadian' => 'Blok Perkebunan C2',
                    'kategori' => 'Gigitan Ular',
                    'kerugian' => 'Luka gigitan di kaki kanan',
                    'keterangan' => 'Digigit ular saat membersihkan gulma'
                ]
            ],
            'tindakan' => 'Dibawa ke rumah sakit untuk mendapatkan anti-venom',
            'pencegahan' => 'Pembersihan area kerja dan penyediaan sepatu boots'
        ],
        [
            'kcl_kerja_id' => 5,
            'farmer_gr_id' => 'ICS-01',
            'periode' => '2024-06-15',
            'jumlah_korban' => 3,
            'lokasi_utama' => 'Pabrik Pengolahan',
            'kategori_utama' => 'Kebakaran',
            'korban' => [
                [
                    'kcl_kerja_korban_id' => 6,
                    'user_id' => 'KAR.004',
                    'type_user' => 'karyawan',
                    'nama' => 'Rudi Hermawan',
                    'lokasi_kejadian' => 'Ruang Boiler',
                    'kategori' => 'Luka Bakar',
                    'kerugian' => 'Luka bakar derajat dua di tangan',
                    'keterangan' => 'Kebocoran pipa steam'
                ],
                [
                    'kcl_kerja_korban_id' => 7,
                    'user_id' => 'KAR.005',
                    'type_user' => 'karyawan',
                    'nama' => 'Eko Prasetyo',
                    'lokasi_kejadian' => 'Ruang Boiler',
                    'kategori' => 'Inhalasi Asap',
                    'kerugian' => 'Gangguan pernapasan',
                    'keterangan' => 'Menghirup asap kebakaran'
                ],
                [
                    'kcl_kerja_korban_id' => 8,
                    'user_id' => 'KAR.006',
                    'type_user' => 'karyawan',
                    'nama' => 'Linda Sari',
                    'lokasi_kejadian' => 'Koridor Evakuasi',
                    'kategori' => 'Terjatuh',
                    'kerugian' => 'Keseleo pergelangan kaki',
                    'keterangan' => 'Terpeleset saat evakuasi'
                ]
            ],
            'tindakan' => 'Evakuasi dan perawatan medis',
            'pencegahan' => 'Pemeriksaan rutin peralatan dan pelatihan evakuasi'
        ]
    ];

    // Dummy data for dropdowns
    $dummyGroups = [
        ['farmer_gr_id' => 'KMJ.14.08.06.2006.0001', 'name' => 'Kelompok Tani Makmur'],
        ['farmer_gr_id' => 'KMJ.14.08.06.2006.0002', 'name' => 'Kelompok Tani Sejahtera'],
        ['farmer_gr_id' => 'KMJ.14.08.06.2006.0003', 'name' => 'Kelompok Tani Subur'],
        ['farmer_gr_id' => 'ICS-01', 'name' => 'Inti-Core Supplier 01'],
        ['farmer_gr_id' => 'ICS-02', 'name' => 'Inti-Core Supplier 02'],
        ['farmer_gr_id' => 'ICS-08', 'name' => 'Inti-Core Supplier 08']
    ];

    $dummyKategori = [
        'Terjatuh',
        'Tertimpa',
        'Terpotong',
        'Tertusuk',
        'Terkena Benda Tajam',
        'Kontak Listrik',
        'Paparan Kimia',
        'Gigitan Hewan',
        'Kebakaran',
        'Kecelakaan Transportasi',
        'Ergonomi',
        'Lainnya'
    ];

    $dummyTindakan = [
        'Pertolongan Pertama',
        'Rujuk ke Puskesmas',
        'Rujuk ke Rumah Sakit',
        'Evakuasi',
        'Perawatan di Klinik',
        'Lainnya'
    ];

    // Action handler
    $mode = $_GET['mode'] ?? 'list';
    $kcl_kerja_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'add':
                    // Generate new ID
                    $newId = !empty($dummyK3Incidents) ? max(array_column($dummyK3Incidents, 'kcl_kerja_id')) + 1 : 1;

                    // Create new incident
                    $newIncident = [
                        'kcl_kerja_id' => $newId,
                        'farmer_gr_id' => $_POST['farmer_gr_id'],
                        'periode' => $_POST['periode'],
                        'jumlah_korban' => (int)$_POST['jumlah_korban'],
                        'lokasi_utama' => $_POST['lokasi_utama'],
                        'kategori_utama' => $_POST['kategori_utama'],
                        'tindakan' => $_POST['tindakan'],
                        'pencegahan' => $_POST['pencegahan'],
                        'korban' => []
                    ];

                    // Process victims
                    foreach ($_POST['type_user'] as $index => $type) {
                        $newIncident['korban'][] = [
                            'kcl_kerja_korban_id' => $index + 1,
                            'user_id' => $_POST['user_id'][$index] ?? '',
                            'type_user' => $type,
                            'nama' => $_POST['nama'][$index],
                            'lokasi_kejadian' => $_POST['lokasi_kejadian'][$index],
                            'kategori' => $_POST['kategori'][$index],
                            'kerugian' => $_POST['kerugian'][$index],
                            'keterangan' => $_POST['keterangan'][$index] ?? ''
                        ];
                    }

                    $dummyK3Incidents[] = $newIncident;
                    $mode = 'list';
                    break;

                case 'edit':
                    // Find and update incident
                    foreach ($dummyK3Incidents as &$incident) {
                        if ($incident['kcl_kerja_id'] == $kcl_kerja_id) {
                            $incident['farmer_gr_id'] = $_POST['farmer_gr_id'];
                            $incident['periode'] = $_POST['periode'];
                            $incident['jumlah_korban'] = (int)$_POST['jumlah_korban'];
                            $incident['lokasi_utama'] = $_POST['lokasi_utama'];
                            $incident['kategori_utama'] = $_POST['kategori_utama'];
                            $incident['tindakan'] = $_POST['tindakan'];
                            $incident['pencegahan'] = $_POST['pencegahan'];

                            // Update victims
                            $incident['korban'] = [];
                            foreach ($_POST['type_user'] as $index => $type) {
                                $incident['korban'][] = [
                                    'kcl_kerja_korban_id' => $_POST['korban_id'][$index] ?? ($index + 1),
                                    'user_id' => $_POST['user_id'][$index] ?? '',
                                    'type_user' => $type,
                                    'nama' => $_POST['nama'][$index],
                                    'lokasi_kejadian' => $_POST['lokasi_kejadian'][$index],
                                    'kategori' => $_POST['kategori'][$index],
                                    'kerugian' => $_POST['kerugian'][$index],
                                    'keterangan' => $_POST['keterangan'][$index] ?? ''
                                ];
                            }
                            break;
                        }
                    }
                    $mode = 'view';
                    break;

                case 'delete':
                    // Delete incident
                    $dummyK3Incidents = array_filter($dummyK3Incidents, function ($incident) use ($kcl_kerja_id) {
                        return $incident['kcl_kerja_id'] != $kcl_kerja_id;
                    });
                    $mode = 'list';
                    break;
            }
        }
    }

    // Find incident for detail/edit view
    $incident = null;
    if ($kcl_kerja_id > 0) {
        foreach ($dummyK3Incidents as $data) {
            if ($data['kcl_kerja_id'] == $kcl_kerja_id) {
                $incident = $data;
                break;
            }
        }
    }

    // Pagination configuration
    $perPage = 5;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max(1, $currentPage);

    // Filter variables
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    $farmerGrFilter = isset($_GET['farmer_gr_filter']) ? $_GET['farmer_gr_filter'] : '';
    $kategoriFilter = isset($_GET['kategori_filter']) ? $_GET['kategori_filter'] : '';

    // Apply filters
    $filteredData = $dummyK3Incidents;

    if ($searchTerm !== '') {
        $filteredData = array_filter($filteredData, function ($item) use ($searchTerm) {
            return stripos($item['farmer_gr_id'], $searchTerm) !== false ||
                stripos($item['lokasi_utama'], $searchTerm) !== false ||
                stripos($item['kategori_utama'], $searchTerm) !== false ||
                stripos(implode(' ', array_column($item['korban'], 'nama')), $searchTerm) !== false;
        });
    }

    if ($farmerGrFilter !== '') {
        $filteredData = array_filter($filteredData, function ($item) use ($farmerGrFilter) {
            return $item['farmer_gr_id'] === $farmerGrFilter;
        });
    }

    if ($kategoriFilter !== '') {
        $filteredData = array_filter($filteredData, function ($item) use ($kategoriFilter) {
            return $item['kategori_utama'] === $kategoriFilter;
        });
    }

    // Pagination logic
    $totalItems = count($filteredData);
    $totalPages = ceil($totalItems / $perPage);
    $currentPage = min($currentPage, $totalPages);
    $offset = ($currentPage - 1) * $perPage;
    $currentPageData = array_slice($filteredData, $offset, $perPage);

    // Get group names for display
    $groupNames = [];
    foreach ($dummyGroups as $group) {
        $groupNames[$group['farmer_gr_id']] = $group['name'];
    }
    ?>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 shadow-sm flex items-center justify-between px-8">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800">
                    <?php if ($mode === 'list'): ?>
                        Manajemen Data K3 (Keselamatan dan Kesehatan Kerja)
                    <?php elseif ($mode === 'add'): ?>
                        Tambah Data K3 Baru
                    <?php elseif ($mode === 'view'): ?>
                        Detail Data K3
                    <?php elseif ($mode === 'edit'): ?>
                        Edit Data K3
                    <?php endif; ?>
                </h1>
            </div>
            <div class="flex items-center space-x-6">
                <?php if ($mode === 'list'): ?>
                    <!-- Tombol Tambah Data -->
                    <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Data
                    </a>
                <?php elseif ($mode === 'view'): ?>
                    <!-- Tombol Kembali ke Daftar -->
                    <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <!-- Tombol Edit -->
                    <a href="?mode=edit&id=<?= $kcl_kerja_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
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
                <!-- Halaman Daftar K3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-4 bg-gray-50 border-b">
                        <form method="get" class="space-y-4">
                            <input type="hidden" name="mode" value="list">
                            <div class="mb-4">
                                <div class="relative">
                                    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?>"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Cari data K3...">
                                    <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Filter Grup Petani -->
                                <div>
                                    <select id="farmer_gr_filter" name="farmer_gr_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Grup Petani</option>
                                        <?php foreach ($dummyGroups as $group): ?>
                                            <option value="<?= htmlspecialchars($group['farmer_gr_id']) ?>" <?= $farmerGrFilter === $group['farmer_gr_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($group['name']) ?> (<?= htmlspecialchars($group['farmer_gr_id']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Filter Kategori -->
                                <div>
                                    <select id="kategori_filter" name="kategori_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Kategori</option>
                                        <?php foreach ($dummyKategori as $kategori): ?>
                                            <option value="<?= htmlspecialchars($kategori) ?>" <?= $kategoriFilter === $kategori ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($kategori) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex gap-2">
                                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-filter mr-2"></i> Filter
                                    </button>
                                    <a href="?mode=list" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-sync-alt mr-2"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Kejadian</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grup Petani</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Korban</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (empty($currentPageData)): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data K3 yang ditemukan.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($currentPageData as $index => $data): ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $offset + $index + 1 ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">K3-<?= str_pad($data['kcl_kerja_id'], 3, '0', STR_PAD_LEFT) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?= htmlspecialchars($data['farmer_gr_id']) ?></div>
                                                <div class="text-xs text-gray-500"><?= htmlspecialchars($groupNames[$data['farmer_gr_id']] ?? '') ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d M Y', strtotime($data['periode'])) ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($data['lokasi_utama']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($data['kategori_utama']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900"><?= $data['jumlah_korban'] ?> orang</div>
                                                <div class="text-xs text-gray-500">
                                                    <?= implode(', ', array_map(function ($k) {
                                                        return htmlspecialchars($k['nama']);
                                                    }, array_slice($data['korban'], 0, 2))) ?>
                                                    <?= count($data['korban']) > 2 ? '...' : '' ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="?mode=view&id=<?= $data['kcl_kerja_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                                                <a href="?mode=edit&id=<?= $data['kcl_kerja_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                                                <a href="?mode=delete&id=<?= $data['kcl_kerja_id'] ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
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
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                Previous
                            </a>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                Next
                            </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium"><?= $offset + 1 ?></span> sampai <span class="font-medium"><?= min($offset + $perPage, $totalItems) ?></span> dari <span class="font-medium"><?= $totalItems ?></span> hasil
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
                <!-- Form Tambah Data K3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Data K3 Baru</h2>
                        <form method="post">
                            <input type="hidden" name="action" value="add">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><span class="text-red-500">*</span></label>
                                    <div class="mb-4">
                                        <label for="farmer_gr_id" class="block text-sm font-medium text-gray-700 mb-1">Grup Petani<span class="text-red-500">*</span></label>
                                        <select id="farmer_gr_id" name="farmer_gr_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Grup Petani</option><span class="text-red-500">*</span></label>
                                            <?php foreach ($dummyGroups as $group): ?>
                                                <option value="<?= htmlspecialchars($group['farmer_gr_id']) ?>">
                                                    <?= htmlspecialchars($group['name']) ?> (<?= htmlspecialchars($group['farmer_gr_id']) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select><span class="text-red-500">*</span></label>
                                    </div>
                                    <div class="mb-4">
                                        <label for="periode" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kejadian<span class="text-red-500">*</span></label>
                                        <input type="date" id="periode" name="periode" class="w-full px-3 py-2 border border-gray-3<span class=" text-red-500">*</span></label>d-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah_korban" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Korban<span class="text-red-500">*</span></label>
                                        <input type="number" id="jumlah_korban" name="jumlah_korban" min="1" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="lokasi_utama" class="block text-sm font-medium text-gray-700 mb-1"><span class="text-red-500">*</span></label>ama<span class="text-red-500">*</span></label>
                                        <input type="text" id="lokasi_utama" name="lokasi_utama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Blok Perkebunan A5" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kategori_utama" class="block text-sm font-medium text-gray-700 mb-1">Kategori Utama<span class="text-red-500">*</span></label>
                                        <select id="kategori_utama" name="kategori_utama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($dummyKategori as $kategori): ?>
                                                <option value="<?= htmlspecialchars($kategori) ?>"><?= htmlspecialchars($kategori) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tindakan" class="block text-sm font-medium text-gray-700 mb-1">Tindakan<span class="text-red-500">*</span></label>
                                        <select id="tindakan" name="tindakan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Tindakan</option>
                                            <?php foreach ($dummyTindakan as $tindakan): ?>
                                                <option value="<?= htmlspecialchars($tindakan) ?>"><?= htmlspecialchars($tindakan) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Tindakan Pencegahan</h3>
                                <div class="mb-4">
                                    <textarea id="pencegahan" name="pencegahan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Deskripsi tindakan pencegahan yang akan dilakukan" required></textarea>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6"><span class="text-red-500">*</span></label>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Korban</h3>
                                <div id="victim-details-container">
                                    <!-- Template (hidden) -->
                                    <div id="victim-template" class="victim-entry mb-6 p-4 border border-dashed border-gray-300 rounded-lg hidden">
                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-medium text-gray-800">Korban <span class="victim-number">1</span></h4>
                                            <button type="button" class="remove-victim-btn text-sm text-red-600 hover:text-red-800 flex items-center">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="type_user_1" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna<span class="text-red-500">*</span></label>
                                                <select id="type_user_1" name="type_user[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                    <option value="">Pilih Tipe</option><span class="text-red-500">*</span></label>
                                                    <option value="petani">Petani</option>
                                                    <option value="karyawan">Karyawan</option>
                                                    <option value="konsultan">Konsultan</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select><span class="text-red-500">*</span></label>
                                            </div>
                                            <div>
                                                <label for="user_id_1" class="block text-sm font-medium text-gray-700 mb-1">ID Pengguna</label>
                                                <input type="text" id="user_id_1" name="user_id[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="ID Petani/Karyawan">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_1" class="block text-sm font-medium text-gray-700 mb-1">Nama Korban<span class="text-red-500">*</span></label>
                                            <input type="text" id="nama_1" name="nama[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Nama lengkap korban" required>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="lokasi_kejadian_1" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Spesifik<span class="text-red-500">*</span></label>
                                                <input type="text" id="lokasi_kejadian_1" name="lokasi_kejadian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Lokasi tepat kejadian" required>
                                            </div>
                                            <div>
                                                <label for="kategori_1" class="block text-sm font-medium text-gray-700 mb-1">Kategori<span class="text-red-500">*</span></label>
                                                <select id="kategori_1" name="kategori[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                    <option value="">Pilih Kategori</option>
                                                    <?php foreach ($dummyKategori as $kategori): ?>
                                                        <option value="<?= htmlspecialchars($kategori) ?>"><?= htmlspecialchars($kategori) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="kerugian_1" class="block text-sm font-medium text-gray-700 mb-1">Kerugian/Dampak<span class="text-red-500">*</span></label>
                                                <input type="text" id="kerugian_1" name="kerugian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Deskripsi kerugian/cedera" required>
                                            </div>
                                            <div>
                                                <label for="keterangan_1" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                                                <textarea id="keterangan_1" name="keterangan[]" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Catatan tambahan..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- First visible victim entry -->
                                    <div class="victim-entry mb-6 p-4 border border-gray-200 rounded-lg">
                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-medium text-gray-800">Korban 1</h4>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="type_user_0" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna<span class="text-red-500">*</span></label>
                                                <select id="type_user_0" name="type_user[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                    <option value="">Pilih Tipe</option>
                                                    <option value="petani">Petani</option>
                                                    <option value="karyawan">Karyawan</option>
                                                    <option value="konsultan">Konsultan</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="user_id_0" class="block text-sm font-medium text-gray-700 mb-1">ID Pengguna</label>
                                                <input type="text" id="user_id_0" name="user_id[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="ID Petani/Karyawan">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_0" class="block text-sm font-medium text-gray-700 mb-1">Nama Korban<span class="text-red-500">*</span></label>
                                            <input type="text" id="nama_0" name="nama[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Nama lengkap korban" required>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="lokasi_kejadian_0" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Spesifik<span class="text-red-500">*</span></label>
                                                <input type="text" id="lokasi_kejadian_0" name="lokasi_kejadian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Lokasi tepat kejadian" required>
                                            </div>
                                            <div>
                                                <label for="kategori_0" class="block text-sm font-medium text-gray-700 mb-1">Kategori<span class="text-red-500">*</span></label>
                                                <select id="kategori_0" name="kategori[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                    <option value="">Pilih Kategori</option>
                                                    <?php foreach ($dummyKategori as $kategori): ?>
                                                        <option value="<?= htmlspecialchars($kategori) ?>"><?= htmlspecialchars($kategori) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="kerugian_0" class="block text-sm font-medium text-gray-700 mb-1">Kerugian/Dampak<span class="text-red-500">*</span></label>
                                                <input type="text" id="kerugian_0" name="kerugian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Deskripsi kerugian/cedera" required>
                                            </div>
                                            <div>
                                                <label for="keterangan_0" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                                                <textarea id="keterangan_0" name="keterangan[]" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Catatan tambahan..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-victim-btn" class="mt-2 text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Korban Lain
                                </button>
                            </div>

                            <div class="mt-8 flex justify-end space-x-4">
                                <button type="button" onclick="window.location.href='?mode=list'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                    Simpan Data K3
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php elseif ($mode === 'view' && isset($incident)): ?>
                <!-- Halaman Detail K3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Data K3 - <?= htmlspecialchars($incident['kategori_utama']) ?></h2>
                                <p class="text-gray-600">ID Kejadian: K3-<?= str_pad($incident['kcl_kerja_id'], 3, '0', STR_PAD_LEFT) ?></p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <?= $incident['jumlah_korban'] ?> Korban
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Dasar</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Grup Petani:</span>
                                        <p class="text-sm font-medium"><?= htmlspecialchars($incident['farmer_gr_id']) ?></p>
                                        <p class="text-xs text-gray-500"><?= htmlspecialchars($groupNames[$incident['farmer_gr_id']] ?? '') ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Tanggal Kejadian:</span>
                                        <p class="text-sm font-medium"><?= date('d F Y', strtotime($incident['periode'])) ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Lokasi Utama:</span>
                                        <p class="text-sm font-medium"><?= htmlspecialchars($incident['lokasi_utama']) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Kejadian</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Kategori Utama:</span>
                                        <p class="text-sm font-medium"><?= htmlspecialchars($incident['kategori_utama']) ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Tindakan:</span>
                                        <p class="text-sm font-medium"><?= htmlspecialchars($incident['tindakan']) ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Tindakan Pencegahan:</span>
                                        <p class="text-sm font-medium"><?= nl2br(htmlspecialchars($incident['pencegahan'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg mb-8">
                            <h3 class="font-medium text-gray-900 mb-4">Detail Korban (<?= $incident['jumlah_korban'] ?>)</h3>
                            <div class="space-y-4">
                                <?php foreach ($incident['korban'] as $index => $korban): ?>
                                    <div class="p-4 border border-gray-200 rounded-lg">
                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-medium text-gray-800">Korban <?= $index + 1 ?></h4>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <span class="text-sm text-gray-500">Tipe Pengguna:</span>
                                                <p class="text-sm font-medium"><?= ucfirst(htmlspecialchars($korban['type_user'])) ?></p>
                                            </div>
                                            <div>
                                                <span class="text-sm text-gray-500">ID Pengguna:</span>
                                                <p class="text-sm font-medium"><?= !empty($korban['user_id']) ? htmlspecialchars($korban['user_id']) : '-' ?></p>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-sm text-gray-500">Nama Korban:</span>
                                            <p class="text-sm font-medium"><?= htmlspecialchars($korban['nama']) ?></p>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <span class="text-sm text-gray-500">Lokasi Spesifik:</span>
                                                <p class="text-sm font-medium"><?= htmlspecialchars($korban['lokasi_kejadian']) ?></p>
                                            </div>
                                            <div>
                                                <span class="text-sm text-gray-500">Kategori:</span>
                                                <p class="text-sm font-medium"><?= htmlspecialchars($korban['kategori']) ?></p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <span class="text-sm text-gray-500">Kerugian/Dampak:</span>
                                                <p class="text-sm font-medium"><?= htmlspecialchars($korban['kerugian']) ?></p>
                                            </div>
                                            <div>
                                                <span class="text-sm text-gray-500">Keterangan:</span>
                                                <p class="text-sm font-medium"><?= !empty($korban['keterangan']) ? nl2br(htmlspecialchars($korban['keterangan'])) : '-' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif ($mode === 'edit' && isset($incident)): ?>
                <!-- Form Edit K3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data K3</h2>
                        <form method="post">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="kcl_kerja_id" value="<?= $incident['kcl_kerja_id'] ?>">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="edit_farmer_gr_id" class="block text-sm font-medium text-gray-700 mb-1">Grup Petani<span class="text-red-500">*</span></label>
                                        <select id="edit_farmer_gr_id" name="farmer_gr_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Grup Petani</option>
                                            <?php foreach ($dummyGroups as $group): ?>
                                                <option value="<?= htmlspecialchars($group['farmer_gr_id']) ?>" <?= $incident['farmer_gr_id'] === $group['farmer_gr_id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($group['name']) ?> (<?= htmlspecialchars($group['farmer_gr_id']) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_periode" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kejadian<span class="text-red-500">*</span></label>
                                        <input type="date" id="edit_periode" name="periode" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= htmlspecialchars($incident['periode']) ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_jumlah_korban" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Korban<span class="text-red-500">*</span></label>
                                        <input type="number" id="edit_jumlah_korban" name="jumlah_korban" min="1" value="<?= $incident['jumlah_korban'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="edit_lokasi_utama" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Utama<span class="text-red-500">*</span></label>
                                        <input type="text" id="edit_lokasi_utama" name="lokasi_utama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= htmlspecialchars($incident['lokasi_utama']) ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_kategori_utama" class="block text-sm font-medium text-gray-700 mb-1">Kategori Utama<span class="text-red-500">*</span></label>
                                        <select id="edit_kategori_utama" name="kategori_utama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($dummyKategori as $kategori): ?>
                                                <option value="<?= htmlspecialchars($kategori) ?>" <?= $incident['kategori_utama'] === $kategori ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($kategori) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit_tindakan" class="block text-sm font-medium text-gray-700 mb-1">Tindakan<span class="text-red-500">*</span></label>
                                        <select id="edit_tindakan" name="tindakan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Tindakan</option>
                                            <?php foreach ($dummyTindakan as $tindakan): ?>
                                                <option value="<?= htmlspecialchars($tindakan) ?>" <?= $incident['tindakan'] === $tindakan ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($tindakan) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Tindakan Pencegahan</h3>
                                <div class="mb-4">
                                    <textarea id="edit_pencegahan" name="pencegahan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required><?= htmlspecialchars($incident['pencegahan']) ?></textarea>
                                </div>
                            </div>

                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Korban</h3>
                                <div id="edit-victim-details-container">
                                    <!-- Template (hidden) -->
                                    <div id="edit-victim-template" class="victim-entry mb-6 p-4 border border-dashed border-gray-300 rounded-lg hidden">
                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-medium text-gray-800">Korban <span class="victim-number">1</span></h4>
                                            <button type="button" class="remove-victim-btn text-sm text-red-600 hover:text-red-800 flex items-center">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="edit_type_user_1" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna<span class="text-red-500">*</span></label>
                                                <select id="edit_type_user_1" name="type_user[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                    <option value="">Pilih Tipe</option>
                                                    <option value="petani">Petani</option>
                                                    <option value="karyawan">Karyawan</option>
                                                    <option value="konsultan">Konsultan</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="edit_user_id_1" class="block text-sm font-medium text-gray-700 mb-1">ID Pengguna</label>
                                                <input type="text" id="edit_user_id_1" name="user_id[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="ID Petani/Karyawan">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_nama_1" class="block text-sm font-medium text-gray-700 mb-1">Nama Korban<span class="text-red-500">*</span></label>
                                            <input type="text" id="edit_nama_1" name="nama[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Nama lengkap korban" required>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="edit_lokasi_kejadian_1" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Spesifik<span class="text-red-500">*</span></label>
                                                <input type="text" id="edit_lokasi_kejadian_1" name="lokasi_kejadian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Lokasi tepat kejadian" required>
                                            </div>
                                            <div>
                                                <label for="edit_kategori_1" class="block text-sm font-medium text-gray-700 mb-1">Kategori<span class="text-red-500">*</span></label>
                                                <select id="edit_kategori_1" name="kategori[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                    <option value="">Pilih Kategori</option>
                                                    <?php foreach ($dummyKategori as $kategori): ?>
                                                        <option value="<?= htmlspecialchars($kategori) ?>"><?= htmlspecialchars($kategori) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div>
                                                <label for="edit_kerugian_1" class="block text-sm font-medium text-gray-700 mb-1">Kerugian/Dampak<span class="text-red-500">*</span></label>
                                                <input type="text" id="edit_kerugian_1" name="kerugian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Deskripsi kerugian/cedera" required>
                                            </div>
                                            <div>
                                                <label for="edit_keterangan_1" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                                                <textarea id="edit_keterangan_1" name="keterangan[]" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Catatan tambahan..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Existing victims -->
                                    <?php foreach ($incident['korban'] as $index => $korban): ?>
                                        <div class="victim-entry mb-6 p-4 border border-gray-200 rounded-lg">
                                            <div class="flex justify-between items-center mb-3">
                                                <h4 class="font-medium text-gray-800">Korban <?= $index + 1 ?></h4>
                                                <button type="button" class="remove-victim-btn text-sm text-red-600 hover:text-red-800 flex items-center">
                                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                </button>
                                            </div>
                                            <input type="hidden" name="korban_id[]" value="<?= $korban['kcl_kerja_korban_id'] ?>">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                                <div>
                                                    <label for="edit_type_user_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna<span class="text-red-500">*</span></label>
                                                    <select id="edit_type_user_<?= $index ?>" name="type_user[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                        <option value="">Pilih Tipe</option>
                                                        <option value="petani" <?= $korban['type_user'] === 'petani' ? 'selected' : '' ?>>Petani</option>
                                                        <option value="karyawan" <?= $korban['type_user'] === 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                                                        <option value="konsultan" <?= $korban['type_user'] === 'konsultan' ? 'selected' : '' ?>>Konsultan</option>
                                                        <option value="lainnya" <?= $korban['type_user'] === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="edit_user_id_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">ID Pengguna</label>
                                                    <input type="text" id="edit_user_id_<?= $index ?>" name="user_id[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= htmlspecialchars($korban['user_id']) ?>" placeholder="ID Petani/Karyawan">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_nama_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">Nama Korban<span class="text-red-500">*</span></label>
                                                <input type="text" id="edit_nama_<?= $index ?>" name="nama[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= htmlspecialchars($korban['nama']) ?>" required>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                                <div>
                                                    <label for="edit_lokasi_kejadian_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">Lokasi Spesifik<span class="text-red-500">*</span></label>
                                                    <input type="text" id="edit_lokasi_kejadian_<?= $index ?>" name="lokasi_kejadian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= htmlspecialchars($korban['lokasi_kejadian']) ?>" required>
                                                </div>
                                                <div>
                                                    <label for="edit_kategori_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">Kategori<span class="text-red-500">*</span></label>
                                                    <select id="edit_kategori_<?= $index ?>" name="kategori[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                                        <option value="">Pilih Kategori</option>
                                                        <?php foreach ($dummyKategori as $kategori): ?>
                                                            <option value="<?= htmlspecialchars($kategori) ?>" <?= $korban['kategori'] === $kategori ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($kategori) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                                <div>
                                                    <label for="edit_kerugian_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">Kerugian/Dampak<span class="text-red-500">*</span></label>
                                                    <input type="text" id="edit_kerugian_<?= $index ?>" name="kerugian[]" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= htmlspecialchars($korban['kerugian']) ?>" required>
                                                </div>
                                                <div>
                                                    <label for="edit_keterangan_<?= $index ?>" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan</label>
                                                    <textarea id="edit_keterangan_<?= $index ?>" name="keterangan[]" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg"><?= htmlspecialchars($korban['keterangan']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" id="edit-add-victim-btn" class="mt-2 text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Korban Lain
                                </button>
                            </div>

                            <div class="mt-8 flex justify-end space-x-4">
                                <button type="button" onclick="window.location.href='?mode=view&id=<?= $incident['kcl_kerja_id'] ?>'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
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
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Data K3 (Keselamatan dan Kesehatan Kerja)</h2>
                        <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script>
        // Function to add victim entry
        function addVictimEntry(container, template, count, data = null) {
            count++;
            const newEntry = template.cloneNode(true);
            newEntry.id = '';
            newEntry.classList.remove('hidden');

            // Update all IDs and labels
            newEntry.querySelectorAll('[id]').forEach(el => {
                const oldId = el.id;
                const newId = oldId.replace(/_(\d+)$/, `_${count-1}`);
                el.id = newId;

                // Update corresponding label
                const label = newEntry.querySelector(`label[for="${oldId}"]`);
                if (label) label.htmlFor = newId;
            });

            // Update victim number display
            newEntry.querySelector('.victim-number').textContent = count;

            // Pre-fill data if provided
            if (data) {
                newEntry.querySelector(`[name="type_user[]"]`).value = data.type_user || '';
                newEntry.querySelector(`[name="user_id[]"]`).value = data.user_id || '';
                newEntry.querySelector(`[name="nama[]"]`).value = data.nama || '';
                newEntry.querySelector(`[name="lokasi_kejadian[]"]`).value = data.lokasi_kejadian || '';
                newEntry.querySelector(`[name="kategori[]"]`).value = data.kategori || '';
                newEntry.querySelector(`[name="kerugian[]"]`).value = data.kerugian || '';
                newEntry.querySelector(`[name="keterangan[]"]`).value = data.keterangan || '';

                // Add hidden ID field if exists
                if (data.kcl_kerja_korban_id) {
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'korban_id[]';
                    idInput.value = data.kcl_kerja_korban_id;
                    newEntry.prepend(idInput);
                }
            }

            // Add remove button functionality
            const removeBtn = newEntry.querySelector('.remove-victim-btn');
            removeBtn.addEventListener('click', function() {
                if (container.querySelectorAll('.victim-entry:not(.hidden)').length > 1) {
                    container.removeChild(newEntry);
                    updateVictimNumbers(container);
                } else {
                    alert('Minimal harus ada satu korban.');
                }
            });

            container.appendChild(newEntry);
            return count;
        }

        // Update victim numbers in titles
        function updateVictimNumbers(container) {
            container.querySelectorAll('.victim-entry:not(.hidden)').forEach((entry, index) => {
                entry.querySelector('.victim-number').textContent = index + 1;
            });
        }

        // Initialize add buttons
        document.addEventListener('DOMContentLoaded', function() {
            // Add victim button for add form
            document.getElementById('add-victim-btn')?.addEventListener('click', function() {
                const container = document.getElementById('victim-details-container');
                const template = document.getElementById('victim-template');
                const currentCount = container.querySelectorAll('.victim-entry:not(.hidden)').length;
                addVictimEntry(container, template, currentCount);
            });

            // Add victim button for edit form
            document.getElementById('edit-add-victim-btn')?.addEventListener('click', function() {
                const container = document.getElementById('edit-victim-details-container');
                const template = document.getElementById('edit-victim-template');
                const currentCount = container.querySelectorAll('.victim-entry:not(.hidden)').length;
                addVictimEntry(container, template, currentCount);
            });

            // Initialize existing remove buttons
            document.querySelectorAll('.remove-victim-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const container = this.closest('.victim-container') ||
                        this.closest('fieldset').querySelector('.victim-details-container') ||
                        this.closest('fieldset').querySelector('#edit-victim-details-container');

                    if (container.querySelectorAll('.victim-entry:not(.hidden)').length > 1) {
                        this.closest('.victim-entry').remove();
                        updateVictimNumbers(container);
                    } else {
                        alert('Minimal harus ada satu korban.');
                    }
                });
            });

            // Dynamic victim count update based on jumlah_korban
            document.getElementById('jumlah_korban')?.addEventListener('change', function() {
                const container = document.getElementById('victim-details-container');
                const template = document.getElementById('victim-template');
                const currentCount = container.querySelectorAll('.victim-entry:not(.hidden)').length;
                const desiredCount = parseInt(this.value) || 1;

                if (desiredCount > currentCount) {
                    let count = currentCount;
                    while (count < desiredCount) {
                        count = addVictimEntry(container, template, count);
                    }
                } else if (desiredCount < currentCount) {
                    const entries = container.querySelectorAll('.victim-entry:not(.hidden)');
                    for (let i = entries.length - 1; i >= desiredCount; i--) {
                        if (entries.length > 1) {
                            container.removeChild(entries[i]);
                        }
                    }
                    updateVictimNumbers(container);
                }
            });

            document.getElementById('edit_jumlah_korban')?.addEventListener('change', function() {
                const container = document.getElementById('edit-victim-details-container');
                const template = document.getElementById('edit-victim-template');
                const currentCount = container.querySelectorAll('.victim-entry:not(.hidden)').length;
                const desiredCount = parseInt(this.value) || 1;

                if (desiredCount > currentCount) {
                    let count = currentCount;
                    while (count < desiredCount) {
                        count = addVictimEntry(container, template, count);
                    }
                } else if (desiredCount < currentCount) {
                    const entries = container.querySelectorAll('.victim-entry:not(.hidden)');
                    for (let i = entries.length - 1; i >= desiredCount; i--) {
                        if (entries.length > 1) {
                            container.removeChild(entries[i]);
                        }
                    }
                    updateVictimNumbers(container);
                }
            });
        });
    </script>

    <?php include 'footer.php'; ?>