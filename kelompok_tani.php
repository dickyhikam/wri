<?php
// kelompok_tani.php
include 'header.php';
?>

<!-- Main Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <div class="container mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kelompok Tani</h1>
        <p class="text-sm text-gray-600">Daftar kelompok tani terdaftar</p>
      </div>
      <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Kelompok
      </button>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Cari Berdasarkan</label>
          <select id="filterBy" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            <option value="name">Nama Kelompok</option>
            <option value="area">Wilayah</option>
            <option value="id">ID Kelompok</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
          <input type="text" id="filterKeyword" class="w-full px-3 py-2 border border-gray-300 rounded-md">
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
          <h2 class="text-lg font-semibold">Daftar Kelompok Tani</h2>
          <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari kelompok tani..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md text-sm w-64">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelompok</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wilayah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Koordinat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Aktivitas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anggota</th>
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
      <h3 id="modalTitle" class="text-lg font-semibold mb-4">Tambah Kelompok Tani</h3>
      
      <form id="dataForm" onsubmit="saveData(event)">
        <input type="hidden" id="editId">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="mb-4">
            <label for="farmer_gr_id" class="block text-sm font-medium text-gray-700 mb-1">ID Kelompok</label>
            <input type="text" id="farmer_gr_id" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelompok</label>
            <input type="text" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="area_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Wilayah</label>
            <input type="text" id="area_wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
          </div>
          
          <div class="mb-4">
            <label for="farmer_act_id" class="block text-sm font-medium text-gray-700 mb-1">ID Aktivitas</label>
            <input type="text" id="farmer_act_id" class="w-full px-3 py-2 border border-gray-300 rounded-md">
          </div>
          
          <div class="mb-4 col-span-2">
            <label for="latlong" class="block text-sm font-medium text-gray-700 mb-1">Koordinat (Lat,Long)</label>
            <input type="text" id="latlong" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Contoh: -6.2088,106.8456">
          </div>
          
          <div class="mb-4 col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea id="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
          </div>
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
        <h3 id="detailTitle" class="text-lg font-semibold">Detail Kelompok Tani</h3>
        <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div>
          <p class="text-sm text-gray-500">ID Kelompok</p>
          <p id="detailFarmerGrId" class="font-medium">-</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Nama Kelompok</p>
          <p id="detailName" class="font-medium">-</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Wilayah</p>
          <p id="detailArea" class="font-medium">-</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">ID Aktivitas</p>
          <p id="detailFarmerActId" class="font-medium">-</p>
        </div>
        <div class="col-span-2">
          <p class="text-sm text-gray-500">Koordinat</p>
          <p id="detailLatlong" class="font-medium">-</p>
        </div>
        <div class="col-span-2">
          <p class="text-sm text-gray-500">Deskripsi</p>
          <p id="detailDescription" class="font-medium">-</p>
        </div>
        <div class="col-span-2">
          <p class="text-sm text-gray-500">Jumlah Anggota</p>
          <p id="detailMemberCount" class="font-medium">-</p>
        </div>
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
      <p id="deleteMessage" class="mb-6">Apakah Anda yakin ingin menghapus kelompok tani ini?</p>
      
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
let kelompokTaniData = JSON.parse(localStorage.getItem('kelompokTaniData')) || [
  {
    farmer_gr_id: "GR001",
    name: "Kelompok Tani Maju Jaya",
    latlong: "-0.6786,101.9440",
    area_wilayah: "Berumbung Baru",
    farmer_act_id: "ACT001",
    description: "Kelompok tani sawit di daerah Berumbung Baru",
    members: 25
  },
  {
    farmer_gr_id: "GR002",
    name: "Kelompok Tani Sejahtera",
    latlong: "-0.6859,101.9503",
    area_wilayah: "Dayun",
    farmer_act_id: "ACT002",
    description: "Kelompok tani sawit di kecamatan Dayun",
    members: 18
  }
];

let anggotaData = [
  { farmer_gr_id: "GR001", name: "Petani 1", nik: "1408060907930001" },
  { farmer_gr_id: "GR001", name: "Petani 2", nik: "1408062006890001" },
  { farmer_gr_id: "GR002", name: "Petani 3", nik: "1408060402870001" }
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
  saveDataToLocalStorage();
});

// Render table with data
function renderTable(data = kelompokTaniData) {
  dataTable.innerHTML = '';
  
  if (data.length === 0) {
    dataTable.innerHTML = `
      <tr>
        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data kelompok tani</td>
      </tr>
    `;
    return;
  }
  
  data.forEach(item => {
    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${item.farmer_gr_id}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        ${item.name}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${item.area_wilayah}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${item.latlong || '-'}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${item.farmer_act_id || '-'}
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        ${countMembers(item.farmer_gr_id)} anggota
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button onclick="showDetailModal('${item.farmer_gr_id}')" class="text-blue-600 hover:text-blue-900 mr-3" title="Detail">
          <i class="fas fa-eye"></i>
        </button>
        <button onclick="editData('${item.farmer_gr_id}')" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
          <i class="fas fa-edit"></i>
        </button>
        <button onclick="showDeleteModal('${item.farmer_gr_id}')" class="text-red-600 hover:text-red-900" title="Hapus">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    dataTable.appendChild(row);
  });
}

