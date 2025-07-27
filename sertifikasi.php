<?php
// Simulasi data dummy untuk modul Audit dan Sertifikasi

// Data master sertifikasi (cert_entity)
$dummyCertEntities = [
    ['cert_entity_id' => 1, 'name' => 'RSPO', 'order' => 1],
    ['cert_entity_id' => 2, 'name' => 'ISPO', 'order' => 2],
    ['cert_entity_id' => 3, 'name' => 'MSPO', 'order' => 3],
    ['cert_entity_id' => 4, 'name' => 'ISCC', 'order' => 4],
];

// Data master criteria
$dummyCriteria = [
    ['criteria_id' => 1, 'entity_id' => 1, 'code' => 'C1', 'name' => 'Manajemen Perkebunan Berkelanjutan', 'order' => 1],
    ['criteria_id' => 2, 'entity_id' => 1, 'code' => 'C2', 'name' => 'Kepatuhan terhadap Hukum', 'order' => 2],
    ['criteria_id' => 3, 'entity_id' => 1, 'code' => 'C3', 'name' => 'Konservasi Sumber Daya Alam', 'order' => 3],
    ['criteria_id' => 4, 'entity_id' => 2, 'code' => 'C1', 'name' => 'Legalitas Lahan', 'order' => 1],
];

// Data master indicator
$dummyIndicators = [
    ['indicator_id' => 1, 'criteria_id' => 1, 'code' => 'C1.1', 'name' => 'Kebijakan dan Komitmen', 'order' => 1],
    ['indicator_id' => 2, 'criteria_id' => 1, 'code' => 'C1.2', 'name' => 'Perencanaan dan Implementasi', 'order' => 2],
    ['indicator_id' => 3, 'criteria_id' => 2, 'code' => 'C2.1', 'name' => 'Kepemilikan Lahan', 'order' => 1],
    ['indicator_id' => 4, 'criteria_id' => 3, 'code' => 'C3.1', 'name' => 'Konservasi Keanekaragaman Hayati', 'order' => 1],
];

// Data master checklist
$dummyChecklists = [
    ['checklist_id' => 1, 'indicator_id' => 1, 'name' => 'Ada dokumen kebijakan keberlanjutan', 'order' => 1],
    ['checklist_id' => 2, 'indicator_id' => 1, 'name' => 'Ada bukti sosialisasi kebijakan', 'order' => 2],
    ['checklist_id' => 3, 'indicator_id' => 2, 'name' => 'Ada dokumen rencana implementasi', 'order' => 1],
    ['checklist_id' => 4, 'indicator_id' => 3, 'name' => 'Ada sertifikat kepemilikan lahan', 'order' => 1],
];

// Data petani (farmer)
$dummyFarmers = [
    ['farmer_id' => 'KMJ.14.08.06.2006.0001', 'name' => 'Budi Santoso'],
    ['farmer_id' => 'KMJ.14.08.06.2006.0002', 'name' => 'Siti Rahayu'],
    ['farmer_id' => 'ICS-01', 'name' => 'Kelompok Tani Makmur'],
    ['farmer_id' => 'ICS-02', 'name' => 'Kelompok Tani Sejahtera'],
];

// Data auditor
$dummyAuditors = [
    ['auditor_id' => 'AUD-001', 'name' => 'Tim ICS Internal', 'type' => 'internal'],
    ['auditor_id' => 'AUD-002', 'name' => 'Dr. Agus Setiawan', 'type' => 'external'],
    ['auditor_id' => 'AUD-003', 'name' => 'PT Sucofindo', 'type' => 'external'],
];

