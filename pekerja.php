<?php
// --- PURELY VISUAL / PRESENTATIONAL VERSION ---
// No database connection or CRUD operations.
// Uses dummy data for display purposes only.

include 'header.php'; // Include your standard header/navigation

// --- SIMULATED DUMMY DATA (Purely for display) ---
// Workers List Data
$workers = [
    [
        'pekerja_id' => 1,
        'nik' => '1408062006890001',
        'name' => 'Pekerja 3',
        'position' => 'Mandor',
        'alamat' => 'Alamat',
        'tgl_mulai' => '05/02/2024',
        'status' => 'Active',
        'upah' => 4500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0002', // Link to lahan
        'farmer_id' => 'KMJ.14.08.06.2006.0002',
        // --- Data untuk Tabel Utama ---
        'farmer_name' => 'Petani 3',
        'lahan_name' => 'Lahan C'
    ],
    [
        'pekerja_id' => 2,
        'nik' => '1408060402870001',
        'name' => 'Pekerja 4',
        'position' => 'Pekerja Harian',
        'alamat' => 'Alamat',
        'tgl_mulai' => '05/02/2024',
        'status' => 'Active',
        'upah' => 2500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0003',
        'farmer_id' => 'KMJ.14.08.06.2006.0003',
        // --- Data untuk Tabel Utama ---
        'farmer_name' => 'Petani 4',
        'lahan_name' => 'Lahan D'
    ],
    [
        'pekerja_id' => 3,
        'nik' => '1408061301620002',
        'name' => 'Pekerja 5',
        'position' => 'Operator Alat Berat',
        'alamat' => 'Alamat',
        'tgl_mulai' => '05/02/2024',
        'status' => 'Inactive',
        'upah' => 3500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0003',
        'farmer_id' => 'KMJ.14.08.06.2006.0004',
        // --- Data untuk Tabel Utama ---
        'farmer_name' => 'Petani 5',
        'lahan_name' => 'Lahan E'
    ]
];

// Profile Detail Data (for view action)
$workerProfile = [
    'pekerja_id' => 1,
    'nik' => '1234567890123456',
    'name' => 'Rudi Hartono',
    'npwp' => '01.234.567.8-912.345',
    'gender' => 'Male',
    'tempat_lahir' => 'Surabaya',
    'tgl_lahir' => '1985-07-20',
    'alamat' => 'Jl. Kenangan No. 45',
    'village_name' => 'Desa Makmur',
    'position' => 'Mandor',
    'tgl_mulai' => '2019-03-15',
    'status' => 'Active',
    'upah' => 4500000,
    'foto' => 'assets/default-avatar.jpg',
    'lahan_id' => 101,
    'farmer_id' => 201,
    // --- Data untuk View ---
    'farmer_name' => 'Petani Andi',
    'lahan_name' => 'Lahan A'
];

// Additional Profile Info (for view tab)
$dummyProfile = [
    'worker_id' => 1,
    'pendidikan_terakhir' => 'SMA',
    'pengalaman_kerja' => '5 tahun di perkebunan kelapa sawit',
    'status_pernikahan' => 'Menikah',
    'jumlah_tanggungan' => 2,
    'keterampilan_khusus' => 'Operasional alat berat, manajemen tim',
    'catatan_kesehatan' => 'Tekanan darah normal, alergi debu'
];

// Documents Data (for view tab)
$dummyDocuments = [
    [
        'document_id' => 1,
        'document_type' => 'KTP',
        'document_name' => 'Kartu Tanda Penduduk',
        'file_path' => 'assets/sample-ktp.jpg',
        'issue_date' => '2015-05-20',
        'expiry_date' => null,
        'status' => 'Active'
    ],
    [
        'document_id' => 2,
        'document_type' => 'Sertifikat',
        'document_name' => 'Sertifikat Operator Alat Berat',
        'file_path' => 'assets/sample-sertifikat.pdf',
        'issue_date' => '2018-08-15',
        'expiry_date' => '2023-08-15',
        'status' => 'Active'
    ]
];

