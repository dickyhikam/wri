<?php include 'header.php'; ?>

<!-- Main Content -->
<div class="flex-1 overflow-auto p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Mitra Mills</h1>
                <p class="text-gray-600 mt-2">Daftar mitra mills yang bekerja sama dengan perusahaan</p>
            </div>
            <div class="flex space-x-4">
                <button onclick="openAddModal()" class="bg-[#f0ab00] hover:bg-[#d69a00] text-white px-4 py-2 rounded-md flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Mitra Mills
                </button>
                <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md flex items-center">
                    <i class="fas fa-download mr-2"></i> Export
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Perusahaan Induk</label>
                    <select id="filterParent" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#f0ab00] focus:border-transparent">
                        <option value="">Semua</option>
                        <option value="PT Perkebunan Nusantara">PT Perkebunan Nusantara</option>
                        <option value="PT Sinar Mas">PT Sinar Mas</option>
                        <option value="PT Astra Agro">PT Astra Agro</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <select id="filterLokasi" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#f0ab00] focus:border-transparent">
                        <option value="">Semua</option>
                        <option value="Sumatera">Sumatera</option>
                        <option value="Kalimantan">Kalimantan</option>
                        <option value="Sulawesi">Sulawesi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                    <select id="filterKapasitas" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#f0ab00] focus:border-transparent">
                        <option value="">Semua</option>
                        <option value="<10">Kurang dari 10 ton/jam</option>
                        <option value="10-30">10-30 ton/jam</option>
                        <option value=">30">Lebih dari 30 ton/jam</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="filterMitraMills()" class="bg-[#403c3c] hover:bg-[#2e2b2b] text-white px-4 py-2 rounded-md w-full">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Mitra Mills Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mitra Mills</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan Induk</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="mitraMillsTableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Data will be populated by JavaScript -->
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
                        <p id="paginationInfo" class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">12</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-[#f0ab00] border-[#f0ab00] text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
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
    </div>
</div>

<!-- Modal Tambah/Edit Mitra Mills -->
<div id="mitraMillsModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
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
            <h3 id="mitraMillsModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Mitra Mills Baru</h3>
            <div class="mt-2">
              <form id="mitraMillsForm">
                <input type="hidden" id="mitraMillsId">
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="namaMitraMills">Nama Mitra Mills</label>
                  <input type="text" id="namaMitraMills" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="parentCompany">Perusahaan Induk</label>
                  <select id="parentCompany" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Pilih Perusahaan Induk</option>
                    <option value="PT Perkebunan Nusantara">PT Perkebunan Nusantara</option>
                    <option value="PT Sinar Mas">PT Sinar Mas</option>
                    <option value="PT Astra Agro">PT Astra Agro</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="lokasiMitraMills">Lokasi</label>
                  <input type="text" id="lokasiMitraMills" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="kapasitasMitraMills">Kapasitas (ton/jam)</label>
                  <input type="number" step="0.1" id="kapasitasMitraMills" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="kontakNama">Nama Kontak</label>
                  <input type="text" id="kontakNama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="kontakEmail">Email Kontak</label>
                  <input type="email" id="kontakEmail" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="saveMitraMillsBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#d69a00] sm:ml-3 sm:w-auto sm:text-sm">
          Simpan
        </button>
        <button type="button" onclick="closeMitraMillsModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Hapus Mitra Mills -->
<div id="deleteMitraMillsModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
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
            <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Mitra Mills</h3>
            <div class="mt-2">
              <p id="deleteMitraMillsMessage" class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus mitra mills ini?</p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" onclick="confirmDeleteMitraMills()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
          Hapus
        </button>
        <button type="button" onclick="closeDeleteMitraMillsModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Data Mitra Mills
