<?php
include 'header.php';
?>


<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Dashboard Analitik</h2>
        <p class="opacity-90">Analisis komprehensif performa petani, lahan, transaksi, dan keberlanjutan</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-chart-line text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Analytics Navigation Tabs -->
  <div class="flex overflow-x-auto pb-2 mb-6 scrollbar-hide">
    <div class="flex space-x-2">
      <button id="tab-farmer" class="tab-button px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium whitespace-nowrap active">Farmer Performance</button>
      <button id="tab-land" class="tab-button px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-50">Land & Environment</button>
      <button id="tab-economic" class="tab-button px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-50">Economic Transaction</button>
      <button id="tab-sustainability" class="tab-button px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-50">RSPO & Sustainability</button>
      <button id="tab-map" class="tab-button px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-gray-50">Interactive Map</button>
    </div>
  </div>

  <!-- Farmer Performance Tab Content -->
  <div id="content-farmer" class="tab-content active">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-xl">Farmer Performance</h3>
      <div class="flex space-x-2">
        <div class="relative">
          <select class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Semua Wilayah</option>
            <option>Pelalawan</option>
            <option>Siak</option>
            <option>Inhu</option>
          </select>
          <i class="fas fa-chevron-down absolute right-3 top-3 text-xs text-gray-500"></i>
        </div>
        <div class="relative">
          <select class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Tahun Ini</option>
            <option>Tahun Lalu</option>
            <option>5 Tahun Terakhir</option>
          </select>
          <i class="fas fa-chevron-down absolute right-3 top-3 text-xs text-gray-500"></i>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Total Petani Aktif</p>
            <h3 class="text-2xl font-bold">1,284</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.5% dari tahun lalu</p>
          </div>
          <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
            <i class="fas fa-users text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Rata-rata Produksi (Kg/Ha)</p>
            <h3 class="text-2xl font-bold">2,450</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 3.2% dari tahun lalu</p>
          </div>
          <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <i class="fas fa-seedling text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Plot Aktif</p>
            <h3 class="text-2xl font-bold">3,672</h3>
            <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 1.8% dari tahun lalu</p>
          </div>
          <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
            <i class="fas fa-map-marked-alt text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Kehadiran Training</p>
            <h3 class="text-2xl font-bold">78%</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 5.3% dari tahun lalu</p>
          </div>
          <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
            <i class="fas fa-chalkboard-teacher text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Distribusi Produktivitas Petani</h4>
          <button class="text-blue-600 text-sm font-medium">Detail</button>
        </div>
        <canvas id="productivityChart" height="250"></canvas>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Trend Produksi per Bulan</h4>
          <div class="flex space-x-2">
            <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">TBS</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">CPO</button>
          </div>
        </div>
        <canvas id="monthlyProductionChart" height="250"></canvas>
      </div>
    </div>
  </div>

  <!-- Land & Environment Tab Content -->
  <div id="content-land" class="tab-content">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-xl">Land & Environment</h3>
      <div class="flex space-x-2">
        <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium flex items-center">
          <i class="fas fa-layer-group mr-2"></i> Layer Peta
        </button>
        <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium flex items-center">
          <i class="fas fa-download mr-2"></i> Export
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Area HCV</p>
            <h3 class="text-2xl font-bold">1,245 Ha</h3>
            <p class="text-xs text-gray-500 mt-1">4.2% dari total area</p>
          </div>
          <div class="bg-red-100 text-red-600 p-3 rounded-lg">
            <i class="fas fa-tree text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Area NKT</p>
            <h3 class="text-2xl font-bold">856 Ha</h3>
            <p class="text-xs text-gray-500 mt-1">2.9% dari total area</p>
          </div>
          <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <i class="fas fa-leaf text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Titik Api (6 Bulan)</p>
            <h3 class="text-2xl font-bold">24</h3>
            <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 20% dari periode lalu</p>
          </div>
          <div class="bg-orange-100 text-orange-600 p-3 rounded-lg">
            <i class="fas fa-fire text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Distribusi Area HCV/NKT</h4>
          <button class="text-blue-600 text-sm font-medium">Detail</button>
        </div>
        <canvas id="hcvChart" height="250"></canvas>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-2">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Peta Sebaran Lahan</h4>
          <div class="flex space-x-2">
            <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">HCV</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">NKT</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">Titik Api</button>
          </div>
        </div>
        <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center">
          <i class="fas fa-map-marked-alt text-4xl text-gray-400"></i>
          <p class="ml-3 text-gray-500">Klik tab 'Interactive Map' untuk melihat peta detail</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Economic Transaction Tab Content -->
  <div id="content-economic" class="tab-content">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-xl">Economic Transaction</h3>
      <div class="flex space-x-2">
        <div class="relative">
          <select class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Semua Komoditas</option>
            <option>TBS</option>
            <option>CPO</option>
            <option>Kernel</option>
          </select>
          <i class="fas fa-chevron-down absolute right-3 top-3 text-xs text-gray-500"></i>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Total Penjualan</p>
            <h3 class="text-2xl font-bold">Rp 12.8M</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 15.2% dari tahun lalu</p>
          </div>
          <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
            <i class="fas fa-money-bill-wave text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Rata-rata Harga/Kg</p>
            <h3 class="text-2xl font-bold">Rp 2,450</h3>
            <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 3.5% dari tahun lalu</p>
          </div>
          <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <i class="fas fa-tags text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Total Buyer</p>
            <h3 class="text-2xl font-bold">18</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 2 baru tahun ini</p>
          </div>
          <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
            <i class="fas fa-warehouse text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Distribusi Pembeli</h4>
          <button class="text-blue-600 text-sm font-medium">Detail</button>
        </div>
        <canvas id="buyerChart" height="250"></canvas>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Trend Harga Komoditas</h4>
          <div class="flex space-x-2">
            <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">TBS</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">CPO</button>
          </div>
        </div>
        <canvas id="priceTrendChart" height="250"></canvas>
      </div>
    </div>
  </div>

  <!-- RSPO & Sustainability Tab Content -->
  <div id="content-sustainability" class="tab-content">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-xl">RSPO & Sustainability Compliance</h3>
      <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium flex items-center">
        <i class="fas fa-file-export mr-2"></i> Export Report
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Sudah RSPO</p>
            <h3 class="text-2xl font-bold text-green-600">220</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 15.8% dari tahun lalu</p>
          </div>
          <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <i class="fas fa-certificate text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Dalam Proses</p>
            <h3 class="text-2xl font-bold text-yellow-600">142</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 22.4% dari tahun lalu</p>
          </div>
          <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
            <i class="fas fa-spinner text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Belum Mulai</p>
            <h3 class="text-2xl font-bold text-red-600">58</h3>
            <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 35.6% dari tahun lalu</p>
          </div>
          <div class="bg-red-100 text-red-600 p-3 rounded-lg">
            <i class="fas fa-times-circle text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">CPO Terhubung</p>
            <h3 class="text-2xl font-bold">78%</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.3% dari tahun lalu</p>
          </div>
          <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
            <i class="fas fa-link text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Progress Sertifikasi per ICS</h4>
          <div class="flex space-x-2">
            <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">RSPO</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">ISPO</button>
          </div>
        </div>
        <canvas id="certificationChart" height="300"></canvas>
      </div>
    </div>
  </div>

  <!-- Interactive Map Tab Content -->
  <div id="content-map" class="tab-content">
    <div class="flex justify-between items-center mb-4">
      <h3 class="font-semibold text-xl">Interactive Map</h3>
      <div class="flex space-x-2">
        <div class="relative">
          <select id="map-layer-select" class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="all">Semua Lahan</option>
            <option value="certified">Lahan Bersertifikat</option>
            <option value="hcv">Area HCV</option>
            <option value="nkt">Area NKT</option>
            <option value="hotspot">Titik Api</option>
          </select>
          <i class="fas fa-chevron-down absolute right-3 top-3 text-xs text-gray-500"></i>
        </div>
        <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium flex items-center">
          <i class="fas fa-download mr-2"></i> Export
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Total Area (Ha)</p>
            <h3 class="text-2xl font-bold">29,650</h3>
            <p class="text-xs text-gray-500 mt-1">3 kabupaten</p>
          </div>
          <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
            <i class="fas fa-map-marked-alt text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Plot Terpetakan</p>
            <h3 class="text-2xl font-bold">3,672</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12% dari tahun lalu</p>
          </div>
          <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <i class="fas fa-map-pin text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Plot Bersertifikat</p>
            <h3 class="text-2xl font-bold">1,024</h3>
            <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 28% dari tahun lalu</p>
          </div>
          <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
            <i class="fas fa-certificate text-xl"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between">
          <div>
            <p class="text-sm font-medium text-gray-500 mb-1">Kepadatan Plot</p>
            <h3 class="text-2xl font-bold">8.2/Ha</h3>
            <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 1.5% dari tahun lalu</p>
          </div>
          <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
            <i class="fas fa-chart-area text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
      <div class="flex justify-between items-center mb-4">
        <h4 class="font-medium">Peta Interaktif Lahan Petani</h4>
        <div class="flex space-x-2">
          <button id="map-zoom-in" class="px-3 py-1 bg-white border border-gray-300 rounded-lg text-sm">
            <i class="fas fa-search-plus"></i>
          </button>
          <button id="map-zoom-out" class="px-3 py-1 bg-white border border-gray-300 rounded-lg text-sm">
            <i class="fas fa-search-minus"></i>
          </button>
          <button id="map-reset" class="px-3 py-1 bg-white border border-gray-300 rounded-lg text-sm">
            <i class="fas fa-globe-asia"></i>
          </button>
        </div>
      </div>
      
      <div class="map-container">
        <div id="map"></div>
        <div class="map-overlay">
          <div class="legend">
            <h4>Legenda</h4>
            <div><i style="background: #2b83ba"></i> Lahan Petani</div>
            <div><i style="background: #d7191c"></i> Area HCV</div>
            <div><i style="background: #fdae61"></i> Area NKT</div>
            <div><i style="background: #000000"></i> Titik Api</div>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Distribusi Lahan per Kabupaten</h4>
          <button class="text-blue-600 text-sm font-medium">Detail</button>
        </div>
        <canvas id="landDistributionChart" height="250"></canvas>
      </div>
      
      <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
          <h4 class="font-medium">Kepadatan Lahan per Wilayah</h4>
          <div class="flex space-x-2">
            <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">Per Ha</button>
            <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">Per ICS</button>
          </div>
        </div>
        <canvas id="landDensityChart" height="250"></canvas>
      </div>
    </div>
  </div>
