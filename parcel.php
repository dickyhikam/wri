<?php

session_unset();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize parcels data in session if not exists
if (!isset($_SESSION['parcels'])) {
    $_SESSION['parcels'] = [
        'ID084d862d5' => [
            //petani
            'nama_petani' => 'Petani 1',
            'nik' => '1408060907930001',
            'npwp' => 'Tidak Ada',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Berumbung Baru',
            'tanggal_lahir' => '1973-09-07',
            'alamat_domisili' => 'Alamat lengkap sesuai KTP',
            'parcel_id' => 'ID084d862d5',
            'id_lahan' => '14.08.06.2006.KMJ.0001',
            'provinsi' => 'Riau',
            'kabupaten' => 'Siak',
            'kecamatan' => 'Dayun',
            'desa' => 'Berumbung Baru',
            'kategori_kebun' => 'Kebun',
            'jenis_tanah' => 'Mineral',
            'status_pengelola' => 'Pemilik',
            'kelompok_tani' => 'Kelompok Tani',
            'tanggal_masuk' => '2024-02-05',
            'tahun_tanam' => 1986,
            'jml_pohon' => 260,
            'pola_tanam' => 'Monokultur',
            'luas_lahan' => 2.04,
            'status_lahan' => 'APL',
            'coordinates' => '101.111111,0.222222;101.111100,0.222200',
            'rspo' => 'Ya',
            'bl_timur_jenis' => 'Kebun Tetangga',
            'bl_barat_jenis' => 'Lahan Kosong',
            'bl_utara_jenis' => 'Jalan Desa',
            'bl_selatan_jenis' => 'Sungai Kecil',
            'created_at' => '2024-02-05 10:00:00',
            'updated_at' => '2024-02-05 10:00:00',
            'status' => 'Registered'
        ],
        'ID114da4c49' => [
            'parcel_id' => 'ID114da4c49',
            'rspo' => 'Tidak',
            'nama_petani' => 'Petani 2',
            'nik' => '1408060907930002',
            'npwp' => '123456789012345',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Berumbung Baru',
            'tanggal_lahir' => '1980-05-15',
            'alamat_domisili' => 'Alamat lengkap sesuai KTP',
            'id_lahan' => '14.08.06.2006.KMJ.0002',
            'provinsi' => 'Riau',
            'kabupaten' => 'Siak',
            'kecamatan' => 'Dayun',
            'desa' => 'Berumbung Baru',
            'kategori_kebun' => 'Kebun',
            'jenis_tanah' => 'Mineral',
            'status_pengelola' => 'Pemilik',
            'kelompok_tani' => 'Kelompok Tani',
            'tanggal_masuk' => '2024-02-10',
            'tahun_tanam' => 1985,
            'jml_pohon' => 57,
            'pola_tanam' => 'Monokultur',
            'luas_lahan' => 1.13,
            'status_lahan' => 'APL',
            'coordinates' => '101.222222,0.333333;101.222200,0.333300',
            'bl_timur_jenis' => 'Kebun Tetangga',
            'bl_barat_jenis' => 'Lahan Kosong',
            'bl_utara_jenis' => 'Jalan Desa',
            'bl_selatan_jenis' => 'Sungai Kecil',
            'created_at' => '2024-02-10 11:00:00',
            'updated_at' => '2024-02-10 11:00:00',
            'status' => 'UnRegistered'
        ]
    ];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        $parcel_id = $_POST['parcel_id'] ?? 'ID' . uniqid();

        $_SESSION['parcels'][$parcel_id] = [
            'parcel_id' => $parcel_id,
            'rspo' => $_POST['rspo'] ?? 'Tidak',
            'nama_petani' => $_POST['nama_petani'] ?? '',
            'nik' => $_POST['nik'] ?? '',
            'npwp' => $_POST['npwp'] ?? 'Tidak Ada',
            'jenis_kelamin' => $_POST['jenis_kelamin'] ?? 'L',
            'tempat_lahir' => $_POST['tempat_lahir'] ?? '',
            'tanggal_lahir' => $_POST['tanggal_lahir'] ?? '',
            'alamat_domisili' => $_POST['alamat_domisili'] ?? '',
            'id_lahan' => $_POST['id_lahan'] ?? '',
            'provinsi' => $_POST['provinsi'] ?? 'Riau',
            'kabupaten' => $_POST['kabupaten'] ?? 'Siak',
            'kecamatan' => $_POST['kecamatan'] ?? 'Dayun',
            'desa' => $_POST['desa'] ?? 'Berumbung Baru',
            'kategori_kebun' => $_POST['kategori_kebun'] ?? 'Kebun',
            'jenis_tanah' => $_POST['jenis_tanah'] ?? 'Mineral',
            'status_pengelola' => $_POST['status_pengelola'] ?? 'Pemilik',
            'kelompok_tani' => $_POST['kelompok_tani'] ?? 'Kelompok Tani',
            'tanggal_masuk' => $_POST['tanggal_masuk'] ?? date('Y-m-d'),
            'tahun_tanam' => $_POST['tahun_tanam'] ?? date('Y'),
            'jml_pohon' => $_POST['jml_pohon'] ?? 0,
            'pola_tanam' => $_POST['pola_tanam'] ?? 'Monokultur',
            'luas_lahan' => $_POST['luas_lahan'] ?? 0,
            'status_lahan' => $_POST['status_lahan'] ?? 'APL',
            'coordinates' => $_POST['coordinates'] ?? '',
            'bl_timur_jenis' => $_POST['bl_timur_jenis'] ?? '',
            'bl_barat_jenis' => $_POST['bl_barat_jenis'] ?? '',
            'bl_utara_jenis' => $_POST['bl_utara_jenis'] ?? '',
            'bl_selatan_jenis' => $_POST['bl_selatan_jenis'] ?? '',
            'created_at' => $_POST['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        header('Location: parcel?action=view&id=' . $parcel_id);
        exit;
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        if (isset($_SESSION['parcels'][$id])) {
            unset($_SESSION['parcels'][$id]);
        }
        header('Location: parcel');
        exit;
    }
}

// Get current action and ID
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$current_parcel = $id ? ($_SESSION['parcels'][$id] ?? null) : null;

// Get unique values for filters
$kecamatans = array_unique(array_column($_SESSION['parcels'], 'kecamatan'));
$kabupatens = array_unique(array_column($_SESSION['parcels'], 'kabupaten'));
$statuses = array_unique(array_column($_SESSION['parcels'], 'status'));
$rspo_status = array_unique(array_column($_SESSION['parcels'], 'rspo'));

// Apply filters
$filtered_parcels = $_SESSION['parcels'];
$filter_kecamatan = $_GET['filter_kecamatan'] ?? '';
$filter_kabupaten = $_GET['filter_kabupaten'] ?? '';
$filter_status = $_GET['filter_status'] ?? '';
$filter_rspo = $_GET['filter_rspo'] ?? '';
$search = $_GET['search'] ?? '';

if ($filter_kecamatan) {
    $filtered_parcels = array_filter($filtered_parcels, fn($p) => $p['kecamatan'] === $filter_kecamatan);
}
if ($filter_kabupaten) {
    $filtered_parcels = array_filter($filtered_parcels, fn($p) => $p['kabupaten'] === $filter_kabupaten);
}
if ($filter_status) {
    $filtered_parcels = array_filter($filtered_parcels, fn($p) => $p['status'] === $filter_status);
}
if ($filter_rspo) {
    $filtered_parcels = array_filter($filtered_parcels, fn($p) => $p['rspo'] === $filter_rspo);
}
if ($search) {
    $search = strtolower($search);
    $filtered_parcels = array_filter($filtered_parcels, function ($p) use ($search) {
        return strpos(strtolower($p['nama_petani']), $search) !== false ||
            strpos(strtolower($p['id_lahan']), $search) !== false ||
            strpos(strtolower($p['desa']), $search) !== false;
    });
}

// Pagination
$itemsPerPage = 5;
$currentPage = max(1, intval($_GET['page'] ?? 1));
$totalItems = count($filtered_parcels);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = min($currentPage, $totalPages);
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedParcels = array_slice($filtered_parcels, $startIndex, $itemsPerPage, true);
?>

<?php include 'header.php'; ?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php if ($action === 'list'): ?>
                    Manajemen Data Parcel
                <?php elseif ($action === 'add'): ?>
                    Tambah Parcel Baru
                <?php elseif ($action === 'view'): ?>
                    Detail Parcel
                <?php elseif ($action === 'edit'): ?>
                    Edit Data Parcel
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action === 'list'): ?>
                <button id="addParcelBtn" onclick="openParcelModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-file-import mr-2"></i> Import Data
                </button>
            <?php elseif ($action === 'view'): ?>
                <a href="parcel?action=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="parcel?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="openVerifParcelModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-check-circle mr-2"></i> Verifikasi
                </button>
            <?php elseif ($action === 'edit' || $action === 'add'): ?>
                <a href="parcel?action=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action === 'list'): ?>
            <!-- List Page -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="space-y-4">
                        <input type="hidden" name="action" value="list">
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" id="search" name="search" value="<?= htmlspecialchars($search) ?>"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Cari data parcel...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- RSPO Filter -->
                            <div>
                                <select id="filter_rspo" name="filter_rspo" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua RSPO</option>
                                    <?php foreach ($rspo_status as $rspo): ?>
                                        <option value="<?= htmlspecialchars($rspo) ?>" <?= $filter_rspo === $rspo ? 'selected' : '' ?>><?= htmlspecialchars($rspo) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Kecamatan Filter -->
                            <div>
                                <select id="filter_kecamatan" name="filter_kecamatan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kecamatan</option>
                                    <?php foreach ($kecamatans as $kecamatan): ?>
                                        <option value="<?= htmlspecialchars($kecamatan) ?>" <?= $filter_kecamatan === $kecamatan ? 'selected' : '' ?>><?= htmlspecialchars($kecamatan) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Kabupaten Filter -->
                            <div>
                                <select id="filter_kabupaten" name="filter_kabupaten" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kabupaten</option>
                                    <?php foreach ($kabupatens as $kabupaten): ?>
                                        <option value="<?= htmlspecialchars($kabupaten) ?>" <?= $filter_kabupaten === $kabupaten ? 'selected' : '' ?>><?= htmlspecialchars($kabupaten) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Status Filter -->
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
                        <div class="col-span-4">
                            <label class="text-sm font-medium text-gray-600 mb-1 block">Pilih Kolom Yang Ditampilkan</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="no" checked>
                                    <span class="ml-2">No</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="parcelId" checked>
                                    <span class="ml-2">Parcel ID</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="rspo" checked>
                                    <span class="ml-2">RSPO</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="namaPetani" checked>
                                    <span class="ml-2">Nama Petani</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="idLahan" checked>
                                    <span class="ml-2">ID Lahan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="kecamatan" checked>
                                    <span class="ml-2">Kecamatan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="luasHa" checked>
                                    <span class="ml-2">Luas (Ha)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="status" checked>
                                    <span class="ml-2">Status</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="columnCheckbox" data-column="aksi" checked>
                                    <span class="ml-2">Aksi</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parcel ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RSPO</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Lahan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (Ha)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($paginatedParcels)): ?>
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data parcel</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedParcels as $id_parcel => $parcel):
                                    $rowNumber = $startIndex + array_search($id_parcel, array_keys($filtered_parcels)) + 1;
                                ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $parcel['parcel_id'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 <?= $parcel['rspo'] == 'Ya' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> rounded-full text-xs">
                                                <?= $parcel['rspo'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $parcel['nama_petani'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $parcel['id_lahan'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $parcel['kecamatan'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $parcel['luas_lahan'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $parcel['status'] == 'Registered' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $parcel['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="parcel?action=view&id=<?= $id_parcel ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
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
        <?php elseif ($action === 'add'): ?>
            <!-- Add Form -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Parcel Baru</h2>
                    <form method="post">
                        <input type="hidden" name="save" value="1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="parcel_id" class="block text-sm font-medium text-gray-700 mb-1">Parcel ID<span class="text-red-500">*</span></label>
                                    <input type="text" id="parcel_id" name="parcel_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: ID084d862d5" required>
                                </div>
                                <div class="mb-4">
                                    <label for="rspo" class="block text-sm font-medium text-gray-700 mb-1">Daftar RSPO<span class="text-red-500">*</span></label>
                                    <select id="rspo" name="rspo" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="nama_petani" class="block text-sm font-medium text-gray-700 mb-1">Nama Petani<span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_petani" name="nama_petani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Petani 1" required>
                                </div>
                                <div class="mb-4">
                                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK<span class="text-red-500">*</span></label>
                                    <input type="text" id="nik" name="nik" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 1408060907930001" required>
                                </div>
                                <div class="mb-4">
                                    <label for="npwp" class="block text-sm font-medium text-gray-700 mb-1">No. NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 123456789012345">
                                </div>
                                <div class="mb-4">
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin<span class="text-red-500">*</span></label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir<span class="text-red-500">*</span></label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Berumbung Baru" required>
                                </div>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir<span class="text-red-500">*</span></label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label for="alamat_domisili" class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili<span class="text-red-500">*</span></label>
                                    <textarea id="alamat_domisili" name="alamat_domisili" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="id_lahan" class="block text-sm font-medium text-gray-700 mb-1">ID Lahan<span class="text-red-500">*</span></label>
                                    <input type="text" id="id_lahan" name="id_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 14.08.06.2006.KMJ.0001" required>
                                </div>
                                <div class="mb-4">
                                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi<span class="text-red-500">*</span></label>
                                    <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Riau" required>
                                </div>
                                <div class="mb-4">
                                    <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten<span class="text-red-500">*</span></label>
                                    <input type="text" id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Siak" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Lahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan<span class="text-red-500">*</span></label>
                                        <input type="text" id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Dayun" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan<span class="text-red-500">*</span></label>
                                        <input type="text" id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Berumbung Baru" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kategori_kebun" class="block text-sm font-medium text-gray-700 mb-1">Kategori Kebun<span class="text-red-500">*</span></label>
                                        <select id="kategori_kebun" name="kategori_kebun" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Kebun">Kebun</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah<span class="text-red-500">*</span></label>
                                        <select id="jenis_tanah" name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Mineral">Mineral</option>
                                            <option value="Gambut">Gambut</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="status_pengelola" class="block text-sm font-medium text-gray-700 mb-1">Status Pengelola<span class="text-red-500">*</span></label>
                                        <select id="status_pengelola" name="status_pengelola" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Pemilik">Pemilik</option>
                                            <option value="Penggarap">Penggarap</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kelompok_tani" class="block text-sm font-medium text-gray-700 mb-1">Kelompok Tani<span class="text-red-500">*</span></label>
                                        <input type="text" id="kelompok_tani" name="kelompok_tani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Kelompok Tani" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk Anggota<span class="text-red-500">*</span></label>
                                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tahun_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam Perdana<span class="text-red-500">*</span></label>
                                        <input type="number" id="tahun_tanam" name="tahun_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="jml_pohon" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok Tegakan Pohon<span class="text-red-500">*</span></label>
                                        <input type="number" id="jml_pohon" name="jml_pohon" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pola_tanam" class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam<span class="text-red-500">*</span></label>
                                        <select id="pola_tanam" name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Monokultur">Monokultur</option>
                                            <option value="Polikultur">Polikultur</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="luas_lahan" class="block text-sm font-medium text-gray-700 mb-1">Luas Lahan (Ha)<span class="text-red-500">*</span></label>
                                        <input type="number" step="0.01" id="luas_lahan" name="luas_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status_lahan" class="block text-sm font-medium text-gray-700 mb-1">Status Lahan<span class="text-red-500">*</span></label>
                                        <select id="status_lahan" name="status_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="APL">APL</option>
                                            <option value="HPK">HPK</option>
                                            <option value="HL">HL</option>
                                            <option value="HGU">HGU</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Batas Lahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="bl_utara_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Utara<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_utara_jenis" name="bl_utara_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jalan Desa" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="bl_selatan_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Selatan<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_selatan_jenis" name="bl_selatan_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Sungai Kecil" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="bl_barat_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Barat<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_barat_jenis" name="bl_barat_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Lahan Kosong" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="bl_timur_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Timur<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_timur_jenis" name="bl_timur_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kebun Tetangga" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="coordinates" class="block text-sm font-medium text-gray-700 mb-1">Koordinat (Format: Long,Lat;Long,Lat;...)<span class="text-red-500">*</span></label>
                                <textarea id="coordinates" name="coordinates" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 101.111111,0.222222;101.111100,0.222200" required></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="window.location.href='?action=list'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                Simpan Data Parcel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($action === 'view' && $current_parcel): ?>
            <!-- View Page -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Detail Parcel</h2>
                            <p class="text-gray-600">Parcel ID: <?= $current_parcel['parcel_id'] ?></p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?= $current_parcel['status'] == 'Registered' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                            <?= $current_parcel['status'] ?>
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Petani</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Nama Petani:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['nama_petani'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">NIK:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['nik'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">RSPO:</span>
                                    <p class="text-sm font-medium">
                                        <span class="px-2 py-1 <?= $current_parcel['rspo'] == 'Ya' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> rounded-full text-xs">
                                            <?= $current_parcel['rspo'] ?>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">NPWP:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['npwp'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Jenis Kelamin:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tempat/Tanggal Lahir:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['tempat_lahir'] ?>, <?= date('d/m/Y', strtotime($current_parcel['tanggal_lahir'])) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Alamat Domisili:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['alamat_domisili'] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Lahan</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">ID Lahan:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['id_lahan'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Lokasi:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['desa'] ?>, <?= $current_parcel['kecamatan'] ?>, <?= $current_parcel['kabupaten'] ?>, <?= $current_parcel['provinsi'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Kategori Kebun:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['kategori_kebun'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Jenis Tanah:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['jenis_tanah'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Status Pengelola:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['status_pengelola'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Kelompok Tani:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['kelompok_tani'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Masuk Anggota:</span>
                                    <p class="text-sm font-medium"><?= date('d/m/Y', strtotime($current_parcel['tanggal_masuk'])) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Tambahan</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Tahun Tanam Perdana:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['tahun_tanam'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Jumlah Pokok Tegakan Pohon:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['jml_pohon'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Pola Tanam:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['pola_tanam'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Luas Lahan (Ha):</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['luas_lahan'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Status Lahan:</span>
                                    <p class="text-sm font-medium">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                            <?= $current_parcel['status_lahan'] ?>
                                        </span>
                                    </p>
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
                                    <p class="text-sm font-medium"><?= $current_parcel['bl_utara_jenis'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Selatan:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['bl_selatan_jenis'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Barat:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['bl_barat_jenis'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Timur:</span>
                                    <p class="text-sm font-medium"><?= $current_parcel['bl_timur_jenis'] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Koordinat Lahan</h3>
                            <div id="map2" class="h-64 w-full bg-gray-200 rounded-lg flex items-center justify-center">
                                <p class="text-gray-500">Peta akan ditampilkan di sini</p>
                            </div>
                        </div>
                    </div>

                    <!-- Map placeholder -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Peta Lahan</h3>
                        <div id="map" class="h-64 w-full bg-gray-200 rounded-lg flex items-center justify-center">
                            <p class="text-gray-500">Peta akan ditampilkan di sini</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($action === 'edit' && $current_parcel): ?>
            <!-- Edit Form -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Parcel</h2>
                    <form method="post">
                        <input type="hidden" name="save" value="1">
                        <input type="hidden" name="parcel_id" value="<?= $current_parcel['parcel_id'] ?>">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="parcel_id_display" class="block text-sm font-medium text-gray-700 mb-1">Parcel ID</label>
                                    <input type="text" id="parcel_id_display" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="<?= $current_parcel['parcel_id'] ?>" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="rspo" class="block text-sm font-medium text-gray-700 mb-1">Daftar RSPO<span class="text-red-500">*</span></label>
                                    <select id="rspo" name="rspo" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="Ya" <?= $current_parcel['rspo'] == 'Ya' ? 'selected' : '' ?>>Ya</option>
                                        <option value="Tidak" <?= $current_parcel['rspo'] == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="nama_petani" class="block text-sm font-medium text-gray-700 mb-1">Nama Petani<span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_petani" name="nama_petani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['nama_petani'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK<span class="text-red-500">*</span></label>
                                    <input type="text" id="nik" name="nik" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['nik'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="npwp" class="block text-sm font-medium text-gray-700 mb-1">No. NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['npwp'] ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin<span class="text-red-500">*</span></label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="L" <?= $current_parcel['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="P" <?= $current_parcel['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir<span class="text-red-500">*</span></label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['tempat_lahir'] ?>" required>
                                </div>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir<span class="text-red-500">*</span></label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['tanggal_lahir'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="alamat_domisili" class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili<span class="text-red-500">*</span></label>
                                    <textarea id="alamat_domisili" name="alamat_domisili" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required><?= $current_parcel['alamat_domisili'] ?></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="id_lahan" class="block text-sm font-medium text-gray-700 mb-1">ID Lahan<span class="text-red-500">*</span></label>
                                    <input type="text" id="id_lahan" name="id_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['id_lahan'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi<span class="text-red-500">*</span></label>
                                    <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['provinsi'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten<span class="text-red-500">*</span></label>
                                    <input type="text" id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['kabupaten'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Lahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan<span class="text-red-500">*</span></label>
                                        <input type="text" id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['kecamatan'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan<span class="text-red-500">*</span></label>
                                        <input type="text" id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['desa'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kategori_kebun" class="block text-sm font-medium text-gray-700 mb-1">Kategori Kebun<span class="text-red-500">*</span></label>
                                        <select id="kategori_kebun" name="kategori_kebun" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Kebun" <?= $current_parcel['kategori_kebun'] == 'Kebun' ? 'selected' : '' ?>>Kebun</option>
                                            <option value="Lainnya" <?= $current_parcel['kategori_kebun'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="jenis_tanah" class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah<span class="text-red-500">*</span></label>
                                        <select id="jenis_tanah" name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Mineral" <?= $current_parcel['jenis_tanah'] == 'Mineral' ? 'selected' : '' ?>>Mineral</option>
                                            <option value="Gambut" <?= $current_parcel['jenis_tanah'] == 'Gambut' ? 'selected' : '' ?>>Gambut</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="status_pengelola" class="block text-sm font-medium text-gray-700 mb-1">Status Pengelola<span class="text-red-500">*</span></label>
                                        <select id="status_pengelola" name="status_pengelola" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Pemilik" <?= $current_parcel['status_pengelola'] == 'Pemilik' ? 'selected' : '' ?>>Pemilik</option>
                                            <option value="Penggarap" <?= $current_parcel['status_pengelola'] == 'Penggarap' ? 'selected' : '' ?>>Penggarap</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kelompok_tani" class="block text-sm font-medium text-gray-700 mb-1">Kelompok Tani<span class="text-red-500">*</span></label>
                                        <input type="text" id="kelompok_tani" name="kelompok_tani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['kelompok_tani'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk Anggota<span class="text-red-500">*</span></label>
                                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['tanggal_masuk'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tahun_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam Perdana<span class="text-red-500">*</span></label>
                                        <input type="number" id="tahun_tanam" name="tahun_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['tahun_tanam'] ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="jml_pohon" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok Tegakan Pohon<span class="text-red-500">*</span></label>
                                        <input type="number" id="jml_pohon" name="jml_pohon" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['jml_pohon'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="pola_tanam" class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam<span class="text-red-500">*</span></label>
                                        <select id="pola_tanam" name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="Monokultur" <?= $current_parcel['pola_tanam'] == 'Monokultur' ? 'selected' : '' ?>>Monokultur</option>
                                            <option value="Polikultur" <?= $current_parcel['pola_tanam'] == 'Polikultur' ? 'selected' : '' ?>>Polikultur</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="luas_lahan" class="block text-sm font-medium text-gray-700 mb-1">Luas Lahan (Ha)<span class="text-red-500">*</span></label>
                                        <input type="number" step="0.01" id="luas_lahan" name="luas_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['luas_lahan'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status_lahan" class="block text-sm font-medium text-gray-700 mb-1">Status Lahan<span class="text-red-500">*</span></label>
                                        <select id="status_lahan" name="status_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="APL" <?= $current_parcel['status_lahan'] == 'APL' ? 'selected' : '' ?>>APL</option>
                                            <option value="HPK" <?= $current_parcel['status_lahan'] == 'HPK' ? 'selected' : '' ?>>HPK</option>
                                            <option value="HL" <?= $current_parcel['status_lahan'] == 'HL' ? 'selected' : '' ?>>HL</option>
                                            <option value="HGU" <?= $current_parcel['status_lahan'] == 'HGU' ? 'selected' : '' ?>>HGU</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Batas Lahan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="bl_utara_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Utara<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_utara_jenis" name="bl_utara_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['bl_utara_jenis'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="bl_selatan_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Selatan<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_selatan_jenis" name="bl_selatan_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['bl_selatan_jenis'] ?>" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="bl_barat_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Barat<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_barat_jenis" name="bl_barat_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['bl_barat_jenis'] ?>" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="bl_timur_jenis" class="block text-sm font-medium text-gray-700 mb-1">Batas Timur<span class="text-red-500">*</span></label>
                                        <input type="text" id="bl_timur_jenis" name="bl_timur_jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $current_parcel['bl_timur_jenis'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="coordinates" class="block text-sm font-medium text-gray-700 mb-1">Koordinat (Format: Long,Lat;Long,Lat;...)<span class="text-red-500">*</span></label>
                                <textarea id="coordinates" name="coordinates" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required><?= $current_parcel['coordinates'] ?></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="window.location.href='?action=view&id=<?= $id ?>'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
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
            <!-- Default Page (If action not recognized) -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Data Parcel</h2>
                    <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<!-- Modal Tambah/Edit Parcel -->
<div id="parcelModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-file text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="parcelModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Parcel Baru</h3>
                        <div class="mt-2">
                            <form id="parcelForm">
                                <input type="hidden" id="parcelId">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="parcelName">File Excel <span class="text-red-500">*</span></label>
                                        <input type="file" id="parcelName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".xls, .xlsx" required>

                                        <!-- Informational text about required format -->
                                        <p class="mt-2 text-sm text-gray-500">
                                            Pastikan file Excel Anda memiliki format yang benar. Harap unggah file dengan ekstensi <strong>.xls</strong> atau <strong>.xlsx</strong>.
                                        </p>

                                        <!-- Optional link to example format -->
                                        <p class="mt-2 text-sm text-gray-500">
                                            <a href="https://docs.google.com/spreadsheets/d/12vEUqvh-70B7afdo1cLky6yeadhMHv31clc_mp4IIqE/edit?usp=drive_link" target="_blank" class="text-blue-500 hover:underline" download>Unduh contoh format Excel di sini</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveMillsBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm" onclick="uploadParcelData()">
                    <span id="btnParcelText">Simpan</span> <!-- Teks tombol -->
                    <svg id="loadingParcelSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                    </svg>
                </button>
                <button type="button" onclick="closeParcelModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi Parcel -->
<div id="verifModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="verifModalTitle" class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Verifikasi Data</h3>
                        <div class="mt-2">
                            <p id="verifModalContent" class="text-sm text-gray-500">
                                Apakah data tersebut sudah sesuai? Setelah Anda menekan "Verifikasi", data akan diproses menjadi Registered.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="verifyDataBtn" class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm" onclick="verifyData()">
                    <span id="btnText">Verifikasi</span> <!-- Teks tombol -->
                    <svg id="loadingSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                    </svg>
                </button>

                <button type="button" onclick="closeVerifParcelModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function openParcelModal(id = null) {
        if (id) {
            const mitra = mitraMillsData.find(m => m.id === id);
            if (mitra) {
                document.getElementById('parcelModalTitle').textContent = 'Edit Data Parcel';
                document.getElementById('parcelId').value = mitra.id;
                document.getElementById('parcelName').value = mitra.name;
                document.getElementById('parcelLocation').value = mitra.location;
                document.getElementById('parcelParentCompany').value = mitra.parent_company;
                document.getElementById('parcelCapacity').value = mitra.kapasitas;
            }
        } else {
            document.getElementById('parcelModalTitle').textContent = 'Import Data Parcel';
            document.getElementById('parcelForm').reset();
            document.getElementById('parcelId').value = '';
        }

        document.getElementById('parcelModal').classList.remove('hidden');
    }

    function closeParcelModal() {
        document.getElementById('parcelModal').classList.add('hidden');
    }

    function openVerifParcelModal(id = null) {
        if (id) {
            const mitra = mitraMillsData.find(m => m.id === id);
            if (mitra) {
                document.getElementById('parcelModalTitle').textContent = 'Edit Data Parcel';
                document.getElementById('parcelId').value = mitra.id;
                document.getElementById('parcelName').value = mitra.name;
                document.getElementById('parcelLocation').value = mitra.location;
                document.getElementById('parcelParentCompany').value = mitra.parent_company;
                document.getElementById('parcelCapacity').value = mitra.kapasitas;
            }
        } else {
            document.getElementById('parcelModalTitle').textContent = 'Konfirmasi Data Parcel';
            document.getElementById('parcelForm').reset();
            document.getElementById('parcelId').value = '';
        }

        document.getElementById('verifModal').classList.remove('hidden');
    }

    function closeVerifParcelModal() {
        document.getElementById('verifModal').classList.add('hidden');
    }

    // Initialize the first map (for the polygon)
    var map = L.map('map').setView([1.211471, 100.305291], 16); // Center map on the first coordinate and set zoom level

    // Add the OpenStreetMap layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Define the coordinates for the polygon
    var latlngs = [
        [1.211471, 100.305291],
        [1.211333, 100.306841],
        [1.210811, 100.306626],
        [1.211121, 100.305253],
        [1.211471, 100.305291] // Close the loop
    ];

    // Create a polygon using the coordinates and add it to the map
    var polygon = L.polygon(latlngs, {
        color: 'blue'
    }).addTo(map);

    // Optional: Add a popup to the polygon
    polygon.bindPopup("Area Lahan");

    // Initialize the second map (for the marker)
    var map2 = L.map('map2').setView([1.211, 100.306], 12); // Center map on the given coordinates and set zoom level
    // Add the OpenStreetMap layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map2);
    // Add a marker at the given coordinates
    var marker = L.marker([1.211, 100.306]).addTo(map2);
    // Optional: Add a popup to the marker
    marker.bindPopup("Lokasi Lahan");

    // Fungsi untuk memulai verifikasi data
    function verifyData() {
        const verifyBtn = document.getElementById("verifyDataBtn");
        const loadingSpinner = document.getElementById("loadingSpinner");
        const btnText = document.getElementById("btnText");

        // Menonaktifkan tombol dan menampilkan spinner
        verifyBtn.disabled = true; // Menonaktifkan tombol
        btnText.style.display = 'none'; // Menyembunyikan teks tombol
        loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner loading

        // Proses verifikasi (contoh: validasi file)
        setTimeout(() => {
            // Simulasi verifikasi selesai
            showSweetAlert('success', 'Verifikasi Berhasil', 'Data parcel yang dipilih sudah berhasil di verifikasi.', true, 'parcel');

            // Menyembunyikan spinner dan mengaktifkan kembali tombol
            loadingSpinner.style.display = 'none'; // Menyembunyikan spinner
            btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
            verifyBtn.disabled = false; // Mengaktifkan kembali tombol

            // Pindah halaman setelah delay
            setTimeout(() => {
                // Ganti dengan URL halaman yang sesuai
                window.location.href = 'parcel'; // Misalnya, ke halaman dashboard
            }, 2000); // Pindah halaman setelah 2 detik
        }, 3000); // Waktu tunggu simulasi (3 detik)
    }

    // Fungsi untuk memulai upload data parcel
    function uploadParcelData() {
        const parcelNameInput = document.getElementById("parcelName");
        const file = parcelNameInput.files[0];

        // Menampilkan loading spinner dan menonaktifkan tombol
        const saveBtn = document.getElementById("saveMillsBtn");
        const loadingSpinner = document.getElementById("loadingParcelSpinner");
        const btnText = document.getElementById("btnParcelText");

        if (!file) {
            showSweetAlert('error', 'Upload Gagal', 'Harap unggah file Excel terlebih dahulu.', false, '');
            return;
        }

        const allowedExtensions = /(\.xls|\.xlsx)$/i;

        // Validasi format file
        if (!allowedExtensions.exec(file.name)) {
            showSweetAlert('error', 'Format Salah', 'Harap unggah file dengan ekstensi .xls atau .xlsx', false, '');
            return;
        }

        // Validasi ukuran file (maksimal 10MB)
        if (file.size > 10 * 1024 * 1024) {
            showSweetAlert('error', 'Ukuran File Terlalu Besar', 'Ukuran file terlalu besar. Maksimal 10MB.', false, '');
            return;
        }

        // Menonaktifkan tombol dan menampilkan spinner saat proses upload
        saveBtn.disabled = true;
        btnText.style.display = 'none'; // Menyembunyikan teks tombol
        loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner

        // Simulasi upload data (misalnya dengan setTimeout)
        setTimeout(() => {
            // Proses upload selesai
            showSweetAlert('success', 'Upload Berhasil', 'Data parcel telah berhasil di-upload dan diverifikasi.', true, 'parcel');

            // Menyembunyikan spinner dan mengaktifkan kembali tombol
            loadingSpinner.style.display = 'none';
            btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
            saveBtn.disabled = false; // Mengaktifkan tombol kembali

            closeParcelModal();
        }, 3000); // Waktu simulasi upload (3 detik)
    }
</script>

<?php include 'footer.php'; ?>