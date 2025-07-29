<?php
// include 'config.php';
include 'header.php';

// Simulasi koneksi database dan data dummy
$dummyICS = [
  ['ics_id' => 1, 'name' => 'ICS Maju Jaya'],
  ['ics_id' => 2, 'name' => 'ICS Sejahtera'],
  ['ics_id' => 3, 'name' => 'ICS Makmur']
];

$dummyFarmers = [
  [
    'farmer_id' => 1,
    'code' => 'KMJ14.08.06.2006.0001',
    'name' => 'Budi Santoso',
    'gender' => 'Laki-laki',
    'ics_id' => 1,
    'ics_name' => 'ICS Maju Jaya'
  ],
  [
    'farmer_id' => 2,
    'code' => 'KMJ14.08.06.2006.0002',
    'name' => 'Siti Aminah',
    'gender' => 'Perempuan',
    'ics_id' => 1,
    'ics_name' => 'ICS Maju Jaya'
  ],
  [
    'farmer_id' => 3,
    'code' => 'KMJ14.08.06.2006.0003',
    'name' => 'Joko Susilo',
    'gender' => 'Laki-laki',
    'ics_id' => 2,
    'ics_name' => 'ICS Sejahtera'
  ]
];

$dummyParticipants = [
  [
    'fr_training_id' => 1,
    'training_id' => 1,
    'farmer_id' => 1,
    'farmer_code' => 'KMJ14.08.06.2006.0001',
    'nama' => 'Budi Santoso',
    'hubungan' => 'Pemilik',
    'gender' => 'Laki-laki',
    'lembaga' => 'ICS Maju Jaya',
    'jabatan' => 'Ketua',
    'no_hp' => '081234567890',
    'status' => 'Terverifikasi'
  ],
  [
    'fr_training_id' => 2,
    'training_id' => 1,
    'farmer_id' => 2,
    'farmer_code' => 'KMJ14.08.06.2006.0002',
    'nama' => 'Siti Aminah',
    'hubungan' => 'Istri',
    'gender' => 'Perempuan',
    'lembaga' => 'ICS Maju Jaya',
    'jabatan' => 'Anggota',
    'no_hp' => '081298765432',
    'status' => 'Terverifikasi'
  ]
];

$dummySpeakers = [
  [
    'ns_training_id' => 1,
    'training_id' => 1,
    'user_id' => 1,
    'type' => 'internal',
    'nama' => 'John Doe',
    'foto' => 'speaker1.jpg',
    'lembaga' => 'PT ABC'
  ],
  [
    'ns_training_id' => 2,
    'training_id' => 1,
    'user_id' => 2,
    'type' => 'eksternal',
    'nama' => 'Jane Smith',
    'foto' => 'speaker2.jpg',
    'lembaga' => 'Universitas XYZ'
  ]
];

// Simulasi data dummy untuk contoh
$dummyTrainings = [
  [
    'training_id' => 1,
    'nama' => 'Pelatihan Pertanian Modern',
    'modul' => 'Teknik Pemupukan',
    'create_by' => 'Admin',
    'create_date' => '2023-05-10',
    'date' => '2023-05-15',
    'location' => 'Kebun Percobaan Siak',
    'absen' => 'absen_20230515.pdf',
    'notulen' => 'notulen_20230515.pdf',
    'note' => 'Peserta antusias mempelajari teknik baru',
    'ics_id' => 1,
    'ics_name' => 'ICS Maju Jaya',
    'verif_date' => '2023-05-16',
    'status' => 'Terverifikasi'
  ],
  [
    'training_id' => 2,
    'nama' => 'Manajemen Lahan',
    'modul' => 'Pengolahan Tanah',
    'create_by' => 'Manager',
    'create_date' => '2023-06-15',
    'date' => '2023-06-20',
    'location' => 'Balai Desa Berumbung Baru',
    'absen' => 'absen_20230620.pdf',
    'notulen' => 'notulen_20230620.pdf',
    'note' => 'Diskusi intensif tentang rotasi tanaman',
    'ics_id' => 2,
    'ics_name' => 'ICS Sejahtera',
    'verif_date' => '2023-06-21',
    'status' => 'Terverifikasi'
  ]
];

// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$training_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Parameter filter dan pagination
$search = isset($_GET['search']) ? $_GET['search'] : '';
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
$creator = isset($_GET['creator']) ? $_GET['creator'] : '';
$ics_filter = isset($_GET['ics_filter']) ? intval($_GET['ics_filter']) : 0;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 2; // Jumlah item per halaman

// Filter data
$filteredTrainings = array_filter($dummyTrainings, function ($t) use ($search, $date_from, $date_to, $creator, $ics_filter) {
  $match = true;

  if ($search && stripos($t['nama'], $search) === false && stripos($t['modul'], $search) === false) {
    $match = false;
  }

  if ($date_from && strtotime($t['date']) < strtotime($date_from)) {
    $match = false;
  }

  if ($date_to && strtotime($t['date']) > strtotime($date_to)) {
    $match = false;
  }

  if ($creator && $t['create_by'] != $creator) {
    $match = false;
  }

  if ($ics_filter && $t['ics_id'] != $ics_filter) {
    $match = false;
  }

  return $match;
});

// Hitung total data setelah filter
$total_trainings = count($filteredTrainings);
$total_pages = ceil($total_trainings / $per_page);

// Ambil data untuk halaman saat ini
$offset = ($page - 1) * $per_page;
$current_page_trainings = array_slice($filteredTrainings, $offset, $per_page);

// Dapatkan daftar creator unik untuk filter
$creators = array_unique(array_column($dummyTrainings, 'create_by'));

