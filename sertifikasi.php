<?php include 'header.php'; ?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Manajemen Sertifikasi</h2>
        <p class="opacity-90">Kelola data sertifikasi petani dan lahan sawit</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-certificate text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Notification (Contoh) -->
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert" style="display: none;" id="notification">
    <span class="block sm:inline" id="notification-message"></span>
  </div>

  <!-- Action Buttons -->
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Daftar Sertifikasi</h2>
    <button onclick="showForm('add')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
      <i class="fas fa-plus mr-2"></i> Tambah Sertifikasi
    </button>
  </div>

  <!-- Form Add/Edit (Hidden by default) -->
  <div id="certification-form" class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100" style="display: none;">
    <h3 class="text-lg font-semibold mb-4" id="form-title">Tambah Data Sertifikasi</h3>
    
    <form id="certification-form-data" onsubmit="return false;">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Program Sertifikasi -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Program Sertifikasi</label>
          <select name="program_sertifikasi" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Pilih Program</option>
            <option value="RSPO">RSPO</option>
            <option value="ISPO">ISPO</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
        
        <!-- Lahan Terkait -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Lahan Terkait</label>
          <select name="land_id" id="land_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required onchange="updateFarmerInfo(this.value)">
            <option value="">Pilih Lahan</option>
            <!-- Options will be populated by JavaScript -->
          </select>
        </div>
        
        <!-- Status Sertifikasi -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Status Sertifikasi</label>
          <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Pilih Status</option>
            <option value="Draft">Draft</option>
            <option value="Proses">Proses</option>
            <option value="Lulus">Lulus</option>
            <option value="Tidak">Tidak</option>
          </select>
        </div>
        
        <!-- Tanggal Mulai Program -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Program</label>
          <input type="date" name="tanggal_mulai" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- Tanggal Audit -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Audit</label>
          <input type="date" name="tanggal_audit" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        
        <!-- Petani Terkait (Read-only) -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Petani Terkait</label>
          <div class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
            <span id="farmer-info">-</span>
            <input type="hidden" name="farmer_id" id="farmer_id">
          </div>
        </div>
      </div>
      
      <!-- Checklist Audit -->
      <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Checklist Audit</label>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div class="flex items-center">
            <input type="checkbox" id="item_1" name="checklist_items[]" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="item_1" class="ml-2 text-sm text-gray-700">Dokumen Legalitas Lahan</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="item_2" name="checklist_items[]" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="item_2" class="ml-2 text-sm text-gray-700">Catatan Panen</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="item_3" name="checklist_items[]" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="item_3" class="ml-2 text-sm text-gray-700">Penggunaan Pupuk</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="item_4" name="checklist_items[]" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="item_4" class="ml-2 text-sm text-gray-700">Penggunaan Pestisida</label>
          </div>
          <div class="flex items-center">
            <input type="checkbox" id="item_5" name="checklist_items[]" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="item_5" class="ml-2 text-sm text-gray-700">Pelatihan Petani</label>
          </div>
        </div>
      </div>
      
      <!-- New Land Form (Hidden by default) -->
      <div id="new-land-form" class="mt-6 p-4 border border-gray-200 rounded-lg bg-gray-50" style="display: none;">
        <h4 class="text-md font-medium mb-3">Tambah Lahan Baru</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lahan</label>
            <input type="text" name="new_land_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Luas (hektar)</label>
            <input type="number" name="new_land_area" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" name="new_land_location" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Tanam</label>
            <input type="number" name="new_land_year" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
            <select name="new_land_farmer_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
              <option value="">Pilih Petani</option>
              <!-- Options will be populated by JavaScript -->
            </select>
          </div>
        </div>
      </div>
      
      <!-- Dokumen Sertifikat -->
      <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen Sertifikat</label>
        <div class="mt-1 flex items-center">
          <input type="file" name="dokumen_sertifikat" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
      </div>
      
      <!-- Form Buttons -->
      <div class="mt-8 flex justify-end space-x-3">
        <button type="button" onclick="hideForm()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
          Batal
        </button>
        <button type="button" onclick="submitForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
          Simpan
        </button>
      </div>
    </form>
  </div>

  <!-- Certification List -->
  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lahan</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="certification-table-body">
  <!-- Data akan diisi oleh JavaScript -->
  <tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">KMJ.14.08.06.2006.0001</td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm font-medium text-gray-900">RSPO</div>
      <div class="text-sm text-gray-500">Ya</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">dummy</div>
      <div class="text-sm text-gray-500">ID: 14.08.06.2006.KMJ.0001</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">Petani 1</div>
      <div class="text-sm text-gray-500">ID: KMJ.14.08.06.2006.0001</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jan 2023</td>
    <td class="px-6 py-4 whitespace-nowrap">
      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
        Lulus
      </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
      <button onclick="viewCertification(1)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
        <i class="fas fa-eye"></i>
      </button>
      <button onclick="showForm('edit', 1)" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
        <i class="fas fa-edit"></i>
      </button>
      <button onclick="confirmDelete(1)" class="text-red-600 hover:text-red-900" title="Hapus">
        <i class="fas fa-trash"></i>
      </button>
    </td>
  </tr>
  <tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">KMJ.14.08.06.2006.0002
