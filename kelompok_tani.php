<?php
// include 'config.php';
include 'header.php';

// Simulasi data dummy kelompok tani
$dummyGroups = [
  [
    'group_id' => 1,
    'group_name' => 'Koptan Maju Jaya',
    'area' => 'Wilayah 1',
    'coordinates' => '-0.456, 101.345',
    'mentor' => 'Pak Amin',
    'mentor_id' => 1,
    'status' => 'Active',
    'created_date' => '2023-01-15',
    'total_members' => 0 // akan diisi otomatis
  ],
  [
    'group_id' => 2,
    'group_name' => 'Koptan Sejahtera',
    'area' => 'Wilayah 2',
    'coordinates' => '-0.467, 101.356',
    'mentor' => 'Pak Budi',
    'mentor_id' => 2,
    'status' => 'Active',
    'created_date' => '2023-02-20',
    'total_members' => 0
  ],
  [
    'group_id' => 3,
    'group_name' => 'Koptan Harapan Baru',
    'area' => 'Wilayah 3',
    'coordinates' => '-0.445, 101.332',
    'mentor' => 'Ibu Siti',
    'mentor_id' => 3,
    'status' => 'Inactive',
    'created_date' => '2023-03-10',
    'total_members' => 0
  ]
];

// Simulasi data aktivitas kelompok
$dummyActivities = [
  [
    'activity_id' => 1,
    'group_id' => 1,
    'activity_type' => 'Pelatihan SOP',
    'date' => '2025-07-12',
    'summary' => 'Pelatihan GAP di lahan demplot',
    'documentation' => 'document1.pdf',
    'mentor' => 'Pak Amin'
  ],
  [
    'activity_id' => 2,
    'group_id' => 1,
    'activity_type' => 'Pemupukan Bersama',
    'date' => '2025-06-28',
    'summary' => 'Pemupukan organik di lahan anggota',
    'documentation' => 'document2.pdf',
    'mentor' => 'Pak Amin'
  ]
];

// Simulasi data pendamping
$dummyMentors = [
  ['id' => 1, 'name' => 'Pak Amin'],
  ['id' => 2, 'name' => 'Pak Budi'],
  ['id' => 3, 'name' => 'Ibu Siti']
];

// Simulasi data anggota kelompok
$dummyMembers = [
  [
    'member_id' => 1,
    'group_id' => 1,
    'name' => 'Petani 1',
    'plot' => 'Blok A-12',
    'status' => 'Aktif'
  ],
  [
    'member_id' => 2,
    'group_id' => 1,
    'name' => 'Petani 2',
    'plot' => 'Blok B-05',
    'status' => 'Aktif'
  ]
];

// 🔁 Hitung jumlah anggota untuk setiap kelompok secara dinamis
foreach ($dummyGroups as &$group) {
  $count = 0;
  foreach ($dummyMembers as $member) {
    if ($member['group_id'] == $group['group_id']) {
      $count++;
    }
  }
  $group['total_members'] = $count;
}
unset($group); // unset reference

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$group_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$activity_id = isset($_GET['activity_id']) ? intval($_GET['activity_id']) : 0;
$member_id = isset($_GET['member_id']) ? intval($_GET['member_id']) : 0;

// Simulasi data yang dipilih
$group = null;
$activity = null;
$member = null;

if ($group_id) {
  foreach ($dummyGroups as $g) {
    if ($g['group_id'] == $group_id) {
      $group = $g;
      break;
    }
  }
}

if ($activity_id) {
  foreach ($dummyActivities as $a) {
    if ($a['activity_id'] == $activity_id) {
      $activity = $a;
      break;
    }
  }
}

if ($member_id) {
  foreach ($dummyMembers as $m) {
    if ($m['member_id'] == $member_id) {
      $member = $m;
      break;
    }
  }
}

// Pagination configuration
$perPage = 5;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$mentor_filter = isset($_GET['mentor_filter']) ? intval($_GET['mentor_filter']) : 0;
$area_filter = isset($_GET['area_filter']) ? $_GET['area_filter'] : '';
$status_filter = isset($_GET['status_filter']) ? $_GET['status_filter'] : '';

