<?php

include 'header.php';

// Fungsi untuk menghasilkan UUID
function generateUUID()
{
    return uniqid(true); // Menghasilkan UUID berbasis waktu
}

// Data menu dengan UUID sebagai menu_id
$dummyKPIProjects = [
    [
        'id' => '1',
        'judul' => 'Improve Sustain',
        'detil' => [
            [
                'id' => '11',
                'output'       => 'Improve sustainability',
                'output_detil'  => [
                    [
                        'activity'     => 'Training P.1',
                        'target'       => 1500,
                        'actual'       => 1000,
                        'achievement'  => 66,  // (1000 / 1500) * 100
                    ],
                    [
                        'activity'     => 'Training P.2',
                        'target'       => 2000,
                        'actual'       => 500,
                        'achievement'  => 25,  // (500 / 2000) * 100
                    ]
                ]
            ],
            [
                'id' => '12',
                'output'      => 'Reduce fire risk',
                'output_detil' => [
                    [
                        'activity'     => '4 Groups',
                        'target'       => 4,
                        'actual'       => 4,
                        'achievement'  => 100, // (4 / 4) * 100
                    ]
                ]
            ]
        ]
    ],

];


// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$menu_id = isset($_GET['id']) ? $_GET['id'] : '';

// Simulasi data farmer yang dipilih
$menu = null;
foreach ($dummyKPIProjects as $dummyKPIProject) {
    if ($dummyKPIProject['menu_id'] == $menu_id) {
        $menu = $dummyKPIProject;
        break;
    }

    // Jika menu memiliki submenus, cari di dalam submenu
    if (isset($dummyKPIProject['submenus'])) {
        foreach ($dummyKPIProject['submenus'] as $submenu) {
            if ($submenu['menu_id'] == $menu_id) {
                $menu = $submenu;
                break;
            }
        }
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/tabulator-tables@5.0.7/dist/css/tabulator.min.css" rel="stylesheet">

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20   shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah KPI Project Baru";
                elseif ($action == 'view') echo "Profil KPI Project: " . ($menu ? htmlspecialchars($menu['name']) : '');
                elseif ($action == 'edit') echo "Edit KPI Project: " . ($menu ? htmlspecialchars($menu['name']) : '');
                else echo "Data KPI Project";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="menu?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
                    <i class="fas fa-plus mr-2"></i> Tambah KPI Project
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
                    <div class="min-w-full divide-y divide-gray-200 hidden" id="example-table"></div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outcome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Output</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Achievement</th>
                                <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyKPIProjects as $menu): ?>
                                <!-- Menu Utama -->
                                <tr class="border-t">
                                    <td class="border p-2 text-gray-800" colspan="6">
                                        <div class="flex items-center">
                                            <button onclick="toggleDetails(<?= htmlspecialchars($menu['id']) ?>)" class="mr-2">
                                                <i id="icon-<?= htmlspecialchars($menu['id']) ?>" class="fas fa-chevron-down text-sm text-gray-500"></i>
                                            </button>
                                            <?= htmlspecialchars($menu['judul']) ?>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Submenu -->
                                <?php if (isset($menu['detil'])): ?>
                                    <?php foreach ($menu['detil'] as $submenu): ?>
                                        <tr class="border-t bg-gray-50" id="submenu-<?= htmlspecialchars($menu['id']) ?>">
                                            <td>└─── </td>
                                            <td class="border p-2 pl-6 text-gray-700" colspan="5">
                                                <button onclick="toggleDetails2(<?= htmlspecialchars($submenu['id']) ?>)" class="mr-2">
                                                    <i id="icon2-<?= htmlspecialchars($submenu['id']) ?>" class="fas fa-chevron-down text-sm text-gray-500"></i>
                                                </button>
                                                <?= htmlspecialchars($submenu['output']) ?>
                                            </td>
                                        </tr>

                                        <?php if (isset($submenu['output_detil'])): ?>
                                            <?php foreach ($submenu['output_detil'] as $submenu2): ?>
                                                <tr class="border-t bg-gray-50 submenu2-<?= htmlspecialchars($submenu['id']) ?>" id="submenu-<?= htmlspecialchars($menu['id']) ?>">
                                                    <td></td>
                                                    <td class="p-2 pl-6 text-gray-700">└───</td>
                                                    <td class="border p-2 pl-6 text-gray-700"><?= htmlspecialchars($submenu2['activity']) ?></td>
                                                    <td class="border p-2 pl-6 text-gray-700"><?= htmlspecialchars($submenu2['target']) ?></td>
                                                    <td class="border p-2 pl-6 text-gray-700"><?= htmlspecialchars($submenu2['actual']) ?></td>
                                                    <td class="border p-2 pl-6 text-gray-700">
                                                        <div class="relative pt-1">
                                                            <div class="flex mb-2 items-center justify-between">
                                                                <span class="text-xs font-semibold inline-block py-1 uppercase rounded-full"><?= htmlspecialchars($submenu2['achievement']) ?>%</span>
                                                            </div>
                                                            <div class="flex mb-2">
                                                                <!-- Progress bar background -->
                                                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                                    <!-- Progress bar fill, width is dynamic based on achievement -->
                                                                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: <?= htmlspecialchars($submenu2['achievement']) ?>%"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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

                        <!-- KPI Project Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">KPI Project <span class="text-red-500">*</span></label>
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
                                <option value="master" <?= $action == 'edit' && $menu['parent_id'] == null ? 'selected' : '' ?>>Master KPI Project</option>
                                <option value="submenu" <?= $action == 'edit' && $menu['parent_id'] != null ? 'selected' : '' ?>>Submenu</option>
                            </select>
                        </div>

                        <!-- KPI Project Induk -->
                        <div id="parentKPIProjectWrapper" style="display: none;">
                            <label for="parent_id" class="block text-sm font-medium text-gray-700">KPI Project Induk <span class="text-red-500">*</span></label>
                            <select id="parent_id" name="parent_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <?php foreach ($dummyKPIProjects as $parentKPIProject): ?>
                                    <?php if ($parentKPIProject['parent_id'] == null): ?>
                                        <option value="<?= $parentKPIProject['menu_id'] ?>" <?= $action == 'edit' && $parentKPIProject['menu_id'] == $menu['parent_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($parentKPIProject['name']) ?>
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
                            <button type="button" id="saveKPIProjectBtn" onclick="saveKPIProjectData()" class="ml-2 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-yellow-400 h-full">
                                <span id="btnKPIProjectText">Simpan</span> <!-- Button text -->
                                <svg id="loadingKPIProjectSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white bg-yellow-500 hover:bg-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/tabulator-tables@5.0.7/dist/js/tabulator.min.js"></script>

<script>
    // Example data with nested structure for tree view
    var tableData = [{
            id: 1,
            outcome: 'Improve sustainability',
            output: 'Improve capacity',
            activity: 'Training P.1',
            target: 1500,
            actual: 1000,
            achievement: 66,
            _children: [{
                id: 11,
                output: 'Training P.2',
                activity: '-',
                target: 2000,
                actual: 500,
                achievement: 25,
            }]
        },
        {
            id: 2,
            outcome: 'Reduce fire risk',
            output: 'Establish infrastructure',
            activity: '4 Groups',
            target: 4,
            actual: 4,
            achievement: 100,
            _children: []
        }
    ];

    // Initialize Tabulator
    var table = new Tabulator("#example-table", {
        data: tableData, // Set the data
        layout: "fitColumns", // Auto-fit the columns to the available space
        dataTree: true, // Enable tree structure
        columns: [{
                title: "Outcome",
                field: "outcome",
                width: 200
            },
            {
                title: "Output",
                field: "output",
                width: 200
            },
            {
                title: "Activity",
                field: "activity",
                width: 200
            },
            {
                title: "Target",
                field: "target",
                width: 100
            },
            {
                title: "Actual",
                field: "actual",
                width: 100
            },
            {
                title: "Achievement",
                field: "achievement",
                width: 100
            },
        ]
    });

    // JavaScript function to toggle submenu visibility
    function toggleDetails(menuId) {
        // Select the submenu elements using the menuId
        const submenu = document.querySelectorAll(`#submenu-${menuId}`);
        const submenuIcon = document.getElementById(`icon-${menuId}`);

        // Check if the submenu elements exist before trying to toggle them
        if (submenu.length > 0 && submenuIcon) {
            // If submenu is not already hidden, toggle it
            if (submenu[0].classList.contains('hidden')) {
                submenu.forEach(item => {
                    item.classList.remove('hidden'); // Show submenu
                });
            } else {
                // If submenu is already visible, hide the visible submenu only
                console.log(`Submenu ${menuId} is already shown. Hiding it now.`);
                submenu.forEach(item => {
                    item.classList.add('hidden'); // Hide the visible submenu
                });
            }

            // Toggle chevron icon (up or down)
            if (submenuIcon.classList.contains('fa-chevron-down')) {
                submenuIcon.classList.remove('fa-chevron-down');
                submenuIcon.classList.add('fa-chevron-up');
            } else {
                submenuIcon.classList.remove('fa-chevron-up');
                submenuIcon.classList.add('fa-chevron-down');
            }
        } else {
            console.error(`Submenu or icon with menuId ${menuId} not found.`);
        }
    }

    function toggleDetails2(menuId) {
        // Select the submenu elements using the menuId
        const submenu = document.querySelectorAll(`.submenu2-${menuId}`);
        const submenuIcon = document.getElementById(`icon2-${menuId}`);

        // Check if the submenu elements exist before trying to toggle them
        if (submenu.length > 0 && submenuIcon) {
            // Toggle the visibility of the submenu
            submenu.forEach(item => {
                item.classList.toggle('hidden'); // Toggle visibility
            });

            // Toggle chevron icon (up or down)
            if (submenuIcon.classList.contains('fa-chevron-down')) {
                submenuIcon.classList.remove('fa-chevron-down');
                submenuIcon.classList.add('fa-chevron-up');
            } else {
                submenuIcon.classList.remove('fa-chevron-up');
                submenuIcon.classList.add('fa-chevron-down');
            }
        } else {
            console.error(`Submenu or icon with menuId ${menuId} not found.`);
        }
    }
</script>

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

    function saveKPIProjectData() {
        const name = document.getElementById("name");
        const url = document.getElementById("url");
        const icon = document.getElementById("icon");
        const type = document.getElementById("type");
        const order = document.getElementById("order");

        // Button & Spinner Elements
        const saveBtn = document.getElementById("saveKPIProjectBtn");
        const loadingSpinner = document.getElementById("loadingKPIProjectSpinner");
        const btnText = document.getElementById("btnKPIProjectText");

        // Validation
        if (!name.value) {
            showSweetAlert('error', 'Form Gagal', 'Nama KPI Project harus diisi.', false, '');
            return;
        }

        if (!url.value) {
            showSweetAlert('error', 'Form Gagal', 'Link KPI Project harus diisi.', false, '');
            return;
        }

        if (!icon.value) {
            showSweetAlert('error', 'Form Gagal', 'Icon KPI Project harus diisi.', false, '');
            return;
        }

        if (!type.value) {
            showSweetAlert('error', 'Form Gagal', 'Tipe KPI Project harus dipilih.', false, '');
            return;
        }

        if (!order.value) {
            showSweetAlert('error', 'Form Gagal', 'Urutan KPI Project harus diisi.', false, '');
            return;
        }

        // Disabling button and showing spinner
        saveBtn.disabled = true;
        btnText.style.display = 'none'; // Hide button text
        loadingSpinner.style.display = 'inline-block'; // Show loading spinner

        // Simulate data upload with setTimeout
        setTimeout(() => {
            // Data uploaded successfully
            showSweetAlert('success', 'Berhasil Disimpan', 'KPI Project berhasil disimpan ke dalam database.', true, 'menu');

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
        const parentKPIProjectWrapper = document.getElementById("parentKPIProjectWrapper");
        // const urlInput = document.getElementById("url");

        function toggleSubmenuOptions() {
            if (typeSelect.value === "submenu") {
                parentKPIProjectWrapper.style.display = "block";
                // urlInput.value = "#";
                // urlInput.setAttribute("disabled", true);
            } else {
                parentKPIProjectWrapper.style.display = "none";
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