</td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm font-medium text-gray-900">ISPO</div>
      <div class="text-sm text-gray-500">Ya</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">dummy</div>
      <div class="text-sm text-gray-500">ID: 14.08.06.2006.KMJ.0002</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">Petani 2</div>
      <div class="text-sm text-gray-500">ID: KMJ.14.08.06.2006.0002</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Feb 2023</td>
    <td class="px-6 py-4 whitespace-nowrap">
      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
        Proses
      </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
      <button onclick="viewCertification(2)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
        <i class="fas fa-eye"></i>
      </button>
      <button onclick="showForm('edit', 2)" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
        <i class="fas fa-edit"></i>
      </button>
      <button onclick="confirmDelete(2)" class="text-red-600 hover:text-red-900" title="Hapus">
        <i class="fas fa-trash"></i>
      </button>
    </td>
  </tr>
  <tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">KMJ.14.08.06.2006.0003</td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm font-medium text-gray-900">RSPO</div>
      <div class="text-sm text-gray-500">Ya</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">Dummy</div>
      <div class="text-sm text-gray-500">ID: 14.08.06.2006.KMJ.0003</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">Petani 2</div>
      <div class="text-sm text-gray-500">ID: KMJ.14.08.06.2006.0003</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05 Mar 2023</td>
    <td class="px-6 py-4 whitespace-nowrap">
      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
        Tidak
      </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
      <button onclick="viewCertification(3)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
        <i class="fas fa-eye"></i>
      </button>
      <button onclick="showForm('edit', 3)" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
        <i class="fas fa-edit"></i>
      </button>
      <button onclick="confirmDelete(3)" class="text-red-600 hover:text-red-900" title="Hapus">
        <i class="fas fa-trash"></i>
      </button>
    </td>
  </tr>
</tbody>
      </table>
    </div>
  </div>

  <!-- View Certification Modal -->
  <div id="view-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center border-b pb-3">
        <h3 class="text-lg font-semibold">Detail Sertifikasi</h3>
        <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="py-4" id="certification-detail-content">
        <!-- Detail akan diisi oleh JavaScript -->
      </div>
      
      <div class="flex justify-end pt-2 border-t">
        <button onclick="closeViewModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
          Tutup
        </button>
      </div>
    </div>
  </div>
</section>