// History Data (for view tab)
$dummyHistories = [
    [
        'history_id' => 1,
        'history_type' => 'Pelatihan',
        'description' => 'Mengikuti pelatihan keselamatan kerja',
        'event_date' => '2021-03-15',
        'recorded_by' => 1,
        'recorded_by_name' => 'Admin',
        'recorded_at' => '2021-03-15 14:30:00'
    ],
    [
        'history_id' => 2,
        'history_type' => 'Penghargaan',
        'description' => 'Pekerja terbaik bulan April 2022',
        'event_date' => '2022-05-01',
        'recorded_by' => 1,
        'recorded_by_name' => 'Admin',
        'recorded_at' => '2022-05-01 10:15:00'
    ]
];

// Villages Data (for dropdown)
$villages = [
    ['village_id' => 1, 'village' => 'Desa Makmur'],
    ['village_id' => 2, 'village' => 'Desa Sejahtera'],
    ['village_id' => 3, 'village' => 'Desa Maju']
];

// Positions Data (for dropdown)
$positions = [
    'Mandor',
    'Pekerja Harian',
    'Operator Alat Berat',
    'Supervisor',
    'Admin Kebun'
];

// Lahans and Petanis Data (for dropdown and auto-fill)
$lahans = [
    101 => ['lahan_name' => 'Lahan A', 'farmer_id' => 201],
    102 => ['lahan_name' => 'Lahan B', 'farmer_id' => 202],
    103 => ['lahan_name' => 'Lahan C', 'farmer_id' => 203]
];

$petanis = [
    201 => 'Petani Andi',
    202 => 'Petani Budi',
    203 => 'Petani Cici'
];

// Simulate action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$worker_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Default to worker 1 for view/edit

