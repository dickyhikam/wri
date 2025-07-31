<?php
// --- VERSI VISUAL / PRESENTASI SEMATA ---
// Tidak ada koneksi database atau operasi CRUD
// Menggunakan data dummy hanya untuk tujuan tampilan
include 'header.php'; // Include header/navigasi standar

// --- DATA DUMMY SIMULASI (Hanya untuk tampilan) ---
// Data Daftar Pekerja (10 data lengkap)
$workers = [
    [
        'pekerja_id' => 'KMJ-001',
        'nik' => '1408062006890001',
        'name' => 'Agus Susanto',
        'position' => 'Mandor',
        'alamat' => 'Jl. Kenangan No. 45',
        'tgl_mulai' => '05/02/2024',
        'status' => 'Active',
        'upah' => 4500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0002',
        'farmer_id' => 'KMJ.14.08.06.2006.0002',
        'farmer_name' => 'Argo Kiswanto',
        'lahan_name' => 'Lahan A',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '12.345.678.9-123.0005',
        'gender' => 'Male',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1989-06-20',
        'agama' => 'Islam',
        'status_perkawinan' => 'Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-002',
        'nik' => '1408060402870001',
        'name' => 'Ari Kuswoyo',
        'position' => 'Pekerja Harian',
        'alamat' => 'Jl. Mawar No. 12',
        'tgl_mulai' => '15/03/2024',
        'status' => 'Active',
        'upah' => 2500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0003',
        'farmer_id' => 'KMJ.14.08.06.2006.0003',
        'farmer_name' => 'Supratman',
        'lahan_name' => 'Lahan B',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '98.765.432.1-987.000',
        'gender' => 'Female',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1987-02-04',
        'agama' => 'Kristen',
        'status_perkawinan' => 'Belum Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-003',
        'nik' => '1408061301620002',
        'name' => 'Bambang Sujatmoko',
        'position' => 'Operator Alat Berat',
        'alamat' => 'Jl. Melati No. 8',
        'tgl_mulai' => '10/01/2024',
        'status' => 'Inactive',
        'upah' => 3500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0003',
        'farmer_id' => 'KMJ.14.08.06.2006.0004',
        'farmer_name' => 'Bayu Sanjoyo',
        'lahan_name' => 'Lahan C',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '11.222.333.4-555.000',
        'gender' => 'Male',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1962-01-13',
        'agama' => 'Katolik',
        'status_perkawinan' => 'Cerai'
    ],
    [
        'pekerja_id' => 'KMJ-004',
        'nik' => '1408061505910001',
        'name' => 'Citra Dewi',
        'position' => 'Admin Kebun',
        'alamat' => 'Jl. Anggrek No. 5',
        'tgl_mulai' => '01/04/2024',
        'status' => 'Active',
        'upah' => 3000000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0005',
        'farmer_id' => 'KMJ.14.08.06.2006.0005',
        'farmer_name' => 'Dewi Sartika',
        'lahan_name' => 'Lahan D',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '33.444.555.6-777.000',
        'gender' => 'Female',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1991-05-15',
        'agama' => 'Islam',
        'status_perkawinan' => 'Belum Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-005',
        'nik' => '1408062207840002',
        'name' => 'Dodi Pratama',
        'position' => 'Supervisor',
        'alamat' => 'Jl. Dahlia No. 22',
        'tgl_mulai' => '20/03/2024',
        'status' => 'Active',
        'upah' => 5000000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0006',
        'farmer_id' => 'KMJ.14.08.06.2006.0006',
        'farmer_name' => 'Eko Prasetyo',
        'lahan_name' => 'Lahan E',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '55.666.777.8-999.000',
        'gender' => 'Male',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1984-07-22',
        'agama' => 'Islam',
        'status_perkawinan' => 'Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-006',
        'nik' => '1408063009930001',
        'name' => 'Eva Marlina',
        'position' => 'Pekerja Harian',
        'alamat' => 'Jl. Kamboja No. 10',
        'tgl_mulai' => '05/05/2024',
        'status' => 'Active',
        'upah' => 2500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0007',
        'farmer_id' => 'KMJ.14.08.06.2006.0007',
        'farmer_name' => 'Fajar Setiawan',
        'lahan_name' => 'Lahan F',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '77.888.999.0-111.000',
        'gender' => 'Female',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1993-09-30',
        'agama' => 'Kristen',
        'status_perkawinan' => 'Belum Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-007',
        'nik' => '1408061204650002',
        'name' => 'Faisal Rahman',
        'position' => 'Mandor',
        'alamat' => 'Jl. Teratai No. 15',
        'tgl_mulai' => '15/01/2024',
        'status' => 'Inactive',
        'upah' => 4500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0008',
        'farmer_id' => 'KMJ.14.08.06.2006.0008',
        'farmer_name' => 'Gunawan Susilo',
        'lahan_name' => 'Lahan G',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '99.000.111.2-333.000',
        'gender' => 'Male',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1965-04-12',
        'agama' => 'Islam',
        'status_perkawinan' => 'Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-008',
        'nik' => '1408060808870001',
        'name' => 'Gita Wulandari',
        'position' => 'Operator Alat Berat',
        'alamat' => 'Jl. Flamboyan No. 7',
        'tgl_mulai' => '10/02/2024',
        'status' => 'Active',
        'upah' => 3500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0009',
        'farmer_id' => 'KMJ.14.08.06.2006.0009',
        'farmer_name' => 'Hendra Kurniawan',
        'lahan_name' => 'Lahan H',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '22.333.444.5-666.000',
        'gender' => 'Female',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1987-08-08',
        'agama' => 'Islam',
        'status_perkawinan' => 'Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-009',
        'nik' => '1408062503960001',
        'name' => 'Hadi Prasetyo',
        'position' => 'Pekerja Harian',
        'alamat' => 'Jl. Manggis No. 3',
        'tgl_mulai' => '01/06/2024',
        'status' => 'Active',
        'upah' => 2500000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0010',
        'farmer_id' => 'KMJ.14.08.06.2006.0010',
        'farmer_name' => 'Indra Gunawan',
        'lahan_name' => 'Lahan I',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '44.555.666.7-888.000',
        'gender' => 'Male',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1996-03-25',
        'agama' => 'Islam',
        'status_perkawinan' => 'Belum Menikah'
    ],
    [
        'pekerja_id' => 'KMJ-010',
        'nik' => '1408061007740002',
        'name' => 'Indah Permata',
        'position' => 'Supervisor',
        'alamat' => 'Jl. Nangka No. 18',
        'tgl_mulai' => '15/04/2024',
        'status' => 'Active',
        'upah' => 5000000,
        'foto' => 'img/image.png',
        'village_name' => 'Berumbung Baru',
        'lahan_id' => '14.08.06.2006.KMJ.0011',
        'farmer_id' => 'KMJ.14.08.06.2006.0011',
        'farmer_name' => 'Joko Santoso',
        'lahan_name' => 'Lahan J',
        'kabupaten' => 'Siak',
        'kecamatan' => 'Dayun',
        'desa' => 'Berumbung Baru',
        'npwp' => '66.777.888.9-000.000',
        'gender' => 'Female',
        'tempat_lahir' => 'Siak',
        'tgl_lahir' => '1974-07-10',
        'agama' => 'Kristen',
        'status_perkawinan' => 'Menikah'
    ]
];

