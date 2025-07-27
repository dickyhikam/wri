<?php include 'header.php'; ?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
  <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <div class="">
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-bold mb-2">Data Mitra</h2>
        </div>
        <div class="flex space-x-4">
          <!-- Tombol Tambah Mills (default visible) -->
          <button id="addMillsBtn" onclick="openMillsModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Mitra Mills
          </button>
          <!-- Tombol Tambah Pengepul (default hidden) -->
          <button id="addPengepulBtn" onclick="openPengepulModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
            <i class="fas fa-plus mr-2"></i> Tambah Mitra Pengepul
          </button>
        </div>
      </div>
    </div>
    <br>
    <!-- Submodule Navigation -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-100">
      <nav class="flex space-x-4" aria-label="Tabs">
        <button id="tabMills" class="px-3 py-2 font-medium text-sm rounded-md bg-blue-100 text-blue-700">
          Mitra Mills
        </button>
        <button id="tabPengepul" class="px-3 py-2 font-medium text-sm rounded-md text-gray-500 hover:text-gray-700">
          Mitra Pengepul
        </button>
      </nav>
    </div>

    <!-- Mitra Mills Section -->
    <div id="millsSection">
      <!-- Filter Section -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
          <form class="flex flex-wrap gap-4">
            <div class="flex-1">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchMills" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama mitra...">
              </div>
            </div>
            <div class="flex space-x-4">
              <select id="filterParent" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Perusahaan Induk</option>
                <option value="PT Perkebunan Nusantara">PT Perkebunan Nusantara</option>
                <option value="PT Sinar Mas">PT Sinar Mas</option>
                <option value="PT Astra Agro">PT Astra Agro</option>
              </select>
              <select id="filterProvinsi" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Provinsi</option>
                <option value="Sumatera Utara">Sumatera Utara</option>
                <option value="Riau">Riau</option>
                <option value="Sumatera Selatan">Sumatera Selatan</option>
              </select>
              <select id="filterKabupaten" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kabupaten</option>
                <option value="Dumai">Dumai</option>
                <option value="Siak">Siak</option>
                <option value="Inhu">Inhu</option>
              </select>
              <button type="button" onclick="filterMitra('mills')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-filter mr-2"></i> Filter
              </button>
              <button type="button" onclick="resetFilter('mills')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-sync-alt mr-2"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Mitra Mills Table -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pabrik</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan Induk</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody id="mitraMillsTableBody" class="bg-white divide-y divide-gray-200">
              <!-- Data will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-xl">
        <div class="flex-1 flex justify-between sm:hidden">
          <button onclick="previousPage('mills')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Previous
          </button>
          <button onclick="nextPage('mills')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Next
          </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p id="millsPaginationInfo" class="text-sm text-gray-700">
              Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <button onclick="previousPage('mills')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left"></i>
              </button>
              <div id="millsPaginationNumbers" class="flex">
                <!-- Pagination numbers will be inserted here -->
              </div>
              <button onclick="nextPage('mills')" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <i class="fas fa-chevron-right"></i>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Mitra Pengepul Section (Hidden by default) -->
    <div id="pengepulSection" class="hidden">
      <!-- Filter Section -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b">
          <form class="flex flex-wrap gap-4">
            <div class="flex-1">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchPengepul" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama pengepul...">
              </div>
            </div>
            <div class="flex space-x-4">
              <select id="filterProvinsiPengepul" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Provinsi</option>
                <option value="Riau">Riau</option>
                <option value="Sumatera Utara">Sumatera Utara</option>
                <option value="Sumatera Selatan">Sumatera Selatan</option>
              </select>
              <select id="filterKabupatenPengepul" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kabupaten</option>
                <option value="Inhu">Inhu</option>
                <option value="Siak">Siak</option>
                <option value="Dumai">Dumai</option>
              </select>
              <select id="filterStatusPengepul" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
              <button type="button" onclick="filterMitra('pengepul')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-filter mr-2"></i> Filter
              </button>
              <button type="button" onclick="resetFilter('pengepul')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-sync-alt mr-2"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Mitra Pengepul Table -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengepul</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Area Wilayah</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody id="mitraPengepulTableBody" class="bg-white divide-y divide-gray-200">
              <!-- Data will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-xl">
        <div class="flex-1 flex justify-between sm:hidden">
          <button onclick="previousPage('pengepul')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Previous
          </button>
          <button onclick="nextPage('pengepul')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Next
          </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p id="pengepulPaginationInfo" class="text-sm text-gray-700">
              Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <button onclick="previousPage('pengepul')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <i class="fas fa-chevron-left"></i>
              </button>
              <div id="pengepulPaginationNumbers" class="flex">
                <!-- Pagination numbers will be inserted here -->
              </div>
              <button onclick="nextPage('pengepul')" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <i class="fas fa-chevron-right"></i>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Modal Tambah/Edit Mitra Mills -->