<script>
// Data dummy untuk simulasi
// Data dummy untuk simulasi
const dummyData = {
  farmers: {
    "KMJ.14.08.06.2006.0001": { name: "Petani 1", phone: "081234567890", address: "Jl. Sawit No. 1, Desa Makmur" },
    "KMJ.14.08.06.2006.0002": { name: "Petani 2", phone: "082345678901", address: "Jl. Kelapa Sawit No. 5, Desa Sejahtera" },
    "KMJ.14.08.06.2006.0003": { name: "Petani 3", phone: "083456789012", address: "Jl. Sawit Baru No. 10, Desa Baru" }
  },
  lands: {
    "14.08.06.2006.KMJ.0001": { farmer_id: "KMJ.14.08.06.2006.0001", name: "Kebun Sawit Jaya", area: 5.2, location: "Desa Makmur", year: 2018 },
    "14.08.06.2006.KMJ.0002": { farmer_id: "KMJ.14.08.06.2006.0002", name: "Kebun Makmur", area: 7.8, location: "Desa Sejahtera", year: 2017 },
    "14.08.06.2006.KMJ.0003": { farmer_id: "KMJ.14.08.06.2006.0002", name: "Lahan Selatan", area: 4.2, location: "Desa Baru", year: 2019 }
  },
  certifications: [
    {
      certification_id: 1,
      program_sertifikasi: "RSPO",
      daftar_rspo: "Ya",
      tanggal_mulai: "2023-01-15",
      tanggal_audit: "2023-06-20",
      status: "Lulus",
      farmer_id: "KMJ.14.08.06.2006.0001",
      land_id: "14.08.06.2006.KMJ.0001",
      checklist_items: [1, 2, 3, 5],
      dokumen_sertifikat: true
    },
    {
      certification_id: 2,
      program_sertifikasi: "ISPO",
      daftar_rspo: "Ya",
      tanggal_mulai: "2023-02-20",
      tanggal_audit: "2023-07-15",
      status: "Proses",
      farmer_id: "KMJ.14.08.06.2006.0002",
      land_id: "14.08.06.2006.KMJ.0002",
      checklist_items: [1, 2, 4],
      dokumen_sertifikat: false
    },
    {
      certification_id: 3,
      program_sertifikasi: "RSPO",
      daftar_rspo: "Ya",
      tanggal_mulai: "2023-03-05",
      tanggal_audit: "2023-08-10",
      status: "Tidak",
      farmer_id: "KMJ.14.08.06.2006.0002",
      land_id: "14.08.06.2006.KMJ.0003",
      checklist_items: [1, 3],
      dokumen_sertifikat: true
    }
  ]
};

// Update informasi petani berdasarkan lahan yang dipilih
function updateFarmerInfo(landId) {
  const farmerInfo = document.getElementById('farmer-info');
  const farmerIdInput = document.getElementById('farmer_id');
  const newLandForm = document.getElementById('new-land-form');
  
  if (landId === "new") {
    // Tampilkan form lahan baru
    newLandForm.style.display = 'block';
    // Kosongkan info petani
    farmerInfo.textContent = '-';
    farmerIdInput.value = '';
    
    // Isi dropdown petani untuk lahan baru
    // Isi dropdown petani untuk lahan baru
const farmerSelect = document.querySelector('select[name="new_land_farmer_id"]');
farmerSelect.innerHTML = '<option value="">Pilih Petani</option>';

for (const [id, farmer] of Object.entries(dummyData.farmers)) {
  farmerSelect.innerHTML += `<option value="${id}">${farmer.name} (ID: ${id})</option>`;
}
  } else if (landId) {
    // Sembunyikan form lahan baru
    newLandForm.style.display = 'none';
    
    // Dapatkan data lahan
    const land = dummyData.lands[landId];
    if (land) {
      // Dapatkan data petani
      const farmer = dummyData.farmers[land.farmer_id];
      if (farmer) {
        farmerInfo.textContent = `${farmer.name} (ID: ${land.farmer_id})`;
        farmerIdInput.value = land.farmer_id;
      } else {
        farmerInfo.textContent = 'Petani tidak ditemukan';
        farmerIdInput.value = '';
      }
    } else {
      farmerInfo.textContent = '-';
      farmerIdInput.value = '';
    }
  } else {
    // Kosongkan info petani
    farmerInfo.textContent = '-';
    farmerIdInput.value = '';
    // Sembunyikan form lahan baru
    newLandForm.style.display = 'none';
  }
}