let mitraMillsData = JSON.parse(localStorage.getItem('mitraMillsData')) || [
  {
    id: 1,
    name: 'PKS Sei Mangkei',
    parent_company: 'PT Perkebunan Nusantara',
    kapasitas: 45,
    location: 'Sumatera Utara, Sumatera',
    kontakNama: 'Budi Santoso',
    kontakEmail: 'budi@seimangkei.com',
    status: 'Aktif',
    tahun_kerjasama: 2018
  },
  {
    id: 2,
    name: 'PKS Kuala Lumpur',
    parent_company: 'PT Sinar Mas',
    kapasitas: 30,
    location: 'Riau, Sumatera',
    kontakNama: 'Ani Wijaya',
    kontakEmail: 'ani@klpalm.com',
    status: 'Aktif',
    tahun_kerjasama: 2020
  }
];

// DOM Elements
const mitraMillsModal = document.getElementById('mitraMillsModal');
const deleteMitraMillsModal = document.getElementById('deleteMitraMillsModal');
const saveMitraMillsBtn = document.getElementById('saveMitraMillsBtn');
const mitraMillsTableBody = document.getElementById('mitraMillsTableBody');
let currentMitraMillsId = null;

// Initialize
document.addEventListener('DOMContentLoaded', () => {
  saveMitraMillsBtn.addEventListener('click', saveMitraMills);
  renderMitraMillsTable();
  saveMitraMillsData();
});

// Modal Functions
function openAddModal() {
  document.getElementById('mitraMillsModalTitle').textContent = 'Tambah Mitra Mills Baru';
  document.getElementById('mitraMillsForm').reset();
  document.getElementById('mitraMillsId').value = '';
  mitraMillsModal.classList.remove('hidden');
}

function openEditModal(id) {
  const mitraMills = mitraMillsData.find(m => m.id === id);
  if (mitraMills) {
    document.getElementById('mitraMillsModalTitle').textContent = 'Edit Data Mitra Mills';
    document.getElementById('mitraMillsId').value = mitraMills.id;
    document.getElementById('namaMitraMills').value = mitraMills.name;
    document.getElementById('parentCompany').value = mitraMills.parent_company;
    document.getElementById('lokasiMitraMills').value = mitraMills.location;
    document.getElementById('kapasitasMitraMills').value = mitraMills.kapasitas;
    document.getElementById('kontakNama').value = mitraMills.kontakNama;
    document.getElementById('kontakEmail').value = mitraMills.kontakEmail;
    mitraMillsModal.classList.remove('hidden');
  }
}

function closeMitraMillsModal() {
  mitraMillsModal.classList.add('hidden');
}

function openDeleteModal(id) {
  const mitraMills = mitraMillsData.find(m => m.id === id);
  if (mitraMills) {
    currentMitraMillsId = id;
    document.getElementById('deleteMitraMillsMessage').textContent = `Apakah Anda yakin ingin menghapus mitra mills ${mitraMills.name}?`;
    deleteMitraMillsModal.classList.remove('hidden');
  }
}

function closeDeleteMitraMillsModal() {
  deleteMitraMillsModal.classList.add('hidden');
  currentMitraMillsId = null;
}

// CRUD Operations
function saveMitraMills() {
  const id = document.getElementById('mitraMillsId').value;
  const data = {
    name: document.getElementById('namaMitraMills').value,
    parent_company: document.getElementById('parentCompany').value,
    location: document.getElementById('lokasiMitraMills').value,
    kapasitas: parseFloat(document.getElementById('kapasitasMitraMills').value),
    kontakNama: document.getElementById('kontakNama').value,
    kontakEmail: document.getElementById('kontakEmail').value,
    status: 'Aktif',
    tahun_kerjasama: new Date().getFullYear()
  };

  // Validation
  if (!data.name || !data.parent_company || !data.location || !data.kapasitas) {
    alert('Harap isi semua field yang wajib!');
    return;
  }

  if (id) {
    // Update existing
    const index = mitraMillsData.findIndex(m => m.id == id);
    if (index !== -1) {
      mitraMillsData[index] = { ...mitraMillsData[index], ...data };
    }
  } else {
    // Add new
    const newId = mitraMillsData.length > 0 ? Math.max(...mitraMillsData.map(m => m.id)) + 1 : 1;
    mitraMillsData.push({ id: newId, ...data });
  }

  saveMitraMillsData();
  renderMitraMillsTable();
  closeMitraMillsModal();
}