<div id="millsModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
            <i class="fas fa-industry text-white"></i>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h3 id="millsModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Mitra Mills Baru</h3>
            <div class="mt-2">
              <form id="millsForm">
                <input type="hidden" id="millsId">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="millsName">Nama Pabrik</label>
                    <input type="text" id="millsName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  </div>
                  
                  <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="millsLocation">Lokasi</label>
                    <input type="text" id="millsLocation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="millsParentCompany">Perusahaan Induk</label>
                    <select id="millsParentCompany" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option value="">Pilih Perusahaan Induk</option>
                      <option value="PT Perkebunan Nusantara">PT Perkebunan Nusantara</option>
                      <option value="PT Sinar Mas">PT Sinar Mas</option>
                      <option value="PT Astra Agro">PT Astra Agro</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="millsCapacity">Kapasitas (ton/hari)</label>
                    <input type="number" id="millsCapacity" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="saveMillsBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm">
          Simpan
        </button>
        <button type="button" onclick="closeMillsModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah/Edit Mitra Pengepul -->
<div id="pengepulModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
            <i class="fas fa-truck text-white"></i>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h3 id="pengepulModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Mitra Pengepul Baru</h3>
            <div class="mt-2">
              <form id="pengepulForm">
                <input type="hidden" id="pengepulId">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="pengepulCode">Kode</label>
                    <input type="text" id="pengepulCode" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="pengepulName">Nama Pengepul</label>
                    <input type="text" id="pengepulName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  </div>
                  
                  <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="pengepulLocation">Lokasi</label>
                    <input type="text" id="pengepulLocation" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="pengepulArea">Area Wilayah</label>
                    <select id="pengepulArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option value="">Pilih Area Wilayah</option>
                      <option value="Wilayah 1">Wilayah 1</option>
                      <option value="Wilayah 2">Wilayah 2</option>
                      <option value="Wilayah 3">Wilayah 3</option>
                    </select>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="pengepulStatus">Status</label>
                    <select id="pengepulStatus" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="savePengepulBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm">
          Simpan
        </button>
        <button type="button" onclick="closePengepulModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hapus Mitra -->
<div id="deleteMitraModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
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
            <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Mitra</h3>
            <div class="mt-2">
              <p id="deleteMitraMessage" class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus mitra ini?</p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" onclick="confirmDeleteMitra()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
          Hapus
        </button>
        <button type="button" onclick="closeDeleteMitraModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Data
