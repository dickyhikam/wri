<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (isset($_SESSION['userFound'])) {
  // Pengguna sudah login
  $user = $_SESSION['userFound'];
}

$host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];

// Cek apakah '/wri' ada dalam path URI
if (strpos($request_uri, '/wri/') !== false) {
  // Jika '/wri' ada, hapus '/wri/' dari path URI
  $modified_uri = str_replace('/wri/', '', $request_uri);
} else {
  $modified_uri = $request_uri;
}

// Cek apakah ada karakter '/' dalam modified_uri
// Jika ada '/', hapus semua '/' dalam URI
if (strpos($modified_uri, '/') !== false) {
  $modified_uri = str_replace('/', '', $modified_uri);
}

// Cek apakah ada tanda '?' dalam URI (menandakan ada parameter query)
if (strpos($modified_uri, '?') !== false) {
  // Hapus semua yang ada setelah '?' (termasuk tanda '?')
  $modified_uri = strtok($modified_uri, '?');
}


$name_menu = [
  '' => 'Dashboard',
  'index' => 'Dashboard',
  'index-user' => 'Dashboard User',
  'petani' => 'Petani',
  'lahan' => 'Lahan/Persil',
  'parcel' => 'Parcel Data',
  'ics' => 'ICS & Fasilitator',
  'pelatihan' => 'Pelatihan',
  'sertifikasi' => 'Sertifikasi & Audit',
  'pekerja' => 'Pekerja',
  'transaksi' => 'Transaksi Produksi',
  'mitra' => 'Mitra & Organisasi',
  'nkt' => 'HCV/NKT',
  'kelompok_tani' => 'Kelompok Tani',
  'produksi' => 'Produksi',
  'perawatan' => 'Perawatan',
  'limbah' => 'Limbah B3 dan K3',
  'workplan' => 'WorkPlan',
  'role' => 'Role',
  'keselamatan' => 'Kecelakaan Kerja',
  'profile' => 'Profile',
  'user' => 'User',
  'akses-menu' => 'Akses Menu',
  'menu' => 'Menu',
  'region' => 'Region'
];
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $name_menu[$modified_uri] ?? '' ?> | MIS</title>
  <!-- icon -->
  <link rel="icon" href="img/logo2.png" />
  <!-- Load Adobe Fonts -->
  <link rel="stylesheet" href="https://use.typekit.net/erz2zrt.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="assets/layout.css" />

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <!-- Include SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <img src="img/logo-text.png" alt="MIS Admin Logo" class="h-10 w-auto" style="width: auto; height: 120px" />
          </a>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 overflow-y-auto py-4 space-y-1 text-sm">
        <!-- Dashboard -->
        <div <?php echo ($user['akun']['role'] == 'User') ? '' : 'hidden'; ?>>
          <a href="index-user" @click="currentMenu = 'dashboard'" class="flex items-center px-6 py-3 <?php echo ($name_menu[$modified_uri] == 'Dashboard User') ? 'sidebar-item active' : ''; ?>">
            <i class="fas fa-tachometer-alt w-5 mr-3 text-[#f0ab00]"></i>
            Dashboard
          </a>
        </div>
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.dashboard, 'sidebar-item active': currentMenu === 'Role' || currentMenu === 'Parcel Data' || currentMenu === 'Petani' || currentMenu === 'Lahan/Persil' || currentMenu === 'Pekerja' || currentMenu === 'Mitra & Organisasi' || currentMenu === 'Kelompok Tani'}">
          <div @click="menuCollapse.dashboard = !menuCollapse.dashboard" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-tachometer-alt w-5 mr-3 text-[#f0ab00]"></i>
              Dashboard
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.dashboard}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="index" @click="currentMenu = 'dashboard'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard') ? 'sidebar-item active' : ''; ?>">Utama</a>
            <a href="dashboard_petani" @click="currentMenu = 'role'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard Petani') ? 'sidebar-item active' : ''; ?>">Petani</a>
            <a href="dashboard_training" @click="currentMenu = 'parcel'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard Training') ? 'sidebar-item active' : ''; ?>">Training</a>
            <a href="dashboard_bmp" @click="currentMenu = 'farmers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard BMP') ? 'sidebar-item active' : ''; ?>">BMP</a>
            <a href="dashboard_k3" @click="currentMenu = 'plots'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard K3') ? 'sidebar-item active' : ''; ?>">K3</a>
            <a href="dashboard_hcv" @click="currentMenu = 'workers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard HCV') ? 'sidebar-item active' : ''; ?>">HCV</a>
            <a href="dashboard_supply_chain" @click="currentMenu = 'partners'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard Supply Chain') ? 'sidebar-item active' : ''; ?>">Supply Chain</a>
            <a href="dashboard_interactive_map" @click="currentMenu = 'farmers_gt'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Dashboard Interactive MAP') ? 'sidebar-item active' : ''; ?>">Interactive MAP</a>
          </div>
        </div>

        <!-- Master Data -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.masterData, 'sidebar-item active': currentMenu === 'Role' || currentMenu === 'Parcel Data' || currentMenu === 'Petani' || currentMenu === 'Lahan/Persil' || currentMenu === 'Pekerja' || currentMenu === 'Mitra & Organisasi' || currentMenu === 'Kelompok Tani'}">
          <div @click="menuCollapse.masterData = !menuCollapse.masterData" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-database w-5 mr-3 text-[#f0ab00]"></i>
              Master Data
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.masterData}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a <?php echo ($user['akun']['role'] == 'Super Admin') ? '' : 'style="display:none;"'; ?> href="role" @click="currentMenu = 'role'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Role') ? 'sidebar-item active' : ''; ?>">Role</a>
            <a <?php echo ($user['akun']['role'] == 'Super Admin') ? '' : 'style="display:none;"'; ?> href="parcel" @click="currentMenu = 'parcel'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Parcel Data') ? 'sidebar-item active' : ''; ?>">Parcel Data</a>
            <a <?php echo ($user['akun']['role'] == 'Super Admin') ? '' : 'style="display:none;"'; ?> href="region" @click="currentMenu = 'region'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Region') ? 'sidebar-item active' : ''; ?>">Region</a>
            <a href="petani" @click="currentMenu = 'farmers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Petani') ? 'sidebar-item active' : ''; ?>">Petani</a>
            <a href="lahan" @click="currentMenu = 'plots'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Lahan/Persil') ? 'sidebar-item active' : ''; ?>">Lahan/Persil</a>
            <a href="pekerja" @click="currentMenu = 'workers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Pekerja') ? 'sidebar-item active' : ''; ?>">Pekerja</a>
            <a href="mitra" @click="currentMenu = 'partners'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Mitra & Organisasi') ? 'sidebar-item active' : ''; ?>">Mitra & Organisasi</a>
            <a href="kelompok_tani" @click="currentMenu = 'farmers_gt'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Kelompok Tani') ? 'sidebar-item active' : ''; ?>">Kelompok Tani</a>
          </div>
        </div>

        <!-- WorkPlan -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?>>
          <a href="workplan" @click="currentMenu = 'workplan'" class="flex items-center px-6 py-3 <?php echo ($name_menu[$modified_uri] == 'WorkPlan') ? 'sidebar-item active' : ''; ?>">
            <i class="fas fa-project-diagram w-5 mr-3 text-[#f0ab00]"></i>
            WorkPlan
          </a>
        </div>

        <!-- Audit -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?>>
          <a href="sertifikasi" @click="currentMenu = 'sertifikasi'" class="flex items-center px-6 py-3 <?php echo ($name_menu[$modified_uri] == 'Sertifikasi & Audit') ? 'sidebar-item active' : ''; ?>">
            <i class="fas fa-user-secret w-5 mr-3 text-[#f0ab00]"></i>
            Audit
          </a>
        </div>

        <!-- HCV -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?>>
          <a href="nkt" @click="currentMenu = 'nkt'" class="flex items-center px-6 py-3 <?php echo ($name_menu[$modified_uri] == 'HCV/NKT') ? 'sidebar-item active' : ''; ?>">
            <i class="fas fa-chart-line w-5 mr-3 text-[#f0ab00]"></i>
            HCV
          </a>
        </div>

        <!-- Transaksi Produksi -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?>>
          <a href="transaksi" @click="currentMenu = 'nkt'" class="flex items-center px-6 py-3 <?php echo ($name_menu[$modified_uri] == 'Transaksi Produksi') ? 'sidebar-item active' : ''; ?>">
            <i class="fas fa-sack-dollar w-5 mr-3 text-[#f0ab00]"></i>
            Transaksi Produksi
          </a>
        </div>

        <!-- BMP -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.bmp, 'sidebar-item active': currentMenu === 'produksition'}">
          <div @click="menuCollapse.bmp = !menuCollapse.bmp" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-warehouse w-5 mr-3 text-[#f0ab00]"></i>
              BMP
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.bmp}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="perawatan" @click="currentMenu = 'produksition'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Perawatan') ? 'sidebar-item active' : ''; ?>">Perawatan</a>
            <a href="produksi" @click="currentMenu = 'produksition'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Produksi') ? 'sidebar-item active' : ''; ?>">Produksi</a>
          </div>
        </div>

        <!-- K3 -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.k3, 'sidebar-item active': currentMenu === 'limbah' || currentMenu === 'keselamatan' || currentMenu === 'productionSummary'}">
          <div @click="menuCollapse.k3 = !menuCollapse.k3" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-user-shield w-5 mr-3 text-[#f0ab00]"></i>
              K3
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.k3}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="limbah" @click="currentMenu = 'limbah'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Limbah B3 dan K3') ? 'sidebar-item active' : ''; ?>">Limbah</a>
            <a href="keselamatan" @click="currentMenu = 'keselamatan'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Kecelakaan Kerja') ? 'sidebar-item active' : ''; ?>">Kecelakaan Kerja</a>
            <a href="#" @click="currentMenu = 'productionSummary'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Safety Awareness') ? 'sidebar-item active' : ''; ?>">Safety Awareness</a>
          </div>
        </div>

        <!-- ICS -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.ics, 'sidebar-item active': currentMenu === 'queryBuilder' || currentMenu === 'analyticsDashboard' || currentMenu === 'productionSummary' || currentMenu === 'dataExport'}">
          <div @click="menuCollapse.ics = !menuCollapse.ics" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-users w-5 mr-3 text-[#f0ab00]"></i>
              ICS
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.ics}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="ics" @click="currentMenu = 'queryBuilder'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'ICS & Fasilitator') ? 'sidebar-item active' : ''; ?>">List Data</a>
            <a href="galery" @click="currentMenu = 'analyticsDashboard'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Galery') ? 'sidebar-item active' : ''; ?>">Galery</a>
            <a href="fasilitas" @click="currentMenu = 'productionSummary'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Fasilitas') ? 'sidebar-item active' : ''; ?>">Fasilitas</a>
            <a href="organisasi" @click="currentMenu = 'dataExport'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Organisasi') ? 'sidebar-item active' : ''; ?>">Organisasi</a>
            <a href="pelatihan" @click="currentMenu = 'dataExport'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Pelatihan') ? 'sidebar-item active' : ''; ?>">Pelatihan</a>
            <a href="aktivitas" @click="currentMenu = 'dataExport'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Aktivity') ? 'sidebar-item active' : ''; ?>">Aktivitas</a>
          </div>
        </div>

        <div <?php echo ($user['akun']['role'] == 'Super Admin' || $user['akun']['role'] == 'User ICS') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.report, 'sidebar-item active': currentMenu === 'Role' || currentMenu === 'Parcel Data' || currentMenu === 'Petani' || currentMenu === 'Lahan/Persil' || currentMenu === 'Pekerja' || currentMenu === 'Mitra & Organisasi' || currentMenu === 'Kelompok Tani'}">
          <div @click="menuCollapse.report = !menuCollapse.report" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-file-invoice w-5 mr-3 text-[#f0ab00]"></i>
              Report
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.report}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="report_transaksi" @click="currentMenu = 'role'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Report Transaksi') ? 'sidebar-item active' : ''; ?>">Transaksi</a>
            <a href="report_training" @click="currentMenu = 'parcel'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Report Training') ? 'sidebar-item active' : ''; ?>">Training</a>
            <a href="report_bmp" @click="currentMenu = 'farmers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Report BMP') ? 'sidebar-item active' : ''; ?>">BMP</a>
            <a href="report_k3" @click="currentMenu = 'plots'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Report K3') ? 'sidebar-item active' : ''; ?>">K3</a>
            <a href="report_hcv" @click="currentMenu = 'workers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Report HCV') ? 'sidebar-item active' : ''; ?>">HCV</a>
          </div>
        </div>

        <!-- User Management -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.userManagement}">
          <div @click="menuCollapse.userManagement = !menuCollapse.userManagement" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-users-cog w-5 mr-3 text-[#f0ab00]"></i>
              Manajemen User
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.userManagement}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="user" @click="currentMenu = 'user'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'User') ? 'sidebar-item active' : ''; ?>">User</a>
            <a href="user-log" @click="currentMenu = 'userLog'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black hidden">User Log</a>
          </div>
        </div>

        <!-- System Admin -->
        <div <?php echo ($user['akun']['role'] == 'Super Admin') ? '' : 'hidden'; ?> class="menu-collapse" :class="{'collapsed': !menuCollapse.systemAdmin}">
          <div @click="menuCollapse.systemAdmin = !menuCollapse.systemAdmin" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-cog w-5 mr-3 text-[#f0ab00]"></i>
              Utility
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.systemAdmin}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="menu" @click="currentMenu = 'menu'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Menu') ? 'sidebar-item active' : ''; ?>">Menu</a>
            <a href="akses-menu" @click="currentMenu = 'aksesMenu'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black <?php echo ($name_menu[$modified_uri] == 'Akses Menu') ? 'sidebar-item active' : ''; ?>">Akses Menu</a>
          </div>
        </div>

      </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col overflow-hidden">
      <header class="h-20 bg-white border-b shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
          <h1 class="text-2xl font-bold text-gray-800" hidden><?= $name_menu[$modified_uri] ?></h1>
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
          <!-- Bell Icon with Notification Badge -->
          <div class="relative text-gray-500 hover:text-gray-700">
            <button id="bellButton" class="relative text-gray-500 hover:text-gray-700">
              <i class="fas fa-bell text-3xl"></i>
              <span id="notificationBadge" class="absolute top-0 right-0 h-4 w-4 rounded-full bg-red-500 text-white text-xs flex items-center justify-center">3</span>
            </button>

            <!-- Dropdown Notification Menu -->
            <div id="notificationDropdown" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-md border border-gray-300 hidden">
              <ul class="space-y-2 p-2">
                <li class="flex items-center p-2 hover:bg-gray-100 rounded-md">
                  <i class="fas fa-user text-gray-500 mr-2"></i>
                  <span>Pengguna baru mendaftar: <strong id="newUserName">Jabir ibn Aflah</strong></span> <!-- Menampilkan nama pengguna -->
                </li>
                <li class="flex items-center p-2 hover:bg-gray-100 rounded-md">
                  <i class="fas fa-user text-gray-500 mr-2"></i>
                  <span>Pengguna baru mendaftar: <strong id="newUserName">Thomas Alva Edison</strong></span> <!-- Menampilkan nama pengguna -->
                </li>
                <li class="flex items-center p-2 hover:bg-gray-100 rounded-md">
                  <i class="fas fa-user text-gray-500 mr-2"></i>
                  <span>Pengguna baru mendaftar: <strong id="newUserName">Tesla Nikola</strong></span> <!-- Menampilkan nama pengguna -->
                </li>
              </ul>
            </div>
          </div>

          <!-- Profile Dropdown - Click Toggle with Alpine.js -->
          <div x-data="{ open: false }" class="relative">
            <!-- Trigger -->
            <button @click="open = !open" class="flex items-center space-x-3 cursor-pointer focus:outline-none">
              <img src="https://ui-avatars.com/api/?name=WRI&background=4299e1&color=fff"
                class="w-10 h-10 rounded-full border border-gray-300" />
              <div class="text-left">
                <p class="text-sm font-medium"><?= $user['profile']['name'] ?></p>
                <p class="text-xs text-gray-500"><?= $user['akun']['role'] ?></p>
              </div>
              <i class="fas fa-chevron-down text-xs text-gray-500"></i>
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg z-20">
              <a href="profile"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600">
                <i class="fas fa-user mr-2 w-4"></i> Profile
              </a>
              <a href="logout" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                <i class="fas fa-sign-out-alt mr-2 w-4"></i> Logout
              </a>
            </div>
          </div>

        </div>
      </header>

      <script>
        // Reusable SweetAlert function
        function showSweetAlert(icon, title, text, autoClose, menu) {
          if (autoClose) {
            // Auto-close alert after a set time (e.g., 3000 milliseconds or 3 seconds)
            Swal.fire({
              icon: icon, // 'success', 'error', etc.
              title: title, // The title of the modal
              text: text, // The message shown inside the modal
              background: '#f3f4f6', // The background color of the modal
              allowOutsideClick: false, // Disable clicking outside the modal
              allowEscapeKey: false, // Disable closing with the Escape key
              timer: 3000, // Auto-close after 3 seconds
              timerProgressBar: true, // Show progress bar for the timer
            }).then(() => {
              // Optional: If you want to redirect to a specific page after auto-close
              if (menu !== '') {
                window.location.href = menu; // Replace with your actual dashboard URL
              }
            });
          } else {
            // Error alert that requires the user to click "OK" to close
            Swal.fire({
              icon: icon, // 'error' for invalid OTP
              title: title, // The title of the modal
              text: text, // The message shown inside the modal
              confirmButtonText: 'OK', // The button text
              background: '#f3f4f6', // The background color of the modal
              allowOutsideClick: false, // Disable clicking outside the modal
              allowEscapeKey: false, // Disable closing with the Escape key
            }).then((result) => {
              // No navigation needed for error, but we can handle any action if required
              if (result.isConfirmed) {
                // Handle the action after the user clicks "OK"
                // For example, you could clear the OTP inputs or perform other actions
              }
            });
          }
        }

        // Menampilkan dropdown ketika ikon bell diklik
        document.getElementById('bellButton').addEventListener('click', function() {
          const dropdown = document.getElementById('notificationDropdown');
          const badge = document.getElementById('notificationBadge');

          // Toggle dropdown visibility
          dropdown.classList.toggle('hidden');

          // Jika ada notifikasi, setel badge untuk menghilang
          if (badge) {
            badge.style.display = 'none'; // Menyembunyikan badge saat dropdown muncul
          }
        });

        // Fungsi untuk menutup dropdown jika area di luar dropdown diklik
        window.addEventListener('click', function(e) {
          const dropdown = document.getElementById('notificationDropdown');
          const bellButton = document.getElementById('bellButton');

          if (!bellButton.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden'); // Menyembunyikan dropdown jika klik di luar
          }
        });
      </script>

      <?php
      // Memeriksa apakah session email sudah ada
      if (isset($_SESSION['userFound'])) {
      } else {
        // Menampilkan SweetAlert jika pengguna belum login
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Anda belum melakukan login. Silakan login terlebih dahulu.',
                confirmButtonText: 'OK',
                background: '#f3f4f6',
                backdrop: 'rgba(0, 0, 0, 1)',
                allowOutsideClick: false, // Disable clicking outside the modal
                allowEscapeKey: false, // Disable closing with the Escape key
            }).then(function() {
                // Setelah alert ditutup, arahkan pengguna ke halaman login
                window.location.href = 'auth-login'; // Arahkan ke halaman login
            });
          </script>";

        // exit(); // Menghentikan eksekusi lebih lanjut setelah pengalihan
      }
      ?>