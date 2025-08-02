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
    'tgl_lahir' => '1945-01-03',
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
    'tgl_lahir' => '1989-06-20',
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
function generateNewFarmerId()
{
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
        <a href="petani?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Petani
        </a>
      <?php elseif ($action == 'view'): ?>
        <div class="flex gap-3 flex-wrap mb-4">
          <!-- Tombol Kembali -->
          <a href="petani" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
          </a>

          <!-- Tombol Edit -->
          <a href="petani?action=edit&id=<?= $farmer_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-edit mr-2"></i> Edit
          </a>

          <!-- Tombol Hapus -->
          <button onclick="openDeletelModal('<?= $farmer_id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-trash-alt mr-2"></i> Hapus
          </button>

          <!-- Tombol Print PDF -->
          <a href="petani_pdf?action=print&id=<?= $farmer_id ?>" target="_blank"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-file-pdf mr-2"></i> Cetak PDF
          </a>
        </div>
      <?php elseif ($action == 'edit'): ?>
        <a href="petani?action=view&id=<?= $farmer_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
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
                $filteredFarmers = array_filter($filteredFarmers, function ($f) {
                  return $f['ics_id'] == $_GET['ics_filter'];
                });
              }
              if (isset($_GET['group_filter']) && $_GET['group_filter'] != '') {
                $filteredFarmers = array_filter($filteredFarmers, function ($f) {
                  return $f['group_id'] == $_GET['group_filter'];
                });
              }
              if (isset($_GET['status_filter']) && $_GET['status_filter'] != '') {
                $filteredFarmers = array_filter($filteredFarmers, function ($f) {
                  return $f['status'] == $_GET['status_filter'];
                });
              }
              if (isset($_GET['gender_filter']) && $_GET['gender_filter'] != '') {
                $filteredFarmers = array_filter($filteredFarmers, function ($f) {
                  return $f['gender'] == $_GET['gender_filter'];
                });
              }
              if (isset($_GET['search']) && $_GET['search'] != '') {
                $search = strtolower($_GET['search']);
                $filteredFarmers = array_filter($filteredFarmers, function ($f) use ($search) {
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
                      <a href="petani?action=view&id=<?= $f['farmer_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Profil">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="petani?action=edit&id=<?= $f['farmer_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit" hidden>
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" onclick="openDeletelModal('<?= $f['farmer_id'] ?>')" class="text-red-600 hover:text-red-900 mr-3" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                      <a href="petani_pdf?action=print&id=<?= $farmer_id ?>" target="_blank" class="text-black-600 hover:text-black-900">
                        <i class="fas fa-file-pdf mr-2"></i>
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
            <a href="petani?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
              Sebelumnya
            </a>
            <a href="petani?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
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
                <a href="petani?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                  <span class="sr-only">Sebelumnya</span>
                  <i class="fas fa-chevron-left"></i>
                </a>

                <?php
                // Show page numbers
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);

                if ($startPage > 1) {
                  echo '<a href="petani?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                  if ($startPage > 2) {
                    echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                  }
                }

                for ($i = $startPage; $i <= $endPage; $i++) {
                  $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                  echo '<a href="petani?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                }

                if ($endPage < $totalPages) {
                  if ($endPage < $totalPages - 1) {
                    echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                  }
                  echo '<a href="petani?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                }
                ?>

                <a href="petani?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                  <span class="sr-only">Selanjutnya</span>
                  <i class="fas fa-chevron-right"></i>
                </a>
              </nav>
            </div>
          </div>
        </div>
      </div>

    <?php elseif ($action == 'add' || $action == 'edit'): ?>

      <!-- HTML Section for NIK Input -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <div class="flex items-center space-x-2">
            <div class="flex-1">
              <label for="nik" class="block text-sm font-medium text-gray-700">NIK <span class="text-red-500">*</span></label>
              <div class="flex items-center">
                <input type="text" id="nik" name="nik" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" oninput="onlyNumber(this)" />
                <button type="button" id="cariNIKBtn" onclick="searchNIK()" class="ml-2 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-yellow-400 h-full">
                  <span id="btnNIKText">Cari</span> <!-- Teks tombol -->
                  <svg id="loadingNIKSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white bg-yellow-500 hover:bg-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <br>
      <!-- Form Tambah/Edit Petani -->
      <div id="farmer-info" style="display: none;" class="bg-white rounded-xl shadow-md overflow-hidden">
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
                  <label class="block text-sm font-medium text-gray-700">ID Petani <span class="text-red-500">*</span></label>
                  <input type="text" id="farmer_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100"
                    value="<?= $action == 'edit' ? htmlspecialchars($farmer['farmer_id']) : generateNewFarmerId() ?>" readonly>
                </div>
                <div>
                  <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP <span class="text-red-500">*</span></label>
                  <input type="text" id="npwp" name="npwp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" oninput="onlyNumber(this)"
                    value="<?= $action == 'edit' ? htmlspecialchars($farmer['npwp']) : '' ?>">
                </div>
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                  <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="<?= $action == 'edit' ? htmlspecialchars($farmer['name']) : '' ?>">
                </div>
                <div>
                  <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                  <select id="gender" name="gender" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Male" <?= $action == 'edit' && $farmer['gender'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Female" <?= $action == 'edit' && $farmer['gender'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
                  </select>
                </div>
                <div>
                  <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir <span class="text-red-500">*</span></label>
                  <input type="text" id="tempat_lahir" name="tempat_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="<?= $action == 'edit' ? htmlspecialchars($farmer['tempat_lahir']) : '' ?>">
                </div>
                <div hidden>
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
                  <label for="ics" class="block text-sm font-medium text-gray-700">ICS</label>
                  <select id="ics" name="ics" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih ICS</option>
                    <option value="A">ICS A</option>
                    <option value="B">ICS B</option>
                    <option value="C">ICS C</option>
                  </select>
                </div>

                <div>
                  <label for="kelompokTani" class="block text-sm font-medium text-gray-700">Kelompok Tani <span class="text-red-500">*</span></label>
                  <select id="kelompokTani" name="kelompokTani" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Kelompok Tani</option>
                  </select>
                </div>
                <div>
                  <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap <span class="text-red-500">*</span></label>
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
                <div>
                  <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                  <input type="date" id="tgl_lahir" name="tgl_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="<?= $action == 'edit' ? htmlspecialchars($farmer['tgl_lahir']) : '' ?>">
                </div>
              </div>
            </div>

            <div class="flex justify-end space-x-3">
              <a href="<?= $action == 'add' ? 'petani' : 'petani?action=view&id=' . $farmer_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Batal</a>
              <button type="button" id="savePetaniBtn" onclick="savePetaniData()" class="ml-2 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-yellow-400 h-full">
                <span id="btnPetaniText">Simpan</span> <!-- Teks tombol -->
                <svg id="loadingPetaniSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white bg-yellow-500 hover:bg-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                </svg>
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

<!-- Modal Hapus Data -->
<div id="deleteModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-600 sm:mx-0 sm:h-10 sm:w-10">
            <i class="fas fa-trash-alt text-white"></i>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h3 id="deleteModalTitle" class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Hapus Data</h3>
            <div class="mt-2">
              <p id="deleteModalContent" class="text-sm text-gray-500">
                Apakah Anda yakin ingin menghapus data ini? Setelah Anda menekan "Hapus", data tidak akan muncul di dalam table.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="deleteDataBtn" class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm" onclick="deleteData()">
          <span id="btnText">Hapus</span> <!-- Teks tombol -->
          <svg id="loadingSpinner" class="hidden w-5 h-5 animate-spin mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
          </svg>
        </button>

        <button type="button" onclick="closeDeleteParcelModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>


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

  // Function to populate the Kelompok Tani dropdown based on the ICS
  function populateKelompokTani() {
    const ics = document.getElementById('ics').value;
    const kelompokTaniSelect = document.getElementById('kelompokTani');

    // Clear the current options
    kelompokTaniSelect.innerHTML = '<option value="">Pilih Kelompok Tani</option>';

    if (ics) {
      // Get Kelompok Tani data based on ICS
      const kelompokTaniOptions = kelompokTaniData[ics];

      // Populate the options dynamically
      kelompokTaniOptions.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option.value;
        optionElement.textContent = option.name;
        kelompokTaniSelect.appendChild(optionElement);
      });
    }
  }

  // Dummy data (converted from PHP to JavaScript)
  const farmersData = <?php echo json_encode($dummyFarmers); ?>;

  // Function to search for NIK and show data
  function searchNIK() {
    const nik = document.getElementById('nik').value;
    const farmerInfoDiv = document.getElementById('farmer-info');

    // Menampilkan loading spinner dan menonaktifkan tombol
    const saveBtn = document.getElementById("cariNIKBtn");
    const loadingSpinner = document.getElementById("loadingNIKSpinner");
    const btnText = document.getElementById("btnNIKText");

    if (!nik) {
      showSweetAlert('error', 'Pencarian Gagal', 'NIK tidak boleh kosong. Mohon untuk mengisi NIK terlebih dahulu.', false, '');
      return;
    }

    if (nik.length !== 16) {
      showSweetAlert('error', 'Pencarian Gagal', 'NIK harus terdiri dari 16 digit. Pastikan NIK yang dimasukkan sudah benar.', false, '');
      return;
    }

    // Find farmer data by NIK
    const farmer = farmersData.find(f => f.nik === nik);

    // Menonaktifkan tombol dan menampilkan spinner saat proses upload
    saveBtn.disabled = true;
    btnText.style.display = 'none'; // Menyembunyikan teks tombol
    loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner

    // Simulasi upload data (misalnya dengan setTimeout)
    setTimeout(() => {

      // Menyembunyikan spinner dan mengaktifkan kembali tombol
      loadingSpinner.style.display = 'none';
      btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
      saveBtn.disabled = false; // Mengaktifkan tombol kembali

      if (farmer) {
        // Data found successfully
        showSweetAlert('success', 'Data Ditemukan', 'Data petani berhasil ditemukan dan bisa dilakukan edit data.', true, '');

        // Show the farmer data and fill the form with the farmer details
        document.getElementById('farmer_id').value = farmer.farmer_id;
        document.getElementById('npwp').value = farmer.npwp;
        document.getElementById('name').value = farmer.name;
        document.getElementById('gender').value = farmer.gender;
        document.getElementById('tempat_lahir').value = farmer.tempat_lahir;
        document.getElementById('tgl_lahir').value = farmer.tgl_lahir;
        document.getElementById('alamat').value = farmer.alamat;

        // Set the ICS and Kelompok Tani
        const icsValue = farmer.ics_id === 1 ? 'A' : farmer.ics_id === 2 ? 'B' : 'C';
        document.getElementById('ics').value = icsValue;
        populateKelompokTani(); // Populate Kelompok Tani options based on ICS

        // Set the Kelompok Tani based on the farmer's group
        const kelompokTaniValue = farmer.group_id === 1 ? 'A1' : farmer.group_id === 2 ? 'B1' : 'C1';
        document.getElementById('kelompokTani').value = kelompokTaniValue;

        farmerInfoDiv.style.display = 'block'; // Show the form with the farmer data
      } else {
        // Data not found, prompt user to add new data
        showSweetAlert('warning', 'Data Tidak Ditemukan', 'Data petani tidak ditemukan. Silakan tambahkan data petani baru.', true, '');

        // Extract the first 6 digits (140806)
        const extractedData = nik.substring(0, 6);

        // Add a dot every two digits (e.g., 140806 -> 14.08.06)
        const formattedData = extractedData.replace(/(\d{2})(?=\d)/g, '$1.');

        // If no matching data is found, clear the form and display it
        document.getElementById('farmer_id').value = formattedData + '.1001.0001';
        document.getElementById('npwp').value = '';
        document.getElementById('name').value = '';
        document.getElementById('gender').value = '';
        document.getElementById('tempat_lahir').value = '';
        document.getElementById('tgl_lahir').value = '';
        document.getElementById('alamat').value = '';
        document.getElementById('ics').value = '';
        document.getElementById('kelompokTani').value = '';

        farmerInfoDiv.style.display = 'block'; // Just show the form
      }

    }, 3000); // Waktu simulasi upload (3 detik)
  }

  // Fungsi untuk konfirmasi hapus
  // function confirmDelete(farmerId) {
  //   if (confirm('Apakah Anda yakin ingin menghapus petani ini?')) {
  //     // Redirect ke action delete dengan parameter id
  //     window.location.href = 'petani?action=delete&id=' + farmerId;
  //   }
  // }

  // Data Dummy Kelompok Tani berdasarkan ICS
  const kelompokTaniData = {
    "A": [{
        value: "A1",
        name: "Kelompok Tani A1"
      },
      {
        value: "A2",
        name: "Kelompok Tani A2"
      }
    ],
    "B": [{
        value: "B1",
        name: "Kelompok Tani B1"
      },
      {
        value: "B2",
        name: "Kelompok Tani B2"
      }
    ],
    "C": [{
        value: "C1",
        name: "Kelompok Tani C1"
      },
      {
        value: "C2",
        name: "Kelompok Tani C2"
      }
    ]
  };

  // Kelompok Tani yang tidak terkait dengan ICS (misalnya Kelompok Tani Umum)
  const kelompokTaniUmum = [{
      value: "U1",
      name: "Kelompok Tani Umum 1"
    },
    {
      value: "U2",
      name: "Kelompok Tani Umum 2"
    }
  ];

  // Mengambil elemen ICS dan Kelompok Tani
  const icsSelect = document.getElementById('ics');
  const kelompokTaniSelect = document.getElementById('kelompokTani');

  // Fungsi untuk mengupdate pilihan Kelompok Tani berdasarkan ICS
  function updateKelompokTaniOptions() {
    const selectedICS = icsSelect.value;
    const farmer_id = document.getElementById('farmer_id').value;

    // Split farmer_id to get the first part (ICS part)
    const farmerParts = farmer_id.split('.'); // This will give us an array of parts
    const firstPart = farmerParts[0]; // This is either the ICS or a number

    // Kosongkan pilihan Kelompok Tani
    kelompokTaniSelect.innerHTML = '<option value="">Pilih Kelompok Tani</option>';

    // Check if the first part is a letter
    if (/[A-Za-z]/.test(firstPart)) {
      // If the first part is a letter (ICS), replace it with the selected ICS
      if (selectedICS) {
        document.getElementById('farmer_id').value = selectedICS + '.' + farmerParts.slice(1).join('.');
      } else {
        // If no ICS is selected, remove the first part (the letter)
        document.getElementById('farmer_id').value = farmerParts.slice(1).join('.');
      }
    } else {
      // If ICS is selected, replace the first part with the selected ICS
      document.getElementById('farmer_id').value = selectedICS + '.' + farmer_id;
    }

    if (selectedICS) {
      // Jika ICS dipilih, tampilkan Kelompok Tani yang sesuai dengan ICS
      const kelompokTaniList = kelompokTaniData[selectedICS] || [];
      kelompokTaniList.forEach(kelompok => {
        const option = document.createElement('option');
        option.value = kelompok.value;
        option.textContent = kelompok.name;
        kelompokTaniSelect.appendChild(option);
      });
    } else {
      // Jika ICS tidak dipilih, tampilkan Kelompok Tani yang tidak terkait dengan ICS
      kelompokTaniUmum.forEach(kelompok => {
        const option = document.createElement('option');
        option.value = kelompok.value;
        option.textContent = kelompok.name;
        kelompokTaniSelect.appendChild(option);
      });
    }
  }

  // Menambahkan event listener pada dropdown ICS
  icsSelect.addEventListener('change', updateKelompokTaniOptions);

  // Panggil fungsi untuk mengupdate pilihan Kelompok Tani pada awalnya
  updateKelompokTaniOptions();

  function savePetaniData() {
    const farmer_id = document.getElementById("farmer_id");
    const npwp = document.getElementById("npwp");
    const name = document.getElementById("name");
    const gender = document.getElementById("gender");
    const tempat_lahir = document.getElementById("tempat_lahir");
    const tgl_lahir = document.getElementById("tgl_lahir");
    const alamat = document.getElementById("alamat");
    const kelompokTani = document.getElementById("kelompokTani");

    // Menampilkan loading spinner dan menonaktifkan tombol
    const saveBtn = document.getElementById("savePetaniBtn");
    const loadingSpinner = document.getElementById("loadingPetaniSpinner");
    const btnText = document.getElementById("btnPetaniText");

    // Validate required fields
    if (!farmer_id.value) {
      showSweetAlert('error', 'Form Gagal', 'ID Petani harus diisi.', false, '');
      return;
    }

    if (!npwp.value) {
      showSweetAlert('error', 'Form Gagal', 'NPWP harus diisi.', false, '');
      return;
    }
    if (npwp.value.length !== 16) {
      showSweetAlert('error', 'Form Gagal', 'NPWP harus terdiri dari 16 karakter.', false, '');
      return;
    }
    if (!/^\d{16}$/.test(npwp.value)) {
      showSweetAlert('error', 'Form Gagal', 'NPWP hanya boleh berisi angka.', false, '');
      return;
    }

    if (!name.value) {
      showSweetAlert('error', 'Form Gagal', 'Nama lengkap harus diisi.', false, '');
      return;
    }

    if (!gender.value) {
      showSweetAlert('error', 'Form Gagal', 'Jenis Kelamin harus diisi.', false, '');
      return;
    }

    if (!tempat_lahir.value) {
      showSweetAlert('error', 'Form Gagal', 'Tempat lahir harus diisi.', false, '');
      return;
    }

    if (!tgl_lahir.value) {
      showSweetAlert('error', 'Form Gagal', 'Tanggal lahir harus diisi.', false, '');
      return;
    }

    if (!alamat.value) {
      showSweetAlert('error', 'Form Gagal', 'Alamat harus diisi.', false, '');
      return;
    }

    if (!kelompokTani.value) {
      showSweetAlert('error', 'Form Gagal', 'Kelompok Tani harus dipilih.', false, '');
      return;
    }

    // Menonaktifkan tombol dan menampilkan spinner saat proses upload
    saveBtn.disabled = true;
    btnText.style.display = 'none'; // Menyembunyikan teks tombol
    loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner

    // Simulasi upload data (misalnya dengan setTimeout)
    setTimeout(() => {
      // Proses upload selesai
      showSweetAlert('success', 'Berhasil Disimpan', 'Data petani berhasil disimpan ke dalam database.', true, 'petani');

      // Menyembunyikan spinner dan mengaktifkan kembali tombol
      loadingSpinner.style.display = 'none';
      btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
      saveBtn.disabled = false; // Mengaktifkan tombol kembali

      // Pindah halaman setelah delay
      setTimeout(() => {
        // Ganti dengan URL halaman yang sesuai
        window.location.href = 'petani'; // Misalnya, ke halaman dashboard
      }, 2000); // Pindah halaman setelah 2 detik
    }, 3000); // Waktu simulasi upload (3 detik)
  }

  // Fungsi untuk menghapus data
  function deleteData() {
    const deleteBtn = document.getElementById("deleteDataBtn");
    const loadingSpinner = document.getElementById("loadingSpinner");
    const btnText = document.getElementById("btnText");

    // Menonaktifkan tombol dan menampilkan spinner
    deleteBtn.disabled = true; // Menonaktifkan tombol
    btnText.style.display = 'none'; // Menyembunyikan teks tombol
    loadingSpinner.style.display = 'inline-block'; // Menampilkan spinner loading

    // Proses penghapusan data
    setTimeout(() => {
      // Simulasi penghapusan data selesai
      showSweetAlert('success', 'Penghapusan Berhasil', 'Data telah berhasil dihapus.', true, '');
      closeDeletelModal()

      // Menyembunyikan spinner dan mengaktifkan kembali tombol
      loadingSpinner.style.display = 'none'; // Menyembunyikan spinner
      btnText.style.display = 'inline'; // Menampilkan kembali teks tombol
      deleteBtn.disabled = false; // Mengaktifkan kembali tombol
    }, 3000); // Waktu tunggu simulasi (3 detik)
  }

  function closeDeletelModal() {
    document.getElementById('deleteModal').classList.add('hidden');
  }

  function openDeletelModal(id = null) {
    document.getElementById('deleteModal').classList.remove('hidden');
  }
</script>

<?php include 'footer.php'; ?>