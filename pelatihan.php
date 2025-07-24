<?php include 'header.php'; ?>

<!-- Main Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <div class="container mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h1 class="text-2xl font-bold text-gray-800">Data Pelatihan</h1>
        <p class="text-gray-600">Manajemen data pelatihan karyawan</p>
      </div>
      <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center transition duration-300">
        <i class="fas fa-plus mr-2"></i> Tambah Pelatihan
      </button>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-semibold">Daftar Pelatihan</h2>
          <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari pelatihan..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelatihan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peserta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody id="dataTable" class="bg-white divide-y divide-gray-200">
              <!-- Data akan diisi oleh JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add/Edit Modal -->
<div id="dataModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
  <div class="modal-box bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 id="modalTitle" class="text-lg font-semibold">Tambah Pelatihan</h3>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <form id="dataForm" onsubmit="saveData(event)">
        <input type="hidden" id="editId">
        
        <div class="mb-4">
          <label for="kodePelatihan" class="block text-sm font-medium text-gray-700 mb-1">Kode Pelatihan*</label>
          <input type="text" id="kodePelatihan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div class="mb-4">
          <label for="namaPelatihan" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelatihan*</label>
          <input type="text" id="namaPelatihan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <label for="jumlahPeserta" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Peserta*</label>
            <input type="number" id="jumlahPeserta" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          </div>
          <div>
            <label for="tanggalPelatihan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal*</label>
            <input type="date" id="tanggalPelatihan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
          </div>
        </div>
        
        <div class="mb-4">
          <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
          <textarea id="deskripsi" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-300">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
  <div class="modal-box bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
        <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="flex items-center mb-4">
        <div class="bg-red-100 p-3 rounded-full mr-3">
          <i class="fas fa-exclamation-circle text-red-600"></i>
        </div>
        <p id="deleteMessage" class="text-gray-700">Apakah Anda yakin ingin menghapus pelatihan ini?</p>
      </div>
      
      <div class="flex justify-end space-x-3">
        <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-300">
          Batal
        </button>
        <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition duration-300">
          Hapus
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Data Storage (simpan di localStorage)
let pelatihanData = JSON.parse(localStorage.getItem('pelatihanData')) || [
  {
    id: 1,
    kode: 'PLT-001',
    nama: 'Pelatihan Keselamatan Kerja',
    peserta: 25,
    tanggal: '2023-05-15',
    deskripsi: 'Pelatihan dasar keselamatan kerja untuk semua karyawan'
  },
  {
    id: 2,
    kode: 'PLT-002',
    nama: 'Manajemen Waktu',
    peserta: 18,
    tanggal: '2023-06-20',
    deskripsi: 'Pelatihan meningkatkan produktivitas dengan manajemen waktu'
  }
];

// DOM Elements
const dataTable = document.getElementById('dataTable');
const searchInput = document.getElementById('searchInput');
const dataModal = document.getElementById('dataModal');
const deleteModal = document.getElementById('deleteModal');
let currentDeleteId = null;

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
  renderTable();
  saveDataToLocalStorage();
});

// Render table with data
function renderTable(data = pelatihanData) {
  dataTable.innerHTML = '';
  
  if (data.length === 0) {
    dataTable.innerHTML = `
      <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data pelatihan</td>
      </tr>
    `;
    return;
  }
  
  data.forEach(item => {
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
          ${item.kode}
        </span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">${item.nama}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">${item.peserta} orang</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-500">${formatDate(item.tanggal)}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button onclick="editData(${item.id})" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="showDeleteModal(${item.id})" class="text-red-600 hover:text-red-900" title="Hapus">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    dataTable.appendChild(row);
  });
}

// Format tanggal untuk tampilan
function formatDate(dateString) {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Search functionality
searchInput.addEventListener('input', (e) => {
  const searchTerm = e.target.value.toLowerCase();
  const filteredData = pelatihanData.filter(item => 
    item.kode.toLowerCase().includes(searchTerm) ||
    item.nama.toLowerCase().includes(searchTerm) ||
    item.deskripsi.toLowerCase().includes(searchTerm)
  );
  renderTable(filteredData);
});

// Modal functions
function openAddModal() {
  document.getElementById('modalTitle').textContent = 'Tambah Pelatihan';
  document.getElementById('dataForm').reset();
  document.getElementById('editId').value = '';
  document.getElementById('tanggalPelatihan').valueAsDate = new Date();
  dataModal.style.display = 'flex';
}

function openEditModal(data) {
  document.getElementById('modalTitle').textContent = 'Edit Pelatihan';
  document.getElementById('editId').value = data.id;
  document.getElementById('kodePelatihan').value = data.kode;
  document.getElementById('namaPelatihan').value = data.nama;
  document.getElementById('jumlahPeserta').value = data.peserta;
  document.getElementById('tanggalPelatihan').value = data.tanggal;
  document.getElementById('deskripsi').value = data.deskripsi;
  dataModal.style.display = 'flex';
}

function closeModal() {
  dataModal.style.display = 'none';
}

function showDeleteModal(id) {
  currentDeleteId = id;
  const item = pelatihanData.find(item => item.id === id);
  document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus pelatihan ${item.kode} - ${item.nama}?`;
  deleteModal.style.display = 'flex';
}

function closeDeleteModal() {
  deleteModal.style.display = 'none';
  currentDeleteId = null;
}

// CRUD Operations
function saveData(event) {
  event.preventDefault();
  
  const id = document.getElementById('editId').value;
  const kode = document.getElementById('kodePelatihan').value;
  const nama = document.getElementById('namaPelatihan').value;
  const peserta = document.getElementById('jumlahPeserta').value;
  const tanggal = document.getElementById('tanggalPelatihan').value;
  const deskripsi = document.getElementById('deskripsi').value;
  
  if (id) {
    // Edit existing data
    const index = pelatihanData.findIndex(item => item.id === parseInt(id));
    if (index !== -1) {
      pelatihanData[index] = { 
        id: parseInt(id), 
        kode, 
        nama, 
        peserta: parseInt(peserta), 
        tanggal,
        deskripsi 
      };
    }
  } else {
    // Add new data
    const newId = pelatihanData.length > 0 ? Math.max(...pelatihanData.map(item => item.id)) + 1 : 1;
    pelatihanData.push({ 
      id: newId, 
      kode, 
      nama, 
      peserta: parseInt(peserta), 
      tanggal,
      deskripsi 
    });
  }
  
  saveDataToLocalStorage();
  renderTable();
  closeModal();
}

function editData(id) {
  const data = pelatihanData.find(item => item.id === id);
  if (data) {
    openEditModal(data);
  }
}

function confirmDelete() {
  pelatihanData = pelatihanData.filter(item => item.id !== currentDeleteId);
  saveDataToLocalStorage();
  renderTable();
  closeDeleteModal();
}

// Local Storage
function saveDataToLocalStorage() {
  localStorage.setItem('pelatihanData', JSON.stringify(pelatihanData));
}
</script>

<?php include 'footer.php'; ?>