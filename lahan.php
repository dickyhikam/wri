<?php include 'header.php'; ?>

<section class="flex-1 overflow-y-auto p-8 bg-gray-50">

<div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Manajemen Lahan</h2>
        <p class="opacity-90">Kelola data lahan sawit petani</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-tractor text-3xl"></i>
      </div>
    </div>
  </div>
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manajemen Lahan</h1>
    <button onclick="showForm()" class="bg-[#F0AB00] hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
      <i class="fas fa-plus mr-2"></i>Tambah Lahan
    </button>
  </div>

  <!-- Tabel Daftar Lahan -->
  <div id="list-view" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar Lahan</h2>
      <div class="flex space-x-2">
        <div class="relative">
          <input type="text" placeholder="Cari lahan..." class="pl-8 pr-4 py-2 border border-gray-300 rounded-lg">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
        <button class="px-3 py-2 bg-gray-100 rounded-lg">
          <i class="fas fa-filter text-gray-600"></i>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Lahan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lahan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani Pemilik</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Luas (Ha)</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <!-- Data Dummy -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PL-001</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">Kebun Sawit Utama</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">Ahmad Fauzi</div>
              <div class="text-sm text-gray-500">ICS-12</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">5.2</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Pelalawan, Riau</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="showDetail('PL-001')" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
              <button onclick="showEditForm('PL-001')" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
              <button onclick="showDeleteModal('PL-001')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PL-002</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">Kebun Sawit Baru</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">Siti Rahma</div>
              <div class="text-sm text-gray-500">ICS-08</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3.8</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Inhu, Riau</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses Verifikasi</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="showDetail('PL-002')" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
              <button onclick="showEditForm('PL-002')" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
              <button onclick="showDeleteModal('PL-002')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PL-003</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">Kebun Sawit Makmur</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">Budi Santoso</div>
              <div class="text-sm text-gray-500">ICS-15</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">7.5</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Siak, Riau</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="showDetail('PL-003')" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
              <button onclick="showEditForm('PL-003')" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
              <button onclick="showDeleteModal('PL-003')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="flex justify-between items-center mt-4">
      <div class="text-sm text-gray-500">
        Menampilkan 1-3 dari 3 lahan
      </div>
      <div class="flex space-x-1">
        <button class="px-3 py-1 bg-gray-200 rounded-lg"><i class="fas fa-chevron-left"></i></button>
        <button class="px-3 py-1 bg-[#F0AB00] text-white rounded-lg">1</button>
        <button class="px-3 py-1 bg-gray-200 rounded-lg"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </div>

  <!-- Form Tambah/Ubah Lahan (Hidden by default) -->
  <div id="form-view" class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hidden">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold" id="form-title">Tambah Lahan Baru</h2>
      <button onclick="hideForm()" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <form>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Kolom Kiri -->
        <div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">ID Lahan</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="PL-004" readonly>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan*</label>
            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kebun Sawit Utama" required>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Petani Pemilik*</label>
            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
              <option value="">Pilih Petani</option>
              <option value="1">Ahmad Fauzi (ICS-12)</option>
              <option value="2">Siti Rahma (ICS-08)</option>
              <option value="3">Budi Santoso (ICS-15)</option>
            </select>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Luas (Ha)*</label>
            <input type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 5.2" required>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam</label>
            <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 2018">
          </div>
        </div>
        
        <!-- Kolom Kanan -->
        <div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Kepemilikan*</label>
            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
              <option value="">Pilih Status</option>
              <option value="milik">Milik Sendiri</option>
              <option value="sewa">Sewa</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>
          

          <div class="mb-4">
  <label class="block text-sm font-medium text-gray-700 mb-1">Alamat (Jalan/Dusun)*</label>
  <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jl. Sawit Makmur No. 12, Dusun Sejahtera" required>
