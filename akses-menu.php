<?php

include 'header.php';

// Simulasi Role
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

// Simulasi Menu dengan akses role
$dummyMenus = [
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440000',
        'name' => 'Master Data',
        'parent_id' => null,
        'url' => '#',
        'icon' => 'fa-database',
        'order' => 1,
        'visibility' => 'Super Admin',
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440001',
                'name' => 'Menu',
                'parent_id' => 1,
                'url' => 'role',
                'icon' => 'fa-cogs',
                'order' => 1,
                'visibility' => 'Super Admin',
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440002',
                'name' => 'Parcel Data',
                'parent_id' => 1,
                'url' => 'parcel',
                'icon' => 'fa-box',
                'order' => 2,
                'visibility' => 'Admin',
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440003',
                'name' => 'Petani',
                'parent_id' => 1,
                'url' => 'petani',
                'icon' => 'fa-users',
                'order' => 3,
                'visibility' => 'All',
            ],
        ]
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440004',
        'name' => 'WorkPlan',
        'parent_id' => null,
        'url' => 'workplan',
        'icon' => 'fa-project-diagram',
        'order' => 2,
        'visibility' => 'All',
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440005',
        'name' => 'Audit',
        'parent_id' => null,
        'url' => 'sertifikasi',
        'icon' => 'fa-user-secret',
        'order' => 3,
        'visibility' => 'Admin',
    ],
];

