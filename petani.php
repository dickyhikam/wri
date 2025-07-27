
<?php 
// include 'config.php';
include 'header.php';
// Simulasi data dummy untuk contoh
$dummyFarmers = [
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0001',
        'name' => 'Petani 1',
        'nik' => '1408060103450001',
        'npwp' => '01.234.567.8-912.345',
        'gender' => 'Male',
        'tempat_lahir' => 'Berumbung Baru',
        'tgl_lahir' => '01/03/1945',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '05/02/2024',
        'status' => 'Active',
        'ics_id' => 1,
        'ics_name' => 'ICS Tani',
        'group_id' => 1,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok A-12',
        'pelatihan' => 'Pengolahan Tanah Organik'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0002',
        'name' => 'Petani 2',
        'nik' => '1408062006890001',
        'npwp' => '09.876.543.2-109.876',
        'gender' => 'Male',
        'tempat_lahir' => 'Indramayu',
        'tgl_lahir' => '20/06/1989',
        'alamat' => 'Alamat',
        'village_id' => 2,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 2,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 2,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '05/02/2024',
        'status' => 'Active',
        'ics_id' => 2,
        'ics_name' => 'ICS Tani',
        'group_id' => 2,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok B-05',
        'pelatihan' => 'Pemupukan Berimbang'
    ],
    // Add more dummy data for pagination demonstration
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0003',
        'name' => 'Petani 3',
        'nik' => '1408061507890001',
        'npwp' => '03.456.789.0-123.456',
        'gender' => 'Female',
        'tempat_lahir' => 'Dayun',
        'tgl_lahir' => '15/07/1989',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '10/03/2024',
        'status' => 'Active',
        'ics_id' => 1,
        'ics_name' => 'ICS Tani',
        'group_id' => 1,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok C-08',
        'pelatihan' => 'Pengendalian Hama'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0004',
        'name' => 'Petani 4',
        'nik' => '1408061205670001',
        'npwp' => '04.567.890.1-234.567',
        'gender' => 'Male',
        'tempat_lahir' => 'Berumbung Baru',
        'tgl_lahir' => '12/05/1967',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '15/01/2024',
        'status' => 'Inactive',
        'ics_id' => 2,
        'ics_name' => 'ICS Tani',
        'group_id' => 2,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok D-03',
        'pelatihan' => 'Pasca Panen'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0005',
        'name' => 'Petani 5',
        'nik' => '1408062209910001',
        'npwp' => '05.678.901.2-345.678',
        'gender' => 'Female',
        'tempat_lahir' => 'Indramayu',
        'tgl_lahir' => '22/09/1991',
        'alamat' => 'Alamat',
        'village_id' => 2,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 2,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 2,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '20/02/2024',
        'status' => 'Active',
        'ics_id' => 1,
        'ics_name' => 'ICS Tani',
        'group_id' => 1,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok E-07',
        'pelatihan' => 'Pengolahan Tanah Organik'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0006',
        'name' => 'Petani 6',
        'nik' => '1408061804820001',
        'npwp' => '06.789.012.3-456.789',
        'gender' => 'Male',
        'tempat_lahir' => 'Dayun',
        'tgl_lahir' => '18/04/1982',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '05/03/2024',
        'status' => 'Active',
        'ics_id' => 2,
        'ics_name' => 'ICS Tani',
        'group_id' => 2,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok F-09',
        'pelatihan' => 'Pemupukan Berimbang'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0007',
        'name' => 'Petani 7',
        'nik' => '1408063006750001',
        'npwp' => '07.890.123.4-567.890',
        'gender' => 'Male',
        'tempat_lahir' => 'Berumbung Baru',
        'tgl_lahir' => '30/06/1975',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '10/01/2024',
        'status' => 'Inactive',
        'ics_id' => 1,
        'ics_name' => 'ICS Tani',
        'group_id' => 1,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok G-11',
        'pelatihan' => 'Pengendalian Hama'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0008',
        'name' => 'Petani 8',
        'nik' => '1408061109930001',
        'npwp' => '08.901.234.5-678.901',
        'gender' => 'Female',
        'tempat_lahir' => 'Indramayu',
        'tgl_lahir' => '11/09/1993',
        'alamat' => 'Alamat',
        'village_id' => 2,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 2,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 2,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '15/02/2024',
        'status' => 'Active',
        'ics_id' => 2,
        'ics_name' => 'ICS Tani',
        'group_id' => 2,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok H-04',
        'pelatihan' => 'Pasca Panen'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0009',
        'name' => 'Petani 9',
        'nik' => '1408060508870001',
        'npwp' => '09.012.345.6-789.012',
        'gender' => 'Male',
        'tempat_lahir' => 'Dayun',
        'tgl_lahir' => '05/08/1987',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '20/03/2024',
        'status' => 'Active',
        'ics_id' => 1,
        'ics_name' => 'ICS Tani',
        'group_id' => 1,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok I-08',
        'pelatihan' => 'Pengolahan Tanah Organik'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0010',
        'name' => 'Petani 10',
        'nik' => '1408062504950001',
        'npwp' => '10.123.456.7-890.123',
        'gender' => 'Female',
        'tempat_lahir' => 'Berumbung Baru',
        'tgl_lahir' => '25/04/1995',
        'alamat' => 'Alamat',
        'village_id' => 1,
        'village_name' => 'Berumbung Baru',
        'kecamatan_id' => 1,
        'kecamatan_name' => 'Dayun',
        'kabupaten_id' => 1,
        'kabupaten_name' => 'Siak',
        'kode_wilayah' => '1408062006',
        'tgl_masuk_gr' => '05/04/2024',
        'status' => 'Active',
        'ics_id' => 2,
        'ics_name' => 'ICS Tani',
        'group_id' => 2,
        'group_name' => 'Kelompok Tani',
        'foto' => 'assets/default-avatar.jpg',
        'plot_kebun' => 'Blok J-12',
        'pelatihan' => 'Pemupukan Berimbang'
    ]
];

