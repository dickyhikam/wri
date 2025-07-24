<?php include 'header.php'; ?>

<section class="flex-1 overflow-y-auto p-8 bg-gray-50">

<div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Manajemen ICS</h2>
        <p class="opacity-90">Kelola data lembaga ICS</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-building text-3xl"></i>
      </div>
    </div>
  </div>
  
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Manajemen ICS</h1>
    <button onclick="showForm()" class="bg-[#F0AB00] hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
      <i class="fas fa-plus mr-2"></i>Tambah ICS
    </button>
  </div>

  <!-- Tabel Daftar ICS -->
  <div id="list-view" class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Daftar ICS</h2>
      <div class="flex space-x-2">
        <div class="relative">
          <input type="text" placeholder="Cari ICS..." class="pl-8 pr-4 py-2 border border-gray-300 rounded-lg">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
        <button class="px-3 py-2 bg-gray-100 rounded-lg">
          <i class="fas fa-filter text-gray-600"></i>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PIC</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="ics-table-body">
          <!-- Data akan diisi oleh JavaScript -->
        </tbody>
      </table>
    </div>

    <div class="flex justify-between items-center mt-4">
      <div class="text-sm text-gray-500">
        Menampilkan <span id="showing-from">1</span>-<span id="showing-to">0</span> dari <span id="total-ics">0</span> ICS
      </div>
      <div class="flex space-x-1">
        <button class="px-3 py-1 bg-gray-200 rounded-lg"><i class="fas fa-chevron-left"></i></button>
        <button class="px-3 py-1 bg-[#F0AB00] text-white rounded-lg">1</button>
        <button class="px-3 py-1 bg-gray-200 rounded-lg"><i class="fas fa-chevron-right"></i></button>
      </div>
    </div>
  </div>

  <!-- Form Tambah/Ubah ICS -->
  <div id="form-view" class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hidden">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold" id="form-title">Tambah ICS Baru</h2>
      <button onclick="hideForm()" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <form id="ics-form">
      <input type="hidden" id="ics-id">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Kolom Kiri -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode ICS*</label>
            <input type="text" id="kode-ics" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: ICS001" required>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama ICS*</label>
            <input type="text" id="nama-ics" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Lembaga Sawit Makmur" required>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. Badan Hukum</label>
            <input type="text" id="no-badan-hukum" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 123/XYZ/2023">
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berdiri</label>
              <input type="date" id="tgl-berdiri" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
            
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Legalitas</label>
              <input type="date" id="tgl-legalitas" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
            </div>
          </div>
        </div>
        
        <!-- Kolom Kanan - Informasi PIC -->
        <div class="space-y-4">
          <h3 class="text-md font-medium text-gray-700 border-b pb-2">Informasi PIC</h3>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama PIC*</label>
            <input type="text" id="nama-pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Budi Santoso" required>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kontak PIC*</label>
            <input type="text" id="kontak-pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: 08123456789" required>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email PIC*</label>
            <input type="email" id="email-pic" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: pic@example.com" required>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
            <label class="inline-flex items-center cursor-pointer">
              <input type="checkbox" id="status" class="sr-only peer" checked>
              <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
              <span class="ms-3 text-sm font-medium text-gray-700">Aktif</span>
            </label>
          </div>
        </div>
      </div>
      
      <!-- Dokumen & Logo -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen Legalitas (Maks. 10 file)</label>
          <div class="flex items-center">
            <input type="file" multiple class="hidden" id="file-upload" max="10">
            <label for="file-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
              <i class="fas fa-upload mr-2"></i>Unggah Dokumen
            </label>
            <span class="ml-2 text-sm text-gray-500">PDF, JPG, PNG (Maks. 5MB/file)</span>
          </div>
          <div id="file-list" class="mt-2 space-y-2"></div>
          
          <div id="document-name-template" class="hidden mt-2">
            <div class="flex items-center">
              <input type="text" placeholder="Nama Dokumen" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg text-sm">
              <button type="button" class="px-3 py-2 bg-red-500 text-white rounded-r-lg" onclick="removeDocument(this)">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
          <div class="flex items-center">
            <input type="file" accept="image/*" class="hidden" id="logo-upload">
            <label for="logo-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">
              <i class="fas fa-image mr-2"></i>Unggah Logo
            </label>
            <span class="ml-2 text-sm text-gray-500">JPG, PNG (Maks. 2MB)</span>
          </div>
          <div id="logo-preview" class="mt-2"></div>
        </div>
      </div>
      
      <!-- Alamat & Lokasi -->
      <div class=" mb-6">
        <div class=" mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Alamat (Jalan/Dusun)*</label>
          <input type="text" id="jalan-dusun" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Jl. Sawit Makmur No. 12, Dusun Sejahtera" required>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
          <div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi*</label>
              <input type="text" id="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" value="Riau" readonly>
            </div>
            
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten*</label>
              <select class="w-full px-3 py-2 border border-gray-300 rounded-lg select-dropdown" id="kabupaten" required>
                <option value="">Pilih Kabupaten</option>
                <!-- Options akan diisi oleh JavaScript -->
              </select>
            </div>
          </div>
          
          <div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan*</label>
              <select class="w-full px-3 py-2 border border-gray-300 rounded-lg select-dropdown" id="kecamatan" required disabled>
                <option value="">Pilih Kecamatan</option>
              </select>
            </div>
            
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Desa*</label>
              <select class="w-full px-3 py-2 border border-gray-300 rounded-lg select-dropdown" id="desa" required disabled>
                <option value="">Pilih Desa</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Koordinat)</label>
            <input type="text" id="lokasi" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: -6.175392, 106.827153">
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Area Wilayah</label>
            <input type="text" id="area-wilayah" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="Contoh: Kawasan Perkebunan Sawit">
          </div>
        </div>
      </div>
      
      <div class="flex justify-end space-x-3">
        <button type="button" onclick="hideForm()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
          Batal
        </button>
        <button type="submit" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
          Simpan ICS
        </button>
      </div>
    </form>
  </div>

  <!-- Detail ICS -->
  <div id="detail-view" class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hidden">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Detail ICS</h2>
      <button onclick="hideDetail()" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <!-- Informasi Utama -->
      <div class="md:col-span-2">
        <h3 class="text-md font-semibold mb-3 border-b pb-2">Informasi ICS</h3>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="text-sm text-gray-500">Kode ICS</p>
            <p class="font-medium" id="detail-kode">ICS001</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Nama</p>
            <p class="font-medium" id="detail-nama">Lembaga Contoh</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">No. Badan Hukum</p>
            <p class="font-medium" id="detail-no-badan-hukum">123/XYZ/2023</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Tanggal Berdiri</p>
            <p class="font-medium" id="detail-tgl-berdiri">15 Januari 2023</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Tanggal Legalitas</p>
            <p class="font-medium" id="detail-tgl-legalitas">20 Februari 2023</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Dibuat Oleh</p>
            <p class="font-medium" id="detail-dibuat-oleh">Admin</p>
          </div>
          
          <!-- Informasi PIC -->
          <div class="col-span-2">
            <h3 class="text-md font-semibold mb-2 border-b pb-2">Informasi PIC</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <p class="text-sm text-gray-500">Nama PIC</p>
                <p class="font-medium" id="detail-nama-pic">Budi Santoso</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Kontak PIC</p>
                <p class="font-medium" id="detail-kontak-pic">08123456789</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Email PIC</p>
                <p class="font-medium" id="detail-email-pic">budi@example.com</p>
              </div>
            </div>
          </div>
          
          <div class="col-span-2">
            <p class="text-sm text-gray-500">Alamat Lengkap</p>
            <p class="font-medium" id="detail-alamat">Jl. Sawit Makmur No. 12, Dusun Sejahtera</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
              <div>
                <p class="text-xs text-gray-500">Provinsi</p>
                <p class="text-sm" id="detail-provinsi">Riau</p>
                <p class="text-xs text-gray-500 mt-2">Kabupaten</p>
                <p class="text-sm" id="detail-kabupaten">Kampar</p>
              </div>
              <div>
                <p class="text-xs text-gray-500">Kecamatan</p>
                <p class="text-sm" id="detail-kecamatan">Bangkinang</p>
                <p class="text-xs text-gray-500 mt-2">Desa</p>
                <p class="text-sm" id="detail-desa">Bangkinang Kota</p>
              </div>
            </div>
          </div>
          <div>
            <p class="text-sm text-gray-500">Lokasi Koordinat</p>
            <p class="font-medium" id="detail-lokasi">-6.175392, 106.827153</p>
          </div>
          <div>
            <p class="text-sm text-gray-500">Area Wilayah</p>
            <p class="font-medium" id="detail-area-wilayah">Kawasan Perkebunan Sawit</p>
          </div>
        </div>
      </div>
      
      <!-- Dokumen & Logo -->
      <div>
        <h3 class="text-md font-semibold mb-3 border-b pb-2">Dokumen & Logo</h3>
        <div class="space-y-4">
          <div>
            <p class="text-sm text-gray-500 mb-2">Dokumen Legalitas</p>
            <div class="space-y-2" id="detail-dokumen">
              <!-- Dokumen akan diisi oleh JavaScript -->
            </div>
          </div>
          
          <div>
            <p class="text-sm text-gray-500 mb-2">Logo</p>
            <div class="bg-gray-100 h-32 rounded-lg flex items-center justify-center" id="detail-logo">
              <img src="https://via.placeholder.com/150" alt="Logo ICS" class="max-h-full max-w-full">
            </div>
          </div>
          
          <div>
            <p class="text-sm text-gray-500 mb-2">Status</p>
            <span id="detail-status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Sejarah ICS -->
    <h3 class="text-md font-semibold mb-3 border-b pb-2">Sejarah ICS</h3>
    <div class="space-y-4" id="detail-sejarah">
      <!-- Sejarah akan diisi oleh JavaScript -->
    </div>
    
    <div class="flex justify-end mt-6">
      <button onclick="hideDetail()" class="px-4 py-2 bg-[#F0AB00] hover:bg-yellow-600 text-white rounded-lg">
        Tutup
      </button>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div id="delete-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
        <button onclick="hideDeleteModal()" class="text-gray-500 hover:text-gray-700">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <p class="mb-6">Yakin ingin menghapus ICS ini? Data tidak bisa dikembalikan.</p>
      <div class="flex justify-end space-x-3">
        <button onclick="hideDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
          Batal
        </button>
        <button onclick="proceedDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
          Ya, Hapus
        </button>
      </div>
    </div>
  </div>