// Data Kontrak Pekerja (5 data lengkap)
$workerContracts = [
    [
        'contract_id' => 1,
        'pekerja_id' => 'KMJ-001',
        'contract_number' => 'KONT/2024/001',
        'start_date' => '2024-02-05',
        'end_date' => '2025-02-04',
        'contract_type' => 'Tahunan',
        'salary' => 4500000,
        'status' => 'Active',
        'created_at' => '2024-02-01 10:00:00'
    ],
    [
        'contract_id' => 2,
        'pekerja_id' => 'KMJ-002',
        'contract_number' => 'KONT/2024/002',
        'start_date' => '2024-03-15',
        'end_date' => '2024-12-31',
        'contract_type' => 'Musiman',
        'salary' => 2500000,
        'status' => 'Active',
        'created_at' => '2024-03-10 14:30:00'
    ],
    [
        'contract_id' => 3,
        'pekerja_id' => 'KMJ-003',
        'contract_number' => 'KONT/2024/003',
        'start_date' => '2024-01-10',
        'end_date' => '2024-06-30',
        'contract_type' => 'Percobaan',
        'salary' => 3500000,
        'status' => 'Expired',
        'created_at' => '2024-01-05 09:15:00'
    ],
    [
        'contract_id' => 4,
        'pekerja_id' => 'KMJ-004',
        'contract_number' => 'KONT/2024/004',
        'start_date' => '2024-04-01',
        'end_date' => '2025-03-31',
        'contract_type' => 'Tahunan',
        'salary' => 3000000,
        'status' => 'Active',
        'created_at' => '2024-03-25 11:20:00'
    ],
    [
        'contract_id' => 5,
        'pekerja_id' => 'KMJ-005',
        'contract_number' => 'KONT/2024/005',
        'start_date' => '2024-03-20',
        'end_date' => '2024-12-31',
        'contract_type' => 'Musiman',
        'salary' => 5000000,
        'status' => 'Active',
        'created_at' => '2024-03-15 09:45:00'
    ]
];

// Data Jenis Fasilitas (4 data lengkap)
$facilityTypes = [
    ['type_id' => 1, 'type_name' => 'Perumahan', 'description' => 'Tempat tinggal pekerja'],
    ['type_id' => 2, 'type_name' => 'Transportasi', 'description' => 'Kendaraan operasional'],
    ['type_id' => 3, 'type_name' => 'Kesehatan', 'description' => 'Fasilitas kesehatan'],
    ['type_id' => 4, 'type_name' => 'Makanan', 'description' => 'Makanan dan minuman']
];

