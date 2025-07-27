<?php 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize mode and ID
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Dummy data for menu access
$data_hak_akses = [
    'ACC001' => [
        'username' => 'admin_wri',
        'user_type' => 'admin',
        'full_name' => 'Admin WRI',
        'menu_access' => ['dashboard', 'petani', 'lahan', 'sertifikasi', 'panen', 'laporan', 'pengguna', 'hak_akses'],
        'status' => 'active',
        'created_at' => '2022-01-15'
    ],
    'ACC002' => [
        'username' => 'petugas1',
        'user_type' => 'officer',
        'full_name' => 'Petugas Lapangan 1',
        'menu_access' => ['dashboard', 'petani', 'lahan', 'panen'],
        'status' => 'active',
        'created_at' => '2022-02-20'
    ],
    'ACC003' => [
        'username' => 'petani_ahmad',
        'user_type' => 'farmer',
        'full_name' => 'Ahmad Fauzi',
        'menu_access' => ['dashboard', 'lahan', 'panen'],
        'status' => 'active',
        'created_at' => '2022-03-05'
    ],
    'ACC004' => [
        'username' => 'petani_budi',
        'user_type' => 'farmer',
        'full_name' => 'Budi Santoso',
        'menu_access' => ['dashboard', 'lahan'],
        'status' => 'inactive',
        'created_at' => '2022-04-10'
    ]
];

// Filter options
$user_types = ['admin' => 'Administrator', 'officer' => 'Petugas Lapangan', 'farmer' => 'Petani'];
$statuses = ['active' => 'Aktif', 'inactive' => 'Non-Aktif'];
$menu_options = [
    'dashboard' => 'Dashboard',
    'petani' => 'Manajemen Petani',
    'lahan' => 'Manajemen Lahan',
    'sertifikasi' => 'Sertifikasi',
    'panen' => 'Data Panen',
    'laporan' => 'Laporan',
    'pengguna' => 'Manajemen Pengguna',
    'hak_akses' => 'Hak Akses'
];

// Dummy user data for dropdown
$data_pengguna = [
    'USR001' => [
        'username' => 'admin_wri',
        'email' => 'admin@wri.com',
        'full_name' => 'Admin WRI',
        'user_type' => 'admin',
        'status' => 'active'
    ],
    'USR002' => [
        'username' => 'petugas1',
        'email' => 'petugas1@wri.com',
        'full_name' => 'Petugas Lapangan 1',
        'user_type' => 'officer',
        'status' => 'active'
    ],
    'USR003' => [
        'username' => 'petani_ahmad',
        'email' => 'ahmad@example.com',
        'full_name' => 'Ahmad Fauzi',
        'user_type' => 'farmer',
        'status' => 'active'
    ],
    'USR004' => [
        'username' => 'petani_budi',
        'email' => 'budi@example.com',
        'full_name' => 'Budi Santoso',
        'user_type' => 'farmer',
        'status' => 'inactive'
    ]
];