function confirmDeleteMitraMills() {
  if (currentMitraMillsId) {
    mitraMillsData = mitraMillsData.filter(m => m.id !== currentMitraMillsId);
    saveMitraMillsData();
    renderMitraMillsTable();
    closeDeleteMitraMillsModal();
  }
}

// Filter Function
function filterMitraMills() {
  const parent = document.getElementById('filterParent').value;
  const lokasi = document.getElementById('filterLokasi').value;
  const kapasitas = document.getElementById('filterKapasitas').value;

  let filteredData = [...mitraMillsData];

  if (parent) {
    filteredData = filteredData.filter(m => m.parent_company === parent);
  }
  if (lokasi) {
    filteredData = filteredData.filter(m => m.location.includes(lokasi));
  }
  if (kapasitas) {
    if (kapasitas === '<10') {
      filteredData = filteredData.filter(m => m.kapasitas < 10);
    } else if (kapasitas === '10-30') {
      filteredData = filteredData.filter(m => m.kapasitas >= 10 && m.kapasitas <= 30);
    } else if (kapasitas === '>30') {
      filteredData = filteredData.filter(m => m.kapasitas > 30);
    }
  }

  renderMitraMillsTable(filteredData);
}

// Render Table
function renderMitraMillsTable(data = mitraMillsData) {
  mitraMillsTableBody.innerHTML = '';

  if (data.length === 0) {
    mitraMillsTableBody.innerHTML = '<tr><td colspan="6" class="px-6 py-4 text-center">Tidak ada data mitra mills</td></tr>';
    return;
  }

  // Update pagination info
  document.getElementById('paginationInfo').innerHTML = `
    Showing <span class="font-medium">1</span> to <span class="font-medium">${data.length}</span> of <span class="font-medium">${data.length}</span> results
  `;

  data.forEach(mitraMills => {
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
          <div class="flex-shrink-0 h-10 w-10">
            <i class="fas fa-industry text-gray-400 text-2xl"></i>
          </div>
          <div class="ml-4">
            <div class="text-sm font-medium text-gray-900">${mitraMills.name}</div>
            <div class="text-sm text-gray-500">${mitraMills.location}</div>
          </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitraMills.parent_company}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${mitraMills.location}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <div class="flex items-center">
          <div class="h-2 w-full bg-gray-200 rounded-full">
            <div class="h-2 bg-green-500 rounded-full" style="width: ${Math.min(100, (mitraMills.kapasitas / 50) * 100)}%"></div>
          </div>
          <span class="ml-2 text-sm font-medium">${mitraMills.kapasitas} ton/jam</span>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <div>${mitraMills.kontakNama}</div>
        <div class="text-gray-400">${mitraMills.kontakEmail}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button onclick="openEditModal(${mitraMills.id})" class="text-blue-600 hover:text-blue-900 mr-3">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="openDeleteModal(${mitraMills.id})" class="text-red-600 hover:text-red-900">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>
    `;
    mitraMillsTableBody.appendChild(row);
  });
}

// Save to localStorage
function saveMitraMillsData() {
  localStorage.setItem('mitraMillsData', JSON.stringify(mitraMillsData));
}

// Close modals when clicking outside
window.onclick = function(event) {
  if (event.target === mitraMillsModal) {
    closeMitraMillsModal();
  }
  if (event.target === deleteMitraMillsModal) {
    closeDeleteMitraMillsModal();
  }
}
</script>

<?php include 'footer.php'; ?>