// Data Fasilitas Pekerja (5 data lengkap)
$workerFacilities = [
    [
        'facility_id' => 1,
        'pekerja_id' => 'KMJ-001',
        'type_id' => 1,
        'facility_name' => 'Rumah 01',
        'description' => 'Rumah tinggal di komplek A',
        'start_date' => '2024-02-05',
        'end_date' => '2025-02-04',
        'status' => 'Active'
    ],
    [
        'facility_id' => 2,
        'pekerja_id' => 'KMJ-001',
        'type_id' => 2,
        'facility_name' => 'Motor Operasional',
        'description' => 'Sepeda motor untuk operasional',
        'start_date' => '2024-02-05',
        'end_date' => '2025-02-04',
        'status' => 'Active'
    ],
    [
        'facility_id' => 3,
        'pekerja_id' => 'KMJ-002',
        'type_id' => 4,
        'facility_name' => 'Makan Siang',
        'description' => 'Makan siang harian',
        'start_date' => '2024-03-15',
        'end_date' => '2024-12-31',
        'status' => 'Active'
    ],
    [
        'facility_id' => 4,
        'pekerja_id' => 'KMJ-004',
        'type_id' => 3,
        'facility_name' => 'Asuransi Kesehatan',
        'description' => 'Asuransi kesehatan tahunan',
        'start_date' => '2024-04-01',
        'end_date' => '2025-03-31',
        'status' => 'Active'
    ],
    [
        'facility_id' => 5,
        'pekerja_id' => 'KMJ-005',
        'type_id' => 1,
        'facility_name' => 'Rumah 02',
        'description' => 'Rumah tinggal di komplek B',
        'start_date' => '2024-03-20',
        'end_date' => '2024-12-31',
        'status' => 'Active'
    ]
];

// Simulasikan aksi
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$worker_id = isset($_GET['id']) ? $_GET['id'] : 'KMJ-001'; // Default ke worker 1 untuk view/edit
$subaction = isset($_GET['subaction']) ? $_GET['subaction'] : '';

// Simulasikan pekerja yang dipilih untuk view/edit
$worker = null;
if ($worker_id) {
    foreach ($workers as $w) {
        if ($w['pekerja_id'] == $worker_id) {
            $worker = $w;
            break;
        }
    }
}

// Dapatkan kontrak pekerja
$workerContractsList = array_filter($workerContracts, function ($c) use ($worker_id) {
    return $c['pekerja_id'] == $worker_id;
});

// Dapatkan fasilitas pekerja
$workerFacilitiesList = array_filter($workerFacilities, function ($f) use ($worker_id) {
    return $f['pekerja_id'] == $worker_id;
});

// Data Desa (untuk dropdown)
$villages = [
    ['village_id' => 1, 'village' => 'Desa Makmur'],
    ['village_id' => 2, 'village' => 'Desa Sejahtera'],
    ['village_id' => 3, 'village' => 'Desa Maju']
];

// Data Jabatan (untuk dropdown)
$positions = [
    'Mandor',
    'Pekerja Harian',
    'Operator Alat Berat',
    'Supervisor',
    'Admin Kebun'
];

// Jenis Kontrak (untuk dropdown)
$contractTypes = [
    'Tahunan',
    'Musiman',
    'Percobaan',
    'Harian'
];

// Data Agama (untuk dropdown)
$religions = [
    'Islam',
    'Kristen',
    'Katolik',
    'Hindu',
    'Buddha',
    'Konghucu'
];

// Data Status Perkawinan (untuk dropdown)
$maritalStatuses = [
    'Belum Menikah',
    'Menikah',
    'Cerai'
];

// Filter data
$filterStatus = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
$filterPosition = isset($_GET['filter_position']) ? $_GET['filter_position'] : '';
$filterKecamatan = isset($_GET['filter_kecamatan']) ? $_GET['filter_kecamatan'] : '';
$filterFacility = isset($_GET['filter_facility']) ? $_GET['filter_facility'] : '';

// Daftar kecamatan unik untuk filter
$kecamatans = array_unique(array_column($workers, 'kecamatan'));

$filteredWorkers = $workers;

if ($filterStatus) {
    $filteredWorkers = array_filter($filteredWorkers, function ($w) use ($filterStatus) {
        return $w['status'] == $filterStatus;
    });
}

if ($filterPosition) {
    $filteredWorkers = array_filter($filteredWorkers, function ($w) use ($filterPosition) {
        return $w['position'] == $filterPosition;
    });
}

if ($filterKecamatan) {
    $filteredWorkers = array_filter($filteredWorkers, function ($w) use ($filterKecamatan) {
        return $w['kecamatan'] == $filterKecamatan;
    });
}

if ($filterFacility) {
    $workerIdsWithFacility = array_map(function ($f) {
        return $f['pekerja_id'];
    }, array_filter($workerFacilities, function ($f) use ($filterFacility) {
        return $f['type_id'] == $filterFacility;
    }));
    $filteredWorkers = array_filter($filteredWorkers, function ($w) use ($workerIdsWithFacility) {
        return in_array($w['pekerja_id'], $workerIdsWithFacility);
    });
}

