<?php
// data custom query_panen
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
                if ($action == 'add') echo "Tambah Custom Query";
                elseif ($action == 'view') echo "Detail Custom Query: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                elseif ($action == 'edit') echo "Edit Custom Query: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                else echo "Data Custom Query";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="custom-query?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Custom Query
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="custom-query" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="custom-query?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            <?php elseif ($action == 'edit'): ?>
                <a href="custom-query" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php elseif ($action == 'add'): ?>
                <a href="custom-query" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Custom Query -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="action" value="list">

                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari data custom query...">
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
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">2</span> data custom query
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
            <!-- Form Tambah/Edit Custom Query -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <!-- Form Query -->
                    <form method="POST" class="">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Query <span class="text-red-500">*</span>
                            </label>

                            <!-- Textarea Query -->
                            <textarea id="queryInput" name="query" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"><?= isset($_POST['query']) ? htmlspecialchars($_POST['query']) : '' ?></textarea>

                            <!-- Tombol Kolom -->
                            <div class="flex flex-wrap gap-2 mt-3 items-center">
                                <p class="text-sm font-medium text-gray-700">Table:</p>
                                <?php
                                $columns = ['User', 'Petani', 'Lahan', 'ICS'];
                                foreach ($columns as $col): ?>
                                    <button type="button"
                                        onclick="insertColumn('<?= $col ?>')"
                                        class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm hover:bg-blue-200">
                                        <?= $col ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>

                            <!-- Pintasan Query -->
                            <div class="flex flex-wrap gap-2 mt-4 items-center">
                                <p class="text-sm font-medium text-gray-700">Shortcut:</p>

                                <button type="button" onclick="insertTemplate('SELECT * FROM nama_tabel;')"
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-sm hover:bg-green-200">
                                    Tampilkan Semua
                                </button>

                                <button type="button" onclick="insertTemplate('SELECT COUNT(*) FROM nama_tabel;')"
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-sm hover:bg-yellow-200">
                                    Jumlah Baris
                                </button>

                                <button type="button" onclick="insertTemplate(`SELECT * FROM nama_tabel WHERE nama LIKE '%keyword%';`)"
                                    class="px-3 py-1 bg-purple-100 text-purple-700 rounded-lg text-sm hover:bg-purple-200">
                                    Cari Berdasarkan Nama
                                </button>

                                <button type="button" onclick="insertTemplate('SELECT * FROM nama_tabel ORDER BY tanggal DESC;')"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200">
                                    Urutkan Tanggal Terbaru
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <a href="custom-query" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                                Proses
                            </button>
                        </div>
                    </form>

                    <!-- Hasil Query -->
                    <?php if (!empty($dummyResult)): ?>
                        <div class=" mx-auto ">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Hasil Query</h2>
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <?php foreach (array_keys($dummyResult[0]) as $column): ?>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <?= htmlspecialchars(ucfirst($column)) ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($dummyResult as $row): ?>
                                        <tr class="hover:bg-gray-50">
                                            <?php foreach ($row as $value): ?>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    <?= htmlspecialchars($value) ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    function insertColumn(columnName) {
        const textarea = document.getElementById('queryInput');
        const cursorPos = textarea.selectionStart;
        const textBefore = textarea.value.substring(0, cursorPos);
        const textAfter = textarea.value.substring(cursorPos);
        textarea.value = textBefore + columnName + textAfter;
        textarea.focus();
        textarea.selectionEnd = cursorPos + columnName.length;
    }

    function insertTemplate(templateQuery) {
        document.getElementById('queryInput').value = templateQuery;
    }

    let leafletMap = null;
    let geoJsonLayer = null;

    function openMapModal(url) {
        document.getElementById('mapModal').style.display = 'block';
        setTimeout(() => {
            if (!leafletMap) {
                leafletMap = L.map('leafletMap').setView([-2, 118], 5); // Center Indonesia
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(leafletMap);
            }
            // Clear previous layer
            if (geoJsonLayer) {
                leafletMap.removeLayer(geoJsonLayer);
            }
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    geoJsonLayer = L.geoJSON(data).addTo(leafletMap);
                    leafletMap.fitBounds(geoJsonLayer.getBounds());
                })
                .catch(() => {
                    alert('Gagal memuat GeoJSON dari URL');
                });
        }, 300);
    }

    function closeMapModal() {
        document.getElementById('mapModal').style.display = 'none';
        // Optionally clear map
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data custom query ini?')) {
            // Simulasi penghapusan data
            alert('Transaksi dengan ID ' + id + ' telah dihapus');
            window.location.href = 'custom-query';
        }
    }
</script>

<?php include 'footer.php'; ?>