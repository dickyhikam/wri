<?php include 'header.php'; ?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Manajemen Pengguna</h2>
        <p class="opacity-90">Kelola data pengguna sistem WRI</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-users-cog text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Notification (Contoh) -->
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert" style="display: none;" id="notification">
    <span class="block sm:inline" id="notification-message"></span>
  </div>

  <!-- Action Buttons -->
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Daftar Pengguna</h2>
    <button onclick="showForm('add')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
      <i class="fas fa-plus mr-2"></i> Tambah Pengguna
    </button>
  </div>

  <!-- Form Add/Edit (Hidden by default) -->
  <div id="user-form" class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100" style="display: none;">
    <h3 class="text-lg font-semibold mb-4" id="form-title">Tambah Data Pengguna</h3>
    
    <form id="user-form-data" onsubmit="return false;">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Username -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
          <input type="text" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- Email -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- Confirm Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
          <input type="password" name="confirm_password" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- Full Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
          <input type="text" name="full_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- User Type -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna</label>
          <select name="user_type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Pilih Tipe</option>
            <option value="admin">Administrator</option>
            <option value="officer">Petugas Lapangan</option>
            <option value="farmer">Petani</option>
          </select>
        </div>
        
        <!-- Village -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Desa</label>
          <select name="village_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Desa</option>
            <option value="1">Desa Makmur</option>
            <option value="2">Desa Sejahtera</option>
            <option value="3">Desa Baru</option>
          </select>
        </div>
        
        <!-- Status -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
          <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="active" selected>Aktif</option>
            <option value="inactive">Non-Aktif</option>
          </select>
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

  <!-- User List -->
  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Desa</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="user-table-body">
          <!-- User 1 -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">USR001</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">admin_wri</div>
              <div class="text-sm text-gray-500">admin@wri.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                Administrator
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Kantor Pusat
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Aktif
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewUser('USR001')" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                <i class="fas fa-eye"></i>
              </button>
              <button onclick="showForm('edit', 'USR001')" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="confirmDelete('USR001')" class="text-red-600 hover:text-red-900" title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
          
          <!-- User 2 -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">USR002</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">petugas1</div>
              <div class="text-sm text-gray-500">petugas1@wri.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                Petugas Lapangan
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Desa Makmur
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Aktif
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewUser('USR002')" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                <i class="fas fa-eye"></i>
              </button>
              <button onclick="showForm('edit', 'USR002')" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="confirmDelete('USR002')" class="text-red-600 hover:text-red-900" title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
          
          <!-- User 3 -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">USR003</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">petani_ahmad</div>
              <div class="text-sm text-gray-500">ahmad@example.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Petani
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Desa Sejahtera
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Aktif
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewUser('USR003')" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                <i class="fas fa-eye"></i>
              </button>
              <button onclick="showForm('edit', 'USR003')" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="confirmDelete('USR003')" class="text-red-600 hover:text-red-900" title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
          
          <!-- User 4 -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">USR004</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">petani_budi</div>
              <div class="text-sm text-gray-500">budi@example.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                Non-Aktif
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              Desa Baru
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                Non-Aktif
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewUser('USR004')" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                <i class="fas fa-eye"></i>
              </button>
              <button onclick="showForm('edit', 'USR004')" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="confirmDelete('USR004')" class="text-red-600 hover:text-red-900" title="Hapus">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- View User Modal -->
  <div id="view-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center border-b pb-3">
        <h3 class="text-lg font-semibold">Detail Pengguna</h3>
        <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="py-4" id="user-detail-content">
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
const dummyUsers = {
  "USR001": {
    username: "admin_wri",
    email: "admin@wri.com",
    full_name: "Admin WRI",
    user_type: "admin",
    village_id: "1",
    village_name: "Kantor Pusat",
    status: "active",
    created_at: "2022-01-15"
  },
  "USR002": {
    username: "petugas1",
    email: "petugas1@wri.com",
    full_name: "Petugas Lapangan 1",
    user_type: "officer",
    village_id: "2",
    village_name: "Desa Makmur",
    status: "active",
    created_at: "2022-02-20"
  },
  "USR003": {
    username: "petani_ahmad",
    email: "ahmad@example.com",
    full_name: "Ahmad Fauzi",
    user_type: "farmer",
    village_id: "3",
    village_name: "Desa Sejahtera",
    status: "active",
    created_at: "2022-03-05"
  },
  "USR004": {
    username: "petani_budi",
    email: "budi@example.com",
    full_name: "Budi Santoso",
    user_type: "farmer",
    village_id: "4",
    village_name: "Desa Baru",
    status: "inactive",
    created_at: "2022-04-10"
  }
};

// Tampilkan form tambah/edit
function showForm(action, id = null) {
  const form = document.getElementById('user-form');
  const formTitle = document.getElementById('form-title');
  const formElement = document.getElementById('user-form-data');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  // Sembunyikan tabel
  tableContainer.style.display = 'none';
  
  if (action === 'add') {
    formTitle.textContent = 'Tambah Data Pengguna';
    formElement.reset();
  } else if (action === 'edit' && id) {
    formTitle.textContent = 'Edit Data Pengguna';
    const user = dummyUsers[id];
    if (user) {
      // Isi form dengan data user
      formElement.username.value = user.username;
      formElement.email.value = user.email;
      formElement.full_name.value = user.full_name;
      formElement.user_type.value = user.user_type;
      formElement.village_id.value = user.village_id;
      formElement.status.value = user.status;
      // Kosongkan password untuk edit
      formElement.password.value = '';
      formElement.confirm_password.value = '';
    }
  }
  
  form.style.display = 'block';
  window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
}

// Sembunyikan form
function hideForm() {
  const form = document.getElementById('user-form');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  form.style.display = 'none';
  // Tampilkan kembali tabel
  tableContainer.style.display = 'block';
}

// Submit form (simulasi)
function submitForm() {
  showNotification('Data pengguna berhasil disimpan', 'success');
  hideForm();
}

// Konfirmasi hapus
function confirmDelete(id) {
  if (confirm('Apakah Anda yakin ingin menghapus data pengguna ini?')) {
    showNotification('Data pengguna berhasil dihapus', 'success');
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
function viewUser(id) {
  const user = dummyUsers[id];
  if (user) {
    const modal = document.getElementById('view-modal');
    const content = document.getElementById('user-detail-content');
    
    // Format tanggal
    const formatDate = (dateString) => {
      if (!dateString) return '-';
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('id-ID', options);
    };
    
    // Format tipe user
    const formatUserType = (type) => {
      switch(type) {
        case 'admin': return 'Administrator';
        case 'officer': return 'Petugas Lapangan';
        case 'farmer': return 'Petani';
        default: return type;
      }
    };
    
    // Buat konten detail
    content.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <p class="text-sm text-gray-500">Username</p>
          <p class="font-medium">${user.username}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Email</p>
          <p class="font-medium">${user.email}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Nama Lengkap</p>
          <p class="font-medium">${user.full_name}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tipe Pengguna</p>
          <p class="font-medium">${formatUserType(user.user_type)}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Desa</p>
          <p class="font-medium">${user.village_name || '-'}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Status</p>
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
            ${user.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
            ${user.status === 'active' ? 'Aktif' : 'Non-Aktif'}
          </span>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Daftar</p>
          <p class="font-medium">${formatDate(user.created_at)}</p>
        </div>
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