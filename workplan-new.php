<?php
// data workplan_panen
include 'header.php';

// Simulasi data dummy
$dummyCustomQuery = [
    [
        'created_by' => 'admin1',
        'query' => 'SELECT * FROM users WHERE active = 1',
        'datetime' => '2025-08-04 08:30:15'
    ],
    [
        'created_by' => 'editor2',
        'query' => "UPDATE articles SET status = 'published' WHERE id = 42",
        'datetime' => '2025-08-04 09:12:47'
    ],
    [
        'created_by' => 'admin1',
        'query' => "DELETE FROM logs WHERE created_at < '2024-01-01'",
        'datetime' => '2025-08-03 18:20:00'
    ],
    [
        'created_by' => 'auditor3',
        'query' => 'SELECT COUNT(*) FROM transactions WHERE amount > 100000',
        'datetime' => '2025-08-02 14:45:33'
    ],
    [
        'created_by' => 'user_test',
        'query' => "INSERT INTO feedback (user_id, message) VALUES (23, 'Great job!')",
        'datetime' => '2025-08-01 11:00:00'
    ]
];



$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Simulasi data yang dipilih
$selectedData = null;
if ($id) {
    foreach ($dummyCustomQuery as $data) {
        if ($data['id'] == $id) {
            $selectedData = $data;
            break;
        }
    }
}
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah Workplan";
                elseif ($action == 'view') echo "Detail Workplan: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                elseif ($action == 'edit') echo "Edit Workplan: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                else echo "Data Workplan";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="workplan-new?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Workplan
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="workplan-new" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="workplan-new?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            <?php elseif ($action == 'edit'): ?>
                <a href="workplan-new" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php elseif ($action == 'add'): ?>
                <a href="workplan-new" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Workplan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="action" value="list">

                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari data workplan...">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div></div>
                            <div></div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Query</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyCustomQuery as $row): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($row['created_by']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-pre-wrap text-sm text-gray-700 max-w-xl">
                                        <?= htmlspecialchars($row['query']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($row['datetime']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Map -->
                <div id="mapModal" style="display:none; position:fixed; top:0; left:0; z-index:1000; width:100vw; height:100vh; background:rgba(0,0,0,0.3);">
                    <div style="position:absolute; top:50px; left:50%; transform:translateX(-50%); background:#fff; border-radius:8px; padding:16px; width:90vw; max-width:800px; height:70vh;">
                        <div style="display: flex; justify-content: flex-end;">
                            <button onclick="closeMapModal()" style="font-size:18px; background:none; border:none;">&times;</button>
                        </div>
                        <div id="leafletMap" style="width:100%;height:60vh; border-radius:4px"></div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">2</span> data workplan
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    1
                                </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($action == 'add' || $action == 'edit'): ?>
            <?php
            // Jika disubmit, tampilkan data dummy
            $dummyResult = [];
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
                $dummyResult = [
                    ['id' => 1, 'nama' => 'Ari', 'email' => 'ari@example.com'],
                    ['id' => 2, 'nama' => 'Budi', 'email' => 'budi@example.com'],
                    ['id' => 3, 'nama' => 'Citra', 'email' => 'citra@example.com'],
                ];
            }
            ?>
            <!-- Form Tambah/Edit Workplan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <!-- Form Query -->
                    <form method="POST" class="">
                        <div class="mb-4">
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul <span class="text-red-500">*</span></label>
                                <input type="text" id="judul" name="judul" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['name']) : '' ?>">
                            </div>
                        </div>

                        <div class="mb-4 flex space-x-4">
                            <!-- Bulan Awal -->
                            <div class="flex-1">
                                <label for="start_month" class="block text-sm font-medium text-gray-700">Bulan Awal <span class="text-red-500">*</span></label>
                                <div class="flex space-x-2">
                                    <select id="start_month" name="start_month" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <select id="start_year" name="start_year" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Tahun</option>
                                        <?php
                                        $current_year = date('Y');
                                        for ($i = $current_year; $i >= 1900; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Bulan Akhir -->
                            <div class="flex-1">
                                <label for="end_month" class="block text-sm font-medium text-gray-700">Bulan Akhir <span class="text-red-500">*</span></label>
                                <div class="flex space-x-2">
                                    <select id="end_month" name="end_month" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <select id="end_year" name="end_year" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Tahun</option>
                                        <?php
                                        $current_year = date('Y');
                                        for ($i = $current_year; $i >= 1900; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div>
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden mt-4">
                <div class="p-6">
                    <table class="min-w-full table-auto bg-white border border-gray-300 border-collapse shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gray-200">
                            <tr class="border-b border-gray-300">
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700" colspan="6">OUTPUT & ACTIVITY</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">UOM</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 2.1 -->
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="8">2.1</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="5"><strong>Established smallholder organizations that are recognized legally by the Indonesian laws</strong></td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top"></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="6">2.1.1</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="4">Formation and legalization of smallholder groups by the Indonesian government</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top"></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="4">1)</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="4" colspan="2">Sosialisasi Program</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Volume</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">lembaga</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Frequency</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">x sebulan</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Quantity</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">kali</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="2" class="text-center">
                                    <button class="px-6 py-2 bg-green-500 w-full text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah UOM
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="5" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Sub Child Activity
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="6" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Child Activity
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 2.1 -->

                            <!-- Row 2.2 -->
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="6">2.2</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="5"><strong>Increased smallholders’ knowledge, capacity, and skills in running oil palm businesses professionally and profitably</strong></td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top"></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="4">2.2.3</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="4" colspan="3">Fertilizer Business progress monitoring</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Volume</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">lembaga</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Frequency</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">x sebulan</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Quantity</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">kali</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="2" class="text-center">
                                    <button class="px-6 py-2 bg-green-500 w-full text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah UOM
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="6" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Child Activity
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 2.2 -->

                            <!-- Row 3.4 -->
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="13">3.4</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="5"><strong>Reduced fire risks near smallholder plantations</strong></td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top"></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="11">3.4.1</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="4">Establishment of fire prevention and management infrastructure</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top"></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="9">2)</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="3">Pencegahan dan Pengendalian Kebakaran Lahan</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top"></td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="2">a.</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="2">Analisa Resiko Kebakaran Lahan</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Quantity</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">lembaga</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="2" class="text-center">
                                    <button class="px-6 py-2 bg-green-500 w-full text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah UOM
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="3">b.</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="3">Penyediaan infrastruktur pencegahan kebakaran lahan dan pengelolaan air</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Quantity</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">lembaga</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Quantity</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">unit</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="2" class="text-center">
                                    <button class="px-6 py-2 bg-green-500 w-full text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah UOM
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="2">c.</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" rowspan="2">Penyusunan rencana kontinjensi kebakaran oleh Tim pencegahan kebakaran </td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">Quantity</td>
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top">dokumen</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-500 hover:text-red-700 ml-2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="2" class="text-center">
                                    <button class="px-6 py-2 bg-green-500 w-full text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah UOM
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="4" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Detil Sub Child Activity
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="5" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Sub Child Activity
                                    </button>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="6" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Child Activity
                                    </button>
                                </td>
                            </tr>
                            <!-- Row 3.4 -->

                            <!-- Row Tambah -->
                            <tr class="border-t border-gray-300 bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-600 border-r border-gray-300 align-top" colspan="7" class="text-center">
                                    <button class="px-6 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        Tambah Activity
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>

</script>

<?php include 'footer.php'; ?>