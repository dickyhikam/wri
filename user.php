<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inisialisasi mode dan ID
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Data dummy pengguna
$data_pengguna = [
    'USR001' => [
        'username' => 'admin_wri',
        'email' => 'admin@wri.com',
        'full_name' => 'Admin WRI',
        'user_type' => 'Super Admin', // Role
        'ics_type' => '', // ICS (not applicable for admin)
        'phone_number' => '081234567890',
        'alamat' => 'Jl. Raya No. 1, Jakarta',
        'province_id' => '1', // Aceh
        'city_id' => '1', // Banda Aceh
        'subdistrict_id' => '1', // Kecamatan 1
        'village_id' => '1', // Kantor Pusat
        'village_name' => 'Kantor Pusat',
        'status' => 'active',
        'created_at' => '2022-01-15'
    ],
    'USR002' => [
        'username' => 'petugas1',
        'email' => 'petugas1@wri.com',
        'full_name' => 'Petugas Lapangan 1',
        'user_type' => 'Staff',
        'ics_type' => '', // ICS Type
        'phone_number' => '081234567891',
        'alamat' => 'Jl. Lapangan No. 2, Siak',
        'province_id' => '2', // Bali
        'city_id' => '1', // Denpasar
        'subdistrict_id' => '2', // Kecamatan 2
        'village_id' => '2', // Desa Makmur
        'village_name' => 'Desa Makmur',
        'status' => 'active',
        'created_at' => '2022-02-20'
    ],
    'USR003' => [
        'username' => 'petani_ahmad',
        'email' => 'ahmad@example.com',
        'full_name' => 'Ahmad Fauzi',
        'user_type' => 'Admin ICS',
        'ics_type' => 'ICS Pekan', // ICS Type
        'phone_number' => '081234567892',
        'alamat' => 'Jl. Petani No. 3, Pekan',
        'province_id' => '3', // Banten
        'city_id' => '2', // Cilegon
        'subdistrict_id' => '3', // Kecamatan 3
        'village_id' => '3', // Desa Sejahtera
        'village_name' => 'Desa Sejahtera',
        'status' => 'active',
        'created_at' => '2022-03-05'
    ],
    'USR004' => [
        'username' => 'petani_budi',
        'email' => 'budi@example.com',
        'full_name' => 'Budi Santoso',
        'user_type' => 'Admin ICS',
        'ics_type' => 'ICS Siak', // ICS Type
        'phone_number' => '081234567893',
        'alamat' => 'Jl. Kebun No. 4, Siak',
        'province_id' => '4', // Yogyakarta
        'city_id' => '1', // Yogyakarta
        'subdistrict_id' => '4', // Kecamatan 4
        'village_id' => '4', // Desa Baru
        'village_name' => 'Desa Baru',
        'status' => 'inactive',
        'created_at' => '2022-04-10'
    ]
];

// Data untuk filter
$villages = array_unique(array_column($data_pengguna, 'village_name'));
$user_types = ['admin' => 'Administrator', 'officer' => 'Petugas Lapangan', 'farmer' => 'Petani'];
$statuses = ['active' => 'Aktif', 'inactive' => 'Non-Aktif'];

// Filter data
$filtered_pengguna = $data_pengguna;
$filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : '';
$filter_village = isset($_GET['filter_village']) ? $_GET['filter_village'] : '';
$filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Aplikasikan filter
if ($filter_type) {
    $filtered_pengguna = array_filter($filtered_pengguna, function ($pengguna) use ($filter_type) {
        return $pengguna['user_type'] == $filter_type;
    });
}

if ($filter_village) {
    $filtered_pengguna = array_filter($filtered_pengguna, function ($pengguna) use ($filter_village) {
        return $pengguna['village_id'] == $filter_village;
    });
}

if ($filter_status) {
    $filtered_pengguna = array_filter($filtered_pengguna, function ($pengguna) use ($filter_status) {
        return $pengguna['status'] == $filter_status;
    });
}

if ($search) {
    $search = strtolower($search);
    $filtered_pengguna = array_filter($filtered_pengguna, function ($pengguna) use ($search) {
        return (strpos(strtolower($pengguna['username']), $search) !== false ||
            strpos(strtolower($pengguna['email']), $search) !== false ||
            strpos(strtolower($pengguna['full_name']), $search) !== false);
    });
}

