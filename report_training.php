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
        <h3 class="text-lg font-semibold mb-4">Filter Laporan Training</h3>
        <form id="filterTrainingForm" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-6">
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">ICS</label>
                <select id="icsFilter" class="border rounded-lg px-4 py-2 w-full">
                    <option value="">Semua ICS</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">Tipe Training</label>
                <select id="trainingTypeFilter" class="border rounded-lg px-4 py-2 w-full">
                    <option value="">Semua Training</option>
                </select>
            </div>
            <div>
                <button type="submit" id="filterBtn" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-500 w-full">
                    <span id="btnFilterText" style="text-align: center;">Filter</span>
                    <svg id="loadingFilterSpinner" style="text-align: center;" class="hidden w-5 h-5 animate-spin ml-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0H4z"></path>
                    </svg>
                </button>
            </div>
            <div class="col-span-3">
                <label class="text-sm font-medium text-gray-600 mb-1 block">Pilih Kolom Yang Ditampilkan</label>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="ics" checked>
                        <span class="ml-2">ICS</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="type" checked>
                        <span class="ml-2">Tipe Training</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="tanggal" checked>
                        <span class="ml-2">Tanggal</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="peserta" checked>
                        <span class="ml-2">Peserta</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="trainer" checked>
                        <span class="ml-2">Trainer</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="columnCheckbox" data-column="lokasi" checked>
                        <span class="ml-2">Lokasi</span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-lg">Daftar Rekap Training</h3>
            <div class="space-x-2">
                <button onclick="exportPDF()" class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                <button onclick="exportExcel()" class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-file-excel"></i> Excel</button>
                <button onclick="window.print()" class="bg-gray-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="rekapTrainingTableBody">
            </table>
        </div>
    </div>

</section>

<script>
    function applyFilter() {
        const btnText = document.getElementById('btnFilterText');
        const spinner = document.getElementById('loadingFilterSpinner');

        // Tampilkan spinner, sembunyikan teks tombol
        btnText.classList.add('hidden');
        spinner.classList.remove('hidden');

        // Simulasi proses filter (misal fetch data, reload table, dll.)
        setTimeout(() => {
            btnText.classList.remove('hidden');
            spinner.classList.add('hidden');
            showSweetAlert('success', 'Berhasil', 'Data transaksi berhasil ditampilkan ke dalam table.', true, '');
        }, 2000); // Ubah waktu sesuai kebutuhan loading asli
    }

    // Data Dummy Training
    const trainingData = [{
            tanggal: "2025-08-10",
            ics: "ICS A",
            type: "Good Agricultural Practices",
            peserta: 30,
            trainer: "Budi Supervisor",
            lokasi: "Kebun Sejahtera"
        },
        {
            tanggal: "2025-08-12",
            ics: "ICS B",
            type: "Keselamatan & Kesehatan Kerja",
            peserta: 25,
            trainer: "Siti Rahma",
            lokasi: "Mills Asri"
        },
        {
            tanggal: "2025-08-15",
            ics: "ICS A",
            type: "Sertifikasi RSPO",
            peserta: 15,
            trainer: "Anton Pratama",
            lokasi: "Site Sungai"
        },
        {
            tanggal: "2025-08-20",
            ics: "ICS C",
            type: "Good Agricultural Practices",
            peserta: 18,
            trainer: "Dewi",
            lokasi: "Kebun Subur"
        },
        {
            tanggal: "2025-08-22",
            ics: "ICS B",
            type: "Keselamatan & Kesehatan Kerja",
            peserta: 22,
            trainer: "Joko",
            lokasi: "Mills Indah"
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

    // Data Dummy Training Type
    const trainingTypeData = [{
            id: "GAP",
            nama: "Good Agricultural Practices"
        },
        {
            id: "K3",
            nama: "Keselamatan & Kesehatan Kerja"
        },
        {
            id: "RSPO",
            nama: "Sertifikasi RSPO"
        }
    ];

    // Render opsi ICS
    const icsSelect = document.getElementById('icsFilter');
    icsData.forEach(i => {
        const opt = document.createElement('option');
        opt.value = i.nama;
        opt.textContent = i.nama;
        icsSelect.appendChild(opt);
    });

    // Render opsi Training Type
    const typeSelect = document.getElementById('trainingTypeFilter');
    trainingTypeData.forEach(t => {
        const opt = document.createElement('option');
        opt.value = t.nama;
        opt.textContent = t.nama;
        typeSelect.appendChild(opt);
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

    // Render tabel with class per td
    function renderTrainingTable(filtered) {
        const tbody = document.getElementById('rekapTrainingTableBody');
        tbody.innerHTML = `<thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase no">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase ics">ICS</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase type">Tipe Training</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tanggal">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase peserta">Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase trainer">Trainer</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase lokasi">Lokasi</th>
                    </tr>
                </thead>
                <tbody>`;
        if (filtered.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" class="text-center px-6 py-4">Tidak ada data training</td></tr>';
            return;
        }
        filtered.forEach((row, idx) => {
            tbody.innerHTML += `
            <tr>
                <td class="px-6 py-4 no">${idx + 1}</td>
                <td class="px-6 py-4 ics">${row.ics}</td>
                <td class="px-6 py-4 type">${row.type}</td>
                <td class="px-6 py-4 tanggal">${row.tanggal}</td>
                <td class="px-6 py-4 peserta">${row.peserta}</td>
                <td class="px-6 py-4 trainer">${row.trainer}</td>
                <td class="px-6 py-4 lokasi">${row.lokasi}</td>
            </tr>`;
        });
        tbody.innerHTML += `</tbody>`;
        toggleTrainingTableColumns();
    }

    // Render semua data awal
    renderTrainingTable(trainingData);

    const filterTrainingForm = document.getElementById('filterTrainingForm');
    filterTrainingForm.onsubmit = function(e) {
        e.preventDefault();
        const btnText = document.getElementById('btnFilterText');
        const spinner = document.getElementById('loadingFilterSpinner');

        // Tampilkan spinner, sembunyikan teks tombol
        btnText.classList.add('hidden');
        spinner.classList.remove('hidden');

        // Ambil nilai filter ICS dan Training Type
        const ics = icsSelect.value;
        const type = typeSelect.value;

        // Filter data training sesuai ICS dan Training Type
        const filtered = trainingData.filter(row => {
            let cond = true;
            if (ics && row.ics !== ics) cond = false;
            if (type && row.type !== type) cond = false;
            return cond;
        });

        // Simulasi proses filter (misal fetch data, reload table, dll.)
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

    // Export PDF/Excel (placeholder fungsi, implementasi bebas sesuai kebutuhan)
    function exportPDF() {
        alert('Export PDF');
    }

    function exportExcel() {
        alert('Export Excel');
    }
</script>

<?php include 'footer.php'; ?>