// Tampilkan form tambah/edit
function showForm(action, id = null) {
  const form = document.getElementById('certification-form');
  const formTitle = document.getElementById('form-title');
  const formElement = document.getElementById('certification-form-data');
  const newLandForm = document.getElementById('new-land-form');
  const landSelect = document.getElementById('land_id');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  // Sembunyikan tabel
  tableContainer.style.display = 'none';
  
  if (action === 'add') {
    formTitle.textContent = 'Tambah Data Sertifikasi';
    formElement.reset();
    // Reset checklist
    document.querySelectorAll('input[name="checklist_items[]"]').forEach(checkbox => {
      checkbox.checked = false;
    });
    // Sembunyikan form lahan baru
    newLandForm.style.display = 'none';
    // Reset opsi lahan
    landSelect.innerHTML = '<option value="">Pilih Lahan</option>';
    
    // Isi dropdown lahan
    for (const [id, land] of Object.entries(dummyData.lands)) {
      const farmer = dummyData.farmers[land.farmer_id] || { name: 'Tidak diketahui' };
      landSelect.innerHTML += `<option value="${id}">${land.name} (${farmer.name})</option>`;
    }
    
    // Tambahkan opsi untuk lahan baru
    landSelect.innerHTML += '<option value="new">Tambah Lahan Baru</option>';
    
    // Reset info petani
    document.getElementById('farmer-info').textContent = '-';
    document.getElementById('farmer_id').value = '';
  } else if (action === 'edit' && id) {
    formTitle.textContent = 'Edit Data Sertifikasi';
    const cert = dummyData.certifications.find(c => c.certification_id === id);
    if (cert) {
      // Isi form dengan data sertifikasi
      formElement.program_sertifikasi.value = cert.program_sertifikasi;
      formElement.tanggal_mulai.value = cert.tanggal_mulai;
      formElement.tanggal_audit.value = cert.tanggal_audit;
      formElement.status.value = cert.status;
      
      // Set lahan yang dipilih
      formElement.land_id.value = cert.land_id;
      
      // Update info petani berdasarkan lahan
      updateFarmerInfo(cert.land_id);
      
      // Set checklist items
      document.querySelectorAll('input[name="checklist_items[]"]').forEach(checkbox => {
        checkbox.checked = cert.checklist_items.includes(parseInt(checkbox.value));
      });
      
      // Isi dropdown lahan
      landSelect.innerHTML = '<option value="">Pilih Lahan</option>';
      for (const [id, land] of Object.entries(dummyData.lands)) {
        const farmer = dummyData.farmers[land.farmer_id] || { name: 'Tidak diketahui' };
        landSelect.innerHTML += `<option value="${id}">${land.name} (${farmer.name})</option>`;
      }
      
      // Tambahkan opsi untuk lahan baru
      landSelect.innerHTML += '<option value="new">Tambah Lahan Baru</option>';
    }
  }
  
  form.style.display = 'block';
  window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
}

// Sembunyikan form
function hideForm() {
  const form = document.getElementById('certification-form');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  form.style.display = 'none';
  // Tampilkan kembali tabel
  tableContainer.style.display = 'block';
}

// Submit form (simulasi)
function submitForm() {
  const form = document.getElementById('certification-form-data');
  const landId = form.land_id.value;
  
  if (landId === "new") {
    // Simpan data lahan baru
    const newLand = {
      farmer_id: parseInt(form.new_land_farmer_id.value),
      name: form.new_land_name.value,
      area: parseFloat(form.new_land_area.value),
      location: form.new_land_location.value,
      year: parseInt(form.new_land_year.value)
    };
    
    // Tambahkan ke data dummy (dalam implementasi nyata, ini akan API call)
    const newLandId = Object.keys(dummyData.lands).length + 1;
    dummyData.lands[newLandId] = newLand;
    
    showNotification('Data lahan dan sertifikasi baru berhasil disimpan', 'success');
  } else {
    showNotification('Data sertifikasi berhasil disimpan', 'success');
  }
  
  hideForm();
}