// Data dummy untuk dropdown
$dummyPlots = ['Blok A-12', 'Blok B-05', 'Blok C-08', 'Blok D-03', 'Blok E-07', 'Blok F-09', 'Blok G-11', 'Blok H-04', 'Blok I-08', 'Blok J-12'];
$dummyTrainings = ['Pengolahan Tanah Organik', 'Pemupukan Berimbang', 'Pengendalian Hama', 'Pasca Panen'];
$dummyIcsList = [
    ['ics_id' => 1, 'name' => 'ICS Tani'],
    ['ics_id' => 2, 'name' => 'ICS Maju']
];
$dummyGroups = [
    ['farmer_gr_id' => 1, 'name' => 'Kelompok Tani'],
    ['farmer_gr_id' => 2, 'name' => 'Kelompok Maju']
];

// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$farmer_id = isset($_GET['id']) ? $_GET['id'] : '';

// Simulasi data farmer yang dipilih
$farmer = null;
if ($farmer_id) {
    foreach ($dummyFarmers as $f) {
        if ($f['farmer_id'] == $farmer_id) {
            $farmer = $f;
            break;
        }
    }
}

// Fungsi untuk generate ID petani baru (simulasi)
function generateNewFarmerId() {
    return 'KMJ.' . date('d.m.Y') . '.' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
}

