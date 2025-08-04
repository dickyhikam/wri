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
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
        <h3 class="text-lg font-semibold mb-4">Filter Laporan Transaksi</h3>
        <form id="filterReportForm" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Region -->
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">Region</label>
                <select id="regionFilter" class="border rounded-lg px-4 py-2 w-full">
                    <option value="">Semua Region</option>
                    <!-- Option region dari array regionData, isikan dengan JS -->
                </select>
            </div>
            <!-- ICS -->
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">ICS</label>
                <select id="icsFilter" class="border rounded-lg px-4 py-2 w-full">
                    <option value="">Semua ICS</option>
                    <!-- Option ICS dari array icsData, isikan dengan JS -->
                </select>
            </div>

            <!-- Date Range -->
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">Tanggal Mulai</label>
                <input type="date" id="startDate" class="border rounded-lg px-4 py-2 w-full">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">Tanggal Selesai</label>
                <input type="date" id="endDate" class="border rounded-lg px-4 py-2 w-full">
            </div>

            <div class="col-span-4">
                <label class="text-sm font-medium text-gray-600 mb-1 block">Pilih Kolom Yang Ditampilkan</label>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="tanggal" checked>
                        <span class="ml-2">Tanggal</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="region" checked>
                        <span class="ml-2">Region</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="ics" checked>
                        <span class="ml-2">ICS</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="jenis" checked>
                        <span class="ml-2">Jenis Transaksi</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="produksi" checked>
                        <span class="ml-2">Produksi</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="status" checked>
                        <span class="ml-2">Status</span>
                    </label>
                </div>
            </div>

            <button type="submit" id="filterBtn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-500">
                <span id="btnFilterText" style="text-align: center;">Filter</span>
                <svg id="loadingFilterSpinner" style="text-align: center;" class="hidden w-5 h-5 animate-spin ml-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                </svg>
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-lg">Daftar Transaksi</h3>
            <div class="space-x-2">
                <button onclick="exportPDF()" class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                <button onclick="exportExcel()" class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-file-excel"></i> Excel</button>
                <button onclick="window.print()" class="bg-gray-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="reportTransaksiTableBody">
            </table>
        </div>
    </div>

</section>

