<?php
// transaksi_panen.php
include 'header.php';
?>

<!-- Main Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <div class="container mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Transaksi Panen</h1>
        <p class="text-sm text-gray-600">Catatan transaksi hasil panen</p>
      </div>
      <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Transaksi
      </button>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
          <input type="date" id="filterStartDate" class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
          <input type="date" id="filterEndDate" class="w-full px-3 py-2 border border-gray-300 rounded-md">
        </div>
        <div class="flex items-end">
          <button onclick="applyFilters()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md w-full">
            Filter
          </button>
        </div>
      </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-semibold">Daftar Transaksi Panen</h2>
          <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari transaksi..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md text-sm w-64">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mills</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volume (kg)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
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
  <div class="modal-box bg-white rounded-lg shadow-xl w-full max-w-2xl">
    <div class="p-6">
      <h3 id="modalTitle" class="text-lg font-semibold mb-4">Tambah Transaksi Panen</h3>
      
      <form id="dataForm" onsubmit="saveData(event)">
        <input type="hidden" id="editId">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="mb-4">
            <label for="lahan_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan</label>
            <select id="lahan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
              <option value="" selected disabled>Pilih Lahan</option>
              <!-- Options akan diisi oleh JavaScript -->
            </select>
          </div>
          
          <div class="mb-4">
            <label for="petani" class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
            <input type="text" id="petani" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
          </div>
          
          <div class="mb-4">
            <label for="ics" class="block text-sm font-medium text-gray-700 mb-1">ICS</label>
            <input type="text" id="ics" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
          </div>
          
          <div class="mb-4">
            <label for="mills_id" class="block text-sm font-medium text-gray-700 mb-1">Mills</label>
            <select id="mills_id" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
              <option value="" selected disabled>Pilih Mills</option>
              <!-- Options akan diisi oleh JavaScript -->
            </select>
          </div>
          
          <div class="mb-4">
            <label for="pengepul_id" class="block text-sm font-medium text-gray-700 mb-1">Pengepul</label>
            <select id="pengepul_id" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
              <option value="" selected disabled>Pilih Pengepul</option>
              <!-- Options akan diisi oleh JavaScript -->
            </select>
          </div>
          
          <div class="mb-4">
            <label for="tgl_panen" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Panen</label>
            <input type="date" id="tgl_panen" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="tgl_transaksi" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transaksi</label>
            <input type="date" id="tgl_transaksi" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="volume" class="block text-sm font-medium text-gray-700 mb-1">Volume (kg)</label>
            <input type="number" step="0.01" id="volume" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="harga_satuan" class="block text-sm font-medium text-gray-700 mb-1">Harga Satuan (Rp)</label>
            <input type="number" id="harga_satuan" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="total" class="block text-sm font-medium text-gray-700 mb-1">Total (Rp)</label>
            <input type="number" id="total" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
          </div>
          
          <div class="mb-4">
            <label for="luas_lahan" class="block text-sm font-medium text-gray-700 mb-1">Luas Lahan (ha)</label>
            <input type="number" step="0.01" id="luas_lahan" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
        
          <div class="mb-4">
            <label for="berkas_transaksi" class="block text-sm font-medium text-gray-700 mb-1">Upload Berkas Transaksi (PDF/JPG)</label>
            <input type="file" id="berkas_transaksi" accept=".pdf,.jpg,.jpeg" class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
        </div>
        
        <div class="mb-4">
          <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
          <textarea id="catatan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
          <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
  <div class="modal-box bg-white rounded-lg shadow-xl w-full max-w-2xl">
    <div class="p-6">
      <div class="flex justify-between items-start mb-4">
        <h3 id="detailTitle" class="text-lg font-semibold">Detail Transaksi Panen</h3>
        <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
          <p class="text-sm text-gray-500">ID Transaksi</p>
          <p id="detailId" class="font-medium">TRX-0001</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Panen</p>
          <p id="detailTglPanen" class="font-medium">15/05/2023</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Lahan</p>
          <p id="detailLahan" class="font-medium">Lahan A</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Mills</p>
          <p id="detailMills" class="font-medium">Mills X</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Petani</p>
          <p id="detailPetani" class="font-medium">-</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">ICS</p>
          <p id="detailIcs" class="font-medium">-</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Pengepul</p>
          <p id="detailPengepul" class="font-medium">Pengepul 1</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Transaksi</p>
          <p id="detailTglTransaksi" class="font-medium">16/05/2023</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Volume</p>
          <p id="detailVolume" class="font-medium">1,500 kg</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Harga Satuan</p>
          <p id="detailHargaSatuan" class="font-medium">Rp 5,000</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Total</p>
          <p id="detailTotal" class="font-medium">Rp 7,500,000</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Luas Lahan</p>
          <p id="detailLuasLahan" class="font-medium">2.5 ha</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Produktivitas</p>
          <p id="detailProduktivitas" class="font-medium">600 kg/ha</p>
        </div>
      </div>
      
      <div class="mb-4">
        <p class="text-sm text-gray-500">Berkas Transaksi</p>
        <a id="detailBerkasLink" href="#" target="_blank" class="text-blue-600 hover:text-blue-800">
          <i class="fas fa-file-pdf mr-1"></i> <span id="detailBerkas">berkas1.pdf</span>
        </a>
      </div>
      
      <div class="mb-4">
        <p class="text-sm text-gray-500">Catatan</p>
        <p id="detailCatatan" class="text-gray-800">Panen rutin musim kemarau</p>
      </div>
      
      <div class="flex justify-end space-x-3 mt-6">
        <button onclick="closeDetailModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
  <div class="modal-box bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="p-6">
      <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
      <p id="deleteMessage" class="mb-6">Apakah Anda yakin ingin menghapus transaksi ini?</p>
      
      <div class="flex justify-end space-x-3">
        <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
          Batal
        </button>
        <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
          Hapus
        </button>
      </div>
    </div>
  </div>
