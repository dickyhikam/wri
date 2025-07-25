<?php include 'header.php'; ?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Manajemen Role Approval</h2>
        <p class="opacity-90">Kelola role dan hak akses untuk sistem approval</p>
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
    <h2 class="text-xl font-semibold text-gray-800">Daftar Role Approval</h2>
    <button onclick="showForm('add')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
      <i class="fas fa-plus mr-2"></i> Tambah Role
    </button>
  </div>

  <!-- Form Add/Edit (Hidden by default) -->
  <div id="role-form" class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100" style="display: none;">
    <h3 class="text-lg font-semibold mb-4" id="form-title">Tambah Role Approval</h3>
    
    <form id="role-form-data" onsubmit="return false;">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Role Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nama Role</label>
          <input type="text" name="role_name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <!-- Type User -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Tipe User</label>
          <select name="type_user" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            <option value="">Pilih Tipe User</option>
            <option value="admin">Admin</option>
            <option value="supervisor">Supervisor</option>
            <option value="manager">Manager</option>
            <option value="field_officer">Field Officer</option>
          </select>
        </div>
        
        <!-- Description -->
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
          <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>
      </div>
      
      <!-- Permissions Section -->
      <div class="mt-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Hak Akses</label>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Farmer Management -->
          <div class="border p-3 rounded-lg">
            <h4 class="font-medium mb-2">Manajemen Petani</h4>
            <div class="space-y-2">
              <div class="flex items-center">
                <input type="checkbox" id="farmer_view" name="permissions[]" value="farmer_view" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="farmer_view" class="ml-2 text-sm text-gray-700">Lihat Data Petani</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="farmer_create" name="permissions[]" value="farmer_create" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="farmer_create" class="ml-2 text-sm text-gray-700">Tambah Petani</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="farmer_edit" name="permissions[]" value="farmer_edit" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="farmer_edit" class="ml-2 text-sm text-gray-700">Edit Petani</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="farmer_delete" name="permissions[]" value="farmer_delete" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="farmer_delete" class="ml-2 text-sm text-gray-700">Hapus Petani</label>
              </div>
            </div>
          </div>
          
          <!-- Approval Management -->
          <div class="border p-3 rounded-lg">
            <h4 class="font-medium mb-2">Manajemen Approval</h4>
            <div class="space-y-2">
              <div class="flex items-center">
                <input type="checkbox" id="approval_view" name="permissions[]" value="approval_view" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="approval_view" class="ml-2 text-sm text-gray-700">Lihat Approval</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="approval_create" name="permissions[]" value="approval_create" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="approval_create" class="ml-2 text-sm text-gray-700">Buat Approval</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="approval_edit" name="permissions[]" value="approval_edit" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="approval_edit" class="ml-2 text-sm text-gray-700">Edit Approval</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="approval_delete" name="permissions[]" value="approval_delete" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="approval_delete" class="ml-2 text-sm text-gray-700">Hapus Approval</label>
              </div>
            </div>
          </div>
          
          <!-- User Management -->
          <div class="border p-3 rounded-lg">
            <h4 class="font-medium mb-2">Manajemen User</h4>
            <div class="space-y-2">
              <div class="flex items-center">
                <input type="checkbox" id="user_view" name="permissions[]" value="user_view" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="user_view" class="ml-2 text-sm text-gray-700">Lihat User</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="user_create" name="permissions[]" value="user_create" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="user_create" class="ml-2 text-sm text-gray-700">Tambah User</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="user_edit" name="permissions[]" value="user_edit" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="user_edit" class="ml-2 text-sm text-gray-700">Edit User</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="user_delete" name="permissions[]" value="user_delete" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="user_delete" class="ml-2 text-sm text-gray-700">Hapus User</label>
              </div>
            </div>
          </div>
          
          <!-- Report Management -->
          <div class="border p-3 rounded-lg">
            <h4 class="font-medium mb-2">Manajemen Laporan</h4>
            <div class="space-y-2">
              <div class="flex items-center">
                <input type="checkbox" id="report_view" name="permissions[]" value="report_view" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="report_view" class="ml-2 text-sm text-gray-700">Lihat Laporan</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="report_generate" name="permissions[]" value="report_generate" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="report_generate" class="ml-2 text-sm text-gray-700">Generate Laporan</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="report_export" name="permissions[]" value="report_export" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="report_export" class="ml-2 text-sm text-gray-700">Export Laporan</label>
              </div>
            </div>
          </div>
          
          <!-- Settings -->
          <div class="border p-3 rounded-lg">
            <h4 class="font-medium mb-2">Pengaturan Sistem</h4>
            <div class="space-y-2">
              <div class="flex items-center">
                <input type="checkbox" id="settings_view" name="permissions[]" value="settings_view" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="settings_view" class="ml-2 text-sm text-gray-700">Lihat Pengaturan</label>
              </div>
              <div class="flex items-center">
                <input type="checkbox" id="settings_edit" name="permissions[]" value="settings_edit" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="settings_edit" class="ml-2 text-sm text-gray-700">Edit Pengaturan</label>
              </div>
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

  <!-- Role List -->
  <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Role</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe User</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Akses</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="role-table-body">
          <!-- Data will be populated by JavaScript -->
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">Admin</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">admin</div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-500">Role dengan akses penuh ke semua fitur sistem</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">15</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewRole(1)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
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
              <div class="text-sm font-medium text-gray-900">Supervisor</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">supervisor</div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-500">Role untuk supervisor yang bisa approve data petani</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">10</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewRole(2)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
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
              <div class="text-sm font-medium text-gray-900">Field Officer</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">field_officer</div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-500">Role untuk petugas lapangan yang input data petani</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">5</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button onclick="viewRole(3)" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
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

  <!-- View Role Modal -->
  <div id="view-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center border-b pb-3">
        <h3 class="text-lg font-semibold">Detail Role</h3>
        <button onclick="closeViewModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <div class="py-4" id="role-detail-content">
        <!-- Detail will be populated by JavaScript -->
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
  roles: [
    {
      role_id: 1,
      role_name: "Admin",
      type_user: "admin",
      description: "Role dengan akses penuh ke semua fitur sistem",
      permissions: [
        "farmer_view", "farmer_create", "farmer_edit", "farmer_delete",
        "approval_view", "approval_create", "approval_edit", "approval_delete",
        "user_view", "user_create", "user_edit", "user_delete",
        "report_view", "report_generate", "report_export",
        "settings_view", "settings_edit"
      ]
    },
    {
      role_id: 2,
      role_name: "Supervisor",
      type_user: "supervisor",
      description: "Role untuk supervisor yang bisa approve data petani",
      permissions: [
        "farmer_view", "farmer_edit",
        "approval_view", "approval_create", "approval_edit",
        "user_view",
        "report_view", "report_generate"
      ]
    },
    {
      role_id: 3,
      role_name: "Field Officer",
      type_user: "field_officer",
      description: "Role untuk petugas lapangan yang input data petani",
      permissions: [
        "farmer_view", "farmer_create",
        "approval_view",
        "report_view"
      ]
    }
  ],
  permissionGroups: {
    "Manajemen Petani": ["farmer_view", "farmer_create", "farmer_edit", "farmer_delete"],
    "Manajemen Approval": ["approval_view", "approval_create", "approval_edit", "approval_delete"],
    "Manajemen User": ["user_view", "user_create", "user_edit", "user_delete"],
    "Manajemen Laporan": ["report_view", "report_generate", "report_export"],
    "Pengaturan Sistem": ["settings_view", "settings_edit"]
  }
};