if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = strtolower($_GET['search']);
    $filteredWorkers = array_filter($filteredWorkers, function ($f) use ($search) {
        return strpos(strtolower($f['name']), $search) !== false;
    });
}

// --- KONFIGURASI PAGINATION ---
$itemsPerPage = 5; // Jumlah item per halaman
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Halaman saat ini
$totalItems = count($filteredWorkers); // Total item setelah filter
$totalPages = ceil($totalItems / $itemsPerPage); // Total halaman
// Batasi currentPage agar tidak melebihi totalPages
$currentPage = min($currentPage, $totalPages);
// Ambil data untuk halaman saat ini
$startIndex = ($currentPage - 1) * $itemsPerPage;
$paginatedWorkers = array_slice($filteredWorkers, $startIndex, $itemsPerPage);
?>

<!-- Area Konten Utama -->
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah Pekerja Baru";
                elseif ($action == 'view') {
                    if ($subaction == 'contract') echo "Kontrak Kerja";
                    elseif ($subaction == 'facility') echo "Fasilitas Pekerja";
                    else echo "Profil Pekerja: " . ($worker ? htmlspecialchars($worker['name']) : '');
                } elseif ($action == 'edit') echo "Edit Pekerja: " . ($worker ? htmlspecialchars($worker['name']) : '');
                else echo "Manajemen Data Pekerja";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="pekerja?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Pekerja
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="pekerja" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <?php if ($subaction == ''): ?>
                    <a href="pekerja?action=edit&id=<?= $worker_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                <?php endif; ?>
            <?php elseif ($action == 'edit'): ?>
                <a href="pekerja?action=view&id=<?= $worker_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Konten Utama -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Pekerja -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="space-y-4">
                        <input type="hidden" name="action" value="list">
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Cari nama..">
                                <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Filter Status -->
                            <div>
                                <select id="filter_status" name="filter_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="Active" <?= $filterStatus == 'Active' ? 'selected' : '' ?>>Active</option>
                                    <option value="Inactive" <?= $filterStatus == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <!-- Filter Jabatan -->
                            <div>
                                <select id="filter_position" name="filter_position" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Jabatan</option>
                                    <?php foreach ($positions as $pos): ?>
                                        <option value="<?= $pos ?>" <?= $filterPosition == $pos ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($pos) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Filter Kecamatan -->
                            <div>
                                <select id="filter_kecamatan" name="filter_kecamatan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kecamatan</option>
                                    <?php foreach ($kecamatans as $kec): ?>
                                        <option value="<?= $kec ?>" <?= $filterKecamatan == $kec ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($kec) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Filter Jenis Fasilitas -->
                            <div>
                                <select id="filter_facility" name="filter_facility" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Fasilitas</option>
                                    <?php foreach ($facilityTypes as $type): ?>
                                        <option value="<?= $type['type_id'] ?>" <?= $filterFacility == $type['type_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($type['type_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pekerja</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pekerja</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($paginatedWorkers)): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data pekerja</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedWorkers as $index => $w):
                                    $rowNumber = $startIndex + $index + 1;
                                    $workerFacilities = array_filter($workerFacilities, function ($f) use ($w) {
                                        return $f['pekerja_id'] == $w['pekerja_id'];
                                    });
                                ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= $rowNumber ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['pekerja_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['position']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($w['kecamatan']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if (!empty($workerFacilities)): ?>
                                                <?php foreach ($workerFacilities as $f):
                                                    $facilityType = array_filter($facilityTypes, function ($t) use ($f) {
                                                        return $t['type_id'] == $f['type_id'];
                                                    });
                                                    $typeName = !empty($facilityType) ? reset($facilityType)['type_name'] : 'Unknown';
                                                ?>
                                                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mb-1">
                                                        <?= htmlspecialchars($typeName) ?>
                                                    </span><br>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span class="text-gray-500 text-sm">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $w['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $w['status'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="pekerja?action=view&id=<?= $w['pekerja_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Profil">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="pekerja?action=edit&id=<?= $w['pekerja_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus" onclick="alert('Fitur hapus hanya untuk demonstrasi. Data tidak akan benar-benar dihapus.'); return false;">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Sebelumnya
                        </a>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                            Selanjutnya
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium"><?= $startIndex + 1 ?></span> sampai <span class="font-medium"><?= min($startIndex + $itemsPerPage, $totalItems) ?></span> dari <span class="font-medium"><?= $totalItems ?></span> data
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Sebelumnya</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <?php
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                                if ($startPage > 1) {
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                    if ($startPage > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                }
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                                }
                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                    }
                                    echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                                }
                                ?>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Selanjutnya</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($action == 'view' && $worker): ?>
            <!-- View Pekerja -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Foto Profil -->
                        <div class="w-full md:w-1/4 flex flex-col items-center">
                            <div class="w-48 h-48 rounded-full bg-gray-200 mb-4 overflow-hidden border-4 border-gray-300">
                                <img src="<?= $worker['foto'] ?>" alt="Foto Profil" class="w-full h-full object-cover" onerror="this.src='img/default-profile.png'">
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 text-center"><?= htmlspecialchars($worker['name']) ?></h2>
                            <p class="text-gray-600 text-center"><?= htmlspecialchars($worker['position']) ?></p>
                            <div class="mt-2">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full <?= $worker['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= $worker['status'] ?>
                                </span>
                            </div>
                            <!-- Tab Navigasi -->
                            <div class="mt-6 w-full">
                                <nav class="flex flex-col space-y-2">
                                    <a href="pekerja?action=view&id=<?= $worker_id ?>" class="px-4 py-2 rounded-lg <?= $subaction == '' ? 'bg-blue-100 text-blue-800' : 'text-gray-700 hover:bg-gray-100' ?>">
                                        <i class="fas fa-user mr-2"></i> Profil
                                    </a>
                                    <a href="pekerja?action=view&id=<?= $worker_id ?>&subaction=contract" class="px-4 py-2 rounded-lg <?= $subaction == 'contract' ? 'bg-blue-100 text-blue-800' : 'text-gray-700 hover:bg-gray-100' ?>">
                                        <i class="fas fa-file-contract mr-2"></i> Kontrak Kerja
                                    </a>
                                    <a href="pekerja?action=view&id=<?= $worker_id ?>&subaction=facility" class="px-4 py-2 rounded-lg <?= $subaction == 'facility' ? 'bg-blue-100 text-blue-800' : 'text-gray-700 hover:bg-gray-100' ?>">
                                        <i class="fas fa-home mr-2"></i> Fasilitas
                                    </a>
                                </nav>
                            </div>
                        </div>
                        <!-- Detail Profil -->
                        <div class="w-full md:w-3/4">
                            <?php if ($subaction == ''): ?>
                                <!-- Tab Profil -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Pribadi</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">NIK</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['nik']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">NPWP</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['npwp']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['gender']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($worker['tgl_lahir'])) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Agama</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['agama']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Status Perkawinan</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['status_perkawinan']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Pekerjaan</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">ID Pekerja</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['pekerja_id']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Tanggal Mulai Bekerja</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['tgl_mulai']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Jabatan</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['position']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Upah</p>
                                            <p class="font-medium">Rp <?= number_format($worker['upah'], 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Alamat</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Alamat</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['alamat']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Desa</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['desa']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Kecamatan</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['kecamatan']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Kabupaten</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['kabupaten']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Informasi Lahan</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">ID Lahan</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['lahan_id']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Nama Lahan</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['lahan_name']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">ID Petani</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['farmer_id']) ?></p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Nama Petani</p>
                                            <p class="font-medium"><?= htmlspecialchars($worker['farmer_name']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($subaction == 'contract'): ?>
                                <!-- Tab Kontrak -->
                                <div class="mb-4 flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800">Kontrak Kerja</h3>
                                    <!-- <button class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center" onclick="alert('Fitur tambah kontrak hanya untuk demonstrasi.');">
                                        <i class="fas fa-plus mr-2"></i> Tambah Kontrak
                                    </button> -->
                                </div>

                                <!-- 🔴 CARD KONTRAK KERJA: Hubungan Pekerja-Lahan-Petani -->
                                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <h4 class="font-semibold text-blue-800 mb-3">Alokasi Lahan dalam Kontrak Kerja</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                        <div><strong>ID Pekerja:</strong> <?= htmlspecialchars($worker['pekerja_id']) ?></div>
                                        <div><strong>ID Lahan:</strong> <?= htmlspecialchars($worker['lahan_id']) ?></div>
                                        <div><strong>Nama Lahan:</strong> <?= htmlspecialchars($worker['lahan_name']) ?></div>
                                        <div><strong>ID Petani:</strong> <?= htmlspecialchars($worker['farmer_id']) ?></div>
                                        <div><strong>Nama Petani:</strong> <?= htmlspecialchars($worker['farmer_name']) ?></div>
                                    </div>
                                </div>

                                <?php if (empty($workerContractsList)): ?>
                                    <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500">
                                        Tidak ada data kontrak untuk pekerja ini
                                    </div>
                                <?php else: ?>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kontrak</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Upah</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php foreach ($workerContractsList as $c): ?>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($c['contract_number']) ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($c['contract_type']) ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap"><?= date('d/m/Y', strtotime($c['start_date'])) ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap"><?= date('d/m/Y', strtotime($c['end_date'])) ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?= number_format($c['salary'], 0, ',', '.') ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $c['status'] == 'Active' ? 'bg-green-100 text-green-800' : ($c['status'] == 'Expired' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800') ?>">
                                                                <?= $c['status'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3" onclick="alert('Fitur lihat detail kontrak hanya untuk demonstrasi.'); return false;">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-3" onclick="alert('Fitur edit kontrak hanya untuk demonstrasi.'); return false;">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="#" class="text-red-600 hover:text-red-900" onclick="alert('Fitur hapus kontrak hanya untuk demonstrasi.'); return false;">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            <?php elseif ($subaction == 'facility'): ?>
                                <!-- Tab Fasilitas -->
                                <div class="mb-4 flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800">Fasilitas yang Diterima</h3>
                                    <button class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center" onclick="alert('Fitur tambah fasilitas hanya untuk demonstrasi.');">
                                        <i class="fas fa-plus mr-2"></i> Tambah Fasilitas
                                    </button>
                                </div>
                                <?php if (empty($workerFacilitiesList)): ?>
                                    <div class="bg-gray-50 p-4 rounded-lg text-center text-gray-500">
                                        Tidak ada data fasilitas untuk pekerja ini
                                    </div>
                                <?php else: ?>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Fasilitas</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <?php foreach ($workerFacilitiesList as $f):
                                                    $type = array_filter($facilityTypes, function ($t) use ($f) {
                                                        return $t['type_id'] == $f['type_id'];
                                                    });
                                                    $typeName = !empty($type) ? reset($type)['type_name'] : 'Unknown';
                                                ?>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($typeName) ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['facility_name']) ?></td>
                                                        <td class="px-6 py-4"><?= htmlspecialchars($f['description']) ?></td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <?= date('d/m/Y', strtotime($f['start_date'])) ?> - <?= date('d/m/Y', strtotime($f['end_date'])) ?>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $f['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                                                <?= $f['status'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3" onclick="alert('Fitur lihat detail fasilitas hanya untuk demonstrasi.'); return false;">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-3" onclick="alert('Fitur edit fasilitas hanya untuk demonstrasi.'); return false;">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="#" class="text-red-600 hover:text-red-900" onclick="alert('Fitur hapus fasilitas hanya untuk demonstrasi.'); return false;">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (($action == 'add' || $action == 'edit') && ($action != 'edit' || $worker)): ?>
            <!-- Form Tambah/Edit Pekerja -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <form>
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-4">
                                <h3 class="text-lg font-medium text-gray-900">Informasi Pribadi</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" value="<?= $action == 'edit' ? htmlspecialchars($worker['name']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK <span class="text-red-500">*</span></label>
                                    <input type="text" id="nik" name="nik" value="<?= $action == 'edit' ? htmlspecialchars($worker['nik']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div style="display: none;">
                                    <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                                    <input type="text" id="npwp" name="npwp" value="<?= $action == 'edit' ? htmlspecialchars($worker['npwp']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <select id="gender" name="gender" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="Male" <?= $action == 'edit' && $worker['gender'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Female" <?= $action == 'edit' && $worker['gender'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
                                    <select id="agama" name="agama" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <?php foreach ($religions as $religion): ?>
                                            <option value="<?= $religion ?>" <?= $action == 'edit' && $worker['agama'] == $religion ? 'selected' : '' ?>><?= $religion ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="<?= $action == 'edit' ? htmlspecialchars($worker['tempat_lahir']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $action == 'edit' ? htmlspecialchars($worker['tgl_lahir']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="status_perkawinan" class="block text-sm font-medium text-gray-700">Status Perkawinan</label>
                                    <select id="status_perkawinan" name="status_perkawinan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <?php foreach ($maritalStatuses as $status): ?>
                                            <option value="<?= $status ?>" <?= $action == 'edit' && $worker['status_perkawinan'] == $status ? 'selected' : '' ?>><?= $status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                                    <input type="file" id="foto" name="foto" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                            </div>

                            <div class="border-b border-gray-200 pb-4 mt-6">
                                <h3 class="text-lg font-medium text-gray-900">Alamat</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
                                    <textarea id="alamat" name="alamat" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $action == 'edit' ? htmlspecialchars($worker['alamat']) : '' ?></textarea>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div>
                                    <label for="province_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                                    <select id="province_id" name="province_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="city_id" class="block text-sm font-medium text-gray-700">Kota</label>
                                    <select id="city_id" name="city_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="subdistrict_id" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                    <select id="subdistrict_id" name="subdistrict_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="village_id" class="block text-sm font-medium text-gray-700">Desa</label>
                                    <select id="village_id" name="village_id"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="border-b border-gray-200 pb-4 mt-6">
                                <h3 class="text-lg font-medium text-gray-900">Kontrak Kerja</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-1" id="form-container">
                                <div class="form-block grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div style="display: none;">
                                        <label for="pekerja_id" class="block text-sm font-medium text-gray-700">ID Pekerja</label>
                                        <input type="text" id="pekerja_id" name="pekerja_id" value="<?= $action == 'edit' ? htmlspecialchars($worker['pekerja_id']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="farmer_id" class="block text-sm font-medium text-gray-700">Petani</label>
                                        <select id="farmer_id" name="farmer_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Petani</option>
                                            <!-- Dynamic options for Farmer ID -->
                                        </select>
                                    </div>

                                    <div style="display: none;">
                                        <label for="farmer_name" class="block text-sm font-medium text-gray-700">Nama Petani</label>
                                        <input type="text" id="farmer_name" name="farmer_name" value="<?= $action == 'edit' ? htmlspecialchars($worker['farmer_name']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="lahan_id" class="block text-sm font-medium text-gray-700">Lahan</label>
                                        <select id="lahan_id" name="lahan_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Lahan</option>
                                            <!-- Dynamic options for Lahan ID will be populated based on selected farmer -->
                                        </select>
                                    </div>

                                    <div style="display: none;">
                                        <label for="lahan_name" class="block text-sm font-medium text-gray-700">Nama Lahan</label>
                                        <input type="text" id="lahan_name" name="lahan_name" value="<?= $action == 'edit' ? htmlspecialchars($worker['lahan_name']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai Bekerja</label>
                                        <input type="date" id="tgl_mulai" name="tgl_mulai" value="<?= $action == 'edit' ? htmlspecialchars($worker['tgl_mulai']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="tgl_mulai" class="block text-sm font-medium text-gray-700">Tanggal Terakhir Bekerja</label>
                                        <input type="date" id="tgl_akhir" name="tgl_akhir" value="<?= $action == 'edit' ? htmlspecialchars($worker['tgl_akhir']) : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="upah" class="block text-sm font-medium text-gray-700">Upah</label>
                                        <input type="text" id="upah" name="upah" value="<?= $action == 'edit' ? number_format($worker['upah'], 0, ',', '.') : '' ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="Active" <?= $action == 'edit' && $worker['status'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                                            <option value="Inactive" <?= $action == 'edit' && $worker['status'] == 'Inactive' ? 'selected' : '' ?>>Non-Aktif</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <button type="button" onclick="addForm()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Kontrak Kerja Baru</button>
                            <div class="flex justify-end pt-6">
                                <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg mr-3" onclick="window.location.href='pekerja'">
                                    Batal
                                </button>
                                <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                                    <?= $action == 'add' ? 'Tambah Pekerja' : 'Simpan Perubahan' ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    let formContainer = document.getElementById("form-container");

    function addForm() {
        let newForm = document.querySelector(".form-block").cloneNode(true);

        // Add a delete button for the new form
        let deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.textContent = "Hapus";
        deleteButton.classList.add("mt-2", "px-4", "py-2", "bg-red-500", "text-white", "rounded");
        deleteButton.onclick = function() {
            formContainer.removeChild(newForm);
        };

        newForm.appendChild(deleteButton);

        // Add a horizontal line (HR) separator
        let separator = document.createElement("hr");
        separator.classList.add("my-4", "border-t", "border-gray-300");
        newForm.appendChild(separator);

        formContainer.appendChild(newForm);
    }

    // Dummy data for Provinces, Cities, Districts, and Villages
    const provinces = [{
            code: "11",
            name: "Aceh"
        },
        {
            code: "51",
            name: "Bali"
        },
        {
            code: "36",
            name: "Banten"
        },
        {
            code: "17",
            name: "Bengkulu"
        },
        {
            code: "34",
            name: "Daerah Istimewa Yogyakarta"
        },
    ];

    const cities = {
        "11": [{
                code: "1101",
                name: "Banda Aceh"
            },
            {
                code: "1102",
                name: "Sabang"
            }
        ],
        "51": [{
                code: "5101",
                name: "Denpasar"
            },
            {
                code: "5102",
                name: "Badung"
            }
        ],
        "36": [{
                code: "3601",
                name: "Serang"
            },
            {
                code: "3602",
                name: "Cilegon"
            }
        ],
        "17": [{
                code: "1701",
                name: "Bengkulu City"
            },
            {
                code: "1702",
                name: "Rejang Lebong"
            }
        ],
        "34": [{
                code: "3401",
                name: "Yogyakarta"
            },
            {
                code: "3402",
                name: "Sleman"
            }
        ],
    };

    const districts = {
        "1101": [{
                code: "110101",
                name: "Banda Aceh Timur"
            },
            {
                code: "110102",
                name: "Kuta Alam"
            }
        ],
        "5101": [{
                code: "510101",
                name: "Denpasar Barat"
            },
            {
                code: "510102",
                name: "Denpasar Timur"
            }
        ],
        "3601": [{
                code: "360101",
                name: "Serang Kota"
            },
            {
                code: "360102",
                name: "Cikande"
            }
        ],
        "1701": [{
                code: "170101",
                name: "Bengkulu Utara"
            },
            {
                code: "170102",
                name: "Bengkulu Selatan"
            }
        ],
        "3401": [{
                code: "340101",
                name: "Yogyakarta Kota"
            },
            {
                code: "340102",
                name: "Sleman Barat"
            }
        ],
    };

    const villages = {
        "110101": [{
                code: "11010101",
                name: "Paya Bili"
            },
            {
                code: "11010102",
                name: "Kuta Alam Selatan"
            }
        ],
        "510101": [{
                code: "51010101",
                name: "Pemecutan Klod"
            },
            {
                code: "51010102",
                name: "Pemecutan Kaja"
            }
        ],
        "360101": [{
                code: "36010101",
                name: "Cigode"
            },
            {
                code: "36010102",
                name: "Kedung Hutan"
            }
        ],
        "170101": [{
                code: "17010101",
                name: "Pahlawan"
            },
            {
                code: "17010102",
                name: "Kampung Baru"
            }
        ],
        "340101": [{
                code: "34010101",
                name: "Catur Tunggal"
            },
            {
                code: "34010102",
                name: "Sleman Tengah"
            }
        ],
    };

    // Populate Province Dropdown
    const provinceSelect = document.getElementById('province_id');
    provinces.forEach(province => {
        const option = document.createElement('option');
        option.value = province.code;
        option.textContent = province.name;
        provinceSelect.appendChild(option);
    });

    // Event listener for Province selection
    document.getElementById('province_id').addEventListener('change', function() {
        const provinceId = this.value;
        if (provinceId) {
            // Populate City Dropdown based on selected Province
            const citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';
            cities[provinceId].forEach(city => {
                const option = document.createElement('option');
                option.value = city.code;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        }
    });

    // Event listener for City selection
    document.getElementById('city_id').addEventListener('change', function() {
        const cityId = this.value;
        if (cityId) {
            // Populate District Dropdown based on selected City
            const subdistrictSelect = document.getElementById('subdistrict_id');
            subdistrictSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            districts[cityId].forEach(district => {
                const option = document.createElement('option');
                option.value = district.code;
                option.textContent = district.name;
                subdistrictSelect.appendChild(option);
            });
        }
    });

    // Event listener for District selection
    document.getElementById('subdistrict_id').addEventListener('change', function() {
        const districtId = this.value;
        if (districtId) {
            // Populate Village Dropdown based on selected District
            const villageSelect = document.getElementById('village_id');
            villageSelect.innerHTML = '<option value="">Pilih Desa</option>';
            villages[districtId].forEach(village => {
                const option = document.createElement('option');
                option.value = village.code;
                option.textContent = village.name;
                villageSelect.appendChild(option);
            });
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Dummy Data for Petani (Farmer) and Lahan (Land)
        const petaniData = {
            'P001': {
                'name': 'Petani A',
                'lahan_ids': ['L001', 'L002']
            },
            'P002': {
                'name': 'Petani B',
                'lahan_ids': ['L003']
            },
            'P003': {
                'name': 'Petani C',
                'lahan_ids': ['L004', 'L005']
            }
        };

        const lahanData = {
            'L001': {
                'name': 'Lahan A',
                'farmer_id': 'P001'
            },
            'L002': {
                'name': 'Lahan B',
                'farmer_id': 'P001'
            },
            'L003': {
                'name': 'Lahan C',
                'farmer_id': 'P002'
            },
            'L004': {
                'name': 'Lahan D',
                'farmer_id': 'P003'
            },
            'L005': {
                'name': 'Lahan E',
                'farmer_id': 'P003'
            }
        };

        // Get the DOM elements
        const lahanSelect = document.getElementById('lahan_id');
        const farmerSelect = document.getElementById('farmer_id');
        const lahanName = document.getElementById('lahan_name');
        const farmerName = document.getElementById('farmer_name');

        // Populate the Farmer dropdown
        for (const [id, petani] of Object.entries(petaniData)) {
            const option = document.createElement('option');
            option.value = id;
            option.textContent = petani.name;
            farmerSelect.appendChild(option);
        }
        for (const [id, petani] of Object.entries(lahanData)) {
            const option = document.createElement('option');
            option.value = id;
            option.textContent = petani.name;
            lahanSelect.appendChild(option);
        }

        // Populate the Lahan dropdown based on selected farmer
        farmerSelect.addEventListener('change', function() {
            const selectedFarmerId = this.value;
            lahanSelect.innerHTML = '<option value="">Pilih ID Lahan</option>'; // Reset Lahan dropdown

            if (selectedFarmerId) {
                // Populate Lahan dropdown with the lands of the selected farmer
                const selectedPetani = petaniData[selectedFarmerId];
                selectedPetani.lahan_ids.forEach(lahanId => {
                    const option = document.createElement('option');
                    option.value = lahanId;
                    option.textContent = lahanData[lahanId].name;
                    lahanSelect.appendChild(option);
                });

                // Set the farmer name based on selected farmer
                farmerName.value = selectedPetani.name;
            } else {
                // Reset fields if no farmer is selected
                lahanName.value = '';
                farmerName.value = '';
            }
        });

        // Populate the Farmer and Lahan fields based on selected land
        lahanSelect.addEventListener('change', function() {
            const selectedLahanId = this.value;
            if (selectedLahanId) {
                // Set the corresponding Farmer ID based on selected land
                const selectedLahan = lahanData[selectedLahanId];
                farmerSelect.value = selectedLahan.farmer_id;

                // Set the Lahan name based on selected land
                lahanName.value = selectedLahan.name;

                // Set the Farmer name based on corresponding farmer
                const selectedPetani = petaniData[selectedLahan.farmer_id];
                farmerName.value = selectedPetani.name;
            } else {
                // Reset fields if no land is selected
                farmerSelect.value = '';
                farmerName.value = '';
            }
        });
    });
</script>

<?php include 'footer.php'; ?>