// Simulasi data training yang dipilih
$training = null;
if ($training_id > 0) {
  foreach ($dummyTrainings as $t) {
    if ($t['training_id'] == $training_id) {
      $training = $t;
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

// Simulasi peserta pelatihan
$training_participants = [];
if ($training_id > 0) {
  $training_participants = array_filter($dummyParticipants, function ($p) use ($training_id) {
    return $p['training_id'] == $training_id;
  });
}

// Simulasi narasumber pelatihan
$training_speakers = [];
if ($training_id > 0) {
  $training_speakers = array_filter($dummySpeakers, function ($s) use ($training_id) {
    return $s['training_id'] == $training_id;
  });
}
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
  <header class="h-20 shadow-sm flex items-center justify-between px-8">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-gray-800">
        <?php
        if ($action == 'add') echo "Tambah Pelatihan Baru";
        elseif ($action == 'view') echo "Detail Pelatihan: " . ($training ? htmlspecialchars($training['nama']) : '');
        elseif ($action == 'edit') echo "Edit Pelatihan: " . ($training ? htmlspecialchars($training['nama']) : '');
        else echo "Data Pelatihan";
        ?>
      </h1>
    </div>
    <div class="flex items-center space-x-6">
      <?php if ($action == 'list'): ?>
        <a href="pelatihan.php" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Pelatihan
        </a>
      <?php elseif ($action == 'view'): ?>
        <a href="pelatihan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="pelatihan.php?action=edit&id=<?= $training_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit
        </a>
      <?php elseif ($action == 'edit'): ?>
        <a href="pelatihan.php?action=view&id=<?= $training_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
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
          <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
          </svg>
        </span>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
          </svg>
        </span>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if ($action == 'list'): ?>
      <!-- Daftar Pelatihan -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
          <form method="get" class="flex flex-wrap gap-4">
            <input type="hidden" name="action" value="list">

            <div class="w-full md:w-auto flex-1">
              <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama/modul pelatihan...">
            </div>

            <div class="w-full md:w-auto">
              <select name="creator" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Pembuat</option>
                <?php foreach ($creators as $c): ?>
                  <option value="<?= htmlspecialchars($c) ?>" <?= $creator == $c ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="w-full md:w-auto">
              <select name="ics_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua ICS</option>
                <?php foreach ($dummyICS as $ics): ?>
                  <option value="<?= $ics['ics_id'] ?>" <?= $ics_filter == $ics['ics_id'] ? 'selected' : '' ?>><?= htmlspecialchars($ics['name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="w-full md:w-auto">
              <input type="date" name="date_from" value="<?= htmlspecialchars($date_from) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Dari Tanggal">
            </div>

            <div class="w-full md:w-auto">
              <input type="date" name="date_to" value="<?= htmlspecialchars($date_to) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Sampai Tanggal">
            </div>

            <div class="w-full md:w-auto flex items-center space-x-2">
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-filter mr-2"></i> Filter
              </button>
              <?php if ($search || $date_from || $date_to || $creator || $ics_filter): ?>
                <a href="pelatihan.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                  <i class="fas fa-times mr-2"></i> Reset
                </a>
              <?php endif; ?>
            </div>
          </form>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelatihan</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modul</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ICS</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pelatihan</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat Oleh</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php if (empty($current_page_trainings)): ?>
                <tr>
                  <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data pelatihan</td>
                </tr>
              <?php else: ?>
                <?php foreach ($current_page_trainings as $index => $t): ?>
                  <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap"><?= $offset + $index + 1 ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($t['nama']) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"><?= htmlspecialchars($t['modul']) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"><?= htmlspecialchars($t['ics_name']) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500"><?= date('d/m/Y', strtotime($t['date'])) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"><?= htmlspecialchars($t['location']) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"><?= htmlspecialchars($t['create_by']) ?></div>
                      <div class="text-sm text-gray-500"><?= date('d/m/Y', strtotime($t['create_date'])) ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <a href="pelatihan.php?action=view&id=<?= $t['training_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="pelatihan.php?action=edit&id=<?= $t['training_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form method="post" style="display:inline;">
                        <input type="hidden" name="training_id" value="<?= $t['training_id'] ?>">
                        <input type="hidden" name="delete_training" value="1">
                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')">
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

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="flex-1 flex justify-between sm:hidden">
            <a href="pelatihan.php?action=list&page=<?= max(1, $page - 1) ?>&search=<?= urlencode($search) ?>&date_from=<?= urlencode($date_from) ?>&date_to=<?= urlencode($date_to) ?>&creator=<?= urlencode($creator) ?>&ics_filter=<?= $ics_filter ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
              Sebelumnya
            </a>
            <a href="pelatihan.php?action=list&page=<?= min($total_pages, $page + 1) ?>&search=<?= urlencode($search) ?>&date_from=<?= urlencode($date_from) ?>&date_to=<?= urlencode($date_to) ?>&creator=<?= urlencode($creator) ?>&ics_filter=<?= $ics_filter ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
              Selanjutnya
            </a>
          </div>
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Menampilkan <span class="font-medium"><?= $offset + 1 ?></span> sampai <span class="font-medium"><?= min($offset + $per_page, $total_trainings) ?></span> dari <span class="font-medium"><?= $total_trainings ?></span> hasil
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="pelatihan.php?action=list&page=<?= max(1, $page - 1) ?>&search=<?= urlencode($search) ?>&date_from=<?= urlencode($date_from) ?>&date_to=<?= urlencode($date_to) ?>&creator=<?= urlencode($creator) ?>&ics_filter=<?= $ics_filter ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $page <= 1 ? 'pointer-events-none opacity-50' : '' ?>">
                  <span class="sr-only">Sebelumnya</span>
                  <i class="fas fa-chevron-left"></i>
                </a>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                  <a href="pelatihan.php?action=list&page=<?= $i ?>&search=<?= urlencode($search) ?>&date_from=<?= urlencode($date_from) ?>&date_to=<?= urlencode($date_to) ?>&creator=<?= urlencode($creator) ?>&ics_filter=<?= $ics_filter ?>" class="<?= $i == $page ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50' ?> relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                    <?= $i ?>
                  </a>
                <?php endfor; ?>

                <a href="pelatihan.php?action=list&page=<?= min($total_pages, $page + 1) ?>&search=<?= urlencode($search) ?>&date_from=<?= urlencode($date_from) ?>&date_to=<?= urlencode($date_to) ?>&creator=<?= urlencode($creator) ?>&ics_filter=<?= $ics_filter ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $page >= $total_pages ? 'pointer-events-none opacity-50' : '' ?>">
                  <span class="sr-only">Selanjutnya</span>
                  <i class="fas fa-chevron-right"></i>
                </a>
              </nav>
            </div>
          </div>
        </div>
      </div>

    <?php elseif ($action == 'add' || $action == 'edit'): ?>
      <!-- Form Tambah/Edit Pelatihan -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?= $action == 'add' ? 'add_training' : 'update_training' ?>" value="1">
            <?php if ($action == 'edit'): ?>
              <input type="hidden" name="training_id" value="<?= $training_id ?>">
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Kolom Kiri -->
              <div class="space-y-4">
                <div>
                  <label for="nama" class="block text-sm font-medium text-gray-700">Nama Pelatihan<span class="text-red-500">*</span></label>
                  <input type="text" id="nama" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($training['nama']) : '' ?>">
                </div>
                <div>
                  <label for="modul" class="block text-sm font-medium text-gray-700">Modul</label>
                  <input type="text" id="modul" name="modul" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($training['modul']) : '' ?>">
                </div>
                <div>
                  <label for="ics_id" class="block text-sm font-medium text-gray-700">ICS<span class="text-red-500">*</span></label>
                  <select id="ics_id" name="ics_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih ICS</option>
                    <?php foreach ($dummyICS as $ics): ?>
                      <option value="<?= $ics['ics_id'] ?>" <?= ($action == 'edit' && $training['ics_id'] == $ics['ics_id']) ? 'selected' : '' ?>><?= htmlspecialchars($ics['name']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <!-- Kolom Kanan -->
              <div class="space-y-4">
                <div>
                  <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Pelatihan<span class="text-red-500">*</span></label>
                  <input type="date" id="date" name="date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($training['date']) : '' ?>">
                </div>
                <div>
                  <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                  <input type="text" id="location" name="location" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?= $action == 'edit' ? htmlspecialchars($training['location']) : '' ?>">
                </div>
                <div>
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                  <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="Terverifikasi" <?= ($action == 'edit' && $training['status'] == 'Terverifikasi') ? 'selected' : '' ?>>Terverifikasi</option>
                    <option value="Belum Diverifikasi" <?= ($action == 'edit' && $training['status'] == 'Belum Diverifikasi') ? 'selected' : '' ?>>Belum Diverifikasi</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
              <div>
                <label for="absen" class="block text-sm font-medium text-gray-700">File Absen</label>
                <input type="file" id="absen" name="absen" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <?php if ($action == 'edit' && !empty($training['absen'])): ?>
                  <div class="mt-2 flex items-center">
                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                    <span class="text-sm text-gray-700"><?= htmlspecialchars($training['absen']) ?></span>
                  </div>
                <?php endif; ?>
              </div>
              <div>
                <label for="notulen" class="block text-sm font-medium text-gray-700">File Notulen</label>
                <input type="file" id="notulen" name="notulen" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <?php if ($action == 'edit' && !empty($training['notulen'])): ?>
                  <div class="mt-2 flex items-center">
                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                    <span class="text-sm text-gray-700"><?= htmlspecialchars($training['notulen']) ?></span>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <div class="mt-6">
              <label for="note" class="block text-sm font-medium text-gray-700">Catatan</label>
              <textarea id="note" name="note" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $action == 'edit' ? htmlspecialchars($training['note']) : '' ?></textarea>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
              <a href="<?= $action == 'add' ? 'pelatihan.php' : 'pelatihan.php?action=view&id=' . $training_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>

    <?php elseif ($action == 'view' && $training): ?>
      <!-- Tampilan Detail Pelatihan -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri - Detail Pelatihan -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 bg-gray-50 border-b">
              <h3 class="text-lg font-medium text-gray-900">Detail Pelatihan</h3>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                  <div>
                    <p class="text-sm text-gray-500">Nama Pelatihan</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($training['nama']) ?></p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Modul</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($training['modul']) ?></p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">ICS</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($training['ics_name']) ?></p>
                  </div>
                </div>
                <div class="space-y-4">
                  <div>
                    <p class="text-sm text-gray-500">Tanggal Pelatihan</p>
                    <p class="text-sm font-medium"><?= date('d/m/Y', strtotime($training['date'])) ?></p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Lokasi</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($training['location']) ?></p>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="text-sm font-medium"><?= htmlspecialchars($training['status']) ?></p>
                    <?php if (!empty($training['verif_date'])): ?>
                      <p class="text-sm text-gray-500">Tanggal Verifikasi</p>
                      <p class="text-sm font-medium"><?= date('d/m/Y', strtotime($training['verif_date'])) ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="mt-6">
                <p class="text-sm text-gray-500">Dibuat Oleh</p>
                <p class="text-sm font-medium"><?= htmlspecialchars($training['create_by']) ?> pada <?= date('d/m/Y', strtotime($training['create_date'])) ?></p>
              </div>
              <div class="mt-6">
                <p class="text-sm text-gray-500">Catatan</p>
                <p class="text-sm font-medium"><?= htmlspecialchars($training['note']) ?></p>
              </div>
              <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <p class="text-sm text-gray-500">File Absen</p>
                  <?php if (!empty($training['absen'])): ?>
                    <a href="<?= htmlspecialchars($training['absen']) ?>" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                      <i class="fas fa-file-pdf mr-2"></i> <?= htmlspecialchars($training['absen']) ?>
                    </a>
                  <?php else: ?>
                    <p class="text-sm text-gray-500">Tidak ada file</p>
                  <?php endif; ?>
                </div>
                <div>
                  <p class="text-sm text-gray-500">File Notulen</p>
                  <?php if (!empty($training['notulen'])): ?>
                    <a href="<?= htmlspecialchars($training['notulen']) ?>" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                      <i class="fas fa-file-pdf mr-2"></i> <?= htmlspecialchars($training['notulen']) ?>
                    </a>
                  <?php else: ?>
                    <p class="text-sm text-gray-500">Tidak ada file</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Daftar Peserta -->
          <div class="bg-white rounded-xl shadow-md overflow-hidden mt-6">
            <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
              <h3 class="text-lg font-medium text-gray-900">Daftar Peserta</h3>
              <button onclick="openModal('add-participant-modal')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Peserta
              </button>
            </div>
            <div class="p-6">
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Petani</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hubungan</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($training_participants)): ?>
                      <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada peserta</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($training_participants as $index => $p): ?>
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap"><?= $index + 1 ?></td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= htmlspecialchars($p['farmer_code']) ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($p['nama']) ?></div>
                            <div class="text-sm text-gray-500"><?= htmlspecialchars($p['lembaga']) ?></div>
                            <div class="text-sm text-gray-500"><?= htmlspecialchars($p['jabatan']) ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= htmlspecialchars($p['hubungan']) ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= htmlspecialchars($p['gender']) ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?= htmlspecialchars($p['no_hp']) ?></div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $p['status'] == 'Terverifikasi' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                              <?= htmlspecialchars($p['status']) ?>
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openEditParticipantModal(<?= htmlspecialchars(json_encode($p)) ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                              <i class="fas fa-edit"></i>
                            </button>
                            <form method="post" style="display:inline;">
                              <input type="hidden" name="fr_training_id" value="<?= $p['fr_training_id'] ?>">
                              <input type="hidden" name="delete_participant" value="1">
                              <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
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
          </div>
        </div>

        <!-- Kolom Kanan - Narasumber -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
              <h3 class="text-lg font-medium text-gray-900">Narasumber</h3>
              <button onclick="openModal('add-speaker-modal')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Narasumber
              </button>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <?php if (empty($training_speakers)): ?>
                  <p class="text-sm text-gray-500 text-center">Belum ada narasumber</p>
                <?php else: ?>
                  <?php foreach ($training_speakers as $speaker): ?>
                    <div class="bg-gray-50 p-4 rounded-lg">
                      <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                          <?php if (!empty($speaker['foto'])): ?>
                            <img src="<?= htmlspecialchars($speaker['foto']) ?>" alt="Foto Narasumber" class="h-full w-full object-cover">
                          <?php else: ?>
                            <i class="fas fa-user text-gray-400"></i>
                          <?php endif; ?>
                        </div>
                        <div class="ml-4 flex-1">
                          <h4 class="text-sm font-medium text-gray-900"><?= htmlspecialchars($speaker['nama']) ?></h4>
                          <p class="text-sm text-gray-500"><?= ucfirst($speaker['type']) ?> - <?= htmlspecialchars($speaker['lembaga']) ?></p>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                          <form method="post" style="display:inline;">
                            <input type="hidden" name="ns_training_id" value="<?= $speaker['ns_training_id'] ?>">
                            <input type="hidden" name="delete_speaker" value="1">
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus narasumber ini?')">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
</main>

<!-- Modal Tambah Peserta -->
<div id="add-participant-modal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Peserta Pelatihan</h3>
        <form method="post">
          <input type="hidden" name="training_id" value="<?= $training_id ?>">
          <input type="hidden" name="add_participant" value="1">

          <div class="mb-4">
            <label for="farmer_id" class="block text-sm font-medium text-gray-700">Petani<span class="text-red-500">*</span></label>
            <select id="farmer_id" name="farmer_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" onchange="updateFarmerInfo(this.value)">
              <option value="">Pilih Petani</option>
              <?php foreach ($dummyFarmers as $farmer): ?>
                <option value="<?= $farmer['farmer_id'] ?>" data-code="<?= htmlspecialchars($farmer['code']) ?>" data-name="<?= htmlspecialchars($farmer['name']) ?>" data-gender="<?= htmlspecialchars($farmer['gender']) ?>" data-ics="<?= htmlspecialchars($farmer['ics_name']) ?>">
                  <?= htmlspecialchars($farmer['name']) ?> (<?= htmlspecialchars($farmer['code']) ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="farmer_code" class="block text-sm font-medium text-gray-700">Kode Petani</label>
              <input type="text" id="farmer_code" name="farmer_code" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="nama" class="block text-sm font-medium text-gray-700">Nama Peserta<span class="text-red-500">*</span></label>
              <input type="text" id="nama" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
              <select id="gender" name="gender" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div>
              <label for="hubungan" class="block text-sm font-medium text-gray-700">Hubungan<span class="text-red-500">*</span></label>
              <select id="hubungan" name="hubungan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="Pemilik">Pemilik</option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Orang Tua">Orang Tua</option>
                <option value="Relasi">Relasi</option>
                <option value="Staff">Staff</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="lembaga" class="block text-sm font-medium text-gray-700">Lembaga</label>
              <input type="text" id="lembaga" name="lembaga" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
              <input type="text" id="jabatan" name="jabatan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>

          <div class="mb-4">
            <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
            <input type="text" id="no_hp" name="no_hp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status Sertifikat</label>
            <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="Terverifikasi">Terverifikasi</option>
              <option value="Belum Diverifikasi">Belum Diverifikasi</option>
            </select>
          </div>

          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeModal('add-participant-modal')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
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

<!-- Modal Edit Peserta -->
<div id="edit-participant-modal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Peserta Pelatihan</h3>
        <form method="post">
          <input type="hidden" name="fr_training_id" id="edit_fr_training_id">
          <input type="hidden" name="training_id" value="<?= $training_id ?>">
          <input type="hidden" name="update_participant" value="1">

          <div class="mb-4">
            <label for="edit_farmer_id" class="block text-sm font-medium text-gray-700">Petani<span class="text-red-500">*</span></label>
            <select id="edit_farmer_id" name="farmer_id" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" disabled>
              <option value="">Pilih Petani</option>
              <?php foreach ($dummyFarmers as $farmer): ?>
                <option value="<?= $farmer['farmer_id'] ?>"><?= htmlspecialchars($farmer['name']) ?> (<?= htmlspecialchars($farmer['code']) ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="edit_farmer_code" class="block text-sm font-medium text-gray-700">Kode Petani</label>
              <input type="text" id="edit_farmer_code" name="farmer_code" readonly class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama Peserta<span class="text-red-500">*</span></label>
              <input type="text" id="edit_nama" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="edit_gender" class="block text-sm font-medium text-gray-700">Gender</label>
              <select id="edit_gender" name="gender" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div>
              <label for="edit_hubungan" class="block text-sm font-medium text-gray-700">Hubungan<span class="text-red-500">*</span></label>
              <select id="edit_hubungan" name="hubungan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="Pemilik">Pemilik</option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Orang Tua">Orang Tua</option>
                <option value="Relasi">Relasi</option>
                <option value="Staff">Staff</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
              <label for="edit_lembaga" class="block text-sm font-medium text-gray-700">Lembaga</label>
              <input type="text" id="edit_lembaga" name="lembaga" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
              <input type="text" id="edit_jabatan" name="jabatan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
          </div>

          <div class="mb-4">
            <label for="edit_no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
            <input type="text" id="edit_no_hp" name="no_hp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div class="mb-4">
            <label for="edit_status" class="block text-sm font-medium text-gray-700">Status Sertifikat</label>
            <select id="edit_status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="Terverifikasi">Terverifikasi</option>
              <option value="Belum Diverifikasi">Belum Diverifikasi</option>
            </select>
          </div>

          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeModal('edit-participant-modal')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
              Batal
            </button>
            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Narasumber -->
<div id="add-speaker-modal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Narasumber</h3>
        <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="training_id" value="<?= $training_id ?>">
          <input type="hidden" name="add_speaker" value="1">
          <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Narasumber<span class="text-red-500">*</span></label>
            <select id="type" name="type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="internal">Internal</option>
              <option value="eksternal">Eksternal</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
            <select id="user_id" name="user_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih User</option>
              <option value="1">John Doe</option>
              <option value="2">Jane Smith</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama<span class="text-red-500">*</span></label>
            <input type="text" id="nama" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="lembaga" class="block text-sm font-medium text-gray-700">Lembaga<span class="text-red-500">*</span></label>
            <input type="text" id="lembaga" name="lembaga" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="mb-4">
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" id="foto" name="foto" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
          </div>
          <div class="flex justify-end space-x-3 mt-6">
            <button type="button" onclick="closeModal('add-speaker-modal')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
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
  // Fungsi untuk modal
  function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
  }

  function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
  }

  // Fungsi untuk membuka modal edit peserta
  function openEditParticipantModal(participant) {
    document.getElementById('edit_fr_training_id').value = participant.fr_training_id;
    document.getElementById('edit_farmer_id').value = participant.farmer_id;
    document.getElementById('edit_farmer_code').value = participant.farmer_code;
    document.getElementById('edit_nama').value = participant.nama;
    document.getElementById('edit_gender').value = participant.gender;
    document.getElementById('edit_hubungan').value = participant.hubungan;
    document.getElementById('edit_lembaga').value = participant.lembaga;
    document.getElementById('edit_jabatan').value = participant.jabatan;
    document.getElementById('edit_no_hp').value = participant.no_hp;
    document.getElementById('edit_status').value = participant.status;

    openModal('edit-participant-modal');
  }

  // Fungsi untuk mengupdate info petani saat dipilih
  function updateFarmerInfo(farmerId) {
    const farmerSelect = document.getElementById('farmer_id');
    const selectedOption = farmerSelect.options[farmerSelect.selectedIndex];

    if (farmerId) {
      document.getElementById('farmer_code').value = selectedOption.getAttribute('data-code');
      document.getElementById('nama').value = selectedOption.getAttribute('data-name');
      document.getElementById('gender').value = selectedOption.getAttribute('data-gender');
      document.getElementById('lembaga').value = selectedOption.getAttribute('data-ics');
    } else {
      document.getElementById('farmer_code').value = '';
      document.getElementById('nama').value = '';
      document.getElementById('lembaga').value = '';
    }
  }

  // Tutup modal saat klik di luar
  window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
      event.target.classList.add('hidden');
    }
  }
</script>

<?php include 'footer.php'; ?>