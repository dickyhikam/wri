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
        'foto' => 'assets/default-avatar.jpg'
    ],
    [
        'farmer_id' => 'KMJ.14.08.06.2006.0002',
        'name' => 'Petani 2',
        'nik' => '1408062006890001',
        'npwp' => '09.876.543.2-109.876',
        'gender' => 'Male',
        'tempat_lahir' => ' Indramayu',
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
        'foto' => 'assets/default-avatar.jpg'
    ]
];
$dummyProfile = [
    'farmer_id' => 1,
    'pendidikan_terakhir' => 'SMA',
    'pekerjaan_tambahan' => 'Pedagang',
    'jumlah_tanggungan' => 3,
    'luas_lahan_total' => 2.5,
    'pengalaman_bertahun' => 10,
    'keterampilan_khusus' => 'Pengolahan tanah, pembibitan',
    'catatan_kesehatan' => 'Tekanan darah normal'
];
$dummyGroups = [
    ['farmer_gr_id' => 1, 'name' => 'Kelompok Tani Makmur'],
    ['farmer_gr_id' => 2, 'name' => 'Kelompok Tani Sejahtera']
];
$dummyIcsList = [
    ['ics_id' => 1, 'name' => 'ICS Makmur'],
    ['ics_id' => 2, 'name' => 'ICS Sejahtera']
];
$dummyKabupaten = [
    ['kabupaten_id' => 1, 'name' => 'dummy 1'],
    ['kabupaten_id' => 2, 'name' => 'dummy 2']
];
$dummyKecamatan = [
    ['kecamatan_id' => 1, 'kabupaten_id' => 1, 'name' => 'dummy 1'],
    ['kecamatan_id' => 2, 'kabupaten_id' => 2, 'name' => 'dummy 2']
];
$dummyVillages = [
    ['village_id' => 1, 'kecamatan_id' => 1, 'name' => 'dummy 1'],
    ['village_id' => 2, 'kecamatan_id' => 2, 'name' => 'dummy 2']
];
// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
// $farmer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$farmer_id = isset($_GET['id']) ? $_GET['id'] : '';
// Simulasi data farmer yang dipilih
$farmer = null;
if ($farmer_id > 0) {
    foreach ($dummyFarmers as $f) {
        if ($f['farmer_id'] == $farmer_id) {
            $farmer = $f;
            break;
        }
    }
}
// Simulasi notifikasi
if (isset($_GET['notif'])) {
    if ($_GET['notif'] == 'success') {
        $_SESSION['success'] = "Operasi berhasil dilakukan!";
    } elseif ($_GET['notif'] == 'error') {
        $_SESSION['error'] = "Terjadi kesalahan dalam operasi!";
    }
}
?>
<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
  <header class="h-20 bg-white border-b shadow-sm flex items-center justify-between px-8">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-gray-800">
        <?php 
        if ($action == 'add') echo "Tambah Petani Baru";
        elseif ($action == 'view') echo "Profil Petani: " . ($farmer ? htmlspecialchars($farmer['name']) : '');
        elseif ($action == 'edit') echo "Edit Petani: " . ($farmer ? htmlspecialchars($farmer['name']) : '');
        else echo "Data Petani";
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
      <?php elseif ($action == 'edit'): ?>
        <a href="petani.php?action=view&id=<?= $farmer_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-times mr-2"></i> Batal
        </a>
      <?php endif; ?>
    </div>
  </header>
  <!-- Main Content -->
  <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <!-- Notifikasi -->
    <?php if (isset($_SESSION['success'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= $_SESSION['success'] ?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if ($action == 'list'): ?>
      <!-- Daftar Petani -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
          <form method="get" class="flex flex-wrap gap-4">
            <input type="hidden" name="action" value="list">
            <div class="flex-1">
              <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama petani...">
            </div>
            <div class="flex space-x-4">
              <select name="ics_filter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua ICS</option>
                <?php foreach ($dummyIcsList as $ics): ?>
                  <option value="<?= $ics['ics_id'] ?>" <?= isset($_GET['ics_filter']) && $_GET['ics_filter'] == $ics['ics_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ics['name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <select name="group_filter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kelompok Tani</option>
                <?php foreach ($dummyGroups as $g): ?>
                  <option value="<?= $g['farmer_gr_id'] ?>" <?= isset($_GET['group_filter']) && $_GET['group_filter'] == $g['farmer_gr_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($g['name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <select name="status_filter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="Active" <?= isset($_GET['status_filter']) && $_GET['status_filter'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                <option value="Inactive" <?= isset($_GET['status_filter']) && $_GET['status_filter'] == 'Inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
              </select>
              <select name="gender_filter" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Jenis Kelamin</option>
                <option value="Male" <?= isset($_GET['gender_filter']) && $_GET['gender_filter'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Female" <?= isset($_GET['gender_filter']) && $_GET['gender_filter'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
              </select>
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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ICS</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Petani</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Gabung</th>
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
              ?>
              <?php if (empty($filteredFarmers)): ?>
                <tr>
                  <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data petani</td>
                </tr>
              <?php else: ?>
                <?php foreach ($filteredFarmers as $index => $f): ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $index + 1 ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['farmer_id']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['ics_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['name']) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($f['alamat']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($f['kabupaten_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= date('d/m/Y', strtotime($f['tgl_masuk_gr'])) ?></td>
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
                      <form method="post" style="display:inline;">
                        <input type="hidden" name="farmer_id" value="<?= $f['farmer_id'] ?>">
                        <input type="hidden" name="delete_farmer" value="1">
                        <button type="submit" class="text-red-600 hover:text-red-900" title="Nonaktifkan" onclick="return confirm('Apakah Anda yakin ingin menonaktifkan petani ini?')">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
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
                  <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                  <input type="text" id="nik" name="nik" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['nik']) : '' ?>">
                </div>
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                  <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['name']) : '' ?>">
                </div>
                <div>
                  <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                  <input type="text" id="npwp" name="npwp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['npwp']) : '' ?>">
                </div>
                <div>
                  <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                  <select id="gender" name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Male" <?= $action == 'edit' && $farmer['gender'] == 'Male' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Female" <?= $action == 'edit' && $farmer['gender'] == 'Female' ? 'selected' : '' ?>>Perempuan</option>
                    <option value="Other" <?= $action == 'edit' && $farmer['gender'] == 'Other' ? 'selected' : '' ?>>Lainnya</option>
                  </select>
                </div>

                <!-- Informasi Tambahan Profil -->
                <h3 class="text-md font-medium text-gray-900 mt-6">Informasi Tambahan Profil</h3>
                <div>
                  <label for="pendidikan_terakhir" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                  <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Pendidikan</option>
                    <option value="Tidak Sekolah" <?= $dummyProfile && $dummyProfile['pendidikan_terakhir'] == 'Tidak Sekolah' ? 'selected' : '' ?>>Tidak Sekolah</option>
                    <option value="SD" <?= $dummyProfile && $dummyProfile['pendidikan_terakhir'] == 'SD' ? 'selected' : '' ?>>SD</option>
                    <option value="SMP" <?= $dummyProfile && $dummyProfile['pendidikan_terakhir'] == 'SMP' ? 'selected' : '' ?>>SMP</option>
                    <option value="SMA" <?= $dummyProfile && $dummyProfile['pendidikan_terakhir'] == 'SMA' ? 'selected' : '' ?>>SMA</option>
                    <option value="Diploma" <?= $dummyProfile && $dummyProfile['pendidikan_terakhir'] == 'Diploma' ? 'selected' : '' ?>>Diploma</option>
                    <option value="Sarjana" <?= $dummyProfile && $dummyProfile['pendidikan_terakhir'] == 'Sarjana' ? 'selected' : '' ?>>Sarjana</option>
                  </select>
                </div>
                <div>
                  <label for="pekerjaan_tambahan" class="block text-sm font-medium text-gray-700">Pekerjaan Tambahan</label>
                  <input type="text" id="pekerjaan_tambahan" name="pekerjaan_tambahan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $dummyProfile ? htmlspecialchars($dummyProfile['pekerjaan_tambahan']) : '' ?>">
                </div>
                <div>
                  <label for="jumlah_tanggungan" class="block text-sm font-medium text-gray-700">Jumlah Tanggungan</label>
                  <input type="number" id="jumlah_tanggungan" name="jumlah_tanggungan" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $dummyProfile ? $dummyProfile['jumlah_tanggungan'] : '0' ?>">
                </div>
                <div>
                  <label for="luas_lahan_total" class="block text-sm font-medium text-gray-700">Luas Lahan Total (ha)</label>
                  <input type="number" step="0.01" id="luas_lahan_total" name="luas_lahan_total" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $dummyProfile ? $dummyProfile['luas_lahan_total'] : '0' ?>">
                </div>
                <div>
                  <label for="pengalaman_bertahun" class="block text-sm font-medium text-gray-700">Pengalaman Bertani (tahun)</label>
                  <input type="number" id="pengalaman_bertahun" name="pengalaman_bertahun" min="0" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $dummyProfile ? $dummyProfile['pengalaman_bertahun'] : '0' ?>">
                </div>
                <div>
                  <label for="keterampilan_khusus" class="block text-sm font-medium text-gray-700">Keterampilan Khusus</label>
                  <textarea id="keterampilan_khusus" name="keterampilan_khusus" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $dummyProfile ? htmlspecialchars($dummyProfile['keterampilan_khusus']) : '' ?></textarea>
                </div>
                <div>
                  <label for="catatan_kesehatan" class="block text-sm font-medium text-gray-700">Catatan Kesehatan</label>
                  <textarea id="catatan_kesehatan" name="catatan_kesehatan" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $dummyProfile ? htmlspecialchars($dummyProfile['catatan_kesehatan']) : '' ?></textarea>
                </div>
                <!-- End Informasi Tambahan Profil -->

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
              <!-- Kolom Kanan -->
              <div class="space-y-4">
                <div>
                  <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                  <input type="text" id="tempat_lahir" name="tempat_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['tempat_lahir']) : '' ?>">
                </div>
                <div>
                  <label for="tgl_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                  <input type="date" id="tgl_lahir" name="tgl_lahir" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['tgl_lahir']) : '' ?>">
                </div>
                <div>
                  <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                  <textarea id="alamat" name="alamat" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $action == 'edit' ? htmlspecialchars($farmer['alamat']) : '' ?></textarea>
                </div>
                <div>
                  <label for="kabupaten_id" class="block text-sm font-medium text-gray-700">Kabupaten</label>
                  <select id="kabupaten_id" name="kabupaten_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Kabupaten</option>
                    <?php foreach ($dummyKabupaten as $k): ?>
                      <option value="<?= $k['kabupaten_id'] ?>" <?= $action == 'edit' && $farmer['kabupaten_id'] == $k['kabupaten_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($k['name']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div>
                  <label for="kecamatan_id" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                  <select id="kecamatan_id" name="kecamatan_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Kecamatan</option>
                    <?php if ($action == 'edit'): ?>
                      <?php foreach ($dummyKecamatan as $kc): ?>
                        <?php if ($kc['kabupaten_id'] == $farmer['kabupaten_id']): ?>
                          <option value="<?= $kc['kecamatan_id'] ?>" <?= $farmer['kecamatan_id'] == $kc['kecamatan_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kc['name']) ?>
                          </option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <div>
                  <label for="village_id" class="block text-sm font-medium text-gray-700">Desa</label>
                  <select id="village_id" name="village_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Desa</option>
                    <?php if ($action == 'edit'): ?>
                      <?php foreach ($dummyVillages as $v): ?>
                        <?php if ($v['kecamatan_id'] == $farmer['kecamatan_id']): ?>
                          <option value="<?= $v['village_id'] ?>" <?= $farmer['village_id'] == $v['village_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($v['name']) ?>
                          </option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <div>
                  <label for="kode_wilayah" class="block text-sm font-medium text-gray-700">Kode Wilayah</label>
                  <input type="text" id="kode_wilayah" name="kode_wilayah" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['kode_wilayah']) : '' ?>">
                </div>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="ics_id" class="block text-sm font-medium text-gray-700">ICS</label>
                <select id="ics_id" name="ics_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Pilih ICS</option>
                  <?php foreach ($dummyIcsList as $ics): ?>
                    <option value="<?= $ics['ics_id'] ?>" <?= $action == 'edit' && $farmer['ics_id'] == $ics['ics_id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($ics['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label for="group_id" class="block text-sm font-medium text-gray-700">Kelompok Tani</label>
                <select id="group_id" name="group_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Pilih Kelompok Tani</option>
                  <?php foreach ($dummyGroups as $g): ?>
                    <option value="<?= $g['farmer_gr_id'] ?>" <?= $action == 'edit' && $farmer['group_id'] == $g['farmer_gr_id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($g['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label for="tgl_masuk_gr" class="block text-sm font-medium text-gray-700">Tanggal Gabung Kelompok</label>
                <input type="date" id="tgl_masuk_gr" name="tgl_masuk_gr" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($farmer['tgl_masuk_gr']) : '' ?>">
              </div>
            </div>
            <?php if ($action == 'edit'): ?>
              <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                  <option value="Active" <?= $farmer['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                  <option value="Inactive" <?= $farmer['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
              </div>
            <?php endif; ?>
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
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
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
              <p class="text-sm text-gray-500">NIK: <?= htmlspecialchars($farmer['nik']) ?></p>
              <div class="mt-6 space-y-4 text-left">
                <div>
                  <p class="text-sm text-gray-500">NPWP</p>
                  <p class="text-sm font-medium"><?= !empty($farmer['npwp']) ? htmlspecialchars($farmer['npwp']) : '-' ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Jenis Kelamin</p>
                  <p class="text-sm font-medium">
                    <?= $farmer['gender'] == 'Male' ? 'Laki-laki' : ($farmer['gender'] == 'Female' ? 'Perempuan' : 'Lainnya') ?>
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
                  <p class="text-sm text-gray-500">Kabupaten</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['kabupaten_name']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Kecamatan</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['kecamatan_name']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Desa</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['village_name']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">ICS</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['ics_name']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Kelompok Tani</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($farmer['group_name']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Tanggal Gabung</p>
                  <p class="text-sm font-medium"><?= date('d/m/Y', strtotime($farmer['tgl_masuk_gr'])) ?></p>
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
          <!-- Informasi Tambahan Profil (Hanya Tampilan) -->
          <?php if ($dummyProfile): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
              <div class="p-6 bg-gray-50 border-b">
                <h3 class="text-lg font-medium text-gray-900">Informasi Tambahan</h3>
              </div>
              <div class="p-6 space-y-4">
                <div>
                  <p class="text-sm text-gray-500">Pendidikan Terakhir</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['pendidikan_terakhir']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Pekerjaan Tambahan</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['pekerjaan_tambahan']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Jumlah Tanggungan</p>
                  <p class="text-sm font-medium"><?= $dummyProfile['jumlah_tanggungan'] ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Luas Lahan Total</p>
                  <p class="text-sm font-medium"><?= $dummyProfile['luas_lahan_total'] ?> ha</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Pengalaman Bertani</p>
                  <p class="text-sm font-medium"><?= $dummyProfile['pengalaman_bertahun'] ?> tahun</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Keterampilan Khusus</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['keterampilan_khusus']) ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Catatan Kesehatan</p>
                  <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['catatan_kesehatan']) ?></p>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <!-- Kolom Kanan - Tab -->
        <div class="lg:col-span-3">
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="border-b border-gray-200">
              <nav class="flex -mb-px">
                <a href="#profile" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-[#f0ab00] text-[#f0ab00]">
                  Profil
                </a>
                <a href="#groups" class="tab-link py-4 px-6 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                  Keanggotaan
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
                          Belum ada informasi profil tambahan untuk petani ini.
                        </p>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
                 <!-- Hanya Tampilan, tidak ada form -->
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                      <div>
                        <p class="text-sm text-gray-500">Pendidikan Terakhir</p>
                        <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['pendidikan_terakhir']) ?></p>
                      </div>
                      <div>
                        <p class="text-sm text-gray-500">Pekerjaan Tambahan</p>
                        <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['pekerjaan_tambahan']) ?></p>
                      </div>
                      <div>
                        <p class="text-sm text-gray-500">Jumlah Tanggungan</p>
                        <p class="text-sm font-medium"><?= $dummyProfile['jumlah_tanggungan'] ?></p>
                      </div>
                    </div>
                    <div class="space-y-4">
                      <div>
                        <p class="text-sm text-gray-500">Luas Lahan Total (ha)</p>
                        <p class="text-sm font-medium"><?= $dummyProfile['luas_lahan_total'] ?> ha</p>
                      </div>
                      <div>
                        <p class="text-sm text-gray-500">Pengalaman Bertani (tahun)</p>
                        <p class="text-sm font-medium"><?= $dummyProfile['pengalaman_bertahun'] ?> tahun</p>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                    <p class="text-sm text-gray-500">Keterampilan Khusus</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['keterampilan_khusus']) ?></p>
                  </div>
                  <div class="mt-4">
                    <p class="text-sm text-gray-500">Catatan Kesehatan</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($dummyProfile['catatan_kesehatan']) ?></p>
                  </div>
              </div>
              <!-- Tab Keanggotaan Kelompok -->
              <div id="groups-content" class="tab-content hidden">
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-lg font-medium text-gray-900">Keanggotaan Kelompok Tani</h3>
                  <button onclick="openModal('add-membership-modal')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Keanggotaan
                  </button>
                </div>
                <?php if (empty($dummyMemberships)): ?>
                  <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <div class="flex">
                      <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                      </div>
                      <div class="ml-3">
                        <p class="text-sm text-blue-700">
                          Petani ini belum terdaftar di kelompok tani manapun.
                        </p>
                      </div>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelompok Tani</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Gabung</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Keluar</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($dummyMemberships as $m): ?>
                          <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($m['group_name']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900"><?= htmlspecialchars($m['jabatan']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900"><?= date('d/m/Y', strtotime($m['tgl_gabung'])) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900"><?= $m['tgl_keluar'] ? date('d/m/Y', strtotime($m['tgl_keluar'])) : '-' ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $m['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                <?= $m['status'] ?>
                              </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                              <button onclick="openModal('edit-membership-modal-<?= $m['membership_id'] ?>')" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                <i class="fas fa-edit"></i>
                              </button>
                              <form method="post" style="display:inline;">
                                <input type="hidden" name="membership_id" value="<?= $m['membership_id'] ?>">
                                <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
                                <input type="hidden" name="remove_membership" value="1">
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus keanggotaan ini?')">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
              </div>
              <!-- Tab Dokumen -->
              <div id="documents-content" class="tab-content hidden">
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-lg font-medium text-gray-900">Dokumen Petani</h3>
                  <button onclick="openModal('add-document-modal')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
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
                          Belum ada dokumen untuk petani ini.
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
                          <form method="post">
                            <input type="hidden" name="document_id" value="<?= $doc['document_id'] ?>">
                            <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
                            <input type="hidden" name="delete_document" value="1">
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                              <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                          </form>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              </div>
              <!-- Tab Riwayat -->
              <div id="history-content" class="tab-content hidden">
                <div class="flex justify-between items-center mb-6">
                  <h3 class="text-lg font-medium text-gray-900">Riwayat Petani</h3>
                  <button onclick="openModal('add-history-modal')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
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
                          Belum ada riwayat untuk petani ini.
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
                            <form method="post" class="mt-2">
                              <input type="hidden" name="history_id" value="<?= $h['history_id'] ?>">
                              <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
                              <input type="hidden" name="delete_history" value="1">
                              <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?')">
                                <i class="fas fa-trash mr-1"></i> Hapus
                              </button>
                            </form>
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
<!-- Modal Tambah Keanggotaan -->
<div id="add-membership-modal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Keanggotaan Kelompok</h3>
        <form method="post">
          <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
          <input type="hidden" name="add_membership" value="1">
          <div class="mb-4">
            <label for="group_id" class="block text-sm font-medium text-gray-700">Kelompok Tani</label>
            <select id="group_id" name="group_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Kelompok Tani</option>
              <?php foreach ($dummyGroups as $g): ?>
                <option value="<?= $g['farmer_gr_id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-4">
            <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="tgl_gabung" class="block text-sm font-medium text-gray-700">Tanggal Gabung</label>
            <input type="date" id="tgl_gabung" name="tgl_gabung" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeModal('add-membership-modal')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
              Batal
            </button>
            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah Dokumen -->
<div id="add-document-modal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Dokumen Petani</h3>
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
          <input type="hidden" name="add_document" value="1">
          <div class="mb-4">
            <label for="document_type" class="block text-sm font-medium text-gray-700">Jenis Dokumen</label>
            <select id="document_type" name="document_type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Jenis Dokumen</option>
              <option value="KTP">KTP</option>
              <option value="NPWP">NPWP</option>
              <option value="Sertifikat Tanah">Sertifikat Tanah</option>
              <option value="Izin Usaha">Izin Usaha</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="document_name" class="block text-sm font-medium text-gray-700">Nama Dokumen</label>
            <input type="text" id="document_name" name="document_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="document_file" class="block text-sm font-medium text-gray-700">File Dokumen</label>
            <input type="file" id="document_file" name="document_file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="issue_date" class="block text-sm font-medium text-gray-700">Tanggal Diterbitkan</label>
              <input type="date" id="issue_date" name="issue_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="expiry_date" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
              <input type="date" id="expiry_date" name="expiry_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeModal('add-document-modal')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
              Batal
            </button>
            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah Riwayat -->
<div id="add-history-modal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Riwayat Petani</h3>
        <form method="post">
          <input type="hidden" name="farmer_id" value="<?= $farmer_id ?>">
          <input type="hidden" name="add_history" value="1">
          <div class="mb-4">
            <label for="history_type" class="block text-sm font-medium text-gray-700">Jenis Riwayat</label>
            <select id="history_type" name="history_type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Jenis Riwayat</option>
              <option value="Pelatihan">Pelatihan</option>
              <option value="Penyuluhan">Penyuluhan</option>
              <option value="Panen">Panen</option>
              <option value="Masalah">Masalah</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="event_date" class="block text-sm font-medium text-gray-700">Tanggal Kejadian</label>
            <input type="date" id="event_date" name="event_date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeModal('add-history-modal')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
              Batal
            </button>
            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
              Simpan
            </button>
          </div>
        </form>
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
  // Fungsi untuk modal
  function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('active');
  }
  function closeModal(id) {
    document.getElementById(id).classList.remove('active');
    document.getElementById(id).classList.add('hidden');
  }
  // Tutup modal saat klik di luar
  window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
      event.target.classList.remove('active');
      event.target.classList.add('hidden');
    }
  }
  // AJAX untuk cascading dropdown
  document.getElementById('kabupaten_id').addEventListener('change', function() {
    const kabupatenId = this.value;
    const kecamatanSelect = document.getElementById('kecamatan_id');
    const desaSelect = document.getElementById('village_id');
    // Reset kecamatan dan desa
    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
    if (kabupatenId) {
      // Simulasi pengambilan data kecamatan berdasarkan kabupaten
      const kecamatanData = <?= json_encode($dummyKecamatan) ?>;
      const filteredKecamatan = kecamatanData.filter(k => k.kabupaten_id == kabupatenId);
      filteredKecamatan.forEach(k => {
        const option = document.createElement('option');
        option.value = k.kecamatan_id;
        option.textContent = k.name;
        kecamatanSelect.appendChild(option);
      });
    }
  });
  document.getElementById('kecamatan_id').addEventListener('change', function() {
    const kecamatanId = this.value;
    const desaSelect = document.getElementById('village_id');
    // Reset desa
    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
    if (kecamatanId) {
      // Simulasi pengambilan data desa berdasarkan kecamatan
      const desaData = <?= json_encode($dummyVillages) ?>;
      const filteredDesa = desaData.filter(d => d.kecamatan_id == kecamatanId);
      filteredDesa.forEach(d => {
        const option = document.createElement('option');
        option.value = d.village_id;
        option.textContent = d.name;
        desaSelect.appendChild(option);
      });
    }
  });
</script>
<?php include 'footer.php'; ?>
```