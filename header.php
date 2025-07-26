<!DOCTYPE html>
<html lang="en">

<?php
$host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];

// Check if '/wri' exists in the URI path
if (strpos($request_uri, '/wri/') !== false) {
  // If '/wri' exists, remove it from the URI path
  $modified_uri = str_replace('/wri/', '', $request_uri);
} else {
  // If '/wri' doesn't exist, keep the original URI
  $modified_uri = $request_uri;
}

$name_menu = [
  'index' => 'Dashboard',
  '' => 'Dashboard',
  'petani' => 'Petani',
  'lahan' => 'Lahan/Persil',
  'parcel' => 'Parcel Data',
  'ics' => 'ICS & Fasilitator',
  'pelatihan' => 'Pelatihan',
  'sertifikasi' => 'Sertifikasi & Audit',
  'pekerja' => 'Pekerja',
  'transaksi' => 'Transaksi',
  'mitra' => 'Mitra & Organisasi',
  'nkt' => 'HCV/NKT',
  'kelompok_tani' => 'Kelompok Tani',
  'produksi' => 'Produksi',
  'perawatan' => 'Perawatan',
  'limbah' => 'Limbah B3 dan K3',
];
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $name_menu[$modified_uri] ?> | MIS</title>
  <!-- Load Adobe Fonts -->
  <link rel="stylesheet" href="https://use.typekit.net/erz2zrt.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="assets/layout.css" />

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800" x-data="{ openModal: false,
    currentMenu: 'dashboard',
    menuCollapse: {
        masterData: false,
        projectManagement: false,
        analytics: false,
        cms: false,
        userManagement: false,
        systemAdmin: false
    }}">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar with Child Menus -->
    <aside class="w-64 bg-[#403c3c] text-white flex flex-col shadow-xl z-10">
      <!-- Logo -->
      <div class="h-20 flex items-center px-6 font-bold text-xl tracking-wide border-b border-yellow-500">
        <div class="flex items-center space-x-2">
          <a href="index">
            <img src="img/logo.png" alt="MIS Admin Logo" class="h-10 w-auto" />
          </a>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 overflow-y-auto py-4 space-y-1 text-sm">
        <!-- Dashboard -->
        <div>
          <a href="index" @click="currentMenu = 'dashboard'" class="flex items-center px-6 py-3 sidebar-item <?php echo ($modified_uri == 'index' || $modified_uri == '') ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt w-5 mr-3 text-[#f0ab00]"></i>
            Dashboard
          </a>
        </div>

        <!-- Master Data -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.masterData}">
          <div @click="menuCollapse.masterData = !menuCollapse.masterData" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer <?php echo ($modified_uri == 'petani') ? 'active' : ''; ?>">
            <div class="flex items-center">
              <i class="fas fa-database w-5 mr-3 text-[#f0ab00]"></i>
              Master Data
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.masterData}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="petani" @click="currentMenu = 'farmers'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black sidebar-item <?php echo ($modified_uri == 'petani') ? 'active' : ''; ?>">Petani</a>
            <a href="lahan" @click="currentMenu = 'plots'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Lahan/Persil</a>
            <a href="parcel" @click="currentMenu = 'parcel'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Parcel Data</a>
            <a href="ics" @click="currentMenu = 'ics'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">ICS & Fasilitator</a>
            <a href="pelatihan" @click="currentMenu = 'trainings'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Pelatihan</a>
            <a href="sertifikasi" @click="currentMenu = 'certifications'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Sertifikasi & Audit</a>
            <a href="pekerja" @click="currentMenu = 'workers'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Pekerja</a>
            <a href="transaksi" @click="currentMenu = 'transactions'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Transaksi</a>
            <a href="mitra" @click="currentMenu = 'partners'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Mitra & Organisasi</a>
            <a href="nkt" @click="currentMenu = 'hcv'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">HCV/NKT</a>
            <a href="kelompok_tani" @click="currentMenu = 'farmers_gt'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Kelompok Tani</a>
            <a href="produksi" @click="currentMenu = 'produksition'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Produksi</a>
            <a href="perawatan" @click="currentMenu = 'produksition'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Perawatan</a>
            <a href="limbah" @click="currentMenu = 'limbah'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Limbah B3 dan K3</a>
          </div>
        </div>

        <!-- Project Management -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.projectManagement}">
          <div @click="menuCollapse.projectManagement = !menuCollapse.projectManagement" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-project-diagram w-5 mr-3 text-[#f0ab00]"></i>
              Project Management
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.projectManagement}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="#" @click="currentMenu = 'workplan'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Workplan Tracker</a>
            <a href="#" @click="currentMenu = 'fieldLogs'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Log Aktivitas Lapangan</a>
            <a href="#" @click="currentMenu = 'activityReports'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Laporan Kegiatan</a>
            <a href="#" @click="currentMenu = 'weeklyReports'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Laporan Mingguan</a>
            <a href="#" @click="currentMenu = 'finalReports'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Final & Intermediate Report</a>
          </div>
        </div>

        <!-- Analytics & Visualization -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.analytics}">
          <div @click="menuCollapse.analytics = !menuCollapse.analytics" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-chart-bar w-5 mr-3 text-[#f0ab00]"></i>
              Analitik & Visualisasi
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.analytics}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="#" @click="currentMenu = 'queryBuilder'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Query Builder</a>
            <a href="analitik" @click="currentMenu = 'analyticsDashboard'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Dashboard Analitik</a>
            <a href="#" @click="currentMenu = 'productionSummary'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Rangkuman Produksi</a>
            <a href="#" @click="currentMenu = 'dataExport'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Export Data</a>
          </div>
        </div>

        <!-- CMS -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.cms}">
          <div @click="menuCollapse.cms = !menuCollapse.cms" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-newspaper w-5 mr-3 text-[#f0ab00]"></i>
              CMS (Konten Publik)
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.cms}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="#" @click="currentMenu = 'icsProfiles'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Profil ICS</a>
            <a href="#" @click="currentMenu = 'articles'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Artikel & Dokumentasi</a>
            <a href="#" @click="currentMenu = 'gallery'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Galeri Foto/Video</a>
          </div>
        </div>

        <!-- User Management -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.userManagement}">
          <div @click="menuCollapse.userManagement = !menuCollapse.userManagement" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-users-cog w-5 mr-3 text-[#f0ab00]"></i>
              Manajemen User
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.userManagement}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="UserRole" @click="currentMenu = 'userRoles'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">User & Role Management</a>
            <a href="menuAccess" @click="currentMenu = 'menuAccess'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Hak Akses Menu</a>
            <a href="ApprovalRole" @click="currentMenu = 'approvalRoles'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Approval Role</a>
            <a href="#" @click="currentMenu = 'activityLogs'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Riwayat Login & Aktivitas</a>
          </div>
        </div>

        <!-- System Admin -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.systemAdmin}">
          <div @click="menuCollapse.systemAdmin = !menuCollapse.systemAdmin" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-cog w-5 mr-3 text-[#f0ab00]"></i>
              Admin System
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.systemAdmin}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="#" @click="currentMenu = 'adminRegions'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Wilayah Administratif</a>
            <a href="#" @click="currentMenu = 'systemParams'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Parameter Sistem</a>
            <a href="#" @click="currentMenu = 'referenceData'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Data Referensi</a>
            <a href="#" @click="currentMenu = 'backupRestore'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Backup & Restore</a>
            <a href="#" @click="currentMenu = 'apiIntegration'" class="block px-4 py-2 rounded-md hover:bg-[#f0ab00] hover:text-black">Integrasi External API</a>
          </div>
        </div>
      </nav>
      <!-- Footer -->
      <div class="p-4 border-t border-yellow-500">
        <div class="flex items-center">
          <img src="https://ui-avatars.com/api/?name=WRI&background=000000&color=fff" class="w-10 h-10 rounded-full" />
          <div class="ml-3">
            <p class="text-sm font-medium">Admin WRI</p>
            <p class="text-xs text-white/70">Super Admin</p>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col overflow-hidden">
      <header class="h-20 bg-white border-b shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
          <h1 class="text-2xl font-bold text-gray-800"><?= $name_menu[$modified_uri] ?></h1>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text"
              class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Search..." />
          </div>
        </div>

        <!-- Notifikasi + Profil -->
        <div class="flex items-center space-x-6">
          <!-- Bell -->
          <button class="relative text-gray-500 hover:text-gray-700">
            <i class="fas fa-bell text-xl"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
          </button>

          <!-- Mail -->
          <button class="relative text-gray-500 hover:text-gray-700">
            <i class="fas fa-envelope text-xl"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
          </button>

          <!-- Profile Dropdown - Click Toggle with Alpine.js -->
          <div x-data="{ open: false }" class="relative">
            <!-- Trigger -->
            <button @click="open = !open" class="flex items-center space-x-3 cursor-pointer focus:outline-none">
              <img src="https://ui-avatars.com/api/?name=WRI&background=4299e1&color=fff"
                class="w-10 h-10 rounded-full border border-gray-300" />
              <div class="text-left">
                <p class="text-sm font-medium">Admin WRI</p>
                <p class="text-xs text-gray-500">Administrator</p>
              </div>
              <i class="fas fa-chevron-down text-xs text-gray-500"></i>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-20">
              <a href="profile"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                <i class="fas fa-user mr-2 w-4"></i> Profile
              </a>
              <a href="auth-login" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                <i class="fas fa-sign-out-alt mr-2 w-4"></i> Logout
              </a>
            </div>
          </div>

        </div>
      </header>