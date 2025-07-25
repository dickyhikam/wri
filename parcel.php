<?php include 'header.php'; ?>

<?php
// Simulasi action (add/view/edit)
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Dummy data with new ID format
// Dummy data with all fields
// Handle form submission
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize parcels array in session if not exists
if (!isset($_SESSION['parcels'])) {
    $_SESSION['parcels'] = [
        [
            'parcel_id' => 'ID084d862d5',
            'id' => 'ID084d862d5',
            'rspo' => 'Ya',
            'nama_petani' => 'Petani 1',
            'nik' => '1408060907930001',
            'npwp' => 'Tidak Ada',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Berumbung Baru',
            'tanggal_lahir' => '1973-09-07',
            'alamat_domisili' => 'Alamat lengkap sesuai KTP',
            'id_lahan' => '14.08.06.2006.KMJ.0001',
            'provinsi' => 'Riau',
            'kabupaten' => 'Siak',
            'kecamatan' => 'Dayun',
            'desa' => 'Berumbung Baru',
            'kategori_kebun' => 'Kebun',
            'jenis_tanah' => 'Mineral',
            'status_pengelola' => 'Pemilik',
            'kelompok_tani' => 'Kelompok Tani',
            'tanggal_masuk' => '2024-02-05',
            'tahun_tanam' => 1986,
            'jml_pohon' => 260,
            'pola_tanam' => 'Monokultur',
            'luas_lahan' => 2.04,
            'status_lahan' => 'APL',
            'coordinates' => '',
            'bl_timur_jenis' => '',
            'bl_barat_jenis' => '',
            'bl_utara_jenis' => '',
            'bl_selatan_jenis' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]
    ];
}

$parcels = &$_SESSION['parcels'];

// Handle actions
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $new_parcel = [
        'parcel_id' => $_POST['parcel_id'] ?? 'ID' . uniqid(),
        'id' => $_POST['parcel_id'] ?? 'ID' . uniqid(),
        'rspo' => $_POST['rspo'] ?? 'Tidak',
        'nama_petani' => $_POST['nama_petani'] ?? '',
        'nik' => $_POST['nik'] ?? '',
        'npwp' => $_POST['npwp'] ?? 'Tidak Ada',
        'jenis_kelamin' => $_POST['jenis_kelamin'] ?? 'L',
        'tempat_lahir' => $_POST['tempat_lahir'] ?? '',
        'tanggal_lahir' => $_POST['tanggal_lahir'] ?? '',
        'alamat_domisili' => $_POST['alamat_domisili'] ?? '',
        'id_lahan' => $_POST['id_lahan'] ?? '',
        'provinsi' => $_POST['provinsi'] ?? 'Riau',
        'kabupaten' => $_POST['kabupaten'] ?? 'Siak',
        'kecamatan' => $_POST['kecamatan'] ?? 'Dayun',
        'desa' => $_POST['desa'] ?? 'Berumbung Baru',
        'kategori_kebun' => $_POST['kategori_kebun'] ?? 'Kebun',
        'jenis_tanah' => $_POST['jenis_tanah'] ?? 'Mineral',
        'status_pengelola' => $_POST['status_pengelola'] ?? 'Pemilik',
        'kelompok_tani' => $_POST['kelompok_tani'] ?? 'Kelompok Tani',
        'tanggal_masuk' => $_POST['tanggal_masuk'] ?? date('Y-m-d'),
        'tahun_tanam' => $_POST['tahun_tanam'] ?? date('Y'),
        'jml_pohon' => $_POST['jml_pohon'] ?? 0,
        'pola_tanam' => $_POST['pola_tanam'] ?? 'Monokultur',
        'luas_lahan' => $_POST['luas_lahan'] ?? 0,
        'status_lahan' => $_POST['status_lahan'] ?? 'APL',
        'coordinates' => $_POST['coordinates'] ?? '',
        'bl_timur_jenis' => $_POST['bl_timur_jenis'] ?? '',
        'bl_barat_jenis' => $_POST['bl_barat_jenis'] ?? '',
        'bl_utara_jenis' => $_POST['bl_utara_jenis'] ?? '',
        'bl_selatan_jenis' => $_POST['bl_selatan_jenis'] ?? '',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    // Add to parcels array
    $parcels[] = $new_parcel;
    
    // Redirect to prevent form resubmission
    header('Location: parcel.php');
    exit;
}