</div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi*</label>
            <div class="grid grid-cols-2 gap-2 mb-2">
              <select class="col-span-2 px-3 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Pilih Provinsi</option>
                <option value="riau" selected>Riau</option>
              </select>
              <select class="px-3 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Pilih Kabupaten</option>
                <option value="pelalawan">Pelalawan</option>
                <option value="inhu">Indragiri Hulu</option>
                <option value="siak">Siak</option>
              </select>
              <select class="px-3 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Pilih Kecamatan</option>
                <option value="pangkalan_kerinci">Pangkalan Kerinci</option>
                <option value="kerinci_kanan">Kerinci Kanan</option>
                <option value="bungaraya">Bungaraya</option>
              </select>
              <select class="px-3 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Pilih Desa</option>
                <option value="bukit_agung">Bukit Agung</option>
                <option value="sialang_pandan">Sialang Pandan</option>
                <option value="dayun">Dayun</option>
              </select>
            </div>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen Legalitas</label>
            <div class="flex items-center">
              <input type="file" class="hidden" id="file-upload">
              <label for="file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-upload mr-2"></i>Unggah Dokumen
              </label>
              <span class="ml-2 text-sm text-gray-500">SHM, SPPT, SKT</span>
            </div>
          </div>
          
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
            <label class="inline-flex items-center cursor-pointer">
              <input type="checkbox" class="sr-only peer" checked>
              <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              <span class="ms-3 text-sm font-medium text-gray-700">Aktif</span>
            </label>
          </div>
        </div>
      </div>
      
      <!-- Batas Lahan -->
      <div class="mb-6 p-4 border border-gray-200 rounded-lg">
        <h3 class="text-md font-semibold mb-3">Batas Lahan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex items-center">
            <input type="checkbox" class="mr-2" id="bl-utara">
            <label for="bl-utara" class="text-sm font-medium text-gray-700">Batas Utara</label>
            <select class="ml-2 px-2 py-1 border border-gray-300 rounded-lg text-sm" disabled>
              <option value="">Jenis Batas</option>
              <option value="sungai">Sungai</option>
              <option value="jalan">Jalan</option>
              <option value="lahan_lain">Lahan Lain</option>
            </select>
          </div>
          <div class="flex items-center">
            <input type="checkbox" class="mr-2" id="bl-selatan">
            <label for="bl-selatan" class="text-sm font-medium text-gray-700">Batas Selatan</label>
            <select class="ml-2 px-2 py-1 border border-gray-300 rounded-lg text-sm" disabled>
              <option value="">Jenis Batas</option>
              <option value="sungai">Sungai</option>
              <option value="jalan">Jalan</option>
              <option value="lahan_lain">Lahan Lain</option>
            </select>
          </div>
          <div class="flex items-center">
            <input type="checkbox" class="mr-2" id="bl-barat">
            <label for="bl-barat" class="text-sm font-medium text-gray-700">Batas Barat</label>
            <select class="ml-2 px-2 py-1 border border-gray-300 rounded-lg text-sm" disabled>
              <option value="">Jenis Batas</option>
              <option value="sungai">Sungai</option>
              <option value="jalan">Jalan</option>
              <option value="lahan_lain">Lahan Lain</option>
            </select>
          </div>
          <div class="flex items-center">
            <input type="checkbox" class="mr-2" id="bl-timur">
            <label for="bl-timur" class="text-sm font-medium text-gray-700">Batas Timur</label>
            <select class="ml-2 px-2 py-1 border border-gray-300 rounded-lg text-sm" disabled>
              <option value="">Jenis Batas</option>
              <option value="sungai">Sungai</option>
              <option value="jalan">Jalan</option>
              <option value="lahan_lain">Lahan Lain</option>
            </select>
          </div>
        </div>
      </div>
      
      <!-- GeoJSON / Polygon Editor -->
      <div class="mb-6 p-4 border border-gray-200 rounded-lg">
        <h3 class="text-md font-semibold mb-3">GeoJSON / Polygon Editor</h3>
        <div class="bg-gray-100 h-48 rounded-lg flex items-center justify-center">
          <p class="text-gray-500">Peta akan ditampilkan di sini</p>
        </div>
        <div class="mt-3 flex justify-end">
          <button type="button" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm mr-2">
            <i class="fas fa-edit mr-1"></i>Edit Polygon
          </button>
          <button type="button" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
            <i class="fas fa-sync-alt mr-1"></i>Reset
          </button>
        </div>
      </div>
      
      <div class="flex justify-end space-x-3">
        <button type="button" onclick="hideForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
          Batal
        </button>
        <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
          Simpan Lahan
        </button>
      </div>
    </form>
  </div>

  <!-- Detail Lahan (Hidden by default) -->
  <div id="detail-view" class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hidden">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Detail Lahan</h2>
      <button onclick="hideDetail()" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <!-- Informasi Utama -->
      <div class="md:col-span-2">
        <h3 class="text-md font-semibold mb-3 border-b pb-2">Informasi Lahan</h3>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="text-sm text-gray-500">ID Lahan</p>
            <p class="font-medium">PL-001</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Nama Lahan</p>
            <p class="font-medium">Kebun Sawit Utama</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Petani Pemilik</p>
            <p class="font-medium">Ahmad Fauzi (ICS-12)</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Luas (Ha)</p>
            <p class="font-medium">5.2</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Tahun Tanam</p>
            <p class="font-medium">2018</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Status Kepemilikan</p>
            <p class="font-medium">Milik Sendiri</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Lokasi</p>
            <p class="font-medium">Desa Bukit Agung, Pangkalan Kerinci, Pelalawan, Riau</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Status Verifikasi</p>
            <p class="font-medium text-green-600">Aktif</p>
          </div>
        </div>
        
        <h3 class="text-md font-semibold mb-3 mt-4 border-b pb-2">Batas Lahan</h3>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="text-sm text-gray-500">Utara</p>
            <p class="font-medium">Sungai (Sungai Kerinci)</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Selatan</p>
            <p class="font-medium">Jalan (Jalan Lintas Timur)</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Barat</p>
            <p class="font-medium">Lahan Lain (Milik PT. Sawit Makmur)</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Timur</p>
            <p class="font-medium">Sungai (Sungai Tapung)</p>
          </div>
        </div>
      </div>
      
      <!-- Dokumen & Peta -->
      <div>
        <h3 class="text-md font-semibold mb-3 border-b pb-2">Dokumen Legalitas</h3>
        <div class="space-y-2 mb-4">
          <div class="flex items-center p-2 bg-gray-50 rounded-lg">
            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
            <span class="text-sm">SHM_12345678.pdf</span>
            <a href="#" class="ml-auto text-blue-500 text-sm"><i class="fas fa-download"></i></a>
          </div>
          <div class="flex items-center p-2 bg-gray-50 rounded-lg">
            <i class="fas fa-file-image text-green-500 mr-2"></i>
            <span class="text-sm">SPPT_2023.jpg</span>
            <a href="#" class="ml-auto text-blue-500 text-sm"><i class="fas fa-download"></i></a>
          </div>
        </div>
        
        <h3 class="text-md font-semibold mb-3 border-b pb-2">Peta Lahan</h3>
        <div class="bg-gray-100 h-48 rounded-lg flex items-center justify-center mb-4">
          <p class="text-gray-500">Peta akan ditampilkan di sini</p>
        </div>
        
        <button class="w-full bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-sm">
          <i class="fas fa-edit mr-1"></i>Edit Polygon
        </button>
      </div>
    </div>
    
    <!-- Sejarah Lahan -->
    <h3 class="text-md font-semibold mb-3 border-b pb-2">Sejarah Lahan</h3>
    <div class="space-y-4">
      <div class="flex items-start p-3 bg-gray-50 rounded-lg">
        <div class="bg-blue-100 p-2 rounded-lg mr-3">
          <i class="fas fa-edit text-blue-600"></i>
        </div>
        <div class="flex-1">
          <div class="flex justify-between">
            <p class="text-sm font-medium">Data lahan diperbarui</p>
            <p class="text-xs text-gray-500">15 Jan 2023</p>
          </div>
          <p class="text-xs text-gray-500 mt-1">Diubah oleh: Admin WRI</p>
          <p class="text-sm mt-1">Perubahan data luas lahan dari 5.0 Ha menjadi 5.2 Ha</p>
        </div>
      </div>
      
      <div class="flex items-start p-3 bg-gray-50 rounded-lg">
        <div class="bg-green-100 p-2 rounded-lg mr-3">
          <i class="fas fa-check-circle text-green-600"></i>
        </div>
        <div class="flex-1">
          <div class="flex justify-between">
            <p class="text-sm font-medium">Verifikasi lahan</p>
            <p class="text-xs text-gray-500">10 Jan 2023</p>
          </div>
          <p class="text-xs text-gray-500 mt-1">Diubah oleh: Verifikator Lapangan</p>
          <p class="text-sm mt-1">Lahan telah diverifikasi dan disetujui</p>
        </div>
      </div>
      
      <div class="flex items-start p-3 bg-gray-50 rounded-lg">
        <div class="bg-purple-100 p-2 rounded-lg mr-3">
          <i class="fas fa-file-upload text-purple-600"></i>
        </div>
        <div class="flex-1">
          <div class="flex justify-between">
            <p class="text-sm font-medium">Dokumen ditambahkan</p>
            <p class="text-xs text-gray-500">5 Jan 2023</p>
          </div>
          <p class="text-xs text-gray-500 mt-1">Diubah oleh: Admin WRI</p>
          <p class="text-sm mt-1">Upload dokumen SPPT terbaru</p>
          <div class="mt-2 flex items-center">
            <i class="fas fa-file-image text-green-500 mr-2"></i>
            <span class="text-sm">SPPT_2023.jpg</span>
            <a href="#" class="ml-auto text-blue-500 text-sm"><i class="fas fa-download"></i></a>
          </div>
        </div>
      </div>
    </div>
    
    <div class="flex justify-end mt-6">
      <button onclick="hideDetail()" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
        Tutup
      </button>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
        <button onclick="hideDeleteModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <p class="mb-6">Yakin ingin menghapus lahan ini? Data tidak bisa dikembalikan.</p>
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

