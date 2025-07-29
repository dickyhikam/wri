<?php
include 'header.php';


// Cek apakah role bukan 'Super Admin'
if ($user['akun']['role'] == 'User') {
  // Menampilkan alert menggunakan SweetAlert
  echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Anda tidak memiliki akses untuk halaman ini.',
                confirmButtonText: 'OK',
                background: '#f3f4f6',
                backdrop: 'rgba(0, 0, 0, 1)'
            }).then(function() {
                // Setelah alert ditutup, arahkan pengguna ke halaman login
                window.history.back(); // Kembali ke halaman sebelumnya
            });
          </script>";
}
?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Selamat Datang, Admin WRI!</h2>
        <p class="opacity-90">Pantau dan kelola seluruh data ICS dan perkebunan sawit secara real-time</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-chart-pie text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Summary Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
      <div class="flex justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Total Petani</p>
          <h3 class="text-2xl font-bold">1,236</h3>
          <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.5% dari bulan lalu</p>
        </div>
        <div class="bg-blue-100 text-blue-600 p-3 rounded-lg">
          <i class="fas fa-user-tie text-xl"></i>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
      <div class="flex justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Total Lahan (Ha)</p>
          <h3 class="text-2xl font-bold">3,504</h3>
          <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.3% dari bulan lalu</p>
        </div>
        <div class="bg-green-100 text-green-600 p-3 rounded-lg">
          <i class="fas fa-map-marked-alt text-xl"></i>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
      <div class="flex justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Produksi (Kg)</p>
          <h3 class="text-2xl font-bold">752,000</h3>
          <p class="text-xs text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 5.2% dari bulan lalu</p>
        </div>
        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
          <i class="fas fa-seedling text-xl"></i>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition-shadow">
      <div class="flex justify-between">
        <div>
          <p class="text-sm font-medium text-gray-500 mb-1">Sudah RSPO</p>
          <h3 class="text-2xl font-bold text-green-600">220</h3>
          <p class="text-xs text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 15.8% dari bulan lalu</p>
        </div>
        <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
          <i class="fas fa-certificate text-xl"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- ICS Statistics Section -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- ICS Summary -->
    <div class="bg-white rounded-xl shadow-md p-6 col-span-1 border border-gray-100">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Statistik ICS</h3>
        <div class="relative">
          <select class="appearance-none bg-gray-100 border border-gray-200 rounded-lg pl-3 pr-8 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Bulan Ini</option>
            <option>3 Bulan Terakhir</option>
            <option>Tahun Ini</option>
          </select>
          <i class="fas fa-chevron-down absolute right-3 top-2 text-xs text-gray-500"></i>
        </div>
      </div>

      <div class="space-y-4">
        <div>
          <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-600">Total ICS</span>
            <span class="font-medium">42</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-blue-600 h-2 rounded-full" style="width: 100%"></div>
          </div>
        </div>

        <div>
          <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-600">Aktif</span>
            <span class="font-medium">38</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-green-500 h-2 rounded-full" style="width: 90%"></div>
          </div>
        </div>

        <div>
          <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-600">Sudah RSPO</span>
            <span class="font-medium">22</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-purple-500 h-2 rounded-full" style="width: 52%"></div>
          </div>
        </div>

        <div>
          <div class="flex justify-between text-sm mb-1">
            <span class="text-gray-600">Dalam Proses Sertifikasi</span>
            <span class="font-medium">14</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-yellow-500 h-2 rounded-full" style="width: 33%"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Production Chart -->
    <div class="bg-white rounded-xl shadow-md p-6 col-span-2 border border-gray-100">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Trend Produksi Tahunan</h3>
        <div class="flex space-x-2">
          <button class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">TBS</button>
          <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">CPO</button>
          <button class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm">Kernel</button>
        </div>
      </div>
      <canvas id="productionChart" height="250"></canvas>
    </div>
  </div>

  <!-- Farmer and Land Distribution -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Farmer Distribution -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Distribusi Petani per Wilayah</h3>
        <button class="text-blue-600 text-sm font-medium">Lihat Detail</button>
      </div>
      <canvas id="farmerChart" height="200"></canvas>
    </div>

    <!-- Land Distribution -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Distribusi Lahan per ICS</h3>
        <button class="text-blue-600 text-sm font-medium">Lihat Detail</button>
      </div>
      <canvas id="landChart" height="200"></canvas>
    </div>
  </div>

  <!-- Recent Activities and New Farmers -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-1">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Aktivitas Terkini</h3>
        <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
      </div>

      <div class="space-y-4">
        <div class="flex items-start">
          <div class="bg-green-100 p-2 rounded-lg mr-3">
            <i class="fas fa-certificate text-green-600"></i>
          </div>
          <div>
            <p class="text-sm font-medium">2 ICS baru tersertifikasi RSPO</p>
            <p class="text-xs text-gray-500">2 jam yang lalu</p>
          </div>
        </div>

        <div class="flex items-start">
          <div class="bg-blue-100 p-2 rounded-lg mr-3">
            <i class="fas fa-user-plus text-blue-600"></i>
          </div>
          <div>
            <p class="text-sm font-medium">15 petani baru terdaftar</p>
            <p class="text-xs text-gray-500">Kemarin, 15:42</p>
          </div>
        </div>

        <div class="flex items-start">
          <div class="bg-purple-100 p-2 rounded-lg mr-3">
            <i class="fas fa-map-marked-alt text-purple-600"></i>
          </div>
          <div>
            <p class="text-sm font-medium">45 Ha lahan baru ditambahkan</p>
            <p class="text-xs text-gray-500">Kemarin, 10:15</p>
          </div>
        </div>

        <div class="flex items-start">
          <div class="bg-yellow-100 p-2 rounded-lg mr-3">
            <i class="fas fa-graduation-cap text-yellow-600"></i>
          </div>
          <div>
            <p class="text-sm font-medium">Pelatihan GAP untuk 30 petani</p>
            <p class="text-xs text-gray-500">3 hari yang lalu</p>
          </div>
        </div>
      </div>
    </div>

    <!-- New Farmers Table -->
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 lg:col-span-2">
      <div class="flex justify-between items-center mb-4">
        <h3 class="font-semibold text-lg">Petani Terbaru</h3>
        <button class="text-blue-600 text-sm font-medium">Lihat Semua</button>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelompok</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wilayah</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=4299e1&color=fff" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Ahmad Fauzi</div>
                    <div class="text-sm text-gray-500">ID: PTN-1245</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Sawit Jaya</div>
                <div class="text-sm text-gray-500">ICS-12</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Pelalawan</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
                <button class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></button>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Siti+Rahma&background=4299e1&color=fff" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Siti Rahma</div>
                    <div class="text-sm text-gray-500">ID: PTN-1246</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Tani Bersatu</div>
                <div class="text-sm text-gray-500">ICS-08</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Inhu</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses Sertifikasi</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
                <button class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></button>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=4299e1&color=fff" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                    <div class="text-sm text-gray-500">ID: PTN-1247</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Sawit Makmur</div>
                <div class="text-sm text-gray-500">ICS-15</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Siak</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
                <button class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>