// Data audit internal
$dummyInternalAudits = [
    [
        'audit_id' => 'AI-001',
        'farmer_id' => 'KMJ.14.08.06.2006.0001',
        'audit_date' => '2025-07-25',
        'auditor_id' => 'AUD-001',
        'status' => 'lolos',
        'notes' => 'Sudah memenuhi semua kriteria dasar',
        'checklist_results' => [
            ['checklist_id' => 1, 'result' => true, 'score' => 100, 'comment' => 'Dokumen lengkap'],
            ['checklist_id' => 2, 'result' => true, 'score' => 90, 'comment' => 'Ada bukti sosialisasi'],
            ['checklist_id' => 3, 'result' => true, 'score' => 95, 'comment' => 'Rencana implementasi jelas'],
        ]
    ],
    [
        'audit_id' => 'AI-002',
        'farmer_id' => 'ICS-01',
        'audit_date' => '2025-07-28',
        'auditor_id' => 'AUD-001',
        'status' => 'belum_lolos',
        'notes' => 'Perlu perbaikan dokumen kebijakan',
        'checklist_results' => [
            ['checklist_id' => 1, 'result' => false, 'score' => 50, 'comment' => 'Dokumen tidak lengkap'],
            ['checklist_id' => 2, 'result' => false, 'score' => 30, 'comment' => 'Tidak ada bukti sosialisasi'],
        ]
    ],
];

// Data sertifikasi/audit eksternal
$dummyCertifications = [
    [
        'certification_id' => 'RSPO-001',
        'farmer_id' => 'KMJ.14.08.06.2006.0001',
        'cert_entity_id' => 1,
        'audit_date' => '2025-08-15',
        'auditor_id' => 'AUD-002',
        'status' => 'lulus',
        'certificate_file' => 'rspo_001_2025.pdf',
        'notes' => 'Lulus dengan beberapa catatan minor',
        'checklist_results' => [
            ['checklist_id' => 1, 'result' => true, 'score' => 95, 'comment' => 'Dokumen lengkap'],
            ['checklist_id' => 2, 'result' => true, 'score' => 85, 'comment' => 'Bukti sosialisasi cukup'],
            ['checklist_id' => 4, 'result' => true, 'score' => 100, 'comment' => 'Sertifikat lahan valid'],
        ]
    ],
];

// Simulasi action
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$submodule = isset($_GET['submodule']) ? $_GET['submodule'] : 'internal-audit';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Pagination configuration
$perPage = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage);

// Filter variables
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$statusFilter = isset($_GET['status_filter']) ? $_GET['status_filter'] : '';
$farmerFilter = isset($_GET['farmer_filter']) ? $_GET['farmer_filter'] : '';

// Data yang akan ditampilkan
$currentData = [];
$totalItems = 0;

switch ($submodule) {
    case 'internal-audit':
        $currentData = $dummyInternalAudits;
        $totalItems = count($currentData);
        break;
    case 'external-audit':
        $currentData = $dummyCertifications;
        $totalItems = count($currentData);
        break;
    case 'cert-entity':
        $currentData = $dummyCertEntities;
        $totalItems = count($currentData);
        break;
    case 'criteria':
        $currentData = $dummyCriteria;
        $totalItems = count($currentData);
        break;
    case 'indicator':
        $currentData = $dummyIndicators;
        $totalItems = count($currentData);
        break;
    case 'checklist':
        $currentData = $dummyChecklists;
        $totalItems = count($currentData);
        break;
}

// Apply filters if needed
if ($searchTerm !== '') {
    $currentData = array_filter($currentData, function($item) use ($searchTerm) {
        return stripos($item['audit_id'] ?? $item['certification_id'] ?? $item['name'] ?? '', $searchTerm) !== false;
    });
    $totalItems = count($currentData);
}

if ($statusFilter !== '' && ($submodule === 'internal-audit' || $submodule === 'external-audit')) {
    $currentData = array_filter($currentData, function($item) use ($statusFilter) {
        return $item['status'] === $statusFilter;
    });
    $totalItems = count($currentData);
}

if ($farmerFilter !== '' && ($submodule === 'internal-audit' || $submodule === 'external-audit')) {
    $currentData = array_filter($currentData, function($item) use ($farmerFilter) {
        return $item['farmer_id'] === $farmerFilter;
    });
    $totalItems = count($currentData);
}

// Pagination logic
$totalPages = ceil($totalItems / $perPage);
$currentPage = min($currentPage, $totalPages);
$offset = ($currentPage - 1) * $perPage;
$currentPageData = array_slice($currentData, $offset, $perPage);

// Data untuk form edit/detail
$selectedItem = null;
if ($id !== '' && $action !== 'list') {
    foreach ($currentData as $item) {
        if (($item['audit_id'] ?? $item['certification_id'] ?? $item['cert_entity_id'] ?? $item['criteria_id'] ?? $item['indicator_id'] ?? $item['checklist_id'] ?? '') == $id) {
            $selectedItem = $item;
            break;
        }
    }
}