let mitraMillsData = [
  {id: 1, name: 'PT Sawit Maju Sejahtera', parent_company: 'PT Agro Sejahtera', kapasitas: 1200, location: 'Desa Bukit Kapur, Kec. Bukit Kapur, Kab. Dumai', status: 'Aktif'},
  {id: 2, name: 'PT Palma Andalas', parent_company: 'PT Palma Group', kapasitas: 900, location: 'Desa Sungai Apit, Kec. Sungai Apit, Kab. Siak', status: 'Aktif'},
  {id: 3, name: 'PT Perkebunan Nusantara V', parent_company: 'PT Perkebunan Nusantara', kapasitas: 1500, location: 'Pekanbaru, Riau', status: 'Aktif'},
  {id: 4, name: 'PT Sinar Mas Agro', parent_company: 'PT Sinar Mas', kapasitas: 1800, location: 'Dumai, Riau', status: 'Aktif'},
  {id: 5, name: 'PT Astra Agro Lestari', parent_company: 'PT Astra Agro', kapasitas: 2000, location: 'Siak, Riau', status: 'Aktif'},
  {id: 6, name: 'PT Bumi Pratama Khatulistiwa', parent_company: 'Lainnya', kapasitas: 800, location: 'Inhu, Riau', status: 'Aktif'},
  {id: 7, name: 'PT Sawit Mas Sejahtera', parent_company: 'PT Sinar Mas', kapasitas: 950, location: 'Sumatera Utara', status: 'Aktif'},
  {id: 8, name: 'PT Agro Indomas', parent_company: 'Lainnya', kapasitas: 1100, location: 'Sumatera Selatan', status: 'Aktif'},
  {id: 9, name: 'PT Sawit Harapan Lestari', parent_company: 'PT Palma Group', kapasitas: 750, location: 'Dumai, Riau', status: 'Aktif'},
  {id: 10, name: 'PT Bina Sawit Makmur', parent_company: 'PT Perkebunan Nusantara', kapasitas: 1300, location: 'Siak, Riau', status: 'Aktif'},
  {id: 11, name: 'PT Sawit Jaya Abadi', parent_company: 'PT Astra Agro', kapasitas: 1600, location: 'Pekanbaru, Riau', status: 'Aktif'}
];

let mitraPengepulData = [
  {id: 1, kode: 'P001', name: 'UD Tani Barokah', location: 'Desa Air Molek, Kec. Pasir Penyu, Kab. Inhu', area_wilayah: 'Wilayah 3', status: 'Aktif'},
  {id: 2, kode: 'P002', name: 'CV Sumber Rezeki', location: 'Desa Pangkalan Pisang, Kec. Koto Gasib, Kab. Siak', area_wilayah: 'Wilayah 1', status: 'Tidak Aktif'},
  {id: 3, kode: 'P003', name: 'UD Makmur Jaya', location: 'Dumai, Riau', area_wilayah: 'Wilayah 2', status: 'Aktif'},
  {id: 4, kode: 'P004', name: 'CV Tani Sejahtera', location: 'Pekanbaru, Riau', area_wilayah: 'Wilayah 1', status: 'Aktif'},
  {id: 5, kode: 'P005', name: 'UD Sawit Lestari', location: 'Siak, Riau', area_wilayah: 'Wilayah 3', status: 'Aktif'},
  {id: 6, kode: 'P006', name: 'CV Mitra Tani', location: 'Inhu, Riau', area_wilayah: 'Wilayah 2', status: 'Tidak Aktif'},
  {id: 7, kode: 'P007', name: 'UD Barokah Makmur', location: 'Sumatera Utara', area_wilayah: 'Wilayah 1', status: 'Aktif'},
  {id: 8, kode: 'P008', name: 'CV Sumber Hasil', location: 'Sumatera Selatan', area_wilayah: 'Wilayah 3', status: 'Aktif'},
  {id: 9, kode: 'P009', name: 'UD Tani Makmur', location: 'Dumai, Riau', area_wilayah: 'Wilayah 2', status: 'Aktif'},
  {id: 10, kode: 'P010', name: 'CV Sawit Jaya', location: 'Siak, Riau', area_wilayah: 'Wilayah 1', status: 'Aktif'},
  {id: 11, kode: 'P011', name: 'UD Maju Bersama', location: 'Pekanbaru, Riau', area_wilayah: 'Wilayah 3', status: 'Tidak Aktif'}
];

// Pagination Settings
const itemsPerPage = 10;
let currentMillsPage = 1;
let currentPengepulPage = 1;
let filteredMillsData = [...mitraMillsData];
let filteredPengepulData = [...mitraPengepulData];

