<?php include 'header.php'; ?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Manajemen Hak Akses Menu</h2>
        <p class="opacity-90">Kelola hak akses menu untuk berbagai tipe pengguna</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-user-shield text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Notification -->
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert" style="display: none;" id="notification">
    <span class="block sm:inline" id="notification-message"></span>
  </div>

  <!-- Action Buttons -->
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Daftar Hak Akses Menu</h2>
    <button onclick="showForm('add')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
      <i class="fas fa-plus mr-2"></i> Tambah Hak Akses
    </button>
  </div>

  <!-- Form Add/Edit (Hidden by default) -->
  <div id="access-form" class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100" style="display: none;">
    <h3 class="text-lg font-semibold mb-4" id="form-title">Tambah Hak Akses Menu</h3>
    
    <form id="access-form-data" onsubmit="return false;">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- User Type -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengguna</label>
          <select name="type_user" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Pilih Tipe Pengguna</option>
            <option value="admin">Admin</option>
            <option value="petani">Petani</option>
            <option value="koperasi">Koperasi</option>
            <option value="pabrik">Pabrik</option>
          </select>
        </div>
        
        <!-- Username -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
          <select name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Pilih Username</option>
            <!-- Options will be populated by JavaScript -->
          </select>
        </div>
        
        <!-- Menu Access -->
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-2">Akses Menu</label>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex items-center">
              <input type="checkbox" id="menu_dashboard" name="menu_access[]" value="dashboard" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_dashboard" class="ml-2 text-sm text-gray-700">Dashboard</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_petani" name="menu_access[]" value="petani" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_petani" class="ml-2 text-sm text-gray-700">Manajemen Petani</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_lahan" name="menu_access[]" value="lahan" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_lahan" class="ml-2 text-sm text-gray-700">Manajemen Lahan</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_sertifikasi" name="menu_access[]" value="sertifikasi" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_sertifikasi" class="ml-2 text-sm text-gray-700">Sertifikasi</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_panen" name="menu_access[]" value="panen" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_panen" class="ml-2 text-sm text-gray-700">Data Panen</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_laporan" name="menu_access[]" value="laporan" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_laporan" class="ml-2 text-sm text-gray-700">Laporan</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_pengguna" name="menu_access[]" value="pengguna" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_pengguna" class="ml-2 text-sm text-gray-700">Manajemen Pengguna</label>
            </div>
            <div class="flex items-center">
              <input type="checkbox" id="menu_hak_akses" name="menu_access[]" value="hak_akses" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
              <label for="menu_hak_akses" class="ml-2 text-sm text-gray-700">Hak Akses</label>
            </div>
          </div>
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

  <!-- Access List -->
  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Pengguna</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu Akses</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="access-table-body">
          <!-- Data dummy -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">admin1</div>
              <div class="text-sm text-gray-500">admin1@example.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Admin Utama</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                Admin
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Dashboard, Petani, Lahan, Sertifikasi, Panen, Laporan, Pengguna, Hak Akses</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jan 2023</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewAccess(1)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
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
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">petani1</div>
              <div class="text-sm text-gray-500">petani1@example.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Budi Santoso</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                Petani
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Dashboard, Lahan, Sertifikasi, Panen</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Feb 2023</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewAccess(2)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
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
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">koperasi1</div>
              <div class="text-sm text-gray-500">koperasi1@example.com</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Koperasi Sawit Makmur</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                Koperasi
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-900">Dashboard, Petani, Lahan, Panen, Laporan</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05 Mar 2023</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewAccess(3)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
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

  <!-- View Access Modal -->
  <div id="view-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center border-b pb-3">
        <h3 class="text-lg font-semibold">Detail Hak Akses Menu</h3>
        <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="py-4" id="access-detail-content">
        <!-- Detail will be filled by JavaScript -->
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
const dummyData = {
  users: [
    {
      id: 1,
      my_id: "USR001",
      username: "admin1",
      email: "admin1@example.com",
      type_user: "admin",
      name: "Admin Utama",
      register_date: "2023-01-15",
      menu_access: ["dashboard", "petani", "lahan", "sertifikasi", "panen", "laporan", "pengguna", "hak_akses"]
    },
    {
      id: 2,
      my_id: "USR002",
      username: "petani1",
      email: "petani1@example.com",
      type_user: "petani",
      name: "Budi Santoso",
      register_date: "2023-02-20",
      menu_access: ["dashboard", "lahan", "sertifikasi", "panen"]
    },
    {
      id: 3,
      my_id: "USR003",
      username: "koperasi1",
      email: "koperasi1@example.com",
      type_user: "koperasi",
      name: "Koperasi Sawit Makmur",
      register_date: "2023-03-05",
      menu_access: ["dashboard", "petani", "lahan", "panen", "laporan"]
    }
  ]
};