// Apply filters
$filtered_hak_akses = $data_hak_akses;
$filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : '';
$filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
$filter_menu = isset($_GET['filter_menu']) ? $_GET['filter_menu'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($filter_type) {
    $filtered_hak_akses = array_filter($filtered_hak_akses, function($hak_akses) use ($filter_type) {
        return $hak_akses['user_type'] == $filter_type;
    });
}

if ($filter_status) {
    $filtered_hak_akses = array_filter($filtered_hak_akses, function($hak_akses) use ($filter_status) {
        return $hak_akses['status'] == $filter_status;
    });
}

if ($filter_menu) {
    $filtered_hak_akses = array_filter($filtered_hak_akses, function($hak_akses) use ($filter_menu) {
        return in_array($filter_menu, $hak_akses['menu_access']);
    });
}

if ($search) {
    $search = strtolower($search);
    $filtered_hak_akses = array_filter($filtered_hak_akses, function($hak_akses) use ($search) {
        return (strpos(strtolower($hak_akses['username']), $search) !== false || 
               strpos(strtolower($hak_akses['full_name']), $search) !== false);
    });
}

// Pagination configuration
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalItems = count($filtered_hak_akses);
$totalPages = ceil($totalItems / $itemsPerPage);
$currentPage = min($currentPage, $totalPages);
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedHakAkses = array_slice($filtered_hak_akses, $startIndex, $itemsPerPage, true);

// Include header
include 'header.php';
?>

<!-- Main Content -->
<main class="flex-1 flex flex-col">
    <!-- Header Section -->
    <header class="h-20 flex items-center justify-between px-8 sticky top-0 z-10">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php 
                switch($mode) {
                    case 'list': echo 'Manajemen Hak Akses'; break;
                    case 'add': echo 'Tambah Hak Akses Baru'; break;
                    case 'view': echo 'Detail Hak Akses'; break;
                    case 'edit': echo 'Edit Hak Akses'; break;
                    default: echo 'Manajemen Hak Akses';
                }
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($mode === 'list'): ?>
                <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Hak Akses
                </a>
            <?php elseif ($mode === 'view'): ?>
                <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="?mode=edit&id=<?= htmlspecialchars($id) ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            <?php elseif (in_array($mode, ['edit', 'add'])): ?>
                <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="flex-1 overflow-y-auto bg-gray-50">
        <?php if ($mode === 'list'): ?>
            <!-- List View -->
            <div class="p-8">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <!-- Filter Section -->
                    <div class="p-4 bg-gray-50 border-b">
                        <form method="get" class="space-y-4">
                            <input type="hidden" name="mode" value="list">
                            <div class="mb-4">
                                <div class="relative">
                                    <input type="text" id="search" name="search" 
                                           value="<?= htmlspecialchars($search) ?>" 
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                           placeholder="Cari hak akses...">
                                    <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <select id="filter_type" name="filter_type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Tipe</option>
                                        <?php foreach($user_types as $key => $type): ?>
                                            <option value="<?= htmlspecialchars($key) ?>" <?= $filter_type === $key ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($type) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <select id="filter_menu" name="filter_menu" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Menu</option>
                                        <?php foreach($menu_options as $key => $menu): ?>
                                            <option value="<?= htmlspecialchars($key) ?>" <?= $filter_menu === $key ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($menu) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <select id="filter_status" name="filter_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Status</option>
                                        <?php foreach($statuses as $key => $status): ?>
                                            <option value="<?= htmlspecialchars($key) ?>" <?= $filter_status === $key ? 'selected' : '' ?>>
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

                    <!-- Table Section -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Akses</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Akses</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (empty($paginatedHakAkses)): ?>
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data hak akses</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($paginatedHakAkses as $id_akses => $hak_akses): 
                                        $rowNumber = $startIndex + array_search($id_akses, array_keys($filtered_hak_akses)) + 1;
                                    ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $id_akses ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900"><?= $hak_akses['full_name'] ?></div>
                                                <div class="text-sm text-gray-500"><?= $hak_akses['username'] ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if ($hak_akses['user_type'] === 'admin'): ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        Administrator
                                                    </span>
                                                <?php elseif ($hak_akses['user_type'] === 'officer'): ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Petugas Lapangan
                                                    </span>
                                                <?php else: ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Petani
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    <?= implode(', ', array_map(function($menu) use ($menu_options) {
                                                        return $menu_options[$menu] ?? $menu;
                                                    }, $hak_akses['menu_access'])) ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if ($hak_akses['status'] === 'active'): ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                                <?php else: ?>
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="?mode=view&id=<?= $id_akses ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="?mode=edit&id=<?= $id_akses ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button onclick="confirmDelete('<?= $id_akses ?>')" class="text-red-600 hover:text-red-900" title="Hapus">
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
                    <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" 
                               class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </a>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" 
                               class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium"><?= $startIndex + 1 ?></span> sampai 
                                    <span class="font-medium"><?= min($startIndex + $itemsPerPage, $totalItems) ?></span> dari 
                                    <span class="font-medium"><?= $totalItems ?></span> hasil
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" 
                                       class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
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
                                    
                                    if ($startPage > 1): ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>" 
                                           class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                            1
                                        </a>
                                        <?php if ($startPage > 2): ?>
                                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                ...
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" 
                                           class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium <?= $i == $currentPage ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' ?>">
                                            <?= $i ?>
                                        </a>
                                    <?php endfor; ?>
                                    
                                    <?php if ($endPage < $totalPages): ?>
                                        <?php if ($endPage < $totalPages - 1): ?>
                                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                ...
                                            </span>
                                        <?php endif; ?>
                                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>" 
                                           class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                            <?= $totalPages ?>
                                        </a>
                                    <?php endif; ?>

                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" 
                                       class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                        <span class="sr-only">Next</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($mode === 'add'): ?>
            <!-- Add Form -->
            <div class="p-8">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Hak Akses Baru</h2>
                        <form id="addForm" action="?mode=list" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pengguna*</label>
                                        <select id="user_id" name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Pengguna</option>
                                            <?php foreach($data_pengguna as $id_pengguna => $pengguna): ?>
                                                <option value="<?= $id_pengguna ?>"><?= $pengguna['full_name'] ?> (<?= $pengguna['username'] ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="active" selected>Aktif</option>
                                            <option value="inactive">Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="user_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna*</label>
                                        <select id="user_type" name="user_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Tipe</option>
                                            <option value="admin">Administrator</option>
                                            <option value="officer">Petugas Lapangan</option>
                                            <option value="farmer">Petani</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Menu Akses*</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <?php foreach($menu_options as $key => $menu): ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="menu_<?= $key ?>" name="menu_access[]" value="<?= $key ?>" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="menu_<?= $key ?>" class="ml-2 text-sm text-gray-700"><?= $menu ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                            <div class="mt-8 flex justify-end space-x-4">
                                <button type="button" onclick="window.location.href='?mode=list'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                    Batal
                                </button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                    Simpan Hak Akses
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php elseif ($mode === 'view' && isset($id) && isset($data_hak_akses[$id])): ?>
            <!-- View Mode -->
            <?php $hak_akses = $data_hak_akses[$id]; ?>
            <div class="p-8">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800"><?= $hak_akses['full_name'] ?></h2>
                                <p class="text-gray-600">ID Akses: <?= $id ?></p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium <?= $hak_akses['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $hak_akses['status'] === 'active' ? 'Aktif' : 'Non-Aktif' ?>
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Pengguna</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Username:</span>
                                        <p class="text-sm font-medium"><?= $hak_akses['username'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Tipe Pengguna:</span>
                                        <p class="text-sm font-medium">
                                            <?= $user_types[$hak_akses['user_type']] ?? $hak_akses['user_type'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-900 mb-2">Informasi Tambahan</h3>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-gray-500">Tanggal Dibuat:</span>
                                        <p class="text-sm font-medium"><?= date('d F Y', strtotime($hak_akses['created_at'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Menu Akses</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <?php foreach($menu_options as $key => $menu): ?>
                                    <div class="flex items-center">
                                        <?php if (in_array($key, $hak_akses['menu_access'])): ?>
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span class="text-sm text-gray-700"><?= $menu ?></span>
                                        <?php else: ?>
                                            <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-500"><?= $menu ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($mode === 'edit' && isset($id) && isset($data_hak_akses[$id])): ?>
            <!-- Edit Form -->
            <?php $hak_akses = $data_hak_akses[$id]; ?>
            <div class="p-8">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Hak Akses</h2>
                        <form id="editForm" action="?mode=view&id=<?= $id ?>" method="post">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Pengguna*</label>
                                        <select id="user_id" name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required disabled>
                                            <option value="">Pilih Pengguna</option>
                                            <?php foreach($data_pengguna as $id_pengguna => $pengguna): ?>
                                                <option value="<?= $id_pengguna ?>" <?= $hak_akses['username'] === $pengguna['username'] ? 'selected' : '' ?>>
                                                    <?= $pengguna['full_name'] ?> (<?= $pengguna['username'] ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="active" <?= $hak_akses['status'] === 'active' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="inactive" <?= $hak_akses['status'] === 'inactive' ? 'selected' : '' ?>>Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-4">
                                        <label for="user_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna*</label>
                                        <select id="user_type" name="user_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="admin" <?= $hak_akses['user_type'] === 'admin' ? 'selected' : '' ?>>Administrator</option>
                                            <option value="officer" <?= $hak_akses['user_type'] === 'officer' ? 'selected' : '' ?>>Petugas Lapangan</option>
                                            <option value="farmer" <?= $hak_akses['user_type'] === 'farmer' ? 'selected' : '' ?>>Petani</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Menu Akses*</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <?php foreach($menu_options as $key => $menu): ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="menu_<?= $key ?>" name="menu_access[]" value="<?= $key ?>" 
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                                   <?= in_array($key, $hak_akses['menu_access']) ? 'checked' : '' ?>>
                                            <label for="menu_<?= $key ?>" class="ml-2 text-sm text-gray-700"><?= $menu ?></label>
                                        </div>
                                    <?php endforeach; ?>
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
            </div>

        <?php else: ?>
            <!-- Default View -->
            <div class="p-8">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Manajemen Hak Akses</h2>
                        <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    // Confirm deletion
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data hak akses ini?')) {
            // In a real application, you would make an AJAX call or form submission here
            alert('Data hak akses berhasil dihapus!');
            window.location.href = '?mode=list';
        }
    }

    // Update user dropdown based on selected user type
    document.getElementById('user_type')?.addEventListener('change', function() {
        const type = this.value;
        const userSelect = document.getElementById('user_id');
        
        // Reset dropdown
        userSelect.innerHTML = '<option value="">Pilih Pengguna</option>';
        
        // Filter users based on type
        <?php foreach($data_pengguna as $id_pengguna => $pengguna): ?>
            if (type === '' || '<?= $pengguna['user_type'] ?>' === type) {
                userSelect.innerHTML += `
                    <option value="<?= $id_pengguna ?>">
                        <?= $pengguna['full_name'] ?> (<?= $pengguna['username'] ?>)
                    </option>
                `;
            }
        <?php endforeach; ?>
    });
</script>

<?php include 'footer.php'; ?>