// Tampilkan form tambah/edit
function showForm(action, id = null) {
  const form = document.getElementById('role-form');
  const formTitle = document.getElementById('form-title');
  const formElement = document.getElementById('role-form-data');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  // Sembunyikan tabel
  tableContainer.style.display = 'none';
  
  if (action === 'add') {
    formTitle.textContent = 'Tambah Role Approval';
    formElement.reset();
    // Reset permissions
    document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
      checkbox.checked = false;
    });
  } else if (action === 'edit' && id) {
    formTitle.textContent = 'Edit Role Approval';
    const role = dummyData.roles.find(r => r.role_id === id);
    if (role) {
      // Isi form dengan data role
      formElement.role_name.value = role.role_name;
      formElement.type_user.value = role.type_user;
      formElement.description.value = role.description;
      
      // Set permissions
      document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
        checkbox.checked = role.permissions.includes(checkbox.value);
      });
    }
  }
  
  form.style.display = 'block';
  window.scrollTo({ top: form.offsetTop - 20, behavior: 'smooth' });
}

// Sembunyikan form
function hideForm() {
  const form = document.getElementById('role-form');
  const tableContainer = document.querySelector('.bg-white.rounded-xl.shadow-md.overflow-hidden'); // Container tabel
  
  form.style.display = 'none';
  // Tampilkan kembali tabel
  tableContainer.style.display = 'block';
}

// Submit form (simulasi)
function submitForm() {
  const form = document.getElementById('role-form-data');
  
  // Dapatkan semua permission yang dicentang
  const permissions = [];
  document.querySelectorAll('input[name="permissions[]"]:checked').forEach(checkbox => {
    permissions.push(checkbox.value);
  });
  
  showNotification('Data role berhasil disimpan', 'success');
  hideForm();
}

// Konfirmasi hapus
function confirmDelete(id) {
  if (confirm('Apakah Anda yakin ingin menghapus role ini?')) {
    showNotification('Role berhasil dihapus', 'success');
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
function viewRole(id) {
  const role = dummyData.roles.find(r => r.role_id === id);
  if (role) {
    const modal = document.getElementById('view-modal');
    const content = document.getElementById('role-detail-content');
    
    // Buat konten detail
    let permissionsHTML = '';
    
    for (const [groupName, groupPermissions] of Object.entries(dummyData.permissionGroups)) {
      const hasPermission = groupPermissions.some(perm => role.permissions.includes(perm));
      
      if (hasPermission) {
        permissionsHTML += `<div class="mb-4">
          <h4 class="font-medium mb-2">${groupName}</h4>
          <ul class="list-disc pl-5 space-y-1">`;
        
        groupPermissions.forEach(perm => {
          if (role.permissions.includes(perm)) {
            const permName = perm.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
            permissionsHTML += `<li class="text-sm">${permName}</li>`;
          }
        });
        
        permissionsHTML += `</ul></div>`;
      }
    }
    
    content.innerHTML = `
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <p class="text-sm text-gray-500">Nama Role</p>
          <p class="font-medium">${role.role_name}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tipe User</p>
          <p class="font-medium">${role.type_user}</p>
        </div>
        <div class="md:col-span-2">
          <p class="text-sm text-gray-500">Deskripsi</p>
          <p class="font-medium">${role.description}</p>
        </div>
      </div>
      
      <div class="border-t pt-4">
        <h4 class="font-medium mb-3">Hak Akses</h4>
        ${permissionsHTML}
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