// Count members in a group
function countMembers(farmer_gr_id) {
  return anggotaData.filter(member => member.farmer_gr_id === farmer_gr_id).length;
}

// Search functionality
searchInput.addEventListener('input', (e) => {
  const searchTerm = e.target.value.toLowerCase();
  const filteredData = kelompokTaniData.filter(item => 
    item.farmer_gr_id.toLowerCase().includes(searchTerm) ||
    item.name.toLowerCase().includes(searchTerm) ||
    item.area_wilayah.toLowerCase().includes(searchTerm) ||
    (item.farmer_act_id && item.farmer_act_id.toLowerCase().includes(searchTerm)) ||
    (item.latlong && item.latlong.toLowerCase().includes(searchTerm))
  );
  renderTable(filteredData);
});

// Filter functionality
function applyFilters() {
  const filterBy = document.getElementById('filterBy').value;
  const keyword = document.getElementById('filterKeyword').value.toLowerCase();
  
  let filteredData = kelompokTaniData;
  
  if (keyword) {
    filteredData = filteredData.filter(item => {
      if (filterBy === 'name') {
        return item.name.toLowerCase().includes(keyword);
      } else if (filterBy === 'area') {
        return item.area_wilayah.toLowerCase().includes(keyword);
      } else if (filterBy === 'id') {
        return item.farmer_gr_id.toLowerCase().includes(keyword);
      }
      return true;
    });
  }
  
  renderTable(filteredData);
}

// Modal functions
function openAddModal() {
  document.getElementById('modalTitle').textContent = 'Tambah Kelompok Tani';
  document.getElementById('dataForm').reset();
  document.getElementById('editId').value = '';
  dataModal.style.display = 'flex';
}

function openEditModal(data) {
  document.getElementById('modalTitle').textContent = 'Edit Kelompok Tani';
  document.getElementById('editId').value = data.farmer_gr_id;
  document.getElementById('farmer_gr_id').value = data.farmer_gr_id;
  document.getElementById('name').value = data.name;
  document.getElementById('area_wilayah').value = data.area_wilayah;
  document.getElementById('farmer_act_id').value = data.farmer_act_id || '';
  document.getElementById('latlong').value = data.latlong || '';
  document.getElementById('description').value = data.description || '';
  
  dataModal.style.display = 'flex';
}

function closeModal() {
  dataModal.style.display = 'none';
}

function showDetailModal(id) {
  const item = kelompokTaniData.find(item => item.farmer_gr_id === id);
  if (item) {
    document.getElementById('detailTitle').textContent = `Detail Kelompok ${item.name}`;
    document.getElementById('detailFarmerGrId').textContent = item.farmer_gr_id;
    document.getElementById('detailName').textContent = item.name;
    document.getElementById('detailArea').textContent = item.area_wilayah;
    document.getElementById('detailFarmerActId').textContent = item.farmer_act_id || '-';
    document.getElementById('detailLatlong').textContent = item.latlong || '-';
    document.getElementById('detailDescription').textContent = item.description || '-';
    document.getElementById('detailMemberCount').textContent = `${countMembers(item.farmer_gr_id)} anggota`;
    
    detailModal.style.display = 'flex';
  }
}

function closeDetailModal() {
  detailModal.style.display = 'none';
}

function showDeleteModal(id) {
  currentDeleteId = id;
  const item = kelompokTaniData.find(item => item.farmer_gr_id === id);
  document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus kelompok tani ${item.name} (${item.farmer_gr_id})?`;
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
  const farmer_gr_id = document.getElementById('farmer_gr_id').value;
  const name = document.getElementById('name').value;
  const area_wilayah = document.getElementById('area_wilayah').value;
  const farmer_act_id = document.getElementById('farmer_act_id').value;
  const latlong = document.getElementById('latlong').value;
  const description = document.getElementById('description').value;
  
  if (id) {
    // Edit existing data
    const index = kelompokTaniData.findIndex(item => item.farmer_gr_id === id);
    if (index !== -1) {
      kelompokTaniData[index] = { 
        farmer_gr_id,
        name,
        area_wilayah,
        farmer_act_id,
        latlong,
        description,
        members: kelompokTaniData[index].members // Preserve member count
      };
    }
  } else {
    // Add new data
    kelompokTaniData.push({ 
      farmer_gr_id,
      name,
      area_wilayah,
      farmer_act_id,
      latlong,
      description,
      members: 0 // Default to 0 members
    });
  }
  
  saveDataToLocalStorage();
  renderTable();
  closeModal();
}

function editData(id) {
  const data = kelompokTaniData.find(item => item.farmer_gr_id === id);
  if (data) {
    openEditModal(data);
  }
}

function confirmDelete() {
  kelompokTaniData = kelompokTaniData.filter(item => item.farmer_gr_id !== currentDeleteId);
  // Also remove members of this group
  anggotaData = anggotaData.filter(member => member.farmer_gr_id !== currentDeleteId);
  saveDataToLocalStorage();
  renderTable();
  closeDeleteModal();
}

// Local Storage
function saveDataToLocalStorage() {
  localStorage.setItem('kelompokTaniData', JSON.stringify(kelompokTaniData));
  localStorage.setItem('anggotaData', JSON.stringify(anggotaData));
}
</script>

<?php
include 'footer.php';
?>