</section>

      <footer class="bg-white border-t py-4 px-8 text-sm text-gray-600">
        <div class="flex justify-between items-center">
          <div>
            © 2023 WRI Dashboard - All rights reserved
          </div>
          <div class="flex space-x-4">
            <a href="#" class="hover:text-gray-800">Privacy Policy</a>
            <a href="#" class="hover:text-gray-800">Terms of Service</a>
            <a href="#" class="hover:text-gray-800">Contact Us</a>
          </div>
        </div>
      </footer>
    </main>
  </div>

  <!-- Leaflet JS for maps -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
      // Tab switching
      const tabs = document.querySelectorAll('.tab-button');
      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          // Remove active class from all tabs and contents
          document.querySelectorAll('.tab-button').forEach(t => t.classList.remove('active'));
          document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
          
          // Add active class to clicked tab
          this.classList.add('active');
          
          // Show corresponding content
          const contentId = this.id.replace('tab-', 'content-');
          document.getElementById(contentId).classList.add('active');
          
          // Initialize map if it's the map tab
          if (this.id === 'tab-map' && !window.mapInitialized) {
            initMap();
            window.mapInitialized = true;
          }
        });
      });
      
      // Initialize charts
      initCharts();
    });

    // Initialize all charts
    function initCharts() {
      // Farmer Performance Charts
      initProductivityChart();
      initMonthlyProductionChart();
      
      // Land & Environment Charts
      initHcvChart();
      
      // Economic Transaction Charts
      initBuyerChart();
      initPriceTrendChart();
      
      // RSPO & Sustainability Charts
      initCertificationChart();
      
      // Map Tab Charts
      initLandDistributionChart();
      initLandDensityChart();
    }

    // Chart initialization functions
    function initProductivityChart() {
      const ctx = document.getElementById('productivityChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['<1 ton', '1-2 ton', '2-3 ton', '3-4 ton', '>4 ton'],
          datasets: [{
            label: 'Jumlah Petani',
            data: [120, 450, 520, 310, 85],
            backgroundColor: [
              'rgba(54, 162, 235, 0.7)',
              'rgba(75, 192, 192, 0.7)',
              'rgba(255, 206, 86, 0.7)',
              'rgba(153, 102, 255, 0.7)',
              'rgba(255, 99, 132, 0.7)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Jumlah Petani'
              }
            }
          }
        }
      });
    }

    function initMonthlyProductionChart() {
      const ctx = document.getElementById('monthlyProductionChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Produksi TBS (ton)',
            data: [1250, 1900, 2100, 2400, 2300, 2500, 2700, 2600, 2450, 2200, 2000, 1800],
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.1)',
            tension: 0.3,
            fill: true
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: false,
              title: {
                display: true,
                text: 'Produksi (ton)'
              }
            }
          }
        }
      });
    }

    function initHcvChart() {
      const ctx = document.getElementById('hcvChart').getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['HCV Area', 'NKT Area', 'Lahan Produktif', 'Lahan Non-Aktif'],
          datasets: [{
            data: [1245, 856, 25600, 1949],
            backgroundColor: [
              'rgba(255, 99, 132, 0.7)',
              'rgba(255, 159, 64, 0.7)',
              'rgba(75, 192, 192, 0.7)',
              'rgba(201, 203, 207, 0.7)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(201, 203, 207, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });
    }

    function initBuyerChart() {
      const ctx = document.getElementById('buyerChart').getContext('2d');
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['PT. A', 'PT. B', 'PT. C', 'PT. D', 'Lainnya'],
          datasets: [{
            data: [35, 25, 20, 15, 5],
            backgroundColor: [
              'rgba(54, 162, 235, 0.7)',
              'rgba(255, 99, 132, 0.7)',
              'rgba(255, 206, 86, 0.7)',
              'rgba(75, 192, 192, 0.7)',
              'rgba(153, 102, 255, 0.7)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });
    }

    function initPriceTrendChart() {
      const ctx = document.getElementById('priceTrendChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Harga TBS (Rp/Kg)',
            data: [2450, 2500, 2550, 2600, 2580, 2520, 2480, 2460, 2420, 2400, 2380, 2350],
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.1)',
            tension: 0.3,
            fill: true,
            yAxisID: 'y'
          }, {
            label: 'Harga CPO (Rp/Kg)',
            data: [8500, 8600, 8700, 8800, 8900, 8850, 8750, 8650, 8550, 8450, 8350, 8250],
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.1)',
            tension: 0.3,
            fill: true,
            yAxisID: 'y1'
          }]
        },
        options: {
          responsive: true,
          interaction: {
            mode: 'index',
            intersect: false,
          },
          plugins: {
            legend: {
              position: 'top',
            }
          },
          scales: {
            y: {
              type: 'linear',
              display: true,
              position: 'left',
              title: {
                display: true,
                text: 'Harga TBS (Rp/Kg)'
              }
            },
            y1: {
              type: 'linear',
              display: true,
              position: 'right',
              title: {
                display: true,
                text: 'Harga CPO (Rp/Kg)'
              },
              grid: {
                drawOnChartArea: false,
              }
            }
          }
        }
      });
    }

    function initCertificationChart() {
      const ctx = document.getElementById('certificationChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['ICS 1', 'ICS 2', 'ICS 3', 'ICS 4', 'ICS 5', 'ICS 6', 'ICS 7', 'ICS 8'],
          datasets: [{
            label: 'Sudah RSPO',
            data: [35, 28, 42, 15, 30, 25, 18, 27],
            backgroundColor: 'rgba(75, 192, 192, 0.7)'
          }, {
            label: 'Dalam Proses',
            data: [20, 15, 18, 25, 12, 15, 22, 15],
            backgroundColor: 'rgba(255, 206, 86, 0.7)'
          }, {
            label: 'Belum Mulai',
            data: [5, 7, 0, 10, 8, 10, 10, 8],
            backgroundColor: 'rgba(255, 99, 132, 0.7)'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            }
          },
          scales: {
            x: {
              stacked: true,
            },
            y: {
              stacked: true,
              title: {
                display: true,
                text: 'Jumlah Petani'
              }
            }
          }
        }
      });
    }

    function initLandDistributionChart() {
      const ctx = document.getElementById('landDistributionChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Pelalawan', 'Siak', 'Inhu'],
          datasets: [{
            label: 'Luas Lahan (Ha)',
            data: [12500, 9850, 7300],
            backgroundColor: [
              'rgba(54, 162, 235, 0.7)',
              'rgba(255, 99, 132, 0.7)',
              'rgba(255, 206, 86, 0.7)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Luas Lahan (Ha)'
              }
            }
          }
        }
      });
    }

    function initLandDensityChart() {
      const ctx = document.getElementById('landDensityChart').getContext('2d');
      new Chart(ctx, {
        type: 'radar',
        data: {
          labels: ['Pelalawan', 'Siak', 'Inhu', 'Wilayah A', 'Wilayah B', 'Wilayah C'],
          datasets: [{
            label: 'Kepadatan Lahan',
            data: [65, 59, 90, 81, 56, 55],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            r: {
              angleLines: {
                display: true
              },
              suggestedMin: 0,
              suggestedMax: 100
            }
          }
        }
      });
    }

    // Map initialization
    function initMap() {
      // Initialize the map centered on Riau, Indonesia
      const map = L.map('map').setView([0.2933, 101.7068], 9);
      
      // Add OpenStreetMap tiles
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
      
      // Add some sample markers (in a real app, these would come from your data)
      const farmerPlots = [
        { lat: 0.3, lng: 101.7, name: "Plot A", status: "active", size: 2.5 },
        { lat: 0.35, lng: 101.65, name: "Plot B", status: "active", size: 3.2 },
        { lat: 0.4, lng: 101.8, name: "Plot C", status: "certified", size: 4.1 },
        { lat: 0.25, lng: 101.75, name: "Plot D", status: "inactive", size: 1.8 }
      ];
      
      const hcvAreas = [
        { lat: 0.28, lng: 101.68, name: "HCV Area 1", size: 125 },
        { lat: 0.32, lng: 101.72, name: "HCV Area 2", size: 85 }
      ];
      
      const nktAreas = [
        { lat: 0.38, lng: 101.78, name: "NKT Area 1", size: 75 },
        { lat: 0.42, lng: 101.82, name: "NKT Area 2", size: 60 }
      ];
      
      const hotspots = [
        { lat: 0.31, lng: 101.71, date: "2023-06-15" },
        { lat: 0.29, lng: 101.69, date: "2023-07-02" }
      ];
      
      // Add farmer plots to the map
      farmerPlots.forEach(plot => {
        const color = plot.status === 'certified' ? 'green' : 
                     plot.status === 'active' ? 'blue' : 'gray';
        
        L.circleMarker([plot.lat, plot.lng], {
          radius: plot.size * 2,
          fillColor: color,
          color: '#000',
          weight: 1,
          opacity: 1,
          fillOpacity: 0.8
        }).bindPopup(`<b>${plot.name}</b><br>Status: ${plot.status}<br>Luas: ${plot.size} Ha`).addTo(map);
      });
      
      // Add HCV areas
      hcvAreas.forEach(area => {
        L.circle([area.lat, area.lng], {
          radius: area.size * 100,
          fillColor: '#d7191c',
          color: '#d7191c',
          weight: 1,
          opacity: 1,
          fillOpacity: 0.3
        }).bindPopup(`<b>${area.name}</b><br>Luas: ${area.size} Ha`).addTo(map);
      });
      
      // Add NKT areas
      nktAreas.forEach(area => {
        L.circle([area.lat, area.lng], {
          radius: area.size * 100,
          fillColor: '#fdae61',
          color: '#fdae61',
          weight: 1,
          opacity: 1,
          fillOpacity: 0.3
        }).bindPopup(`<b>${area.name}</b><br>Luas: ${area.size} Ha`).addTo(map);
      });
      
      // Add hotspots
      hotspots.forEach(hotspot => {
        L.circleMarker([hotspot.lat, hotspot.lng], {
          radius: 8,
          fillColor: '#000',
          color: '#000',
          weight: 1,
          opacity: 1,
          fillOpacity: 0.8
        }).bindPopup(`<b>Titik Api</b><br>Tanggal: ${hotspot.date}`).addTo(map);
      });
      
      // Map control buttons
      document.getElementById('map-zoom-in').addEventListener('click', () => {
        map.zoomIn();
      });
      
      document.getElementById('map-zoom-out').addEventListener('click', () => {
        map.zoomOut();
      });
      
      document.getElementById('map-reset').addEventListener('click', () => {
        map.setView([0.2933, 101.7068], 9);
      });
      
      // Layer control
      document.getElementById('map-layer-select').addEventListener('change', function() {
        map.eachLayer(layer => {
          if (layer instanceof L.Circle || layer instanceof L.CircleMarker) {
            map.removeLayer(layer);
          }
        });
        
        const selectedLayer = this.value;
        
        if (selectedLayer === 'all' || selectedLayer === 'certified') {
          farmerPlots.forEach(plot => {
            if (selectedLayer === 'all' || (selectedLayer === 'certified' && plot.status === 'certified')) {
              const color = plot.status === 'certified' ? 'green' : 
                           plot.status === 'active' ? 'blue' : 'gray';
              
              L.circleMarker([plot.lat, plot.lng], {
                radius: plot.size * 2,
                fillColor: color,
                color: '#000',
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
              }).bindPopup(`<b>${plot.name}</b><br>Status: ${plot.status}<br>Luas: ${plot.size} Ha`).addTo(map);
            }
          });
        }
        
        if (selectedLayer === 'all' || selectedLayer === 'hcv') {
          hcvAreas.forEach(area => {
            L.circle([area.lat, area.lng], {
              radius: area.size * 100,
              fillColor: '#d7191c',
              color: '#d7191c',
              weight: 1,
              opacity: 1,
              fillOpacity: 0.3
            }).bindPopup(`<b>${area.name}</b><br>Luas: ${area.size} Ha`).addTo(map);
          });
        }
        
        if (selectedLayer === 'all' || selectedLayer === 'nkt') {
          nktAreas.forEach(area => {
            L.circle([area.lat, area.lng], {
              radius: area.size * 100,
              fillColor: '#fdae61',
              color: '#fdae61',
              weight: 1,
              opacity: 1,
              fillOpacity: 0.3
            }).bindPopup(`<b>${area.name}</b><br>Luas: ${area.size} Ha`).addTo(map);
          });
        }
        
        if (selectedLayer === 'all' || selectedLayer === 'hotspot') {
          hotspots.forEach(hotspot => {
            L.circleMarker([hotspot.lat, hotspot.lng], {
              radius: 8,
              fillColor: '#000',
              color: '#000',
              weight: 1,
              opacity: 1,
              fillOpacity: 0.8
            }).bindPopup(`<b>Titik Api</b><br>Tanggal: ${hotspot.date}`).addTo(map);
          });
        }
      });
      
      // Store map reference
      window.map = map;
    }
  </script>
</body>
</html>