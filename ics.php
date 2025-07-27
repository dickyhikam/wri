<?php include 'header.php'; ?>
  <!-- Mode untuk menentukan tampilan -->
  <?php
  $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  // Data Dummy ICS
  $data_ics = [
    'ICS-2023-001' => [
      'nama' => 'Lembaga Sawit Kampar',
      'no_badan_hukum' => '123/KPR/2023',
      'jumlah_petani' => 50,
      'tgl_berdiri' => '2023-01-15',
      'tgl_legalitas' => '2023-02-20',
      'pic' => [
        'nama' => 'Budi Santoso',
        'kontak' => '08123456789',
        'email' => 'budi@sawitkampar.com'
      ],
      'alamat' => 'Jl. Sawit Makmur No. 12, Dusun Sejahtera',
      'provinsi' => 'Riau',
      'kabupaten' => 'Kampar',
      'kecamatan' => 'Bangkinang',
      'desa' => 'Bangkinang Kota',
      'lokasi' => '-0.335987, 101.025543',
      'area_wilayah' => 'Kawasan Perkebunan Sawit Kampar',
      'dokumen' => [
        ['nama' => 'Akta Pendirian', 'file' => 'akta_pendirian.pdf'],
        ['nama' => 'SIUP', 'file' => 'siup.pdf']
      ],
      'logo' => 'https://via.placeholder.com/150',
      'sop' => ['nama' => 'SOP Pengelolaan', 'file' => 'sop_pengelolaan.pdf'],
      'fasilitas' => [
        ['fasilitas' => 'Traktor', 'jumlah' => 2, 'keterangan' => 'Kondisi baik'],
        ['fasilitas' => 'Gudang', 'jumlah' => 1, 'keterangan' => 'Kapasitas 100 ton']
      ],
      'pengurus' => [
        ['nama' => 'Budi Santoso', 'jabatan' => 'Ketua', 'status' => 'Aktif'],
        ['nama' => 'Ani Wijaya', 'jabatan' => 'Bendahara', 'status' => 'Aktif']
      ],
      'status' => 'Aktif',
      'created_by' => 'admin1',
      'created_at' => '2023-01-10',
      'updated_by' => 'admin1',
      'updated_at' => '2023-03-15'
    ],
    'ICS-2023-002' => [
      'nama' => 'Koperasi Rokan Hulu',
      'no_badan_hukum' => '456/RHU/2023',
      'jumlah_petani' => 35,
      'tgl_berdiri' => '2023-03-10',
      'tgl_legalitas' => '2023-04-05',
      'pic' => [
        'nama' => 'Ani Wijaya',
        'kontak' => '08234567890',
        'email' => 'ani@koperasirh.com'
      ],
      'alamat' => 'Jl. Koperasi No. 45, Dusun Makmur',
      'provinsi' => 'Riau',
      'kabupaten' => 'Rokan Hulu',
      'kecamatan' => 'Pasir Pengaraian',
      'desa' => 'Pasir Pengaraian',
      'lokasi' => '0.596672, 100.751798',
      'area_wilayah' => 'Wilayah Rokan Hulu',
      'dokumen' => [
        ['nama' => 'Akta Notaris', 'file' => 'akta_notaris.pdf']
      ],
      'logo' => 'https://via.placeholder.com/150',
      'sop' => ['nama' => 'SOP Koperasi', 'file' => 'sop_koperasi.pdf'],
      'fasilitas' => [
        ['fasilitas' => 'Alat Penyemprot', 'jumlah' => 5, 'keterangan' => 'Kondisi baru']
      ],
      'pengurus' => [
        ['nama' => 'Siti Rahayu', 'jabatan' => 'Sekretaris', 'status' => 'Aktif']
      ],
      'status' => 'Proses Verifikasi',
      'created_by' => 'operator1',
      'created_at' => '2023-03-05',
      'updated_by' => 'operator1',
      'updated_at' => '2023-04-12'
    ]
  ];

  // Data unik untuk filter
  $kabupatens = array_unique(array_column($data_ics, 'kabupaten'));
  $kecamatans = array_unique(array_column($data_ics, 'kecamatan'));
  $statuses = array_unique(array_column($data_ics, 'status'));

  // Initialize filtered data with all data first
  $filtered_ics = $data_ics;
  
  // Get filter parameters
  $filter_kabupaten = isset($_GET['filter_kabupaten']) ? $_GET['filter_kabupaten'] : '';
  $filter_kecamatan = isset($_GET['filter_kecamatan']) ? $_GET['filter_kecamatan'] : '';
  $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  // Apply filters
  if ($filter_kabupaten) {
      $filtered_ics = array_filter($filtered_ics, function($ics) use ($filter_kabupaten) {
          return $ics['kabupaten'] == $filter_kabupaten;
      });
  }

  if ($filter_kecamatan) {
      $filtered_ics = array_filter($filtered_ics, function($ics) use ($filter_kecamatan) {
          return $ics['kecamatan'] == $filter_kecamatan;
      });
  }

  if ($filter_status) {
      $filtered_ics = array_filter($filtered_ics, function($ics) use ($filter_status) {
          return $ics['status'] == $filter_status;
      });
  }

  if ($search) {
      $search = strtolower($search);
      $filtered_ics = array_filter($filtered_ics, function($ics) use ($search) {
          return (strpos(strtolower($ics['nama']), $search) !== false || 
                 strpos(strtolower($ics['pic']['nama']), $search) !== false ||
                 strpos(strtolower($ics['pic']['kontak']), $search) !== false);
      });
  }

  // Konfigurasi Pagination
  $itemsPerPage = 5;
  $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
  $totalItems = count($filtered_ics);
  $totalPages = ceil($totalItems / $itemsPerPage);
  $currentPage = min($currentPage, $totalPages);
  $startIndex = ($currentPage - 1) * $itemsPerPage;
  $paginatedICS = array_slice($filtered_ics, $startIndex, $itemsPerPage, true);
  ?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php if ($mode === 'list'): ?>
                    Manajemen ICS
                <?php elseif ($mode === 'add'): ?>
                    Tambah ICS Baru
                <?php elseif ($mode === 'view'): ?>
                    Detail ICS
                <?php elseif ($mode === 'edit'): ?>
                    Edit Data ICS
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($mode === 'list'): ?>
                <!-- Tombol Tambah Data -->
                <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah ICS
                </a>
            <?php elseif ($mode === 'view'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <!-- Tombol Edit -->
                <a href="?mode=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
            <?php elseif ($mode === 'edit' || $mode === 'add'): ?>
                <!-- Tombol Kembali ke Daftar -->
                <a href="?mode=list" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($mode === 'list'): ?>
            <!-- Halaman Daftar ICS -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="space-y-4">
                        <input type="hidden" name="mode" value="list">
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="Cari data ICS...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Filter Kabupaten -->
                            <div>
                                <select id="filter_kabupaten" name="filter_kabupaten" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kabupaten</option>
                                    <?php foreach($kabupatens as $kabupaten): ?>
                                        <option value="<?= htmlspecialchars($kabupaten) ?>" <?= $filter_kabupaten === $kabupaten ? 'selected' : '' ?>><?= htmlspecialchars($kabupaten) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Filter Kecamatan -->
                            <div>
                                <select id="filter_kecamatan" name="filter_kecamatan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kecamatan</option>
                                    <?php foreach($kecamatans as $kecamatan): ?>
                                        <option value="<?= htmlspecialchars($kecamatan) ?>" <?= $filter_kecamatan === $kecamatan ? 'selected' : '' ?>><?= htmlspecialchars($kecamatan) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Filter Status -->
                            <div>
                                <select id="filter_status" name="filter_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <?php foreach($statuses as $status): ?>
                                        <option value="<?= htmlspecialchars($status) ?>" <?= $filter_status === $status ? 'selected' : '' ?>><?= htmlspecialchars($status) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3">
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID ICS</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama ICS</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PIC</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($paginatedICS)): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data ICS</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedICS as $id_ics => $ics): 
                                    $rowNumber = $startIndex + array_search($id_ics, array_keys($filtered_ics)) + 1;
                                ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $id_ics ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $ics['nama'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div><?= $ics['pic']['nama'] ?></div>
                                            <div class="text-xs text-gray-500"><?= $ics['pic']['kontak'] ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $ics['jumlah_petani'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                <?= $ics['kabupaten'] ?>, <?= $ics['provinsi'] ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($ics['status'] === 'Aktif'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                            <?php elseif ($ics['status'] === 'Proses Verifikasi'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses Verifikasi</span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="?mode=view&id=<?= $id_ics ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                                            <a href="?mode=edit&id=<?= $id_ics ?>" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                                            <button onclick="confirmDelete('<?= $id_ics ?>')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Controls -->
                <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium"><?= $startIndex + 1 ?></span> sampai <span class="font-medium"><?= min($startIndex + $itemsPerPage, $totalItems) ?></span> dari <span class="font-medium"><?= $totalItems ?></span> hasil
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <!-- Previous Page Link -->
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                                <!-- Page Numbers -->
                                <?php 
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                                
                                if ($currentPage <= 3) {
                                    $endPage = min(5, $totalPages);
                                }
                                
                                if ($currentPage >= $totalPages - 2) {
                                    $startPage = max(1, $totalPages - 4);
                                }
                                
                                if ($startPage > 1) {
                                    ?>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        1
                                    </a>
                                    <?php if ($startPage > 2): ?>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                    <?php endif; ?>
                                    <?php
                                }
                                
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    ?>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium <?= $i == $currentPage ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' ?>">
                                        <?= $i ?>
                                    </a>
                                    <?php
                                }
                                
                                if ($endPage < $totalPages) {
                                    ?>
                                    <?php if ($endPage < $totalPages - 1): ?>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                    <?php endif; ?>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <?= $totalPages ?>
                                    </a>
                                    <?php
                                }
                                ?>

                                <!-- Next Page Link -->
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($mode === 'add'): ?>
            <!-- Form Tambah ICS -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah ICS Baru</h2>
                    <form id="addForm" action="?mode=list" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="nama_ics" class="block text-sm font-medium text-gray-700 mb-1">Nama ICS*</label>
                                    <input type="text" id="nama_ics" name="nama_ics" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Lembaga Sawit Makmur" required>
                                </div>
                                <div class="mb-4">
                                    <label for="no_badan_hukum" class="block text-sm font-medium text-gray-700 mb-1">No. Badan Hukum</label>
                                    <input type="text" id="no_badan_hukum" name="no_badan_hukum" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 123/XYZ/2023">
                                </div>
                                <div class="mb-4">
                                    <label for="jumlah_petani" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Petani*</label>
                                    <input type="number" id="jumlah_petani" name="jumlah_petani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 50" required>
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_berdiri" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berdiri</label>
                                    <input type="date" id="tgl_berdiri" name="tgl_berdiri" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_legalitas" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Legalitas</label>
                                    <input type="date" id="tgl_legalitas" name="tgl_legalitas" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <h3 class="text-md font-medium text-gray-700 border-b pb-2 mb-4">Informasi PIC</h3>
                                <div class="mb-4">
                                    <label for="nama_pic" class="block text-sm font-medium text-gray-700 mb-1">Nama PIC*</label>
                                    <input type="text" id="nama_pic" name="nama_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Budi Santoso" required>
                                </div>
                                <div class="mb-4">
                                    <label for="kontak_pic" class="block text-sm font-medium text-gray-700 mb-1">Kontak PIC*</label>
                                    <input type="text" id="kontak_pic" name="kontak_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 08123456789" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email_pic" class="block text-sm font-medium text-gray-700 mb-1">Email PIC*</label>
                                    <input type="email" id="email_pic" name="email_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: pic@example.com" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi*</label>
                                    <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Proses Verifikasi">Proses Verifikasi</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen & Logo & SOP -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen & Logo & SOP</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Legalitas (Maks. 10 file)</label>
                                    <div class="flex items-center">
                                        <input type="file" multiple class="hidden" id="file-upload">
                                        <label for="file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-upload mr-2"></i>Unggah Dokumen
                                        </label>
                                        <span class="ml-2 text-sm text-gray-500">PDF, JPG, PNG (Maks. 5MB/file)</span>
                                    </div>
                                    <div id="file-list" class="mt-2 space-y-2"></div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                                    <div class="flex items-center">
                                        <input type="file" accept="image/*" class="hidden" id="logo-upload">
                                        <label for="logo-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-image mr-2"></i>Unggah Logo
                                        </label>
                                        <span class="ml-2 text-sm text-gray-500">JPG, PNG (Maks. 2MB)</span>
                                    </div>
                                    <div id="logo-preview" class="mt-2"></div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SOP</label>
                                    <div class="flex items-center">
                                        <input type="file" class="hidden" id="sop-upload" accept=".pdf,.doc,.docx">
                                        <label for="sop-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-file-alt mr-2"></i>Unggah SOP
                                        </label>
                                        <span class="ml-2 text-sm text-gray-500">PDF, DOC (Maks. 5MB)</span>
                                    </div>
                                    <div id="sop-preview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Alamat & Lokasi -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat & Lokasi</h3>
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat (Jalan/Dusun)*</label>
                                <input type="text" id="alamat" name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jl. Sawit Makmur No. 12, Dusun Sejahtera" required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                        <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Riau" readonly>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten*</label>
                                        <select id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kabupaten</option>
                                            <option value="Kampar">Kampar</option>
                                            <option value="Rokan Hulu">Rokan Hulu</option>
                                            <option value="Indragiri Hulu">Indragiri Hulu</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="mb-4">
                                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
                                        <select id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa*</label>
                                        <select id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Desa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
                                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Koordinat)</label>
                                    <input type="text" id="lokasi" name="lokasi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: -6.175392, 106.827153">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="area_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Area Wilayah</label>
                                    <input type="text" id="area_wilayah" name="area_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kawasan Perkebunan Sawit">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fasilitas -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Fasilitas</h3>
                                <button type="button" onclick="tambahFasilitas()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah Fasilitas
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="fasilitas-list">
                                        <!-- Data fasilitas akan diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Pengurus -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Pengurus ICS</h3>
                                <button type="button" onclick="tambahPengurus()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah Pengurus
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="pengurus-list">
                                        <!-- Data pengurus akan diisi oleh JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="window.location.href='?mode=list'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                Simpan Data ICS
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($mode === 'view' && isset($id) && isset($data_ics[$id])): ?>
            <!-- Halaman Detail ICS -->
            <?php $ics = $data_ics[$id]; ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800"><?= $ics['nama'] ?></h2>
                            <p class="text-gray-600">ID ICS: <?= $id ?></p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-medium <?= $ics['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : ($ics['status'] === 'Proses Verifikasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') ?>">
                            <?= $ics['status'] ?>
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Dasar</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">No. Badan Hukum:</span>
                                    <p class="text-sm font-medium"><?= $ics['no_badan_hukum'] ?: '-' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Jumlah Petani:</span>
                                    <p class="text-sm font-medium"><?= $ics['jumlah_petani'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Berdiri:</span>
                                    <p class="text-sm font-medium"><?= $ics['tgl_berdiri'] ? date('d F Y', strtotime($ics['tgl_berdiri'])) : '-' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Legalitas:</span>
                                    <p class="text-sm font-medium"><?= $ics['tgl_legalitas'] ? date('d F Y', strtotime($ics['tgl_legalitas'])) : '-' ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi PIC</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Nama PIC:</span>
                                    <p class="text-sm font-medium"><?= $ics['pic']['nama'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Kontak PIC:</span>
                                    <p class="text-sm font-medium"><?= $ics['pic']['kontak'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Email PIC:</span>
                                    <p class="text-sm font-medium"><?= $ics['pic']['email'] ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Administratif</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Dibuat Oleh:</span>
                                    <p class="text-sm font-medium"><?= $ics['created_by'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Tanggal Dibuat:</span>
                                    <p class="text-sm font-medium"><?= date('d F Y', strtotime($ics['created_at'])) ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Diperbarui Oleh:</span>
                                    <p class="text-sm font-medium"><?= $ics['updated_by'] ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Terakhir Diperbarui:</span>
                                    <p class="text-sm font-medium"><?= date('d F Y', strtotime($ics['updated_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Alamat Lengkap</h3>
                            <div class="space-y-2">
                                <p class="text-sm font-medium"><?= $ics['alamat'] ?></p>
                                <div class="grid grid-cols-2 gap-4 mt-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Provinsi</span>
                                        <p class="text-sm"><?= $ics['provinsi'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Kabupaten</span>
                                        <p class="text-sm"><?= $ics['kabupaten'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Kecamatan</span>
                                        <p class="text-sm"><?= $ics['kecamatan'] ?></p>
                                    </div>
                                    <div>
                                        <span class="text-xs text-gray-500">Desa</span>
                                        <p class="text-sm"><?= $ics['desa'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Lokasi & Area</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Lokasi Koordinat:</span>
                                    <p class="text-sm font-medium"><?= $ics['lokasi'] ?: '-' ?></p>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Area Wilayah:</span>
                                    <p class="text-sm font-medium"><?= $ics['area_wilayah'] ?: '-' ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Dokumen & Logo</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-500">Dokumen Legalitas:</span>
                                    <div class="space-y-1 mt-1">
                                        <?php if (!empty($ics['dokumen'])): ?>
                                            <?php foreach ($ics['dokumen'] as $doc): ?>
                                                <div class="flex items-center">
                                                    <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                                    <a href="#" class="text-blue-600 hover:underline text-sm"><?= $doc['nama'] ?></a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-sm text-gray-500">Tidak ada dokumen</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Logo:</span>
                                    <div class="mt-1">
                                        <?php if ($ics['logo']): ?>
                                            <img src="<?= $ics['logo'] ?>" alt="Logo ICS" class="h-20 rounded-lg border border-gray-200">
                                        <?php else: ?>
                                            <p class="text-sm text-gray-500">Tidak ada logo</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">SOP:</span>
                                    <div class="mt-1">
                                        <?php if (!empty($ics['sop'])): ?>
                                            <div class="flex items-center">
                                                <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                                                <a href="#" class="text-blue-600 hover:underline text-sm"><?= $ics['sop']['nama'] ?></a>
                                            </div>
                                        <?php else: ?>
                                            <p class="text-sm text-gray-500">Tidak ada SOP</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Fasilitas</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($ics['fasilitas'])): ?>
                                        <?php foreach ($ics['fasilitas'] as $index => $fasilitas): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['fasilitas'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['jumlah'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['keterangan'] ?: '-' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada fasilitas</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Pengurus -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-8">
                        <h3 class="font-medium text-gray-900 mb-2">Pengurus ICS</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if (!empty($ics['pengurus'])): ?>
                                        <?php foreach ($ics['pengurus'] as $index => $pengurus): ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengurus['nama'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengurus['jabatan'] ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $pengurus['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                        <?= $pengurus['status'] ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengurus</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-6">
                        <a href="?mode=list" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        <?php elseif ($mode === 'edit' && isset($id) && isset($data_ics[$id])): ?>
            <!-- Form Edit ICS -->
            <?php $ics = $data_ics[$id]; ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data ICS</h2>
                    <form id="editForm" action="?mode=view&id=<?= $id ?>" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <label for="nama_ics" class="block text-sm font-medium text-gray-700 mb-1">Nama ICS*</label>
                                    <input type="text" id="nama_ics" name="nama_ics" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['nama'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="no_badan_hukum" class="block text-sm font-medium text-gray-700 mb-1">No. Badan Hukum</label>
                                    <input type="text" id="no_badan_hukum" name="no_badan_hukum" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['no_badan_hukum'] ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="jumlah_petani" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Petani*</label>
                                    <input type="number" id="jumlah_petani" name="jumlah_petani" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['jumlah_petani'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_berdiri" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berdiri</label>
                                    <input type="date" id="tgl_berdiri" name="tgl_berdiri" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['tgl_berdiri'] ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="tgl_legalitas" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Legalitas</label>
                                    <input type="date" id="tgl_legalitas" name="tgl_legalitas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['tgl_legalitas'] ?>">
                                </div>
                            </div>
                            <div>
                                <h3 class="text-md font-medium text-gray-700 border-b pb-2 mb-4">Informasi PIC</h3>
                                <div class="mb-4">
                                    <label for="nama_pic" class="block text-sm font-medium text-gray-700 mb-1">Nama PIC*</label>
                                    <input type="text" id="nama_pic" name="nama_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['pic']['nama'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="kontak_pic" class="block text-sm font-medium text-gray-700 mb-1">Kontak PIC*</label>
                                    <input type="text" id="kontak_pic" name="kontak_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['pic']['kontak'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email_pic" class="block text-sm font-medium text-gray-700 mb-1">Email PIC*</label>
                                    <input type="email" id="email_pic" name="email_pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['pic']['email'] ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi*</label>
                                    <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                        <option value="Aktif" <?= $ics['status'] === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="Proses Verifikasi" <?= $ics['status'] === 'Proses Verifikasi' ? 'selected' : '' ?>>Proses Verifikasi</option>
                                        <option value="Nonaktif" <?= $ics['status'] === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen & Logo & SOP -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen & Logo & SOP</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Legalitas</label>
                                    <div class="flex items-center">
                                        <input type="file" multiple class="hidden" id="file-upload">
                                        <label for="file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-upload mr-2"></i>Unggah Dokumen
                                        </label>
                                    </div>
                                    <div id="file-list" class="mt-2 space-y-2">
                                        <?php if (!empty($ics['dokumen'])): ?>
                                            <?php foreach ($ics['dokumen'] as $doc): ?>
                                                <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                                        <span class="text-sm"><?= $doc['nama'] ?></span>
                                                    </div>
                                                    <button type="button" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                                    <div class="flex items-center">
                                        <input type="file" accept="image/*" class="hidden" id="logo-upload">
                                        <label for="logo-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-image mr-2"></i>Unggah Logo
                                        </label>
                                    </div>
                                    <div id="logo-preview" class="mt-2">
                                        <?php if ($ics['logo']): ?>
                                            <div class="relative">
                                                <img src="<?= $ics['logo'] ?>" alt="Logo Preview" class="h-32 rounded-lg border border-gray-200">
                                                <button type="button" onclick="removeLogo()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transform translate-x-1 -translate-y-1">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SOP</label>
                                    <div class="flex items-center">
                                        <input type="file" class="hidden" id="sop-upload" accept=".pdf,.doc,.docx">
                                        <label for="sop-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                                            <i class="fas fa-file-alt mr-2"></i>Unggah SOP
                                        </label>
                                    </div>
                                    <div id="sop-preview" class="mt-2">
                                        <?php if (!empty($ics['sop'])): ?>
                                            <div class="flex items-center justify-between bg-gray-50 p-2 rounded-lg">
                                                <div class="flex items-center">
                                                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                                                    <span class="text-sm"><?= $ics['sop']['nama'] ?></span>
                                                </div>
                                                <button type="button" class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Alamat & Lokasi -->
                        <div class="mt-6 border-t pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat & Lokasi</h3>
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat (Jalan/Dusun)*</label>
                                <input type="text" id="alamat" name="alamat" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['alamat'] ?>" required>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <div class="mb-4">
                                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
                                        <input type="text" id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['provinsi'] ?>" readonly>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kabupaten*</label>
                                        <select id="kabupaten" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kabupaten</option>
                                            <option value="Kampar" <?= $ics['kabupaten'] === 'Kampar' ? 'selected' : '' ?>>Kampar</option>
                                            <option value="Rokan Hulu" <?= $ics['kabupaten'] === 'Rokan Hulu' ? 'selected' : '' ?>>Rokan Hulu</option>
                                            <option value="Indragiri Hulu" <?= $ics['kabupaten'] === 'Indragiri Hulu' ? 'selected' : '' ?>>Indragiri Hulu</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="mb-4">
                                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
                                        <select id="kecamatan" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Kecamatan</option>
                                            <?php 
                                            // Kecamatan berdasarkan kabupaten
                                            $kecamatan_options = [];
                                            if ($ics['kabupaten'] === 'Kampar') {
                                                $kecamatan_options = ['Bangkinang', 'Kampar', 'Tapung'];
                                            } elseif ($ics['kabupaten'] === 'Rokan Hulu') {
                                                $kecamatan_options = ['Pasir Pengaraian', 'Rambah', 'Kunto Darussalam'];
                                            } elseif ($ics['kabupaten'] === 'Indragiri Hulu') {
                                                $kecamatan_options = ['Rengat', 'Kelayang', 'Siberida'];
                                            }
                                            
                                            foreach ($kecamatan_options as $kec): ?>
                                                <option value="<?= $kec ?>" <?= $ics['kecamatan'] === $kec ? 'selected' : '' ?>><?= $kec ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="desa" class="block text-sm font-medium text-gray-700 mb-1">Desa*</label>
                                        <select id="desa" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                            <option value="">Pilih Desa</option>
                                            <?php 
                                            // Desa berdasarkan kecamatan
                                            $desa_options = [];
                                            if ($ics['kecamatan'] === 'Bangkinang') {
                                                $desa_options = ['Bangkinang Kota', 'Pulau Lawas'];
                                            } elseif ($ics['kecamatan'] === 'Pasir Pengaraian') {
                                                $desa_options = ['Pasir Pengaraian', 'Rambah'];
                                            } elseif ($ics['kecamatan'] === 'Rengat') {
                                                $desa_options = ['Rengat', 'Pematang Reba'];
                                            }
                                            
                                            foreach ($desa_options as $desa): ?>
                                                <option value="<?= $desa ?>" <?= $ics['desa'] === $desa ? 'selected' : '' ?>><?= $desa ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-4">
                                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Koordinat)</label>
                                    <input type="text" id="lokasi" name="lokasi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['lokasi'] ?>">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="area_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Area Wilayah</label>
                                    <input type="text" id="area_wilayah" name="area_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="<?= $ics['area_wilayah'] ?>">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fasilitas -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Fasilitas</h3>
                                <button type="button" onclick="tambahFasilitas()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah Fasilitas
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="fasilitas-list">
                                        <?php if (!empty($ics['fasilitas'])): ?>
                                            <?php foreach ($ics['fasilitas'] as $index => $fasilitas): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['fasilitas'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['jumlah'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $fasilitas['keterangan'] ?: '-' ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button type="button" onclick="editFasilitas(<?= $index ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                                                        <button type="button" onclick="hapusFasilitas(<?= $index ?>)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada fasilitas</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Pengurus -->
                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Pengurus ICS</h3>
                                <button type="button" onclick="tambahPengurus()" class="text-sm bg-[#F0AB00] hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">
                                    <i class="fas fa-plus mr-1"></i>Tambah Pengurus
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="pengurus-list">
                                        <?php if (!empty($ics['pengurus'])): ?>
                                            <?php foreach ($ics['pengurus'] as $index => $pengurus): ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $index + 1 ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengurus['nama'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $pengurus['jabatan'] ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $pengurus['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                            <?= $pengurus['status'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <button type="button" onclick="editPengurus(<?= $index ?>)" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                                                        <button type="button" onclick="hapusPengurus(<?= $index ?>)" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengurus</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="window.location.href='?mode=view&id=<?= $id ?>'" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Halaman Default (Jika mode tidak dikenali) -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Data ICS</h2>
                    <p class="text-gray-600">Silakan pilih menu yang tersedia.</p>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<!-- Modal Konfirmasi Hapus -->
<div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
            <button onclick="hideDeleteModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="mb-6">Yakin ingin menghapus ICS ini? Data tidak bisa dikembalikan.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="hideDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                Batal
            </button>
            <button onclick="proceedDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<!-- Modal Fasilitas -->
<div id="fasilitas-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="fasilitas-modal-title">Tambah Fasilitas</h3>
            <button onclick="hideFasilitasModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="fasilitas-form">
            <input type="hidden" id="fasilitas-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas*</label>
                    <input type="text" id="fasilitas-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Traktor" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah*</label>
                    <input type="number" id="fasilitas-jumlah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea id="fasilitas-keterangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kondisi baik"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hideFasilitasModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pengurus -->
<div id="pengurus-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold" id="pengurus-modal-title">Tambah Pengurus</h3>
            <button onclick="hidePengurusModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="pengurus-form">
            <input type="hidden" id="pengurus-id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama*</label>
                    <input type="text" id="pengurus-nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Budi Santoso" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan*</label>
                    <input type="text" id="pengurus-jabatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Ketua" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                    <select id="pengurus-status" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="hidePengurusModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Data untuk wilayah
    const wilayahData = {
        kabupaten: ['Kampar', 'Rokan Hulu', 'Indragiri Hulu'],
        kecamatan: {
            'Kampar': ['Bangkinang', 'Kampar', 'Tapung'],
            'Rokan Hulu': ['Pasir Pengaraian', 'Rambah', 'Kunto Darussalam'],
            'Indragiri Hulu': ['Rengat', 'Kelayang', 'Siberida']
        },
        desa: {
            'Bangkinang': ['Bangkinang Kota', 'Pulau Lawas'],
            'Kampar': ['Kampar', 'Muara Takus'],
            'Tapung': ['Tapung Hilir', 'Tapung Hulu'],
            'Pasir Pengaraian': ['Pasir Pengaraian', 'Rambah'],
            'Rambah': ['Rambah Hilir', 'Rambah Samo'],
            'Kunto Darussalam': ['Kunto Darussalam', 'Sedinginan'],
            'Rengat': ['Rengat', 'Pematang Reba'],
            'Kelayang': ['Kelayang', 'Sei Pasir Putih'],
            'Siberida': ['Siberida', 'Petalongan']
        }
    };

    // Variabel untuk menyimpan data sementara
    let currentFasilitas = [];
    let currentPengurus = [];
    let currentEditingFasilitasId = null;
    let currentEditingPengurusId = null;
    let icsToDelete = null;

    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi form fasilitas
        document.getElementById('fasilitas-form').addEventListener('submit', function(e) {
            e.preventDefault();
            saveFasilitas();
        });
        
        // Inisialisasi form pengurus
        document.getElementById('pengurus-form').addEventListener('submit', function(e) {
            e.preventDefault();
            savePengurus();
        });

        // Handle perubahan kabupaten
        document.getElementById('kabupaten').addEventListener('change', function() {
            const kabupaten = this.value;
            const kecamatanSelect = document.getElementById('kecamatan');
            
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kecamatanSelect.disabled = !kabupaten;
            
            if (kabupaten && wilayahData.kecamatan[kabupaten]) {
                wilayahData.kecamatan[kabupaten].forEach(kec => {
                    const option = document.createElement('option');
                    option.value = kec;
                    option.textContent = kec;
                    kecamatanSelect.appendChild(option);
                });
            }
            
            // Reset desa
            const desaSelect = document.getElementById('desa');
            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            desaSelect.disabled = true;
        });

        // Handle perubahan kecamatan
        document.getElementById('kecamatan').addEventListener('change', function() {
            const kecamatan = this.value;
            const desaSelect = document.getElementById('desa');
            
            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            desaSelect.disabled = !kecamatan;
            
            if (kecamatan && wilayahData.desa[kecamatan]) {
                wilayahData.desa[kecamatan].forEach(desa => {
                    const option = document.createElement('option');
                    option.value = desa;
                    option.textContent = desa;
                    desaSelect.appendChild(option);
                });
            }
        });

        // Handle upload dokumen
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            const fileList = document.getElementById('file-list');
            
            if (files.length > 10) {
                showToast('Maksimal 10 file yang dapat diunggah', 'error');
                return;
            }
            
            for (let i = 0; i < Math.min(files.length, 10); i++) {
                const file = files[i];
                
                if (file.size > 5 * 1024 * 1024) {
                    showToast(`File ${file.name} melebihi ukuran maksimal 5MB`, 'error');
                    continue;
                }
                
                const docItem = document.createElement('div');
                docItem.className = 'flex items-center justify-between bg-gray-50 p-2 rounded-lg';
                docItem.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                        <span class="text-sm">${file.name}</span>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeDocument(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                fileList.appendChild(docItem);
            }
        });

        // Handle upload logo
        document.getElementById('logo-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const logoPreview = document.getElementById('logo-preview');
            
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Ukuran logo maksimal 2MB', 'error');
                    return;
                }
                
                if (!file.type.match('image.*')) {
                    showToast('File harus berupa gambar', 'error');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.innerHTML = `
                        <div class="relative">
                            <img src="${e.target.result}" alt="Logo Preview" class="h-32 rounded-lg border border-gray-200">
                            <button type="button" onclick="removeLogo()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transform translate-x-1 -translate-y-1">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle upload SOP
        document.getElementById('sop-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const sopPreview = document.getElementById('sop-preview');
            
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    showToast('Ukuran SOP maksimal 5MB', 'error');
                    return;
                }
                
                if (!file.type.match('application/pdf') && !file.type.match('application/msword') && !file.type.match('application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                    showToast('File harus berupa PDF atau DOC', 'error');
                    return;
                }
                
                const sopItem = document.createElement('div');
                sopItem.className = 'flex items-center justify-between bg-gray-50 p-2 rounded-lg';
                sopItem.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                        <span class="text-sm">${file.name}</span>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeSOP(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                sopPreview.innerHTML = '';
                sopPreview.appendChild(sopItem);
            }
        });

        // Jika mode edit, isi data fasilitas dan pengurus
        <?php if ($mode === 'edit' && isset($id) && isset($data_ics[$id])): ?>
            currentFasilitas = <?= json_encode($data_ics[$id]['fasilitas']) ?>;
            currentPengurus = <?= json_encode($data_ics[$id]['pengurus']) ?>;
        <?php endif; ?>
    });

    // Fungsi untuk menampilkan modal konfirmasi hapus
    function confirmDelete(id) {
        icsToDelete = id;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    // Fungsi untuk menyembunyikan modal hapus
    function hideDeleteModal() {
        icsToDelete = null;
        document.getElementById('delete-modal').classList.add('hidden');
    }

    // Fungsi untuk memproses penghapusan
    function proceedDelete() {
        if (icsToDelete) {
            // Simulasi penghapusan data
            showToast('ICS berhasil dihapus', 'success');
            window.location.href = '?mode=list';
        }
        hideDeleteModal();
    }

    // Fungsi untuk menampilkan modal fasilitas
    function showFasilitasModal(fasilitasId = null) {
        document.getElementById('fasilitas-modal').classList.remove('hidden');
        
        if (fasilitasId !== null) {
            // Mode edit
            document.getElementById('fasilitas-modal-title').textContent = 'Edit Fasilitas';
            const fasilitas = currentFasilitas[fasilitasId];
            
            document.getElementById('fasilitas-id').value = fasilitasId;
            document.getElementById('fasilitas-nama').value = fasilitas.fasilitas;
            document.getElementById('fasilitas-jumlah').value = fasilitas.jumlah;
            document.getElementById('fasilitas-keterangan').value = fasilitas.keterangan || '';
        } else {
            // Mode tambah
            document.getElementById('fasilitas-modal-title').textContent = 'Tambah Fasilitas';
            document.getElementById('fasilitas-form').reset();
            document.getElementById('fasilitas-id').value = '';
        }
    }

    // Fungsi untuk menyembunyikan modal fasilitas
    function hideFasilitasModal() {
        document.getElementById('fasilitas-modal').classList.add('hidden');
    }

    // Fungsi untuk menyimpan fasilitas
    function saveFasilitas() {
        const fasilitasId = document.getElementById('fasilitas-id').value;
        const isEditMode = fasilitasId !== '';
        
        const fasilitasData = {
            fasilitas: document.getElementById('fasilitas-nama').value,
            jumlah: parseInt(document.getElementById('fasilitas-jumlah').value),
            keterangan: document.getElementById('fasilitas-keterangan').value
        };
        
        if (isEditMode) {
            currentFasilitas[fasilitasId] = fasilitasData;
        } else {
            currentFasilitas.push(fasilitasData);
        }
        
        renderFasilitasList();
        hideFasilitasModal();
        showToast(`Fasilitas berhasil ${isEditMode ? 'diperbarui' : 'ditambahkan'}`, 'success');
    }

    // Fungsi untuk menampilkan daftar fasilitas
    function renderFasilitasList() {
        const tbody = document.getElementById('fasilitas-list');
        tbody.innerHTML = '';
        
        if (currentFasilitas.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada fasilitas</td>
                </tr>
            `;
            return;
        }
        
        currentFasilitas.forEach((fasilitas, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${fasilitas.fasilitas}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${fasilitas.jumlah}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${fasilitas.keterangan || '-'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button type="button" onclick="editFasilitas(${index})" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                    <button type="button" onclick="hapusFasilitas(${index})" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Fungsi untuk mengedit fasilitas
    function editFasilitas(index) {
        showFasilitasModal(index);
    }

    // Fungsi untuk menghapus fasilitas
    function hapusFasilitas(index) {
        currentFasilitas.splice(index, 1);
        renderFasilitasList();
        showToast('Fasilitas berhasil dihapus', 'success');
    }

    // Fungsi untuk menampilkan modal pengurus
    function showPengurusModal(pengurusId = null) {
        document.getElementById('pengurus-modal').classList.remove('hidden');
        
        if (pengurusId !== null) {
            // Mode edit
            document.getElementById('pengurus-modal-title').textContent = 'Edit Pengurus';
            const pengurus = currentPengurus[pengurusId];
            
            document.getElementById('pengurus-id').value = pengurusId;
            document.getElementById('pengurus-nama').value = pengurus.nama;
            document.getElementById('pengurus-jabatan').value = pengurus.jabatan;
            document.getElementById('pengurus-status').value = pengurus.status;
        } else {
            // Mode tambah
            document.getElementById('pengurus-modal-title').textContent = 'Tambah Pengurus';
            document.getElementById('pengurus-form').reset();
            document.getElementById('pengurus-id').value = '';
        }
    }

    // Fungsi untuk menyembunyikan modal pengurus
    function hidePengurusModal() {
        document.getElementById('pengurus-modal').classList.add('hidden');
    }

    // Fungsi untuk menyimpan pengurus
    function savePengurus() {
        const pengurusId = document.getElementById('pengurus-id').value;
        const isEditMode = pengurusId !== '';
        
        const pengurusData = {
            nama: document.getElementById('pengurus-nama').value,
            jabatan: document.getElementById('pengurus-jabatan').value,
            status: document.getElementById('pengurus-status').value
        };
        
        if (isEditMode) {
            currentPengurus[pengurusId] = pengurusData;
        } else {
            currentPengurus.push(pengurusData);
        }
        
        renderPengurusList();
        hidePengurusModal();
        showToast(`Pengurus berhasil ${isEditMode ? 'diperbarui' : 'ditambahkan'}`, 'success');
    }

    // Fungsi untuk menampilkan daftar pengurus
    function renderPengurusList() {
        const tbody = document.getElementById('pengurus-list');
        tbody.innerHTML = '';
        
        if (currentPengurus.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada pengurus</td>
                </tr>
            `;
            return;
        }
        
        currentPengurus.forEach((pengurus, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${pengurus.nama}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${pengurus.jabatan}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${pengurus.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        ${pengurus.status}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button type="button" onclick="editPengurus(${index})" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
                    <button type="button" onclick="hapusPengurus(${index})" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Fungsi untuk mengedit pengurus
    function editPengurus(index) {
        showPengurusModal(index);
    }

    // Fungsi untuk menghapus pengurus
    function hapusPengurus(index) {
        currentPengurus.splice(index, 1);
        renderPengurusList();
        showToast('Pengurus berhasil dihapus', 'success');
    }

    // Fungsi untuk menambahkan fasilitas
    function tambahFasilitas() {
        showFasilitasModal();
    }

    // Fungsi untuk menambahkan pengurus
    function tambahPengurus() {
        showPengurusModal();
    }

    // Fungsi untuk menghapus dokumen
    function removeDocument(button) {
        button.closest('div').remove();
    }

    // Fungsi untuk menghapus logo
    function removeLogo() {
        document.getElementById('logo-preview').innerHTML = '';
        document.getElementById('logo-upload').value = '';
    }

    // Fungsi untuk menghapus SOP
    function removeSOP(button) {
        button.closest('div').remove();
        document.getElementById('sop-upload').value = '';
    }

    // Fungsi untuk menampilkan toast notifikasi
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 px-4 py-2 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
</script>

<?php include 'footer.php'; ?>