// DOM Elements
let tabMills, tabPengepul, millsSection, pengepulSection, mitraMillsTableBody, mitraPengepulTableBody, addMillsBtn, addPengepulBtn;
let currentMitraId = null;
let currentMitraType = null;

// Fungsi untuk menginisialisasi DOM elements
function initializeDOM() {
  tabMills = document.getElementById('tabMills');
  tabPengepul = document.getElementById('tabPengepul');
  millsSection = document.getElementById('millsSection');
  pengepulSection = document.getElementById('pengepulSection');
  mitraMillsTableBody = document.getElementById('mitraMillsTableBody');
  mitraPengepulTableBody = document.getElementById('mitraPengepulTableBody');
  addMillsBtn = document.getElementById('addMillsBtn');
  addPengepulBtn = document.getElementById('addPengepulBtn');
}

// Fungsi untuk mengatur event listeners
function setupEventListeners() {
  // Tab switching
  tabMills.addEventListener('click', () => {
    tabMills.classList.add('bg-blue-100', 'text-blue-700');
    tabMills.classList.remove('text-gray-500', 'hover:text-gray-700');
    tabPengepul.classList.add('text-gray-500', 'hover:text-gray-700');
    tabPengepul.classList.remove('bg-blue-100', 'text-blue-700');
    millsSection.classList.remove('hidden');
    pengepulSection.classList.add('hidden');
    addMillsBtn.classList.remove('hidden');
    addPengepulBtn.classList.add('hidden');
    
    filteredMillsData = [...mitraMillsData];
    renderMitraMillsTable();
    updateMillsPagination();
  });
  
  tabPengepul.addEventListener('click', () => {
    tabPengepul.classList.add('bg-blue-100', 'text-blue-700');
    tabPengepul.classList.remove('text-gray-500', 'hover:text-gray-700');
    tabMills.classList.add('text-gray-500', 'hover:text-gray-700');
    tabMills.classList.remove('bg-blue-100', 'text-blue-700');
    pengepulSection.classList.remove('hidden');
    millsSection.classList.add('hidden');
    addPengepulBtn.classList.remove('hidden');
    addMillsBtn.classList.add('hidden');
    
    filteredPengepulData = [...mitraPengepulData];
    renderMitraPengepulTable();
    updatePengepulPagination();
  });
  
  // Save buttons
  document.getElementById('saveMillsBtn').addEventListener('click', saveMills);
  document.getElementById('savePengepulBtn').addEventListener('click', savePengepul);
  
  // Search functionality
  document.getElementById('searchMills').addEventListener('input', () => filterMitra('mills'));
  document.getElementById('searchPengepul').addEventListener('input', () => filterMitra('pengepul'));
}

// Fungsi untuk inisialisasi awal
function initializeApp() {
  initializeDOM();
  setupEventListeners();
  
  // Set data filtered
  filteredMillsData = [...mitraMillsData];
  filteredPengepulData = [...mitraPengepulData];
  
  // Render tables
  renderMitraMillsTable();
  renderMitraPengepulTable();
  updateMillsPagination();
  updatePengepulPagination();
  
  // Aktifkan tab Mills secara default
  tabMills.click();
}

