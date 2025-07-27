<?php include 'header.php'; ?>
<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <?php
  // Mode untuk menentukan tampilan
  $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  // --- Data Petani Dummy (Disesuaikan dengan contoh Anda) ---
  // Biasanya data ini diambil dari database
  $data_petani = [
    'KMJ.14.08.06.2006.0001' => [
        'nama' => 'Petani 1',
        'nik' => '1408060907930001',
        'alamat' => 'Alamat Petani 1',
        'tempat_lahir' => 'Berumbung Baru',
        'tanggal_lahir' => '01/03/1945',
        'jenis_kelamin' => 'L',
        'kebun' => 'Kebun',
        'jenis_tanah' => 'Mineral',
        'status_lahan' => 'Pemilik',
        'desa' => 'Berumbung Baru',
        'kecamatan' => 'Dayun',
        'kabupaten' => 'Siak',
        'tahun_tanam' => '1986'
    ],
    'KMJ.14.08.06.2006.0002' => [
        'nama' => 'Petani 2',
        'nik' => '1408062006890001',
        'alamat' => 'Alamat Petani 2',
        'tempat_lahir' => 'Indramayu',
        'tanggal_lahir' => '20/06/1989',
        'jenis_kelamin' => 'L',
        'kebun' => 'Kebun',
        'jenis_tanah' => 'Mineral',
        'status_lahan' => 'Penggarap',
        'desa' => 'Berumbung Baru',
        'kecamatan' => 'Kerinci Kanan',
        'kabupaten' => 'Siak',
        'tahun_tanam' => '1985'
    ]
  ];
  
  // Data unik untuk filter
  $kecamatans = array_unique(array_column($data_petani, 'kecamatan'));
  $kabupatens = array_unique(array_column($data_petani, 'kabupaten'));
  
  // --- Data Limbah B3 Dummy ---
  $data_limbah = [
    'LB3-001' => [
        'plot' => 'Plot A-12',
        'jenis' => 'Pestisida Kadaluarsa',
        'tanggal' => '15/07/2023',
        'keterangan' => 'Pestisida jenis insektisida yang sudah kadaluarsa sejak bulan lalu.',
        'status' => 'Tersimpan',
        'id_petani' => 'KMJ.14.08.06.2006.0001'
    ],
    'LB3-002' => [
        'plot' => 'Plot B-05',
        'jenis' => 'Oli Bekas',
        'tanggal' => '20/07/2023',
        'keterangan' => 'Oli bekas dari perawatan mesin pabrik.',
        'status' => 'Proses',
        'id_petani' => 'KMJ.14.08.06.2006.0002'
    ],
    'LB3-003' => [
        'plot' => 'Plot C-08',
        'jenis' => 'Baterai Bekas',
        'tanggal' => '25/07/2023',
        'keterangan' => 'Baterai bekas dari alat berat.',
        'status' => 'Belum Diproses',
        'id_petani' => 'KMJ.14.08.06.2006.0002'
    ]
  ];

  // Initialize filtered data with all data first
  $filtered_limbah = $data_limbah;
  
  // Get filter parameters
  $filter_jenis = isset($_GET['filter_jenis']) ? $_GET['filter_jenis'] : '';
  $filter_petani = isset($_GET['filter_petani']) ? $_GET['filter_petani'] : '';
  $filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  // Apply filters
  if ($filter_jenis) {
      $filtered_limbah = array_filter($filtered_limbah, function($limbah) use ($filter_jenis) {
          return $limbah['jenis'] == $filter_jenis;
      });
  }

  if ($filter_petani) {
      $filtered_limbah = array_filter($filtered_limbah, function($limbah) use ($filter_petani) {
          return $limbah['id_petani'] == $filter_petani;
      });
  }

  if ($filter_status) {
      $filtered_limbah = array_filter($filtered_limbah, function($limbah) use ($filter_status) {
          return $limbah['status'] == $filter_status;
      });
  }

  if ($search) {
      $search = strtolower($search);
      $filtered_limbah = array_filter($filtered_limbah, function($limbah) use ($search, $data_petani) {
          $id_petani = $limbah['id_petani'];
          $petani = isset($data_petani[$id_petani]) ? $data_petani[$id_petani] : null;
          
          return (strpos(strtolower($limbah['id']), $search) !== false) || 
                 ($petani && strpos(strtolower($petani['nama']), $search) !== false);
      });
  }

  // Konfigurasi Pagination
  $itemsPerPage = 5;
  $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
  $totalItems = count($filtered_limbah);
  $totalPages = ceil($totalItems / $itemsPerPage);
  $currentPage = min($currentPage, $totalPages);
  $startIndex = ($currentPage - 1) * $itemsPerPage;
  $paginatedLimbah = array_slice($filtered_limbah, $startIndex, $itemsPerPage, true);
  ?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php if ($mode === 'list'): ?>
                    Manajemen Data Limbah B3
                <?php elseif ($mode === 'add'): ?>
                    Tambah Data Limbah B3
                <?php elseif ($mode === 'view'): ?>
                    Detail Limbah B3
                <?php elseif ($mode === 'edit'): ?>
                    Edit Data Limbah B3
                <?php endif; ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($mode === 'list'): ?>
                <!-- Tombol Tambah Data -->
                <a href="?mode=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
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
            <!-- Halaman Daftar Limbah B3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="space-y-4">
                        <input type="hidden" name="mode" value="list">
                        <div class="mb-4">
                            <div class="relative">
                                <input type="text" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       placeholder="Cari data limbah...">
                                <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Filter Jenis Limbah -->
                            <div>
                                <select id="filter_jenis" name="filter_jenis" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Jenis Limbah</option>
                                    <option value="Pestisida Kadaluarsa" <?= $filter_jenis === 'Pestisida Kadaluarsa' ? 'selected' : '' ?>>Pestisida Kadaluarsa</option>
                                    <option value="Oli Bekas" <?= $filter_jenis === 'Oli Bekas' ? 'selected' : '' ?>>Oli Bekas</option>
                                    <option value="Baterai Bekas" <?= $filter_jenis === 'Baterai Bekas' ? 'selected' : '' ?>>Baterai Bekas</option>
                                    <option value="Kemasan B3" <?= $filter_jenis === 'Kemasan B3' ? 'selected' : '' ?>>Kemasan B3</option>
                                </select>
                            </div>
                            
                            <!-- Filter Petani -->
                            <div>
                                <select id="filter_petani" name="filter_petani" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Petani</option>
                                    <?php foreach($data_petani as $id_petani => $petani): ?>
                                        <option value="<?= $id_petani ?>" <?= $filter_petani === $id_petani ? 'selected' : '' ?>><?= htmlspecialchars($petani['nama']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Filter Status -->
                            <div>
                                <select id="filter_status" name="filter_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="Tersimpan" <?= $filter_status === 'Tersimpan' ? 'selected' : '' ?>>Tersimpan</option>
                                    <option value="Proses" <?= $filter_status === 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Belum Diproses" <?= $filter_status === 'Belum Diproses' ? 'selected' : '' ?>>Belum Diproses</option>
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Limbah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plot</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Limbah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($paginatedLimbah)): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data limbah</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($paginatedLimbah as $id_limbah => $limbah): 
                                    $rowNumber = $startIndex + array_search($id_limbah, array_keys($filtered_limbah)) + 1;
                                    $petani = isset($data_petani[$limbah['id_petani']]) ? $data_petani[$limbah['id_petani']] : null;
                                ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rowNumber ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $id_limbah ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $limbah['plot'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $limbah['jenis'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $limbah['tanggal'] ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?= $petani ? htmlspecialchars($petani['nama']) : 'Tidak Diketahui' ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($limbah['status'] === 'Tersimpan'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersimpan</span>
                                            <?php elseif ($limbah['status'] === 'Proses'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum Diproses</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="?mode=view&id=<?= $id_limbah ?>" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                                            <a href="?mode=edit&id=<?= $id_limbah ?>" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                                            <button onclick="confirmDelete('<?= $id_limbah ?>')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
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
            <!-- Form Tambah Limbah B3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Data Limbah B3</h2>
                    <form id="addForm" action="?mode=list" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="plot_id" class="block text-sm font-medium text-gray-700 mb-1">Plot</label>
                                <select id="plot_id" name="plot_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Plot</option>
                                    <option value="A-12">Plot A-12</option>
                                    <option value="B-05">Plot B-05</option>
                                    <option value="C-08">Plot C-08</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="limbah_ref_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Limbah</label>
                                <select id="limbah_ref_id" name="limbah_ref_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Jenis Limbah</option>
                                    <option value="1">Pestisida Kadaluarsa</option>
                                    <option value="2">Oli Bekas</option>
                                    <option value="3">Baterai Bekas</option>
                                    <option value="4">Kemasan B3</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <!-- Dropdown untuk memilih Petani -->
                            <div class="mb-4">
                                <label for="id_petani_add" class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
                                <select id="id_petani_add" name="id_petani" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Petani</option>
                                    <?php foreach($data_petani as $id_petani_key => $info_petani): ?>
                                        <option value="<?= htmlspecialchars($id_petani_key) ?>"><?= htmlspecialchars($info_petani['nama']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Tersimpan">Tersimpan</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Belum Diproses">Belum Diproses</option>
                                </select>
                            </div>
                            <div class="mb-4 md:col-span-2">
                                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($mode === 'view' && $id && isset($data_limbah[$id])): ?>
            <?php 
                $currentData = $data_limbah[$id];
                $petani_terkait = isset($data_petani[$currentData['id_petani']]) ? $data_petani[$currentData['id_petani']] : null;
            ?>
            <!-- Halaman Detail Limbah B3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Limbah B3 #<?= $id ?></h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">ID Limbah</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $id ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Plot</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $currentData['plot'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Limbah</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $currentData['jenis'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $currentData['tanggal'] ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <?php if ($currentData['status'] === 'Tersimpan'): ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersimpan</span>
                                <?php elseif ($currentData['status'] === 'Proses'): ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                                <?php else: ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum Diproses</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Keterangan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= $currentData['keterangan'] ?></p>
                        </div>
                    </div>

                    <!-- Informasi Petani Terkait -->
                    <?php if ($petani_terkait): ?>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Petani Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Petani</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['nama']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">NIK</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['nik']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['alamat']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tempat, Tanggal Lahir</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['tempat_lahir'] . ', ' . $petani_terkait['tanggal_lahir']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['jenis_kelamin']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Desa/Kelurahan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['desa']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Kecamatan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['kecamatan']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Kabupaten</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['kabupaten']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jenis Tanah</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['jenis_tanah']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status Lahan</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['status_lahan']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tahun Tanam</label>
                            <p class="mt-1 text-sm text-gray-900"><?= htmlspecialchars($petani_terkait['tahun_tanam']) ?></p>
                        </div>
                    </div>
                    <?php else: ?>
                        <p class="text-gray-500 italic">Tidak ada informasi petani terkait untuk limbah ini.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif ($mode === 'edit' && $id && isset($data_limbah[$id])): ?>
            <?php $currentData = $data_limbah[$id]; ?>
            <!-- Form Edit Limbah B3 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Limbah B3 #<?= $id ?></h2>
                    <form id="editForm" action="?mode=view&id=<?= $id ?>" method="post">
                        <input type="hidden" name="edit_id" value="<?= $id ?>">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="edit_plot_id" class="block text-sm font-medium text-gray-700 mb-1">Plot</label>
                                <select id="edit_plot_id" name="edit_plot_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                                                        <option value="">Pilih Plot</option>
                                    <option value="A-12" <?= $currentData['plot'] === 'A-12' ? 'selected' : '' ?>>Plot A-12</option>
                                    <option value="B-05" <?= $currentData['plot'] === 'B-05' ? 'selected' : '' ?>>Plot B-05</option>
                                    <option value="C-08" <?= $currentData['plot'] === 'C-08' ? 'selected' : '' ?>>Plot C-08</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_limbah_ref_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Limbah</label>
                                <select id="edit_limbah_ref_id" name="edit_limbah_ref_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Jenis Limbah</option>
                                    <option value="1" <?= $currentData['jenis'] === 'Pestisida Kadaluarsa' ? 'selected' : '' ?>>Pestisida Kadaluarsa</option>
                                    <option value="2" <?= $currentData['jenis'] === 'Oli Bekas' ? 'selected' : '' ?>>Oli Bekas</option>
                                    <option value="3" <?= $currentData['jenis'] === 'Baterai Bekas' ? 'selected' : '' ?>>Baterai Bekas</option>
                                    <option value="4" <?= $currentData['jenis'] === 'Kemasan B3' ? 'selected' : '' ?>>Kemasan B3</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                <input type="date" id="edit_tanggal" name="edit_tanggal" value="<?= date('Y-m-d', strtotime(str_replace('/', '-', $currentData['tanggal']))) ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="edit_id_petani" class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
                                <select id="edit_id_petani" name="edit_id_petani" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Petani</option>
                                    <?php foreach($data_petani as $id_petani_key => $info_petani): ?>
                                        <option value="<?= htmlspecialchars($id_petani_key) ?>" <?= $currentData['id_petani'] === $id_petani_key ? 'selected' : '' ?>><?= htmlspecialchars($info_petani['nama']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="edit_status" name="edit_status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Tersimpan" <?= $currentData['status'] === 'Tersimpan' ? 'selected' : '' ?>>Tersimpan</option>
                                    <option value="Proses" <?= $currentData['status'] === 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Belum Diproses" <?= $currentData['status'] === 'Belum Diproses' ? 'selected' : '' ?>>Belum Diproses</option>
                                </select>
                            </div>
                            <div class="mb-4 md:col-span-2">
                                <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                <textarea id="edit_keterangan" name="edit_keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"><?= $currentData['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="reset" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Reset</button>
                            <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <!-- Tampilan Default jika mode tidak dikenali -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Halaman Tidak Ditemukan</h2>
                <p class="text-gray-600">Mode yang diminta tidak tersedia atau data tidak ditemukan.</p>
                <a href="?mode=list" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Kembali ke Daftar Limbah</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Konfirmasi Hapus</h3>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data limbah ini?</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Batal</button>
            <button id="confirmDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Hapus</button>
        </div>
    </div>
</div>
</section>

<script>
    // Fungsi untuk menampilkan modal konfirmasi hapus
    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        
        confirmBtn.onclick = function() {
            // Lakukan aksi hapus di sini (biasanya dengan AJAX atau form submission)
            window.location.href = '?mode=list&delete=' + id;
        };
        
        modal.classList.remove('hidden');
    }
    
    // Fungsi untuk menutup modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

<?php include 'footer.php'; ?>