// Format tanggal
function formatDate(dateString) {
  if (!dateString) return '-';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Tampilkan form tambah/edit
function showForm(action, id = null) {
  const form = document.getElementById('access-form');
  const formTitle = document.getElementById('form-title');
  const formElement = document.getElementById('access-form-data');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  // Sembunyikan tabel
  tableContainer.style.display = 'none';
  
  if (action === 'add') {
    formTitle.textContent = 'Tambah Hak Akses Menu';
    formElement.reset();
    // Reset checklist
    document.querySelectorAll('input[name="menu_access[]"]').forEach(checkbox => {
      checkbox.checked = false;
    });
    
    // Isi dropdown username
    const usernameSelect = formElement.username;
    usernameSelect.innerHTML = '<option value="">Pilih Username</option>';
    
    // Tambahkan opsi username (dalam implementasi nyata, ini akan diisi dari database)
    usernameSelect.innerHTML += `
      <option value="admin1">admin1 (Admin Utama)</option>
      <option value="petani1">petani1 (Budi Santoso)</option>
      <option value="koperasi1">koperasi1 (Koperasi Sawit Makmur)</option>
      <option value="petani2">petani2 (Siti Aminah)</option>
      <option value="pabrik1">pabrik1 (Pabrik Kelapa Sawit Jaya)</option>
    `;
  } else if (action === 'edit' && id) {
    formTitle.textContent = 'Edit Hak Akses Menu';
    const user = dummyData.users.find(u => u.id === id);
    if (user) {
      // Isi form dengan data user
      formElement.type_user.value = user.type_user;
      formElement.username.value = user.username;
      
      // Set checklist items
      document.querySelectorAll('input[name="menu_access[]"]').forEach(checkbox => {
        checkbox.checked = user.menu_access.includes(checkbox.value);
      });
    }
  }
  
  form.style.display = 'block';
  window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
}

// Sembunyikan form
function hideForm() {
  const form = document.getElementById('access-form');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  form.style.display = 'none';
  // Tampilkan kembali tabel
  tableContainer.style.display = 'block';
}

// Submit form (simulasi)
function submitForm() {
  showNotification('Data hak akses berhasil disimpan', 'success');
  hideForm();
}

// Konfirmasi hapus
function confirmDelete(id) {
  if (confirm('Apakah Anda yakin ingin menghapus data hak akses ini?')) {
    showNotification('Data hak akses berhasil dihapus', 'success');
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
function viewAccess(id) {
  const user = dummyData.users.find(u => u.id === id);
  if (user) {
    const modal = document.getElementById('view-modal');
    const content = document.getElementById('access-detail-content');
    
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
          <p class="text-sm text-gray-500">Nama</p>
          <p class="font-medium">${user.name}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tipe Pengguna</p>
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
            ${user.type_user === 'admin' ? 'bg-purple-100 text-purple-800' : 
              user.type_user === 'petani' ? 'bg-green-100 text-green-800' : 
              user.type_user === 'koperasi' ? 'bg-blue-100 text-blue-800' : 
              'bg-yellow-100 text-yellow-800'}">
            ${user.type_user}
          </span>
        </div>
        <div>
          <p class="text-sm text-gray-500">ID Pengguna</p>
          <p class="font-medium">${user.my_id}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Daftar</p>
          <p class="font-medium">${formatDate(user.register_date)}</p>
        </div>
      </div>
      
      <div class="mb-4">
        <p class="text-sm text-gray-500">Menu Akses</p>
        <div class="mt-2 flex flex-wrap gap-2">
          ${user.menu_access.map(menu => `
            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
              ${menu.replace('_', ' ')}
            </span>
          `).join('')}
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

// Update username dropdown based on user type
document.querySelector('select[name="type_user"]').addEventListener('change', function() {
  const type = this.value;
  const usernameSelect = document.querySelector('select[name="username"]');
  
  // Simulasi filter username berdasarkan tipe pengguna
  if (type === 'admin') {
    usernameSelect.innerHTML = `
      <option value="">Pilih Username</option>
      <option value="admin1">admin1 (Admin Utama)</option>
      <option value="admin2">admin2 (Admin Kedua)</option>
    `;
  } else if (type === 'petani') {
    usernameSelect.innerHTML = `
      <option value="">Pilih Username</option>
      <option value="petani1">petani1 (Budi Santoso)</option>
      <option value="petani2">petani2 (Siti Aminah)</option>
      <option value="petani3">petani3 (Joko Widodo)</option>
    `;
  } else if (type === 'koperasi') {
    usernameSelect.innerHTML = `
      <option value="">Pilih Username</option>
      <option value="koperasi1">koperasi1 (Koperasi Sawit Makmur)</option>
      <option value="koperasi2">koperasi2 (Koperasi Sawit Jaya)</option>
    `;
  } else if (type === 'pabrik') {
    usernameSelect.innerHTML = `
      <option value="">Pilih Username</option>
      <option value="pabrik1">pabrik1 (Pabrik Kelapa Sawit Jaya)</option>
      <option value="pabrik2">pabrik2 (Pabrik Sawit Makmur)</option>
    `;
  } else {
    usernameSelect.innerHTML = '<option value="">Pilih Username</option>';
  }
});
</script>

<?php include 'footer.php'; ?>