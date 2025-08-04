<?php
// data external_panen
include 'header.php';

// Simulasi data dummy
$dummyDataExternal = [
    [
        'id' => 1,
        'nama' => 'Data Kabupaten',
        'url'  => 'https://contoh.com/data_panen_1.json'
    ],
    [
        'id' => 2,
        'nama' => 'Data Pemerintah',
        'url'  => 'https://contoh.com/data_panen_2.json'
    ]
];

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Simulasi data yang dipilih
$selectedData = null;
if ($id) {
    foreach ($dummyDataExternal as $data) {
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
                if ($action == 'add') echo "Tambah Data External";
                elseif ($action == 'view') echo "Detail Data External: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                elseif ($action == 'edit') echo "Edit Data External: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                else echo "Data Data External";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="external?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Data External
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="external" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="external?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            <?php elseif ($action == 'edit'): ?>
                <a href="external" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php elseif ($action == 'add'): ?>
                <a href="external" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Data External -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="action" value="list">

                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari data external...">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyDataExternal as $external): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $external['nama'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $external['url'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="external?action=edit&id=<?= $external['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('<?= $external['id'] ?>')" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">2</span> data external
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
            <!-- Form Tambah/Edit Data External -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <form class="space-y-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['nama'] : '' ?>">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">URL <span class="text-red-500">*</span></label>
                            <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"><?= ($action == 'edit') ? $selectedData['url'] : '' ?></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <a href="<?= ($action == 'edit') ? 'external' : 'external' ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
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

<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data external ini?')) {
            // Simulasi penghapusan data
            alert('Transaksi dengan ID ' + id + ' telah dihapus');
            window.location.href = 'external';
        }
    }
</script>

<?php include 'footer.php'; ?>