<?php include 'header.php'; ?>

<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8 sticky top-0 z-10">
        <h1 class="text-2xl font-bold text-gray-800">Role Approval</h1>
        <button onclick="showForm('add')" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Role
        </button>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <!-- Form (Hidden by default) -->
        <div id="role-form" class="bg-white rounded-xl shadow-md overflow-hidden mb-6 hidden">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6" id="form-title">Tambah Role Approval</h2>
                <form id="role-form-element">
                    <input type="hidden" id="role_id" name="role_id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="role_name" class="block text-sm font-medium text-gray-700">Nama Role</label>
                            <input type="text" id="role_name" name="role_name" required 
                                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="type_user" class="block text-sm font-medium text-gray-700">Tipe User</label>
                            <select id="type_user" name="type_user" required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Tipe User</option>
                                <option value="admin">Admin</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="manager">Manager</option>
                                <option value="field_officer">Field Officer</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" rows="3" 
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Hak Akses</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="permissions-container">
                            <!-- Permissions will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideFormAndShowTable()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Batal</button>
                        <button type="submit" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">Simpan Role</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- View Section (Hidden by default) -->
        <div id="view-section" class="bg-white rounded-xl shadow-md overflow-hidden mb-6 hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Detail Role</h2>
                    <button onclick="hideViewSection()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-4" id="view-role-details">
                    <!-- Detail akan diisi oleh JavaScript -->
                </div>
                <div class="flex justify-end pt-4 mt-4 border-t">
                    <button onclick="hideViewSection()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Tutup</button>
                </div>
            </div>
        </div>

        <!-- Role Table (Shown by default) -->
        <div id="role-table-container" class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Filter Section -->
            <div class="p-4 bg-gray-50 border-b">
                <form id="filter-form" class="space-y-4">
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" id="search-input" name="search" 
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   placeholder="Cari role...">
                            <button type="button" onclick="applyFilters()" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <select id="filter-type-user" name="filter_type_user" 
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Tipe User</option>
                                <option value="admin">Admin</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="manager">Manager</option>
                                <option value="field_officer">Field Officer</option>
                            </select>
                        </div>
                        <div>
                            <select id="filter-access-count" name="filter_access_count" 
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Jumlah Akses</option>
                                <option value="few">Sedikit (1-3)</option>
                                <option value="moderate">Sedang (4-6)</option>
                                <option value="many">Banyak (> 6)</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="applyFilters()" 
                                class="bg-[#2463ec] hover:bg-[#1a4bb0] text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
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
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button onclick="previousPage()" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button onclick="nextPage()" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700" id="pagination-info">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">10</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button onclick="previousPage()" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div id="pagination-numbers" class="flex">
                                <!-- Page numbers will be inserted here -->
                            </div>
                            <button onclick="nextPage()" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
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