</div>

<script>
// Data Storage (simpan di localStorage)
let transaksiData = JSON.parse(localStorage.getItem('transaksiPanenData')) || [
  {
    transaction_id: 1,
    lahan_id: 1,
    mills_id: 1,
    pengepul_id: 1,
    volume: 1500,
    harga_satuan: 5000,
    total: 7500000,
    luas_lahan: 2.5,
    tgl_panen: '2023-05-15',
    tgl_transaksi: '2023-05-16',
    berkas_transaksi: 'berkas1.pdf',
    catatan: 'Panen rutin musim kemarau'
  }
];

let lahanData = [
  { id: 1, nama: 'Lahan A', petani: 'Petani Budi', ics: 'ICS-001' },
  { id: 2, nama: 'Lahan B', petani: 'Petani Siti', ics: 'ICS-002' }
];

let millsData = [
  { id: 1, nama: 'Mills X' },
  { id: 2, nama: 'Mills Y' }
];

let pengepulData = [
  { id: 1, nama: 'Pengepul 1' },
  { id: 2, nama: 'Pengepul 2' }
];

// DOM Elements
const dataTable = document.getElementById('dataTable');
const searchInput = document.getElementById('searchInput');
const dataModal = document.getElementById('dataModal');
const detailModal = document.getElementById('detailModal');
const deleteModal = document.getElementById('deleteModal');
let currentDeleteId = null;

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
  renderTable();
  populateDropdowns();
  saveDataToLocalStorage();
  
  // Set tanggal default ke hari ini
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('tgl_panen').value = today;
  document.getElementById('tgl_transaksi').value = today;
  
  // Reset total
  document.getElementById('total').value = '0';
  
  // Event listener untuk update petani dan ICS saat lahan dipilih
  document.getElementById('lahan_id').addEventListener('change', function() {
    const selectedLahanId = this.value;
    const selectedLahan = lahanData.find(l => l.id == selectedLahanId);
    
    // Update petani field
    document.getElementById('petani').value = selectedLahan ? selectedLahan.petani : 'Tidak Diketahui';
    
    // Update ICS field
    document.getElementById('ics').value = selectedLahan ? selectedLahan.ics : 'Tidak Diketahui';
  });
  
  // Hitung total otomatis saat harga atau volume berubah
  document.getElementById('harga_satuan').addEventListener('input', calculateTotal);
  document.getElementById('volume').addEventListener('input', calculateTotal);
});

