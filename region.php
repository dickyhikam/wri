<?php include 'header.php'; ?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <div class="">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Data Region</h2>
                </div>
                <div class="flex space-x-4">
                    <!-- Tombol Tambah Provinsi (default visible) -->
                    <button id="addProvinsiBtn" onclick="openProvinsiModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i> Tambah Provinsi
                    </button>
                    <!-- Tombol Tambah Kabupaten (default hidden) -->
                    <button id="addKabupatenBtn" onclick="openKabupatenModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
                        <i class="fas fa-plus mr-2"></i> Tambah Kabupaten
                    </button>
                    <!-- Tombol Tambah Kecamatan (default hidden) -->
                    <button id="addKecamatanBtn" onclick="openKecamatanModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
                        <i class="fas fa-plus mr-2"></i> Tambah Kecamatan
                    </button>
                    <!-- Tombol Tambah Desa (default hidden) -->
                    <button id="addDesaBtn" onclick="openDesaModal()" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center hidden">
                        <i class="fas fa-plus mr-2"></i> Tambah Desa
                    </button>
                </div>
            </div>
        </div>
        <br>
        <!-- Submodule Navigation -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-100">
            <nav class="flex space-x-4" aria-label="Tabs">
                <button id="tabProvinsi" class="px-3 py-2 font-medium text-sm rounded-md bg-blue-100 text-blue-700">
                    Provinsi
                </button>
                <button id="tabKabupaten" class="px-3 py-2 font-medium text-sm rounded-md text-gray-500 hover:text-gray-700">
                    Kabupaten
                </button>
                <button id="tabKecamatan" class="px-3 py-2 font-medium text-sm rounded-md text-gray-500 hover:text-gray-700">
                    Kecamatan
                </button>
                <button id="tabDesa" class="px-3 py-2 font-medium text-sm rounded-md text-gray-500 hover:text-gray-700">
                    Desa
                </button>
            </nav>
        </div>

        <!-- Provinsi Section -->
        <div id="provinsiSection">
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form class="flex flex-wrap gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="searchProvinsi" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama mitra...">
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" onclick="filterMitra('provinsi')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                            <button type="button" onclick="resetFilter('provinsi')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                                <i class="fas fa-sync-alt mr-2"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Provinsi Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="mitraProvinsiTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-xl">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button onclick="previousPage('provinsi')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button onclick="nextPage('provinsi')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p id="provinsiPaginationInfo" class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button onclick="previousPage('provinsi')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div id="provinsiPaginationNumbers" class="flex">
                                <!-- Pagination numbers will be inserted here -->
                            </div>
                            <button onclick="nextPage('provinsi')" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kabupaten Section (Hidden by default) -->
        <div id="kabupatenSection" class="hidden">
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form class="flex flex-wrap gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="searchKabupaten" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama kabupaten...">
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" onclick="filterMitra('kabupaten')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                            <button type="button" onclick="resetFilter('kabupaten')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                                <i class="fas fa-sync-alt mr-2"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kabupaten Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="mitraKabupatenTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-xl">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button onclick="previousPage('kabupaten')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button onclick="nextPage('kabupaten')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p id="kabupatenPaginationInfo" class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button onclick="previousPage('kabupaten')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div id="kabupatenPaginationNumbers" class="flex">
                                <!-- Pagination numbers will be inserted here -->
                            </div>
                            <button onclick="nextPage('kabupaten')" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kabupaten Section (Hidden by default) -->
        <div id="kecamatanSection" class="hidden">
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form class="flex flex-wrap gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="searchKabupaten" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama kecamatan...">
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" onclick="filterMitra('kecamatan')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                            <button type="button" onclick="resetFilter('kecamatan')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                                <i class="fas fa-sync-alt mr-2"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kecamatan Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="mitraKecamatanTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-xl">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button onclick="previousPage('kecamatan')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button onclick="nextPage('kecamatan')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p id="kecamatanPaginationInfo" class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button onclick="previousPage('kecamatan')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div id="kecamatanPaginationNumbers" class="flex">
                                <!-- Pagination numbers will be inserted here -->
                            </div>
                            <button onclick="nextPage('kecamatan')" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kabupaten Section (Hidden by default) -->
        <div id="desaSection" class="hidden">
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form class="flex flex-wrap gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" id="searchKabupaten" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari nama desa...">
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button" onclick="filterMitra('desa')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                            <button type="button" onclick="resetFilter('desa')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                                <i class="fas fa-sync-alt mr-2"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Desa Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Desa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="mitraDesaTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-xl">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button onclick="previousPage('desa')" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button onclick="nextPage('desa')" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p id="desaPaginationInfo" class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button onclick="previousPage('desa')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div id="desaPaginationNumbers" class="flex">
                                <!-- Pagination numbers will be inserted here -->
                            </div>
                            <button onclick="nextPage('desa')" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
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

<!-- Modal Tambah/Edit Provinsi -->
<div id="provinsiModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-map text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="provinsiModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Provinsi Baru</h3>
                        <div class="mt-2">
                            <form id="provinsiForm">
                                <input type="hidden" id="provinsiId">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="provinsiName">Provinsi <span class="text-red-500">*</span></label>
                                        <input type="text" id="provinsiName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveProvinsiBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" onclick="closeProvinsiModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Kabupaten -->
