<?php

include 'header.php';

// Fungsi untuk menghasilkan UUID
function generateUUID()
{
    return uniqid(true); // Menghasilkan UUID berbasis waktu
}

// Data menu dengan UUID sebagai menu_id
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
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440012',
        'name' => 'BMP',
        'parent_id' => null,
        'url' => '#',
        'icon' => 'fa-warehouse',
        'order' => 6,
        'visibility' => 'All',
        'columns' => ['judul', 'deskripsi', 'status'],
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440013',
                'name' => 'Perawatan',
                'parent_id' => 13,
                'url' => 'perawatan',
                'icon' => 'fa-tools',
                'order' => 1,
                'visibility' => 'All',
                'columns' => ['id_kegiatan', 'nama_alat', 'biaya'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440014',
                'name' => 'Produksi',
                'parent_id' => 13,
                'url' => 'produksi',
                'icon' => 'fa-cogs',
                'order' => 2,
                'visibility' => 'All',
                'columns' => ['jenis_produk', 'jumlah', 'lokasi'],
            ]
        ]
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440015',
        'name' => 'K3',
        'parent_id' => null,
        'url' => '#',
        'icon' => 'fa-user-shield',
        'order' => 7,
        'visibility' => 'All',
        'columns' => ['judul_insiden', 'lokasi', 'tanggal'],
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440016',
                'name' => 'Limbah',
                'parent_id' => 16,
                'url' => 'limbah',
                'icon' => 'fa-trash-alt',
                'order' => 1,
                'visibility' => 'All',
                'columns' => ['jenis_limbah', 'volume', 'penanganan'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440017',
                'name' => 'Kecelakaan Kerja',
                'parent_id' => 16,
                'url' => 'keselamatan',
                'icon' => 'fa-exclamation-triangle',
                'order' => 2,
                'visibility' => 'All',
                'columns' => ['jenis_kecelakaan', 'korban', 'penyebab'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440018',
                'name' => 'Safety Awareness',
                'parent_id' => 16,
                'url' => 'safety-awareness',
                'icon' => 'fa-hand-holding-heart',
                'order' => 3,
                'visibility' => 'All',
                'columns' => ['tema', 'jumlah_peserta', 'materi'],
            ]
        ]
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440019',
        'name' => 'ICS',
        'parent_id' => null,
        'url' => '#',
        'icon' => 'fa-users',
        'order' => 8,
        'visibility' => 'All',
        'columns' => ['nama_program', 'periode', 'status'],
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440020',
                'name' => 'List Data',
                'parent_id' => 20,
                'url' => 'ics',
                'icon' => 'fa-list',
                'order' => 1,
                'visibility' => 'All',
                'columns' => ['id', 'nama', 'status'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440021',
                'name' => 'Galery',
                'parent_id' => 20,
                'url' => 'analitik',
                'icon' => 'fa-image',
                'order' => 2,
                'visibility' => 'All',
                'columns' => ['gambar', 'judul', 'keterangan'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440022',
                'name' => 'Fasilitas',
                'parent_id' => 20,
                'url' => 'fasilitas',
                'icon' => 'fa-cogs',
                'order' => 3,
                'visibility' => 'All',
                'columns' => ['nama_fasilitas', 'jumlah', 'lokasi'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440023',
                'name' => 'Organisasi',
                'parent_id' => 20,
                'url' => 'organisasi',
                'icon' => 'fa-university',
                'order' => 4,
                'visibility' => 'All',
                'columns' => ['nama_organisasi', 'struktur', 'fungsi'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440024',
                'name' => 'Pelatihan',
                'parent_id' => 20,
                'url' => 'pelatihan',
                'icon' => 'fa-chalkboard-teacher',
                'order' => 5,
                'visibility' => 'All',
                'columns' => ['topik', 'peserta', 'pemateri'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440025',
                'name' => 'Aktivity',
                'parent_id' => 20,
                'url' => 'aktivitas',
                'icon' => 'fa-running',
                'order' => 6,
                'visibility' => 'All',
                'columns' => ['nama_aktivitas', 'waktu', 'output'],
            ]
        ]
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440026',
        'name' => 'User Management',
        'parent_id' => null,
        'url' => '#',
        'icon' => 'fa-users-cog',
        'order' => 9,
        'visibility' => 'Super Admin',
        'columns' => ['username', 'email', 'role'],
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440027',
                'name' => 'User',
                'parent_id' => 27,
                'url' => 'user',
                'icon' => 'fa-user',
                'order' => 1,
                'visibility' => 'Super Admin',
                'columns' => ['nama_user', 'akses', 'status'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440028',
                'name' => 'User Log',
                'parent_id' => 27,
                'url' => 'user-log',
                'icon' => 'fa-file-alt',
                'order' => 2,
                'visibility' => 'Super Admin',
                'columns' => ['tanggal', 'aktivitas', 'ip_address'],
            ]
        ]
    ],
    [
        'menu_id' => '550e8400-e29b-41d4-a716-446655440029',
        'name' => 'System Admin',
        'parent_id' => null,
        'url' => '#',
        'icon' => 'fa-cogs',
        'order' => 10,
        'visibility' => 'Super Admin',
        'columns' => ['setting', 'value', 'status'],
        'submenus' => [
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440030',
                'name' => 'Menu',
                'parent_id' => 30,
                'url' => 'menu',
                'icon' => 'fa-bars',
                'order' => 1,
                'visibility' => 'Super Admin',
                'columns' => ['judul_menu', 'icon', 'urutan'],
            ],
            [
                'menu_id' => '550e8400-e29b-41d4-a716-446655440031',
                'name' => 'Akses Menu',
                'parent_id' => 30,
                'url' => 'akses-menu',
                'icon' => 'fa-key',
                'order' => 2,
                'visibility' => 'Super Admin',
                'columns' => ['role', 'menu', 'izin'],
            ]
        ]
    ]
];


// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$menu_id = isset($_GET['id']) ? $_GET['id'] : '';

// Simulasi data farmer yang dipilih
$menu = null;
foreach ($dummyMenus as $dummyMenu) {
    if ($dummyMenu['menu_id'] == $menu_id) {
        $menu = $dummyMenu;
        break;
    }

    // Jika menu memiliki submenus, cari di dalam submenu
    if (isset($dummyMenu['submenus'])) {
        foreach ($dummyMenu['submenus'] as $submenu) {
            if ($submenu['menu_id'] == $menu_id) {
                $menu = $submenu;
                break;
            }
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
                if ($action == 'add') echo "Tambah Menu Baru";
                elseif ($action == 'view') echo "Profil Menu: " . ($menu ? htmlspecialchars($menu['name']) : '');
                elseif ($action == 'edit') echo "Edit Menu: " . ($menu ? htmlspecialchars($menu['name']) : '');
                else echo "Data Menu";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="menu?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
                    <i class="fas fa-plus mr-2"></i> Tambah Menu
                </a>
            <?php elseif ($action == 'edit'): ?>
                <a href="menu" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center hidden">
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyMenus as $menu): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($menu['name']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($menu['url']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <i class="fas <?= htmlspecialchars($menu['icon']) ?>"></i>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?= ($menu['parent_id'] == null ? 'Master Menu' : 'Submenu') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($menu['order']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="menu?action=edit&id=<?= htmlspecialchars($menu['menu_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('<?= htmlspecialchars($menu['menu_id']) ?>')" class="text-red-600 hover:text-red-900 hidden" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php if (isset($menu['submenus'])): ?>
                                    <?php foreach ($menu['submenus'] as $submenu): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap pl-14"><?= htmlspecialchars($submenu['name']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($submenu['url']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                -
                                                <i class="fas <?= htmlspecialchars($submenu['icon']) ?> hidden"></i>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?= ($submenu['parent_id'] == null ? 'Master Menu' : 'Submenu') ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($submenu['order']) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="menu?action=edit&id=<?= htmlspecialchars($submenu['menu_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete('<?= htmlspecialchars($submenu['menu_id']) ?>')" class="text-red-600 hover:text-red-900 hidden" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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

                        <!-- Menu Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Menu <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $action == 'edit' ? htmlspecialchars($menu['name']) : '' ?>">
                        </div>

                        <!-- Link -->
                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700">Link <span class="text-red-500">*</span></label>
                            <input type="text" id="url" name="url" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $action == 'edit' ? htmlspecialchars($menu['url']) : '' ?>">
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700">Icon <span class="text-red-500">*</span></label>
                            <input type="text" id="icon" name="icon" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $action == 'edit' ? htmlspecialchars($menu['icon']) : '' ?>">
                        </div>

                        <!-- Tipe -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Tipe <span class="text-red-500">*</span></label>
                            <select id="type" name="type" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="master" <?= $action == 'edit' && $menu['parent_id'] == null ? 'selected' : '' ?>>Master Menu</option>
                                <option value="submenu" <?= $action == 'edit' && $menu['parent_id'] != null ? 'selected' : '' ?>>Submenu</option>
                            </select>
                        </div>

                        <!-- Menu Induk -->
                        <div id="parentMenuWrapper" style="display: none;">
                            <label for="parent_id" class="block text-sm font-medium text-gray-700">Menu Induk <span class="text-red-500">*</span></label>
                            <select id="parent_id" name="parent_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <?php foreach ($dummyMenus as $parentMenu): ?>
                                    <?php if ($parentMenu['parent_id'] == null): ?>
                                        <option value="<?= $parentMenu['menu_id'] ?>" <?= $action == 'edit' && $parentMenu['menu_id'] == $menu['parent_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($parentMenu['name']) ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Order -->
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700">Urutan <span class="text-red-500">*</span></label>
                            <input type="number" id="order" name="order" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $action == 'edit' ? htmlspecialchars($menu['order']) : '' ?>">
                        </div>

                        <!-- Kolom Tabel (Dinamis) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kolom Tabel <span class="text-red-500">*</span></label>

                            <!-- Wrapper untuk semua input kolom -->
                            <div id="kolomTableWrapper" class="space-y-2 mt-1">
                                <?php if ($action == 'edit' && isset($menu['columns']) && is_array($menu['columns'])): ?>
                                    <?php foreach ($menu['columns'] as $column): ?>
                                        <div class="flex gap-2 items-center">
                                            <input type="text" name="kolom_table[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Nama Kolom" value="<?= htmlspecialchars($column) ?>">
                                            <button type="button" onclick="removeKolomInput(this)" class="text-red-500 font-bold text-xl px-2">×</button>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <!-- Jika bukan edit atau kolom kosong -->
                                    <div class="flex gap-2 items-center">
                                        <input type="text" name="kolom_table[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Nama Kolom">
                                        <button type="button" onclick="removeKolomInput(this)" class="text-red-500 font-bold text-xl px-2">×</button>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Tombol tambah input -->
                            <button type="button" onclick="addKolomInput()" class="mt-2 text-sm text-blue-600 hover:underline">+ Tambah Kolom</button>
                        </div>

                        <br>

                        <div class="flex justify-end space-x-3">
                            <a href="menu" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>

                            <!-- Save Button with Loading Spinner -->
                            <button type="button" id="saveMenuBtn" onclick="saveMenuData()" class="ml-2 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-yellow-400 h-full">
                                <span id="btnMenuText">Simpan</span> <!-- Button text -->
                                <svg id="loadingMenuSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white bg-yellow-500 hover:bg-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    function addKolomInput() {
        const wrapper = document.getElementById('kolomTableWrapper');
        const div = document.createElement('div');
        div.className = 'flex gap-2 items-center';

        div.innerHTML = `
            <input type="text" name="kolom_table[]" class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nama Kolom">
            <button type="button" onclick="removeKolomInput(this)" class="text-red-500 font-bold text-xl px-2">×</button>
        `;

        wrapper.appendChild(div);
    }

    function removeKolomInput(button) {
        const wrapper = document.getElementById('kolomTableWrapper');

        // Opsional: jika semua baris dihapus, tambahkan otomatis satu baris kosong
        if (wrapper.children.length > 1) {
            button.parentNode.remove();
        }
    }

    function saveMenuData() {
        const name = document.getElementById("name");
        const url = document.getElementById("url");
        const icon = document.getElementById("icon");
        const type = document.getElementById("type");
        const order = document.getElementById("order");

        // Button & Spinner Elements
        const saveBtn = document.getElementById("saveMenuBtn");
        const loadingSpinner = document.getElementById("loadingMenuSpinner");
        const btnText = document.getElementById("btnMenuText");

        // Validation
        if (!name.value) {
            showSweetAlert('error', 'Form Gagal', 'Nama Menu harus diisi.', false, '');
            return;
        }

        if (!url.value) {
            showSweetAlert('error', 'Form Gagal', 'Link Menu harus diisi.', false, '');
            return;
        }

        if (!icon.value) {
            showSweetAlert('error', 'Form Gagal', 'Icon Menu harus diisi.', false, '');
            return;
        }

        if (!type.value) {
            showSweetAlert('error', 'Form Gagal', 'Tipe Menu harus dipilih.', false, '');
            return;
        }

        if (!order.value) {
            showSweetAlert('error', 'Form Gagal', 'Urutan Menu harus diisi.', false, '');
            return;
        }

        // Disabling button and showing spinner
        saveBtn.disabled = true;
        btnText.style.display = 'none'; // Hide button text
        loadingSpinner.style.display = 'inline-block'; // Show loading spinner

        // Simulate data upload with setTimeout
        setTimeout(() => {
            // Data uploaded successfully
            showSweetAlert('success', 'Berhasil Disimpan', 'Menu berhasil disimpan ke dalam database.', true, 'menu');

            // Hiding the spinner and re-enabling the button
            loadingSpinner.style.display = 'none';
            btnText.style.display = 'inline'; // Show button text again
            saveBtn.disabled = false; // Enable button again

            // Redirect after a delay
            setTimeout(() => {
                window.location.href = 'menu'; // Redirect to the menu page
            }, 2000); // Redirect after 2 seconds
        }, 3000); // Simulated upload time (3 seconds)
    }

    document.addEventListener("DOMContentLoaded", function() {
        const typeSelect = document.getElementById("type");
        const parentMenuWrapper = document.getElementById("parentMenuWrapper");
        // const urlInput = document.getElementById("url");

        function toggleSubmenuOptions() {
            if (typeSelect.value === "submenu") {
                parentMenuWrapper.style.display = "block";
                // urlInput.value = "#";
                // urlInput.setAttribute("disabled", true);
            } else {
                parentMenuWrapper.style.display = "none";
                // urlInput.removeAttribute("disabled");
                // urlInput.value = "";
            }
        }

        typeSelect.addEventListener("change", toggleSubmenuOptions);

        // Trigger on load (edit mode)
        toggleSubmenuOptions();
    });
</script>
<?php include 'footer.php'; ?>