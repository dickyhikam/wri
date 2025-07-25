<?php
// nkt.php
include 'header.php';
?>

<!-- Main Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <div class="container mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Data NKT</h1>
      </div>
      <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Data
      </button>
    </div>
    
    <!-- Submenu Tabs -->
    <div class="flex space-x-4 mb-8 border-b border-gray-200">
       <a href="monitoring.php" @click="currentMenu = 'hcv'" class="block px-4 py-2 rounded-md hover:bg-white-300 hover:text-black">Monitoring NKT 1 & 4</a>
       <a href="patok.php" @click="currentMenu = 'hcv'" class="block px-4 py-2 rounded-md hover:bg-white-300 hover:text-black">Patok Sempadan</a>
       <a href="potensi.php" @click="currentMenu = 'hcv'" class="block px-4 py-2 rounded-md hover:bg-white-300 hover:text-black">Potensi Kebakaran</a>
    </div>


    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <div class="p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-semibold">Daftar Pengukuran NKT</h2>
          <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari data..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md text-sm w-64">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis NKT</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parameter</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Plot</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Informasi Plot</th>
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
      <h3 id="modalTitle" class="text-lg font-semibold mb-4">Tambah Data NKT</h3>
      
      <form id="dataForm" onsubmit="saveData(event)">
        <input type="hidden" id="editId">
        
        <div class="mb-4">
          <label for="jenisNkt" class="block text-sm font-medium text-gray-700 mb-1">Jenis NKT</label>
          <select id="jenisNkt" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
            <option value="" selected disabled>Pilih Jenis</option>
            <option value="NKT Sawit">NKT Sawit</option>
            <option value="NKT Karet">NKT Karet</option>
          </select>
        </div>
        
        <div class="mb-4">
          <label for="parameter" class="block text-sm font-medium text-gray-700 mb-1">Parameter</label>
          <input type="text" id="parameter" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
        </div>
        
        <div class="mb-4">
          <label for="noPlot" class="block text-sm font-medium text-gray-700 mb-1">No Plot</label>
          <input type="text" id="noPlot" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
        </div>
        
        <div class="mb-4">
          <label for="infoPlot" class="block text-sm font-medium text-gray-700 mb-1">Informasi Plot</label>
          <textarea id="infoPlot" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
  <div class="modal-box bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="p-6">
      <h3 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h3>
      <p id="deleteMessage" class="mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
      
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
let nktData = JSON.parse(localStorage.getItem('nktData')) || [
  {
    id: 1,
    jenisNkt: 'NKT Sawit',
    parameter: 'Kerapatan 85%',
    noPlot: 'PLT-001',
    infoPlot: 'Lahan Utara Blok A\nKoordinat: -2.55, 118.01'
  },
  {
    id: 2,
    jenisNkt: 'NKT Karet',
    parameter: 'Kerapatan 78%',
    noPlot: 'PLT-002',
    infoPlot: 'Lahan Selatan Blok B\nKoordinat: -2.56, 118.02'
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
function renderTable(data = nktData) {
  dataTable.innerHTML = '';
  
  if (data.length === 0) {
    dataTable.innerHTML = `
      <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
      </tr>
    `;
    return;
  }
  
  data.forEach(item => {
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
          item.jenisNkt === 'NKT Sawit' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'
        }">
          ${item.jenisNkt}
        </span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${item.parameter}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${item.noPlot}
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">${item.infoPlot.replace('\n', '<br>')}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button onclick="editData(${item.id})" class="text-yellow-600 hover:text-yellow-900 mr-3">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="showDeleteModal(${item.id})" class="text-red-600 hover:text-red-900">
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
  const filteredData = nktData.filter(item => 
    item.jenisNkt.toLowerCase().includes(searchTerm) ||
    item.parameter.toLowerCase().includes(searchTerm) ||
    item.noPlot.toLowerCase().includes(searchTerm) ||
    item.infoPlot.toLowerCase().includes(searchTerm)
  );
  renderTable(filteredData);
});

// Modal functions
function openAddModal() {
  document.getElementById('modalTitle').textContent = 'Tambah Data NKT';
  document.getElementById('dataForm').reset();
  document.getElementById('editId').value = '';
  dataModal.style.display = 'flex';
}

function openEditModal(data) {
  document.getElementById('modalTitle').textContent = 'Edit Data NKT';
  document.getElementById('editId').value = data.id;
  document.getElementById('jenisNkt').value = data.jenisNkt;
  document.getElementById('parameter').value = data.parameter;
  document.getElementById('noPlot').value = data.noPlot;
  document.getElementById('infoPlot').value = data.infoPlot;
  dataModal.style.display = 'flex';
}

function closeModal() {
  dataModal.style.display = 'none';
}

function showDeleteModal(id) {
  currentDeleteId = id;
  const item = nktData.find(item => item.id === id);
  document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus data ${item.noPlot} (${item.jenisNkt})?`;
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
  const jenisNkt = document.getElementById('jenisNkt').value;
  const parameter = document.getElementById('parameter').value;
  const noPlot = document.getElementById('noPlot').value;
  const infoPlot = document.getElementById('infoPlot').value;
  
  if (id) {
    // Edit existing data
    const index = nktData.findIndex(item => item.id === parseInt(id));
    if (index !== -1) {
      nktData[index] = { id: parseInt(id), jenisNkt, parameter, noPlot, infoPlot };
    }
  } else {
    // Add new data
    const newId = nktData.length > 0 ? Math.max(...nktData.map(item => item.id)) + 1 : 1;
    nktData.push({ id: newId, jenisNkt, parameter, noPlot, infoPlot });
  }
  
  saveDataToLocalStorage();
  renderTable();
  closeModal();
}

function editData(id) {
  const data = nktData.find(item => item.id === id);
  if (data) {
    openEditModal(data);
  }
}

function confirmDelete() {
  nktData = nktData.filter(item => item.id !== currentDeleteId);
  saveDataToLocalStorage();
  renderTable();
  closeDeleteModal();
}

// Local Storage
function saveDataToLocalStorage() {
  localStorage.setItem('nktData', JSON.stringify(nktData));
}
</script>

<?php
include 'footer.php';
?>