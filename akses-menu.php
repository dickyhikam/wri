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
        'accessible_menus' => [ // semua menu & submenu
            '550e8400-e29b-41d4-a716-446655440000',
            '550e8400-e29b-41d4-a716-446655440001',
            '550e8400-e29b-41d4-a716-446655440002',
            '550e8400-e29b-41d4-a716-446655440003',
            '550e8400-e29b-41d4-a716-446655440004',
            '550e8400-e29b-41d4-a716-446655440005',
            '550e8400-e29b-41d4-a716-446655440006',
            '550e8400-e29b-41d4-a716-446655440007',
            '550e8400-e29b-41d4-a716-446655440008',
            '550e8400-e29b-41d4-a716-446655440009',
            '550e8400-e29b-41d4-a716-446655440010',
            '550e8400-e29b-41d4-a716-446655440011',
        ],
        'accessible_columns' => [
            '550e8400-e29b-41d4-a716-446655440003' => ['nama_petani', 'nik', 'alamat'],
            '550e8400-e29b-41d4-a716-446655440000' => ['judul', 'status'],
            '550e8400-e29b-41d4-a716-446655440011' => ['tanggal', 'produk'],
        ]
    ],
    [
        'role_id' => 2,
        'name' => 'Admin',
        'number' => 2,
        'approval' => 'Tidak',
        'status' => 'Inactive',
        'accessible_menus' => [
            '550e8400-e29b-41d4-a716-446655440000',
            '550e8400-e29b-41d4-a716-446655440003',
            '550e8400-e29b-41d4-a716-446655440004',
        ],
        'accessible_columns' => [
            '550e8400-e29b-41d4-a716-446655440003' => ['nama_petani', 'telepon'],
            '550e8400-e29b-41d4-a716-446655440004' => ['id_lahan', 'luas'],
        ]
    ],
    [
        'role_id' => 3,
        'name' => 'User',
        'number' => 3,
        'approval' => 'Tidak',
        'status' => 'Active',
        'accessible_menus' => [
            '550e8400-e29b-41d4-a716-446655440003',
        ],
        'accessible_columns' => [
            '550e8400-e29b-41d4-a716-446655440003' => ['nama_petani'],
        ]
    ],
    [
        'role_id' => 4,
        'name' => 'Editor',
        'number' => 4,
        'approval' => 'Tidak',
        'status' => 'Active',
        'accessible_menus' => [
            '550e8400-e29b-41d4-a716-446655440000',
            '550e8400-e29b-41d4-a716-446655440011',
        ],
        'accessible_columns' => [
            '550e8400-e29b-41d4-a716-446655440000' => ['judul'],
            '550e8400-e29b-41d4-a716-446655440011' => ['produk', 'volume'],
        ]
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
        'columns' => ['judul', 'status', 'tanggal'],
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440001',
                'name' => 'Menu',
                'parent_id' => 1,
                'url' => 'role',
                'icon' => 'fa-cogs',
                'order' => 1,
                'visibility' => 'Super Admin',
                'columns' => ['kode_menu', 'nama_menu', 'icon'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440002',
                'name' => 'Parcel Data',
                'parent_id' => 1,
                'url' => 'parcel',
                'icon' => 'fa-box',
                'order' => 2,
                'visibility' => 'Super Admin',
                'columns' => ['kode_parcel', 'lokasi', 'luas'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440003',
                'name' => 'Petani',
                'parent_id' => 1,
                'url' => 'petani',
                'icon' => 'fa-users',
                'order' => 3,
                'visibility' => 'All',
                'columns' => ['nama_petani', 'nik', 'alamat', 'telepon'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440004',
                'name' => 'Lahan/Persil',
                'parent_id' => 1,
                'url' => 'lahan',
                'icon' => 'fa-map-marker-alt',
                'order' => 4,
                'visibility' => 'All',
                'columns' => ['id_lahan', 'lokasi', 'luas'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440005',
                'name' => 'Pekerja',
                'parent_id' => 1,
                'url' => 'pekerja',
                'icon' => 'fa-users',
                'order' => 5,
                'visibility' => 'All',
                'columns' => ['nama', 'jabatan', 'kontak'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440006',
                'name' => 'Mitra & Organisasi',
                'parent_id' => 1,
                'url' => 'mitra',
                'icon' => 'fa-handshake',
                'order' => 6,
                'visibility' => 'All',
                'columns' => ['nama_mitra', 'jenis', 'wilayah'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440007',
                'name' => 'Kelompok Tani',
                'parent_id' => 1,
                'url' => 'kelompok_tani',
                'icon' => 'fa-users',
                'order' => 7,
                'visibility' => 'All',
                'columns' => ['nama_kelompok', 'jumlah_anggota', 'desa'],
            ]
        ]
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440008',
        'name' => 'WorkPlan',
        'parent_id' => null,
        'url' => 'workplan',
        'icon' => 'fa-project-diagram',
        'order' => 2,
        'visibility' => 'All',
        'columns' => ['pekerjaan', 'tanggal_mulai', 'tanggal_selesai'],
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440009',
        'name' => 'Audit',
        'parent_id' => null,
        'url' => 'sertifikasi',
        'icon' => 'fa-user-secret',
        'order' => 3,
        'visibility' => 'All',
        'columns' => ['tanggal_audit', 'auditor', 'hasil'],
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440010',
        'name' => 'HCV',
        'parent_id' => null,
        'url' => 'nkt',
        'icon' => 'fa-chart-line',
        'order' => 4,
        'visibility' => 'All',
        'columns' => ['lokasi', 'kategori_hcv', 'luas_area'],
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440011',
        'name' => 'Transaksi Produksi',
        'parent_id' => null,
        'url' => 'transaksi',
        'icon' => 'fa-sack-dollar',
        'order' => 5,
        'visibility' => 'All',
        'columns' => ['tanggal', 'produk', 'volume', 'harga'],
    ],
];

// Fungsi untuk mendapatkan menu berdasarkan role
function findMenuById($menuId, $menus)
{
    foreach ($menus as $menu) {
        if ($menu['menu_id'] === $menuId) {
            return $menu;
        }
        if (!empty($menu['submenus'])) {
            foreach ($menu['submenus'] as $submenu) {
                if ($submenu['menu_id'] === $menuId) {
                    return $submenu;
                }
            }
        }
    }
    return null;
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kolom Tabel yang Dapat Diakses</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyRoles as $role): ?>
                                <tr>
                                    <!-- Kolom Role -->
                                    <td class="px-6 py-4 font-semibold text-gray-800"><?= htmlspecialchars($role['name']) ?></td>

                                    <!-- Kolom Menu -->
                                    <td class="px-6 py-4 align-top">
                                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                                            <?php foreach ($role['accessible_menus'] ?? [] as $menuId): ?>
                                                <?php $menu = findMenuById($menuId, $dummyMenus); ?>
                                                <?php if ($menu): ?>
                                                    <li><?= htmlspecialchars($menu['name']) ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>

                                    <!-- Kolom Tabel -->
                                    <td class="px-6 py-4 align-top">
                                        <ul class="list-none space-y-2 text-sm">
                                            <?php foreach ($role['accessible_columns'] ?? [] as $menuId => $columns): ?>
                                                <?php $menu = findMenuById($menuId, $dummyMenus); ?>
                                                <?php if ($menu): ?>
                                                    <li>
                                                        <span class="font-medium text-gray-700"><?= htmlspecialchars($menu['name']) ?>:</span>
                                                        <span class="text-gray-600"><?= implode(', ', array_map('htmlspecialchars', $columns)) ?></span>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <a href="akses-menu?action=edit&id=<?= $role['role_id'] ?>"
                                            class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
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
                                <table class="w-full table-auto border border-collapse border-gray-300 text-sm">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="border p-2 text-left">Menu / Submenu</th>
                                            <th class="border p-2 text-center">Akses Menu</th>
                                            <th class="border p-2 text-left">Kolom Tabel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dummyMenus as $menu): ?>
                                            <!-- Menu Utama -->
                                            <tr class="border-t">
                                                <td class="border p-2 font-semibold text-gray-800"><?= htmlspecialchars($menu['name']) ?></td>
                                                <td class="border p-2 text-center">
                                                    <input type="checkbox" id="menu_<?= $menu['menu_id'] ?>" class="menu-checkbox" name="accessible_menus[]" value="<?= $menu['menu_id'] ?>" data-menu-id="<?= $menu['menu_id'] ?>" <?= ($action == 'edit' && in_array($menu['menu_id'], $role['accessible_menus'] ?? [])) ? 'checked' : '' ?>>
                                                </td>
                                                <td class="border p-2">
                                                    <?php if (!empty($menu['columns'])): ?>
                                                        <?php foreach ($menu['columns'] as $column): ?>
                                                            <label class="inline-flex items-center mr-4">
                                                                <input type="checkbox"
                                                                    name="accessible_columns[<?= $menu['menu_id'] ?>][]"
                                                                    value="<?= $column ?>"
                                                                    <?= ($action == 'edit' && in_array($column, $role['accessible_columns'][$menu['menu_id']] ?? [])) ? 'checked' : '' ?>>
                                                                <span class="ml-1"><?= htmlspecialchars($column) ?></span>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <!-- Submenu -->
                                            <?php if (isset($menu['submenus'])): ?>
                                                <?php foreach ($menu['submenus'] as $submenu): ?>
                                                    <tr class="border-t bg-gray-50">
                                                        <td class="border p-2 pl-6 text-gray-700">└─ <?= htmlspecialchars($submenu['name']) ?></td>
                                                        <td class="border p-2 text-center">
                                                            <input type="checkbox" id="submenu_<?= $submenu['menu_id'] ?>" class="submenu-checkbox" name="accessible_menus[]" value="<?= $submenu['menu_id'] ?>" data-parent="<?= $menu['menu_id'] ?>" <?= ($action == 'edit' && in_array($submenu['menu_id'], $role['accessible_menus'] ?? [])) ? 'checked' : '' ?>>
                                                        </td>
                                                        <td class="border p-2">
                                                            <?php if (!empty($submenu['columns'])): ?>
                                                                <?php foreach ($submenu['columns'] as $column): ?>
                                                                    <label class="inline-flex items-center mr-4">
                                                                        <input type="checkbox"
                                                                            name="accessible_columns[<?= $submenu['menu_id'] ?>][]"
                                                                            value="<?= $column ?>"
                                                                            <?= ($action == 'edit' && in_array($column, $role['accessible_columns'][$submenu['menu_id']] ?? [])) ? 'checked' : '' ?>>
                                                                        <span class="ml-1"><?= htmlspecialchars($column) ?></span>
                                                                    </label>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

    document.addEventListener('DOMContentLoaded', function() {
        const menuCheckboxes = document.querySelectorAll('.menu-checkbox');
        const submenuCheckboxes = document.querySelectorAll('.submenu-checkbox');

        // SUBMENU → Check/Uncheck parent
        submenuCheckboxes.forEach(submenu => {
            submenu.addEventListener('change', function() {
                const parentId = this.dataset.parent;
                const parentCheckbox = document.querySelector(`#menu_${parentId}`);

                if (this.checked) {
                    parentCheckbox.checked = true;
                } else {
                    const siblings = document.querySelectorAll(`.submenu-checkbox[data-parent="${parentId}"]`);
                    const allUnchecked = Array.from(siblings).every(sib => !sib.checked);
                    if (allUnchecked && parentCheckbox) {
                        parentCheckbox.checked = false;
                    }
                }
            });
        });

        // PARENT → Uncheck all children
        menuCheckboxes.forEach(menu => {
            menu.addEventListener('change', function() {
                const menuId = this.dataset.menuId;
                const children = document.querySelectorAll(`.submenu-checkbox[data-parent="${menuId}"]`);
                children.forEach(child => {
                    child.checked = this.checked;
                });

                // Opsional: uncheck juga kolom kolom menu induk
                if (!this.checked) {
                    // uncheck all related column checkboxes (menu columns)
                    const columnCheckboxes = document.querySelectorAll(`input[name^="accessible_columns[${menuId}]"]`);
                    columnCheckboxes.forEach(cb => cb.checked = false);
                }
            });
        });
    });
</script>
<?php include 'footer.php'; ?>