// Fungsi untuk mendapatkan menu berdasarkan role
function getMenuForRole($role)
{
    global $dummyMenus;
    $accessibleMenus = [];

    foreach ($dummyMenus as $menu) {
        // Super Admin dapat mengakses semua menu
        if ($role === 'Super Admin') {
            $accessibleMenus[] = $menu;
            if (isset($menu['submenus'])) {
                $accessibleMenus = array_merge($accessibleMenus, $menu['submenus']);
            }
        } else {
            // Role lainnya hanya bisa mengakses menu yang visibility-nya sesuai dengan role
            if ($menu['visibility'] === 'All' || $menu['visibility'] === $role) {
                $accessibleMenus[] = $menu;
                if (isset($menu['submenus'])) {
                    foreach ($menu['submenus'] as $submenu) {
                        if ($submenu['visibility'] === 'All' || $submenu['visibility'] === $role) {
                            $accessibleMenus[] = $submenu;
                        }
                    }
                }
            }
        }
    }
    return $accessibleMenus;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
// Ambil data role dari form (jika ada)
$role_id = isset($_GET['id']) ? $_GET['id'] : null;
$role = null;

// Jika mengedit, cari data role
if ($action == 'edit' && $role_id) {
    // Cari data role sesuai dengan ID
    foreach ($dummyRoles as $r) {
        if ($r['role_id'] == $role_id) {
            $role = $r;
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
                if ($action == 'add') echo "Tambah Akses Menu Baru";
                elseif ($action == 'view') echo "Profil Akses Menu: " . ($menu ? htmlspecialchars($menu['name']) : '');
                elseif ($action == 'edit') echo "Edit Akses Menu: " . ($menu ? htmlspecialchars($menu['name']) : '');
                else echo "Data Menu";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="akses-menu?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
                    <i class="fas fa-plus mr-2"></i> Tambah Menu
                </a>
            <?php elseif ($action == 'edit'): ?>
                <a href="akses-menu" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
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
                    <!-- Tabel Akses Menu untuk Semua Role -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu yang Dapat Diakses</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyRoles as $role): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold"><?= htmlspecialchars($role['name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <ul class="list-disc pl-6">
                                            <?php
                                            // Menampilkan menu-menu yang dapat diakses oleh role
                                            $accessibleMenus = getMenuForRole($role['name']);
                                            foreach ($accessibleMenus as $menu):
                                            ?>
                                                <li class="text-gray-700"><?= htmlspecialchars($menu['name']) ?></li>
                                                <?php if (isset($menu['submenus'])): ?>
                                                    <ul class="list-inside pl-4">
                                                        <?php foreach ($menu['submenus'] as $submenu): ?>
                                                            <li class="text-gray-600"><?= htmlspecialchars($submenu['name']) ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="akses-menu?action=edit&id=<?= $role['role_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" style="display: none;">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="menu?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="menu?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium"><?= $offset + 1 ?></span> sampai <span class="font-medium"><?= min($offset + $perPage, $totalFarmers) ?></span> dari <span class="font-medium"><?= $totalFarmers ?></span> menu
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="menu?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                                <?php
                                // Show page numbers
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);

                                if ($startPage > 1) {
                                    echo '<a href="menu?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="menu?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                                }

                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="menu?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>

                                <a href="menu?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
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
                        <!-- Role Dropdown -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                            <select id="role" name="role" disabled class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" onchange="updateAccessibleMenus()">
                                <option value="" disabled selected>-- Pilih Role --</option>
                                <?php foreach ($dummyRoles as $role): ?>
                                    <option value="<?= $role['role_id'] ?>" <?= ($action == 'edit' && $role['role_id'] == $role_id) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($role['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <br>
                        <!-- Menu yang Dapat Diakses (Checkbox) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Menu yang Dapat Diakses <span class="text-red-500">*</span></label>
                            <div class="space-y-2 mt-2">
                                <?php
                                // Menampilkan semua menu dan submenu yang dapat dipilih
                                foreach ($dummyMenus as $menu):
                                ?>
                                    <div>
                                        <input type="checkbox" id="menu_<?= $menu['menu_id'] ?>" name="accessible_menus[]" value="<?= $menu['menu_id'] ?>"
                                            <?= ($action == 'edit' && in_array($menu['menu_id'], $role['accessible_menus'] ?? [])) ? 'checked' : '' ?>>
                                        <label for="menu_<?= $menu['menu_id'] ?>" class="ml-2 text-gray-700"><?= htmlspecialchars($menu['name']) ?></label>
                                    </div>
                                    <?php if (isset($menu['submenus'])): ?>
                                        <?php foreach ($menu['submenus'] as $submenu): ?>
                                            <div class="ml-6">
                                                <input type="checkbox" id="submenu_<?= $submenu['menu_id'] ?>" name="accessible_menus[]" value="<?= $submenu['menu_id'] ?>"
                                                    <?= ($action == 'edit' && in_array($submenu['menu_id'], $role['accessible_menus'] ?? [])) ? 'checked' : '' ?>>
                                                <label for="submenu_<?= $submenu['menu_id'] ?>" class="ml-2 text-gray-600"><?= htmlspecialchars($submenu['name']) ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>

                        <br>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="akses-menu" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Batal</a>

                            <!-- Save Button with Spinner -->
                            <button type="submit" class="ml-2 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-yellow-400 h-full">
                                <span id="btnText">Simpan</span> <!-- Teks tombol -->
                                <svg id="loadingSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white bg-yellow-500 hover:bg-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>
<script>
    function saveMenuData() {
        const name = document.getElementById("name");
        const number = document.getElementById("number");
        const approval = document.getElementById("approval");
        const status = document.getElementById("status");
        const accessibleMenus = document.getElementById("accessible_menus");

        // Button & Spinner Elements
        const saveBtn = document.querySelector("button[type='submit']");
        const loadingSpinner = document.getElementById("loadingSpinner");
        const btnText = document.getElementById("btnText");

        // Validate Form Fields
        if (!name.value || !number.value || !approval.value || !status.value || accessibleMenus.selectedOptions.length === 0) {
            alert("Semua field harus diisi!");
            return;
        }

        // Disabling the button and showing the loading spinner
        saveBtn.disabled = true;
        btnText.style.display = 'none';
        loadingSpinner.style.display = 'inline-block';

        // Simulating Data Submission
        setTimeout(() => {
            alert('Data berhasil disimpan!');
            // Reset button and hide the spinner
            loadingSpinner.style.display = 'none';
            btnText.style.display = 'inline';
            saveBtn.disabled = false;

            // Optionally redirect to another page or reload
            window.location.href = 'akses-menu'; // Redirect back to the list page
        }, 3000); // Simulated 3 second delay
    }
</script>
<?php include 'footer.php'; ?>