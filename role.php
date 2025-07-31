<?php

include 'header.php';

// Cek apakah role bukan 'Super Admin'
if ($user['akun']['role'] == 'User') {
    // Menampilkan alert menggunakan SweetAlert
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Anda tidak memiliki akses untuk halaman ini.',
                confirmButtonText: 'OK',
                background: '#f3f4f6',
                backdrop: 'rgba(0, 0, 0, 1)',
                allowOutsideClick: false, // Disable clicking outside the modal
                allowEscapeKey: false, // Disable closing with the Escape key
            }).then(function() {
                // Setelah alert ditutup, arahkan pengguna ke halaman login
                window.history.back(); // Kembali ke halaman sebelumnya
            });
          </script>";
}

// Simulasi data dummy untuk role
$dummyRoles = [
    [
        'role_id' => 1,
        'name' => 'Super Admin',
        'number' => 1,
        'approval' => 'Ya',
        'status' => 'Active',
    ],
    [
        'role_id' => 2,
        'name' => 'Admin',
        'number' => 2,
        'approval' => 'Tidak',
        'status' => 'Inactive',
    ],
    [
        'role_id' => 3,
        'name' => 'User',
        'number' => 3,
        'approval' => 'Tidak',
        'status' => 'Active',
    ],
    [
        'role_id' => 4,
        'name' => 'Editor',
        'number' => 4,
        'approval' => 'Tidak',
        'status' => 'Active',
    ],
];

// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$farmer_id = isset($_GET['id']) ? $_GET['id'] : '';

// Simulasi data farmer yang dipilih
$farmer = null;
if ($farmer_id) {
    foreach ($dummyRoles as $f) {
        if ($f['role_id'] == $farmer_id) {
            $farmer = $f;
            break;
        }
    }
}

?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20   shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah Role Baru";
                elseif ($action == 'view') echo "Profil Role: " . ($farmer ? htmlspecialchars($farmer['name']) : '');
                elseif ($action == 'edit') echo "Edit Role: " . ($farmer ? htmlspecialchars($farmer['name']) : '');
                else echo "Data Role";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="role?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Role
                </a>
            <?php elseif ($action == 'edit'): ?>
                <a href="role?action=view&id=<?= $farmer_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Petani -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permission Manager</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            // Filter data berdasarkan dropdown
                            $filteredRoles = $dummyRoles;
                            // if (isset($_GET['ics_filter']) && $_GET['ics_filter'] != '') {
                            //     $filteredRoles = array_filter($filteredRoles, function ($f) {
                            //         return $f['ics_id'] == $_GET['ics_filter'];
                            //     });
                            // }
                            // if (isset($_GET['group_filter']) && $_GET['group_filter'] != '') {
                            //     $filteredRoles = array_filter($filteredRoles, function ($f) {
                            //         return $f['group_id'] == $_GET['group_filter'];
                            //     });
                            // }
                            // if (isset($_GET['status_filter']) && $_GET['status_filter'] != '') {
                            //     $filteredRoles = array_filter($filteredRoles, function ($f) {
                            //         return $f['status'] == $_GET['status_filter'];
                            //     });
                            // }
                            // if (isset($_GET['gender_filter']) && $_GET['gender_filter'] != '') {
                            //     $filteredRoles = array_filter($filteredRoles, function ($f) {
                            //         return $f['gender'] == $_GET['gender_filter'];
                            //     });
                            // }
                            // if (isset($_GET['search']) && $_GET['search'] != '') {
                            //     $search = strtolower($_GET['search']);
                            //     $filteredRoles = array_filter($filteredRoles, function ($f) use ($search) {
                            //         return strpos(strtolower($f['name']), $search) !== false;
                            //     });
                            // }

                            // Pagination logic
                            // $totalFarmers = count($filteredRoles);
                            // $totalPages = ceil($totalFarmers / $perPage);
                            // $currentPage = min($currentPage, $totalPages); // Ensure we don't go past the last page

                            // Get current page's farmers
                            // $offset = ($currentPage - 1) * $perPage;
                            // $currentPageFarmers = array_slice($filteredRoles, $offset, $perPage);
                            // echo count($filteredRoles) . '|' . empty($currentPageFarmers);
                            ?>
                            <?php if (empty($filteredRoles)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data role</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($filteredRoles as $index => $f): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['number']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['approval']) ?></td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $f['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $f['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="role?action=edit&id=<?= $f['role_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('<?= $f['role_id'] ?>')" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" style="display: none;">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="role?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="role?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium"><?= $offset + 1 ?></span> sampai <span class="font-medium"><?= min($offset + $perPage, $totalFarmers) ?></span> dari <span class="font-medium"><?= $totalFarmers ?></span> role
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="role?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                                <?php
                                // Show page numbers
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);

                                if ($startPage > 1) {
                                    echo '<a href="role?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="role?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                                }

                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="role?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>

                                <a href="role?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($action == 'add' || $action == 'edit'): ?>
            <!-- Form Tambah/Edit Petani -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <form method="POST">

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $action == 'edit' ? htmlspecialchars($farmer['name']) : '' ?>">
                        </div>

                        <!-- Number -->
                        <div>
                            <label for="number" class="block text-sm font-medium text-gray-700">Urutan <span class="text-red-500">*</span></label>
                            <input type="number" id="number" name="number" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $action == 'edit' ? htmlspecialchars($farmer['number']) : '' ?>">
                        </div>

                        <!-- Approval -->
                        <div>
                            <label for="approval" class="block text-sm font-medium text-gray-700">Permission Manager <span class="text-red-500">*</span></label>
                            <select id="approval" name="approval" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="Ya" <?= $action == 'edit' && $farmer['approval'] == 'Ya' ? 'selected' : '' ?>>Ya</option>
                                <option value="Tidak" <?= $action == 'edit' && $farmer['approval'] == 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                            <select id="status" name="status" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="Active" <?= $action == 'edit' && $farmer['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= $action == 'edit' && $farmer['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <br>

                        <div class="flex justify-end space-x-3">
                            <a href="role" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php include 'footer.php'; ?>