<?php
// Include header
include 'header.php';
?>

<!-- Main Content -->
<div class="flex-1 overflow-auto custom-scroll p-6" x-data="fireRiskApp()">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <a href="javascript:history.back()" class="btn bg-gray-200 hover:bg-gray-300 text-gray-800 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Pemantauan Areal Potensi Kebakaran</h2>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik Lahan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Lahan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cuaca</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Risiko</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="(item, index) in monitoringData" :key="item.id">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="index + 1"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="item.nama_lokasi"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="formatDate(item.tanggal_pemantauan)"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.nama_petugas"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.pemilik_lahan"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.jenis_lahan"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.cuaca"></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span x-bind:class="{
                                        'bg-green-100 text-green-800': item.tingkat_risiko === 'Rendah',
                                        'bg-yellow-100 text-yellow-800': item.tingkat_risiko === 'Sedang',
                                        'bg-red-100 text-red-800': item.tingkat_risiko === 'Tinggi'
                                    }" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" x-text="item.tingkat_risiko">
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
                                                    <label class="block text-sm font-medium text-gray-700">Koordinat/Titik Pantau *</label>
                                                    <input x-model="formData.koordinat" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Luas Area Dipantau (Ha) *</label>
                                                    <input x-model="formData.luas_area" type="number" step="0.01" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tanggal Pemantauan *</label>
                                                    <input x-model="formData.tanggal_pemantauan" type="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Petugas/Pemantau *</label>
                                                    <input x-model="formData.nama_petugas" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Pemilik Lahan *</label>
                                                    <input x-model="formData.pemilik_lahan" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Jenis Lahan *</label>
                                                    <select x-model="formData.jenis_lahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                        <option value="">Pilih Jenis Lahan</option>
                                                        <option value="Hutan">Hutan</option>
                                                        <option value="Perkebunan">Perkebunan</option>
                                                        <option value="Pertanian">Pertanian</option>
                                                        <option value="Pemukiman">Pemukiman</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Cuaca Saat Pemantauan *</label>
                                                    <select x-model="formData.cuaca" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                        <option value="">Pilih Cuaca</option>
                                                        <option value="Cerah">Cerah</option>
                                                        <option value="Panas">Panas</option>
                                                        <option value="Mendung">Mendung</option>
                                                        <option value="Hujan">Hujan</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section B: Indikator Potensi Kebakaran -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">B. Indikator Potensi Kebakaran</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg space-y-4">
                                            <!-- Indicator 1 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">1. Apakah terdapat sampah kering/tumpukan ranting?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator1" value="Ada" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ada</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator1" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan1" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 2 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">2. Apakah terdapat vegetasi kering/mati?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator2" value="Ada" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ada</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator2" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan2" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 3 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">3. Apakah terdapat aktivitas pembakaran?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator3" value="Ada" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ada</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator3" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan3" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 4 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">4. Apakah terdapat sumber api potensial?</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator4" value="Ada" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Ada</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator4" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan4" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 5 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">5. Kondisi kelembaban tanah</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator5" value="Basah" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Basah</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator5" value="Sedang" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Sedang</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator5" value="Kering" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Kering</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan5" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 6 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">6. Kecepatan angin</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator6" value="Tenang" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Tenang (<5 km/jam)</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator6" value="Sedang" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Sedang (5-20 km/jam)</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator6" value="Kencang" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Kencang (>20 km/jam)</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan6" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>

                                            <!-- Indicator 7 -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">7. Akses pemadaman kebakaran</label>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator7" value="Mudah" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Mudah</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator7" value="Sedang" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Sedang</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input x-model="formData.indikator7" value="Sulit" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                        <label class="ml-2 block text-sm text-gray-700">Sulit</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <textarea x-model="formData.catatan7" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section C: Kesimpulan dan Tindakan -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">C. Kesimpulan dan Tindakan</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tingkat Risiko Kebakaran *</label>
                                                    <select x-model="formData.tingkat_risiko" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                        <option value="">Pilih Tingkat Risiko</option>
                                                        <option value="Rendah">Rendah</option>
                                                        <option value="Sedang">Sedang</option>
                                                        <option value="Tinggi">Tinggi</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tindakan Pencegahan yang Dilakukan *</label>
                                                    <textarea x-model="formData.tindakan_pencegahan" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Recomendasi Lanjutan</label>
                                                    <textarea x-model="formData.rekomendasi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
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
                                                <label class="block text-sm font-medium text-gray-700">Koordinat/Titik Pantau</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.koordinat || '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Luas Area Dipantau (Ha)</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.luas_area ? viewData.luas_area + ' Ha' : '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Tanggal Pemantauan</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="formatDate(viewData.tanggal_pemantauan) || '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Nama Petugas/Pemantau</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nama_petugas || '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Nama Pemilik Lahan</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.pemilik_lahan || '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Jenis Lahan</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.jenis_lahan || '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Cuaca Saat Pemantauan</label>
                                                <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.cuaca || '-'"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section B: Indikator Potensi Kebakaran -->
                                <div>
                                    <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                        <h4 class="font-bold">B. Indikator Potensi Kebakaran</h4>
                                    </div>
                                    <div class="border border-gray-200 p-4 rounded-b-lg space-y-4">
                                        <!-- Indicator 1 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">1. Apakah terdapat sampah kering/tumpukan ranting?</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator1 || '-'"></p>
                                            <template x-if="viewData.catatan1">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan1"></p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Indicator 2 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">2. Apakah terdapat vegetasi kering/mati?</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator2 || '-'"></p>
                                            <template x-if="viewData.catatan2">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan2"></p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Indicator 3 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">3. Apakah terdapat aktivitas pembakaran?</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator3 || '-'"></p>
                                            <template x-if="viewData.catatan3">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan3"></p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Indicator 4 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">4. Apakah terdapat sumber api potensial?</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator4 || '-'"></p>
                                            <template x-if="viewData.catatan4">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan4"></p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Indicator 5 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">5. Kondisi kelembaban tanah</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator5 || '-'"></p>
                                            <template x-if="viewData.catatan5">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan5"></p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Indicator 6 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">6. Kecepatan angin</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator6 || '-'"></p>
                                            <template x-if="viewData.catatan6">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan6"></p>
                                                </div>
                                            </template>
                                        </div>

                                        <!-- Indicator 7 -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">7. Akses pemadaman kebakaran</label>
                                            <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.indikator7 || '-'"></p>
                                            <template x-if="viewData.catatan7">
                                                <div class="mt-2">
                                                    <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                                                    <p class="mt-1 text-sm text-gray-900" x-text="viewData.catatan7"></p>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section C: Kesimpulan dan Tindakan -->
                                <div>
                                    <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                        <h4 class="font-bold">C. Kesimpulan dan Tindakan</h4>
                                    </div>
                                    <div class="border border-gray-200 p-4 rounded-b-lg">
                                        <div class="grid grid-cols-1 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Tingkat Risiko Kebakaran</label>
                                                <span x-bind:class="{
                                                    'bg-green-100 text-green-800': viewData.tingkat_risiko === 'Rendah',
                                                    'bg-yellow-100 text-yellow-800': viewData.tingkat_risiko === 'Sedang',
                                                    'bg-red-100 text-red-800': viewData.tingkat_risiko === 'Tinggi'
                                                }" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" x-text="viewData.tingkat_risiko || '-'">
                                                </span>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Tindakan Pencegahan yang Dilakukan</label>
                                                <p class="mt-1 text-sm text-gray-900 whitespace-pre-line" x-text="viewData.tindakan_pencegahan || '-'"></p>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Recomendasi Lanjutan</label>
                                                <p class="mt-1 text-sm text-gray-900 whitespace-pre-line" x-text="viewData.rekomendasi || '-'"></p>
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
function fireRiskApp() {
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
            luas_area: '',
            tanggal_pemantauan: '',
            nama_petugas: '',
            pemilik_lahan: '',
            jenis_lahan: '',
            cuaca: '',
            indikator1: '',
            catatan1: '',
            indikator2: '',
            catatan2: '',
            indikator3: '',
            catatan3: '',
            indikator4: '',
            catatan4: '',
            indikator5: '',
            catatan5: '',
            indikator6: '',
            catatan6: '',
            indikator7: '',
            catatan7: '',
            tingkat_risiko: '',
            tindakan_pencegahan: '',
            rekomendasi: ''
        },
        
        // Inisialisasi data dari localStorage saat komponen dimuat
        init() {
            const savedData = localStorage.getItem('fireRiskMonitoringData');
            if (savedData) {
                this.monitoringData = JSON.parse(savedData);
            } else {
                // Data contoh jika localStorage kosong
                this.monitoringData = [
                    {
                        id: 1,
                        nama_lokasi: 'Blok A1',
                        koordinat: '-6.12345, 106.78901',
                        luas_area: 25.5,
                        tanggal_pemantauan: '2023-07-15',
                        nama_petugas: 'Budi Santoso',
                        pemilik_lahan: 'PT Perkebunan Nusantara',
                        jenis_lahan: 'Perkebunan',
                        cuaca: 'Panas',
                        indikator1: 'Ada',
                        catatan1: 'Banyak ranting kering di area timur',
                        indikator2: 'Tidak',
                        catatan2: '',
                        indikator3: 'Tidak',
                        catatan3: '',
                        indikator4: 'Ada',
                        catatan4: 'Ada aktivitas pembakaran sampah di dekat lokasi',
                        indikator5: 'Kering',
                        catatan5: 'Tanah sangat kering',
                        indikator6: 'Sedang',
                        catatan6: 'Angin sekitar 10-15 km/jam',
                        indikator7: 'Sedang',
                        catatan7: 'Akses jalan cukup baik tapi sempit',
                        tingkat_risiko: 'Sedang',
                        tindakan_pencegahan: 'Pembersihan ranting kering dan pembuatan sekat bakar',
                        rekomendasi: 'Perlu patroli rutin 2x sehari'
                    }
                ];
                this.saveToLocalStorage();
            }
        },
        
        // Menyimpan data ke localStorage
        saveToLocalStorage() {
            localStorage.setItem('fireRiskMonitoringData', JSON.stringify(this.monitoringData));
        },
        
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID');
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
            // Validasi form
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
        
        // Validasi form sebelum menyimpan
        validateForm() {
            const requiredFields = [
                'nama_lokasi', 'koordinat', 'luas_area', 'tanggal_pemantauan',
                'nama_petugas', 'pemilik_lahan', 'jenis_lahan', 'cuaca',
                'tingkat_risiko', 'tindakan_pencegahan'
            ];
            
            for (const field of requiredFields) {
                if (!this.formData[field]) {
                    alert(`Field ${field.replace(/_/g, ' ')} harus diisi!`);
                    return false;
                }
            }
            
            return true;
        },
        
        resetForm() {
            this.formData = {
                nama_lokasi: '',
                koordinat: '',
                luas_area: '',
                tanggal_pemantauan: '',
                nama_petugas: '',
                pemilik_lahan: '',
                jenis_lahan: '',
                cuaca: '',
                indikator1: '',
                catatan1: '',
                indikator2: '',
                catatan2: '',
                indikator3: '',
                catatan3: '',
                indikator4: '',
                catatan4: '',
                indikator5: '',
                catatan5: '',
                indikator6: '',
                catatan6: '',
                indikator7: '',
                catatan7: '',
                tingkat_risiko: '',
                tindakan_pencegahan: '',
                rekomendasi: ''
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