// Simulate selected worker for view/edit
$worker = null;
if ($worker_id > 0) {
    foreach ($workers as $w) {
        if ($w['pekerja_id'] == $worker_id) {
            $worker = $w;
            break;
        }
    }
    // Also populate for profile view if not found in list
    if (!$worker && $action === 'view') {
         $worker = $workerProfile;
    }
}
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 bg-white border-b shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah Pekerja Baru";
                elseif ($action == 'view') echo "Profil Pekerja: " . ($worker ? htmlspecialchars($worker['name']) : '');
                elseif ($action == 'edit') echo "Edit Pekerja: " . ($worker ? htmlspecialchars($worker['name']) : '');
                else echo "Data Pekerja";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="pekerja.php?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Pekerja
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="pekerja.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="pekerja.php?action=edit&id=<?= $worker_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            <?php elseif ($action == 'edit'): ?>
                <a href="pekerja.php?action=view&id=<?= $worker_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <!-- Notifikasi -->
        <?php if (isset($_GET['notif']) && $_GET['notif'] == 'success'): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">Operasi berhasil dilakukan!</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        <?php elseif (isset($_GET['notif']) && $_GET['notif'] == 'error'): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">Terjadi kesalahan dalam operasi!</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        <?php endif; ?>

        <?php if ($action == 'list'): ?>
            <!-- Daftar Pekerja -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex">
                        <input type="hidden" name="action" value="list">
                        <input type="text" name="search" class="flex-grow px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama pekerja...">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-lg flex items-center">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th> <!-- Kolom NIK dihapus -->
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pekerja</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petani</th> <!-- Kolom Nama Petani ditambahkan -->
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th> <!-- Kolom Nama Lahan ditambahkan -->
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($workers)): ?>
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data pekerja</td> <!-- Update colspan to 9 -->
                                </tr>
                            <?php else: ?>
                                <?php foreach ($workers as $index => $w): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $index + 1 ?></td>
                                        <!-- <td class="px-6 py-4 whitespace-nowrap><?#= htmlspecialchars($w['nik']) ?></td> <!-- Data NIK dihapus -->
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['name']) ?></td>
                                        <!-- Menampilkan Nama Petani dan Nama Lahan dari data dummy/array -->
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['farmer_name'] ?? 'Belum Ada Kontrak') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['lahan_name'] ?? 'Belum Ada Kontrak') ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['position']) ?></td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($w['alamat']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= date('d/m/Y', strtotime($w['tgl_mulai'])) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $w['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $w['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="pekerja.php?action=view&id=<?= $w['pekerja_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Profil">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="pekerja.php?action=edit&id=<?= $w['pekerja_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- Action button for delete (non-functional in this version) -->
                                            <button class="text-red-600 hover:text-red-900" title="Nonaktifkan" onclick="alert('Fitur nonaktifkan hanya untuk tampilan.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php elseif ($action == 'add' || $action == 'edit'): ?>
            <!-- Form Tambah/Edit Pekerja -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <form method="post" enctype="multipart/form-data" class="space-y-6">
                        <!-- Hidden inputs for form logic (non-functional) -->
                        <input type="hidden" name="<?= $action == 'add' ? 'add_worker' : 'update_worker' ?>" value="1">
                        <?php if ($action == 'edit'): ?>
                            <input type="hidden" name="worker_id" value="<?= $worker_id ?>">
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kolom Kiri -->
                            <div class="space-y-4">
                                <div>
                                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                                    <input type="text" id="nik" name="nik" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($worker['nik']) : '' ?>">
                                </div>
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        value="<?= $action == 'edit' ? htmlspecialchars($worker['name']) : '' ?>">
                                </div>
                                <div>
                                    <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                                    <input type="text" id="npwp" name="npwp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($worker['npwp'] ?? '') : '' ?>">
                                </div>
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                    <select id="gender" name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Male" <?= $action == 'edit' && ($worker['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Female" <?= $action == 'edit' && ($worker['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Perempuan</option>
                                        <option value="Other" <?= $action == 'edit' && ($worker['gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                                    <input type="file" id="foto" name="foto" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <?php if ($action == 'edit' && !empty($worker['foto'])): ?>
                                        <div class="mt-2 flex items-center">
                                            <img src="<?= htmlspecialchars($worker['foto']) ?>" alt="Foto Pekerja" class="h-16 w-16 rounded-full object-cover">
                                            <span class="ml-2 text-sm text-gray-500">Foto saat ini</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="space-y-4">
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($worker['tempat_lahir'] ?? '') : '' ?>">
                                </div>
                                <div>
                                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($worker['tgl_lahir'] ?? '') : '' ?>">
                                </div>
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                    <textarea id="alamat" name="alamat" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $action == 'edit' ? htmlspecialchars($worker['alamat']) : '' ?></textarea>
                                </div>
                                <div>
                                    <label for="village_id" class="block text-sm font-medium text-gray-700">Desa</label>
                                    <select id="village_id" name="village_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Desa</option>
                                        <?php foreach ($villages as $v): ?>
                                            <option value="<?= $v['village_id'] ?>" <?= $action == 'edit' && ($worker['village_id'] ?? 0) == $v['village_id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($v['village']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                    <select id="position" name="position" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Jabatan</option>
                                        <?php foreach ($positions as $pos): ?>
                                            <option value="<?= $pos ?>" <?= $action == 'edit' && ($worker['position'] ?? '') == $pos ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($pos) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- NAMA LAHAN DROPDOWN -->
                                <div>
                                    <label for="lahan_id" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                    <select id="lahan_id" name="lahan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Nama Lahan</option>
                                        <?php foreach ($lahans as $id => $l): ?>
                                            <option value="<?= $id ?>" <?= $action == 'edit' && ($worker['lahan_id'] ?? 0) == $id ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($l['lahan_name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- NAMA PETANI READ-ONLY -->
                                <div>
                                    <label for="farmer_name_display" class="block text-sm font-medium text-gray-700">Nama Petani</label>
                                    <input type="text" id="farmer_name_display" name="farmer_name_display" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-gray-100" value="<?= $action == 'edit' ? htmlspecialchars($petanis[$worker['farmer_id']] ?? '') : '' ?>">
                                    <!-- Hidden input to potentially send farmer_id if needed -->
                                    <input type="hidden" id="farmer_id" name="farmer_id" value="<?= $action == 'edit' ? htmlspecialchars($worker['farmer_id'] ?? '') : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai Bekerja</label>
                                <input type="date" id="tgl_mulai" name="tgl_mulai" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($worker['tgl_mulai']) : '' ?>">
                            </div>
                            <div>
                                <label for="upah" class="block text-sm font-medium text-gray-700">Gaji Pokok</label>
                                <input type="number" id="upah" name="upah" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? $worker['upah'] : '' ?>">
                            </div>
                        </div>

                        <?php if ($action == 'edit'): ?>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Active" <?= $worker['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                    <option value="Inactive" <?= $worker['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="flex justify-end space-x-3">
                            <a href="<?= $action == 'add' ? 'pekerja.php' : 'pekerja.php?action=view&id=' . $worker_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>
                            <button type="button" onclick="alert('Form simpan hanya untuk tampilan. Data tidak akan disimpan.')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($action == 'view' && $worker): ?>
            <!-- Tampilan Profil Pekerja -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Kolom Kiri - Profil -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="p-6 bg-gray-50 border-b">
                            <h3 class="text-lg font-medium text-gray-900">Profil Pekerja</h3>
                        </div>
                        <div class="p-6 text-center">
                            <?php if (!empty($worker['foto'])): ?>
                                <img src="<?= htmlspecialchars($worker['foto']) ?>" alt="Foto Pekerja" class="mx-auto h-32 w-32 rounded-full object-cover mb-4">
                            <?php else: ?>
                                <div class="mx-auto h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                                    <i class="fas fa-user text-4xl text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                            <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($worker['name']) ?></h3>
                            <p class="text-sm text-gray-500">NIK: <?= htmlspecialchars($worker['nik']) ?></p>
                            <p class="text-sm font-medium text-[#f0ab00] mt-1"><?= htmlspecialchars($worker['position']) ?></p>
                            <div class="mt-6 space-y-4 text-left">
                                <div>
                                    <p class="text-sm text-gray-500">NPWP</p>
                                    <!-- Perbaikan: Tampilkan data jika ada -->
                                    <p class="text-sm font-medium"><?= !empty($worker['npwp']) ? htmlspecialchars($worker['npwp']) : '-' ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                    <p class="text-sm font-medium">
                                        <?= ($worker['gender'] ?? '') == 'Male' ? 'Laki-laki' : (($worker['gender'] ?? '') == 'Female' ? 'Perempuan' : 'Lainnya') ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tempat/Tgl Lahir</p>
                                    <p class="text-sm font-medium">
                                        <?php
                                        $tempat = !empty($worker['tempat_lahir']) ? htmlspecialchars($worker['tempat_lahir']) : '';
                                        $tgl = !empty($worker['tgl_lahir']) ? date('d/m/Y', strtotime($worker['tgl_lahir'])) : '';
                                        if ($tempat === '' && $tgl === '') {
                                            echo '-';
                                        } else {
                                            echo $tempat . ($tempat && $tgl ? ', ' : '') . $tgl;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Alamat</p>
                                    <p class="text-sm font-medium"><?= htmlspecialchars($worker['alamat']) ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Desa</p>
                                    <p class="text-sm font-medium"><?= htmlspecialchars($worker['village_name']) ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Mulai Bekerja</p>
                                    <p class="text-sm font-medium"><?= date('d/m/Y', strtotime($worker['tgl_mulai'])) ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Gaji Pokok</p>
                                    <p class="text-sm font-medium">Rp <?= number_format($worker['upah'], 0, ',', '.') ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $worker['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $worker['status'] ?>
                                    </span>
                                </div>
                                <!-- NAMA LAHAN & PETANI DI PROFILE -->
                                <div>
                                    <p class="text-sm text-gray-500">Nama Lahan</p>
                                    <p class="text-sm font-medium"><?= htmlspecialchars($worker['lahan_name'] ?? 'Tidak Diketahui') ?></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Nama Petani</p>
                                    <p class="text-sm font-medium"><?= htmlspecialchars($worker['farmer_name'] ?? 'Tidak Diketahui') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kolom Kanan - Tab -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="border-b border-gray-200">
                            <nav class="flex -mb-px">
                                <a href="#profile" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-[#f0ab00] text-[#f0ab00]">
                                    Profil
                                </a>
                                <a href="#documents" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                    Dokumen
                                </a>
                                <a href="#history" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                    Riwayat
                                </a>
                            </nav>
                        </div>
                        <div class="p-6">
                            <!-- Tab Profil -->
                            <div id="profile-content" class="tab-content active">
                                <?php if (!$dummyProfile): ?>
                                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-info-circle text-blue-400"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-700">
                                                    Belum ada informasi profil tambahan untuk pekerja ini.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Tampilkan Informasi Tambahan dalam format tabel/grid di tab Profil -->
                                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                        <div class="p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Pendidikan Terakhir</p>
                                                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['pendidikan_terakhir']) ?></p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500">Status Pernikahan</p>
                                                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['status_pernikahan']) ?></p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500">Jumlah Tanggungan</p>
                                                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['jumlah_tanggungan']) ?></p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500">Pengalaman Kerja</p>
                                                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['pengalaman_kerja']) ?></p>
                                                </div>
                                                <div class="md:col-span-2">
                                                    <p class="text-sm text-gray-500">Keterampilan Khusus</p>
                                                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['keterampilan_khusus']) ?></p>
                                                </div>
                                                <div class="md:col-span-2">
                                                    <p class="text-sm text-gray-500">Catatan Kesehatan</p>
                                                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['catatan_kesehatan']) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tab Dokumen -->
                            <div id="documents-content" class="tab-content hidden">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-medium text-gray-900">Dokumen Pekerja</h3>
                                    <button onclick="alert('Modal tambah dokumen hanya untuk tampilan.')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                                        <i class="fas fa-plus mr-2"></i> Tambah Dokumen
                                    </button>
                                </div>
                                <?php if (empty($dummyDocuments)): ?>
                                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-info-circle text-blue-400"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-700">
                                                    Belum ada dokumen untuk pekerja ini.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        <?php foreach ($dummyDocuments as $doc): ?>
                                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                                <div class="p-4 text-center">
                                                    <?php
                                                    $file_ext = pathinfo($doc['file_path'], PATHINFO_EXTENSION);
                                                    $icon = 'fa-file-alt';
                                                    $color = 'text-blue-500';
                                                    if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                        $icon = 'fa-file-image';
                                                        $color = 'text-green-500';
                                                    } elseif (in_array($file_ext, ['pdf'])) {
                                                        $icon = 'fa-file-pdf';
                                                        $color = 'text-red-500';
                                                    } elseif (in_array($file_ext, ['doc', 'docx'])) {
                                                        $icon = 'fa-file-word';
                                                        $color = 'text-blue-600';
                                                    } elseif (in_array($file_ext, ['xls', 'xlsx'])) {
                                                        $icon = 'fa-file-excel';
                                                        $color = 'text-green-600';
                                                    }
                                                    ?>
                                                    <i class="fas <?= $icon ?> text-4xl <?= $color ?> mb-3"></i>
                                                    <h4 class="text-md font-medium text-gray-900"><?= htmlspecialchars($doc['document_name']) ?></h4>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        <?= strtoupper($doc['document_type']) ?>
                                                        <?php if ($doc['expiry_date']): ?>
                                                            <br>Kadaluarsa: <?= date('d/m/Y', strtotime($doc['expiry_date'])) ?>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 flex justify-between items-center">
                                                    <a href="<?= htmlspecialchars($doc['file_path']) ?>" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                        <i class="fas fa-download mr-1"></i> Unduh
                                                    </a>
                                                    <button type="button" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="alert('Fitur hapus dokumen hanya untuk tampilan.')">
                                                        <i class="fas fa-trash mr-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Tab Riwayat -->
                            <div id="history-content" class="tab-content hidden">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-medium text-gray-900">Riwayat Pekerja</h3>
                                    <button onclick="alert('Modal tambah riwayat hanya untuk tampilan.')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                                        <i class="fas fa-plus mr-2"></i> Tambah Riwayat
                                    </button>
                                </div>
                                <?php if (empty($dummyHistories)): ?>
                                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-info-circle text-blue-400"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-700">
                                                    Belum ada riwayat untuk pekerja ini.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="space-y-4">
                                        <?php foreach ($dummyHistories as $h): ?>
                                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="text-md font-medium text-gray-900"><?= htmlspecialchars($h['history_type']) ?></h4>
                                                        <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($h['description']) ?></p>
                                                        <p class="text-xs text-gray-500 mt-2">
                                                            <i class="far fa-calendar-alt mr-1"></i> <?= date('d/m/Y', strtotime($h['event_date'])) ?>
                                                        </p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-xs text-gray-500">
                                                            Dicatat oleh: <?= htmlspecialchars($h['recorded_by_name']) ?><br>
                                                            <?= date('d/m/Y H:i', strtotime($h['recorded_at'])) ?>
                                                        </p>
                                                        <button type="button" class="mt-2 text-red-600 hover:text-red-800 text-xs font-medium" onclick="alert('Fitur hapus riwayat hanya untuk tampilan.')">
                                                            <i class="fas fa-trash mr-1"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<!-- Modals would go here if needed for pure display -->

<script>
    // Fungsi untuk tab
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            // Update tab aktif
            document.querySelectorAll('.tab-link').forEach(t => {
                t.classList.remove('border-[#f0ab00]', 'text-[#f0ab00]');
                t.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-[#f0ab00]', 'text-[#f0ab00]');
            // Update konten aktif
            const target = this.getAttribute('href').substring(1);
            document.querySelectorAll('.tab-content').forEach(c => {
                c.classList.remove('active');
                c.classList.add('hidden');
            });
            document.getElementById(target + '-content').classList.remove('hidden');
            document.getElementById(target + '-content').classList.add('active');
        });
    });

    // Auto-fill Nama Petani based on Nama Lahan selection (Purely client-side for display)
    document.addEventListener('DOMContentLoaded', function () {
        const lahanSelect = document.getElementById('lahan_id');
        const farmerNameInput = document.getElementById('farmer_name_display');
        const farmerIdInput = document.getElementById('farmer_id');

        // Data for auto-fill (mimics database relationship)
        const lahanToFarmerMap = {
            <?php foreach ($lahans as $id => $l): ?>
                <?= $id ?>: { name: "<?= addslashes($petanis[$l['farmer_id']] ?? 'Tidak Diketahui') ?>", id: <?= $l['farmer_id'] ?> },
            <?php endforeach; ?>
        };

        if (lahanSelect && farmerNameInput && farmerIdInput) {
            lahanSelect.addEventListener('change', function () {
                const selectedLahanId = this.value;
                if (selectedLahanId && lahanToFarmerMap[selectedLahanId]) {
                    farmerNameInput.value = lahanToFarmerMap[selectedLahanId].name;
                    farmerIdInput.value = lahanToFarmerMap[selectedLahanId].id;
                } else {
                    farmerNameInput.value = '';
                    farmerIdInput.value = '';
                }
            });

            // Trigger change on page load if editing to populate initial value
            if (document.querySelector('input[name="update_worker"]')) {
                 const initialLahanId = lahanSelect.value;
                 if (initialLahanId && lahanToFarmerMap[initialLahanId]) {
                    farmerNameInput.value = lahanToFarmerMap[initialLahanId].name;
                    farmerIdInput.value = lahanToFarmerMap[initialLahanId].id;
                 }
            }
        }
    });
</script>

<?php include 'footer.php'; // Include your standard footer ?>