</section>

<script>
  let lahanIdToDelete = null;

  function showForm() {
    document.getElementById('list-view').classList.add('hidden');
    document.getElementById('form-view').classList.remove('hidden');
    document.getElementById('detail-view').classList.add('hidden');
  }
  
  function hideForm() {
    document.getElementById('list-view').classList.remove('hidden');
    document.getElementById('form-view').classList.add('hidden');
    document.getElementById('detail-view').classList.add('hidden');
  }
  
  function showDetail(id) {
    // Di sini bisa ditambahkan AJAX untuk mengambil data detail berdasarkan ID
    document.getElementById('list-view').classList.add('hidden');
    document.getElementById('form-view').classList.add('hidden');
    document.getElementById('detail-view').classList.remove('hidden');
  }
  
  function hideDetail() {
    document.getElementById('list-view').classList.remove('hidden');
    document.getElementById('form-view').classList.add('hidden');
    document.getElementById('detail-view').classList.add('hidden');
  }
  
  function showEditForm(id) {
    // Di sini bisa ditambahkan AJAX untuk mengambil data berdasarkan ID
    document.getElementById('form-title').textContent = 'Edit Lahan ' + id;
    document.getElementById('list-view').classList.add('hidden');
    document.getElementById('form-view').classList.remove('hidden');
    document.getElementById('detail-view').classList.add('hidden');
  }

  function showDeleteModal(id) {
    lahanIdToDelete = id;
    document.getElementById('delete-modal').classList.remove('hidden');
  }

  function hideDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
    lahanIdToDelete = null;
  }

  function proceedDelete() {
    if (lahanIdToDelete) {
      // Tampilkan pesan (ini hanya contoh, nanti bisa diganti dengan AJAX)
      alert('Lahan ' + lahanIdToDelete + ' berhasil dihapus');
      
      // Sembunyikan modal
      hideDeleteModal();
      
      // Di sini nanti bisa ditambahkan AJAX untuk menghapus dari database
      // Setelah berhasil hapus, bisa di-refresh halaman atau hapus baris tabel
    }
  }
  
  // Aktifkan select batas lahan ketika checkbox dicentang
  document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const select = this.nextElementSibling.nextElementSibling;
      select.disabled = !this.checked;
    });
  });
</script>

<?php include 'footer.php'; ?>