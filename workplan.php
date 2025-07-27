<?php include 'header.php'; ?>
<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <!-- Welcome Banner -->
    <div>
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold mb-2">Workplan Tracker System</h2>
            </div>
        </div>
    </div>
    
    <!-- Notification -->
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert" style="display: none;" id="notification">
        <span class="block sm:inline" id="notification-message"></span>
    </div>
    
    <!-- Determine current page -->
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'activities';
    $action = isset($_GET['action']) ? $_GET['action'] : 'list';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    // Sample data for activities (parent and child)
    $activities = [
        'ACT-001' => [
            'id' => 'ACT-001',
            'name' => 'Persiapan Proyek',
            'type' => 'parent',
            'description' => 'Aktivitas utama persiapan proyek',
            'status' => 'active',
            'created_at' => '2023-01-10 08:30:00'
        ],
        'ACT-001-1' => [
            'id' => 'ACT-001-1',
            'name' => 'Pembuatan Dokumen Proyek',
            'type' => 'child',
            'parent_id' => 'ACT-001',
            'description' => 'Membuat dokumen awal proyek',
            'status' => 'active',
            'created_at' => '2023-01-12 10:15:00'
        ],
        'ACT-001-2' => [
            'id' => 'ACT-001-2',
            'name' => 'Koordinasi Tim',
            'type' => 'child',
            'parent_id' => 'ACT-001',
            'description' => 'Koordinasi dengan tim proyek',
            'status' => 'active',
            'created_at' => '2023-01-12 11:30:00'
        ],
        'ACT-002' => [
            'id' => 'ACT-002',
            'name' => 'Implementasi Sistem',
            'type' => 'parent',
            'description' => 'Aktivitas implementasi sistem utama',
            'status' => 'active',
            'created_at' => '2023-01-15 09:00:00'
        ]
    ];

    // Sample data for progress input (linked to child activities)
    $progress = [
        'PRG-001' => [
            'id' => 'PRG-001',
            'child_activity_id' => 'ACT-001-1',
            'month' => '2023-01',
            'monthly_progress' => 20,
            'total_progress' => 20,
            'remark' => 'Persiapan awal',
            'created_at' => '2023-01-15 09:30:00'
        ],
        'PRG-002' => [
            'id' => 'PRG-002',
            'child_activity_id' => 'ACT-001-1',
            'month' => '2023-02',
            'monthly_progress' => 35,
            'total_progress' => 55,
            'remark' => 'Penyelesaian dokumen',
            'created_at' => '2023-02-05 11:20:00'
        ],
        'PRG-003' => [
            'id' => 'PRG-003',
            'child_activity_id' => 'ACT-001-2',
            'month' => '2023-02',
            'monthly_progress' => 15,
            'total_progress' => 15,
            'remark' => 'Analisis kebutuhan',
            'created_at' => '2023-02-10 14:45:00'
        ]
    ];

    // Sample data for tracker (aggregates progress for parent activities)
    $trackers = [
        'WPT-001' => [
            'id' => 'WPT-001',
            'parent_activity_id' => 'ACT-001',
            'name' => 'Proyek Pembangunan Sistem',
            'start_date' => '2023-01-15',
            'end_date' => '2023-06-30',
            'remark' => 'Sistem monitoring',
            'created_at' => '2023-01-10 14:20:00'
        ],
        'WPT-002' => [
            'id' => 'WPT-002',
            'parent_activity_id' => 'ACT-002',
            'name' => 'Proyek Pengembangan Aplikasi',
            'start_date' => '2023-02-01',
            'end_date' => '2023-08-31',
            'remark' => 'Aplikasi mobile',
            'created_at' => '2023-01-20 10:15:00'
        ]
    ];
    
    // Pagination configuration
    $perPage = 5;
    $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $currentPage = max(1, $currentPage);
    
    // Filter variables
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    $statusFilter = isset($_GET['status_filter']) ? $_GET['status_filter'] : '';
    $typeFilter = isset($_GET['type_filter']) ? $_GET['type_filter'] : '';
    ?>
    
    <!-- Navigation Tabs -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-100">
        <nav class="flex space-x-4" aria-label="Tabs">
            <a href="?page=activities&action=list" class="<?= ($page == 'activities') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Daftar Aktivitas
            </a>
            <a href="?page=progress&action=list" class="<?= ($page == 'progress') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Input Progress
            </a>
            <a href="?page=trackers&action=list" class="<?= ($page == 'trackers') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Workplan Tracker
            </a>
        </nav>
    </div>

    <!-- Activities Section -->
    <?php if ($page == 'activities'): ?>
        <?php if ($action == 'list'): ?>
            <!-- Activities List -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Daftar Aktivitas</h2>
                    <div class="flex space-x-2">
                        <a href="?page=activities&action=create&type=parent" class="px-4 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#d69500] focus:outline-none focus:ring-2 focus:ring-[#F0AB00] flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Parent
                        </a>
                        <a href="?page=activities&action=create&type=child" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Child
                        </a>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="page" value="activities">
                        <input type="hidden" name="action" value="list">

                        <!-- Global Search -->
                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Cari ID/Nama Aktivitas..."
                                value="<?= htmlspecialchars($searchTerm) ?>">
                        </div>

                        <!-- Additional Filters -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <select name="status_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="active" <?= $statusFilter === 'active' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="inactive" <?= $statusFilter === 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                            <div>
                                <select name="type_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Tipe</option>
                                    <option value="parent" <?= $typeFilter === 'parent' ? 'selected' : '' ?>>Parent</option>
                                    <option value="child" <?= $typeFilter === 'child' ? 'selected' : '' ?>>Child</option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Aktivitas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            // Apply filters
                            $filteredActivities = $activities;
                            if ($searchTerm !== '') {
                                $filteredActivities = array_filter($filteredActivities, function($activity) use ($searchTerm) {
                                    return stripos($activity['id'], $searchTerm) !== false || 
                                           stripos($activity['name'], $searchTerm) !== false;
                                });
                            }
                            
                            if ($statusFilter !== '') {
                                $filteredActivities = array_filter($filteredActivities, function($activity) use ($statusFilter) {
                                    return $activity['status'] === $statusFilter;
                                });
                            }
                            
                            if ($typeFilter !== '') {
                                $filteredActivities = array_filter($filteredActivities, function($activity) use ($typeFilter) {
                                    return $activity['type'] === $typeFilter;
                                });
                            }
                            
                            $totalItems = count($filteredActivities);
                            $totalPages = ceil($totalItems / $perPage);
                            $currentPage = min($currentPage, $totalPages);
                            $offset = ($currentPage - 1) * $perPage;
                            $currentPageData = array_slice($filteredActivities, $offset, $perPage);
                            
                            if (empty($currentPageData)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada data ditemukan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($currentPageData as $activity): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $activity['id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?= $activity['name'] ?></div>
                                        <div class="text-sm text-gray-500"><?= substr($activity['description'], 0, 50) ?>...</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            <?= $activity['type'] == 'parent' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?>">
                                            <?= ucfirst($activity['type']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= isset($activity['parent_id']) ? $activity['parent_id'] : '-' ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            <?= $activity['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                            <?= $activity['status'] == 'active' ? 'Aktif' : 'Nonaktif' ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="?page=activities&action=view&id=<?= $activity['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="?page=activities&action=edit&id=<?= $activity['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('activity', '<?= $activity['id'] ?>')" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => max(1, $currentPage - 1)])) ?>"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => min($totalPages, $currentPage + 1)])) ?>"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium"><?= $offset + 1 ?></span>
                                sampai
                                <span class="font-medium"><?= min($offset + $perPage, $totalItems) ?></span>
                                dari
                                <span class="font-medium"><?= $totalItems ?></span>
                                data
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => max(1, $currentPage - 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                                <?php
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);

                                if ($startPage > 1) {
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $activeClass = ($i == $currentPage) ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $activeClass . '">' . $i . '</a>';
                                }

                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>

                                <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => min($totalPages, $currentPage + 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($action == 'create'): ?>
            <!-- Create Activity Form -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <h2 class="text-2xl font-bold mb-6">Tambah Aktivitas <?= isset($_GET['type']) && $_GET['type'] == 'parent' ? 'Parent' : 'Child' ?></h2>
                <form id="activity-form">
                    <input type="hidden" name="type" value="<?= isset($_GET['type']) ? $_GET['type'] : 'parent' ?>">
                    <div class="grid grid-cols-1 gap-6">
                        <?php if (isset($_GET['type']) && $_GET['type'] == 'child'): ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Parent Activity</label>
                            <select name="parent_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Parent Activity</option>
                                <?php foreach ($activities as $act): ?>
                                    <?php if ($act['type'] == 'parent'): ?>
                                        <option value="<?= $act['id'] ?>"><?= $act['name'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aktivitas</label>
                            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="?page=activities&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Batal
                        </a>
                        <button type="button" onclick="submitForm('activity')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        <?php elseif ($action == 'edit' && $id && isset($activities[$id])): ?>
            <!-- Edit Activity Form -->
            <?php $activity = $activities[$id]; ?>
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <h2 class="text-2xl font-bold mb-6">Edit Aktivitas</h2>
                <form id="activity-form">
                    <input type="hidden" name="id" value="<?= $activity['id'] ?>">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Aktivitas</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100"
                                value="<?= ucfirst($activity['type']) ?> Activity" readonly>
                        </div>
                        <?php if ($activity['type'] == 'child'): ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Parent Activity</label>
                            <select name="parent_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Parent Activity</option>
                                <?php foreach ($activities as $act): ?>
                                    <?php if ($act['type'] == 'parent'): ?>
                                        <option value="<?= $act['id'] ?>" <?= ($act['id'] == $activity['parent_id']) ? 'selected' : '' ?>>
                                            <?= $act['name'] ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aktivitas</label>
                            <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $activity['name'] ?>" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $activity['description'] ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="active" <?= $activity['status'] == 'active' ? 'selected' : '' ?>>Aktif</option>
                                <option value="inactive" <?= $activity['status'] == 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="?page=activities&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Batal
                        </a>
                        <button type="button" onclick="submitForm('activity')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        <?php elseif ($action == 'view' && $id && isset($activities[$id])): ?>
            <!-- View Activity -->
            <?php $activity = $activities[$id]; ?>
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Detail Aktivitas</h2>
                    <div>
                        <a href="?page=activities&action=edit&id=<?= $activity['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg mr-2">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <a href="?page=activities&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">ID Aktivitas</p>
                        <p class="font-medium text-lg"><?= $activity['id'] ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nama Aktivitas</p>
                        <p class="font-medium text-lg"><?= $activity['name'] ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tipe</p>
                        <p class="font-medium">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                <?= $activity['type'] == 'parent' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' ?>">
                                <?= ucfirst($activity['type']) ?> Activity
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-medium">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                <?= $activity['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $activity['status'] == 'active' ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </p>
                    </div>
                    <?php if ($activity['type'] == 'child'): ?>
                    <div>
                        <p class="text-sm text-gray-500">Parent Activity</p>
                        <p class="font-medium"><?= $activity['parent_id'] ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Deskripsi</p>
                        <p class="font-medium"><?= $activity['description'] ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Dibuat</p>
                        <p class="font-medium"><?= date('d M Y H:i', strtotime($activity['created_at'])) ?></p>
                    </div>
                </div>
                <?php if ($activity['type'] == 'parent'): ?>
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Child Activities</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <?php
                        $hasChildren = false;
                        foreach ($activities as $act):
                            if ($act['type'] == 'child' && $act['parent_id'] == $activity['id']):
                                $hasChildren = true;
                        ?>
                        <div class="mb-4 pb-4 border-b border-gray-200 last:border-0 last:mb-0 last:pb-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium"><?= $act['name'] ?></p>
                                    <p class="text-sm text-gray-500"><?= $act['id'] ?></p>
                                </div>
                                <div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        <?= $act['status'] == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $act['status'] == 'active' ? 'Aktif' : 'Nonaktif' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                            endif;
                        endforeach;
                        if (!$hasChildren):
                        ?>
                        <p class="text-gray-500">Tidak ada child activity</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                 <?php if ($activity['type'] == 'child'): ?>
                 <div class="mt-8">
                     <h3 class="text-lg font-semibold mb-4">Progress Input</h3>
                     <div class="bg-gray-50 rounded-lg p-4">
                         <?php
                         $hasProgress = false;
                         foreach ($progress as $prog):
                             if ($prog['child_activity_id'] == $activity['id']):
                                 $hasProgress = true;
                         ?>
                         <div class="mb-4 pb-4 border-b border-gray-200 last:border-0 last:mb-0 last:pb-0">
                             <div class="flex justify-between items-center mb-2">
                                 <p class="font-medium"><?= date('F Y', strtotime($prog['month'].'-01')) ?></p>
                                 <div class="flex items-center">
                                     <span class="text-sm mr-2"><?= $prog['monthly_progress'] ?>% (bulanan)</span>
                                     <span class="text-sm"><?= $prog['total_progress'] ?>% (total)</span>
                                 </div>
                             </div>
                             <div class="flex space-x-2">
                                 <div class="w-full bg-gray-200 rounded-full h-2.5">
                                     <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $prog['monthly_progress'] ?>%"></div>
                                 </div>
                                 <div class="w-full bg-gray-200 rounded-full h-2.5">
                                     <div class="bg-green-600 h-2.5 rounded-full" style="width: <?= $prog['total_progress'] ?>%"></div>
                                 </div>
                             </div>
                             <?php if ($prog['remark']): ?>
                             <p class="text-sm text-gray-500 mt-2"><?= $prog['remark'] ?></p>
                             <?php endif; ?>
                         </div>
                         <?php
                             endif;
                         endforeach;
                         if (!$hasProgress):
                         ?>
                         <p class="text-gray-500">Belum ada progress</p>
                         <?php endif; ?>
                     </div>
                 </div>
                 <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">Aksi tidak valid atau aktivitas tidak ditemukan.</span>
            </div>
        <?php endif; ?>
    <!-- Progress Section -->
    <?php elseif ($page == 'progress'): ?>
        <?php if ($action == 'list'): ?>
            <!-- Progress List -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Daftar Progress</h2>
                    <a href="?page=progress&action=create" class="px-4 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#d69500] focus:outline-none focus:ring-2 focus:ring-[#F0AB00] flex items-center">
                        <i class="fas fa-plus mr-2"></i> Input Progress
                    </a>
                </div>

                <!-- Filter Section -->
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="page" value="progress">
                        <input type="hidden" name="action" value="list">

                        <!-- Global Search -->
                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Cari ID Progress/Child Activity..."
                                value="<?= htmlspecialchars($searchTerm) ?>">
                        </div>

                        <!-- Additional Filters -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <select name="child_activity_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Child Activity</option>
                                    <?php foreach ($activities as $act): ?>
                                        <?php if ($act['type'] == 'child'): ?>
                                            <option value="<?= $act['id'] ?>"><?= $act['name'] ?> (<?= $act['id'] ?>)</option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Child Activity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress Bulanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Input</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            // Apply filters
                            $filteredProgress = $progress;
                            if ($searchTerm !== '') {
                                $filteredProgress = array_filter($filteredProgress, function($prog) use ($searchTerm, $activities) {
                                    $childActivity = isset($prog['child_activity_id']) && isset($activities[$prog['child_activity_id']]) ? $activities[$prog['child_activity_id']] : null;
                                    return stripos($prog['id'], $searchTerm) !== false || 
                                           ($childActivity && stripos($childActivity['name'], $searchTerm) !== false);
                                });
                            }
                            
                            $totalItems = count($filteredProgress);
                            $totalPages = ceil($totalItems / $perPage);
                            $currentPage = min($currentPage, $totalPages);
                            $offset = ($currentPage - 1) * $perPage;
                            $currentPageData = array_slice($filteredProgress, $offset, $perPage);
                            
                            if (empty($currentPageData)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada data ditemukan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($currentPageData as $prog):
                                    $childActivity = isset($prog['child_activity_id']) && isset($activities[$prog['child_activity_id']]) ? $activities[$prog['child_activity_id']] : null;
                                ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= $childActivity ? $childActivity['name'] . ' (' . $childActivity['id'] . ')' : 'Child Activity tidak ditemukan' ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('F Y', strtotime($prog['month'].'-01')) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $prog['monthly_progress'] ?>%"></div>
                                        </div>
                                        <span class="mt-1 block"><?= $prog['monthly_progress'] ?>%</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: <?= $prog['total_progress'] ?>%"></div>
                                        </div>
                                        <span class="mt-1 block"><?= $prog['total_progress'] ?>%</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y', strtotime($prog['created_at'])) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="?page=progress&action=view&id=<?= $prog['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="?page=progress&action=edit&id=<?= $prog['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('progress', '<?= $prog['id'] ?>')" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => max(1, $currentPage - 1)])) ?>"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => min($totalPages, $currentPage + 1)])) ?>"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium"><?= $offset + 1 ?></span>
                                sampai
                                <span class="font-medium"><?= min($offset + $perPage, $totalItems) ?></span>
                                dari
                                <span class="font-medium"><?= $totalItems ?></span>
                                data
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => max(1, $currentPage - 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                                <?php
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);

                                if ($startPage > 1) {
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $activeClass = ($i == $currentPage) ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $activeClass . '">' . $i . '</a>';
                                }

                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>

                                <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => min($totalPages, $currentPage + 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($action == 'create'): ?>
            <!-- Create Progress Form -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <h2 class="text-2xl font-bold mb-6">Input Progress</h2>
                <form id="progress-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Child Activity</label>
                            <select name="child_activity_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Child Activity</option>
                                <?php foreach ($activities as $activity): ?>
                                    <?php if ($activity['type'] == 'child'): ?>
                                        <option value="<?= $activity['id'] ?>"><?= $activity['name'] ?> (<?= $activity['id'] ?>)</option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan/Tahun</label>
                            <input type="month" name="month" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Progress Bulanan (%)</label>
                            <input type="number" name="monthly_progress" min="0" max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Progress Total (%)</label>
                            <input type="number" name="total_progress" min="0" max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea name="remark" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="?page=progress&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Batal
                        </a>
                        <button type="button" onclick="submitForm('progress')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        <?php elseif ($action == 'edit' && $id && isset($progress[$id])): ?>
            <!-- Edit Progress Form -->
            <?php $prog = $progress[$id]; ?>
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <h2 class="text-2xl font-bold mb-6">Edit Progress</h2>
                <form id="progress-form">
                    <input type="hidden" name="id" value="<?= $prog['id'] ?>">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Child Activity</label>
                            <select name="child_activity_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Child Activity</option>
                                <?php foreach ($activities as $activity): ?>
                                    <?php if ($activity['type'] == 'child'): ?>
                                        <option value="<?= $activity['id'] ?>" <?= ($prog['child_activity_id'] == $activity['id']) ? 'selected' : '' ?>>
                                            <?= $activity['name'] ?> (<?= $activity['id'] ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan/Tahun</label>
                            <input type="month" name="month" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $prog['month'] ?>" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Progress Bulanan (%)</label>
                            <input type="number" name="monthly_progress" min="0" max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $prog['monthly_progress'] ?>" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Progress Total (%)</label>
                            <input type="number" name="total_progress" min="0" max="100"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                value="<?= $prog['total_progress'] ?>" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea name="remark" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $prog['remark'] ?></textarea>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="?page=progress&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            Batal
                        </a>
                        <button type="button" onclick="submitForm('progress')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        <?php elseif ($action == 'view' && $id && isset($progress[$id])): ?>
            <!-- View Progress Details -->
            <?php
            $prog = $progress[$id];
            $childActivity = isset($prog['child_activity_id']) && isset($activities[$prog['child_activity_id']]) ? $activities[$prog['child_activity_id']] : null;
            $parentActivity = $childActivity ? (isset($activities[$childActivity['parent_id']]) ? $activities[$childActivity['parent_id']] : null) : null;
            ?>
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Detail Progress</h2>
                    <div>
                        <a href="?page=progress&action=edit&id=<?= $prog['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg mr-2">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <a href="?page=progress&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">ID Progress</p>
                        <p class="font-medium text-lg"><?= $prog['id'] ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Child Activity</p>
                        <p class="font-medium text-lg"><?= $childActivity ? $childActivity['name'] . ' (' . $childActivity['id'] . ')' : 'Child Activity tidak ditemukan' ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Parent Activity</p>
                        <p class="font-medium"><?= $parentActivity ? $parentActivity['name'] . ' (' . $parentActivity['id'] . ')' : '-' ?></p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Bulan/Tahun</p>
                        <p class="font-medium"><?= date('F Y', strtotime($prog['month'].'-01')) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Input</p>
                        <p class="font-medium"><?= date('d M Y H:i', strtotime($prog['created_at'])) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Progress Bulanan</p>
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $prog['monthly_progress'] ?>%"></div>
                            </div>
                            <span class="font-medium"><?= $prog['monthly_progress'] ?>%</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Progress Total</p>
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: <?= $prog['total_progress'] ?>%"></div>
                            </div>
                            <span class="font-medium"><?= $prog['total_progress'] ?>%</span>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Keterangan</p>
                        <p class="font-medium"><?= $prog['remark'] ?: '-' ?></p>
                    </div>

                </div>
            </div>
        <?php else: ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">Aksi tidak valid atau progress tidak ditemukan.</span>
            </div>
        <?php endif; ?>
     <!-- Trackers Section -->
    <?php elseif ($page == 'trackers'): ?>
        <?php if ($action == 'list'): ?>
            <!-- Trackers List -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Daftar Workplan Tracker</h2>
                </div>

                <!-- Filter Section -->
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="page" value="trackers">
                        <input type="hidden" name="action" value="list">

                        <!-- Global Search -->
                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Cari ID/Nama Proyek..."
                                value="<?= htmlspecialchars($searchTerm) ?>">
                        </div>

                        <!-- Additional Filters -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <select name="parent_activity_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Parent Activity</option>
                                    <?php foreach ($activities as $act): ?>
                                        <?php if ($act['type'] == 'parent'): ?>
                                            <option value="<?= $act['id'] ?>"><?= $act['name'] ?> (<?= $act['id'] ?>)</option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Proyek</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent Aktivitas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            // Apply filters
                            $filteredTrackers = $trackers;
                            if ($searchTerm !== '') {
                                $filteredTrackers = array_filter($filteredTrackers, function($tracker) use ($searchTerm) {
                                    return stripos($tracker['id'], $searchTerm) !== false || 
                                           stripos($tracker['name'], $searchTerm) !== false;
                                });
                            }
                            
                            $totalItems = count($filteredTrackers);
                            $totalPages = ceil($totalItems / $perPage);
                            $currentPage = min($currentPage, $totalPages);
                            $offset = ($currentPage - 1) * $perPage;
                            $currentPageData = array_slice($filteredTrackers, $offset, $perPage);
                            
                            if (empty($currentPageData)): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada data ditemukan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($currentPageData as $tracker):
                                    $parentActivity = isset($tracker['parent_activity_id']) && isset($activities[$tracker['parent_activity_id']]) ? $activities[$tracker['parent_activity_id']] : null;

                                    // Calculate total progress for this parent activity
                                    $totalProgress = 0;
                                    $childCount = 0;
                                    foreach ($activities as $act) {
                                        if ($act['type'] == 'child' && $act['parent_id'] == $tracker['parent_activity_id']) {
                                            $childCount++;
                                            // Find the latest progress entry for this child
                                            $latestProgress = null;
                                            foreach ($progress as $prog) {
                                                if ($prog['child_activity_id'] == $act['id']) {
                                                    if (!$latestProgress || $prog['month'] > $latestProgress['month']) {
                                                        $latestProgress = $prog;
                                                    }
                                                }
                                            }
                                            if ($latestProgress) {
                                                $totalProgress += $latestProgress['total_progress'];
                                            }
                                        }
                                    }
                                    $avgProgress = $childCount > 0 ? round($totalProgress / $childCount) : 0;
                                ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $tracker['id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?= $tracker['name'] ?></div>
                                        <?php if ($tracker['remark']): ?>
                                        <div class="text-sm text-gray-500"><?= substr($tracker['remark'], 0, 50) ?>...</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y', strtotime($tracker['start_date'])) ?> - <?= date('d M Y', strtotime($tracker['end_date'])) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $parentActivity ? $parentActivity['name'] . ' (' . $parentActivity['id'] . ')' : '-' ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: <?= $avgProgress ?>%"></div>
                                        </div>
                                        <span class="mt-1 block"><?= $avgProgress ?>%</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="?page=trackers&action=view&id=<?= $tracker['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => max(1, $currentPage - 1)])) ?>"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => min($totalPages, $currentPage + 1)])) ?>"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium"><?= $offset + 1 ?></span>
                                sampai
                                <span class="font-medium"><?= min($offset + $perPage, $totalItems) ?></span>
                                dari
                                <span class="font-medium"><?= $totalItems ?></span>
                                data
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => max(1, $currentPage - 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                                <?php
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);

                                if ($startPage > 1) {
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $activeClass = ($i == $currentPage) ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $activeClass . '">' . $i . '</a>';
                                }

                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page_num' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>

                                <a href="?<?= http_build_query(array_merge($_GET, ['page_num' => min($totalPages, $currentPage + 1)])) ?>"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($action == 'view' && $id && isset($trackers[$id])): ?>
            <!-- View Tracker -->
            <?php $tracker = $trackers[$id];
                $parentActivity = isset($tracker['parent_activity_id']) && isset($activities[$tracker['parent_activity_id']]) ? $activities[$tracker['parent_activity_id']] : null;

                // Prepare data for progress bars
                $progressData = [];
                $overallTotalProgress = 0;
                $childCount = 0;
                foreach ($activities as $act) {
                    if ($act['type'] == 'child' && $act['parent_id'] == $tracker['parent_activity_id']) {
                        $childCount++;
                        $childProgress = [
                            'activity' => $act,
                            'latest_progress' => null
                        ];
                        // Find the latest progress entry for this child
                        foreach ($progress as $prog) {
                            if ($prog['child_activity_id'] == $act['id']) {
                                if (!$childProgress['latest_progress'] || $prog['month'] > $childProgress['latest_progress']['month']) {
                                    $childProgress['latest_progress'] = $prog;
                                }
                            }
                        }
                        if ($childProgress['latest_progress']) {
                            $overallTotalProgress += $childProgress['latest_progress']['total_progress'];
                        }

                        $progressData[] = $childProgress;
                    }
                }
                $avgOverallProgress = $childCount > 0 ? round($overallTotalProgress / $childCount) : 0;
            ?>
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Detail Workplan Tracker</h2>
                    <div>
                        <a href="?page=trackers&action=list" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <p class="text-sm text-gray-500">ID Tracker</p>
                        <p class="font-medium text-lg"><?= $tracker['id'] ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nama Proyek</p>
                        <p class="font-medium text-lg"><?= $tracker['name'] ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Periode</p>
                        <p class="font-medium"><?= date('d M Y', strtotime($tracker['start_date'])) ?> - <?= date('d M Y', strtotime($tracker['end_date'])) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Parent Aktivitas</p>
                        <p class="font-medium"><?= $parentActivity ? $parentActivity['name'] . ' (' . $parentActivity['id'] . ')' : '-' ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Catatan</p>
                        <p class="font-medium"><?= $tracker['remark'] ?: '-' ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Dibuat</p>
                        <p class="font-medium"><?= date('d M Y H:i', strtotime($tracker['created_at'])) ?></p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">Progress Total Keseluruhan</p>
                        <div class="flex items-center">
                            <div class="w-full bg-gray-200 rounded-full h-4 mr-2">
                                <div class="bg-green-600 h-4 rounded-full" style="width: <?= $avgOverallProgress ?>%"></div>
                            </div>
                            <span class="font-medium text-lg"><?= $avgOverallProgress ?>%</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Detail Progress per Child Activity</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <?php
                        $hasProgress = false;
                        foreach ($progressData as $pData):
                            $childAct = $pData['activity'];
                            $latestProg = $pData['latest_progress'];
                            if ($latestProg):
                                $hasProgress = true;
                        ?>
                        <div class="mb-4 pb-4 border-b border-gray-200 last:border-0 last:mb-0 last:pb-0">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-medium"><?= $childAct['name'] ?> (<?= $childAct['id'] ?>)</p>
                                <div class="flex items-center">
                                    <span class="text-sm mr-2"><?= $latestProg['monthly_progress'] ?>% (bulanan)</span>
                                    <span class="text-sm"><?= $latestProg['total_progress'] ?>% (total)</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?= $latestProg['monthly_progress'] ?>%"></div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: <?= $latestProg['total_progress'] ?>%"></div>
                                </div>
                            </div>
                            <?php if ($latestProg['remark']): ?>
                            <p class="text-sm text-gray-500 mt-2"><?= $latestProg['remark'] ?></p>
                            <?php endif; ?>
                             <p class="text-xs text-gray-400 mt-1">Terakhir diupdate: <?= date('F Y', strtotime($latestProg['month'].'-01')) ?></p>
                        </div>
                        <?php
                            endif;
                        endforeach;
                        if (!$hasProgress):
                        ?>
                        <p class="text-gray-500">Belum ada progress untuk child activities ini.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">Workplan tracker tidak ditemukan.</span>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">Halaman tidak ditemukan.</span>
        </div>
    <?php endif; ?>
</section>
<script>
    // Confirm before deletion
    function confirmDelete(type, id) {
        if (confirm(`Apakah Anda yakin ingin menghapus ${type} ini?`)) {
            // In a real app, this would be an AJAX call or form submission
            showNotification(`${type} berhasil dihapus`, 'success');
            // Reload page after 1 second
            setTimeout(() => {
                window.location.href = `?page=${type}s&action=list`;
            }, 1000);
        }
    }
    // Submit form
    function submitForm(type) {
        const form = document.getElementById(`${type}-form`);
        let isValid = true;
        // Simple validation
        form.querySelectorAll('[required]').forEach(input => {
            if (!input.value) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });
        if (isValid) {
            // In a real app, this would be an AJAX call or form submission
            showNotification(`${type} berhasil ${form.id.includes('edit') ? 'diupdate' : 'disimpan'}`, 'success');
            // Redirect to list page after 1 second
            setTimeout(() => {
                window.location.href = `?page=${type}s&action=list`;
            }, 1000);
        } else {
            showNotification('Harap isi semua field yang diperlukan', 'error');
        }
    }
    // Show notification
    function showNotification(message, type = 'success') {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notification-message');
        notificationMessage.textContent = message;
        notification.style.display = 'block';
        // Set color based on type
        if (type === 'success') {
            notification.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6';
        } else if (type === 'error') {
            notification.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6';
        }
        // Hide after 3 seconds
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }
</script>
<?php include 'footer.php'; ?>