// Filter Function
function filterMitra(type) {
  if (type === 'mills') {
    const parent = document.getElementById('filterParent').value;
    const provinsi = document.getElementById('filterProvinsi').value;
    const kabupaten = document.getElementById('filterKabupaten').value;
    const search = document.getElementById('searchMills').value.toLowerCase();
    
    filteredMillsData = mitraMillsData.filter(m => {
      const matchesParent = parent ? m.parent_company === parent : true;
      const matchesProvinsi = provinsi ? m.location.includes(provinsi) : true;
      const matchesKabupaten = kabupaten ? m.location.includes(kabupaten) : true;
      const matchesSearch = search ? 
        (m.name.toLowerCase().includes(search) || 
         m.location.toLowerCase().includes(search)) : true;
      
      return matchesParent && matchesProvinsi && matchesKabupaten && matchesSearch;
    });
    
    currentMillsPage = 1;
    renderMitraMillsTable();
    updateMillsPagination();
  } else {
    const provinsi = document.getElementById('filterProvinsiPengepul').value;
    const kabupaten = document.getElementById('filterKabupatenPengepul').value;
    const status = document.getElementById('filterStatusPengepul').value;
    const search = document.getElementById('searchPengepul').value.toLowerCase();
    
    filteredPengepulData = mitraPengepulData.filter(m => {
      const matchesProvinsi = provinsi ? m.location.includes(provinsi) : true;
      const matchesKabupaten = kabupaten ? m.location.includes(kabupaten) : true;
      const matchesStatus = status ? m.status === status : true;
      const matchesSearch = search ? 
        (m.name.toLowerCase().includes(search) || 
         m.location.toLowerCase().includes(search) ||
         m.kode.toLowerCase().includes(search)) : true;
      
      return matchesProvinsi && matchesKabupaten && matchesStatus && matchesSearch;
    });
    
    currentPengepulPage = 1;
    renderMitraPengepulTable();
    updatePengepulPagination();
  }
}

// Reset Filter Function
function resetFilter(type) {
  if (type === 'mills') {
    document.getElementById('searchMills').value = '';
    document.getElementById('filterParent').value = '';
    document.getElementById('filterProvinsi').value = '';
    document.getElementById('filterKabupaten').value = '';
    
    filteredMillsData = [...mitraMillsData];
    currentMillsPage = 1;
    renderMitraMillsTable();
    updateMillsPagination();
  } else {
    document.getElementById('searchPengepul').value = '';
    document.getElementById('filterProvinsiPengepul').value = '';
    document.getElementById('filterKabupatenPengepul').value = '';
    document.getElementById('filterStatusPengepul').value = '';
    
    filteredPengepulData = [...mitraPengepulData];
    currentPengepulPage = 1;
    renderMitraPengepulTable();
    updatePengepulPagination();
  }
}

// Render Tables with Pagination
function renderMitraMillsTable() {
  mitraMillsTableBody.innerHTML = '';

  const startIndex = (currentMillsPage - 1) * itemsPerPage;
  const endIndex = Math.min(startIndex + itemsPerPage, filteredMillsData.length);
  const currentData = filteredMillsData.slice(startIndex, endIndex);

  if (currentData.length === 0) {
    mitraMillsTableBody.innerHTML = '<tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data mitra mills</td></tr>';
    return;
  }

  currentData.forEach((mitra, index) => {
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${startIndex + index + 1}</td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">${mitra.name}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitra.parent_company}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitra.kapasitas} ton/hari
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitra.location}
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
          ${mitra.status}
        </span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button onclick="openMillsModal(${mitra.id})" class="text-blue-600 hover:text-blue-900 mr-3">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="openDeleteModal('mills', ${mitra.id})" class="text-red-600 hover:text-red-900">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    `;
    mitraMillsTableBody.appendChild(row);
  });
}

function renderMitraPengepulTable() {
  mitraPengepulTableBody.innerHTML = '';

  const startIndex = (currentPengepulPage - 1) * itemsPerPage;
  const endIndex = Math.min(startIndex + itemsPerPage, filteredPengepulData.length);
  const currentData = filteredPengepulData.slice(startIndex, endIndex);

  if (currentData.length === 0) {
    mitraPengepulTableBody.innerHTML = '<tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data mitra pengepul</td></tr>';
    return;
  }

  currentData.forEach((mitra, index) => {
    const statusClass = mitra.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
    
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${startIndex + index + 1}</td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitra.kode}
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">${mitra.name}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitra.location}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitra.area_wilayah}
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
          ${mitra.status}
        </span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button onclick="openPengepulModal(${mitra.id})" class="text-blue-600 hover:text-blue-900 mr-3">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="openDeleteModal('pengepul', ${mitra.id})" class="text-red-600 hover:text-red-900">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    `;
    mitraPengepulTableBody.appendChild(row);
  });
}

