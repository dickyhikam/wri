<?php
// Include header
include 'header.php';
?>

<!-- Main Content -->
<div class="flex-1 overflow-auto custom-scroll p-6" x-data="boundaryMarkerApp()">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <a href="javascript:history.back()" class="btn bg-gray-200 hover:bg-gray-300 text-gray-800 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <h2 class="text-2xl font-bold text-gray-800">Pemantauan Patok Sempadan Sungai/Kanal</h2>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Sungai/Kanal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik Lahan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Patok</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="(item, index) in monitoringData" :key="item.id">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="index + 1"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="item.nama_lokasi"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.nama_sungai"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="formatDate(item.tanggal_pemantauan)"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.nama_petugas"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.pemilik_lahan"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="item.patok.length"></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span x-bind:class="{
                                        'bg-green-100 text-green-800': getOverallStatus(item) === 'Baik',
                                        'bg-yellow-100 text-yellow-800': getOverallStatus(item) === 'Perlu Perbaikan',
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
                                                    <label class="block text-sm font-medium text-gray-700">Nama Lokasi/Blok <span class="text-red-500">*</span></label>
                                                    <input x-model="formData.nama_lokasi" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Sungai/Kanal <span class="text-red-500">*</span></label>
                                                    <input x-model="formData.nama_sungai" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Pemilik Lahan <span class="text-red-500">*</span></label>
                                                    <input x-model="formData.pemilik_lahan" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tanggal Pemantauan <span class="text-red-500">*</span></label>
                                                    <input x-model="formData.tanggal_pemantauan" type="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Petugas/Pemantau <span class="text-red-500">*</span></label>
                                                    <input x-model="formData.nama_petugas" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section B: Kondisi Patok -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">B. Kondisi Patok</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="mb-4">
                                                <button @click="addPatok()" type="button" class="btn bg-green-500 hover:bg-green-600 text-white">
                                                    <i class="fas fa-plus mr-2"></i> Tambah Patok
                                                </button>
                                            </div>

                                            <div class="space-y-6">
                                                <template x-for="(patok, index) in formData.patok" :key="index">
                                                    <div class="border border-gray-200 p-4 rounded-lg">
                                                        <div class="flex justify-between items-center mb-3">
                                                            <h5 class="font-medium">Patok #<span x-text="index + 1"></span></h5>
                                                            <button @click="removePatok(index)" type="button" class="text-red-500 hover:text-red-700">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>

                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Nomor Patok <span class="text-red-500">*</span></label>
                                                                <input x-model="patok.nomor" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50">
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Kondisi Patok <span class="text-red-500">*</span></label>
                                                                <div class="mt-2 space-y-2">
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.kondisi" value="Baik" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Baik</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.kondisi" value="Rusak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Rusak</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.kondisi" value="Hilang" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Hilang</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Vegetasi Sempadan <span class="text-red-500">*</span></label>
                                                                <div class="mt-2 space-y-2">
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.vegetasi" value="Terjaga" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Terjaga</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.vegetasi" value="Terbuka" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Terbuka</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Tanda Gangguan <span class="text-red-500">*</span></label>
                                                                <div class="mt-2 space-y-2">
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.gangguan" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.gangguan" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Perlu Tindak Lanjut <span class="text-red-500">*</span></label>
                                                                <div class="mt-2 space-y-2">
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.tindak_lanjut" value="Ya" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Ya</label>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <input x-model="patok.tindak_lanjut" value="Tidak" type="radio" class="h-4 w-4 text-[#f0ab00] focus:ring-[#f0ab00] border-gray-300">
                                                                        <label class="ml-2 block text-sm text-gray-700">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="md:col-span-2">
                                                                <label class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                                                                <textarea x-model="patok.catatan" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section C: Rekomendasi -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">C. Rekomendasi atau Tindakan Lanjut</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Rekomendasi <span class="text-red-500">*</span></label>
                                                    <textarea x-model="formData.rekomendasi" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#f0ab00] focus:ring focus:ring-[#f0ab00] focus:ring-opacity-50"></textarea>
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
                                                    <label class="block text-sm font-medium text-gray-700">Nama Sungai/Kanal</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nama_sungai || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Pemilik Lahan</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.pemilik_lahan || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Tanggal Pemantauan</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="formatDate(viewData.tanggal_pemantauan) || '-'"></p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Nama Petugas/Pemantau</label>
                                                    <p class="mt-1 text-sm text-gray-900 font-semibold" x-text="viewData.nama_petugas || '-'"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section B: Kondisi Patok -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">B. Kondisi Patok</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Patok</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vegetasi</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gangguan</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindak Lanjut</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        <template x-for="(patok, index) in viewData.patok" :key="index">
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="patok.nomor"></td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="patok.kondisi"></td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="patok.vegetasi"></td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="patok.gangguan"></td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="patok.tindak_lanjut"></td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="patok.catatan || '-'"></td>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section C: Rekomendasi -->
                                    <div>
                                        <div class="bg-[#f0ab00] text-white px-4 py-2 rounded-t-lg">
                                            <h4 class="font-bold">C. Rekomendasi atau Tindakan Lanjut</h4>
                                        </div>
                                        <div class="border border-gray-200 p-4 rounded-b-lg">
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Rekomendasi</label>
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
    function boundaryMarkerApp() {
        return {
            openModal: false,
            viewModal: false,
            deleteModal: false,
            currentForm: 'new',
            currentItemId: null,
            monitoringData: [],
            formData: {
                nama_lokasi: '',
                nama_sungai: '',
                pemilik_lahan: '',
                tanggal_pemantauan: '',
                nama_petugas: '',
                patok: [],
                rekomendasi: ''
            },

            // Initialize data from localStorage
            init() {
                const savedData = localStorage.getItem('boundaryMarkerData');
                if (savedData) {
                    this.monitoringData = JSON.parse(savedData);
                } else {
                    // Sample data if localStorage is empty
                    this.monitoringData = [{
                        id: 1,
                        nama_lokasi: 'Blok Sungai A',
                        nama_sungai: 'Sungai Ciliwung',
                        pemilik_lahan: 'PT Perkebunan Nusantara',
                        tanggal_pemantauan: '2023-07-20',
                        nama_petugas: 'Budi Santoso',
                        patok: [{
                                nomor: 'P001',
                                kondisi: 'Baik',
                                vegetasi: 'Terjaga',
                                gangguan: 'Tidak',
                                tindak_lanjut: 'Tidak',
                                catatan: 'Kondisi normal'
                            },
                            {
                                nomor: 'P002',
                                kondisi: 'Rusak',
                                vegetasi: 'Terbuka',
                                gangguan: 'Ya',
                                tindak_lanjut: 'Ya',
                                catatan: 'Perlu perbaikan patok'
                            }
                        ],
                        rekomendasi: 'Perlu perbaikan patok P002 dan penanaman vegetasi di sempadan'
                    }];
                    this.saveToLocalStorage();
                }
            },

            // Save data to localStorage
            saveToLocalStorage() {
                localStorage.setItem('boundaryMarkerData', JSON.stringify(this.monitoringData));
            },

            formatDate(dateString) {
                if (!dateString) return '';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID');
            },

            // Add new patok entry
            addPatok() {
                this.formData.patok.push({
                    nomor: '',
                    kondisi: '',
                    vegetasi: '',
                    gangguan: '',
                    tindak_lanjut: '',
                    catatan: ''
                });
            },

            // Remove patok entry
            removePatok(index) {
                this.formData.patok.splice(index, 1);
            },

            // Calculate overall status based on patok conditions
            getOverallStatus(item) {
                if (!item.patok || item.patok.length === 0) return 'Baik';

                const criticalCount = item.patok.filter(p =>
                    p.kondisi === 'Hilang' ||
                    p.kondisi === 'Rusak' ||
                    p.gangguan === 'Ya' ||
                    p.tindak_lanjut === 'Ya'
                ).length;

                if (criticalCount === 0) return 'Baik';
                if (criticalCount < item.patok.length / 2) return 'Perlu Perbaikan';
                return 'Kritis';
            },

            viewItem(item) {
                this.viewData = JSON.parse(JSON.stringify(item));
                this.viewModal = true;
            },

            editItem(item) {
                this.currentForm = 'edit';
                this.currentItemId = item.id;
                this.formData = {
                    ...item
                };
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
                    'nama_lokasi', 'nama_sungai', 'pemilik_lahan',
                    'tanggal_pemantauan', 'nama_petugas', 'rekomendasi'
                ];

                // Check main form fields
                for (const field of requiredFields) {
                    if (!this.formData[field]) {
                        alert(`Field ${field.replace(/_/g, ' ')} harus diisi!`);
                        return false;
                    }
                }

                // Check patok entries
                if (this.formData.patok.length === 0) {
                    alert('Minimal harus ada satu patok yang dimonitoring!');
                    return false;
                }

                for (const patok of this.formData.patok) {
                    if (!patok.nomor || !patok.kondisi || !patok.vegetasi ||
                        !patok.gangguan || !patok.tindak_lanjut) {
                        alert('Semua field wajib untuk setiap patok harus diisi!');
                        return false;
                    }
                }

                return true;
            },

            resetForm() {
                this.formData = {
                    nama_lokasi: '',
                    nama_sungai: '',
                    pemilik_lahan: '',
                    tanggal_pemantauan: '',
                    nama_petugas: '',
                    patok: [],
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