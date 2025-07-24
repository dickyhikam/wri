<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin WRI</title>
  <link rel="shortcut icon" href="img/logo2.png">
  <!-- Load Adobe Fonts -->
  <link rel="stylesheet" href="https://use.typekit.net/erz2zrt.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
      --font-acumin: "acumin-pro", sans-serif;
      --font-acumin-cond: "acumin-pro-condensed", sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      font-family: var(--font-acumin);
      color: #4A4A4A;
      background-color: #f8f9fa;
    }

    h1 {
      font-size: 30px;
      font-weight: 300;
      line-height: 1.2;
    }

    h2 {
      font-family: var(--font-acumin-cond);
      font-size: 23px;
      font-weight: 700;
      line-height: 1.1;
    }

    h3 {
      font-size: 22px;
      font-weight: 400;
      line-height: 1.1;
    }

    .description {
      font-size: 16px;
      line-height: 1.625;
    }

    .btn-lbl {
      text-align: center;
      display: inline-block;
      vertical-align: top;
      font-size: 14px;
      border: 1px solid #4a4a4a;
      border-radius: 3px;
      min-width: 170px;
      font-weight: 700;
      padding: 13px 20px;
    }

    .legend {
      font-weight: 400;
      font-size: 13px;
      text-transform: uppercase;
    }

    .chart-value {
      font-size: 12px;
      line-height: 1.2;
    }

    p {
      font-size: 18px;
      line-height: 1.77;
      font-weight: 300;
    }

    blockquote {
      font-size: 22px;
      line-height: 1.45;
      font-weight: 300;
      letter-spacing: -1px;
      padding: 20px 0 44px 15%;
    }

    blockquote cite {
      text-align: right;
      font-size: 16px;
    }

    blockquote cite strong {
      display: block;
      font-weight: 700;
    }

    /* Override Tailwind base font */
    .font-sans {
      font-family: var(--font-acumin) !important;
    }

    /* Sidebar styles */
    .sidebar-item.active {
      background-color: rgba(255, 255, 255, 0.2);
      font-weight: 500;
    }

    .sidebar-item:hover:not(.active) {
      background-color: rgba(255, 255, 255, 0.1);
    }

    /* Scrollbar styles */
    .custom-scroll::-webkit-scrollbar {
      width: 8px;
    }

    .custom-scroll::-webkit-scrollbar-track {
      background: transparent;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.4);
      border-radius: 4px;
    }

    .custom-scroll {
      scrollbar-width: thin;
      scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
    }

    [x-cloak] {
      display: none !important;
    }

    .menu-collapse {
      transition: all 0.3s ease;
    }

    .menu-collapse.collapsed .submenu {
      display: none;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800" x-data="{
    openModal: false,
    currentMenu: 'dashboard',
    menuCollapse: {
        masterData: false,
        projectManagement: false,
        analytics: false,
        cms: false,
        userManagement: false,
        systemAdmin: false
    }
}">
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar with Child Menus -->
    <aside class="w-64 bg-[#403c3c] text-white flex flex-col shadow-xl z-10">
      <!-- Logo -->
      <div class="h-20 flex items-center px-6 font-bold text-xl tracking-wide border-b border-yellow-500">
        <div class="flex items-center space-x-2">
          <img src="img/logo.png" alt="MIS Admin Logo" class="h-10 w-auto" />
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 overflow-y-auto py-4 space-y-1 text-sm">
        <!-- Dashboard -->
        <div>
          <a href="index" @click="currentMenu = 'dashboard'" :class="{'sidebar-item active': currentMenu === 'dashboard', 'sidebar-item': currentMenu !== 'dashboard'}" class="flex items-center px-6 py-3">
            <i class="fas fa-tachometer-alt w-5 mr-3 text-[#f0ab00]"></i>
            Dashboard
          </a>
        </div>

        <!-- Master Data -->
        <div class="menu-collapse" :class="{'collapsed': !menuCollapse.masterData}">
          <div @click="menuCollapse.masterData = !menuCollapse.masterData" class="sidebar-item flex items-center justify-between px-6 py-3 cursor-pointer">
            <div class="flex items-center">
              <i class="fas fa-database w-5 mr-3 text-[#f0ab00]"></i>
              Master Data
            </div>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" :class="{'transform rotate-180': menuCollapse.masterData}"></i>
          </div>
          <div class="submenu pl-14 pr-6 py-2 space-y-1">
            <a href="petani" @click="currentMenu = 'farmers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Petani</a>
            <a href="lahan" @click="currentMenu = 'plots'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Lahan/Persil</a>
            <a href="#" @click="currentMenu = 'parcel'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Parcel Data</a>
            <a href="ics" @click="currentMenu = 'ics'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">ICS & Fasilitator</a>
            <a href="pelatihan" @click="currentMenu = 'trainings'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Pelatihan</a>
            <a href="sertifikasi" @click="currentMenu = 'certifications'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Sertifikasi & Audit</a>
            <a href="pekerja" @click="currentMenu = 'workers'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Pekerja</a>
            <a href="transaksi" @click="currentMenu = 'transactions'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Transaksi</a>
            <a href="mitra" @click="currentMenu = 'partners'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Mitra & Organisasi</a>
            <a href="#" @click="currentMenu = 'hcv'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">HCV/NKT</a>
            <a href="kelompok_tani" @click="currentMenu = 'farmers_gt'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Kelompok Tani</a>
            <a href="produksi" @click="currentMenu = 'produksition'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Produksi</a>
            <a href="perawatan" @click="currentMenu = 'produksition'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Perawatan</a>
            <a href="limbah" @click="currentMenu = 'limbah'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Limbah B3 dan K3</a>
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
            <a href="#" @click="currentMenu = 'workplan'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Workplan Tracker</a>
            <a href="#" @click="currentMenu = 'fieldLogs'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Log Aktivitas Lapangan</a>
            <a href="#" @click="currentMenu = 'activityReports'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Laporan Kegiatan</a>
            <a href="#" @click="currentMenu = 'weeklyReports'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Laporan Mingguan</a>
            <a href="#" @click="currentMenu = 'finalReports'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Final & Intermediate Report</a>
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
            <a href="#" @click="currentMenu = 'queryBuilder'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Query Builder</a>
            <a href="analitik" @click="currentMenu = 'analyticsDashboard'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Dashboard Analitik</a>
            <a href="#" @click="currentMenu = 'productionSummary'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Rangkuman Produksi</a>
            <a href="#" @click="currentMenu = 'dataExport'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Export Data</a>
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
            <a href="#" @click="currentMenu = 'icsProfiles'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Profil ICS</a>
            <a href="#" @click="currentMenu = 'articles'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Artikel & Dokumentasi</a>
            <a href="#" @click="currentMenu = 'gallery'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Galeri Foto/Video</a>
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
            <a href="#" @click="currentMenu = 'userRoles'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">User & Role Management</a>
            <a href="#" @click="currentMenu = 'menuAccess'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Hak Akses Menu</a>
            <a href="#" @click="currentMenu = 'approvalRoles'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Approval Role</a>
            <a href="#" @click="currentMenu = 'activityLogs'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Riwayat Login & Aktivitas</a>
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
            <a href="#" @click="currentMenu = 'adminRegions'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Wilayah Administratif</a>
            <a href="#" @click="currentMenu = 'systemParams'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Parameter Sistem</a>
            <a href="#" @click="currentMenu = 'referenceData'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Data Referensi</a>
            <a href="#" @click="currentMenu = 'backupRestore'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Backup & Restore</a>
            <a href="#" @click="currentMenu = 'apiIntegration'" class="block px-4 py-2 rounded-md hover:bg-yellow-300 hover:text-black">Integrasi External API</a>
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
          <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Search..." />
          </div>
        </div>
        <div class="flex items-center space-x-6">
          <button class="relative text-gray-500 hover:text-gray-700">
            <i class="fas fa-bell text-xl"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
          </button>
          <button class="relative text-gray-500 hover:text-gray-700">
            <i class="fas fa-envelope text-xl"></i>
            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
          </button>
          <div class="flex items-center space-x-3">
            <img src="https://ui-avatars.com/api/?name=WRI&background=4299e1&color=fff" class="w-10 h-10 rounded-full" />
            <div>
              <p class="text-sm font-medium">Admin WRI</p>
              <p class="text-xs text-gray-500">Administrator</p>
            </div>
          </div>
        </div>
      </header>