// Pagination Functions
function updateMillsPagination() {
  const totalItems = filteredMillsData.length;
  const totalPages = Math.ceil(totalItems / itemsPerPage);
  const startItem = (currentMillsPage - 1) * itemsPerPage + 1;
  const endItem = Math.min(currentMillsPage * itemsPerPage, totalItems);
  
  // Update pagination info
  document.getElementById('millsPaginationInfo').innerHTML = `
    Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of <span class="font-medium">${totalItems}</span> results
  `;
  
  // Update pagination numbers
  const paginationNumbers = document.getElementById('millsPaginationNumbers');
  paginationNumbers.innerHTML = '';
  
  // Always show first page
  addPaginationNumber('mills', 1);
  
  // Show ellipsis if needed
  if (currentMillsPage > 3) {
    const ellipsis = document.createElement('span');
    ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
    ellipsis.textContent = '...';
    paginationNumbers.appendChild(ellipsis);
  }
  
  // Show current page and neighbors
  const startPage = Math.max(2, currentMillsPage - 1);
  const endPage = Math.min(totalPages - 1, currentMillsPage + 1);
  
  for (let i = startPage; i <= endPage; i++) {
    addPaginationNumber('mills', i);
  }
  
  // Show ellipsis if needed
  if (currentMillsPage < totalPages - 2) {
    const ellipsis = document.createElement('span');
    ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
    ellipsis.textContent = '...';
    paginationNumbers.appendChild(ellipsis);
  }
  
  // Always show last page if there's more than one page
  if (totalPages > 1) {
    addPaginationNumber('mills', totalPages);
  }
}

function updatePengepulPagination() {
  const totalItems = filteredPengepulData.length;
  const totalPages = Math.ceil(totalItems / itemsPerPage);
  const startItem = (currentPengepulPage - 1) * itemsPerPage + 1;
  const endItem = Math.min(currentPengepulPage * itemsPerPage, totalItems);
  
  // Update pagination info
  document.getElementById('pengepulPaginationInfo').innerHTML = `
    Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of <span class="font-medium">${totalItems}</span> results
  `;
  
  // Update pagination numbers
  const paginationNumbers = document.getElementById('pengepulPaginationNumbers');
  paginationNumbers.innerHTML = '';
  
  // Always show first page
  addPaginationNumber('pengepul', 1);
  
  // Show ellipsis if needed
  if (currentPengepulPage > 3) {
    const ellipsis = document.createElement('span');
    ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
    ellipsis.textContent = '...';
    paginationNumbers.appendChild(ellipsis);
  }
  
  // Show current page and neighbors
  const startPage = Math.max(2, currentPengepulPage - 1);
  const endPage = Math.min(totalPages - 1, currentPengepulPage + 1);
  
  for (let i = startPage; i <= endPage; i++) {
    addPaginationNumber('pengepul', i);
  }
  
  // Show ellipsis if needed
  if (currentPengepulPage < totalPages - 2) {
    const ellipsis = document.createElement('span');
    ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
    ellipsis.textContent = '...';
    paginationNumbers.appendChild(ellipsis);
  }
  
  // Always show last page if there's more than one page
  if (totalPages > 1) {
    addPaginationNumber('pengepul', totalPages);
  }
}

function addPaginationNumber(type, page) {
  const paginationNumbers = document.getElementById(`${type}PaginationNumbers`);
  const isCurrent = (type === 'mills' ? currentMillsPage : currentPengepulPage) === page;
  
  const pageButton = document.createElement('button');
  pageButton.onclick = () => goToPage(type, page);
  pageButton.className = `relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
    isCurrent 
      ? 'z-10 bg-[#f0ab00] border-[#f0ab00] text-white' 
      : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
  }`;
  pageButton.textContent = page;
  
  paginationNumbers.appendChild(pageButton);
}