</section>

<script>
  // Data dummy untuk wilayah Riau (3 kabupaten dengan kecamatan dan desa)
  const wilayahData = {
    kabupaten: [
      { id: 'kab1', name: 'Kabupaten Kampar' },
      { id: 'kab2', name: 'Kabupaten Rokan Hulu' },
      { id: 'kab3', name: 'Kabupaten Indragiri Hulu' }
    ],
    kecamatan: {
      kab1: [
        { id: 'kec1', name: 'Bangkinang' },
        { id: 'kec2', name: 'Kampar' },
        { id: 'kec3', name: 'Tapung' }
      ],
      kab2: [
        { id: 'kec4', name: 'Pasir Pengaraian' },
        { id: 'kec5', name: 'Rambah' },
        { id: 'kec6', name: 'Kunto Darussalam' }
      ],
      kab3: [
        { id: 'kec7', name: 'Rengat' },
        { id: 'kec8', name: 'Kelayang' },
        { id: 'kec9', name: 'Siberida' }
      ]
    },
    desa: {
      kec1: [
        { id: 'desa1', name: 'Desa Bangkinang Kota' },
        { id: 'desa2', name: 'Desa Pulau Lawas' }
      ],
      kec2: [
        { id: 'desa3', name: 'Desa Kampar' },
        { id: 'desa4', name: 'Desa Muara Takus' }
      ],
      kec3: [
        { id: 'desa5', name: 'Desa Tapung Hilir' },
        { id: 'desa6', name: 'Desa Tapung Hulu' }
      ],
      kec4: [
        { id: 'desa7', name: 'Desa Pasir Pengaraian' },
        { id: 'desa8', name: 'Desa Rambah' }
      ],
      kec5: [
        { id: 'desa9', name: 'Desa Rambah Hilir' },
        { id: 'desa10', name: 'Desa Rambah Samo' }
      ],
      kec6: [
        { id: 'desa11', name: 'Desa Kunto Darussalam' },
        { id: 'desa12', name: 'Desa Sedinginan' }
      ],
      kec7: [
        { id: 'desa13', name: 'Desa Rengat' },
        { id: 'desa14', name: 'Desa Pematang Reba' }
      ],
      kec8: [
        { id: 'desa15', name: 'Desa Kelayang' },
        { id: 'desa16', name: 'Desa Sei Pasir Putih' }
      ],
      kec9: [
        { id: 'desa17', name: 'Desa Siberida' },
        { id: 'desa18', name: 'Desa Petalongan' }
      ]
    }
  };

  // Data dummy ICS
  let icsData = [
    {
      id: '1',
      kode: 'ICS001',
      nama: 'Lembaga Sawit Kampar',
      noBadanHukum: '123/KPR/2023',
      tglBerdiri: '2023-01-15',
      tglLegalitas: '2023-02-20',
      pic: {
        nama: 'Budi Santoso',
        kontak: '08123456789',
        email: 'budi@sawitkampar.com'
      },
      alamat: 'Jl. Sawit Makmur No. 12, Dusun Sejahtera',
      provinsi: 'Riau',
      kabupaten: 'kab1',
      kecamatan: 'kec1',
      desa: 'desa1',
      lokasi: '-0.335987, 101.025543',
      areaWilayah: 'Kawasan Perkebunan Sawit Kampar',
      dokumen: [
        { nama: 'Akta Pendirian', file: 'akta_pendirian.pdf' },
        { nama: 'SIUP', file: 'siup.pdf' }
      ],
      logo: 'https://via.placeholder.com/150',
      status: true,
      dibuatOleh: 'Admin',
      sejarah: [
        { 
          tanggal: '2023-03-15', 
          oleh: 'Admin WRI', 
          aksi: 'Perubahan data alamat dan dokumen legalitas',
          tipe: 'edit'
        },
        { 
          tanggal: '2023-03-10', 
          oleh: 'Verifikator Lapangan', 
          aksi: 'ICS telah diverifikasi dan disetujui',
          tipe: 'verifikasi'
        }
      ]
    },
    {
      id: '2',
      kode: 'ICS002',
      nama: 'Koperasi Rokan Hulu',
      noBadanHukum: '456/RHU/2023',
      tglBerdiri: '2023-03-10',
      tglLegalitas: '2023-04-05',
      pic: {
        nama: 'Ani Wijaya',
        kontak: '08234567890',
        email: 'ani@koperasirh.com'
      },
      alamat: 'Jl. Koperasi No. 45, Dusun Makmur',
      provinsi: 'Riau',
      kabupaten: 'kab2',
      kecamatan: 'kec4',
      desa: 'desa7',
      lokasi: '0.596672, 100.751798',
      areaWilayah: 'Wilayah Rokan Hulu',
      dokumen: [
        { nama: 'Akta Notaris', file: 'akta_notaris.pdf' }
      ],
      logo: 'https://via.placeholder.com/150',
      status: false,
      dibuatOleh: 'Operator',
      sejarah: [
        { 
          tanggal: '2023-04-12', 
          oleh: 'Operator', 
          aksi: 'Pendaftaran ICS baru',
          tipe: 'buat'
        }
      ]
    }
  ];

  // Inisialisasi
  document.addEventListener('DOMContentLoaded', function() {
    initKabupatenDropdown();
    renderICSList();
    
    // Tambahkan class select-dropdown ke semua elemen select
    document.querySelectorAll('select').forEach(select => {
      select.classList.add('select-dropdown');
    });
  });

  // Fungsi untuk mengisi dropdown kabupaten
  function initKabupatenDropdown() {
    const kabupatenSelect = document.getElementById('kabupaten');
    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
    
    wilayahData.kabupaten.forEach(kab => {
      const option = document.createElement('option');
      option.value = kab.id;
      option.textContent = kab.name;
      kabupatenSelect.appendChild(option);
    });
  }

  // Handle perubahan kabupaten
  document.getElementById('kabupaten').addEventListener('change', function() {
    const kabupatenId = this.value;
    const kecamatanSelect = document.getElementById('kecamatan');
    
    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
    kecamatanSelect.disabled = !kabupatenId;
    kecamatanSelect.classList.toggle('bg-gray-100', !kabupatenId);
    
    if (kabupatenId && wilayahData.kecamatan[kabupatenId]) {
      wilayahData.kecamatan[kabupatenId].forEach(kec => {
        const option = document.createElement('option');
        option.value = kec.id;
        option.textContent = kec.name;
        kecamatanSelect.appendChild(option);
      });
    }
    
    // Reset desa
    const desaSelect = document.getElementById('desa');
    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
    desaSelect.disabled = true;
    desaSelect.classList.add('bg-gray-100');
  });

  // Handle perubahan kecamatan
  document.getElementById('kecamatan').addEventListener('change', function() {
    const kecamatanId = this.value;
    const desaSelect = document.getElementById('desa');
    
    desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
    desaSelect.disabled = !kecamatanId;
    desaSelect.classList.toggle('bg-gray-100', !kecamatanId);
    
    if (kecamatanId && wilayahData.desa[kecamatanId]) {
      wilayahData.desa[kecamatanId].forEach(desa => {
        const option = document.createElement('option');
        option.value = desa.id;
        option.textContent = desa.name;
        desaSelect.appendChild(option);
      });
    }
  });

  // Fungsi untuk menampilkan daftar ICS
  function renderICSList() {
    const tbody = document.getElementById('ics-table-body');
    tbody.innerHTML = '';
    
    icsData.forEach(ics => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">${ics.kode}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${ics.nama}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${ics.pic?.nama || '-'}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${ics.pic?.kontak || '-'}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${ics.status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
            ${ics.status ? 'Aktif' : 'Proses Verifikasi'}
          </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
          <button onclick="showDetail('${ics.id}')" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></button>
          <button onclick="showEditForm('${ics.id}')" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></button>
          <button onclick="showDeleteModal('${ics.id}')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
        </td>
      `;
      tbody.appendChild(row);
    });
    
    // Update informasi jumlah data
    document.getElementById('showing-to').textContent = icsData.length;
    document.getElementById('total-ics').textContent = icsData.length;
  }

  // Fungsi untuk menampilkan form tambah/edit
  function showForm(icsId = null) {
    document.getElementById('list-view').classList.add('hidden');
    document.getElementById('form-view').classList.remove('hidden');
    document.getElementById('detail-view').classList.add('hidden');
    
    const form = document.getElementById('ics-form');
    form.reset();
    
    if (icsId) {
      // Mode edit
      document.getElementById('form-title').textContent = 'Edit ICS';
      const ics = icsData.find(item => item.id === icsId);
      
      if (ics) {
        document.getElementById('ics-id').value = ics.id;
        document.getElementById('kode-ics').value = ics.kode;
        document.getElementById('nama-ics').value = ics.nama;
        document.getElementById('no-badan-hukum').value = ics.noBadanHukum;
        document.getElementById('tgl-berdiri').value = ics.tglBerdiri;
        document.getElementById('tgl-legalitas').value = ics.tglLegalitas;
        document.getElementById('nama-pic').value = ics.pic?.nama || '';
        document.getElementById('kontak-pic').value = ics.pic?.kontak || '';
        document.getElementById('email-pic').value = ics.pic?.email || '';
        document.getElementById('jalan-dusun').value = ics.alamat;
        document.getElementById('provinsi').value = ics.provinsi;
        document.getElementById('lokasi').value = ics.lokasi;
        document.getElementById('area-wilayah').value = ics.areaWilayah;
        document.getElementById('status').checked = ics.status;
        
        // Set dropdown wilayah
        document.getElementById('kabupaten').value = ics.kabupaten;
        document.getElementById('kabupaten').dispatchEvent(new Event('change'));
        
        setTimeout(() => {
          document.getElementById('kecamatan').value = ics.kecamatan;
          document.getElementById('kecamatan').dispatchEvent(new Event('change'));
          
          setTimeout(() => {
            document.getElementById('desa').value = ics.desa;
          }, 100);
        }, 100);
        
        // Set logo preview
        const logoPreview = document.getElementById('logo-preview');
        logoPreview.innerHTML = `
          <div class="relative">
            <img src="${ics.logo}" alt="Logo Preview" class="h-32 rounded-lg border border-gray-200">
            <button type="button" onclick="removeLogo()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transform translate-x-1 -translate-y-1">
                          <i class="fas fa-times text-xs"></i>
            </button>
          </div>
        `;
        
        // Set dokumen preview
        const fileList = document.getElementById('file-list');
        fileList.innerHTML = '';
        
        if (ics.dokumen && ics.dokumen.length > 0) {
          ics.dokumen.forEach(doc => {
            const docItem = document.createElement('div');
            docItem.className = 'flex items-center justify-between bg-gray-50 p-2 rounded-lg';
            docItem.innerHTML = `
              <div class="flex items-center">
                <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                <span class="text-sm">${doc.nama}</span>
              </div>
              <button type="button" class="text-red-500 hover:text-red-700" onclick="removeDocument(this)">
                <i class="fas fa-times"></i>
              </button>
            `;
            fileList.appendChild(docItem);
          });
        }
      }
    } else {
      // Mode tambah baru
      document.getElementById('form-title').textContent = 'Tambah ICS Baru';
      document.getElementById('ics-id').value = '';
      document.getElementById('status').checked = true;
      
      // Reset logo preview
      document.getElementById('logo-preview').innerHTML = '';
      
      // Reset dokumen list
      document.getElementById('file-list').innerHTML = '';
    }
  }

  // Fungsi untuk menyembunyikan form
  function hideForm() {
    document.getElementById('form-view').classList.add('hidden');
    document.getElementById('list-view').classList.remove('hidden');
  }

  // Fungsi untuk menampilkan detail ICS
  function showDetail(icsId) {
    document.getElementById('list-view').classList.add('hidden');
    document.getElementById('form-view').classList.add('hidden');
    document.getElementById('detail-view').classList.remove('hidden');
    
    const ics = icsData.find(item => item.id === icsId);
    if (ics) {
      document.getElementById('detail-kode').textContent = ics.kode;
      document.getElementById('detail-nama').textContent = ics.nama;
      document.getElementById('detail-no-badan-hukum').textContent = ics.noBadanHukum || '-';
      document.getElementById('detail-tgl-berdiri').textContent = formatDate(ics.tglBerdiri);
      document.getElementById('detail-tgl-legalitas').textContent = formatDate(ics.tglLegalitas);
      document.getElementById('detail-dibuat-oleh').textContent = ics.dibuatOleh || 'Admin';
      
      // Informasi PIC
      document.getElementById('detail-nama-pic').textContent = ics.pic?.nama || '-';
      document.getElementById('detail-kontak-pic').textContent = ics.pic?.kontak || '-';
      document.getElementById('detail-email-pic').textContent = ics.pic?.email || '-';
      
      // Alamat
      document.getElementById('detail-alamat').textContent = ics.alamat;
      
      // Wilayah
      const kabupaten = wilayahData.kabupaten.find(k => k.id === ics.kabupaten);
      document.getElementById('detail-kabupaten').textContent = kabupaten?.name || '-';
      
      const kecamatan = wilayahData.kecamatan[ics.kabupaten]?.find(k => k.id === ics.kecamatan);
      document.getElementById('detail-kecamatan').textContent = kecamatan?.name || '-';
      
      const desa = wilayahData.desa[ics.kecamatan]?.find(d => d.id === ics.desa);
      document.getElementById('detail-desa').textContent = desa?.name || '-';
      
      document.getElementById('detail-provinsi').textContent = ics.provinsi;
      document.getElementById('detail-lokasi').textContent = ics.lokasi || '-';
      document.getElementById('detail-area-wilayah').textContent = ics.areaWilayah || '-';
      
      // Dokumen
      const dokumenContainer = document.getElementById('detail-dokumen');
      dokumenContainer.innerHTML = '';
      
      if (ics.dokumen && ics.dokumen.length > 0) {
        ics.dokumen.forEach(doc => {
          const docItem = document.createElement('div');
          docItem.className = 'flex items-center';
          docItem.innerHTML = `
            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
            <a href="#" class="text-blue-600 hover:underline text-sm">${doc.nama}</a>
          `;
          dokumenContainer.appendChild(docItem);
        });
      } else {
        dokumenContainer.innerHTML = '<p class="text-sm text-gray-500">Tidak ada dokumen</p>';
      }
      
      // Logo
      const logoContainer = document.getElementById('detail-logo');
      logoContainer.innerHTML = '';
      
      if (ics.logo) {
        const img = document.createElement('img');
        img.src = ics.logo;
        img.alt = 'Logo ICS';
        img.className = 'max-h-full max-w-full';
        logoContainer.appendChild(img);
      } else {
        logoContainer.innerHTML = '<p class="text-sm text-gray-500">Tidak ada logo</p>';
      }
      
      // Status
      const statusElement = document.getElementById('detail-status');
      statusElement.textContent = ics.status ? 'Aktif' : 'Nonaktif';
      statusElement.className = `px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
        ics.status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
      }`;
      
      // Sejarah
      const sejarahContainer = document.getElementById('detail-sejarah');
      sejarahContainer.innerHTML = '';
      
      if (ics.sejarah && ics.sejarah.length > 0) {
        ics.sejarah.forEach(history => {
          const historyItem = document.createElement('div');
          historyItem.className = 'flex items-start';
          
          let iconClass, bgClass;
          switch (history.tipe) {
            case 'edit':
              iconClass = 'fa-edit text-yellow-500';
              bgClass = 'bg-yellow-50';
              break;
            case 'verifikasi':
              iconClass = 'fa-check-circle text-green-500';
              bgClass = 'bg-green-50';
              break;
            default:
              iconClass = 'fa-plus-circle text-blue-500';
              bgClass = 'bg-blue-50';
          }
          
          historyItem.innerHTML = `
            <div class="flex-shrink-0 mt-1">
              <i class="fas ${iconClass} mr-3"></i>
            </div>
            <div class="flex-1 ${bgClass} p-3 rounded-lg">
              <div class="flex justify-between">
                <p class="text-sm font-medium">${history.aksi}</p>
                <p class="text-xs text-gray-500">${formatDate(history.tanggal)}</p>
              </div>
              <p class="text-xs text-gray-500 mt-1">Oleh: ${history.oleh}</p>
            </div>
          `;
          sejarahContainer.appendChild(historyItem);
        });
      } else {
        sejarahContainer.innerHTML = '<p class="text-sm text-gray-500">Tidak ada riwayat perubahan</p>';
      }
    }
  }

  // Fungsi untuk menyembunyikan detail
  function hideDetail() {
    document.getElementById('detail-view').classList.add('hidden');
    document.getElementById('list-view').classList.remove('hidden');
  }

  // Fungsi untuk menampilkan form edit
  function showEditForm(icsId) {
    showForm(icsId);
  }

  // Fungsi untuk menampilkan modal hapus
  function showDeleteModal(icsId) {
    document.getElementById('delete-modal').classList.remove('hidden');
    document.getElementById('delete-modal').setAttribute('data-ics-id', icsId);
  }

  // Fungsi untuk menyembunyikan modal hapus
  function hideDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
    document.getElementById('delete-modal').removeAttribute('data-ics-id');
  }

  // Fungsi untuk memproses penghapusan
  function proceedDelete() {
    const icsId = document.getElementById('delete-modal').getAttribute('data-ics-id');
    if (icsId) {
      icsData = icsData.filter(item => item.id !== icsId);
      renderICSList();
      hideDeleteModal();
      showToast('ICS berhasil dihapus', 'success');
    }
  }

  // Fungsi untuk menangani submit form
  document.getElementById('ics-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const icsId = document.getElementById('ics-id').value;
    const isEditMode = !!icsId;
    
    const icsDataObj = {
      id: isEditMode ? icsId : generateId(),
      kode: document.getElementById('kode-ics').value,
      nama: document.getElementById('nama-ics').value,
      noBadanHukum: document.getElementById('no-badan-hukum').value,
      tglBerdiri: document.getElementById('tgl-berdiri').value,
      tglLegalitas: document.getElementById('tgl-legalitas').value,
      pic: {
        nama: document.getElementById('nama-pic').value,
        kontak: document.getElementById('kontak-pic').value,
        email: document.getElementById('email-pic').value
      },
      alamat: document.getElementById('jalan-dusun').value,
      provinsi: document.getElementById('provinsi').value,
      kabupaten: document.getElementById('kabupaten').value,
      kecamatan: document.getElementById('kecamatan').value,
      desa: document.getElementById('desa').value,
      lokasi: document.getElementById('lokasi').value,
      areaWilayah: document.getElementById('area-wilayah').value,
      status: document.getElementById('status').checked,
      dibuatOleh: isEditMode ? icsData.find(item => item.id === icsId).dibuatOleh : 'Admin',
      dokumen: [], // Dokumen akan diisi dari file upload
      logo: isEditMode ? icsData.find(item => item.id === icsId).logo : 'https://via.placeholder.com/150',
      sejarah: isEditMode ? icsData.find(item => item.id === icsId).sejarah : []
    };
    
    // Tambahkan riwayat perubahan jika edit
    if (isEditMode) {
      icsDataObj.sejarah.unshift({
        tanggal: new Date().toISOString().split('T')[0],
        oleh: 'Admin',
        aksi: 'Perubahan data ICS',
        tipe: 'edit'
      });
    } else {
      icsDataObj.sejarah = [{
        tanggal: new Date().toISOString().split('T')[0],
        oleh: 'Admin',
        aksi: 'Pendaftaran ICS baru',
        tipe: 'buat'
      }];
    }
    
    // Simpan data
    if (isEditMode) {
      const index = icsData.findIndex(item => item.id === icsId);
      if (index !== -1) {
        icsData[index] = icsDataObj;
      }
    } else {
      icsData.push(icsDataObj);
    }
    
    renderICSList();
    hideForm();
    showToast(`ICS berhasil ${isEditMode ? 'diperbarui' : 'ditambahkan'}`, 'success');
  });

  // Fungsi untuk menghapus dokumen
  function removeDocument(button) {
    const docItem = button.closest('div');
    docItem.remove();
  }

  // Fungsi untuk menghapus logo
  function removeLogo() {
    document.getElementById('logo-preview').innerHTML = '';
    document.getElementById('logo-upload').value = '';
  }

  // Fungsi untuk menangani upload dokumen
  document.getElementById('file-upload').addEventListener('change', function(e) {
    const files = e.target.files;
    const fileList = document.getElementById('file-list');
    
    if (files.length > 10) {
      showToast('Maksimal 10 file yang dapat diunggah', 'error');
      return;
    }
    
    for (let i = 0; i < Math.min(files.length, 10); i++) {
      const file = files[i];
      
      if (file.size > 5 * 1024 * 1024) {
        showToast(`File ${file.name} melebihi ukuran maksimal 5MB`, 'error');
        continue;
      }
      
      const docTemplate = document.getElementById('document-name-template').cloneNode(true);
      docTemplate.classList.remove('hidden');
      docTemplate.querySelector('input').placeholder = file.name;
      
      fileList.appendChild(docTemplate);
    }
  });

  // Fungsi untuk menangani upload logo
  document.getElementById('logo-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const logoPreview = document.getElementById('logo-preview');
    
    if (file) {
      if (file.size > 2 * 1024 * 1024) {
        showToast('Ukuran logo maksimal 2MB', 'error');
        return;
      }
      
      if (!file.type.match('image.*')) {
        showToast('File harus berupa gambar', 'error');
        return;
      }
      
      const reader = new FileReader();
      reader.onload = function(e) {
        logoPreview.innerHTML = `
          <div class="relative">
            <img src="${e.target.result}" alt="Logo Preview" class="h-32 rounded-lg border border-gray-200">
            <button type="button" onclick="removeLogo()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center transform translate-x-1 -translate-y-1">
              <i class="fas fa-times text-xs"></i>
            </button>
          </div>
        `;
      };
      reader.readAsDataURL(file);
    }
  });

  // Fungsi utilitas untuk generate ID
  function generateId() {
    return Math.random().toString(36).substr(2, 9);
  }

  // Fungsi utilitas untuk format tanggal
  function formatDate(dateString) {
    if (!dateString) return '-';
    
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
  }

  // Fungsi untuk menampilkan toast notifikasi
  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 px-4 py-2 rounded-lg shadow-lg text-white ${
      type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
      toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
      setTimeout(() => {
        toast.remove();
      }, 300);
    }, 3000);
  }
</script>

<?php include 'footer.php'; ?>