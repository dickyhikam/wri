<?php
// data fasilitas_panen
include 'header.php';

// Simulasi data dummy
$dummyFasilitas = [
    [
        'id' => 1,
        'nama' => 'Sample GeoJSON Demo',
        'qty' => 5, // Example quantity
        'koordinat_lokasi' => [
            'latitude' => -0.7893,
            'longitude' => 113.9213
        ], // Example coordinates (latitude, longitude)
        'image' => 'https://www.infosawit.com/wp-content/uploads/2024/11/Kebun-Sawit-4.jpg',
        'description' => 'A demo image for the Sample GeoJSON data.'
    ],
    [
        'id' => 2,
        'nama' => 'Negara-negara Dunia',
        'qty' => 10, // Example quantity
        'koordinat_lokasi' => [
            'latitude' => 20.5937,
            'longitude' => 78.9629
        ], // Example coordinates for India
        'image' => 'https://dsn.co.id/wp-content/uploads/2021/02/day1DSN__100.jpg',
        'description' => 'Image representing countries of the world.'
    ],
    [
        'id' => 3,
        'nama' => 'Provinsi di Indonesia',
        'qty' => 30, // Example quantity
        'koordinat_lokasi' => [
            'latitude' => -5.6368,
            'longitude' => 105.0537
        ], // Example coordinates for Indonesia
        'image' => 'https://www.asianagri.com/wp-content/uploads/2024/04/asian-agri-nurtures-sustainability-through-investment-in-smallholders.jpg',
        'description' => 'Image related to Indonesian provinces.'
    ],
    [
        'id' => 4,
        'nama' => 'National Parks USA',
        'qty' => 7, // Example quantity
        'koordinat_lokasi' => [
            'latitude' => 38.8026,
            'longitude' => -99.5247
        ], // Example coordinates for USA
        'image' => 'https://www.infosawit.com/wp-content/uploads/2024/04/FFB_Jefri-Tarigan-3.jpg',
        'description' => 'Image representing national parks in the USA.'
    ]
];


