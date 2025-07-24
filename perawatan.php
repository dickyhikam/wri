<?php
// Include header
include 'header.php';

// Simulasi data dari database
$perawatans = [
    [
        'perawatan_id' => 1,
        'plot_id' => 101,
        'tahun_tanam' => 2023,
        'luas' => 5.0,
        'total_upah' => 1500000,
        'keterangan' => 'Perawatan rutin',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 1,
                'jenis_pekerjaan_id' => 1,
                'pekerja_id' => 1,
                'date' => '2023-09-10',
                'upah' => 500000,
                'jenis_lain' => 'Penyiangan',
                'jml' => 2,
            ],
            [
                'perawatan_detil_id' => 2,
                'jenis_pekerjaan_id' => 2,
                'pekerja_id' => 2,
                'date' => '2023-09-12',
                'upah' => 750000,
                'jenis_lain' => 'Pengairan',
                'jml' => 3,
            ],
        ],
    ],
    [
        'perawatan_id' => 2,
        'plot_id' => 102,
        'tahun_tanam' => 2023,
        'luas' => 6.0,
        'total_upah' => 2000000,
        'keterangan' => 'Perawatan intensif',
        'perawatan_detil' => [
            [
                'perawatan_detil_id' => 3,
                'jenis_pekerjaan_id' => 3,
                'pekerja_id' => 3,
                'date' => '2023-09-15',
                'upah' => 800000,
                'jenis_lain' => 'Pemupukan',
                'jml' => 1,
            ],
            [
                'perawatan_detil_id' => 4,
                'jenis_pekerjaan_id' => 4,
                'pekerja_id' => 4,
                'date' => '2023-09-18',
                'upah' => 700000,
                'jenis_lain' => 'Penyemprotan',
                'jml' => 2,
            ],
        ],
    ],
];

$lahan = [
    101 => ['name' => 'Lahan Blok A', 'farmer_name' => 'Petani Andi'],
    102 => ['name' => 'Lahan Blok B', 'farmer_name' => 'Petani Siti'],
];

$jenis_pekerjaan = [
    1 => ['name' => 'Penyiangan'],
    2 => ['name' => 'Pengairan'],
    3 => ['name' => 'Pemupukan'],
    4 => ['name' => 'Penyemprotan'],
];

$pekerja = [
    1 => ['name' => 'Budi Santoso'],
    2 => ['name' => 'Ani Putri'],
    3 => ['name' => 'Joko Widodo'],
    4 => ['name' => 'Siti Nurhaliza'],
];