<div id="kabupatenModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-map text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="kabupatenModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Kabupaten Baru</h3>
                        <div class="mt-2">
                            <form id="kabupatenForm">
                                <input type="hidden" id="kabupatenId">

                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="provinsiArea">Provinsi <span class="text-red-500">*</span></label>
                                        <select id="provinsiArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="kabupatenName">Kabupaten <span class="text-red-500">*</span></label>
                                        <input type="text" id="kabupatenName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveKabupatenBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" onclick="closeKabupatenModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Kecamatan -->
<div id="kecamatanModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-map text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="kecamatanModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Kecamatan Baru</h3>
                        <div class="mt-2">
                            <form id="kecamatanForm">
                                <input type="hidden" id="kecamatanId">

                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="provinsiArea">Provinsi <span class="text-red-500">*</span></label>
                                        <select id="provinsiArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="kabupatenArea">Kabupaten <span class="text-red-500">*</span></label>
                                        <select id="kabupatenArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="kecamatanName">Kecamatan <span class="text-red-500">*</span></label>
                                        <input type="text" id="kecamatanName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveKecamatanBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" onclick="closeKecamatanModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Desa -->
<div id="desaModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#f0ab00] sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 id="desaModalTitle" class="text-lg leading-6 font-medium text-gray-900">Tambah Desa/Kelurahan Baru</h3>
                        <div class="mt-2">
                            <form id="desaForm">
                                <input type="hidden" id="desaId">

                                <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="provinsiArea">Provinsi <span class="text-red-500">*</span></label>
                                        <select id="provinsiArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="kabupatenArea">Kabupaten <span class="text-red-500">*</span></label>
                                        <select id="kabupatenArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="kecamatanArea">Kecamatan <span class="text-red-500">*</span></label>
                                        <select id="kecamatanArea" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1" for="desaName">Desa/Kelurahan</label>
                                        <input type="text" id="desaName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="saveDesaBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#f0ab00] text-base font-medium text-white hover:bg-[#e09900] sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" onclick="closeDesaModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div id="deleteMitraModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
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
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Mitra</h3>
                        <div class="mt-2">
                            <p id="deleteMitraMessage" class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus mitra ini?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="confirmDeleteMitra()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button type="button" onclick="closeDeleteMitraModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Data
    // Array Provinsi (fokus: Sumatra dan utamanya Riau)
    const provinsiData = [{
            id: 14,
            nama: "Riau"
        },
        {
            id: 12,
            nama: "Sumatera Utara"
        },
        {
            id: 16,
            nama: "Sumatera Selatan"
        },
        {
            id: 15,
            nama: "Jambi"
        }
    ];

    // Array Kabupaten/Kota di Riau (10 kabupaten, 2 kota)
    const kabupatenData = [{
            id: 1401,
            id_provinsi: 14,
            nama: "Kabupaten Kampar"
        },
        {
            id: 1402,
            id_provinsi: 14,
            nama: "Kabupaten Indragiri Hulu"
        },
        {
            id: 1403,
            id_provinsi: 14,
            nama: "Kabupaten Bengkalis"
        },
        {
            id: 1404,
            id_provinsi: 14,
            nama: "Kabupaten Indragiri Hilir"
        },
        {
            id: 1405,
            id_provinsi: 14,
            nama: "Kabupaten Pelalawan"
        },
        {
            id: 1406,
            id_provinsi: 14,
            nama: "Kabupaten Rokan Hulu"
        },
        {
            id: 1407,
            id_provinsi: 14,
            nama: "Kabupaten Rokan Hilir"
        },
        {
            id: 1408,
            id_provinsi: 14,
            nama: "Kabupaten Siak"
        },
        {
            id: 1409,
            id_provinsi: 14,
            nama: "Kabupaten Kuantan Singingi"
        },
        {
            id: 1410,
            id_provinsi: 14,
            nama: "Kabupaten Kepulauan Meranti"
        },
        {
            id: 1471,
            id_provinsi: 14,
            nama: "Kota Pekanbaru"
        },
        {
            id: 1472,
            id_provinsi: 14,
            nama: "Kota Dumai"
        }
    ];

    // Contoh Array Kecamatan (banyak, beberapa dari tiap kabupaten)
    const kecamatanData = [{
            id: 140101,
            id_kabupaten: 1401,
            nama: "Bangkinang Kota"
        },
        {
            id: 140102,
            id_kabupaten: 1401,
            nama: "Kampar Kiri"
        },
        {
            id: 140201,
            id_kabupaten: 1402,
            nama: "Rengat"
        },
        {
            id: 140202,
            id_kabupaten: 1402,
            nama: "Seberida"
        },
        {
            id: 140301,
            id_kabupaten: 1403,
            nama: "Bantan"
        },
        {
            id: 140302,
            id_kabupaten: 1403,
            nama: "Bukit Batu"
        },
        {
            id: 140401,
            id_kabupaten: 1404,
            nama: "Tembilahan"
        },
        {
            id: 140402,
            id_kabupaten: 1404,
            nama: "Enok"
        },
        {
            id: 140501,
            id_kabupaten: 1405,
            nama: "Pangkalan Kerinci"
        },
        {
            id: 140601,
            id_kabupaten: 1406,
            nama: "Ujung Batu"
        },
        {
            id: 140701,
            id_kabupaten: 1407,
            nama: "Bangko"
        },
        {
            id: 140801,
            id_kabupaten: 1408,
            nama: "Siak"
        },
        {
            id: 140901,
            id_kabupaten: 1409,
            nama: "Kuantan Mudik"
        },
        {
            id: 141001,
            id_kabupaten: 1410,
            nama: "Tebing Tinggi"
        },
        {
            id: 147101,
            id_kabupaten: 1471,
            nama: "Sukajadi"
        },
        {
            id: 147201,
            id_kabupaten: 1472,
            nama: "Dumai Barat"
        }
        // dst, (total ada 169 kecamatan lebih di Riau!!!)
    ];

    // Contoh Array Desa/Kelurahan (lebih banyak, per kecamatan — ambil beberapa per kecamatan)
    const desaData = [{
            id: 1401012001,
            id_kecamatan: 140101,
            nama: "Desa Ridan Permai"
        },
        {
            id: 1401012002,
            id_kecamatan: 140101,
            nama: "Desa Langgini"
        },
        {
            id: 1402012001,
            id_kecamatan: 140201,
            nama: "Desa Seberida"
        },
        {
            id: 1403012001,
            id_kecamatan: 140301,
            nama: "Desa Bantan Air"
        },
        {
            id: 1403022001,
            id_kecamatan: 140302,
            nama: "Desa Bukit Batu"
        },
        {
            id: 1404011001,
            id_kecamatan: 140401,
            nama: "Kelurahan Tembilahan"
        },
        {
            id: 1404022001,
            id_kecamatan: 140402,
            nama: "Desa Sungai Guntung"
        },
        {
            id: 1405011001,
            id_kecamatan: 140501,
            nama: "Kelurahan Pangkalan Kerinci"
        },
        {
            id: 1406012001,
            id_kecamatan: 140601,
            nama: "Desa Ujung Batu Timur"
        },
        {
            id: 1407012001,
            id_kecamatan: 140701,
            nama: "Desa Bangko Bakti"
        },
        {
            id: 1408011001,
            id_kecamatan: 140801,
            nama: "Kelurahan Kampung Dalam"
        },
        {
            id: 1409012001,
            id_kecamatan: 140901,
            nama: "Desa Sungai Pinang"
        },
        {
            id: 1410011001,
            id_kecamatan: 141001,
            nama: "Selat Panjang Kota"
        },
        {
            id: 1471011001,
            id_kecamatan: 147101,
            nama: "Kelurahan Jadirejo"
        },
        {
            id: 1472011001,
            id_kecamatan: 147201,
            nama: "Kelurahan Bukit Timah"
        }
        // dst, isi data lebih banyak sesuai kebutuhan.
    ];

    // Pagination Settings
    const itemsPerPage = 10;
    let currentProvinsiPage = 1;
    let currentKabupatenPage = 1;
    let currentKecamatanPage = 1;
    let currentDesaPage = 1;
    let filteredProvinsiData = [...provinsiData];
    let filteredKabupatenData = [...kabupatenData];
    let filteredKecamatanData = [...kecamatanData];
    let filteredDesaData = [...desaData];

    // DOM Elements
    let tabProvinsi, tabKabupaten, tabKecamatan, tabDesa, provinsiSection, kabupatenSection, kecamatanSection, desaSection, mitraProvinsiTableBody, mitraKabupatenTableBody, mitraKecamatanTableBody, mitraDesaTableBody, addProvinsiBtn, addKabupatenBtn, addKecamatanBtn, addDesaBtn;
    let currentMitraId = null;
    let currentMitraType = null;

    // Fungsi untuk menginisialisasi DOM elements
    function initializeDOM() {
        tabProvinsi = document.getElementById('tabProvinsi');
        tabKabupaten = document.getElementById('tabKabupaten');
        tabKecamatan = document.getElementById('tabKecamatan');
        tabDesa = document.getElementById('tabDesa');
        provinsiSection = document.getElementById('provinsiSection');
        kabupatenSection = document.getElementById('kabupatenSection');
        kecamatanSection = document.getElementById('kecamatanSection');
        desaSection = document.getElementById('desaSection');
        mitraProvinsiTableBody = document.getElementById('mitraProvinsiTableBody');
        mitraKabupatenTableBody = document.getElementById('mitraKabupatenTableBody');
        mitraKecamatanTableBody = document.getElementById('mitraKecamatanTableBody');
        mitraDesaTableBody = document.getElementById('mitraDesaTableBody');
        addProvinsiBtn = document.getElementById('addProvinsiBtn');
        addKabupatenBtn = document.getElementById('addKabupatenBtn');
        addKecamatanBtn = document.getElementById('addKecamatanBtn');
        addDesaBtn = document.getElementById('addDesaBtn');
    }

    // Fungsi untuk mengatur event listeners
    function setupEventListeners() {
        // Tab switching
        tabProvinsi.addEventListener('click', () => {
            tabProvinsi.classList.add('bg-blue-100', 'text-blue-700');
            tabKabupaten.classList.remove('bg-blue-100', 'text-blue-700');
            tabKecamatan.classList.remove('bg-blue-100', 'text-blue-700');
            tabDesa.classList.remove('bg-blue-100', 'text-blue-700');

            tabProvinsi.classList.remove('text-gray-500', 'hover:text-gray-700');
            tabKabupaten.classList.add('text-gray-500', 'hover:text-gray-700');
            tabKecamatan.classList.add('text-gray-500', 'hover:text-gray-700');
            tabDesa.classList.add('text-gray-500', 'hover:text-gray-700');

            provinsiSection.classList.remove('hidden');
            kabupatenSection.classList.add('hidden');
            kecamatanSection.classList.add('hidden');
            desaSection.classList.add('hidden');

            addProvinsiBtn.classList.remove('hidden');
            addKabupatenBtn.classList.add('hidden');
            addKecamatanBtn.classList.add('hidden');
            addDesaBtn.classList.add('hidden');

            filteredProvinsiData = [...provinsiData];
            renderMitraProvinsiTable();
            updateProvinsiPagination();
        });

        tabKabupaten.addEventListener('click', () => {
            tabProvinsi.classList.remove('bg-blue-100', 'text-blue-700');
            tabKabupaten.classList.add('bg-blue-100', 'text-blue-700');
            tabKecamatan.classList.remove('bg-blue-100', 'text-blue-700');
            tabDesa.classList.remove('bg-blue-100', 'text-blue-700');

            tabProvinsi.classList.add('text-gray-500', 'hover:text-gray-700');
            tabKabupaten.classList.remove('text-gray-500', 'hover:text-gray-700');
            tabKecamatan.classList.add('text-gray-500', 'hover:text-gray-700');
            tabDesa.classList.add('text-gray-500', 'hover:text-gray-700');

            provinsiSection.classList.add('hidden');
            kabupatenSection.classList.remove('hidden');
            kecamatanSection.classList.add('hidden');
            desaSection.classList.add('hidden');

            addProvinsiBtn.classList.add('hidden');
            addKabupatenBtn.classList.remove('hidden');
            addKecamatanBtn.classList.add('hidden');
            addDesaBtn.classList.add('hidden');

            filteredKabupatenData = [...kabupatenData];
            renderMitraKabupatenTable();
            updateKabupatenPagination();
        });

        tabKecamatan.addEventListener('click', () => {
            tabProvinsi.classList.remove('bg-blue-100', 'text-blue-700');
            tabKabupaten.classList.remove('bg-blue-100', 'text-blue-700');
            tabKecamatan.classList.add('bg-blue-100', 'text-blue-700');
            tabDesa.classList.remove('bg-blue-100', 'text-blue-700');

            tabProvinsi.classList.add('text-gray-500', 'hover:text-gray-700');
            tabKabupaten.classList.add('text-gray-500', 'hover:text-gray-700');
            tabKecamatan.classList.remove('text-gray-500', 'hover:text-gray-700');
            tabDesa.classList.add('text-gray-500', 'hover:text-gray-700');

            provinsiSection.classList.add('hidden');
            kabupatenSection.classList.add('hidden');
            kecamatanSection.classList.remove('hidden');
            desaSection.classList.add('hidden');

            addProvinsiBtn.classList.add('hidden');
            addKabupatenBtn.classList.add('hidden');
            addKecamatanBtn.classList.remove('hidden');
            addDesaBtn.classList.add('hidden');

            filteredKecamatanData = [...kecamatanData];
            renderMitraKecamatanTable();
            updateKabupatenPagination();
        });

        tabDesa.addEventListener('click', () => {
            tabProvinsi.classList.remove('bg-blue-100', 'text-blue-700');
            tabKabupaten.classList.remove('bg-blue-100', 'text-blue-700');
            tabKecamatan.classList.remove('bg-blue-100', 'text-blue-700');
            tabDesa.classList.add('bg-blue-100', 'text-blue-700');

            tabProvinsi.classList.add('text-gray-500', 'hover:text-gray-700');
            tabKabupaten.classList.add('text-gray-500', 'hover:text-gray-700');
            tabKecamatan.classList.add('text-gray-500', 'hover:text-gray-700');
            tabDesa.classList.remove('text-gray-500', 'hover:text-gray-700');

            provinsiSection.classList.add('hidden');
            kabupatenSection.classList.add('hidden');
            kecamatanSection.classList.add('hidden');
            desaSection.classList.remove('hidden');

            addProvinsiBtn.classList.add('hidden');
            addKabupatenBtn.classList.add('hidden');
            addKecamatanBtn.classList.add('hidden');
            addDesaBtn.classList.remove('hidden');

            filteredDesaData = [...desaData];
            renderMitraDesaTable();
            updateKabupatenPagination();
        });

        // Save buttons
        document.getElementById('saveProvinsiBtn').addEventListener('click', saveProvinsi);
        document.getElementById('saveKabupatenBtn').addEventListener('click', saveKabupaten);

        // Search functionality
        document.getElementById('searchProvinsi').addEventListener('input', () => filterMitra('provinsi'));
        document.getElementById('searchKabupaten').addEventListener('input', () => filterMitra('kabupaten'));
    }

    // Fungsi untuk inisialisasi awal
    function initializeApp() {
        initializeDOM();
        setupEventListeners();

        // Set data filtered
        filteredProvinsiData = [...provinsiData];
        filteredKabupatenData = [...kabupatenData];

        // Render tables
        renderMitraProvinsiTable();
        renderMitraKabupatenTable();
        updateProvinsiPagination();
        updateKabupatenPagination();

        // Aktifkan tab Provinsi secara default
        tabProvinsi.click();

        // Pastikan kode ini dijalankan setelah DOM siap, misal di window.onload atau setelah elemen HTML dimuat.
        const provinsiSelect = document.getElementById('provinsiArea');
        provinsiData.forEach(prov => {
            const opt = document.createElement('option');
            opt.value = prov.id; // isi value sesuai kebutuhan misalnya pakai id atau nama
            opt.textContent = prov.nama;
            provinsiSelect.appendChild(opt);
        });

    }

    // Filter Function
    function filterMitra(type) {
        if (type === 'provinsi') {
            const parent = document.getElementById('filterParent').value;
            const provinsi = document.getElementById('filterProvinsi').value;
            const kabupaten = document.getElementById('filterKabupaten').value;
            const search = document.getElementById('searchProvinsi').value.toLowerCase();

            filteredProvinsiData = mitraProvinsiData.filter(m => {
                const matchesParent = parent ? m.parent_company === parent : true;
                const matchesProvinsi = provinsi ? m.location.includes(provinsi) : true;
                const matchesKabupaten = kabupaten ? m.location.includes(kabupaten) : true;
                const matchesSearch = search ?
                    (m.name.toLowerCase().includes(search) ||
                        m.location.toLowerCase().includes(search)) : true;

                return matchesParent && matchesProvinsi && matchesKabupaten && matchesSearch;
            });

            currentProvinsiPage = 1;
            renderMitraProvinsiTable();
            updateProvinsiPagination();
        } else {
            const provinsi = document.getElementById('filterProvinsiKabupaten').value;
            const kabupaten = document.getElementById('filterKabupatenKabupaten').value;
            const status = document.getElementById('filterStatusKabupaten').value;
            const search = document.getElementById('searchKabupaten').value.toLowerCase();

            filteredKabupatenData = mitraKabupatenData.filter(m => {
                const matchesProvinsi = provinsi ? m.location.includes(provinsi) : true;
                const matchesKabupaten = kabupaten ? m.location.includes(kabupaten) : true;
                const matchesStatus = status ? m.status === status : true;
                const matchesSearch = search ?
                    (m.name.toLowerCase().includes(search) ||
                        m.location.toLowerCase().includes(search) ||
                        m.kode.toLowerCase().includes(search)) : true;

                return matchesProvinsi && matchesKabupaten && matchesStatus && matchesSearch;
            });

            currentKabupatenPage = 1;
            renderMitraKabupatenTable();
            updateKabupatenPagination();
        }
    }

    // Reset Filter Function
    function resetFilter(type) {
        if (type === 'provinsi') {
            document.getElementById('searchProvinsi').value = '';
            document.getElementById('filterParent').value = '';
            document.getElementById('filterProvinsi').value = '';
            document.getElementById('filterKabupaten').value = '';

            filteredProvinsiData = [...provinsiData];
            currentProvinsiPage = 1;
            renderMitraProvinsiTable();
            updateProvinsiPagination();
        } else {
            document.getElementById('searchKabupaten').value = '';
            document.getElementById('filterProvinsiKabupaten').value = '';
            document.getElementById('filterKabupatenKabupaten').value = '';
            document.getElementById('filterStatusKabupaten').value = '';

            filteredKabupatenData = [...kabupatenData];
            currentKabupatenPage = 1;
            renderMitraKabupatenTable();
            updateKabupatenPagination();
        }
    }

    // Render Tables with Pagination
    function renderMitraProvinsiTable() {
        mitraProvinsiTableBody.innerHTML = '';

        const startIndex = (currentProvinsiPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredProvinsiData.length);
        const currentData = filteredProvinsiData.slice(startIndex, endIndex);

        if (currentData.length === 0) {
            mitraProvinsiTableBody.innerHTML = '<tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data provinsi</td></tr>';
            return;
        }

        currentData.forEach((mitra, index) => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${startIndex + index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${mitra.nama}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openProvinsiModal(${mitra.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                    <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="openDeleteModal('provinsi', ${mitra.id})" class="text-red-600 hover:text-red-900">
                    <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
                `;
            mitraProvinsiTableBody.appendChild(row);
        });
    }

    function renderMitraKabupatenTable() {
        mitraKabupatenTableBody.innerHTML = '';

        const startIndex = (currentKabupatenPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredKabupatenData.length);
        const currentData = filteredKabupatenData.slice(startIndex, endIndex);

        if (currentData.length === 0) {
            mitraKabupatenTableBody.innerHTML = '<tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data kabupaten</td></tr>';
            return;
        }

        currentData.forEach((mitra, index) => {
            // Lookup nama provinsi berdasarkan id_provinsi milik mitra
            const provinsi = provinsiData.find(p => p.id === mitra.id_provinsi);
            const namaProvinsi = provinsi ? provinsi.nama : '-'; // jika tidak ditemukan tampilkan "-"

            const statusClass = mitra.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';

            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${startIndex + index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${namaProvinsi}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${mitra.nama}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openKabupatenModal(${mitra.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="openDeleteModal('kabupaten', ${mitra.id})" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            mitraKabupatenTableBody.appendChild(row);
        });
    }

    function renderMitraKecamatanTable() {
        mitraKecamatanTableBody.innerHTML = '';

        const startIndex = (currentKecamatanPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredKecamatanData.length);
        const currentData = filteredKecamatanData.slice(startIndex, endIndex);

        if (currentData.length === 0) {
            mitraKecamatanTableBody.innerHTML = '<tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data kecamatan</td></tr>';
            return;
        }

        currentData.forEach((mitra, index) => {
            // Lookup kabupaten untuk kecamatan ini
            const kabupaten = kabupatenData.find(kab => kab.id === mitra.id_kabupaten);
            const namaKabupaten = kabupaten ? kabupaten.nama : '-';

            // Lookup provinsi lewat kabupaten
            const provinsi = kabupaten ? provinsiData.find(prov => prov.id === kabupaten.id_provinsi) : null;
            const namaProvinsi = provinsi ? provinsi.nama : '-';

            const statusClass = mitra.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';

            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${startIndex + index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${namaProvinsi}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${namaKabupaten}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${mitra.nama}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openKabupatenModal(${mitra.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="openDeleteModal('kecamatan', ${mitra.id})" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            mitraKecamatanTableBody.appendChild(row);
        });
    }

    function renderMitraDesaTable() {
        mitraDesaTableBody.innerHTML = '';

        const startIndex = (currentDesaPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredDesaData.length);
        const currentData = filteredDesaData.slice(startIndex, endIndex);

        if (currentData.length === 0) {
            mitraDesaTableBody.innerHTML = '<tr><td colspan="8" class="px-6 py-4 text-center">Tidak ada data desa</td></tr>';
            return;
        }

        currentData.forEach((mitra, index) => {
            // Lookup kecamatan
            const kecamatan = kecamatanData.find(kec => kec.id === mitra.id_kecamatan);
            const namaKecamatan = kecamatan ? kecamatan.nama : '-';

            // Lookup kabupaten
            const kabupaten = kecamatan ? kabupatenData.find(kab => kab.id === kecamatan.id_kabupaten) : null;
            const namaKabupaten = kabupaten ? kabupaten.nama : '-';

            // Lookup provinsi
            const provinsi = kabupaten ? provinsiData.find(prov => prov.id === kabupaten.id_provinsi) : null;
            const namaProvinsi = provinsi ? provinsi.nama : '-';

            // Status class jika ada status
            const statusClass = mitra.status === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';

            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${startIndex + index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${namaProvinsi}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${namaKabupaten}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${namaKecamatan}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${mitra.nama}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button onclick="openDesaModal(${mitra.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="openDeleteModal('desa', ${mitra.id})" class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            mitraDesaTableBody.appendChild(row);
        });
    }

    // Pagination Functions
    function updateProvinsiPagination() {
        const totalItems = filteredProvinsiData.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const startItem = (currentProvinsiPage - 1) * itemsPerPage + 1;
        const endItem = Math.min(currentProvinsiPage * itemsPerPage, totalItems);

        // Update pagination info
        document.getElementById('provinsiPaginationInfo').innerHTML = `Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of <span class="font-medium">${totalItems}</span> results`;

        // Update pagination numbers
        const paginationNumbers = document.getElementById('provinsiPaginationNumbers');
        paginationNumbers.innerHTML = '';

        // Always show first page
        addPaginationNumber('provinsi', 1);

        // Show ellipsis if needed
        if (currentProvinsiPage > 3) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
            ellipsis.textContent = '...';
            paginationNumbers.appendChild(ellipsis);
        }

        // Show current page and neighbors
        const startPage = Math.max(2, currentProvinsiPage - 1);
        const endPage = Math.min(totalPages - 1, currentProvinsiPage + 1);

        for (let i = startPage; i <= endPage; i++) {
            addPaginationNumber('provinsi', i);
        }

        // Show ellipsis if needed
        if (currentProvinsiPage < totalPages - 2) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
            ellipsis.textContent = '...';
            paginationNumbers.appendChild(ellipsis);
        }

        // Always show last page if there's more than one page
        if (totalPages > 1) {
            addPaginationNumber('provinsi', totalPages);
        }
    }

    function updateKabupatenPagination() {
        const totalItems = filteredKabupatenData.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const startItem = (currentKabupatenPage - 1) * itemsPerPage + 1;
        const endItem = Math.min(currentKabupatenPage * itemsPerPage, totalItems);

        // Update pagination info
        document.getElementById('kabupatenPaginationInfo').innerHTML = `Showing <span class="font-medium">${startItem}</span> to <span class="font-medium">${endItem}</span> of <span class="font-medium">${totalItems}</span> results`;

        // Update pagination numbers
        const paginationNumbers = document.getElementById('kabupatenPaginationNumbers');
        paginationNumbers.innerHTML = '';

        // Always show first page
        addPaginationNumber('kabupaten', 1);

        // Show ellipsis if needed
        if (currentKabupatenPage > 3) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
            ellipsis.textContent = '...';
            paginationNumbers.appendChild(ellipsis);
        }

        // Show current page and neighbors
        const startPage = Math.max(2, currentKabupatenPage - 1);
        const endPage = Math.min(totalPages - 1, currentKabupatenPage + 1);

        for (let i = startPage; i <= endPage; i++) {
            addPaginationNumber('kabupaten', i);
        }

        // Show ellipsis if needed
        if (currentKabupatenPage < totalPages - 2) {
            const ellipsis = document.createElement('span');
            ellipsis.className = 'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700';
            ellipsis.textContent = '...';
            paginationNumbers.appendChild(ellipsis);
        }

        // Always show last page if there's more than one page
        if (totalPages > 1) {
            addPaginationNumber('kabupaten', totalPages);
        }
    }

    function addPaginationNumber(type, page) {
        const paginationNumbers = document.getElementById(`${type}PaginationNumbers`);
        const isCurrent = (type === 'provinsi' ? currentProvinsiPage : currentKabupatenPage) === page;

        const pageButton = document.createElement('button');
        pageButton.onclick = () => goToPage(type, page);
        pageButton.className = `relative inline-flex items-center px-4 py-2 border text-sm font-medium ${ isCurrent ? 'z-10 bg-[#f0ab00] border-[#f0ab00] text-white'  : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'}`;
        pageButton.textContent = page;

        paginationNumbers.appendChild(pageButton);
    }

    function goToPage(type, page) {
        if (type === 'provinsi') {
            currentProvinsiPage = page;
            renderMitraProvinsiTable();
            updateProvinsiPagination();
        } else {
            currentKabupatenPage = page;
            renderMitraKabupatenTable();
            updateKabupatenPagination();
        }
    }

    function previousPage(type) {
        if (type === 'provinsi' && currentProvinsiPage > 1) {
            currentProvinsiPage--;
            renderMitraProvinsiTable();
            updateProvinsiPagination();
        } else if (type === 'kabupaten' && currentKabupatenPage > 1) {
            currentKabupatenPage--;
            renderMitraKabupatenTable();
            updateKabupatenPagination();
        }
    }

    function nextPage(type) {
        const totalPages = type === 'provinsi' ?
            Math.ceil(filteredProvinsiData.length / itemsPerPage) :
            Math.ceil(filteredKabupatenData.length / itemsPerPage);

        if (type === 'provinsi' && currentProvinsiPage < totalPages) {
            currentProvinsiPage++;
            renderMitraProvinsiTable();
            updateProvinsiPagination();
        } else if (type === 'kabupaten' && currentKabupatenPage < totalPages) {
            currentKabupatenPage++;
            renderMitraKabupatenTable();
            updateKabupatenPagination();
        }
    }

    // Provinsi Modal Functions
    function openProvinsiModal(id = null) {
        if (id) {
            const mitra = mitraProvinsiData.find(m => m.id === id);
            if (mitra) {
                document.getElementById('provinsiModalTitle').textContent = 'Edit Data Provinsi';
                document.getElementById('provinsiId').value = mitra.id;
                document.getElementById('provinsiName').value = mitra.name;
                document.getElementById('provinsiLocation').value = mitra.location;
                document.getElementById('provinsiParentCompany').value = mitra.parent_company;
                document.getElementById('provinsiCapacity').value = mitra.kapasitas;
            }
        } else {
            document.getElementById('provinsiModalTitle').textContent = 'Tambah Provinsi Baru';
            document.getElementById('provinsiForm').reset();
            document.getElementById('provinsiId').value = '';
        }

        document.getElementById('provinsiModal').classList.remove('hidden');
    }

    function closeProvinsiModal() {
        document.getElementById('provinsiModal').classList.add('hidden');
    }

    function saveProvinsi() {
        const id = document.getElementById('provinsiId').value;
        const data = {
            name: document.getElementById('provinsiName').value,
            location: document.getElementById('provinsiLocation').value,
            parent_company: document.getElementById('provinsiParentCompany').value,
            kapasitas: parseFloat(document.getElementById('provinsiCapacity').value),
            status: 'Aktif'
        };

        // Validation
        if (!data.name || !data.location || !data.parent_company || !data.kapasitas) {
            alert('Harap isi semua field yang wajib!');
            return;
        }

        if (id) {
            // Update existing provinsi
            const index = mitraProvinsiData.findIndex(m => m.id == id);
            if (index !== -1) {
                mitraProvinsiData[index] = {
                    ...provinsiData[index],
                    ...data
                };
            }
        } else {
            // Add new provinsi
            const newId = mitraProvinsiData.length > 0 ? Math.max(...provinsiData.map(m => m.id)) + 1 : 1;
            mitraProvinsiData.push({
                id: newId,
                ...data
            });
        }

        filteredProvinsiData = [...provinsiData];
        currentProvinsiPage = 1;
        renderMitraProvinsiTable();
        updateProvinsiPagination();
        closeProvinsiModal();
    }

    // Kabupaten Modal Functions
    function openKabupatenModal(id = null) {
        if (id) {
            const mitra = mitraKabupatenData.find(m => m.id === id);
            if (mitra) {
                document.getElementById('kabupatenModalTitle').textContent = 'Edit Data Kabupaten';
                document.getElementById('kabupatenId').value = mitra.id;
                document.getElementById('kabupatenCode').value = mitra.kode;
                document.getElementById('kabupatenName').value = mitra.name;
                document.getElementById('kabupatenLocation').value = mitra.location;
                document.getElementById('kabupatenArea').value = mitra.area_wilayah;
                document.getElementById('kabupatenStatus').value = mitra.status;
            }
        } else {
            document.getElementById('kabupatenModalTitle').textContent = 'Tambah Kabupaten Baru';
            document.getElementById('kabupatenForm').reset();
            document.getElementById('kabupatenId').value = '';
        }

        document.getElementById('kabupatenModal').classList.remove('hidden');
    }

    function closeKabupatenModal() {
        document.getElementById('kabupatenModal').classList.add('hidden');
    }

    function saveKabupaten() {
        const id = document.getElementById('kabupatenId').value;
        const data = {
            kode: document.getElementById('kabupatenCode').value,
            name: document.getElementById('kabupatenName').value,
            location: document.getElementById('kabupatenLocation').value,
            area_wilayah: document.getElementById('kabupatenArea').value,
            status: document.getElementById('kabupatenStatus').value
        };

        // Validation
        if (!data.kode || !data.name || !data.location || !data.area_wilayah) {
            alert('Harap isi semua field yang wajib!');
            return;
        }

        if (id) {
            // Update existing kabupaten
            const index = mitraKabupatenData.findIndex(m => m.id == id);
            if (index !== -1) {
                mitraKabupatenData[index] = {
                    ...kabupatenData[index],
                    ...data
                };
            }
        } else {
            // Add new kabupaten
            const newId = mitraKabupatenData.length > 0 ? Math.max(...kabupatenData.map(m => m.id)) + 1 : 1;
            mitraKabupatenData.push({
                id: newId,
                ...data
            });
        }

        filteredKabupatenData = [...kabupatenData];
        currentKabupatenPage = 1;
        renderMitraKabupatenTable();
        updateKabupatenPagination();
        closeKabupatenModal();
    }

    function openKecamatanModal(id = null) {
        if (id) {
            const mitra = kecamatanData.find(m => m.id === id);
            if (mitra) {
                // document.getElementById('kabupatenModalTitle').textContent = 'Edit Data Kecamatan';
                // document.getElementById('kabupatenId').value = mitra.id;
                // document.getElementById('kabupatenCode').value = mitra.kode;
                // document.getElementById('kabupatenName').value = mitra.name;
                // document.getElementById('kabupatenLocation').value = mitra.location;
                // document.getElementById('kabupatenArea').value = mitra.area_wilayah;
                // document.getElementById('kabupatenStatus').value = mitra.status;
            }
        } else {
            document.getElementById('kabupatenModalTitle').textContent = 'Tambah Kecamatan Baru';
            document.getElementById('kabupatenForm').reset();
            document.getElementById('kabupatenId').value = '';
        }

        document.getElementById('kecamatanModal').classList.remove('hidden');
    }

    function closeKecamatanModal() {
        document.getElementById('kecamatanModal').classList.add('hidden');
    }

    function openDesaModal(id = null) {
        if (id) {
            const mitra = desaData.find(m => m.id === id);
            if (mitra) {
                // document.getElementById('kabupatenModalTitle').textContent = 'Edit Data Kecamatan';
                // document.getElementById('kabupatenId').value = mitra.id;
                // document.getElementById('kabupatenCode').value = mitra.kode;
                // document.getElementById('kabupatenName').value = mitra.name;
                // document.getElementById('kabupatenLocation').value = mitra.location;
                // document.getElementById('kabupatenArea').value = mitra.area_wilayah;
                // document.getElementById('kabupatenStatus').value = mitra.status;
            }
        } else {
            document.getElementById('kabupatenModalTitle').textContent = 'Tambah Kecamatan Baru';
            document.getElementById('kabupatenForm').reset();
            document.getElementById('kabupatenId').value = '';
        }

        document.getElementById('desaModal').classList.remove('hidden');
    }

    function closeDesaModal() {
        document.getElementById('desaModal').classList.add('hidden');
    }

    // Delete Functions
    function openDeleteModal(type, id) {
        currentMitraType = type;
        currentMitraId = id;

        let mitra;
        if (type === 'provinsi') {
            mitra = mitraProvinsiData.find(m => m.id === id);
        } else {
            mitra = mitraKabupatenData.find(m => m.id === id);
        }

        if (mitra) {
            document.getElementById('deleteMitraMessage').textContent = `Apakah Anda yakin ingin menghapus mitra ${mitra.name}?`;
            document.getElementById('deleteMitraModal').classList.remove('hidden');
        }
    }

    function closeDeleteMitraModal() {
        document.getElementById('deleteMitraModal').classList.add('hidden');
        currentMitraId = null;
        currentMitraType = null;
    }

    function confirmDeleteMitra() {
        if (currentMitraId && currentMitraType) {
            if (currentMitraType === 'provinsi') {
                mitraProvinsiData = mitraProvinsiData.filter(m => m.id !== currentMitraId);
                filteredProvinsiData = filteredProvinsiData.filter(m => m.id !== currentMitraId);
            } else {
                mitraKabupatenData = mitraKabupatenData.filter(m => m.id !== currentMitraId);
                filteredKabupatenData = filteredKabupatenData.filter(m => m.id !== currentMitraId);
            }

            if (currentMitraType === 'provinsi') {
                // Reset to first page if no items left on current page
                const startIndex = (currentProvinsiPage - 1) * itemsPerPage;
                if (startIndex >= filteredProvinsiData.length && currentProvinsiPage > 1) {
                    currentProvinsiPage = Math.max(1, currentProvinsiPage - 1);
                }
                renderMitraProvinsiTable();
                updateProvinsiPagination();
            } else {
                // Reset to first page if no items left on current page
                const startIndex = (currentKabupatenPage - 1) * itemsPerPage;
                if (startIndex >= filteredKabupatenData.length && currentKabupatenPage > 1) {
                    currentKabupatenPage = Math.max(1, currentKabupatenPage - 1);
                }
                renderMitraKabupatenTable();
                updateKabupatenPagination();
            }

            closeDeleteMitraModal();
        }
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            if (document.getElementById('provinsiModal').classList.contains('hidden') === false) {
                closeProvinsiModal();
            }
            if (document.getElementById('kabupatenModal').classList.contains('hidden') === false) {
                closeKabupatenModal();
            }
            if (document.getElementById('deleteMitraModal').classList.contains('hidden') === false) {
                closeDeleteMitraModal();
            }
        }
    }

    // Initialize the app when DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeApp);
    } else {
        initializeApp();
    }
</script>

<?php include 'footer.php'; ?>