<script>
// Data dummy untuk simulasi
const dummyData = {
    roles: [
        {
            role_id: 1,
            role_name: "Admin",
            type_user: "admin",
            description: "Role dengan akses penuh ke semua fitur sistem",
            permissions: ["farmer_view", "farmer_create", "farmer_edit", "farmer_delete",
                         "approval_view", "approval_create", "approval_edit", "approval_delete",
                         "user_view", "user_create", "user_edit", "user_delete",
                         "report_view", "report_generate", "report_export",
                         "settings_view", "settings_edit"]
        },
        {
            role_id: 2,
            role_name: "Supervisor",
            type_user: "supervisor",
            description: "Role untuk supervisor yang bisa approve data petani",
            permissions: ["farmer_view", "farmer_edit",
                         "approval_view", "approval_create", "approval_edit",
                         "user_view",
                         "report_view", "report_generate"]
        },
        {
            role_id: 3,
            role_name: "Field Officer",
            type_user: "field_officer",
            description: "Role untuk petugas lapangan yang input data petani",
            permissions: ["farmer_view", "farmer_create",
                         "approval_view",
                         "report_view"]
        },
        {
            role_id: 4,
            role_name: "Manager",
            type_user: "manager",
            description: "Role untuk manager yang mengawasi operasional",
            permissions: ["farmer_view", "farmer_edit",
                         "approval_view", "approval_edit",
                         "user_view",
                         "report_view", "report_generate", "report_export"]
        },
        {
            role_id: 5,
            role_name: "Auditor",
            type_user: "auditor",
            description: "Role untuk auditor yang memeriksa data",
            permissions: ["farmer_view",
                         "approval_view",
                         "report_view", "report_generate"]
        },
        {
            role_id: 6,
            role_name: "Guest",
            type_user: "guest",
            description: "Role untuk tamu dengan akses terbatas",
            permissions: ["farmer_view",
                         "report_view"]
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

// Pagination settings
let currentPage = 1;
const rolesPerPage = 5;
let filteredRoles = [...dummyData.roles];

// Function to show form (add/edit) dan menyembunyikan tabel
function showForm(action, id = null) {
    const form = document.getElementById('role-form');
    const tableContainer = document.getElementById('role-table-container');
    const viewSection = document.getElementById('view-section');
    
    // Sembunyikan tabel dan view section
    tableContainer.classList.add('hidden');
    viewSection.classList.add('hidden');
    
    // Reset form
    document.getElementById('role-form-element').reset();
    document.getElementById('role_id').value = '';
    
    // Populate permissions
    const permissionsContainer = document.getElementById('permissions-container');
    permissionsContainer.innerHTML = '';
    
    Object.keys(dummyData.permissionGroups).forEach(group => {
        const groupDiv = document.createElement('div');
        groupDiv.className = 'border rounded-lg p-4';
        groupDiv.innerHTML = `
            <h4 class="font-medium mb-3">${group}</h4>
            <div class="space-y-2">
                ${dummyData.permissionGroups[group].map(permission => `
                    <div class="flex items-center">
                        <input type="checkbox" name="permissions[]" value="${permission}" id="perm_${permission}" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="perm_${permission}" class="ml-3 text-sm text-gray-700">${permission.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</label>
                    </div>
                `).join('')}
            </div>
        `;
        permissionsContainer.appendChild(groupDiv);
    });
    
    const formTitle = document.getElementById('form-title');
    if (action === 'add') {
        formTitle.textContent = 'Tambah Role Approval';
    } else if (action === 'edit' && id) {
        formTitle.textContent = 'Edit Role Approval';
        const role = dummyData.roles.find(r => r.role_id === id);
        if (role) {
            // Populate form with role data
            document.getElementById('role_name').value = role.role_name;
            document.getElementById('type_user').value = role.type_user;
            document.getElementById('description').value = role.description;
            
            // Set permissions
            document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = role.permissions.includes(checkbox.value);
            });
        }
        document.getElementById('role_id').value = id;
    }
    
    // Tampilkan form
    form.classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Function to hide form and show table
function hideFormAndShowTable() {
    document.getElementById('role-form').classList.add('hidden');
    document.getElementById('view-section').classList.add('hidden');
    document.getElementById('role-table-container').classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Function to view role details (non-modal)
function viewRole(id) {
    const role = dummyData.roles.find(r => r.role_id === id);
    if (role) {
        const viewSection = document.getElementById('view-section');
        const detailsDiv = document.getElementById('view-role-details');
        
        let permissionsHTML = '';
        Object.keys(dummyData.permissionGroups).forEach(group => {
            const groupPermissions = dummyData.permissionGroups[group].filter(p => role.permissions.includes(p));
            if (groupPermissions.length > 0) {
                permissionsHTML += `
                    <div class="mb-3">
                        <h5 class="font-medium text-gray-700">${group}</h5>
                        <ul class="list-disc list-inside text-sm text-gray-600">
                            ${groupPermissions.map(p => `<li>${p.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</li>`).join('')}
                        </ul>
                    </div>
                `;
            }
        });
        
        detailsDiv.innerHTML = `
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
                <div>
                    <p class="text-sm text-gray-500">Jumlah Akses</p>
                    <p class="font-medium">${role.permissions.length}</p>
                </div>
            </div>
            <div class="border-t pt-4">
                <h4 class="font-medium mb-3">Hak Akses</h4>
                ${permissionsHTML}
            </div>
        `;
        
        // Sembunyikan tabel dan form, tampilkan view section
        document.getElementById('role-table-container').classList.add('hidden');
        document.getElementById('role-form').classList.add('hidden');
        viewSection.classList.remove('hidden');
        
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

// Function to hide view section
function hideViewSection() {
    document.getElementById('view-section').classList.add('hidden');
    document.getElementById('role-table-container').classList.remove('hidden');
}

// Function to apply filters
function applyFilters() {
    const searchInput = document.getElementById('search-input').value.toLowerCase();
    const filterTypeUser = document.getElementById('filter-type-user').value;
    const filterAccessCount = document.getElementById('filter-access-count').value;
    
    filteredRoles = dummyData.roles.filter(role => {
        const matchesSearch = role.role_name.toLowerCase().includes(searchInput) || 
                             role.description.toLowerCase().includes(searchInput);
        const matchesTypeUser = filterTypeUser ? role.type_user === filterTypeUser : true;
        let matchesAccessCount = true;
        
        if (filterAccessCount) {
            const count = role.permissions.length;
            if (filterAccessCount === 'few') matchesAccessCount = count >= 1 && count <= 3;
            else if (filterAccessCount === 'moderate') matchesAccessCount = count >= 4 && count <= 6;
            else if (filterAccessCount === 'many') matchesAccessCount = count > 6;
        }
        
        return matchesSearch && matchesTypeUser && matchesAccessCount;
    });
    
    currentPage = 1;
    loadRoles();
}

// Function to delete role
function deleteRole(id) {
    if (confirm('Apakah Anda yakin ingin menghapus role ini?')) {
        // Remove role from dummy data
        dummyData.roles = dummyData.roles.filter(r => r.role_id !== id);
        filteredRoles = filteredRoles.filter(r => r.role_id !== id);
        // Reload roles
        loadRoles();
    }
}

// Function to load roles with pagination
function loadRoles() {
    const startIndex = (currentPage - 1) * rolesPerPage;
    const endIndex = startIndex + rolesPerPage;
    const paginatedRoles = filteredRoles.slice(startIndex, endIndex);
    
    const tableBody = document.getElementById('role-table-body');
    tableBody.innerHTML = '';
    
    if (paginatedRoles.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data role</td>
            </tr>
        `;
    } else {
        paginatedRoles.forEach(role => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${role.role_name}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">${role.type_user}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-500">${role.description}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        ${role.permissions.length}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="viewRole(${role.role_id})" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="showForm('edit', ${role.role_id})" class="text-yellow-600 hover:text-yellow-900 mr-3">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteRole(${role.role_id})" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }
    
    // Update pagination info
    const totalItems = filteredRoles.length;
    const totalPages = Math.ceil(totalItems / rolesPerPage);
    
    document.getElementById('pagination-info').innerHTML = `
        Showing <span class="font-medium">${startIndex + 1}</span> to 
        <span class="font-medium">${Math.min(endIndex, totalItems)}</span> of 
        <span class="font-medium">${totalItems}</span> results
    `;
    
    // Update pagination numbers
    const paginationNumbers = document.getElementById('pagination-numbers');
    paginationNumbers.innerHTML = '';
    
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    if (startPage > 1) {
        const pageButton = document.createElement('button');
        pageButton.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50';
        pageButton.textContent = '1';
        pageButton.onclick = () => { currentPage = 1; loadRoles(); };
        paginationNumbers.appendChild(pageButton);
        
        if (startPage > 2) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
            ellipsis.textContent = '...';
            paginationNumbers.appendChild(ellipsis);
        }
    }
    
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.className = `relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
            i === currentPage ? 'bg-blue-100 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50'
        }`;
        pageButton.textContent = i;
        pageButton.onclick = () => { currentPage = i; loadRoles(); };
        paginationNumbers.appendChild(pageButton);
    }
    
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
            ellipsis.textContent = '...';
            paginationNumbers.appendChild(ellipsis);
        }
        
        const pageButton = document.createElement('button');
        pageButton.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50';
        pageButton.textContent = totalPages;
        pageButton.onclick = () => { currentPage = totalPages; loadRoles(); };
        paginationNumbers.appendChild(pageButton);
    }
}

// Function for previous page
function previousPage() {
    if (currentPage > 1) {
        currentPage--;
        loadRoles();
    }
}

// Function for next page
function nextPage() {
    const totalPages = Math.ceil(filteredRoles.length / rolesPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        loadRoles();
    }
}

// Function to go to specific page
function goToPage(page) {
    const totalPages = Math.ceil(filteredRoles.length / rolesPerPage);
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        loadRoles();
    }
}

// Event listener for form submission
document.getElementById('role-form-element')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const roleData = {
        role_id: parseInt(formData.get('role_id')) || Date.now(), // Use timestamp for new roles
        role_name: formData.get('role_name'),
        type_user: formData.get('type_user'),
        description: formData.get('description'),
        permissions: []
    };
    
    // Get selected permissions
    document.querySelectorAll('input[name="permissions[]"]:checked').forEach(checkbox => {
        roleData.permissions.push(checkbox.value);
    });
    
    // Save or update role
    if (formData.get('role_id')) {
        // Update existing role
        const index = dummyData.roles.findIndex(r => r.role_id === roleData.role_id);
        if (index !== -1) {
            dummyData.roles[index] = roleData;
        }
    } else {
        // Add new role
        dummyData.roles.push(roleData);
    }
    
    // Hide form and show table
    hideFormAndShowTable();
    filteredRoles = [...dummyData.roles];
    loadRoles();
});

// Initial load of roles
document.addEventListener('DOMContentLoaded', function() {
    loadRoles();
    
    // Add event listener for filter form
    document.getElementById('filter-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        applyFilters();
    });
});
</script>

<?php include 'footer.php'; ?>