// Hitung total
function calculateTotal() {
  const volume = parseFloat(document.getElementById('volume').value) || 0;
  const hargaSatuan = parseFloat(document.getElementById('harga_satuan').value) || 0;
  const total = volume * hargaSatuan;
  document.getElementById('total').value = total.toLocaleString('id-ID');
}

// Populate dropdown options
function populateDropdowns() {
  const lahanSelect = document.getElementById('lahan_id');
  const millsSelect = document.getElementById('mills_id');
  const pengepulSelect = document.getElementById('pengepul_id');
  
  // Clear existing options
  lahanSelect.innerHTML = '<option value="" selected disabled>Pilih Lahan</option>';
  millsSelect.innerHTML = '<option value="" selected disabled>Pilih Mills</option>';
  pengepulSelect.innerHTML = '<option value="" selected disabled>Pilih Pengepul</option>';
  
  // Add lahan options
  lahanData.forEach(lahan => {
    const option = document.createElement('option');
    option.value = lahan.id;
    option.textContent = lahan.nama;
    lahanSelect.appendChild(option);
  });
  
  // Add mills options
  millsData.forEach(mills => {
    const option = document.createElement('option');
    option.value = mills.id;
    option.textContent = mills.nama;
    millsSelect.appendChild(option);
  });
  
  // Add pengepul options
  pengepulData.forEach(pengepul => {
    const option = document.createElement('option');
    option.value = pengepul.id;
    option.textContent = pengepul.nama;
    pengepulSelect.appendChild(option);
  });
}

// Format date to DD/MM/YYYY
function formatDate(dateString) {
  const date = new Date(dateString);
  const day = date.getDate().toString().padStart(2, '0');
  const month = (date.getMonth() + 1).toString().padStart(2, '0');
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

// Format currency
function formatCurrency(amount) {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount);
}

// Format number with thousand separator
function formatNumber(num) {
  return new Intl.NumberFormat('id-ID').format(num);
}

// Get nama by id
function getNamaById(data, id) {
  const item = data.find(item => item.id == id);
  return item ? item.nama : 'Tidak Diketahui';
}

// Get petani by lahan id
function getPetaniByLahanId(id) {
  const lahan = lahanData.find(item => item.id == id);
  return lahan ? lahan.petani : 'Tidak Diketahui';
}

// Get ICS by lahan id
function getIcsByLahanId(id) {
  const lahan = lahanData.find(item => item.id == id);
  return lahan ? lahan.ics : 'Tidak Diketahui';
}

// Render table with data
function renderTable(data = transaksiData) {
  dataTable.innerHTML = '';
  
  if (data.length === 0) {
    dataTable.innerHTML = `
      <tr>
        <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data transaksi</td>
      </tr>
    `;
    return;
  }
  
  // Urutkan berdasarkan tanggal panen terbaru
  data.sort((a, b) => new Date(b.tgl_panen) - new Date(a.tgl_panen));
  
  data.forEach(item => {
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        TRX-${item.transaction_id.toString().padStart(4, '0')}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${formatDate(item.tgl_panen)}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${getNamaById(lahanData, item.lahan_id)}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${getPetaniByLahanId(item.lahan_id)}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${getIcsByLahanId(item.lahan_id)}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${getNamaById(millsData, item.mills_id)}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${formatNumber(item.volume)} kg
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${formatCurrency(item.total)}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button onclick="showDetailModal(${item.transaction_id})" class="text-blue-600 hover:text-blue-900 mr-3" title="Detail">
          <i class="fas fa-eye"></i>
        </button>
        <button onclick="editData(${item.transaction_id})" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="showDeleteModal(${item.transaction_id})" class="text-red-600 hover:text-red-900" title="Hapus">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    dataTable.appendChild(row);
  });
}

