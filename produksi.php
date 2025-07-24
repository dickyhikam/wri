<?php
// Include header
include 'header.php';

// Simulasi data dari database untuk Produksi
$produksi_data = [
    [
        'id' => 1,
        'plot_id' => 101, // ID Lahan
        'date' => '2023-09-15',
        'jumlah_panen' => 500,
        'luas' => 2.5,
        'keterangan' => 'Hasil panen pertama'
    ],
    [
        'id' => 2,
        'plot_id' => 102, // ID Lahan
        'date' => '2023-09-20',
        'jumlah_panen' => 600,
        'luas' => 3.0,
        'keterangan' => 'Hasil panen kedua'
    ]
];

// Simulasi data Lahan (Plot) - Sesuai dengan database
$lahan = [
    101 => ['name' => 'Lahan Blok A', 'farmer_name' => 'Petani Andi'],
    102 => ['name' => 'Lahan Blok B', 'farmer_name' => 'Petani Siti'],
    // Tambahkan data lahan lain jika diperlukan
];

// Menangani parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Mendapatkan data spesifik berdasarkan ID untuk view/edit
$selected_produksi = null;
if ($action === 'view' || $action === 'edit') {
    foreach ($produksi_data as $data) {
        if ($data['id'] == $id) {
            $selected_produksi = $data;
            break;
        }
    }
}
?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 bg-white border-b shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php if ($action === 'list'): ?>
                    Data Produksi
                <?php elseif ($action === 'add'): ?>
                    Tambah Data Produksi
                <?php elseif ($action === 'view'): ?>
                    Detail Produksi
                <?php elseif ($action === 'edit'): ?>
                    Edit Data Produksi
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action === 'list'): ?>
                <!-- Tombol Tambah Data -->
                <a href="produksi.php?action=add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </a>
            <?php elseif ($action === 'view'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="produksi.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <!-- Tombol Edit -->
                <a href="produksi.php?action=edit&id=<?= $id ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            <?php elseif ($action === 'edit' || $action === 'add'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="produksi.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action === 'list'): ?>
            <!-- Halaman Daftar Produksi -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg">
                            <i class="fas fa-file-export mr-2"></i> Export
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Produksi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Panen</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Panen (kg)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (ha)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($produksi_data as $index => $data): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">PROD-<?= $data['id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $lahan[$data['plot_id']]['name'] ?? 'Lahan Tidak Dikenal' ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d/m/Y', strtotime($data['date'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $data['jumlah_panen'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $data['luas'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="produksi.php?action=view&id=<?= $data['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="produksi.php?action=edit&id=<?= $data['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php elseif ($action === 'view' && $selected_produksi): ?>
            <!-- Halaman Detail Produksi -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Produksi #PROD-<?= $selected_produksi['id'] ?></h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Lahan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $lahan[$selected_produksi['plot_id']]['name'] ?? 'Lahan Tidak Dikenal' ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Petani</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $lahan[$selected_produksi['plot_id']]['farmer_name'] ?? 'Petani Tidak Dikenal' ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Panen</label>
                            <p class="mt-1 text-sm text-gray-900"><?= date('d F Y', strtotime($selected_produksi['date'])) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jumlah Panen (kg)</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $selected_produksi['jumlah_panen'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Luas Lahan (ha)</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $selected_produksi['luas'] ?></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Keterangan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $selected_produksi['keterangan'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($action === 'add'): ?>
            <!-- Form Tambah Produksi -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Data Produksi</h2>
                    <form id="addForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                <select id="lahan_id" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lahan</option>
                                    <?php foreach ($lahan as $id_lahan => $data_lahan): ?>
                                        <option value="<?= $id_lahan ?>"><?= $data_lahan['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- Elemen untuk menampilkan nama petani -->
                                <div id="petani-info-add" class="mt-2 text-sm text-gray-500 hidden">
                                    Petani: <span id="petani-name-add"></span>
                                </div>
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Panen</label>
                                <input type="date" id="date" name="date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="jumlah_panen" class="block text-sm font-medium text-gray-700">Jumlah Panen (kg)</label>
                                <input type="number" id="jumlah_panen" name="jumlah_panen" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="luas" class="block text-sm font-medium text-gray-700">Luas Lahan (ha)</label>
                                <input type="number" step="0.01" id="luas" name="luas" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Produksi</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($action === 'edit' && $selected_produksi): ?>
            <!-- Form Edit Produksi -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Produksi #PROD-<?= $selected_produksi['id'] ?></h2>
                    <form id="editForm">
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                <label for="lahan_id_edit" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                <select id="lahan_id_edit" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lahan</option>
                                    <?php foreach ($lahan as $id_lahan => $data_lahan): ?>
                                        <option value="<?= $id_lahan ?>" <?= ($id_lahan == $selected_produksi['plot_id']) ? 'selected' : '' ?>><?= $data_lahan['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <!-- Elemen untuk menampilkan nama petani -->
                                <div id="petani-info-edit" class="mt-2 text-sm text-gray-500">
                                    Petani: <span id="petani-name-edit"><?= $lahan[$selected_produksi['plot_id']]['farmer_name'] ?? '' ?></span>
                                </div>
                            </div>
                            <div>
                                <label for="date_edit" class="block text-sm font-medium text-gray-700">Tanggal Panen</label>
                                <input type="date" id="date_edit" name="date" value="<?= $selected_produksi['date'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="jumlah_panen_edit" class="block text-sm font-medium text-gray-700">Jumlah Panen (kg)</label>
                                <input type="number" id="jumlah_panen_edit" name="jumlah_panen" value="<?= $selected_produksi['jumlah_panen'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="luas_edit" class="block text-sm font-medium text-gray-700">Luas Lahan (ha)</label>
                                <input type="number" step="0.01" id="luas_edit" name="luas" value="<?= $selected_produksi['luas'] ?>" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label for="keterangan_edit" class="block text-sm font-medium text-gray-700">Keterangan</label>
                                <textarea id="keterangan_edit" name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $selected_produksi['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Halaman tidak valid -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Halaman Tidak Ditemukan</h2>
                    <p class="text-gray-600">Maaf, halaman yang Anda cari tidak tersedia.</p>
                    <a href="produksi.php" class="mt-4 inline-block text-blue-600 hover:text-blue-800">Kembali ke Daftar Produksi</a>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    // Fungsi untuk menampilkan nama petani saat lahan dipilih di form Tambah
    document.getElementById('lahan_id')?.addEventListener('change', function() {
        const selectedLahanId = this.value;
        const petaniInfoDiv = document.getElementById('petani-info-add');
        const petaniNameSpan = document.getElementById('petani-name-add');
        
        // Data lahan dari PHP ke JavaScript
        const lahanData = <?= json_encode($lahan) ?>;
        
        if (selectedLahanId !== '' && lahanData[selectedLahanId]) {
            petaniInfoDiv.classList.remove('hidden');
            petaniNameSpan.textContent = lahanData[selectedLahanId]['farmer_name'];
        } else {
            petaniInfoDiv.classList.add('hidden');
            petaniNameSpan.textContent = '';
        }
    });

    // Fungsi untuk menampilkan nama petani saat lahan dipilih di form Edit
    document.getElementById('lahan_id_edit')?.addEventListener('change', function() {
        const selectedLahanId = this.value;
        const petaniInfoDiv = document.getElementById('petani-info-edit');
        const petaniNameSpan = document.getElementById('petani-name-edit');
        
        // Data lahan dari PHP ke JavaScript
        const lahanData = <?= json_encode($lahan) ?>;
        
        if (selectedLahanId !== '' && lahanData[selectedLahanId]) {
            // Pastikan elemen ditampilkan
            petaniInfoDiv.style.display = 'block'; 
            petaniNameSpan.textContent = lahanData[selectedLahanId]['farmer_name'];
        } else {
            petaniInfoDiv.style.display = 'none';
            petaniNameSpan.textContent = '';
        }
    });

    // Untuk form edit, jika sudah ada lahan terpilih, pastikan info petani ditampilkan
    document.addEventListener('DOMContentLoaded', function() {
        const editSelect = document.getElementById('lahan_id_edit');
        if (editSelect && editSelect.value !== '') {
            // Trigger change event secara manual
            const event = new Event('change');
            editSelect.dispatchEvent(event);
        }
    });
</script>

<?php include 'footer.php'; ?>