function goToPage(type, page) {
  if (type === 'mills') {
    currentMillsPage = page;
    renderMitraMillsTable();
    updateMillsPagination();
  } else {
    currentPengepulPage = page;
    renderMitraPengepulTable();
    updatePengepulPagination();
  }
}

function previousPage(type) {
  if (type === 'mills' && currentMillsPage > 1) {
    currentMillsPage--;
    renderMitraMillsTable();
    updateMillsPagination();
  } else if (type === 'pengepul' && currentPengepulPage > 1) {
    currentPengepulPage--;
    renderMitraPengepulTable();
    updatePengepulPagination();
  }
}

function nextPage(type) {
  const totalPages = type === 'mills' 
    ? Math.ceil(filteredMillsData.length / itemsPerPage)
    : Math.ceil(filteredPengepulData.length / itemsPerPage);
  
  if (type === 'mills' && currentMillsPage < totalPages) {
    currentMillsPage++;
    renderMitraMillsTable();
    updateMillsPagination();
  } else if (type === 'pengepul' && currentPengepulPage < totalPages) {
    currentPengepulPage++;
    renderMitraPengepulTable();
    updatePengepulPagination();
  }
}

// Mills Modal Functions
function openMillsModal(id = null) {
  if (id) {
    const mitra = mitraMillsData.find(m => m.id === id);
    if (mitra) {
      document.getElementById('millsModalTitle').textContent = 'Edit Data Mitra Mills';
      document.getElementById('millsId').value = mitra.id;
      document.getElementById('millsName').value = mitra.name;
      document.getElementById('millsLocation').value = mitra.location;
      document.getElementById('millsParentCompany').value = mitra.parent_company;
      document.getElementById('millsCapacity').value = mitra.kapasitas;
    }
  } else {
    document.getElementById('millsModalTitle').textContent = 'Tambah Mitra Mills Baru';
    document.getElementById('millsForm').reset();
    document.getElementById('millsId').value = '';
  }
  
  document.getElementById('millsModal').classList.remove('hidden');
}

function closeMillsModal() {
  document.getElementById('millsModal').classList.add('hidden');
}

function saveMills() {
  const id = document.getElementById('millsId').value;
  const data = {
    name: document.getElementById('millsName').value,
    location: document.getElementById('millsLocation').value,
    parent_company: document.getElementById('millsParentCompany').value,
    kapasitas: parseFloat(document.getElementById('millsCapacity').value),
    status: 'Aktif'
  };
  
  // Validation
  if (!data.name || !data.location || !data.parent_company || !data.kapasitas) {
    alert('Harap isi semua field yang wajib!');
    return;
  }
  
  if (id) {
    // Update existing mills
    const index = mitraMillsData.findIndex(m => m.id == id);
    if (index !== -1) {
      mitraMillsData[index] = { ...mitraMillsData[index], ...data };
    }
  } else {
    // Add new mills
    const newId = mitraMillsData.length > 0 ? Math.max(...mitraMillsData.map(m => m.id)) + 1 : 1;
    mitraMillsData.push({ id: newId, ...data });
  }
  
  filteredMillsData = [...mitraMillsData];
  currentMillsPage = 1;
  renderMitraMillsTable();
  updateMillsPagination();
  closeMillsModal();
}

// Pengepul Modal Functions
function openPengepulModal(id = null) {
  if (id) {
    const mitra = mitraPengepulData.find(m => m.id === id);
    if (mitra) {
      document.getElementById('pengepulModalTitle').textContent = 'Edit Data Mitra Pengepul';
      document.getElementById('pengepulId').value = mitra.id;
      document.getElementById('pengepulCode').value = mitra.kode;
      document.getElementById('pengepulName').value = mitra.name;
      document.getElementById('pengepulLocation').value = mitra.location;
      document.getElementById('pengepulArea').value = mitra.area_wilayah;
      document.getElementById('pengepulStatus').value = mitra.status;
    }
  } else {
    document.getElementById('pengepulModalTitle').textContent = 'Tambah Mitra Pengepul Baru';
    document.getElementById('pengepulForm').reset();
    document.getElementById('pengepulId').value = '';
  }
  
  document.getElementById('pengepulModal').classList.remove('hidden');
}