// Search functionality
searchInput.addEventListener('input', (e) => {
  const searchTerm = e.target.value.toLowerCase();
  const filteredData = transaksiData.filter(item => 
    item.transaction_id.toString().includes(searchTerm) ||
    getNamaById(lahanData, item.lahan_id).toLowerCase().includes(searchTerm) ||
    getPetaniByLahanId(item.lahan_id).toLowerCase().includes(searchTerm) ||
    getIcsByLahanId(item.lahan_id).toLowerCase().includes(searchTerm) ||
    getNamaById(millsData, item.mills_id).toLowerCase().includes(searchTerm) ||
    getNamaById(pengepulData, item.pengepul_id).toLowerCase().includes(searchTerm) ||
    item.volume.toString().includes(searchTerm) ||
    item.catatan.toLowerCase().includes(searchTerm)
  );
  renderTable(filteredData);
});

// Filter functionality
function applyFilters() {
  const startDate = document.getElementById('filterStartDate').value;
  const endDate = document.getElementById('filterEndDate').value;
  
  let filteredData = transaksiData;
  
  if (startDate) {
    filteredData = filteredData.filter(item => item.tgl_panen >= startDate);
  }
  
  if (endDate) {
    filteredData = filteredData.filter(item => item.tgl_panen <= endDate);
  }
  
  renderTable(filteredData);
}

// Modal functions
function openAddModal() {
  document.getElementById('modalTitle').textContent = 'Tambah Transaksi Panen';
  document.getElementById('dataForm').reset();
  document.getElementById('editId').value = '';
  
  // Set tanggal default ke hari ini
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('tgl_panen').value = today;
  document.getElementById('tgl_transaksi').value = today;
  
  // Reset total, petani, dan ICS
  document.getElementById('total').value = '0';
  document.getElementById('petani').value = '';
  document.getElementById('ics').value = '';
  
  dataModal.style.display = 'flex';
}

function openEditModal(data) {
  document.getElementById('modalTitle').textContent = 'Edit Transaksi Panen';
  document.getElementById('editId').value = data.transaction_id;
  document.getElementById('lahan_id').value = data.lahan_id;
  
  // Set petani dan ICS berdasarkan lahan yang dipilih
  const lahan = lahanData.find(l => l.id == data.lahan_id);
  document.getElementById('petani').value = lahan ? lahan.petani : 'Tidak Diketahui';
  document.getElementById('ics').value = lahan ? lahan.ics : 'Tidak Diketahui';
  
  document.getElementById('mills_id').value = data.mills_id;
  document.getElementById('pengepul_id').value = data.pengepul_id;
  document.getElementById('tgl_panen').value = data.tgl_panen;
  document.getElementById('tgl_transaksi').value = data.tgl_transaksi;
  document.getElementById('volume').value = data.volume;
  document.getElementById('harga_satuan').value = data.harga_satuan;
  document.getElementById('total').value = data.total;
  document.getElementById('luas_lahan').value = data.luas_lahan;
  document.getElementById('catatan').value = data.catatan || '';
  
  dataModal.style.display = 'flex';
}

function closeModal() {
  dataModal.style.display = 'none';
}