include 'header.php';
?>



<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">

<div class="">
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-bold mb-2">Manajemen Sertifikasi & Audit</h2>
        </div>
      </div>
    </div>
    <!-- Submodule Navigation -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-100">
        <nav class="flex space-x-4" aria-label="Tabs">
            <a href="?submodule=internal-audit" class="<?= $submodule === 'internal-audit' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Audit Internal
            </a>
            <a href="?submodule=external-audit" class="<?= $submodule === 'external-audit' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Audit Eksternal
            </a>
            <a href="?submodule=cert-entity" class="<?= $submodule === 'cert-entity' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Sertifikasi
            </a>
            <a href="?submodule=criteria" class="<?= $submodule === 'criteria' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Kriteria
            </a>
            <a href="?submodule=indicator" class="<?= $submodule === 'indicator' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Indikator
            </a>
            <a href="?submodule=checklist" class="<?= $submodule === 'checklist' ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' ?> px-3 py-2 font-medium text-sm rounded-md">
                Checklist
            </a>
        </nav>
    </div>

    

    <!-- Content based on submodule -->
    <?php if ($action === 'list'): ?>
        <!-- List View -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    <?php 
                    switch($submodule) {
                        case 'internal-audit': echo 'Daftar Audit Internal'; break;
                        case 'external-audit': echo 'Daftar Audit Eksternal'; break;
                        case 'cert-entity': echo 'Daftar Jenis Sertifikasi'; break;
                        case 'criteria': echo 'Daftar Kriteria'; break;
                        case 'indicator': echo 'Daftar Indikator'; break;
                        case 'checklist': echo 'Daftar Checklist'; break;
                    }
                    ?>
                </h2>
                <a href="?action=add&submodule=<?= $submodule ?>" class="px-4 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#d69500] focus:outline-none focus:ring-2 focus:ring-[#F0AB00] flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah
                </a>
            </div>

            <!-- Filter Section -->
            <div class="p-4 bg-gray-50 border-b">
                <form method="get" class="flex flex-col gap-4">
                    <input type="hidden" name="action" value="list">
                    <input type="hidden" name="submodule" value="<?= $submodule ?>">

                    <!-- Global Search -->
                    <div class="flex-1">
                        <input type="text" name="search" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Cari <?php 
                                switch($submodule) {
                                    case 'internal-audit': echo 'ID Audit/Petani'; break;
                                    case 'external-audit': echo 'ID Sertifikasi/Petani'; break;
                                    case 'cert-entity': echo 'Nama Sertifikasi'; break;
                                    case 'criteria': echo 'Kriteria'; break;
                                    case 'indicator': echo 'Indikator'; break;
                                    case 'checklist': echo 'Checklist'; break;
                                }
                            ?>..."
                            value="<?= htmlspecialchars($searchTerm) ?>">
                    </div>

                    <!-- Additional Filters -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <?php if ($submodule === 'internal-audit' || $submodule === 'external-audit'): ?>
                            <div>
                                <select name="status_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="lolos" <?= $statusFilter === 'lolos' ? 'selected' : '' ?>>Lolos</option>
                                    <option value="belum_lolos" <?= $statusFilter === 'belum_lolos' ? 'selected' : '' ?>>Belum Lolos</option>
                                    <?php if ($submodule === 'external-audit'): ?>
                                        <option value="lulus" <?= $statusFilter === 'lulus' ? 'selected' : '' ?>>Lulus</option>
                                        <option value="tidak_lulus" <?= $statusFilter === 'tidak_lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div>
                                <select name="farmer_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Petani</option>
                                    <?php foreach ($dummyFarmers as $farmer): ?>
                                        <option value="<?= $farmer['farmer_id'] ?>" <?= $farmerFilter === $farmer['farmer_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($farmer['name']) ?> (<?= htmlspecialchars($farmer['farmer_id']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php elseif ($submodule === 'indicator'): ?>
                            <div>
                                <select name="criteria_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Kriteria</option>
                                    <?php foreach ($dummyCriteria as $criteria): ?>
                                        <option value="<?= $criteria['criteria_id'] ?>">
                                            <?= htmlspecialchars($criteria['code']) ?> - <?= htmlspecialchars($criteria['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php elseif ($submodule === 'checklist'): ?>
                            <div>
                                <select name="indicator_filter" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Semua Indikator</option>
                                    <?php foreach ($dummyIndicators as $indicator): ?>
                                        <option value="<?= $indicator['indicator_id'] ?>">
                                            <?= htmlspecialchars($indicator['code']) ?> - <?= htmlspecialchars($indicator['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>
                        <div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <?php if ($submodule === 'internal-audit'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Audit</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Audit</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Auditor</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'external-audit'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Sertifikasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petani</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'cert-entity'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Sertifikasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'criteria'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sertifikasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kriteria</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'indicator'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kriteria</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Indikator</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php elseif ($submodule === 'checklist'): ?>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Indikator</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checklist</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($currentPageData)): ?>
                            <tr>
                                <td colspan="<?= $submodule === 'internal-audit' || $submodule === 'external-audit' ? 6 : ($submodule === 'cert-entity' ? 4 : ($submodule === 'checklist' ? 5 : 6)) ?>" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data ditemukan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($currentPageData as $item): ?>
                                <tr>
                                    <?php if ($submodule === 'internal-audit'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['audit_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $farmerName = '';
                                                foreach ($dummyFarmers as $farmer) {
                                                    if ($farmer['farmer_id'] === $item['farmer_id']) {
                                                        $farmerName = $farmer['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($farmerName) . ' (' . htmlspecialchars($item['farmer_id']) . ')';
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['audit_date']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $item['status'] === 'lolos' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $item['status'] === 'lolos' ? 'Lolos' : 'Belum Lolos' ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $auditorName = '';
                                                foreach ($dummyAuditors as $auditor) {
                                                    if ($auditor['auditor_id'] === $item['auditor_id']) {
                                                        $auditorName = $auditor['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($auditorName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=detail&submodule=internal-audit&id=<?= urlencode($item['audit_id']) ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?action=edit&submodule=internal-audit&id=<?= urlencode($item['audit_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'external-audit'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['certification_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $farmerName = '';
                                                foreach ($dummyFarmers as $farmer) {
                                                    if ($farmer['farmer_id'] === $item['farmer_id']) {
                                                        $farmerName = $farmer['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($farmerName) . ' (' . htmlspecialchars($item['farmer_id']) . ')';
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['audit_date']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $certName = '';
                                                foreach ($dummyCertEntities as $cert) {
                                                    if ($cert['cert_entity_id'] === $item['cert_entity_id']) {
                                                        $certName = $cert['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($certName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $item['status'] === 'lulus' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $item['status'] === 'lulus' ? 'Lulus' : 'Tidak Lulus' ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=detail&submodule=external-audit&id=<?= urlencode($item['certification_id']) ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="?action=edit&submodule=external-audit&id=<?= urlencode($item['certification_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'cert-entity'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['cert_entity_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=cert-entity&id=<?= urlencode($item['cert_entity_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'criteria'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['criteria_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $certName = '';
                                                foreach ($dummyCertEntities as $cert) {
                                                    if ($cert['cert_entity_id'] === $item['entity_id']) {
                                                        $certName = $cert['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($certName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['code']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=criteria&id=<?= urlencode($item['criteria_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'indicator'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['indicator_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $criteriaName = '';
                                                foreach ($dummyCriteria as $criteria) {
                                                    if ($criteria['criteria_id'] === $item['criteria_id']) {
                                                        $criteriaName = $criteria['code'] . ' - ' . $criteria['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($criteriaName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['code']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=indicator&id=<?= urlencode($item['indicator_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php elseif ($submodule === 'checklist'): ?>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['checklist_id']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php 
                                                $indicatorName = '';
                                                foreach ($dummyIndicators as $indicator) {
                                                    if ($indicator['indicator_id'] === $item['indicator_id']) {
                                                        $indicatorName = $indicator['code'] . ' - ' . $indicator['name'];
                                                        break;
                                                    }
                                                }
                                                echo htmlspecialchars($indicatorName);
                                            ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($item['name']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($item['order']) ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="?action=edit&submodule=checklist&id=<?= urlencode($item['checklist_id']) ?>" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
                <div class="flex-1 flex justify-between sm:hidden">
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                        Sebelumnya
                    </a>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                        Selanjutnya
                    </a>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium"><?= $offset + 1 ?></span>
                            sampai
                            <span class="font-medium"><?= min($offset + $perPage, $totalItems) ?></span>
                            dari
                            <span class="font-medium"><?= $totalItems ?></span>
                            data
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => max(1, $currentPage - 1)])) ?>"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                <span class="sr-only">Sebelumnya</span>
                                <i class="fas fa-chevron-left"></i>
                            </a>

                            <?php
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);

                            if ($startPage > 1) {
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>';
                                if ($startPage > 2) {
                                    echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                }
                            }

                            for ($i = $startPage; $i <= $endPage; $i++) {
                                $activeClass = ($i == $currentPage) ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50';
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium ' . $activeClass . '">' . $i . '</a>';
                            }

                            if ($endPage < $totalPages) {
                                if ($endPage < $totalPages - 1) {
                                    echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>';
                                }
                                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">' . $totalPages . '</a>';
                            }
                            ?>

                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => min($totalPages, $currentPage + 1)])) ?>"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                <span class="sr-only">Selanjutnya</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($action === 'add' || $action === 'edit'): ?>
        <!-- Form Add/Edit -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    <?= $action === 'add' ? 'Tambah' : 'Edit' ?> 
                    <?php 
                    switch($submodule) {
                        case 'internal-audit': echo 'Audit Internal'; break;
                        case 'external-audit': echo 'Audit Eksternal'; break;
                        case 'cert-entity': echo 'Jenis Sertifikasi'; break;
                        case 'criteria': echo 'Kriteria'; break;
                        case 'indicator': echo 'Indikator'; break;
                        case 'checklist': echo 'Checklist'; break;
                    }
                    ?>
                </h2>
                <a href="?action=list&submodule=<?= $submodule ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </a>
            </div>

            <form>
                <?php if ($submodule === 'internal-audit'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="farmer_id" class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
                                <select id="farmer_id" name="farmer_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Petani</option>
                                    <?php foreach ($dummyFarmers as $farmer): ?>
                                        <option value="<?= $farmer['farmer_id'] ?>" <?= ($selectedItem && $selectedItem['farmer_id'] === $farmer['farmer_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($farmer['name']) ?> (<?= htmlspecialchars($farmer['farmer_id']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="audit_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Audit</label>
                                <input type="date" id="audit_date" name="audit_date" value="<?= $selectedItem ? htmlspecialchars($selectedItem['audit_date']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="auditor_id" class="block text-sm font-medium text-gray-700 mb-1">Auditor Internal</label>
                                <select id="auditor_id" name="auditor_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Auditor</option>
                                    <?php foreach ($dummyAuditors as $auditor): ?>
                                        <?php if ($auditor['type'] === 'internal'): ?>
                                            <option value="<?= $auditor['auditor_id'] ?>" <?= ($selectedItem && $selectedItem['auditor_id'] === $auditor['auditor_id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($auditor['name']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="lolos" <?= ($selectedItem && $selectedItem['status'] === 'lolos') ? 'selected' : '' ?>>Lolos</option>
                                    <option value="belum_lolos" <?= ($selectedItem && $selectedItem['status'] === 'belum_lolos') ? 'selected' : '' ?>>Belum Lolos</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Checklist Audit</label>
                                <div class="space-y-2 max-h-60 overflow-y-auto p-2 border rounded-md">
                                    <?php foreach ($dummyChecklists as $checklist): ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="checklist_<?= $checklist['checklist_id'] ?>" name="checklist[]" value="<?= $checklist['checklist_id'] ?>"
                                                <?= ($selectedItem && in_array($checklist['checklist_id'], array_column($selectedItem['checklist_results'], 'checklist_id'))) ? 'checked' : '' ?>
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="checklist_<?= $checklist['checklist_id'] ?>" class="ml-2 block text-sm text-gray-700">
                                                <?= htmlspecialchars($checklist['name']) ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan/Rekomendasi</label>
                                <textarea id="notes" name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"><?= $selectedItem ? htmlspecialchars($selectedItem['notes']) : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php elseif ($submodule === 'external-audit'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="farmer_id" class="block text-sm font-medium text-gray-700 mb-1">Petani</label>
                                <select id="farmer_id" name="farmer_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Petani</option>
                                    <?php foreach ($dummyFarmers as $farmer): ?>
                                        <option value="<?= $farmer['farmer_id'] ?>" <?= ($selectedItem && $selectedItem['farmer_id'] === $farmer['farmer_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($farmer['name']) ?> (<?= htmlspecialchars($farmer['farmer_id']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="cert_entity_id" class="block text-sm font-medium text-gray-700 mb-1">Jenis Sertifikasi</label>
                                <select id="cert_entity_id" name="cert_entity_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Sertifikasi</option>
                                    <?php foreach ($dummyCertEntities as $cert): ?>
                                        <option value="<?= $cert['cert_entity_id'] ?>" <?= ($selectedItem && $selectedItem['cert_entity_id'] === $cert['cert_entity_id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cert['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="audit_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Audit</label>
                                <input type="date" id="audit_date" name="audit_date" value="<?= $selectedItem ? htmlspecialchars($selectedItem['audit_date']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="auditor_id" class="block text-sm font-medium text-gray-700 mb-1">Auditor Eksternal</label>
                                <select id="auditor_id" name="auditor_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="">Pilih Auditor</option>
                                    <?php foreach ($dummyAuditors as $auditor): ?>
                                        <?php if ($auditor['type'] === 'external'): ?>
                                            <option value="<?= $auditor['auditor_id'] ?>" <?= ($selectedItem && $selectedItem['auditor_id'] === $auditor['auditor_id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($auditor['name']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                    <option value="lulus" <?= ($selectedItem && $selectedItem['status'] === 'lulus') ? 'selected' : '' ?>>Lulus</option>
                                    <option value="tidak_lulus" <?= ($selectedItem && $selectedItem['status'] === 'tidak_lulus') ? 'selected' : '' ?>>Tidak Lulus</option>
                                </select>
                            </div>
                            <div>
                                <label for="certificate_file" class="block text-sm font-medium text-gray-700 mb-1">File Sertifikat (PDF)</label>
                                <input type="file" id="certificate_file" name="certificate_file" accept=".pdf" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                                <?php if ($selectedItem && $selectedItem['certificate_file']): ?>
                                    <p class="text-sm text-gray-500 mt-1">File saat ini: <?= htmlspecialchars($selectedItem['certificate_file']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                                <textarea id="notes" name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"><?= $selectedItem ? htmlspecialchars($selectedItem['notes']) : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php elseif ($submodule === 'cert-entity'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Sertifikasi</label>
                            <input type="text" id="name" name="name" value="<?= $selectedItem ? htmlspecialchars($selectedItem['name']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php elseif ($submodule === 'criteria'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="entity_id" class="block text-sm font-medium text-gray-700 mb-1">Sertifikasi</label>
                            <select id="entity_id" name="entity_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Sertifikasi</option>
                                <?php foreach ($dummyCertEntities as $cert): ?>
                                    <option value="<?= $cert['cert_entity_id'] ?>" <?= ($selectedItem && $selectedItem['entity_id'] === $cert['cert_entity_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cert['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Kriteria</label>
                            <input type="text" id="code" name="code" value="<?= $selectedItem ? htmlspecialchars($selectedItem['code']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kriteria</label>
                            <input type="text" id="name" name="name" value="<?= $selectedItem ? htmlspecialchars($selectedItem['name']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php elseif ($submodule === 'indicator'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="criteria_id" class="block text-sm font-medium text-gray-700 mb-1">Kriteria</label>
                            <select id="criteria_id" name="criteria_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Kriteria</option>
                                <?php foreach ($dummyCriteria as $criteria): ?>
                                    <option value="<?= $criteria['criteria_id'] ?>" <?= ($selectedItem && $selectedItem['criteria_id'] === $criteria['criteria_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($criteria['code']) ?> - <?= htmlspecialchars($criteria['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Indikator</label>
                            <input type="text" id="code" name="code" value="<?= $selectedItem ? htmlspecialchars($selectedItem['code']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Indikator</label>
                            <input type="text" id="name" name="name" value="<?= $selectedItem ? htmlspecialchars($selectedItem['name']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php elseif ($submodule === 'checklist'): ?>
                    <div class="space-y-4">
                        <div>
                            <label for="indicator_id" class="block text-sm font-medium text-gray-700 mb-1">Indikator</label>
                            <select id="indicator_id" name="indicator_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                                <option value="">Pilih Indikator</option>
                                <?php foreach ($dummyIndicators as $indicator): ?>
                                    <option value="<?= $indicator['indicator_id'] ?>" <?= ($selectedItem && $selectedItem['indicator_id'] === $indicator['indicator_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($indicator['code']) ?> - <?= htmlspecialchars($indicator['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Checklist</label>
                            <input type="text" id="name" name="name" value="<?= $selectedItem ? htmlspecialchars($selectedItem['name']) : '' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                            <input type="number" id="order" name="order" min="1" value="<?= $selectedItem ? htmlspecialchars($selectedItem['order']) : '1' ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200">
                    <a href="?action=list&submodule=<?= $submodule ?>" class="px-5 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2 bg-[#F0AB00] text-white rounded-md hover:bg-[#d69500] focus:outline-none focus:ring-2 focus:ring-[#F0AB00]">
                        <?= $action === 'add' ? 'Simpan' : 'Update' ?>
                    </button>
                </div>
            </form>
        </div>
    <?php elseif ($action === 'detail'): ?>
        <!-- Detail View -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">
                    Detail 
                    <?php 
                    switch($submodule) {
                        case 'internal-audit': echo 'Audit Internal'; break;
                        case 'external-audit': echo 'Audit Eksternal'; break;
                        case 'cert-entity': echo 'Jenis Sertifikasi'; break;
                        case 'criteria': echo 'Kriteria'; break;
                        case 'indicator': echo 'Indikator'; break;
                        case 'checklist': echo 'Checklist'; break;
                    }
                    ?>
                </h2>
                <a href="?action=list&submodule=<?= $submodule ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Kembali
                </a>
            </div>

            <?php if ($selectedItem): ?>
                <?php if ($submodule === 'internal-audit'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">ID Audit</label>
                                <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['audit_id']) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Petani</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $farmerName = '';
                                        foreach ($dummyFarmers as $farmer) {
                                            if ($farmer['farmer_id'] === $selectedItem['farmer_id']) {
                                                $farmerName = $farmer['name'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($farmerName) . ' (' . htmlspecialchars($selectedItem['farmer_id']) . ')';
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Audit</label>
                                <p class="text-gray-900"><?= htmlspecialchars($selectedItem['audit_date']) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Auditor Internal</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $auditorName = '';
                                        foreach ($dummyAuditors as $auditor) {
                                            if ($auditor['auditor_id'] === $selectedItem['auditor_id']) {
                                                $auditorName = $auditor['name'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($auditorName);
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <p class="text-gray-900">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $selectedItem['status'] === 'lolos' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $selectedItem['status'] === 'lolos' ? 'Lolos' : 'Belum Lolos' ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Checklist Audit</label>
                                <div class="space-y-2 max-h-60 overflow-y-auto p-2 border rounded-md">
                                    <?php foreach ($selectedItem['checklist_results'] as $result): 
                                        $checklistName = '';
                                        foreach ($dummyChecklists as $checklist) {
                                            if ($checklist['checklist_id'] === $result['checklist_id']) {
                                                $checklistName = $checklist['name'];
                                                break;
                                            }
                                        }
                                    ?>
                                        <div class="flex items-start">
                                            <input type="checkbox" checked disabled class="h-4 w-4 text-blue-600 mt-1">
                                            <div class="ml-2">
                                                <p class="text-sm font-medium text-gray-700"><?= htmlspecialchars($checklistName) ?></p>
                                                <p class="text-xs text-gray-500">Nilai: <?= htmlspecialchars($result['score']) ?> | <?= $result['result'] ? 'Lolos' : 'Tidak Lolos' ?></p>
                                                <?php if (!empty($result['comment'])): ?>
                                                    <p class="text-xs text-gray-500 mt-1">Komentar: <?= htmlspecialchars($result['comment']) ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Catatan/Rekomendasi</label>
                                <p class="text-gray-900 whitespace-pre-line"><?= htmlspecialchars($selectedItem['notes']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php elseif ($submodule === 'external-audit'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">ID Sertifikasi</label>
                                <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['certification_id']) ?></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Petani</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $farmerName = '';
                                        foreach ($dummyFarmers as $farmer) {
                                            if ($farmer['farmer_id'] === $selectedItem['farmer_id']) {
                                                $farmerName = $farmer['name'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($farmerName) . ' (' . htmlspecialchars($selectedItem['farmer_id']) . ')';
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Sertifikasi</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $certName = '';
                                        foreach ($dummyCertEntities as $cert) {
                                            if ($cert['cert_entity_id'] === $selectedItem['cert_entity_id']) {
                                                $certName = $cert['name'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($certName);
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Audit</label>
                                <p class="text-gray-900"><?= htmlspecialchars($selectedItem['audit_date']) ?></p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Auditor Eksternal</label>
                                <p class="text-gray-900">
                                    <?php 
                                        $auditorName = '';
                                        foreach ($dummyAuditors as $auditor) {
                                            if ($auditor['auditor_id'] === $selectedItem['auditor_id']) {
                                                $auditorName = $auditor['name'];
                                                break;
                                            }
                                        }
                                        echo htmlspecialchars($auditorName);
                                    ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <p class="text-gray-900">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $selectedItem['status'] === 'lulus' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= $selectedItem['status'] === 'lulus' ? 'Lulus' : 'Tidak Lulus' ?>
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">File Sertifikat</label>
                                <p class="text-gray-900">
                                    <?php if ($selectedItem['certificate_file']): ?>
                                        <a href="#" class="text-blue-600 hover:text-blue-800 flex items-center">
                                            <i class="fas fa-file-pdf mr-2"></i> <?= htmlspecialchars($selectedItem['certificate_file']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-400">Tidak ada file</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Catatan</label>
                                <p class="text-gray-900 whitespace-pre-line"><?= htmlspecialchars($selectedItem['notes']) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Hasil Checklist Audit</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Checklist</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($selectedItem['checklist_results'] as $result): 
                                        $checklistName = '';
                                        foreach ($dummyChecklists as $checklist) {
                                            if ($checklist['checklist_id'] === $result['checklist_id']) {
                                                $checklistName = $checklist['name'];
                                                break;
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($checklistName) ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $result['result'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                    <?= $result['result'] ? 'Lolos' : 'Tidak Lolos' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($result['score']) ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($result['comment']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php elseif ($submodule === 'cert-entity'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['cert_entity_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Sertifikasi</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['name']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php elseif ($submodule === 'criteria'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['criteria_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Sertifikasi</label>
                            <p class="text-gray-900">
                                <?php 
                                    $certName = '';
                                    foreach ($dummyCertEntities as $cert) {
                                        if ($cert['cert_entity_id'] === $selectedItem['entity_id']) {
                                            $certName = $cert['name'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($certName);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Kode Kriteria</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['code']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Kriteria</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['name']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php elseif ($submodule === 'indicator'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['indicator_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Kriteria</label>
                            <p class="text-gray-900">
                                <?php 
                                    $criteriaName = '';
                                    foreach ($dummyCriteria as $criteria) {
                                        if ($criteria['criteria_id'] === $selectedItem['criteria_id']) {
                                            $criteriaName = $criteria['code'] . ' - ' . $criteria['name'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($criteriaName);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Kode Indikator</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['code']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Indikator</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['name']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php elseif ($submodule === 'checklist'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">ID</label>
                            <p class="text-gray-900 font-medium"><?= htmlspecialchars($selectedItem['checklist_id']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Indikator</label>
                            <p class="text-gray-900">
                                <?php 
                                    $indicatorName = '';
                                    foreach ($dummyIndicators as $indicator) {
                                        if ($indicator['indicator_id'] === $selectedItem['indicator_id']) {
                                            $indicatorName = $indicator['code'] . ' - ' . $indicator['name'];
                                            break;
                                        }
                                    }
                                    echo htmlspecialchars($indicatorName);
                                ?>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Checklist</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['name']) ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Urutan Tampil</label>
                            <p class="text-gray-900"><?= htmlspecialchars($selectedItem['order']) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <p class="text-gray-500">Data tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>