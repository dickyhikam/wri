<?php include 'header.php'; ?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <?php
  // Mode untuk menentukan tampilan
  $mode = isset($_GET['mode']) ? $_GET['mode'] : 'list';
  $id = isset($_GET['id']) ? $_GET['id'] : null;
  
  // Tampilan Daftar Limbah B3
  if ($mode === 'list'):
  ?>
    <!-- Welcome Banner with specific title for this section -->
    <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-bold mb-2">Manajemen Limbah B3</h2>
          <p class="opacity-90">Kelola data limbah B3 dan informasi terkait</p>
        </div>
        <div class="bg-white bg-opacity-20 p-3 rounded-lg">
          <i class="fas fa-trash-alt text-3xl"></i>
        </div>
      </div>
    </div>

    <!-- Action Buttons and Search -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
      <div class="flex space-x-3">
        <a href="?mode=add" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Data
        </a>
        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-file-export mr-2"></i> Export
        </button>
      </div>
      <div class="relative w-full sm:w-64">
        <input type="text" placeholder="Cari data limbah..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
      </div>
    </div>

    <!-- Main Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-8">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Limbah</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plot</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Limbah</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Sample Data Row 1 -->
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">LB3-001</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Plot A-12</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Pestisida Kadaluarsa</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">15/07/2023</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersimpan</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="?mode=view&id=LB3-001" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                <a href="?mode=edit&id=LB3-001" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                <button onclick="confirmDelete('LB3-001')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
            
            <!-- Sample Data Row 2 -->
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">LB3-002</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Plot B-05</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Oli Bekas</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">20/07/2023</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="?mode=view&id=LB3-002" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                <a href="?mode=edit&id=LB3-002" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                <button onclick="confirmDelete('LB3-002')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
            
            <!-- Sample Data Row 3 -->
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">LB3-003</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Plot C-08</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Baterai Bekas</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">25/07/2023</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum Diproses</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="?mode=view&id=LB3-003" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                <a href="?mode=edit&id=LB3-003" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                <button onclick="confirmDelete('LB3-003')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div class="bg-white px-6 py-3 flex items-center justify-between border-t border-gray-200">
        <div class="flex-1 flex justify-between sm:hidden">
          <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </a>
          <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">12</span> results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left"></i>
              </a>
              <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 3 </a>
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <i class="fas fa-chevron-right"></i>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Delete Confirmation Modal (tetap menggunakan modal untuk konfirmasi) -->
    <div id="deleteModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Hapus Data</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus data limbah B3 ini? Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="button" onclick="deleteData()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
              Hapus
            </button>
            <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              Batal
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      // Hanya menyisakan fungsi untuk delete confirmation
      function confirmDelete(id) {
        document.getElementById('deleteModal').setAttribute('data-id', id);
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
      
      function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
      
      function deleteData() {
        const id = document.getElementById('deleteModal').getAttribute('data-id');
        // In a real app, you would send delete request to server here
        alert('Data dengan ID ' + id + ' berhasil dihapus!');
        closeDeleteModal();
        // You would typically refresh the table here
        window.location.href = '?mode=list';
      }
    </script>
  
  <?php
  // Tampilan Tambah Data
  elseif ($mode === 'add'):
  ?>
    <!-- Header untuk halaman tambah data -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Tambah Data Limbah B3</h2>
        <p class="text-gray-600">Isi formulir berikut untuk menambahkan data limbah B3 baru</p>
      </div>
      <a href="?mode=list" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
      </a>
    </div>
    
    <!-- Form Tambah Data -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6">
      <form id="addForm" action="?mode=list" method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="mb-4">
            <label for="plot_id" class="block text-sm font-medium text-gray-700 mb-1">Plot</label>
            <select id="plot_id" name="plot_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Plot</option>
              <option value="A-12">Plot A-12</option>
              <option value="B-05">Plot B-05</option>
              <option value="C-08">Plot C-08</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label for="limbah_ref_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Limbah</label>
            <select id="limbah_ref_id" name="limbah_ref_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Jenis Limbah</option>
              <option value="1">Pestisida Kadaluarsa</option>
              <option value="2">Oli Bekas</option>
              <option value="3">Baterai Bekas</option>
              <option value="4">Kemasan B3</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          
          <div class="mb-4 md:col-span-2">
            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
          <button type="reset" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
            <i class="fas fa-sync-alt mr-2"></i> Reset
          </button>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-save mr-2"></i> Simpan Data
          </button>
        </div>
      </form>
    </div>
  
  <?php
  // Tampilan Lihat Detail
  elseif ($mode === 'view' && $id):
    // Data dummy berdasarkan ID
    $data = [
      'LB3-001' => [
        'plot' => 'Plot A-12',
        'jenis' => 'Pestisida Kadaluarsa',
        'tanggal' => '15/07/2023',
        'keterangan' => 'Pestisida jenis insektisida yang sudah kadaluarsa sejak bulan lalu.',
        'status' => 'Tersimpan'
      ],
      'LB3-002' => [
        'plot' => 'Plot B-05',
        'jenis' => 'Oli Bekas',
        'tanggal' => '20/07/2023',
        'keterangan' => 'Oli bekas dari perawatan mesin pabrik.',
        'status' => 'Proses'
      ],
      'LB3-003' => [
        'plot' => 'Plot C-08',
        'jenis' => 'Baterai Bekas',
        'tanggal' => '25/07/2023',
        'keterangan' => 'Baterai bekas dari alat berat.',
        'status' => 'Belum Diproses'
      ]
    ];
    
    $currentData = $data[$id] ?? null;
    if ($currentData):
  ?>
    <!-- Header untuk halaman lihat detail -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Detail Limbah B3</h2>
        <p class="text-gray-600">Informasi lengkap tentang data limbah B3</p>
      </div>
      <a href="?mode=list" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
      </a>
    </div>
    
    <!-- Detail Data -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <p class="text-sm font-medium text-gray-500">ID Limbah</p>
          <p class="text-lg text-gray-900 mt-1 font-medium"><?= $id ?></p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Plot</p>
          <p class="text-lg text-gray-900 mt-1 font-medium"><?= $currentData['plot'] ?></p>
        </div>
        
        <div>
          <p class="text-sm font-medium text-gray-500">Jenis Limbah</p>
          <p class="text-lg text-gray-900 mt-1 font-medium"><?= $currentData['jenis'] ?></p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Tanggal</p>
          <p class="text-lg text-gray-900 mt-1 font-medium"><?= $currentData['tanggal'] ?></p>
        </div>
        
        <div class="md:col-span-2">
          <p class="text-sm font-medium text-gray-500">Keterangan</p>
          <p class="text-gray-900 mt-1"><?= $currentData['keterangan'] ?></p>
        </div>
        
        <div>
          <p class="text-sm font-medium text-gray-500">Status</p>
          <p class="text-lg text-gray-900 mt-1 font-medium">
            <?php if ($currentData['status'] === 'Tersimpan'): ?>
              <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersimpan</span>
            <?php elseif ($currentData['status'] === 'Proses'): ?>
              <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
            <?php else: ?>
              <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum Diproses</span>
            <?php endif; ?>
          </p>
        </div>
      </div>
      
      <div class="mt-8 flex justify-end">
        <a href="?mode=edit&id=<?= $id ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit Data
        </a>
      </div>
    </div>
  
  <?php
    else:
  ?>
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6 text-center">
      <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
      <h3 class="text-xl font-medium text-gray-800 mb-2">Data tidak ditemukan</h3>
      <p class="text-gray-600 mb-4">Data limbah B3 dengan ID <?= $id ?> tidak ditemukan dalam sistem.</p>
      <a href="?mode=list" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
      </a>
    </div>
  <?php
    endif;
  
  // Tampilan Edit Data
  elseif ($mode === 'edit' && $id):
    // Data dummy berdasarkan ID
    $data = [
      'LB3-001' => [
        'plot' => 'A-12',
        'jenis' => '1',
        'tanggal' => '2023-07-15',
        'keterangan' => 'Pestisida jenis insektisida yang sudah kadaluarsa sejak bulan lalu.',
        'status' => 'tersimpan'
      ],
      'LB3-002' => [
        'plot' => 'B-05',
        'jenis' => '2',
        'tanggal' => '2023-07-20',
        'keterangan' => 'Oli bekas dari perawatan mesin pabrik.',
        'status' => 'proses'
      ],
      'LB3-003' => [
        'plot' => 'C-08',
        'jenis' => '3',
        'tanggal' => '2023-07-25',
        'keterangan' => 'Baterai bekas dari alat berat.',
        'status' => 'belum'
      ]
    ];
    
    $currentData = $data[$id] ?? null;
    if ($currentData):
  ?>
    <!-- Header untuk halaman edit -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Data Limbah B3</h2>
        <p class="text-gray-600">Perbarui informasi data limbah B3</p>
      </div>
      <a href="?mode=list" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
      </a>
    </div>
    
    <!-- Form Edit Data -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6">
      <form id="editForm" action="?mode=view&id=<?= $id ?>" method="post">
        <input type="hidden" name="edit_id" value="<?= $id ?>">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="mb-4">
            <label for="edit_plot_id" class="block text-sm font-medium text-gray-700 mb-1">Plot</label>
            <select id="edit_plot_id" name="edit_plot_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Plot</option>
              <option value="A-12" <?= $currentData['plot'] === 'A-12' ? 'selected' : '' ?>>Plot A-12</option>
              <option value="B-05" <?= $currentData['plot'] === 'B-05' ? 'selected' : '' ?>>Plot B-05</option>
              <option value="C-08" <?= $currentData['plot'] === 'C-08' ? 'selected' : '' ?>>Plot C-08</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label for="edit_limbah_ref_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Limbah</label>
            <select id="edit_limbah_ref_id" name="edit_limbah_ref_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="">Pilih Jenis Limbah</option>
              <option value="1" <?= $currentData['jenis'] === '1' ? 'selected' : '' ?>>Pestisida Kadaluarsa</option>
              <option value="2" <?= $currentData['jenis'] === '2' ? 'selected' : '' ?>>Oli Bekas</option>
              <option value="3" <?= $currentData['jenis'] === '3' ? 'selected' : '' ?>>Baterai Bekas</option>
              <option value="4">Kemasan B3</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label for="edit_tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" id="edit_tanggal" name="edit_tanggal" value="<?= $currentData['tanggal'] ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
          </div>
          
          <div class="mb-4">
            <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select id="edit_status" name="edit_status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              <option value="tersimpan" <?= $currentData['status'] === 'tersimpan' ? 'selected' : '' ?>>Tersimpan</option>
              <option value="proses" <?= $currentData['status'] === 'proses' ? 'selected' : '' ?>>Proses</option>
              <option value="belum" <?= $currentData['status'] === 'belum' ? 'selected' : '' ?>>Belum Diproses</option>
            </select>
          </div>
          
          <div class="mb-4 md:col-span-2">
            <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea id="edit_keterangan" name="edit_keterangan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"><?= $currentData['keterangan'] ?></textarea>
          </div>
        </div>
        
        <div class="mt-6 flex justify-end space-x-3">
          <a href="?mode=view&id=<?= $id ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
            <i class="fas fa-times mr-2"></i> Batal
          </a>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-save mr-2"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  
  <?php
    else:
  ?>
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6 text-center">
      <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
      <h3 class="text-xl font-medium text-gray-800 mb-2">Data tidak ditemukan</h3>
      <p class="text-gray-600 mb-4">Data limbah B3 dengan ID <?= $id ?> tidak ditemukan dalam sistem.</p>
      <a href="?mode=list" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
      </a>
    </div>
  <?php
    endif;
  
  // Mode tidak dikenali
  else:
  ?>
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6 text-center">
      <i class="fas fa-exclamation-circle text-red-500 text-4xl mb-4"></i>
      <h3 class="text-xl font-medium text-gray-800 mb-2">Halaman tidak valid</h3>
      <p class="text-gray-600 mb-4">Mode yang diminta tidak dikenali oleh sistem.</p>
      <a href="?mode=list" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
      </a>
    </div>
  <?php
  endif;
  ?>
</section>

<?php include 'footer.php'; ?>