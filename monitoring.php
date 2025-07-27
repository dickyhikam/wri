
<?php
// Include header
include 'header.php';
?>

<!-- Main Content -->
<div class="flex-1 overflow-auto custom-scroll p-6" x-data="nktMonitoringApp()">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <a href="javascript:history.back()" class="btn bg-gray-200 hover:bg-gray-300 text-gray-800 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Pemantauan NKT 1 & NKT 4</h2>
            </div>
            <button @click="openModal = true; currentForm = 'new'" class="btn bg-[#f0ab00] hover:bg-[#d69b00] text-white flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </button>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi/Blok</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis NKT</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik Lahan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="(item, index) in monitoringData" :key="item.id">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="index + 1"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="item.nama_lokasi"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <template x-for="jenis in item.jenis_nkt">
                                        <span x-text="jenis" class="mr-1"></span>
                                    </template>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="formatDate(item.tanggal_pemantauan)"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.nama_petugas"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.pemilik_lahan"></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span x-bind:class="{
                                        'bg-green-100 text-green-800': getOverallStatus(item) === 'Baik',
                                        'bg-yellow-100 text-yellow-800': getOverallStatus(item) === 'Perlu Perhatian',
                                        'bg-red-100 text-red-800': getOverallStatus(item) === 'Kritis'
                                    }" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" x-text="getOverallStatus(item)">
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button @click="viewItem(item)" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button @click="editItem(item)" class="text-yellow-600 hover:text-yellow-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button @click="confirmDelete(item)" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div x-show="openModal" class="fixed inset-0 overflow-y-auto z-50" x-cloak>
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75" @click="openModal = false"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" x-text="currentForm === 'new' ? 'Tambah Data Pemantauan' : 'Edit Data Pemantauan'"></h3>
                            <div class="mt-2 w-full">
                                <!-- Form Sections -->
                                <div class="space-y-6">
                                    <!-- Section A: Identitas Lokasi -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">A. Identitas Lokasi</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Lokasi/Blok *</label>
                                                    <input x-model="formData.nama_lokasi" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Koordinat/Titik Monitoring *</label>
                                                    <input x-model="formData.koordinat" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div class="md:col-span-2">
                                                    <label class="block text-sm font-medium text-gray-700">Jenis NKT *</label>
                                                    <div class="mt-2 space-y-2">
                                                        <div class="flex items-center">
                                                            <input x-model="formData.jenis_nkt" value="NKT 1" type="checkbox" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300 rounded">
                                                            <label class="ml-2 block text-sm text-gray-700">NKT 1 (Keanekaragaman Hayati Tinggi)</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input x-model="formData.jenis_nkt" value="NKT 4" type="checkbox" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300 rounded">
                                                            <label class="ml-2 block text-sm text-gray-700">NKT 4 (Jasa Ekosistem)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tanggal Monitoring *</label>
                                                    <input x-model="formData.tanggal_pemantauan" type="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Petugas/Pemantau *</label>
                                                    <input x-model="formData.nama_petugas" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Pemilik Lahan *</label>
                                                    <input x-model="formData.pemilik_lahan" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section B: Pemantauan NKT 1 -->
                                    <div x-show="formData.jenis_nkt.includes('NKT 1')">
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">B. Pemantauan NKT 1 (Keanekaragaman Hayati)</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg space-y-4">
                                            <!-- Indicator 1 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">1. Kehadiran satwa liar dilindungi?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator1" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator1" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2" x-show="formData.nkt1_indikator1 === 'Ya'">
                                                    <label class="block text-sm font-medium text-gray-700">Nama Lokal Satwa</label>
                                                    <input x-model="formData.nkt1_catatan1" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>

                                            <!-- Indicator 2 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">2. Jejak, sarang, atau bekas aktivitas satwa?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator2" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator2" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2" x-show="formData.nkt1_indikator2 === 'Ya'">
                                                    <label class="block text-sm font-medium text-gray-700">Deskripsi Lokasi</label>
                                                    <textarea x-model="formData.nkt1_catatan2" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 3 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">3. Vegetasi alami masih utuh (tidak ditebang)?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator3" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator3" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                                    <textarea x-model="formData.nkt1_catatan3" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 4 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">4. Keberadaan pohon besar atau tanaman asli?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator4" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator4" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2" x-show="formData.nkt1_indikator4 === 'Ya'">
                                                    <label class="block text-sm font-medium text-gray-700">Jenis Pohon/Tanaman</label>
                                                    <input x-model="formData.nkt1_catatan4" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>

                                            <!-- Indicator 5 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">5. Ada gangguan lain (kebisingan, ternak liar, dll)?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator5" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt1_indikator5" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2" x-show="formData.nkt1_indikator5 === 'Ya'">
                                                    <label class="block text-sm font-medium text-gray-700">Jenis Gangguan</label>
                                                    <input x-model="formData.nkt1_catatan5" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section C: Pemantauan NKT 4 -->
                                    <div x-show="formData.jenis_nkt.includes('NKT 4')">
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">C. Pemantauan NKT 4 (Jasa Lingkungan)</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg space-y-4">
                                            <!-- Indicator 1 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">1. Sungai/kanal mengalir normal?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator1" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator1" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Kondisi Aliran</label>
                                                    <input x-model="formData.nkt4_catatan1" type="text" placeholder="Aliran stabil atau meluap?" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>

                                            <!-- Indicator 2 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">2. Air terlihat jernih?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator2" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator2" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Kondisi Air</label>
                                                    <input x-model="formData.nkt4_catatan2" type="text" placeholder="Warna/keruh/berbusa?" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>

                                            <!-- Indicator 3 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">3. Tidak ada sampah atau limbah di sempadan?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator3" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator3" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2" x-show="formData.nkt4_indikator3 === 'Tidak'">
                                                    <label class="block text-sm font-medium text-gray-700">Jenis Limbah</label>
                                                    <input x-model="formData.nkt4_catatan3" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>

                                            <!-- Indicator 4 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">4. Vegetasi di tepi sungai masih utuh?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator4" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.nkt4_indikator4" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2" x-show="formData.nkt4_indikator4 === 'Tidak'">
                                                    <label class="block text-sm font-medium text-gray-700">Perlu ditanam kembali?</label>
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex items-center">
                                                            <input x-model="formData.nkt4_catatan4" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                            <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input x-model="formData.nkt4_catatan4" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                            <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section D: Tindak Lanjut -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">D. Tindak Lanjut yang Diperlukan</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">1. Perlu penanaman vegetasi ulang?</label>
                                                    <div class="flex items-center space-x-4 mt-2">
                                                        <div class="flex items-center">
                                                            <input x-model="formData.tindak_lanjut1" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                            <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input x-model="formData.tindak_lanjut1" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                            <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">2. Perlu pembersihan sampah/limbah?</label>
                                                    <div class="flex items-center space-x-4 mt-2">
                                                        <div class="flex items-center">
                                                            <input x-model="formData.tindak_lanjut2" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                            <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input x-model="formData.tindak_lanjut2" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                            <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">3. Masukan lain</label>
                                                    <textarea x-model="formData.tindak_lanjut3" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click="saveData()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#d69b00] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f0ab00] sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" @click="openModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f0ab00] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div x-show="viewModal" class="fixed inset-0 overflow-y-auto z-50" x-cloak>
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75" @click="viewModal = false"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Detail Data Pemantauan</h3>
                            <div class="mt-2 w-full">
                                <!-- Form Sections -->
                                <div class="space-y-6">
                                    <!-- Section A: Identitas Lokasi -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">A. Identitas Lokasi</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Lokasi/Blok</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nama_lokasi || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Koordinat/Titik Monitoring</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.koordinat || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Jenis NKT</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold">
                                                        <template x-for="jenis in viewData.jenis_nkt">
                                                            <span x-text="jenis" class="mr-2"></span>
                                                        </template>
                                                    </p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tanggal Monitoring</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="formatDate(viewData.tanggal_pemantauan) || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Petugas/Pemantau</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nama_petugas || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Pemilik Lahan</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.pemilik_lahan || '-'"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section B: Pemantauan NKT 1 -->
                                    <div x-show="viewData.jenis_nkt.includes('NKT 1')">
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">B. Pemantauan NKT 1 (Keanekaragaman Hayati)</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg space-y-4">
                                            <!-- Indicator 1 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">1. Kehadiran satwa liar dilindungi?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt1_indikator1 || '-'"></p>
                                                <template x-if="viewData.nkt1_indikator1 === 'Ya' && viewData.nkt1_catatan1">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Nama Lokal Satwa</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt1_catatan1"></p>
                                                    </div>
                                                </template>
                                            </div>

                                                                                        <!-- Indicator 2 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">2. Jejak, sarang, atau bekas aktivitas satwa?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt1_indikator2 || '-'"></p>
                                                <template x-if="viewData.nkt1_indikator2 === 'Ya' && viewData.nkt1_catatan2">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Deskripsi Lokasi</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt1_catatan2"></p>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Indicator 3 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">3. Vegetasi alami masih utuh (tidak ditebang)?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt1_indikator3 || '-'"></p>
                                                <template x-if="viewData.nkt1_catatan3">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt1_catatan3"></p>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Indicator 4 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">4. Keberadaan pohon besar atau tanaman asli?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt1_indikator4 || '-'"></p>
                                                <template x-if="viewData.nkt1_indikator4 === 'Ya' && viewData.nkt1_catatan4">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Jenis Pohon/Tanaman</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt1_catatan4"></p>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Indicator 5 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">5. Ada gangguan lain (kebisingan, ternak liar, dll)?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt1_indikator5 || '-'"></p>
                                                <template x-if="viewData.nkt1_indikator5 === 'Ya' && viewData.nkt1_catatan5">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Jenis Gangguan</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt1_catatan5"></p>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section C: Pemantauan NKT 4 -->
                                    <div x-show="viewData.jenis_nkt.includes('NKT 4')">
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">C. Pemantauan NKT 4 (Jasa Lingkungan)</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg space-y-4">
                                            <!-- Indicator 1 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">1. Sungai/kanal mengalir normal?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt4_indikator1 || '-'"></p>
                                                <template x-if="viewData.nkt4_catatan1">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Kondisi Aliran</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt4_catatan1"></p>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Indicator 2 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">2. Air terlihat jernih?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt4_indikator2 || '-'"></p>
                                                <template x-if="viewData.nkt4_catatan2">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Kondisi Air</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt4_catatan2"></p>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Indicator 3 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">3. Tidak ada sampah atau limbah di sempadan?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt4_indikator3 || '-'"></p>
                                                <template x-if="viewData.nkt4_indikator3 === 'Tidak' && viewData.nkt4_catatan3">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Jenis Limbah</label>
                                                        <p class="mt-1 text-sm text-gray-900" x-text="viewData.nkt4_catatan3"></p>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Indicator 4 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">4. Vegetasi di tepi sungai masih utuh?</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt4_indikator4 || '-'"></p>
                                                <template x-if="viewData.nkt4_indikator4 === 'Tidak' && viewData.nkt4_catatan4">
                                                    <div class="mt-2">
                                                        <label class="block text-sm font-medium text-gray-700">Perlu ditanam kembali?</label>
                                                        <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nkt4_catatan4"></p>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section D: Tindak Lanjut -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">D. Tindak Lanjut yang Diperlukan</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">1. Perlu penanaman vegetasi ulang?</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.tindak_lanjut1 || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">2. Perlu pembersihan sampah/limbah?</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.tindak_lanjut2 || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">3. Masukan lain</label>
                                                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line" x-text="viewData.tindak_lanjut3 || '-'"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click="viewModal = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#d69b00] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f0ab00] sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModal" class="fixed inset-0 overflow-y-auto z-50" x-cloak>
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Hapus</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus data pemantauan ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click="deleteItem()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus
                    </button>
                    <button type="button" @click="deleteModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#f0ab00] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function nktMonitoringApp() {
    return {
        openModal: false,
        viewModal: false,
        deleteModal: false,
        currentForm: 'new',
        currentItemId: null,
        monitoringData: [],
        formData: {
            nama_lokasi: '',
            koordinat: '',
            jenis_nkt: [],
            tanggal_pemantauan: '',
            nama_petugas: '',
            pemilik_lahan: '',
            // NKT 1 Fields
            nkt1_indikator1: '',
            nkt1_catatan1: '',
            nkt1_indikator2: '',
            nkt1_catatan2: '',
            nkt1_indikator3: '',
            nkt1_catatan3: '',
            nkt1_indikator4: '',
            nkt1_catatan4: '',
            nkt1_indikator5: '',
            nkt1_catatan5: '',
            // NKT 4 Fields
            nkt4_indikator1: '',
            nkt4_catatan1: '',
            nkt4_indikator2: '',
            nkt4_catatan2: '',
            nkt4_indikator3: '',
            nkt4_catatan3: '',
            nkt4_indikator4: '',
            nkt4_catatan4: '',
            // Tindak Lanjut
            tindak_lanjut1: '',
            tindak_lanjut2: '',
            tindak_lanjut3: ''
        },
        
        // Initialize data from localStorage
        init() {
            const savedData = localStorage.getItem('nktMonitoringData');
            if (savedData) {
                this.monitoringData = JSON.parse(savedData);
            } else {
                // Sample data if localStorage is empty
                this.monitoringData = [
                    {
                        id: 1,
                        nama_lokasi: 'Blok Konservasi A',
                        koordinat: '-6.12345, 106.78901',
                        jenis_nkt: ['NKT 1', 'NKT 4'],
                        tanggal_pemantauan: '2023-07-25',
                        nama_petugas: 'Budi Santoso',
                        pemilik_lahan: 'PT Perkebunan Nusantara',
                        // NKT 1 Data
                        nkt1_indikator1: 'Ya',
                        nkt1_catatan1: 'Burung Rangkong',
                        nkt1_indikator2: 'Ya',
                        nkt1_catatan2: 'Jejak babi hutan di area utara',
                        nkt1_indikator3: 'Ya',
                        nkt1_catatan3: 'Vegetasi alami masih bagus',
                        nkt1_indikator4: 'Ya',
                        nkt1_catatan4: 'Pohon Meranti dan Durian',
                        nkt1_indikator5: 'Tidak',
                        nkt1_catatan5: '',
                        // NKT 4 Data
                        nkt4_indikator1: 'Ya',
                        nkt4_catatan1: 'Aliran stabil',
                        nkt4_indikator2: 'Tidak',
                        nkt4_catatan2: 'Air agak keruh',
                        nkt4_indikator3: 'Tidak',
                        nkt4_catatan3: 'Sampah plastik',
                        nkt4_indikator4: 'Ya',
                        nkt4_catatan4: '',
                        // Tindak Lanjut
                        tindak_lanjut1: 'Ya',
                        tindak_lanjut2: 'Ya',
                        tindak_lanjut3: 'Perlu patroli rutin 2x seminggu'
                    }
                ];
                this.saveToLocalStorage();
            }
        },
        
        // Save data to localStorage
        saveToLocalStorage() {
            localStorage.setItem('nktMonitoringData', JSON.stringify(this.monitoringData));
        },
        
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID');
        },
        
        // Calculate overall status based on monitoring indicators
        getOverallStatus(item) {
            // Check NKT 1 indicators
            const nkt1Issues = [
                item.nkt1_indikator5 === 'Ya', // Ada gangguan
                item.nkt1_indikator3 === 'Tidak' // Vegetasi tidak utuh
            ].filter(Boolean).length;
            
            // Check NKT 4 indicators
            const nkt4Issues = [
                item.nkt4_indikator1 === 'Tidak', // Aliran tidak normal
                item.nkt4_indikator2 === 'Tidak', // Air tidak jernih
                item.nkt4_indikator3 === 'Tidak', // Ada sampah/limbah
                item.nkt4_indikator4 === 'Tidak' // Vegetasi tidak utuh
            ].filter(Boolean).length;
            
            // Check follow-up actions
            const followUpActions = [
                item.tindak_lanjut1 === 'Ya',
                item.tindak_lanjut2 === 'Ya'
            ].filter(Boolean).length;
            
            const totalIssues = nkt1Issues + nkt4Issues;
            
            if (totalIssues === 0 && followUpActions === 0) return 'Baik';
            if (totalIssues <= 2 || followUpActions > 0) return 'Perlu Perhatian';
            return 'Kritis';
        },
        
        viewItem(item) {
            this.viewData = JSON.parse(JSON.stringify(item));
            this.viewModal = true;
        },
        
        editItem(item) {
            this.currentForm = 'edit';
            this.currentItemId = item.id;
            this.formData = {...item};
            this.openModal = true;
        },
        
        confirmDelete(item) {
            this.currentItemId = item.id;
            this.deleteModal = true;
        },
        
        deleteItem() {
            this.monitoringData = this.monitoringData.filter(item => item.id !== this.currentItemId);
            this.saveToLocalStorage();
            this.deleteModal = false;
        },
        
        saveData() {
            // Validate form
            if (!this.validateForm()) {
                return;
            }
            
            if (this.currentForm === 'new') {
                // Add new item
                const newId = Math.max(...this.monitoringData.map(item => item.id), 0) + 1;
                this.monitoringData.push({
                    id: newId,
                    ...this.formData
                });
            } else {
                // Update existing item
                const index = this.monitoringData.findIndex(item => item.id === this.currentItemId);
                if (index !== -1) {
                    this.monitoringData[index] = {
                        id: this.currentItemId,
                        ...this.formData
                    };
                }
            }
            
            this.saveToLocalStorage();
            this.openModal = false;
            this.resetForm();
        },
        
        // Validate form before saving
        validateForm() {
            const requiredFields = [
                'nama_lokasi', 'koordinat', 'tanggal_pemantauan',
                'nama_petugas', 'pemilik_lahan'
            ];
            
            // Check main form fields
            for (const field of requiredFields) {
                if (!this.formData[field]) {
                    alert(`Field ${field.replace(/_/g, ' ')} harus diisi!`);
                    return false;
                }
            }
            
            // Check at least one NKT type is selected
            if (this.formData.jenis_nkt.length === 0) {
                alert('Pilih minimal satu jenis NKT!');
                return false;
            }
            
            // Validate NKT 1 fields if selected
            if (this.formData.jenis_nkt.includes('NKT 1')) {
                const nkt1Fields = [
                    'nkt1_indikator1', 'nkt1_indikator2', 
                    'nkt1_indikator3', 'nkt1_indikator4',
                    'nkt1_indikator5'
                ];
                
                for (const field of nkt1Fields) {
                    if (!this.formData[field]) {
                        alert(`Semua indikator NKT 1 harus diisi!`);
                        return false;
                    }
                }
            }
            
            // Validate NKT 4 fields if selected
            if (this.formData.jenis_nkt.includes('NKT 4')) {
                const nkt4Fields = [
                    'nkt4_indikator1', 'nkt4_indikator2',
                    'nkt4_indikator3', 'nkt4_indikator4'
                ];
                
                for (const field of nkt4Fields) {
                    if (!this.formData[field]) {
                        alert(`Semua indikator NKT 4 harus diisi!`);
                        return false;
                    }
                }
            }
            
            return true;
        },
        
        resetForm() {
            this.formData = {
                nama_lokasi: '',
                koordinat: '',
                jenis_nkt: [],
                tanggal_pemantauan: '',
                nama_petugas: '',
                pemilik_lahan: '',
                // NKT 1 Fields
                nkt1_indikator1: '',
                nkt1_catatan1: '',
                nkt1_indikator2: '',
                nkt1_catatan2: '',
                nkt1_indikator3: '',
                nkt1_catatan3: '',
                nkt1_indikator4: '',
                nkt1_catatan4: '',
                nkt1_indikator5: '',
                nkt1_catatan5: '',
                // NKT 4 Fields
                nkt4_indikator1: '',
                nkt4_catatan1: '',
                nkt4_indikator2: '',
                nkt4_catatan2: '',
                nkt4_indikator3: '',
                nkt4_catatan3: '',
                nkt4_indikator4: '',
                nkt4_catatan4: '',
                // Tindak Lanjut
                tindak_lanjut1: '',
                tindak_lanjut2: '',
                tindak_lanjut3: ''
            };
            this.currentItemId = null;
        }
    }
}
</script>

<?php
// Include footer
include 'footer.php';
?>