function closePengepulModal() {
  document.getElementById('pengepulModal').classList.add('hidden');
}

function savePengepul() {
  const id = document.getElementById('pengepulId').value;
  const data = {
    kode: document.getElementById('pengepulCode').value,
    name: document.getElementById('pengepulName').value,
    location: document.getElementById('pengepulLocation').value,
    area_wilayah: document.getElementById('pengepulArea').value,
    status: document.getElementById('pengepulStatus').value
  };
  
  // Validation
  if (!data.kode || !data.name || !data.location || !data.area_wilayah) {
    alert('Harap isi semua field yang wajib!');
    return;
  }
  
  if (id) {
    // Update existing pengepul
    const index = mitraPengepulData.findIndex(m => m.id == id);
    if (index !== -1) {
      mitraPengepulData[index] = { ...mitraPengepulData[index], ...data };
    }
  } else {
    // Add new pengepul
    const newId = mitraPengepulData.length > 0 ? Math.max(...mitraPengepulData.map(m => m.id)) + 1 : 1;
    mitraPengepulData.push({ id: newId, ...data });
  }
  
  filteredPengepulData = [...mitraPengepulData];
  currentPengepulPage = 1;
  renderMitraPengepulTable();
  updatePengepulPagination();
  closePengepulModal();
}

// Delete Functions
function openDeleteModal(type, id) {
  currentMitraType = type;
  currentMitraId = id;
  
  let mitra;
  if (type === 'mills') {
    mitra = mitraMillsData.find(m => m.id === id);
  } else {
    mitra = mitraPengepulData.find(m => m.id === id);
  }
  
  if (mitra) {
    document.getElementById('deleteMitraMessage').textContent = `Apakah Anda yakin ingin menghapus mitra ${mitra.name}?`;
    document.getElementById('deleteMitraModal').classList.remove('hidden');
  }
}

function closeDeleteMitraModal() {
  document.getElementById('deleteMitraModal').classList.add('hidden');
  currentMitraId = null;
  currentMitraType = null;
}

function confirmDeleteMitra() {
  if (currentMitraId && currentMitraType) {
    if (currentMitraType === 'mills') {
      mitraMillsData = mitraMillsData.filter(m => m.id !== currentMitraId);
      filteredMillsData = filteredMillsData.filter(m => m.id !== currentMitraId);
    } else {
      mitraPengepulData = mitraPengepulData.filter(m => m.id !== currentMitraId);
      filteredPengepulData = filteredPengepulData.filter(m => m.id !== currentMitraId);
    }
    
    if (currentMitraType === 'mills') {
      // Reset to first page if no items left on current page
      const startIndex = (currentMillsPage - 1) * itemsPerPage;
      if (startIndex >= filteredMillsData.length && currentMillsPage > 1) {
        currentMillsPage = Math.max(1, currentMillsPage - 1);
      }
      renderMitraMillsTable();
      updateMillsPagination();
    } else {
      // Reset to first page if no items left on current page
      const startIndex = (currentPengepulPage - 1) * itemsPerPage;
      if (startIndex >= filteredPengepulData.length && currentPengepulPage > 1) {
        currentPengepulPage = Math.max(1, currentPengepulPage - 1);
      }
      renderMitraPengepulTable();
      updatePengepulPagination();
    }
    
    closeDeleteMitraModal();
  }
}

// Close modals when clicking outside
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    if (document.getElementById('millsModal').classList.contains('hidden') === false) {
      closeMillsModal();
    }
    if (document.getElementById('pengepulModal').classList.contains('hidden') === false) {
      closePengepulModal();
    }
    if (document.getElementById('deleteMitraModal').classList.contains('hidden') === false) {
      closeDeleteMitraModal();
    }
  }
}

// Initialize the app when DOM is loaded
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeApp);
} else {
  initializeApp();
}
</script>

<?php include 'footer.php'; ?>