// Konfirmasi hapus
function confirmDelete(id) {
  if (confirm('Apakah Anda yakin ingin menghapus data sertifikasi ini?')) {
    showNotification('Data sertifikasi berhasil dihapus', 'success');
  }
}

// Tampilkan notifikasi
function showNotification(message, type = 'success') {
  const notification = document.getElementById('notification');
  const notificationMessage = document.getElementById('notification-message');
  
  notificationMessage.textContent = message;
  notification.style.display = 'block';
  
  // Set warna notifikasi berdasarkan type
  if (type === 'success') {
    notification.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6';
  } else if (type === 'error') {
    notification.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6';
  }
  
  // Hilangkan notifikasi setelah 3 detik
  setTimeout(() => {
    notification.style.display = 'none';
  }, 3000);
}

// Tampilkan modal view
function viewCertification(id) {
  const cert = dummyData.certifications.find(c => c.certification_id === id);
  if (cert) {
    const modal = document.getElementById('view-modal');
    const content = document.getElementById('certification-detail-content');
    const tableContainer = document.getElementById('certification-table-container');
    
    // Format tanggal
    const formatDate = (dateString) => {
      if (!dateString) return '-';
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('id-ID', options);
    };
    
    // Dapatkan data petani dan lahan
    const farmer = dummyData.farmers[cert.farmer_id] || { name: 'Tidak diketahui' };
    const land = dummyData.lands[cert.land_id] || { name: 'Tidak diketahui' };
    
    // Dapatkan checklist items
    const checklistItems = {
      1: 'Dokumen Legalitas Lahan',
      2: 'Catatan Panen',
      3: 'Penggunaan Pupuk',
      4: 'Penggunaan Pestisida',
      5: 'Pelatihan Petani'
    };
    const completedChecklist = cert.checklist_items.map(item => checklistItems[item]).join(', ');
    
    // Buat konten detail
    content.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <p class="text-sm text-gray-500">Program Sertifikasi</p>
          <p class="font-medium">${cert.program_sertifikasi}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Status</p>
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
            ${cert.status === 'Lulus' ? 'bg-green-100 text-green-800' : 
              cert.status === 'Proses' ? 'bg-yellow-100 text-yellow-800' : 
              'bg-red-100 text-red-800'}">
            ${cert.status}
          </span>
        </div>
        <div>
          <p class="text-sm text-gray-500">Lahan</p>
          <p class="font-medium">${land.name} (ID: ${cert.land_id})</p>
          <p class="text-sm text-gray-500 mt-1">${land.area ? land.area + ' ha' : '-'} • ${land.location || '-'}</p>
          <p class="text-sm text-gray-500">Tahun Tanam: ${land.year || '-'}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Petani</p>
          <p class="font-medium">${farmer.name} (ID: ${cert.farmer_id})</p>
          <p class="text-sm text-gray-500 mt-1">${farmer.phone || '-'}</p>
          <p class="text-sm text-gray-500">${farmer.address || '-'}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Mulai</p>
          <p class="font-medium">${formatDate(cert.tanggal_mulai)}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Audit</p>
          <p class="font-medium">${formatDate(cert.tanggal_audit)}</p>
        </div>
      </div>
      
      <div class="mb-4">
        <p class="text-sm text-gray-500">Checklist Audit</p>
        <p class="font-medium">${completedChecklist || 'Tidak ada'}</p>
      </div>
      
      <div>
        <p class="text-sm text-gray-500">Dokumen Sertifikat</p>
        <p class="font-medium">${cert.dokumen_sertifikat ? 'Tersedia' : 'Tidak tersedia'}</p>
        ${cert.dokumen_sertifikat ? '<button class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Unduh Dokumen</button>' : ''}
      </div>
    `;
    
    modal.classList.remove('hidden');
  }
}

// Tutup modal view
function closeViewModal() {
  document.getElementById('view-modal').classList.add('hidden');
}
</script>

<?php include 'footer.php'; ?>