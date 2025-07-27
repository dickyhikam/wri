<?php
// transaksi_panen.php
include 'header.php';

// Simulasi data dummy
$dummyTransaksi = [
    [
        'id' => 1,
        'tanggal' => '2023-05-15',
        'lahan' => 'Lahan A',
        'petani' => 'Budi Santoso',
        'ics' => 'ICS-001',
        'mills' => 'Mills X',
        'volume' => 1500,
        'harga' => 5000,
        'total' => 7500000,
        'status' => 'Selesai'
    ],
    [
        'id' => 2,
        'tanggal' => '2023-05-20',
        'lahan' => 'Lahan B',
        'petani' => 'Siti Rahma',
        'ics' => 'ICS-002',
        'mills' => 'Mills Y',
        'volume' => 2000,
        'harga' => 5200,
        'total' => 10400000,
        'status' => 'Proses'
    ]
];

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Simulasi data yang dipilih
$selectedData = null;
if ($id) {
    foreach ($dummyTransaksi as $data) {
        if ($data['id'] == $id) {
            $selectedData = $data;
            break;
        }
    }
}
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
  <header class="h-20 shadow-sm flex items-center justify-between px-8">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-gray-800">
        <?php 
        if ($action == 'add') echo "Tambah Transaksi Panen";
        elseif ($action == 'view') echo "Detail Transaksi: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
        elseif ($action == 'edit') echo "Edit Transaksi: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
        else echo "Data Transaksi Panen";
        ?>
      </h1>
    </div>
    <div class="flex items-center space-x-6">
      <?php if ($action == 'list'): ?>
        <a href="transaksi.php?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-plus mr-2"></i> Tambah Transaksi
        </a>
      <?php elseif ($action == 'view'): ?>
        <a href="transaksi.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="transaksi.php?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-edit mr-2"></i> Edit
        </a>
        <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-trash-alt mr-2"></i> Hapus
        </button>
      <?php elseif ($action == 'edit'): ?>
        <a href="transaksi.php?action=view&id=<?= $id ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-times mr-2"></i> Batal
        </a>
      <?php elseif ($action == 'add'): ?>
        <a href="transaksi.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
      <?php endif; ?>
    </div>
  </header>
  
  <!-- Main Content -->
  <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <?php if ($action == 'list'): ?>
      <!-- Daftar Transaksi Panen -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
          <form method="get" class="flex flex-col gap-4">
            <input type="hidden" name="action" value="list">
            
            <div class="flex-1">
              <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari transaksi...">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <select name="status_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                  <option value="">Semua Status</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Proses">Proses</option>
                </select>
              </div>
              <div>
                <input type="date" name="date_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                  <i class="fas fa-filter mr-2"></i> Filter
                </button>
              </div>
            </div>
          </form>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lahan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ICS</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volume (kg)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total (Rp)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php foreach ($dummyTransaksi as $transaksi): ?>
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    TRX-<?= str_pad($transaksi['id'], 4, '0', STR_PAD_LEFT) ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= date('d/m/Y', strtotime($transaksi['tanggal'])) ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= $transaksi['lahan'] ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= $transaksi['petani'] ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= $transaksi['ics'] ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= number_format($transaksi['volume'], 0, ',', '.') ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    Rp <?= number_format($transaksi['total'], 0, ',', '.') ?>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $transaksi['status'] == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                      <?= $transaksi['status'] ?>
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="transaksi.php?action=view&id=<?= $transaksi['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="transaksi.php?action=edit&id=<?= $transaksi['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" onclick="confirmDelete('<?= $transaksi['id'] ?>')" class="text-red-600 hover:text-red-900">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">2</span> transaksi
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Previous</span>
                  <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                  1
                </a>
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Next</span>
                  <i class="fas fa-chevron-right"></i>
                </a>
              </nav>
            </div>
          </div>
        </div>
      </div>
      
    <?php elseif ($action == 'add' || $action == 'edit'): ?>
      <!-- Form Tambah/Edit Transaksi -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
          <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Lahan</label>
                  <select class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Lahan</option>
                    <option value="1" <?= ($action == 'edit' && $selectedData['lahan'] == 'Lahan A') ? 'selected' : '' ?>>Lahan A</option>
                    <option value="2" <?= ($action == 'edit' && $selectedData['lahan'] == 'Lahan B') ? 'selected' : '' ?>>Lahan B</option>
                  </select>
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
                  <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="<?= ($action == 'edit') ? $selectedData['petani'] : '' ?>" readonly>
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">ICS</label>
                  <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="<?= ($action == 'edit') ? $selectedData['ics'] : '' ?>" readonly>
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Mills</label>
                  <select class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    <option value="">Pilih Mills</option>
                    <option value="1" <?= ($action == 'edit' && $selectedData['mills'] == 'Mills X') ? 'selected' : '' ?>>Mills X</option>
                    <option value="2" <?= ($action == 'edit' && $selectedData['mills'] == 'Mills Y') ? 'selected' : '' ?>>Mills Y</option>
                  </select>
                </div>
              </div>
              <div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Panen</label>
                  <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['tanggal'] : '' ?>" required>
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Volume (kg)</label>
                  <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['volume'] : '' ?>" required>
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan (Rp)</label>
                  <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="<?= ($action == 'edit') ? $selectedData['harga'] : '' ?>" required>
                </div>
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Total (Rp)</label>
                  <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="<?= ($action == 'edit') ? number_format($selectedData['total'], 0, ',', '.') : '' ?>" readonly>
                </div>
              </div>
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
              <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"><?= ($action == 'edit') ? 'Catatan transaksi panen' : '' ?></textarea>
            </div>
            <div class="flex justify-end space-x-3">
              <a href="<?= ($action == 'edit') ? 'transaksi.php?action=view&id='.$id : 'transaksi.php' ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Batal
              </a>
              <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
      
    <?php elseif ($action == 'view' && $selectedData): ?>
      <!-- Detail Transaksi - Updated Layout to Match Farmer Style -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header with ID and Status -->
        <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
          <div>
            <h3 class="text-lg font-medium text-gray-900">
              TRX-<?= str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) ?>
            </h3>
            <p class="text-sm text-gray-500">
              <?= date('d/m/Y', strtotime($selectedData['tanggal'])) ?>
            </p>
          </div>
          <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full <?= $selectedData['status'] == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
            <?= $selectedData['status'] ?>
          </span>
        </div>
        
        <!-- Main Content -->
        <div class="p-6">
          <!-- Tab Navigation -->
          <div class="border-b border-gray-200 mb-6">
            <nav class="flex -mb-px space-x-8">
              <button class="tab-button py-4 px-1 text-center border-b-2 font-medium text-sm border-[#f0ab00] text-[#f0ab00]">
                Informasi Utama
              </button>
            </nav>
          </div>
          
          <!-- Informasi Utama -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
              <h4 class="text-md font-medium text-gray-900 mb-4">Informasi Transaksi</h4>
              <div class="space-y-4">
                <div>
                  <p class="text-sm text-gray-500">Lahan</p>
                  <p class="text-sm font-medium"><?= $selectedData['lahan'] ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Petani</p>
                  <p class="text-sm font-medium"><?= $selectedData['petani'] ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">ICS</p>
                  <p class="text-sm font-medium"><?= $selectedData['ics'] ?></p>
                </div>
              </div>
            </div>
            
            <div>
              <h4 class="text-md font-medium text-gray-900 mb-4">Detail Panen</h4>
              <div class="space-y-4">
                <div>
                  <p class="text-sm text-gray-500">Mills</p>
                  <p class="text-sm font-medium"><?= $selectedData['mills'] ?></p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Volume</p>
                  <p class="text-sm font-medium"><?= number_format($selectedData['volume'], 0, ',', '.') ?> kg</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Harga Satuan</p>
                  <p class="text-sm font-medium">Rp <?= number_format($selectedData['harga'], 0, ',', '.') ?></p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Informasi Keuangan -->
          <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h4 class="text-md font-medium text-gray-900 mb-4">Ringkasan Keuangan</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="bg-white p-3 rounded-md shadow-sm">
                <p class="text-sm text-gray-500">Total</p>
                <p class="text-lg font-semibold">Rp <?= number_format($selectedData['total'], 0, ',', '.') ?></p>
              </div>
            </div>
          </div>
          
          <!-- Catatan dan Dokumen -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h4 class="text-md font-medium text-gray-900 mb-2">Catatan</h4>
              <div class="bg-gray-50 p-4 rounded-md">
                <p class="text-sm text-gray-700">Catatan transaksi panen</p>
              </div>
            </div>
            
            <div>
              <h4 class="text-md font-medium text-gray-900 mb-2">Dokumen</h4>
              <div class="border-2 border-dashed border-gray-300 rounded-md p-4 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="mt-1 text-sm text-gray-600">Unggah dokumen pendukung</p>
                <button type="button" class="mt-2 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f0ab00]">
                  Pilih File
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
</main>

<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
        // Simulasi penghapusan data
        alert('Transaksi dengan ID ' + id + ' telah dihapus');
        window.location.href = 'transaksi.php';
    }
}
</script>

<?php include 'footer.php'; ?>