// Konfigurasi pagination
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalItems = count($filtered_pengguna);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = min($currentPage, $totalPages);
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedPengguna = array_slice($filtered_pengguna, $startIndex, $itemsPerPage, true);

include 'header.php';

// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$user_id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20   shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah Pengguna Baru";
                elseif ($action == 'view') echo "Profil Pengguna: " . ($data_pengguna[$user_id] ? htmlspecialchars($data_pengguna[$user_id]['full_name']) : '');
                elseif ($action == 'edit') echo "Edit Pengguna: " . ($data_pengguna[$user_id] ? htmlspecialchars($data_pengguna[$user_id]['full_name']) : '');
                else echo "Data Pengguna";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="user?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Pengguna
                </a>
            <?php elseif ($action == 'edit'): ?>
                <a href="user?action=view&id=<?= $user_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">


        <?php if ($action == 'list'): ?>
            <!-- User Table (Shown by default) -->
            <div id="user-table-container" class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Filter Section -->
                <div class="p-4 bg-gray-50 border-b">
                    <form id="filter-form" class="space-y-4">
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" id="search-input" name="search"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Cari pengguna...">
                                <button type="button" onclick="applyFilters()" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <select id="filter-type-user" name="filter_type_user"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Tipe User</option>
                                    <option value="admin">Administrator</option>
                                    <option value="officer">Petugas Lapangan</option>
                                    <option value="farmer">Petani</option>
                                </select>
                            </div>
                            <div>
                                <select id="filter-village" name="filter_village"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Desa</option>
                                    <option value="1">Kantor Pusat</option>
                                    <option value="2">Desa Makmur</option>
                                    <option value="3">Desa Sejahtera</option>
                                    <option value="4">Desa Baru</option>
                                </select>
                            </div>
                            <div>
                                <select id="filter-status" name="filter_status"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="applyFilters()"
                                class="bg-[#2463ec] hover:bg-[#1a4bb0] text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pengguna</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe User</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Desa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="user-table-body">
                            <?php if (empty($paginatedPengguna)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data pengguna</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedPengguna as $id_pengguna => $pengguna): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $id_pengguna ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengguna['full_name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $pengguna['username'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($pengguna['ics_type'] === ''): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    WRI
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    ICS
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $pengguna['village_name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($pengguna['status'] === 'active'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="user?action=edit&id=<?= $id_pengguna ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="openStatusModal('<?= $id_pengguna ?>', '<?= $pengguna['status'] ?>')" class="text-blue-600 hover:text-blue-900 mr-3" title="Toggle Status">
                                                <i class="fas fa-sync-alt"></i>
                                            </a>
                                            <a href="#" onclick="openDeletelModal()" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
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
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

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

                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($action == 'add' || $action == 'edit'): ?>
            <!-- Form (Hidden by default) -->
            <div id="user-form" class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <form id="user-form-element">
                        <input type="hidden" id="user_id" name="user_id" value="<?= $user_id ?>">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap<span class="text-red-500">*</span></label>
                                    <input type="text" id="full_name" name="full_name" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        value="<?= $action == 'edit' ? htmlspecialchars($data_pengguna[$user_id]['full_name']) : '' ?>">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email<span class="text-red-500">*</span></label>
                                    <input type="email" id="email" name="email" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        value="<?= $action == 'edit' ? htmlspecialchars($data_pengguna[$user_id]['email']) : '' ?>">
                                </div>
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700">Username<span class="text-red-500">*</span></label>
                                    <input type="text" id="username" name="username" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        value="<?= $action == 'edit' ? htmlspecialchars($data_pengguna[$user_id]['username']) : '' ?>">
                                </div>
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700">No Telp<span class="text-red-500">*</span></label>
                                    <input type="text" id="phone_number" name="phone_number" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        value="<?= $action == 'edit' ? htmlspecialchars($data_pengguna[$user_id]['phone_number']) : '' ?>">
                                </div>
                                <div>
                                    <label for="user_type" class="block text-sm font-medium text-gray-700">Role<span class="text-red-500">*</span></label>
                                    <select id="user_type" name="user_type" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Role</option>
                                        <option value="Super Admin" <?= $action == 'edit' && $data_pengguna[$user_id]['user_type'] == 'Super Admin' ? 'selected' : '' ?>>Super Admin</option>
                                        <option value="Admin" <?= $action == 'edit' && $data_pengguna[$user_id]['user_type'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="Manager" <?= $action == 'edit' && $data_pengguna[$user_id]['user_type'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                                        <option value="Staff" <?= $action == 'edit' && $data_pengguna[$user_id]['user_type'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                                        <option value="Admin ICS" <?= $action == 'edit' && $data_pengguna[$user_id]['user_type'] == 'Admin ICS' ? 'selected' : '' ?>>Admin ICS</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="ics_type" class="block text-sm font-medium text-gray-700">ICS</label>
                                    <select id="ics_type" name="ics_type"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih ICS</option>
                                        <option value="ICS Siak" <?= $action == 'edit' && $data_pengguna[$user_id]['ics_type'] == 'ICS Siak' ? 'selected' : '' ?>>ICS Siak</option>
                                        <option value="ICS Pekan" <?= $action == 'edit' && $data_pengguna[$user_id]['ics_type'] == 'ICS Pekan' ? 'selected' : '' ?>>ICS Pekan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap<span class="text-red-500">*</span></label>
                                    <textarea id="alamat" name="alamat" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $action == 'edit' ? htmlspecialchars($data_pengguna[$user_id]['alamat']) : '' ?></textarea>
                                </div>
                                <div>
                                    <label for="province_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                                    <select id="province_id" name="province_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="1" <?= $action == 'edit' && $data_pengguna[$user_id]['province_id'] == '1' ? 'selected' : '' ?>>Aceh</option>
                                        <option value="2" <?= $action == 'edit' && $data_pengguna[$user_id]['province_id'] == '2' ? 'selected' : '' ?>>Bali</option>
                                        <option value="3" <?= $action == 'edit' && $data_pengguna[$user_id]['province_id'] == '3' ? 'selected' : '' ?>>Banten</option>
                                        <option value="4" <?= $action == 'edit' && $data_pengguna[$user_id]['province_id'] == '4' ? 'selected' : '' ?>>Yogyakarta</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="city_id" class="block text-sm font-medium text-gray-700">Kota</label>
                                    <select id="city_id" name="city_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kota</option>
                                        <option value="1" <?= $action == 'edit' && $data_pengguna[$user_id]['city_id'] == '1' ? 'selected' : '' ?>>Banda Aceh</option>
                                        <option value="2" <?= $action == 'edit' && $data_pengguna[$user_id]['city_id'] == '2' ? 'selected' : '' ?>>Denpasar</option>
                                        <option value="3" <?= $action == 'edit' && $data_pengguna[$user_id]['city_id'] == '3' ? 'selected' : '' ?>>Serang</option>
                                        <option value="4" <?= $action == 'edit' && $data_pengguna[$user_id]['city_id'] == '4' ? 'selected' : '' ?>>Yogyakarta</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="subdistrict_id" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                    <select id="subdistrict_id" name="subdistrict_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                        <option value="1" <?= $action == 'edit' && $data_pengguna[$user_id]['subdistrict_id'] == '1' ? 'selected' : '' ?>>Kecamatan 1</option>
                                        <option value="2" <?= $action == 'edit' && $data_pengguna[$user_id]['subdistrict_id'] == '2' ? 'selected' : '' ?>>Kecamatan 2</option>
                                        <option value="3" <?= $action == 'edit' && $data_pengguna[$user_id]['subdistrict_id'] == '3' ? 'selected' : '' ?>>Kecamatan 3</option>
                                        <option value="4" <?= $action == 'edit' && $data_pengguna[$user_id]['subdistrict_id'] == '4' ? 'selected' : '' ?>>Kecamatan 4</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="village_id" class="block text-sm font-medium text-gray-700">Desa</label>
                                    <select id="village_id" name="village_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Desa</option>
                                        <option value="1" <?= $action == 'edit' && $data_pengguna[$user_id]['village_id'] == '1' ? 'selected' : '' ?>>Kantor Pusat</option>
                                        <option value="2" <?= $action == 'edit' && $data_pengguna[$user_id]['village_id'] == '2' ? 'selected' : '' ?>>Desa Makmur</option>
                                        <option value="3" <?= $action == 'edit' && $data_pengguna[$user_id]['village_id'] == '3' ? 'selected' : '' ?>>Desa Sejahtera</option>
                                        <option value="4" <?= $action == 'edit' && $data_pengguna[$user_id]['village_id'] == '4' ? 'selected' : '' ?>>Desa Baru</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status<span class="text-red-500">*</span></label>
                                    <select id="status" name="status" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="active" <?= $action == 'edit' && $data_pengguna[$user_id]['status'] == 'active' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="inactive" <?= $action == 'edit' && $data_pengguna[$user_id]['status'] == 'inactive' ? 'selected' : '' ?>>Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="flex justify-end space-x-3">
                            <a href="user" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Batal</a>
                            <button type="button" id="saveUserBtn" onclick="saveUserData()" class="ml-2 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-yellow-400 h-full">
                                <span id="btnUserText">Simpan</span> <!-- Teks tombol -->
                                <svg id="loadingUserSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white bg-yellow-500 hover:bg-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        <?php else: ?>
            <!-- View Section (Hidden by default) -->
            <div id="view-section" class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Detail Pengguna</h2>
                        <button onclick="hideViewSection()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="space-y-4" id="view-user-details">
                        <!-- Detail akan diisi oleh JavaScript -->
                    </div>
                    <div class="flex justify-end pt-4 mt-4 border-t">
                        <button onclick="hideViewSection()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Tutup</button>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </section>
</main>

<!-- Modal Hapus Data -->
<div id="deleteModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-600 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-trash-alt text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="deleteModalTitle" class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Hapus Data</h3>
                        <div class="mt-2">
                            <p id="deleteModalContent" class="text-sm text-gray-500">
                                Apakah Anda yakin ingin menghapus data ini? Setelah Anda menekan "Hapus", data tidak akan muncul di dalam table.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="deleteDataBtn" class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm" onclick="deleteData()">
                    <span id="btnText">Hapus</span> <!-- Teks tombol -->
                    <svg id="loadingSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                    </svg>
                </button>

                <button type="button" onclick="closeDeletelModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Activate/Deactivate -->
<div id="statusModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-600 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-sync-alt text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="statusModalTitle" class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Perubahan Status</h3>
                        <div class="mt-2">
                            <p id="statusModalContent" class="text-sm text-gray-500">
                                Apakah Anda yakin ingin mengubah status pengguna ini menjadi <span id="statusAction"></span>?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="changeStatusBtn" class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm" onclick="changeStatus()">
                    <span id="btnStatusText">Ubah Status</span>
                    <svg id="statusLoadingSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                    </svg>
                </button>

                <button type="button" onclick="closeStatusModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dummy data for Provinces, Cities, Districts, and Villages
        const provinces = [{
                code: "11",
                name: "Aceh"
            },
            {
                code: "51",
                name: "Bali"
            },
            {
                code: "36",
                name: "Banten"
            },
            {
                code: "17",
                name: "Bengkulu"
            },
            {
                code: "34",
                name: "Daerah Istimewa Yogyakarta"
            },
        ];

        const cities = {
            "11": [{
                    code: "1101",
                    name: "Banda Aceh"
                },
                {
                    code: "1102",
                    name: "Sabang"
                }
            ],
            "51": [{
                    code: "5101",
                    name: "Denpasar"
                },
                {
                    code: "5102",
                    name: "Badung"
                }
            ],
            "36": [{
                    code: "3601",
                    name: "Serang"
                },
                {
                    code: "3602",
                    name: "Cilegon"
                }
            ],
            "17": [{
                    code: "1701",
                    name: "Bengkulu City"
                },
                {
                    code: "1702",
                    name: "Rejang Lebong"
                }
            ],
            "34": [{
                    code: "3401",
                    name: "Yogyakarta"
                },
                {
                    code: "3402",
                    name: "Sleman"
                }
            ],
        };

        const districts = {
            "1101": [{
                    code: "110101",
                    name: "Banda Aceh Timur"
                },
                {
                    code: "110102",
                    name: "Kuta Alam"
                }
            ],
            "5101": [{
                    code: "510101",
                    name: "Denpasar Barat"
                },
                {
                    code: "510102",
                    name: "Denpasar Timur"
                }
            ],
            "3601": [{
                    code: "360101",
                    name: "Serang Kota"
                },
                {
                    code: "360102",
                    name: "Cikande"
                }
            ],
            "1701": [{
                    code: "170101",
                    name: "Bengkulu Utara"
                },
                {
                    code: "170102",
                    name: "Bengkulu Selatan"
                }
            ],
            "3401": [{
                    code: "340101",
                    name: "Yogyakarta Kota"
                },
                {
                    code: "340102",
                    name: "Sleman Barat"
                }
            ],
        };

        const villages = {
            "110101": [{
                    code: "11010101",
                    name: "Paya Bili"
                },
                {
                    code: "11010102",
                    name: "Kuta Alam Selatan"
                }
            ],
            "510101": [{
                    code: "51010101",
                    name: "Pemecutan Klod"
                },
                {
                    code: "51010102",
                    name: "Pemecutan Kaja"
                }
            ],
            "360101": [{
                    code: "36010101",
                    name: "Cigode"
                },
                {
                    code: "36010102",
                    name: "Kedung Hutan"
                }
            ],
            "170101": [{
                    code: "17010101",
                    name: "Pahlawan"
                },
                {
                    code: "17010102",
                    name: "Kampung Baru"
                }
            ],
            "340101": [{
                    code: "34010101",
                    name: "Catur Tunggal"
                },
                {
                    code: "34010102",
                    name: "Sleman Tengah"
                }
            ],
        };

        // Populate Province Dropdown
        const provinceSelect = document.getElementById('province_id');
        provinces.forEach(province => {
            const option = document.createElement('option');
            option.value = province.code;
            option.textContent = province.name;
            provinceSelect.appendChild(option);
        });

        // Event listener for Province selection
        document.getElementById('province_id').addEventListener('change', function() {
            const provinceId = this.value;
            if (provinceId) {
                // Populate City Dropdown based on selected Province
                const citySelect = document.getElementById('city_id');
                citySelect.innerHTML = '<option value="">Pilih Kota</option>';
                cities[provinceId].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.code;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            }
        });

        // Event listener for City selection
        document.getElementById('city_id').addEventListener('change', function() {
            const cityId = this.value;
            if (cityId) {
                // Populate District Dropdown based on selected City
                const subdistrictSelect = document.getElementById('subdistrict_id');
                subdistrictSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                districts[cityId].forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.code;
                    option.textContent = district.name;
                    subdistrictSelect.appendChild(option);
                });
            }
        });

        // Event listener for District selection
        document.getElementById('subdistrict_id').addEventListener('change', function() {
            const districtId = this.value;
            if (districtId) {
                // Populate Village Dropdown based on selected District
                const villageSelect = document.getElementById('village_id');
                villageSelect.innerHTML = '<option value="">Pilih Desa</option>';
                villages[districtId].forEach(village => {
                    const option = document.createElement('option');
                    option.value = village.code;
                    option.textContent = village.name;
                    villageSelect.appendChild(option);
                });
            }
        });
    });

    function saveUserData() {
        const user_id = document.getElementById("user_id");
        const full_name = document.getElementById("full_name");
        const email = document.getElementById("email");
        const username = document.getElementById("username");
        const phone_number = document.getElementById("phone_number");
        const user_type = document.getElementById("user_type");
        const ic_type = document.getElementById("ics_type");
        const alamat = document.getElementById("alamat");
        const status = document.getElementById("status");

        // Menampilkan loading spinner dan menonaktifkan tombol
        const saveBtn = document.getElementById("saveUserBtn");
        const loadingSpinner = document.getElementById("loadingUserSpinner");
        const btnText = document.getElementById("btnUserText");

        // Validate required fields
        if (!full_name.value) {
            showSweetAlert('error', 'Form Gagal', 'Nama Lengkap harus diisi.', false, '');
            return;
        }

        if (!email.value) {
            showSweetAlert('error', 'Form Gagal', 'Email harus diisi.', false, '');
            return;
        }

        if (!username.value) {
            showSweetAlert('error', 'Form Gagal', 'Username harus diisi.', false, '');
            return;
        }

        if (!phone_number.value) {
            showSweetAlert('error', 'Form Gagal', 'No Telp harus diisi.', false, '');
            return;
        }

        if (!user_type.value) {
            showSweetAlert('error', 'Form Gagal', 'Role harus dipilih.', false, '');
            return;
        }

        if (user_type.value === "Admin ICS" && !ic_type.value) {
            showSweetAlert('error', 'Form Gagal', 'ICS harus dipilih untuk role Admin ICS.', false, '');
            return;
        }

        if (!alamat.value) {
            showSweetAlert('error', 'Form Gagal', 'Alamat Lengkap harus diisi.', false, '');
            return;
        }

        if (!status.value) {
            showSweetAlert('error', 'Form Gagal', 'Status harus dipilih.', false, '');
            return;
        }

        // Menonaktifkan tombol dan menampilkan spinner saat proses upload
        saveBtn.disabled = true;
        btnText.style.display = 'none'; // Menyembunyikan teks tombol
        loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner

        // Simulasi upload data (misalnya dengan setTimeout)
        setTimeout(() => {
            // Proses upload selesai
            showSweetAlert('success', 'Berhasil Disimpan', 'Data user berhasil disimpan ke dalam database.', true, 'user');

            // Menyembunyikan spinner dan mengaktifkan kembali tombol
            loadingSpinner.style.display = 'none';
            btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
            saveBtn.disabled = false; // Mengaktifkan tombol kembali

            // Pindah halaman setelah delay
            setTimeout(() => {
                // Ganti dengan URL halaman yang sesuai
                window.location.href = 'user'; // Misalnya, ke halaman daftar user
            }, 2000); // Pindah halaman setelah 2 detik
        }, 3000); // Waktu simulasi upload (3 detik)
    }


    // Function to show form (add/edit) dan menyembunyikan tabel
    function showForm(action, id = null) {
        const form = document.getElementById('user-form');
        const tableContainer = document.getElementById('user-table-container');
        const viewSection = document.getElementById('view-section');

        // Sembunyikan tabel dan view section
        tableContainer.classList.add('hidden');
        viewSection.classList.add('hidden');

        // Reset form
        document.getElementById('user-form-element').reset();
        document.getElementById('user_id').value = '';

        const formTitle = document.getElementById('form-title');
        if (action === 'add') {
            formTitle.textContent = 'Tambah Pengguna Baru';
        } else if (action === 'edit' && id) {
            formTitle.textContent = 'Edit Data Pengguna';
            // In a real application, you would fetch user data here
            // For demo, we'll use the PHP data
            const userData = <?= json_encode($data_pengguna) ?>[id];
            if (userData) {
                // Populate form with user data
                document.getElementById('username').value = userData.username;
                document.getElementById('email').value = userData.email;
                document.getElementById('full_name').value = userData.full_name;
                document.getElementById('user_type').value = userData.user_type;
                document.getElementById('village_id').value = userData.village_id;
                document.getElementById('status').value = userData.status;
            }
            document.getElementById('user_id').value = id;
        }

        // Tampilkan form
        form.classList.remove('hidden');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Function to hide form and show table
    function hideFormAndShowTable() {
        document.getElementById('user-form').classList.add('hidden');
        document.getElementById('view-section').classList.add('hidden');
        document.getElementById('user-table-container').classList.remove('hidden');
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Function to view user details
    function viewUser(id) {
        const userData = <?= json_encode($data_pengguna) ?>[id];
        if (userData) {
            const viewSection = document.getElementById('view-section');
            const detailsDiv = document.getElementById('view-user-details');

            detailsDiv.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">ID Pengguna</p>
                    <p class="font-medium">${id}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Username</p>
                    <p class="font-medium">${userData.username}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">${userData.email}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nama Lengkap</p>
                    <p class="font-medium">${userData.full_name}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tipe User</p>
                    <p class="font-medium">${userData.user_type === 'admin' ? 'Administrator' : 
                                           userData.user_type === 'officer' ? 'Petugas Lapangan' : 'Petani'}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Desa</p>
                    <p class="font-medium">${userData.village_name}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="font-medium">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            ${userData.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                            ${userData.status === 'active' ? 'Aktif' : 'Non-Aktif'}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Daftar</p>
                    <p class="font-medium">${userData.created_at}</p>
                </div>
            </div>
        `;

            // Sembunyikan tabel dan form, tampilkan view section
            document.getElementById('user-table-container').classList.add('hidden');
            document.getElementById('user-form').classList.add('hidden');
            viewSection.classList.remove('hidden');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }

    // Function to hide view section
    function hideViewSection() {
        document.getElementById('view-section').classList.add('hidden');
        document.getElementById('user-table-container').classList.remove('hidden');
    }

    // Function to edit user
    function editUser(id) {
        showForm('edit', id);
    }

    // Function to delete user
    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
            // In a real application, you would make an AJAX call here
            alert('Pengguna berhasil dihapus!');
            window.location.href = '?mode=list';
        }
    }

    // Function to apply filters
    function applyFilters() {
        // In a real application, this would submit the form
        document.getElementById('filter-form').submit();
    }

    // Event listener for form submission
    document.getElementById('user-form-element')?.addEventListener('submit', function(e) {
        e.preventDefault();

        // In a real application, you would make an AJAX call here
        alert('Data pengguna berhasil disimpan!');
        hideFormAndShowTable();
        window.location.href = '?mode=list';
    });

    function openDeletelModal(id = null) {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeletelModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Fungsi untuk menghapus data
    function deleteData() {
        const deleteBtn = document.getElementById("deleteDataBtn");
        const loadingSpinner = document.getElementById("loadingSpinner");
        const btnText = document.getElementById("btnText");

        // Menonaktifkan tombol dan menampilkan spinner
        deleteBtn.disabled = true; // Menonaktifkan tombol
        btnText.style.display = 'none'; // Menyembunyikan teks tombol
        loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner loading

        // Proses penghapusan data
        setTimeout(() => {
            // Simulasi penghapusan data selesai
            showSweetAlert('success', 'Penghapusan Berhasil', 'Data telah berhasil dihapus.', true, '');
            closeDeletelModal()

            // Menyembunyikan spinner dan mengaktifkan kembali tombol
            loadingSpinner.style.display = 'none'; // Menyembunyikan spinner
            btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
            deleteBtn.disabled = false; // Mengaktifkan kembali tombol
        }, 3000); // Waktu tunggu simulasi (3 detik)
    }

    let selectedUserId = null;
    let selectedUserStatus = null;

    function openStatusModal(userId, currentStatus) {
        selectedUserId = userId;
        selectedUserStatus = currentStatus;

        const statusText = document.getElementById("statusAction");
        const statusModalTitle = document.getElementById("statusModalTitle");

        if (currentStatus === 'active') {
            statusText.textContent = 'Non-Aktif';
            statusModalTitle.textContent = 'Konfirmasi Non-Aktifkan Pengguna';
        } else {
            statusText.textContent = 'Aktif';
            statusModalTitle.textContent = 'Konfirmasi Aktifkan Pengguna';
        }

        // Show the modal
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    function changeStatus() {
        const changeStatusBtn = document.getElementById("changeStatusBtn");
        const loadingSpinner = document.getElementById("statusLoadingSpinner");
        const btnText = document.getElementById("btnStatusText");

        // Disable the button and show loading spinner
        changeStatusBtn.disabled = true;
        btnText.style.display = 'none';
        loadingSpinner.style.display = 'inline-block';

        // Simulate status change (Replace with actual status change logic)
        setTimeout(() => {
            // Simulate the success of the operation
            showSweetAlert('success', 'Berhasil Diubah', 'Status pengguna berhasil diubah.', true, '');

            // Close modal and reset button state
            closeStatusModal();

            loadingSpinner.style.display = 'none';
            btnText.style.display = 'inline';
            changeStatusBtn.disabled = false;

            // Optionally, you could also refresh the page or update the table data
            location.reload(); // This will refresh the page
        }, 3000); // Simulate 3-second delay for status change
    }
</script>

<?php include 'footer.php'; ?>