<script>
    // Contoh struktur data (ganti dengan data asli dari database)
    const transaksiData = [{
            tanggal: "2025-08-20",
            region: "Sumatera Utara",
            ics: "ICS A",
            jenis: "Penerimaan CPO",
            volume: 69,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-11",
            region: "Riau",
            ics: "ICS A",
            jenis: "Pengiriman CPO",
            volume: 65,
            status: "Pending"
        },
        {
            tanggal: "2025-08-04",
            region: "Riau",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 30,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-11",
            region: "Riau",
            ics: "ICS B",
            jenis: "Penerimaan CPO",
            volume: 61,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-20",
            region: "Sumatera Utara",
            ics: "ICS B",
            jenis: "Pengiriman CPO",
            volume: 91,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-14",
            region: "Sumatera Utara",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 73,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-21",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Penerimaan TBS",
            volume: 100,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-19",
            region: "Sumatera Utara",
            ics: "ICS B",
            jenis: "Penerimaan CPO",
            volume: 51,
            status: "Pending"
        },
        {
            tanggal: "2025-08-10",
            region: "Sumatera Selatan",
            ics: "ICS C",
            jenis: "Penerimaan TBS",
            volume: 35,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-01",
            region: "Riau",
            ics: "ICS B",
            jenis: "Penerimaan TBS",
            volume: 52,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-18",
            region: "Jambi",
            ics: "ICS A",
            jenis: "Penerimaan TBS",
            volume: 72,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-14",
            region: "Sumatera Selatan",
            ics: "ICS B",
            jenis: "Penerimaan CPO",
            volume: 75,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-17",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Pengiriman TBS",
            volume: 46,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-10",
            region: "Sumatera Utara",
            ics: "ICS C",
            jenis: "Penerimaan CPO",
            volume: 73,
            status: "Pending"
        },
        {
            tanggal: "2025-08-07",
            region: "Jambi",
            ics: "ICS A",
            jenis: "Penerimaan CPO",
            volume: 43,
            status: "Pending"
        },
        {
            tanggal: "2025-08-09",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Penerimaan TBS",
            volume: 33,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-30",
            region: "Sumatera Utara",
            ics: "ICS B",
            jenis: "Pengiriman CPO",
            volume: 40,
            status: "Pending"
        },
        {
            tanggal: "2025-08-19",
            region: "Riau",
            ics: "ICS A",
            jenis: "Penerimaan TBS",
            volume: 14,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-13",
            region: "Sumatera Utara",
            ics: "ICS A",
            jenis: "Pengiriman CPO",
            volume: 12,
            status: "Pending"
        },
        {
            tanggal: "2025-08-08",
            region: "Sumatera Selatan",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 85,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-25",
            region: "Riau",
            ics: "ICS A",
            jenis: "Pengiriman TBS",
            volume: 62,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-30",
            region: "Riau",
            ics: "ICS C",
            jenis: "Penerimaan CPO",
            volume: 22,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-06",
            region: "Sumatera Selatan",
            ics: "ICS B",
            jenis: "Penerimaan CPO",
            volume: 88,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-17",
            region: "Jambi",
            ics: "ICS A",
            jenis: "Penerimaan TBS",
            volume: 62,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-23",
            region: "Riau",
            ics: "ICS C",
            jenis: "Penerimaan CPO",
            volume: 96,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-20",
            region: "Jambi",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 48,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-27",
            region: "Riau",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 66,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-10",
            region: "Riau",
            ics: "ICS B",
            jenis: "Pengiriman CPO",
            volume: 28,
            status: "Pending"
        },
        {
            tanggal: "2025-08-08",
            region: "Sumatera Selatan",
            ics: "ICS A",
            jenis: "Pengiriman TBS",
            volume: 93,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-20",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Pengiriman CPO",
            volume: 92,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-26",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Pengiriman TBS",
            volume: 18,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-15",
            region: "Jambi",
            ics: "ICS C",
            jenis: "Penerimaan CPO",
            volume: 37,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-02",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Pengiriman TBS",
            volume: 98,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-08",
            region: "Jambi",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 82,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-13",
            region: "Sumatera Selatan",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 16,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-22",
            region: "Riau",
            ics: "ICS B",
            jenis: "Penerimaan TBS",
            volume: 44,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-31",
            region: "Riau",
            ics: "ICS B",
            jenis: "Pengiriman CPO",
            volume: 22,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-23",
            region: "Jambi",
            ics: "ICS B",
            jenis: "Pengiriman CPO",
            volume: 66,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-22",
            region: "Sumatera Selatan",
            ics: "ICS A",
            jenis: "Penerimaan CPO",
            volume: 29,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-11",
            region: "Sumatera Selatan",
            ics: "ICS A",
            jenis: "Penerimaan CPO",
            volume: 61,
            status: "Dibatalkan"
        },
        {
            tanggal: "2025-08-13",
            region: "Riau",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 63,
            status: "Pending"
        },
        {
            tanggal: "2025-08-17",
            region: "Sumatera Utara",
            ics: "ICS B",
            jenis: "Pengiriman TBS",
            volume: 73,
            status: "Pending"
        },
        {
            tanggal: "2025-08-17",
            region: "Sumatera Utara",
            ics: "ICS C",
            jenis: "Penerimaan CPO",
            volume: 75,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-20",
            region: "Riau",
            ics: "ICS A",
            jenis: "Penerimaan TBS",
            volume: 29,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-08",
            region: "Sumatera Utara",
            ics: "ICS A",
            jenis: "Pengiriman CPO",
            volume: 84,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-05",
            region: "Sumatera Utara",
            ics: "ICS A",
            jenis: "Penerimaan CPO",
            volume: 62,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-03",
            region: "Sumatera Selatan",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 57,
            status: "Selesai"
        },
        {
            tanggal: "2025-08-28",
            region: "Riau",
            ics: "ICS C",
            jenis: "Penerimaan CPO",
            volume: 27,
            status: "Pending"
        },
        {
            tanggal: "2025-08-23",
            region: "Sumatera Utara",
            ics: "ICS C",
            jenis: "Pengiriman CPO",
            volume: 99,
            status: "Pending"
        },
        {
            tanggal: "2025-08-02",
            region: "Riau",
            ics: "ICS A",
            jenis: "Penerimaan TBS",
            volume: 78,
            status: "Pending"
        }
    ];

    // Data Dummy Region
    const regionData = [{
            id: 1,
            nama: "Riau Tengah"
        },
        {
            id: 2,
            nama: "Riau Selatan"
        },
        {
            id: 3,
            nama: "Jambi Barat"
        },
        {
            id: 4,
            nama: "Sumatera Utara 1"
        }
    ];

    // Data Dummy ICS
    const icsData = [{
            id: "ICS_A",
            nama: "ICS A"
        },
        {
            id: "ICS_B",
            nama: "ICS B"
        },
        {
            id: "ICS_C",
            nama: "ICS C"
        }
    ];

    // Render opsi region
    const regionSelect = document.getElementById('regionFilter');
    regionData.forEach(r => {
        const opt = document.createElement('option');
        opt.value = r.nama;
        opt.textContent = r.nama;
        regionSelect.appendChild(opt);
    });

    // Render opsi ICS
    const icsSelect = document.getElementById('icsFilter');
    icsData.forEach(i => {
        const opt = document.createElement('option');
        opt.value = i.nama;
        opt.textContent = i.nama;
        icsSelect.appendChild(opt);
    });

    // Fungsi toggle kolom tabel berdasarkan checkbox
    function toggleTrainingTableColumns() {
        // dapatkan semua checkbox kolom yang ada
        const checkboxes = document.querySelectorAll('.columnCheckbox');
        checkboxes.forEach(cb => {
            const colClass = cb.getAttribute('data-column');

            // sembunyikan/tampilkan semua cell <td> dan header <th> dengan kelas sesuai
            document.querySelectorAll(`td.${colClass}`).forEach(cell => {
                cell.style.display = cb.checked ? 'table-cell' : 'none';
            });

            document.querySelectorAll(`th.${colClass}`).forEach(cell => {
                cell.style.display = cb.checked ? 'table-cell' : 'none';
            });
        });
    }

    // Tambahkan event listener setiap checkbox
    const colCheckboxes = document.querySelectorAll('.columnCheckbox');
    colCheckboxes.forEach(cb => {
        cb.addEventListener('change', toggleTrainingTableColumns);
    });

    // Panggil sekali saat halaman load untuk set kolom default
    window.addEventListener('DOMContentLoaded', toggleTrainingTableColumns);

    // Filter dan render table
    function renderReportTable(filtered) {
        const tableBody = document.getElementById('reportTransaksiTableBody');
        tableBody.innerHTML = `
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase no">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tanggal">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase region">Region</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase ics">ICS</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase jenis">Jenis Transaksi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase produksi">Produksi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase status">Status</th>
                </tr>
            </thead>
            <tbody>
        `;
        if (filtered.length === 0) {
            tableBody.innerHTML += '<tr><td colspan="7" class="px-6 py-4 text-center">Tidak ada data transaksi</td></tr></tbody>';
            return;
        }
        filtered.forEach((trx, i) => {
            tableBody.innerHTML += `
                <tr>
                    <td class="px-6 py-4 no">${i + 1}</td>
                    <td class="px-6 py-4 tanggal">${trx.tanggal}</td>
                    <td class="px-6 py-4 region">${trx.region}</td>
                    <td class="px-6 py-4 ics">${trx.ics}</td>
                    <td class="px-6 py-4 jenis">${trx.jenis}</td>
                    <td class="px-6 py-4 produksi">${trx.volume}</td>
                    <td class="px-6 py-4 status">${trx.status}</td>
                </tr>
            `;
        });
        tableBody.innerHTML += '</tbody>';
    }


    const filterReportForm = document.getElementById('filterReportForm');
    filterReportForm.onsubmit = function(e) {
        e.preventDefault();

        const btnText = document.getElementById('btnFilterText');
        const spinner = document.getElementById('loadingFilterSpinner');

        // Tampilkan spinner, sembunyikan teks tombol
        btnText.classList.add('hidden');
        spinner.classList.remove('hidden');

        // Ambil nilai filter dari form
        const region = regionSelect.value;
        const ics = icsSelect.value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        // Filter data transaksiData sesuai filter region, ics, tanggal
        const filtered = transaksiData.filter(row => {
            if (region && row.region !== region) return false;
            if (ics && row.ics !== ics) return false;

            if (startDate && row.tanggal < startDate) return false;
            if (endDate && row.tanggal > endDate) return false;

            return true;
        });

        // Simulasi proses filter/loading delay
        setTimeout(() => {
            btnText.classList.remove('hidden');
            spinner.classList.add('hidden');

            // Render tabel hasil filter
            renderReportTable(filtered);

            // Tampilkan/sembunyikan kolom sesuai checklist
            toggleTrainingTableColumns();

            // Contoh alert (ganti dengan SweetAlert jika ada)
            showSweetAlert('success', 'Berhasil', 'Filter berhasil diterapkan, data tampil di tabel.', true, '');
        }, 1500); // sesuaikan waktu loading
    };

    // Export PDF/Excel (gunakan jsPDF, XLSX, dsb)
    function exportPDF() {
        /* kode export PDF */
    }

    function exportExcel() {
        /* kode export Excel */
    }

    // ... (declare data dan fungsi di atas)

    // Render semua data di awal (belum ada filter)
    renderReportTable(transaksiData);

    // ... (kode filter onsubmit dan export)
</script>

<?php include 'footer.php'; ?>