// Pagination configuration
$perPage = 5; // Number of items per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage); // Ensure page is at least 1
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
  <header class="h-20   shadow-sm flex items-center justify-between px-8">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-gray-800">
        <?php 
        if ($action == 'add') echo "Tambah Petani Baru";
        elseif ($action == 'view') echo "Profil Petani: " . ($farmer ? htmlspecialchars($farmer['name']) : '');
        elseif ($action == 'edit') echo "Edit Petani: " . ($farmer ? htmlspecialchars($farmer['name']) : '');
        else echo "Manajemen Data Petani";
        ?>
      </h1>
    </div>
    <div class="flex items-center space-x-6">
      <?php if ($action == 'list'): ?>
        <a href="petani.php?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Petani
        </a>
      <?php elseif ($action == 'view'): ?>
        <a href="petani.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="petani.php?action=edit&id=<?= $farmer_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit
        </a>
        <button onclick="confirmDelete('<?= $farmer_id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-trash-alt mr-2"></i> Hapus
        </button>
      <?php elseif ($action == 'edit'): ?>
        <a href="petani.php?action=view&id=<?= $farmer_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
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
        <div class="p-4 bg-gray-50 border-b">
          <form method="get" class="flex flex-col gap-4">
            <input type="hidden" name="action" value="list">
            
            <!-- Pencarian dipindah ke atas -->
            <div class="flex-1">
              <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama petani..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
              <div>
                <select name="ics_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua ICS</option>
                  <?php foreach ($dummyIcsList as $ics): ?>
                    <option value="<?= $ics['ics_id'] ?>" <?= isset($_GET['ics_filter']) && $_GET['ics_filter'] == $ics['ics_id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($ics['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <select name="group_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Kelompok Tani</option>
                  <?php foreach ($dummyGroups as $g): ?>
                    <option value="<?= $g['farmer_gr_id'] ?>" <?= isset($_GET['group_filter']) && $_GET['group_filter'] == $g['farmer_gr_id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($g['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <select name="status_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Status</option>
                  <option value="Active" <?= isset($_GET['status_filter']) && $_GET['status_filter'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                  <option value="Inactive" <?= isset($_GET['status_filter']) && $_GET['status_filter'] == 'Inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
              </div>
              <div>
                <select name="gender_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Jenis Kelamin</option>
                  <option value="Male" <?= isset($_GET['gender_filter']) && $_GET['gender_filter'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                  <option value="Female" <?= isset($_GET['gender_filter']) && $_GET['gender_filter'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Petani</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petani</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plot Kebun</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php 
              // Filter data berdasarkan dropdown
              $filteredFarmers = $dummyFarmers;
              if (isset($_GET['ics_filter']) && $_GET['ics_filter'] != '') {
                  $filteredFarmers = array_filter($filteredFarmers, function($f) {
                      return $f['ics_id'] == $_GET['ics_filter'];
                  });
              }
              if (isset($_GET['group_filter']) && $_GET['group_filter'] != '') {
                  $filteredFarmers = array_filter($filteredFarmers, function($f) {
                      return $f['group_id'] == $_GET['group_filter'];
                  });
              }
              if (isset($_GET['status_filter']) && $_GET['status_filter'] != '') {
                  $filteredFarmers = array_filter($filteredFarmers, function($f) {
                      return $f['status'] == $_GET['status_filter'];
                  });
              }
              if (isset($_GET['gender_filter']) && $_GET['gender_filter'] != '') {
                  $filteredFarmers = array_filter($filteredFarmers, function($f) {
                      return $f['gender'] == $_GET['gender_filter'];
                  });
              }
              if (isset($_GET['search']) && $_GET['search'] != '') {
                  $search = strtolower($_GET['search']);
                  $filteredFarmers = array_filter($filteredFarmers, function($f) use ($search) {
                      return strpos(strtolower($f['name']), $search) !== false;
                  });
              }
              
              // Pagination logic
              $totalFarmers = count($filteredFarmers);
              $totalPages = ceil($totalFarmers / $perPage);
              $currentPage = min($currentPage, $totalPages); // Ensure we don't go past the last page
              
              // Get current page's farmers
              $offset = ($currentPage - 1) * $perPage;
              $currentPageFarmers = array_slice($filteredFarmers, $offset, $perPage);
              ?>
              <?php if (empty($currentPageFarmers)): ?>
                <tr>
                  <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data petani</td>
                </tr>
              <?php else: ?>
                <?php foreach ($currentPageFarmers as $index => $f): ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $index + 1 + $offset ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['farmer_id']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['plot_kebun']) ?></td>
                    
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $f['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                        <?= $f['status'] ?>
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <a href="petani.php?action=view&id=<?= $f['farmer_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Profil">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="petani.php?action=edit&id=<?= $f['farmer_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" onclick="confirmDelete('<?= $f['farmer_id'] ?>')" class="text-red-600 hover:text-red-900" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
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
            <a href="petani.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
              Sebelumnya
            </a>
            <a href="petani.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
              Selanjutnya
            </a>
          </div>
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Menampilkan <span class="font-medium"><?= $offset + 1 ?></span> sampai <span class="font-medium"><?= min($offset + $perPage, $totalFarmers) ?></span> dari <span class="font-medium"><?= $totalFarmers ?></span> petani
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="petani.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                  <span class="sr-only">Sebelumnya</span>
                  <i class="fas fa-chevron-left"></i>
                </a>
                
                <?php 
                // Show page numbers
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);
                
                if ($startPage > 1) {
                    echo '<a href="petani.php?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                    if ($startPage > 2) {
                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                    }
                }
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                    echo '<a href="petani.php?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                }
                
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) {
                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                    }
                    echo '<a href="petani.php?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                }
                ?>
                
                <a href="petani.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
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
          <form method="post" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="<?= $action == 'add' ? 'add_farmer' : 'update_farmer' ?>" value="1">
            <?php if ($action == 'edit'): ?>
              <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
            <?php endif; ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Kolom Kiri -->
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700">ID Petani</label>
                  <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100" 
                         value="<?= $action == 'edit' ? htmlspecialchars($farmer['farmer_id']) : generateNewFarmerId() ?>" readonly>
                </div>
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                  <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                         value="<?= $action == 'edit' ? htmlspecialchars($farmer['name']) : '' ?>">
                </div>
                <div>
                  <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                  <input type="text" id="nik" name="nik" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                         value="<?= $action == 'edit' ? htmlspecialchars($farmer['nik']) : '' ?>">
                </div>
                <div>
                  <label for="plot_kebun" class="block text-sm font-medium text-gray-700">Plot Kebun</label>
                  <select id="plot_kebun" name="plot_kebun" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Plot Kebun</option>
                    <?php foreach ($dummyPlots as $plot): ?>
                      <option value="<?= htmlspecialchars($plot) ?>" <?= $action == 'edit' && $farmer['plot_kebun'] == $plot ? 'selected' : '' ?>>
                        <?= htmlspecialchars($plot) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div>
                  <label for="pelatihan" class="block text-sm font-medium text-gray-700">Pelatihan yang Diikuti</label>
                  <select id="pelatihan" name="pelatihan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Pelatihan</option>
                    <?php foreach ($dummyTrainings as $training): ?>
                      <option value="<?= htmlspecialchars($training) ?>" <?= $action == 'edit' && $farmer['pelatihan'] == $training ? 'selected' : '' ?>>
                        <?= htmlspecialchars($training) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              
              <!-- Kolom Kanan -->
              <div class="space-y-4">
                <div>
                  <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                  <select id="gender" name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Male" <?= $action == 'edit' && $farmer['gender'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Female" <?= $action == 'edit' && $farmer['gender'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
                  </select>
                </div>
                <div>
                  <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                  <input type="text" id="tempat_lahir" name="tempat_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                         value="<?= $action == 'edit' ? htmlspecialchars($farmer['tempat_lahir']) : '' ?>">
                </div>
                <div>
                  <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                  <input type="date" id="tgl_lahir" name="tgl_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                         value="<?= $action == 'edit' ? htmlspecialchars($farmer['tgl_lahir']) : '' ?>">
                </div>
                <div>
                  <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                  <textarea id="alamat" name="alamat" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $action == 'edit' ? htmlspecialchars($farmer['alamat']) : '' ?></textarea>
                </div>
                <div>
                  <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                  <input type="file" id="foto" name="foto" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                  <?php if ($action == 'edit' && !empty($farmer['foto'])): ?>
                    <div class="mt-2 flex items-center">
                      <img src="<?= htmlspecialchars($farmer['foto']) ?>" alt="Foto Petani" class="h-16 w-16 rounded-full object-cover">
                      <span class="ml-2 text-sm text-gray-500">Foto saat ini</span>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            
            <div class="flex justify-end space-x-3">
              <a href="<?= $action == 'add' ? 'petani.php' : 'petani.php?action=view&id='.$farmer_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
      
    <?php elseif ($action == 'view' && $farmer): ?>
      <!-- Tampilan Profil Petani -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri - Profil -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 bg-gray-50 border-b">
              <h3 class="text-lg font-medium text-gray-900">Profil Petani</h3>
            </div>
            <div class="p-6 text-center">
              <?php if (!empty($farmer['foto'])): ?>
                <img src="<?= htmlspecialchars($farmer['foto']) ?>" alt="Foto Petani" class="mx-auto h-32 w-32 rounded-full object-cover mb-4">
              <?php else: ?>
                <div class="mx-auto h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mb-4">
                  <i class="fas fa-user text-4xl text-gray-400"></i>
                </div>
              <?php endif; ?>
              <h3 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($farmer['name']) ?></h3>
              <p class="text-sm text-gray-500">ID: <?= htmlspecialchars($farmer['farmer_id']) ?></p>
              
              <div class="mt-6 space-y-4 text-left">
                <div>
                  <p class="text-sm text-gray-500">Plot Kebun</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['plot_kebun']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Pelatihan</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['pelatihan']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">NIK</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['nik']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Jenis Kelamin</p>
                  <p class="text-sm font-medium">
                    <?= $farmer['gender'] == 'Male' ? 'Laki-laki' : 'Perempuan' ?>
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Tempat/Tgl Lahir</p>
                  <p class="text-sm font-medium">
                    <?= htmlspecialchars($farmer['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($farmer['tgl_lahir'])) ?>
                  </p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Alamat</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['alamat']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Status</p>
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $farmer['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <?= $farmer['status'] ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Kolom Kanan - Informasi Tambahan -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="border-b border-gray-200">
              <nav class="flex -mb-px">
                <a href="#kebun" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-[#f0ab00] text-[#f0ab00]">
                  Info Kebun
                </a>
                <a href="#pelatihan" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                  Riwayat Pelatihan
                </a>
                <a href="#riwayat" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                  Riwayat Aktivitas
                </a>
              </nav>
            </div>
            <div class="p-6">
              <!-- Tab Info Kebun -->
              <div id="kebun-content" class="tab-content active">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="space-y-4">
                    <div>
                      <p class="text-sm text-gray-500">Luas Lahan</p>
                      <p class="text-sm font-medium">2.5 Ha</p>
                    </div>
                    <div>
                      <p class="text-sm text-gray-500">Jenis Tanaman</p>
                      <p class="text-sm font-medium">Kelapa Sawit</p>
                    </div>
                  </div>
                  <div class="space-y-4">
                    <div>
                      <p class="text-sm text-gray-500">Tanggal Tanam</p>
                      <p class="text-sm font-medium">15/03/2020</p>
                    </div>
                    <div>
                      <p class="text-sm text-gray-500">Produktivitas</p>
                      <p class="text-sm font-medium">22 Ton/Ha/Tahun</p>
                    </div>
                  </div>
                </div>
                <div class="mt-6">
                  <p class="text-sm text-gray-500">Catatan Kebun</p>
                  <p class="text-sm font-medium">Tanaman dalam kondisi baik, pemupukan teratur dilakukan setiap 6 bulan sekali.</p>
                </div>
              </div>
              
              <!-- Tab Riwayat Pelatihan -->
              <div id="pelatihan-content" class="tab-content hidden">
                <div class="space-y-4">
                  <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between items-start">
                      <div>
                        <h4 class="text-md font-medium text-gray-900"><?= htmlspecialchars($farmer['pelatihan']) ?></h4>
                        <p class="text-sm text-gray-600 mt-1">Pelatihan tentang teknik terkait <?= htmlspecialchars($farmer['pelatihan']) ?> untuk meningkatkan produktivitas.</p>
                        <p class="text-xs text-gray-500 mt-2">
                          <i class="far fa-calendar-alt mr-1"></i> 15/03/2023
                        </p>
                      </div>
                      <div class="text-right">
                        <p class="text-xs text-gray-500">
                          Lokasi: Balai Desa <?= htmlspecialchars($farmer['village_name']) ?><br>
                          Instruktur: Dr. Agus Setiawan
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Tab Riwayat Aktivitas -->
              <div id="riwayat-content" class="tab-content hidden">
                <div class="space-y-4">
                  <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between items-start">
                      <div>
                        <h4 class="text-md font-medium text-gray-900">Pemupukan Rutin</h4>
                        <p class="text-sm text-gray-600 mt-1">Pemupukan dilakukan di plot <?= htmlspecialchars($farmer['plot_kebun']) ?> dengan pupuk NPK 15-15-15.</p>
                        <p class="text-xs text-gray-500 mt-2">
                          <i class="far fa-calendar-alt mr-1"></i> 10/06/2023
                        </p>
                      </div>
                      <div class="text-right">
                        <p class="text-xs text-gray-500">
                          Petugas: Budi Santoso<br>
                          Status: Selesai
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between items-start">
                      <div>
                        <h4 class="text-md font-medium text-gray-900">Panen</h4>
                        <p class="text-sm text-gray-600 mt-1">Panen dilakukan dengan hasil 5.2 ton dari plot <?= htmlspecialchars($farmer['plot_kebun']) ?>.</p>
                        <p class="text-xs text-gray-500 mt-2">
                          <i class="far fa-calendar-alt mr-1"></i> 25/05/2023
                        </p>
                      </div>
                      <div class="text-right">
                        <p class="text-xs text-gray-500">
                          Petugas: Ahmad Fauzi<br>
                          Status: Selesai
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Keanggotaan -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="p-6 bg-gray-50 border-b">
              <h3 class="text-lg font-medium text-gray-900">Keanggotaan</h3>
            </div>
            <div class="p-6 space-y-4">
              <div>
                <p class="text-sm text-gray-500">ICS</p>
                <p class="text-sm font-medium"><?= htmlspecialchars($farmer['ics_name']) ?></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Kelompok Tani</p>
                <p class="text-sm font-medium"><?= htmlspecialchars($farmer['group_name']) ?></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Tanggal Masuk</p>
                <p class="text-sm font-medium"><?= htmlspecialchars($farmer['tgl_masuk_gr']) ?></p>
              </div>
            </div>
          </div>
          
          <!-- Dokumen -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="p-6 bg-gray-50 border-b">
              <h3 class="text-lg font-medium text-gray-900">Dokumen</h3>
            </div>
            <div class="p-6 space-y-4">
              <div>
                <p class="text-sm text-gray-500">NPWP</p>
                <p class="text-sm font-medium"><?= htmlspecialchars($farmer['npwp']) ?></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Dokumen Lainnya</p>
                <div class="mt-2 space-y-2">
                  <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <span class="text-sm font-medium">KTP.pdf</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                      <i class="fas fa-download"></i>
                    </a>
                  </div>
                  <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                    <span class="text-sm font-medium">Sertifikat_Tanah.pdf</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800">
                      <i class="fas fa-download"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
</main>

<script>
  // Fungsi untuk tab
  document.querySelectorAll('.tab-link').forEach(link => {
    link.addEventListener('click', function(e) {
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

  // Fungsi untuk konfirmasi hapus
  function confirmDelete(farmerId) {
    if (confirm('Apakah Anda yakin ingin menghapus petani ini?')) {
      // Redirect ke action delete dengan parameter id
      window.location.href = 'petani.php?action=delete&id=' + farmerId;
    }
  }
</script>

<?php include 'footer.php'; ?>