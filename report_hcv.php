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
        <h3 class="text-lg font-semibold mb-4">Filter Laporan HCV</h3>
        <form id="filterHCVForm" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-6">
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">ICS</label>
                <select id="icsFilter" class="border rounded-lg px-4 py-2 w-full">
                    <option value="">Semua ICS</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-600 mb-1 block">Tipe HCV</label>
                <select id="trainingTypeFilter" class="border rounded-lg px-4 py-2 w-full">
                    <option value="">Semua HCV</option>
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
                        <span class="ml-2">Tipe HCV</span>
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
            <h3 class="font-semibold text-lg">Daftar Rekap HCV</h3>
            <div class="space-x-2">
                <button onclick="exportPDF()" class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-file-pdf"></i> PDF</button>
                <button onclick="exportExcel()" class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-file-excel"></i> Excel</button>
                <button onclick="window.print()" class="bg-gray-500 text-white px-3 py-1 rounded-lg text-sm"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="rekapHCVTableBody">
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

    // Data Dummy HCV
    const trainingData = [{
            ics: "ICS A",
            type: "HCV Site",
            tanggal: "2025-08-01",
            peserta: 10,
            trainer: "Budi Supervisor",
            lokasi: "Site Sungai A"
        },
        {
            ics: "ICS B",
            type: "HCV Site",
            tanggal: "2025-08-05",
            peserta: 15,
            trainer: "Siti Rahma",
            lokasi: "Site Hutan B"
        },
        {
            ics: "ICS C",
            type: "Environmental Assessment",
            tanggal: "2025-08-10",
            peserta: 20,
            trainer: "Anton Pratama",
            lokasi: "Area Bukit C"
        },
        {
            ics: "ICS A",
            type: "Social Impact",
            tanggal: "2025-08-15",
            peserta: 12,
            trainer: "Dewi",
            lokasi: "Desa D"
        },
        {
            ics: "ICS B",
            type: "Conservation Plan",
            tanggal: "2025-08-18",
            peserta: 18,
            trainer: "Joko",
            lokasi: "Lahan E"
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

    // Data Dummy HCV Type
    const trainingTypeData = [{
            id: "GAP",
            nama: "Good Agricultural Practices"
        },
        {
            id: "HCV",
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

    // Render opsi HCV Type
    const typeSelect = document.getElementById('trainingTypeFilter');
    trainingTypeData.forEach(t => {
        const opt = document.createElement('option');
        opt.value = t.nama;
        opt.textContent = t.nama;
        typeSelect.appendChild(opt);
    });

    // Fungsi toggle kolom tabel berdasarkan checkbox
    function toggleHCVTableColumns() {
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
        cb.addEventListener('change', toggleHCVTableColumns);
    });

    // Panggil sekali saat halaman load untuk set kolom default
    window.addEventListener('DOMContentLoaded', toggleHCVTableColumns);

    // Render tabel with class per td
    function renderHCVTable(filtered) {
        const tbody = document.getElementById('rekapHCVTableBody');
        tbody.innerHTML = `<thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase no">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase ics">ICS</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase type">Tipe HCV</th>
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
        toggleHCVTableColumns();
    }


    // Render semua data awal
    renderHCVTable(trainingData);

    const filterHCVForm = document.getElementById('filterHCVForm');
    filterHCVForm.onsubmit = function(e) {
        e.preventDefault();
        const btnText = document.getElementById('btnFilterText');
        const spinner = document.getElementById('loadingFilterSpinner');

        // Tampilkan spinner, sembunyikan teks tombol
        btnText.classList.add('hidden');
        spinner.classList.remove('hidden');

        // Ambil nilai filter ICS dan HCV Type
        const ics = icsSelect.value;
        const type = typeSelect.value;

        // Filter data training sesuai ICS dan HCV Type
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
            toggleHCVTableColumns();

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