// Get current parcel for view/edit
$current_parcel = null;
if ($id && in_array($action, ['view', 'edit'])) {
    foreach ($parcels as $parcel) {
        if ($parcel['id'] === $id || $parcel['parcel_id'] === $id) {
            $current_parcel = $parcel;
            break;
        }
    }
}
?>

<section class="flex-1 overflow-y-auto p-8 bg-gray-50">

    <?php if ($action == 'list'): ?>
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Parcel Kebun</h1>
            
            <a href="parcel.php?action=add" class="bg-[#F0AB00] hover:bg-[#D69E00] text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Parcel
            </a>
        </div>

        <!-- Filter and Search Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama Petani</label>
                    <input type="text" id="searchInput" placeholder="Masukkan nama petani..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status RSPO</label>
                    <select id="rspoFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                        <option value="">Semua</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                    <select id="kecamatanFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                        <option value="">Semua</option>
                        <option value="Dayun">Dayun</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
    <button id="exportBtn" class="mr-2 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Export</button>
    <button id="importBtn" class="mr-2 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">Import</button>
    <button id="applyFilter" class="px-4 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#D69E00]">Terapkan Filter</button>
</div>
        </div>

        <!-- Data Table -->
<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parcel ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">RSPO</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petani</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Lahan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas Lahan (Ha)</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="parcelTableBody">
                <?php foreach ($parcels as $parcel): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($parcel['parcel_id']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 <?= $parcel['rspo'] == 'Ya' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?> rounded-full text-xs">
                            <?= htmlspecialchars($parcel['rspo']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($parcel['nama_petani']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($parcel['nik']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($parcel['id_lahan']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($parcel['kecamatan']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($parcel['luas_lahan']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                            <?= htmlspecialchars($parcel['status_lahan']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="parcel.php?action=view&id=<?= $parcel['parcel_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-2"><i class="fas fa-eye"></i></a>
                        <a href="parcel.php?action=edit&id=<?= $parcel['parcel_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-2"><i class="fas fa-edit"></i></a>
                        <a href="#" onclick="confirmDelete('<?= $parcel['parcel_id'] ?>')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium"><?= count($parcels) ?></span> of <span class="font-medium"><?= count($parcels) ?></span> results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" aria-current="page" class="z-10 bg-[#F0AB00] border-[#F0AB00] text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>

        <script>
            // Filter functionality
            <script>
document.getElementById('applyFilter').addEventListener('click', function() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const rspoValue = document.getElementById('rspoFilter').value;
    const kecamatanValue = document.getElementById('kecamatanFilter').value;
    
    const rows = document.querySelectorAll('#parcelTableBody tr');
    
    rows.forEach(row => {
        const nama = row.cells[2].textContent.toLowerCase();
        const rspo = row.cells[1].textContent.trim();
        const kecamatan = row.cells[5].textContent.trim();
        
        const namaMatch = nama.includes(searchValue);
        const rspoMatch = rspoValue === '' || rspo.includes(rspoValue);
        const kecamatanMatch = kecamatanValue === '' || kecamatan.includes(kecamatanValue);
        
        if (namaMatch && rspoMatch && kecamatanMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Add event listeners for the new buttons
document.getElementById('exportBtn').addEventListener('click', function() {
    // Add your export functionality here
    console.log('Export button clicked');
    // Implement your export logic (e.g., export to Excel, CSV, etc.)
});

document.getElementById('importBtn').addEventListener('click', function() {
    // Add your import functionality here
    console.log('Import button clicked');
    // Implement your import logic (e.g., open file dialog, parse imported file)


// Note: The reset functionality is now removed as per HRD's request

            

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data parcel ini?')) {
        window.location.href = 'parcel.php?action=delete&id=' + id;
    }
}
        </script>

    <?php elseif ($action == 'add' || $action == 'edit'): ?>
    <!-- Form Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <?= ($action == 'add') ? 'Tambah Data Parcel' : 'Edit Data Parcel' ?>
        </h1>
        <a href="parcel.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <form method="post" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Column 1 - Data Petani -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Data Petani</h4>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Daftar RSPO</label>
                        <select name="rspo" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="Ya" <?= ($action == 'edit' && $current_parcel['rspo'] == 'Ya') ? 'selected' : '' ?>>Ya</option>
                            <option value="Tidak" <?= ($action == 'edit' && $current_parcel['rspo'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Petani</label>
                        <input type="text" name="nama_petani" value="<?= ($action == 'edit') ? $current_parcel['nama_petani'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                        <input type="text" name="nik" value="<?= ($action == 'edit') ? $current_parcel['nik'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. NPWP</label>
                        <input type="text" name="npwp" value="<?= ($action == 'edit') ? $current_parcel['npwp'] : 'Tidak Ada' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="L" <?= ($action == 'edit' && $current_parcel['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= ($action == 'edit' && $current_parcel['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="<?= ($action == 'edit') ? $current_parcel['tempat_lahir'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="<?= ($action == 'edit') ? $current_parcel['tanggal_lahir'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Domisili (Sesuai KTP)</label>
                        <textarea name="alamat_domisili" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]"><?= ($action == 'edit') ? $current_parcel['alamat_domisili'] : '' ?></textarea>
                    </div>
                </div>
                
                <!-- Column 2 - Data Lahan -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Data Lahan</h4>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Parcel ID</label>
                        <input type="text" name="parcel_id" value="<?= ($action == 'edit') ? $current_parcel['parcel_id'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]" <?= ($action == 'edit') ? 'readonly' : '' ?>>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Lahan</label>
                        <input type="text" name="id_lahan" value="<?= ($action == 'edit') ? $current_parcel['id_lahan'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                        <input type="text" name="provinsi" value="<?= ($action == 'edit') ? $current_parcel['provinsi'] : 'Riau' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten</label>
                        <input type="text" name="kabupaten" value="<?= ($action == 'edit') ? $current_parcel['kabupaten'] : 'Siak' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                        <input type="text" name="kecamatan" value="<?= ($action == 'edit') ? $current_parcel['kecamatan'] : 'Dayun' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Desa/Kelurahan</label>
                        <input type="text" name="desa" value="<?= ($action == 'edit') ? $current_parcel['desa'] : 'Berumbung Baru' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Kebun</label>
                        <select name="kategori_kebun" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="Kebun" <?= ($action == 'edit' && $current_parcel['kategori_kebun'] == 'Kebun') ? 'selected' : '' ?>>Kebun</option>
                            <option value="Lainnya" <?= ($action == 'edit' && $current_parcel['kategori_kebun'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Tanah</label>
                        <select name="jenis_tanah" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="Mineral" <?= ($action == 'edit' && $current_parcel['jenis_tanah'] == 'Mineral') ? 'selected' : '' ?>>Mineral</option>
                            <option value="Gambut" <?= ($action == 'edit' && $current_parcel['jenis_tanah'] == 'Gambut') ? 'selected' : '' ?>>Gambut</option>
                        </select>
                    </div>
                </div>
                
                <!-- Column 3 - Data Tambahan -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Informasi Tambahan</h4>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pengelola Lahan</label>
                        <select name="status_pengelola" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="Pemilik" <?= ($action == 'edit' && $current_parcel['status_pengelola'] == 'Pemilik') ? 'selected' : '' ?>>Pemilik</option>
                            <option value="Penggarap" <?= ($action == 'edit' && $current_parcel['status_pengelola'] == 'Penggarap') ? 'selected' : '' ?>>Penggarap</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Koperasi/Kelompok Tani</label>
                        <input type="text" name="kelompok_tani" value="<?= ($action == 'edit') ? $current_parcel['kelompok_tani'] : 'Kelompok Tani' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk Anggota</label>
                        <input type="date" name="tanggal_masuk" value="<?= ($action == 'edit') ? $current_parcel['tanggal_masuk'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam Perdana</label>
                        <input type="number" name="tahun_tanam" value="<?= ($action == 'edit') ? $current_parcel['tahun_tanam'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pokok Tegakan Pohon</label>
                        <input type="number" name="jml_pohon" value="<?= ($action == 'edit') ? $current_parcel['jml_pohon'] : '' ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pola Tanam</label>
                        <select name="pola_tanam" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="Monokultur" <?= ($action == 'edit' && $current_parcel['pola_tanam'] == 'Monokultur') ? 'selected' : '' ?>>Monokultur</option>
                            <option value="Polikultur" <?= ($action == 'edit' && $current_parcel['pola_tanam'] == 'Polikultur') ? 'selected' : '' ?>>Polikultur</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Lahan</label>
                        <select name="status_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                            <option value="APL" <?= ($action == 'edit' && $current_parcel['status_lahan'] == 'APL') ? 'selected' : '' ?>>APL</option>
                            <option value="HPK" <?= ($action == 'edit' && $current_parcel['status_lahan'] == 'HPK') ? 'selected' : '' ?>>HPK</option>
                            <option value="HL" <?= ($action == 'edit' && $current_parcel['status_lahan'] == 'HL') ? 'selected' : '' ?>>HL</option>
                            <option value="HGU" <?= ($action == 'edit' && $current_parcel['status_lahan'] == 'HGU') ? 'selected' : '' ?>>HGU</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Additional sections can be added here for more fields -->
            
            <div class="mt-6 flex justify-end">
                <button type="submit" name="save" class="bg-[#F0AB00] hover:bg-[#D69E00] text-white px-4 py-2 rounded-lg">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>


<?php elseif ($action == 'view' && $current_parcel): ?>
    <!-- View Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Parcel</h1>
        <div class="flex space-x-2">
            <a href="parcel.php?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="parcel.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- View Container -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Column 1 - Informasi Petani -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Informasi Petani</h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Parcel ID</p>
                            <p class="font-medium"><?= $current_parcel['parcel_id'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama Petani</p>
                            <p class="font-medium"><?= $current_parcel['nama_petani'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">NIK</p>
                            <p class="font-medium"><?= $current_parcel['nik'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">RSPO</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs"><?= $current_parcel['rspo'] ?></span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">NPWP</p>
                            <p class="font-medium"><?= $current_parcel['npwp'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                            <p class="font-medium"><?= $current_parcel['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tempat/Tanggal Lahir</p>
                            <p class="font-medium"><?= $current_parcel['tempat_lahir'] ?>, <?= date('d/m/Y', strtotime($current_parcel['tanggal_lahir'])) ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat Domisili</p>
                            <p class="font-medium"><?= $current_parcel['alamat_domisili'] ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Column 2 - Informasi Lahan -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Informasi Lahan</h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">ID Lahan</p>
                            <p class="font-medium"><?= $current_parcel['id_lahan'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="font-medium"><?= $current_parcel['desa'] ?>, <?= $current_parcel['kecamatan'] ?>, <?= $current_parcel['kabupaten'] ?>, <?= $current_parcel['provinsi'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori Kebun</p>
                            <p class="font-medium"><?= $current_parcel['kategori_kebun'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jenis Tanah</p>
                            <p class="font-medium"><?= $current_parcel['jenis_tanah'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Pengelola</p>
                            <p class="font-medium"><?= $current_parcel['status_pengelola'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kelompok Tani</p>
                            <p class="font-medium"><?= $current_parcel['kelompok_tani'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Masuk Anggota</p>
                            <p class="font-medium"><?= date('d/m/Y', strtotime($current_parcel['tanggal_masuk'])) ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tahun Tanam Perdana</p>
                            <p class="font-medium"><?= $current_parcel['tahun_tanam'] ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Column 3 - Informasi Tambahan -->
                <div>
                    <h4 class="font-medium text-gray-700 mb-3 border-b pb-2">Informasi Tambahan</h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Pokok Tegakan Pohon</p>
                            <p class="font-medium"><?= $current_parcel['jml_pohon'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pola Tanam</p>
                            <p class="font-medium"><?= $current_parcel['pola_tanam'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Lahan</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"><?= $current_parcel['status_lahan'] ?></span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Luas Lahan (Ha)</p>
                            <p class="font-medium"><?= $current_parcel['luas_lahan'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Koordinat Lahan</p>
                            <p class="font-medium text-xs"><?= $current_parcel['coordinates'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Batas Lahan</p>
                            <div class="text-xs">
                                <p>Timur: <?= $current_parcel['bl_timur_jenis'] ?></p>
                                <p>Barat: <?= $current_parcel['bl_barat_jenis'] ?></p>
                                <p>Utara: <?= $current_parcel['bl_utara_jenis'] ?></p>
                                <p>Selatan: <?= $current_parcel['bl_selatan_jenis'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional information sections can be added here -->
        </div>
    </div>
<?php endif; ?>
</section>

<?php include 'footer.php'; ?>