// Menangani parameter URL
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Mendapatkan data spesifik berdasarkan ID
$selected_perawatan = null;
if ($action === 'view') {
    foreach ($perawatans as $p) {
        if ($p['perawatan_id'] === $id) {
            $selected_perawatan = $p;
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
                    Data Perawatan
                <?php elseif ($action === 'add'): ?>
                    Tambah Data Perawatan
                <?php elseif ($action === 'view'): ?>
                    Detail Perawatan
                <?php elseif ($action === 'edit'): ?>
                    Edit Data Perawatan
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action === 'list'): ?>
                <!-- Tombol Tambah Data -->
                <a href="perawatan.php?action=add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </a>
            <?php elseif ($action === 'view'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="perawatan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <!-- Tombol Edit -->
                <a href="perawatan.php?action=edit&id=<?= $id ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            <?php elseif ($action === 'edit'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="perawatan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action === 'list'): ?>
            <!-- Halaman Daftar Perawatan -->
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Perawatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Tanam</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (ha)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Upah (Rp)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($perawatans as $index => $perawatan): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $index + 1 ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">PRW-<?= $perawatan['perawatan_id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $lahan[$perawatan['plot_id']]['name'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $perawatan['tahun_tanam'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= $perawatan['luas'] ?> ha</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp <?= number_format($perawatan['total_upah'], 0, ',', '.') ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="perawatan.php?action=view&id=<?= $perawatan['perawatan_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="perawatan.php?action=edit&id=<?= $perawatan['perawatan_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php elseif ($action === 'view' && $selected_perawatan): ?>
            <!-- Halaman Detail Perawatan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Perawatan #PRW-<?= $selected_perawatan['perawatan_id'] ?></h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Lahan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $lahan[$selected_perawatan['plot_id']]['name'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Petani</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $lahan[$selected_perawatan['plot_id']]['farmer_name'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tahun Tanam</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $selected_perawatan['tahun_tanam'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Luas (ha)</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $selected_perawatan['luas'] ?> ha</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Total Upah (Rp)</label>
                            <p class="mt-1 text-sm text-gray-900">Rp <?= number_format($selected_perawatan['total_upah'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Kegiatan Perawatan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pekerjaan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerja</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Upah (Rp)</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($selected_perawatan['perawatan_detil'] as $detail): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $jenis_pekerjaan[$detail['jenis_pekerjaan_id']]['name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $pekerja[$detail['pekerja_id']]['name'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= date('d/m/Y', strtotime($detail['date'])) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?= number_format($detail['upah'], 0, ',', '.') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $detail['jml'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php elseif ($action === 'add'): ?>
            <!-- Form Tambah Perawatan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Data Perawatan</h2>
                    <form id="addForm" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                <select id="lahan_id" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lahan</option>
                                    <?php foreach ($lahan as $id => $data): ?>
                                        <option value="<?= $id ?>"><?= $data['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="petani-info" class="mt-2 text-sm text-gray-500 hidden">
                                    Petani: <span id="petani-name"></span>
                                </div>
                            </div>
                            <div>
                                <label for="tahun_tanam" class="block text-sm font-medium text-gray-700">Tahun Tanam</label>
                                <input type="number" id="tahun_tanam" name="tahun_tanam" min="1900" max="2100" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="luas" class="block text-sm font-medium text-gray-700">Luas (ha)</label>
                                <input type="number" step="0.01" id="luas" name="luas" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="total_upah" class="block text-sm font-medium text-gray-700">Total Upah (Rp)</label>
                                <input type="number" id="total_upah" name="total_upah" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Perawatan</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($action === 'edit' && $selected_perawatan): ?>
            <!-- Form Edit Perawatan -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Perawatan #PRW-<?= $selected_perawatan['perawatan_id'] ?></h2>
                    <form id="editForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                <select id="lahan_id" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Lahan</option>
                                    <?php foreach ($lahan as $id => $data): ?>
                                        <option value="<?= $id ?>" <?= ($id == $selected_perawatan['plot_id']) ? 'selected' : '' ?>><?= $data['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="petani-info" class="mt-2 text-sm text-gray-500">
                                    Petani: <span id="petani-name"><?= $lahan[$selected_perawatan['plot_id']]['farmer_name'] ?></span>
                                </div>
                            </div>
                            <div>
                                <label for="tahun_tanam" class="block text-sm font-medium text-gray-700">Tahun Tanam</label>
                                <input type="number" id="tahun_tanam" name="tahun_tanam" min="1900" max="2100" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['tahun_tanam'] ?>">
                            </div>
                            <div>
                                <label for="luas" class="block text-sm font-medium text-gray-700">Luas (ha)</label>
                                <input type="number" step="0.01" id="luas" name="luas" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['luas'] ?>">
                            </div>
                            <div>
                                <label for="total_upah" class="block text-sm font-medium text-gray-700">Total Upah (Rp)</label>
                                <input type="number" id="total_upah" name="total_upah" min="0" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= $selected_perawatan['total_upah'] ?>">
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
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    // Fungsi untuk menampilkan nama petani saat lahan dipilih
    document.getElementById('lahan_id').addEventListener('change', function() {
        const selectedLahanId = this.value;
        const petaniInfo = document.getElementById('petani-info');
        const petaniName = document.getElementById('petani-name');
        
        // Data lahan dari PHP ke JavaScript
        const lahanData = <?= json_encode($lahan) ?>;
        
        if (selectedLahanId !== '') {
            petaniInfo.classList.remove('hidden');
            petaniName.textContent = lahanData[selectedLahanId]['farmer_name'];
        } else {
            petaniInfo.classList.add('hidden');
            petaniName.textContent = '';
        }
    });
</script>

<?php include 'footer.php'; ?>