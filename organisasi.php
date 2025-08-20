<?php
// data organisasi_panen
include 'header.php';

// Simulasi data dummy
$dummyOrganisasi = [
    [
        'id' => 1,
        'nama_jabatan' => 'Direktur Utama',
        'urutan' => 1,
        'ics' => 'DIR-001',
        'anggota' => [
            ['id' => 1, 'nama' => 'Budi Santoso', 'email' => 'budi@perusahaan.com', 'telepon' => '081234567890'],
            ['id' => 2, 'nama' => 'Siti Rahayu', 'email' => 'siti@perusahaan.com', 'telepon' => '081298765432']
        ]
    ],
    [
        'id' => 2,
        'nama_jabatan' => 'Manager Operasional',
        'urutan' => 2,
        'ics' => 'MGR-002',
        'anggota' => [
            ['id' => 3, 'nama' => 'Ahmad Fauzi', 'email' => 'ahmad@perusahaan.com', 'telepon' => '081312345678'],
            ['id' => 4, 'nama' => 'Dewi Handayani', 'email' => 'dewi@perusahaan.com', 'telepon' => '081398765432']
        ]
    ],
    [
        'id' => 3,
        'nama_jabatan' => 'Supervisor Lapangan',
        'urutan' => 3,
        'ics' => 'SPV-003',
        'anggota' => [
            ['id' => 5, 'nama' => 'Rudi Hermawan', 'email' => 'rudi@perusahaan.com', 'telepon' => '081512345678'],
            ['id' => 6, 'nama' => 'Maya Indah', 'email' => 'maya@perusahaan.com', 'telepon' => '081598765432'],
            ['id' => 7, 'nama' => 'Joko Widodo', 'email' => 'joko@perusahaan.com', 'telepon' => '081612345678']
        ]
    ],
    [
        'id' => 4,
        'nama_jabatan' => 'Staf Administrasi',
        'urutan' => 4,
        'ics' => 'STF-004',
        'anggota' => [
            ['id' => 8, 'nama' => 'Rina Wijaya', 'email' => 'rina@perusahaan.com', 'telepon' => '081712345678'],
            ['id' => 9, 'nama' => 'Hendra Pratama', 'email' => 'hendra@perusahaan.com', 'telepon' => '081798765432'],
            ['id' => 10, 'nama' => 'Dian Sastro', 'email' => 'dian@perusahaan.com', 'telepon' => '081812345678']
        ]
    ],
    [
        'id' => 5,
        'nama_jabatan' => 'Koordinator Tim',
        'urutan' => 5,
        'ics' => 'KOR-005',
        'anggota' => [
            ['id' => 11, 'nama' => 'Fajar Nugroho', 'email' => 'fajar@perusahaan.com', 'telepon' => '081912345678'],
            ['id' => 12, 'nama' => 'Lina Marlina', 'email' => 'lina@perusahaan.com', 'telepon' => '081998765432']
        ]
    ]
];


$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Simulasi data yang dipilih
$selectedData = null;
if ($id) {
    foreach ($dummyOrganisasi as $data) {
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
                if ($action == 'add') echo "Tambah Organisasi";
                elseif ($action == 'view') echo "Detail Organisasi: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                elseif ($action == 'edit') echo "Edit Organisasi: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                else echo "Data Organisasi";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="organisasi?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Organisasi
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="organisasi" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="organisasi?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            <?php elseif ($action == 'edit'): ?>
                <a href="organisasi" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php elseif ($action == 'add'): ?>
                <a href="organisasi" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Organisasi -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="action" value="list">

                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari data organisasi...">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ICS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyOrganisasi as $organisasi): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($organisasi['nama_jabatan']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($organisasi['ics']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <ul>
                                            <?php foreach ($organisasi['anggota'] as $anggota): ?>
                                                <li><?= htmlspecialchars($anggota['nama']) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="organisasi?action=edit&id=<?= $organisasi['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('<?= $organisasi['id'] ?>')" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">2</span> data organisasi
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
            <!-- Form Tambah/Edit Organisasi -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <form class="space-y-6" enctype="multipart/form-data">
                        <!-- Form for Jabatan -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_jabatan" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['nama_jabatan'] : '' ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Urutan <span class="text-red-500">*</span></label>
                            <input type="number" name="urutan" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['urutan'] : '' ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">ICS <span class="text-red-500">*</span></label>
                            <input type="text" name="ics" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['ics'] : '' ?>" required>
                        </div>

                        <!-- Form for Anggota -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anggota</label>

                            <?php foreach ($selectedData['anggota'] as $index => $anggota): ?>
                                <div class="anggota-item mb-4 flex space-x-4 items-center" id="anggota-<?= $anggota['id'] ?>">
                                    <!-- Nama Anggota -->
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Anggota <span class="text-red-500">*</span></label>
                                        <input type="text" name="anggota[<?= $anggota['id'] ?>][nama]" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $anggota['nama'] : '' ?>" required>
                                    </div>

                                    <!-- Email Anggota -->
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Anggota <span class="text-red-500">*</span></label>
                                        <input type="email" name="anggota[<?= $anggota['id'] ?>][email]" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $anggota['email'] : '' ?>" required>
                                    </div>

                                    <!-- Telepon Anggota -->
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Anggota <span class="text-red-500">*</span></label>
                                        <input type="tel" name="anggota[<?= $anggota['id'] ?>][telepon]" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $anggota['telepon'] : '' ?>" required>
                                    </div>

                                    <!-- Delete button (for all but the first member) -->
                                    <?php if ($index > 0): ?>
                                        <button type="button" class="delete-anggota bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" onclick="deleteAnggota(<?= $anggota['id'] ?>)">
                                            Hapus Anggota
                                        </button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <div class="form_anggota"></div>

                            <!-- Add Anggota button -->
                            <button type="button" class="add-anggota bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg mt-4" onclick="addAnggota()">
                                Tambah Anggota
                            </button>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="<?= ($action == 'edit') ? 'organisasi' : 'organisasi' ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
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
    // Function to delete anggota
    function deleteAnggota(id) {
        const anggotaItem = document.getElementById('anggota-' + id);
        anggotaItem.remove();
    }

    // Function to add anggota
    function addAnggota() {
        const anggotaContainer = document.querySelector('div.form_anggota');
        const newAnggotaHTML = `
            <div class="anggota-item mb-4 flex space-x-4 items-center">
                <!-- Nama Anggota -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Anggota <span class="text-red-500">*</span></label>
                    <input type="text" name="anggota[new][nama]" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Email Anggota -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Anggota <span class="text-red-500">*</span></label>
                    <input type="email" name="anggota[new][email]" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Telepon Anggota -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Anggota <span class="text-red-500">*</span></label>
                    <input type="tel" name="anggota[new][telepon]" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Delete button -->
                <button type="button" class="delete-anggota bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" onclick="deleteAnggota('new')">
                    Hapus Anggota
                </button>
            </div>
        `;
        anggotaContainer.insertAdjacentHTML('beforeend', newAnggotaHTML);
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data organisasi ini?')) {
            // Simulasi penghapusan data
            alert('Transaksi dengan ID ' + id + ' telah dihapus');
            window.location.href = 'organisasi';
        }
    }
</script>

<?php include 'footer.php'; ?>