function showDetailModal(id) {
  const item = transaksiData.find(item => item.transaction_id === id);
  if (item) {
    // Get lahan info
    const lahan = lahanData.find(l => l.id == item.lahan_id);
    
    // Calculate productivity (kg/ha)
    const produktivitas = item.luas_lahan > 0 ? (item.volume / item.luas_lahan).toFixed(2) : 0;
    
    // Set detail modal content
    document.getElementById('detailTitle').textContent = `Detail Transaksi TRX-${item.transaction_id.toString().padStart(4, '0')}`;
    document.getElementById('detailId').textContent = `TRX-${item.transaction_id.toString().padStart(4, '0')}`;
    document.getElementById('detailTglPanen').textContent = formatDate(item.tgl_panen);
    document.getElementById('detailLahan').textContent = getNamaById(lahanData, item.lahan_id);
    document.getElementById('detailPetani').textContent = lahan ? lahan.petani : 'Tidak Diketahui';
    document.getElementById('detailIcs').textContent = lahan ? lahan.ics : 'Tidak Diketahui';
    document.getElementById('detailMills').textContent = getNamaById(millsData, item.mills_id);
    document.getElementById('detailPengepul').textContent = getNamaById(pengepulData, item.pengepul_id);
    document.getElementById('detailTglTransaksi').textContent = formatDate(item.tgl_transaksi);
    document.getElementById('detailVolume').textContent = `${formatNumber(item.volume)} kg`;
    document.getElementById('detailHargaSatuan').textContent = formatCurrency(item.harga_satuan);
    document.getElementById('detailTotal').textContent = formatCurrency(item.total);
    document.getElementById('detailLuasLahan').textContent = `${item.luas_lahan} ha`;
    document.getElementById('detailProduktivitas').textContent = `${formatNumber(produktivitas)} kg/ha`;
    
    // Handle berkas transaksi
    if (item.berkas_transaksi) {
      document.getElementById('detailBerkas').textContent = item.berkas_transaksi;
      document.getElementById('detailBerkasLink').href = `#${item.berkas_transaksi}`;
      document.getElementById('detailBerkasLink').style.display = 'inline-block';
    } else {
      document.getElementById('detailBerkas').textContent = 'Tidak ada berkas';
      document.getElementById('detailBerkasLink').style.display = 'none';
    }
    
    // Handle catatan
    document.getElementById('detailCatatan').textContent = item.catatan || 'Tidak ada catatan';
    
    // Show modal
    detailModal.style.display = 'flex';
  }
}

function closeDetailModal() {
  detailModal.style.display = 'none';
}

function showDeleteModal(id) {
  currentDeleteId = id;
  const item = transaksiData.find(item => item.transaction_id === id);
  document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus transaksi panen TRX-${item.transaction_id.toString().padStart(4, '0')} pada ${formatDate(item.tgl_panen)}?`;
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
  const lahan_id = document.getElementById('lahan_id').value;
  const mills_id = document.getElementById('mills_id').value;
  const pengepul_id = document.getElementById('pengepul_id').value;
  const tgl_panen = document.getElementById('tgl_panen').value;
  const tgl_transaksi = document.getElementById('tgl_transaksi').value;
  const volume = parseFloat(document.getElementById('volume').value);
  const harga_satuan = parseFloat(document.getElementById('harga_satuan').value);
  const total = parseFloat(document.getElementById('total').value.replace(/[^0-9]/g, ''));
  const luas_lahan = parseFloat(document.getElementById('luas_lahan').value);
  const berkas_transaksi = document.getElementById('berkas_transaksi').files[0]?.name || '';
  const catatan = document.getElementById('catatan').value;
  
  if (id) {
    // Edit existing data
    const index = transaksiData.findIndex(item => item.transaction_id === parseInt(id));
    if (index !== -1) {
      transaksiData[index] = { 
        transaction_id: parseInt(id),
        lahan_id,
        mills_id,
        pengepul_id,
        volume,
        harga_satuan,
        total,
        luas_lahan,
        tgl_panen,
        tgl_transaksi,
        berkas_transaksi: berkas_transaksi || transaksiData[index].berkas_transaksi,
        catatan
      };
    }
  } else {
    // Add new data
    const newId = transaksiData.length > 0 ? Math.max(...transaksiData.map(item => item.transaction_id)) + 1 : 1;
    transaksiData.push({ 
      transaction_id: newId,
      lahan_id,
      mills_id,
      pengepul_id,
      volume,
      harga_satuan,
      total,
      luas_lahan,
      tgl_panen,
      tgl_transaksi,
      berkas_transaksi,
      catatan
    });
  }
  
  saveDataToLocalStorage();
  renderTable();
  closeModal();
}

function editData(id) {
  const data = transaksiData.find(item => item.transaction_id === id);
  if (data) {
    openEditModal(data);
  }
}

function confirmDelete() {
  transaksiData = transaksiData.filter(item => item.transaction_id !== currentDeleteId);
  saveDataToLocalStorage();
  renderTable();
  closeDeleteModal();
}

// Local Storage
function saveDataToLocalStorage() {
  localStorage.setItem('transaksiPanenData', JSON.stringify(transaksiData));
}
</script>

<?php
include 'footer.php';
?>