// Filter data
$filteredGroups = array_filter($dummyGroups, function ($g) use ($mentor_filter, $area_filter, $status_filter, $search) {
  $match = true;
  if ($mentor_filter > 0) $match = $match && ($g['mentor_id'] == $mentor_filter);
  if ($area_filter != '') $match = $match && ($g['area'] == $area_filter);
  if ($status_filter != '') $match = $match && ($g['status'] == $status_filter);
  if ($search != '') $match = $match && (stripos($g['group_name'], $search) !== false);
  return $match;
});

$totalGroups = count($filteredGroups);
$totalPages = max(1, ceil($totalGroups / $perPage));
$currentPage = min($currentPage, $totalPages);
$offset = ($currentPage - 1) * $perPage;
$currentPageGroups = array_slice($filteredGroups, $offset, $perPage);
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
  <header class="h-20 shadow-sm flex items-center justify-between px-8">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-gray-800">
        <?php
        if ($action == 'add') echo "Tambah Kelompok Tani Baru";
        elseif ($action == 'view') echo "Detail Kelompok: " . ($group ? htmlspecialchars($group['group_name']) : '');
        elseif ($action == 'edit') echo "Edit Kelompok: " . ($group ? htmlspecialchars($group['group_name']) : '');
        elseif ($action == 'add_activity') echo "Tambah Aktivitas Kelompok";
        elseif ($action == 'edit_activity') echo "Edit Aktivitas Kelompok";
        elseif ($action == 'add_member') echo "Tambah Anggota Kelompok";
        elseif ($action == 'edit_member') echo "Edit Anggota Kelompok";
        else echo "Data Kelompok Tani";
        ?>
      </h1>
    </div>
    <div class="flex items-center space-x-6">
      <?php if ($action == 'list'): ?>
        <a href="kelompok_tani.php?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Kelompok
        </a>
      <?php elseif ($action == 'view'): ?>
        <a href="kelompok_tani.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="kelompok_tani.php?action=edit&id=<?= $group_id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit
        </a>
        <button onclick="confirmDelete('<?= $group_id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-trash-alt mr-2"></i> Hapus
        </button>
      <?php elseif (in_array($action, ['edit', 'add_activity', 'edit_activity', 'add_member', 'edit_member'])): ?>
        <a href="<?= getBackUrl($action, $group_id, $activity_id, $member_id) ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-times mr-2"></i> Batal
        </a>
      <?php elseif ($action == 'add'): ?>
        <a href="kelompok_tani.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
      <?php endif; ?>
    </div>
  </header>

  <!-- Main Content -->
  <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <?php if ($action == 'list'): ?>
      <!-- Daftar Kelompok Tani -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
          <form method="get" class="flex flex-col gap-4">
            <input type="hidden" name="action" value="list">
            <div class="flex-1">
              <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama kelompok..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <select name="mentor_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Pendamping</option>
                  <?php foreach ($dummyMentors as $mentor): ?>
                    <option value="<?= $mentor['id'] ?>" <?= $mentor_filter == $mentor['id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($mentor['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <select name="area_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Area</option>
                  <option value="Wilayah 1" <?= $area_filter == 'Wilayah 1' ? 'selected' : '' ?>>Wilayah 1</option>
                  <option value="Wilayah 2" <?= $area_filter == 'Wilayah 2' ? 'selected' : '' ?>>Wilayah 2</option>
                  <option value="Wilayah 3" <?= $area_filter == 'Wilayah 3' ? 'selected' : '' ?>>Wilayah 3</option>
                </select>
              </div>
              <div>
                <select name="status_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Status</option>
                  <option value="Active" <?= $status_filter == 'Active' ? 'selected' : '' ?>>Aktif</option>
                  <option value="Inactive" <?= $status_filter == 'Inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelompok</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area Wilayah</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Koordinat</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendamping</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php if (empty($currentPageGroups)): ?>
                <tr>
                  <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data kelompok tani</td>
                </tr>
              <?php else: ?>
                <?php foreach ($currentPageGroups as $index => $g): ?>
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $index + 1 + $offset ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($g['group_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($g['area']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($g['coordinates']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($g['mentor'] ?? 'Tidak Ada') ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $g['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                        <?= $g['status'] == 'Active' ? 'Aktif' : 'Tidak Aktif' ?>
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <a href="kelompok_tani.php?action=view&id=<?= $g['group_id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a href="kelompok_tani.php?action=edit&id=<?= $g['group_id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" onclick="confirmDelete('<?= $g['group_id'] ?>')" class="text-red-600 hover:text-red-900" title="Hapus">
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
        <?php if ($totalPages > 1): ?>
          <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
              <div>
                <p class="text-sm text-gray-700">
                  Menampilkan <span class="font-medium"><?= $offset + 1 ?></span> sampai <span class="font-medium"><?= min($offset + $perPage, $totalGroups) ?></span> dari <span class="font-medium"><?= $totalGroups ?></span> kelompok
                </p>
              </div>
              <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                  <a href="kelompok_tani.php?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                    <i class="fas fa-chevron-left"></i>
                  </a>
                  <?php
                  $startPage = max(1, $currentPage - 2);
                  $endPage = min($totalPages, $currentPage + 2);
                  if ($startPage > 1) {
                    echo '<a href="kelompok_tani.php?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                    if ($startPage > 2) {
                      echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                    }
                  }
                  for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = $i == $currentPage ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                    echo '<a href="kelompok_tani.php?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $active . '">' . $i . '</a>';
                  }
                  if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) {
                      echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                    }
                    echo '<a href="kelompok_tani.php?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                  }
                  ?>
                  <a href="kelompok_tani.php?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                    <i class="fas fa-chevron-right"></i>
                  </a>
                </nav>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    <?php elseif ($action == 'add'): ?>
      <!-- Form Tambah Kelompok Tani -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <form method="post" class="space-y-6">
            <input type="hidden" name="add_group" value="1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Kolom Kiri -->
              <div class="space-y-4">
                <div>
                  <label for="group_name" class="block text-sm font-medium text-gray-700">Nama Kelompok *</label>
                  <input type="text" id="group_name" name="group_name" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan nama kelompok">
                </div>
                <div>
                  <label for="mentor" class="block text-sm font-medium text-gray-700">Pendamping (ICS)</label>
                  <select id="mentor" name="mentor"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tidak Ada Pendamping</option>
                    <?php foreach ($dummyMentors as $mentor): ?>
                      <option value="<?= $mentor['id'] ?>"><?= htmlspecialchars($mentor['name']) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div>
                  <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                  <select id="status" name="status" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="Active">Aktif</option>
                    <option value="Inactive">Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <!-- Kolom Kanan -->
              <div class="space-y-4">
                <div>
                  <label for="area" class="block text-sm font-medium text-gray-700">Area Wilayah *</label>
                  <select id="area" name="area" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Area Wilayah</option>
                    <option value="Wilayah 1">Wilayah 1</option>
                    <option value="Wilayah 2">Wilayah 2</option>
                    <option value="Wilayah 3">Wilayah 3</option>
                  </select>
                </div>
                <div>
                  <label for="coordinates" class="block text-sm font-medium text-gray-700">Lokasi Peta (latlong)</label>
                  <input type="text" id="coordinates" name="coordinates"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: -0.456, 101.345">
                  <p class="mt-1 text-sm text-gray-500">Format: latitude, longitude (gunakan titik desimal)</p>
                </div>
                <div>
                  <label for="total_members" class="block text-sm font-medium text-gray-700">Jumlah Anggota *</label>
                  <input type="number" id="total_members" name="total_members" min="1" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan jumlah anggota">
                </div>
              </div>
            </div>
            <!-- Peta Interaktif -->
            <div class="mt-4">
              <h5 class="text-sm font-medium text-gray-700 mb-2">Lokasi di Peta</h5>
              <div id="map" class="w-full h-64 border rounded-lg" style="background-color: #f0f0f0;">
                <iframe width="100%" height="100%" style="border:0; border-radius: 0.5rem;"
                  src="https://maps.google.com/maps?q=-0.456,101.345&z=15&output=embed"
                  frameborder="0" allowfullscreen></iframe>
              </div>
              <p class="mt-2 text-xs text-gray-500">Gunakan input di atas untuk mengisi koordinat.</p>
            </div>
            <div class="flex justify-end space-x-3">
              <a href="kelompok_tani.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    <?php elseif ($action == 'edit' && $group): ?>
      <!-- Form Edit Kelompok Tani -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <form method="post" class="space-y-6">
            <input type="hidden" name="update_group" value="1">
            <input type="hidden" name="group_id" value="<?= $group_id ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Kolom Kiri -->
              <div class="space-y-4">
                <div>
                  <label for="group_name" class="block text-sm font-medium text-gray-700">Nama Kelompok *</label>
                  <input type="text" id="group_name" name="group_name" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="<?= htmlspecialchars($group['group_name']) ?>">
                </div>
                <div>
                  <label for="mentor" class="block text-sm font-medium text-gray-700">Pendamping (ICS)</label>
                  <select id="mentor" name="mentor"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Tidak Ada Pendamping</option>
                    <?php foreach ($dummyMentors as $mentor): ?>
                      <option value="<?= $mentor['id'] ?>" <?= $group['mentor_id'] == $mentor['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($mentor['name']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div>
                  <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                  <select id="status" name="status" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="Active" <?= $group['status'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                    <option value="Inactive" <?= $group['status'] == 'Inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <!-- Kolom Kanan -->
              <div class="space-y-4">
                <div>
                  <label for="area" class="block text-sm font-medium text-gray-700">Area Wilayah *</label>
                  <select id="area" name="area" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Area Wilayah</option>
                    <option value="Wilayah 1" <?= $group['area'] == 'Wilayah 1' ? 'selected' : '' ?>>Wilayah 1</option>
                    <option value="Wilayah 2" <?= $group['area'] == 'Wilayah 2' ? 'selected' : '' ?>>Wilayah 2</option>
                    <option value="Wilayah 3" <?= $group['area'] == 'Wilayah 3' ? 'selected' : '' ?>>Wilayah 3</option>
                  </select>
                </div>
                <div>
                  <label for="coordinates" class="block text-sm font-medium text-gray-700">Lokasi Peta (latlong)</label>
                  <input type="text" id="coordinates" name="coordinates"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="<?= htmlspecialchars($group['coordinates']) ?>">
                  <p class="mt-1 text-sm text-gray-500">Format: latitude, longitude</p>
                </div>
                <div>
                  <label for="total_members" class="block text-sm font-medium text-gray-700">Jumlah Anggota *</label>
                  <input type="number" id="total_members" name="total_members" min="1" required
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    value="<?= htmlspecialchars($group['total_members']) ?>">
                </div>
              </div>
            </div>
            <!-- Peta Interaktif -->
            <div class="mt-4">
              <h5 class="text-sm font-medium text-gray-700 mb-2">Lokasi di Peta</h5>
              <div id="map" class="w-full h-64 border rounded-lg" style="background-color: #f0f0f0;">
                <iframe width="100%" height="100%" style="border:0; border-radius: 0.5rem;"
                  src="https://maps.google.com/maps?q=<?= $group['coordinates'] ?>&z=15&output=embed"
                  frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="flex justify-end space-x-3">
              <a href="kelompok_tani.php?action=view&id=<?= $group_id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    <?php elseif ($action == 'view' && $group): ?>
      <!-- Tampilan Detail Kelompok Tani -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
          <h3 class="text-lg font-medium text-gray-900">Detail Kelompok Tani</h3>
          <div class="flex space-x-2">
            <a href="kelompok_tani.php?action=edit&id=<?= $group_id ?>" class="text-blue-600 hover:text-blue-800 text-sm">
              <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <a href="#" onclick="confirmDelete('<?= $group_id ?>')" class="text-red-600 hover:text-red-800 text-sm">
              <i class="fas fa-trash-alt mr-1"></i> Hapus
            </a>
          </div>
        </div>
        <div class="p-6">
          <!-- Informasi Utama -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div>
              <h4 class="text-md font-semibold text-gray-700 mb-2">Informasi Dasar</h4>
              <div class="space-y-2">
                <p class="text-sm"><span class="font-medium">Nama Kelompok:</span> <?= htmlspecialchars($group['group_name']) ?></p>
                <p class="text-sm"><span class="font-medium">Area Wilayah:</span> <?= htmlspecialchars($group['area']) ?></p>
                <p class="text-sm"><span class="font-medium">Pendamping:</span> <?= htmlspecialchars($group['mentor'] ?? 'Tidak Ada') ?></p>
                <p class="text-sm"><span class="font-medium">Status:</span>
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $group['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <?= $group['status'] == 'Active' ? 'Aktif' : 'Tidak Aktif' ?>
                  </span>
                </p>
              </div>
            </div>
            <div>
              <h4 class="text-md font-semibold text-gray-700 mb-2">Statistik</h4>
              <div class="space-y-2">
                <p class="text-sm"><span class="font-medium">Tanggal Dibentuk:</span> <?= date('d/m/Y', strtotime($group['created_date'])) ?></p>
                <p class="text-sm"><span class="font-medium">Jumlah Anggota:</span> <?= htmlspecialchars($group['total_members']) ?> orang</p>
                <p class="text-sm"><span class="font-medium">Total Aktivitas:</span> <?= count(array_filter($dummyActivities, function ($a) use ($group_id) {
                                                                                        return $a['group_id'] == $group_id;
                                                                                      })) ?> kegiatan</p>
              </div>
            </div>
            <div>
              <h4 class="text-md font-semibold text-gray-700 mb-2">Lokasi</h4>
              <div class="h-48 bg-gray-100 rounded-lg overflow-hidden">
                <iframe width="100%" height="100%" frameborder="0" style="border:0; border-radius: 0.5rem;"
                  src="https://maps.google.com/maps?q=<?= urlencode($group['coordinates']) ?>&z=15&output=embed"
                  allowfullscreen></iframe>
              </div>
              <p class="mt-2 text-xs text-gray-500 text-center">Koordinat: <?= htmlspecialchars($group['coordinates']) ?></p>
            </div>
          </div>

          <!-- Tab Aktivitas dan Anggota -->
          <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
              <button data-tab="aktivitas" class="tab-button py-3 px-4 text-center border-b-2 font-medium text-sm border-[#f0ab00] text-[#f0ab00]">
                Aktivitas Kelompok
              </button>
              <button data-tab="anggota" class="tab-button py-3 px-4 text-center border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Daftar Anggota
              </button>
            </nav>
          </div>

          <!-- Konten Tab -->
          <div class="mt-4">
            <!-- Tab Aktivitas -->
            <div id="aktivitas-content" class="tab-content active">
              <div class="flex justify-between items-center mb-4">
                <h4 class="text-md font-semibold text-gray-700">Daftar Aktivitas</h4>
                <a href="kelompok_tani.php?action=add_activity&group_id=<?= $group_id ?>" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-3 py-1 rounded-lg text-sm flex items-center">
                  <i class="fas fa-plus mr-1"></i> Tambah
                </a>
              </div>
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kegiatan</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ringkasan</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php $groupActivities = array_filter($dummyActivities, fn($a) => $a['group_id'] == $group_id); ?>
                    <?php if (empty($groupActivities)): ?>
                      <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada aktivitas</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($groupActivities as $a): ?>
                        <tr>
                          <td class="px-4 py-4"><?= htmlspecialchars($a['activity_type']) ?></td>
                          <td class="px-4 py-4"><?= date('d/m/Y', strtotime($a['date'])) ?></td>
                          <td class="px-4 py-4"><?= htmlspecialchars($a['summary']) ?></td>
                          <td class="px-4 py-4 text-sm">
                            <a href="kelompok_tani.php?action=edit_activity&id=<?= $a['activity_id'] ?>" class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <a href="#" onclick="confirmDeleteActivity('<?= $a['activity_id'] ?>')" class="text-red-600"><i class="fas fa-trash-alt"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Tab Anggota -->
            <div id="anggota-content" class="tab-content hidden">
              <div class="flex justify-between items-center mb-4">
                <h4 class="text-md font-semibold text-gray-700">Daftar Anggota</h4>
                <a href="kelompok_tani.php?action=add_member&group_id=<?= $group_id ?>" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-3 py-1 rounded-lg text-sm flex items-center">
                  <i class="fas fa-plus mr-1"></i> Tambah
                </a>
              </div>
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Plot</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                      <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php $groupMembers = array_filter($dummyMembers, fn($m) => $m['group_id'] == $group_id); ?>
                    <?php if (empty($groupMembers)): ?>
                      <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada anggota</td>
                      </tr>
                    <?php else: ?>
                      <?php foreach ($groupMembers as $idx => $m): ?>
                        <tr>
                          <td class="px-4 py-4"><?= $idx + 1 ?></td>
                          <td class="px-4 py-4"><?= htmlspecialchars($m['name']) ?></td>
                          <td class="px-4 py-4"><?= htmlspecialchars($m['plot']) ?></td>
                          <td class="px-4 py-4">
                            <span class="px-2 text-xs font-semibold rounded-full <?= $m['status'] == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                              <?= $m['status'] ?>
                            </span>
                          </td>
                          <td class="px-4 py-4 text-sm">
                            <a href="kelompok_tani.php?action=edit_member&id=<?= $m['member_id'] ?>" class="text-blue-600 mr-3"><i class="fas fa-edit"></i></a>
                            <a href="#" onclick="confirmDeleteMember('<?= $m['member_id'] ?>')" class="text-red-600"><i class="fas fa-trash-alt"></i></a>
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
      </div>
    <?php elseif ($action == 'add_activity' || ($action == 'edit_activity' && $activity)): ?>
      <!-- Form Tambah/Edit Aktivitas -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <form method="post" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="<?= $action == 'add_activity' ? 'add_activity' : 'update_activity' ?>" value="1">
            <input type="hidden" name="group_id" value="<?= isset($_GET['group_id']) ? $_GET['group_id'] : ($activity ? $activity['group_id'] : '') ?>">
            <?php if ($action == 'edit_activity'): ?>
              <input type="hidden" name="activity_id" value="<?= $activity_id ?>">
            <?php endif; ?>
            <div class="space-y-4">
              <div>
                <label for="activity_type" class="block text-sm font-medium text-gray-700">Jenis Kegiatan *</label>
                <select id="activity_type" name="activity_type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Pilih Jenis Kegiatan</option>
                  <option value="Pelatihan SOP" <?= ($activity && $activity['activity_type'] == 'Pelatihan SOP') ? 'selected' : '' ?>>Pelatihan SOP</option>
                  <option value="Pemupukan Bersama" <?= ($activity && $activity['activity_type'] == 'Pemupukan Bersama') ? 'selected' : '' ?>>Pemupukan Bersama</option>
                  <option value="Panen Bersama" <?= ($activity && $activity['activity_type'] == 'Panen Bersama') ? 'selected' : '' ?>>Panen Bersama</option>
                  <option value="Pertemuan Rutin" <?= ($activity && $activity['activity_type'] == 'Pertemuan Rutin') ? 'selected' : '' ?>>Pertemuan Rutin</option>
                </select>
              </div>
              <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal *</label>
                <input type="date" id="date" name="date" required
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  value="<?= $activity ? htmlspecialchars($activity['date']) : '' ?>">
              </div>
              <div>
                <label for="summary" class="block text-sm font-medium text-gray-700">Ringkasan Laporan *</label>
                <textarea id="summary" name="summary" rows="3" required
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $activity ? htmlspecialchars($activity['summary']) : '' ?></textarea>
              </div>
              <div>
                <label for="documentation" class="block text-sm font-medium text-gray-700">Upload Dokumentasi</label>
                <input type="file" id="documentation" name="documentation" accept="image/*,.pdf"
                  class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <?php if ($activity && !empty($activity['documentation'])): ?>
                  <p class="mt-2 text-sm text-gray-600">
                    Dokumen saat ini: <?= htmlspecialchars($activity['documentation']) ?>
                    <a href="#" class="text-blue-600 hover:text-blue-800 ml-2">Lihat</a>
                  </p>
                <?php endif; ?>
                <p class="mt-1 text-sm text-gray-500">Format: gambar (JPG, PNG) atau PDF, maksimal 5MB</p>
              </div>
            </div>
            <div class="flex justify-end space-x-3">
              <a href="<?= getBackUrl($action, $group_id, $activity_id, $member_id) ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    <?php elseif ($action == 'add_member' || ($action == 'edit_member' && $member)): ?>
      <!-- Form Tambah/Edit Anggota -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <form method="post" class="space-y-6">
            <input type="hidden" name="<?= $action == 'add_member' ? 'add_member' : 'update_member' ?>" value="1">
            <input type="hidden" name="group_id" value="<?= isset($_GET['group_id']) ? $_GET['group_id'] : ($member ? $member['group_id'] : '') ?>">
            <?php if ($action == 'edit_member'): ?>
              <input type="hidden" name="member_id" value="<?= $member_id ?>">
            <?php endif; ?>
            <div class="space-y-4">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Anggota *</label>
                <input type="text" id="name" name="name" required
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  value="<?= $member ? htmlspecialchars($member['name']) : '' ?>"
                  placeholder="Masukkan nama anggota">
              </div>
              <div>
                <label for="plot" class="block text-sm font-medium text-gray-700">Plot Kebun *</label>
                <input type="text" id="plot" name="plot" required
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  value="<?= $member ? htmlspecialchars($member['plot']) : '' ?>"
                  placeholder="Masukkan plot kebun">
              </div>
              <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                <select id="status" name="status" required
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                  <option value="Aktif" <?= ($member && $member['status'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                  <option value="Tidak Aktif" <?= ($member && $member['status'] == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
              </div>
            </div>
            <div class="flex justify-end space-x-3">
              <a href="<?= getBackUrl($action, $group_id, $activity_id, $member_id) ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    <?php else: ?>
      <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Data Kelompok Tani</h2>
        <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
      </div>
    <?php endif; ?>
  </section>
</main>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 w-96 shadow-xl">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Konfirmasi Hapus</h3>
    <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kelompok ini? Aksi ini tidak dapat dibatalkan.</p>
    <div class="flex justify-end space-x-3">
      <button onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-100">
        Batal
      </button>
      <a id="confirmDeleteBtn" href="#" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
        Hapus
      </a>
    </div>
  </div>
</div>

<script>
  // Tab functionality
  document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', function() {
      const tabId = this.getAttribute('data-tab');
      document.querySelectorAll('.tab-button').forEach(t => {
        t.classList.remove('border-[#f0ab00]', 'text-[#f0ab00]');
        t.classList.add('border-transparent', 'text-gray-500');
      });
      this.classList.add('border-[#f0ab00]', 'text-[#f0ab00]');
      document.querySelectorAll('.tab-content').forEach(c => {
        c.classList.remove('active');
        c.classList.add('hidden');
      });
      document.getElementById(tabId + '-content').classList.remove('hidden');
      document.getElementById(tabId + '-content').classList.add('active');
    });
  });

  // Delete confirmation with modal
  function confirmDelete(id) {
    document.getElementById('confirmDeleteBtn').href = 'kelompok_tani.php?action=delete&id=' + id;
    document.getElementById('deleteModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
  }

  // Close modal on click outside
  window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
      closeModal();
    }
  }
</script>

<?php
function getBackUrl($action, $group_id, $activity_id, $member_id)
{
  switch ($action) {
    case 'edit':
    case 'view':
      return 'kelompok_tani.php?action=view&id=' . $group_id;
    case 'edit_activity':
      return 'kelompok_tani.php?action=view&id=' . $group_id;
    case 'edit_member':
      return 'kelompok_tani.php?action=view&id=' . $group_id;
    case 'add_activity':
      return 'kelompok_tani.php?action=view&id=' . $group_id;
    case 'add_member':
      return 'kelompok_tani.php?action=view&id=' . $group_id;
    default:
      return 'kelompok_tani.php';
  }
}
include 'footer.php';
?>