$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Simulasi data yang dipilih
$selectedData = null;
if ($id) {
    foreach ($dummyFasilitas as $data) {
        if ($data['id'] == $id) {
            $selectedData = $data;
            break;
        }
    }
}
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    <header class="h-20 shadow-sm flex items-center justify-between px-8">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php
                if ($action == 'add') echo "Tambah Fasilitas";
                elseif ($action == 'view') echo "Detail Fasilitas: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                elseif ($action == 'edit') echo "Edit Fasilitas: " . ($selectedData ? 'TRX-' . str_pad($selectedData['id'], 4, '0', STR_PAD_LEFT) : '');
                else echo "Data Fasilitas";
                ?>
            </h1>
        </div>
        <div class="flex items-center space-x-6">
            <?php if ($action == 'list'): ?>
                <a href="fasilitas?action=add" class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Fasilitas
                </a>
            <?php elseif ($action == 'view'): ?>
                <a href="fasilitas" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <a href="fasilitas?action=edit&id=<?= $id ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <button onclick="confirmDelete('<?= $id ?>')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus
                </button>
            <?php elseif ($action == 'edit'): ?>
                <a href="fasilitas" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            <?php elseif ($action == 'add'): ?>
                <a href="fasilitas" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
        <?php if ($action == 'list'): ?>
            <!-- Daftar Fasilitas -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-4 bg-gray-50 border-b">
                    <form method="get" class="flex flex-col gap-4">
                        <input type="hidden" name="action" value="list">

                        <div class="flex-1">
                            <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari data fasilitas...">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div></div>
                            <div></div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                    <i class="fas fa-filter mr-2"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Koordinat Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($dummyFasilitas as $fasilitas): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($fasilitas['nama']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 hover:underline">
                                        <img src="<?= $fasilitas['image'] ?>" alt="" style="width: 140px; height: 100px;">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= htmlspecialchars($fasilitas['qty']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div id="map-<?= $fasilitas['id'] ?>" style="width: 220px; height: 200px;"></div>
                                        <script>
                                            var map = L.map('map-<?= $fasilitas['id'] ?>').setView([<?= $fasilitas['koordinat_lokasi']['latitude'] ?>, <?= $fasilitas['koordinat_lokasi']['longitude'] ?>], 13);

                                            // Add OSM tile layer
                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                            }).addTo(map);

                                            // Add a marker for the location
                                            L.marker([<?= $fasilitas['koordinat_lokasi']['latitude'] ?>, <?= $fasilitas['koordinat_lokasi']['longitude'] ?>]).addTo(map)
                                                .bindPopup("<b><?= htmlspecialchars($fasilitas['nama']) ?></b><br>Lat: <?= $fasilitas['koordinat_lokasi']['latitude'] ?><br>Long: <?= $fasilitas['koordinat_lokasi']['longitude'] ?>")
                                                .openPopup();
                                        </script>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="fasilitas?action=edit&id=<?= $fasilitas['id'] ?>" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('<?= $fasilitas['id'] ?>')" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Map -->
                <div id="mapModal" style="display:none; position:fixed; top:0; left:0; z-index:1000; width:100vw; height:100vh; background:rgba(0,0,0,0.3);">
                    <div style="position:absolute; top:50px; left:50%; transform:translateX(-50%); background:#fff; border-radius:8px; padding:16px; width:90vw; max-width:800px; height:70vh;">
                        <div style="display: flex; justify-content: flex-end;">
                            <button onclick="closeMapModal()" style="font-size:18px; background:none; border:none;">&times;</button>
                        </div>
                        <div id="leafletMap" style="width:100%;height:60vh; border-radius:4px"></div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">2</span> dari <span class="font-medium">2</span> data fasilitas
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    1
                                </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($action == 'add' || $action == 'edit'): ?>
            <!-- Form Tambah/Edit Fasilitas -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <form class="space-y-6" enctype="multipart/form-data" method="POST">
                        <!-- Judul Field -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                            <input
                                type="text"
                                name="nama"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                value="<?= ($action == 'edit') ? htmlspecialchars($selectedData['nama']) : '' ?>"
                                required>
                        </div>

                        <!-- Quantity Field -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Qty <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="qty"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                value="<?= ($action == 'edit') ? htmlspecialchars($selectedData['qty']) : '' ?>"
                                required
                                min="1">
                        </div>

                        <!-- Koordinat Lokasi (Latitude and Longitude) Fields -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Koordinat Lokasi (Latitude, Longitude) <span class="text-red-500">*</span></label>
                            <div class="flex space-x-4">
                                <input
                                    step="any"
                                    name="latitude"
                                    id="latitude"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    placeholder="Latitude"
                                    value="<?= ($action == 'edit') ? htmlspecialchars($selectedData['koordinat_lokasi']['latitude']) : '' ?>"
                                    readonly>
                                <input
                                    step="any"
                                    name="longitude"
                                    id="longitude"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    placeholder="Longitude"
                                    value="<?= ($action == 'edit') ? htmlspecialchars($selectedData['koordinat_lokasi']['longitude']) : '' ?>"
                                    readonly>
                            </div>
                        </div>

                        <!-- OpenStreetMap -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Lokasi pada Peta <span class="text-red-500">*</span></label>
                            <div id="map" style="height: 300px; width: 100%; border-radius: 8px;"></div>
                        </div>

                        <!-- Foto (File Upload) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto <span class="text-red-500">*</span></label>
                            <input
                                type="file"
                                name="file_upload"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                <?= ($action == 'edit') ? '' : 'required' ?>>
                            <?php if ($action == 'edit' && isset($selectedData['image'])): ?>
                                <div class="mt-2">
                                    <img src="<?= htmlspecialchars($selectedData['image']) ?>" alt="Current Image" style="width: 150px; height: 100px;">
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Keterangan (Description) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea
                                name="description"
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"><?= ($action == 'edit') ? htmlspecialchars($selectedData['description']) : '' ?></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a
                                href="<?= ($action == 'edit') ? 'fasilitas' : 'fasilitas' ?>"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="bg-[#f0ab00] hover:bg-[#e09900] text-white px-4 py-2 rounded-lg">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    // Initialize the map
    var map = L.map('map').setView([<?= ($action == 'edit') ? htmlspecialchars($selectedData['koordinat_lokasi']['latitude']) : '-6.200000' ?>, <?= ($action == 'edit') ? htmlspecialchars($selectedData['koordinat_lokasi']['longitude']) : '106.816666' ?>], 13);

    // Set the tile layer for the map (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Marker to represent the location
    var marker = L.marker([<?= ($action == 'edit') ? htmlspecialchars($selectedData['koordinat_lokasi']['latitude']) : '-6.200000' ?>, <?= ($action == 'edit') ? htmlspecialchars($selectedData['koordinat_lokasi']['longitude']) : '106.816666' ?>]).addTo(map);

    // Update the coordinates when the marker is dragged
    marker.on('dragend', function(e) {
        var lat = e.target.getLatLng().lat;
        var lng = e.target.getLatLng().lng;
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

    // Allow the user to click on the map to set the coordinates
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Move the marker to the clicked position
        marker.setLatLng([lat, lng]);

        // Update the latitude and longitude fields
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data fasilitas ini?')) {
            // Simulasi penghapusan data
            alert('Transaksi dengan ID ' + id + ' telah dihapus');
            window.location.href = 'fasilitas';
        }
    }
</script>

<?php include 'footer.php'; ?>