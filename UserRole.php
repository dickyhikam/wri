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
        'user_type' => 'admin',
        'village_id' => '1',
        'village_name' => 'Kantor Pusat',
        'status' => 'active',
        'created_at' => '2022-01-15'
    ],
    'USR002' => [
        'username' => 'petugas1',
        'email' => 'petugas1@wri.com',
        'full_name' => 'Petugas Lapangan 1',
        'user_type' => 'officer',
        'village_id' => '2',
        'village_name' => 'Desa Makmur',
        'status' => 'active',
        'created_at' => '2022-02-20'
    ],
    'USR003' => [
        'username' => 'petani_ahmad',
        'email' => 'ahmad@example.com',
        'full_name' => 'Ahmad Fauzi',
        'user_type' => 'farmer',
        'village_id' => '3',
        'village_name' => 'Desa Sejahtera',
        'status' => 'active',
        'created_at' => '2022-03-05'
    ],
    'USR004' => [
        'username' => 'petani_budi',
        'email' => 'budi@example.com',
        'full_name' => 'Budi Santoso',
        'user_type' => 'farmer',
        'village_id' => '4',
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
?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8 sticky top-0 z-10">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
        <button onclick="showForm('add')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Pengguna
        </button>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <!-- Form (Hidden by default) -->
        <div id="user-form" class="bg-white rounded-xl shadow-md overflow-hidden mb-6 hidden">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6" id="form-title">Tambah Pengguna Baru</h2>
                <form id="user-form-element">
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username<span class="text-red-500">*</span></label>
                            <input type="text" id="username" name="username" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email<span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password<span class="text-red-500">*</span></label>
                            <input type="password" id="password" name="password" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password<span class="text-red-500">*</span></label>
                            <input type="password" id="confirm_password" name="confirm_password" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap<span class="text-red-500">*</span></label>
                            <input type="text" id="full_name" name="full_name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="user_type" class="block text-sm font-medium text-gray-700">Tipe Pengguna<span class="text-red-500">*</span></label>
                            <select id="user_type" name="user_type" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Tipe</option>
                                <option value="admin">Administrator</option>
                                <option value="officer">Petugas Lapangan</option>
                                <option value="farmer">Petani</option>
                            </select>
                        </div>
                        <div>
                            <label for="village_id" class="block text-sm font-medium text-gray-700">Desa</label>
                            <select id="village_id" name="village_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Desa</option>
                                <option value="1">Kantor Pusat</option>
                                <option value="2">Desa Makmur</option>
                                <option value="3">Desa Sejahtera</option>
                                <option value="4">Desa Baru</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status<span class="text-red-500">*</span></label>
                            <select id="status" name="status" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="active">Aktif</option>
                                <option value="inactive">Non-Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideFormAndShowTable()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Section (Hidden by default) -->
        <div id="view-section" class="bg-white rounded-xl shadow-md overflow-hidden mb-6 hidden">
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
                                        <?php if ($pengguna['user_type'] === 'admin'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Administrator
                                            </span>
                                        <?php elseif ($pengguna['user_type'] === 'officer'): ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Petugas Lapangan
                                            </span>
                                        <?php else: ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Petani
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
                                        <button onclick="viewUser('<?= $id_pengguna ?>')" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="editUser('<?= $id_pengguna ?>')" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="deleteUser('<?= $id_pengguna ?>')" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
    </section>
</main>

<script>
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
</script>

<?php include 'footer.php'; ?>