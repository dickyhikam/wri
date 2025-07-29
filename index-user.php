<?php include 'header.php'; ?>

<!-- Main Dashboard Content -->
<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
  <!-- Welcome Banner -->
  <div class="bg-[#F0AB00] rounded-xl p-6 mb-8 text-white shadow-lg">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold mb-2">Selamat Datang, User MIS!</h2>
        <p class="opacity-90">Pantau dan kelola seluruh data dan perkebunan sawit secara real-time</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-chart-pie text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Info Banner for Access and Role Change -->
  <div class="bg-blue-500 rounded-xl p-6 text-white shadow-lg mb-8">
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-lg font-bold">Informasi !!!</h2>
        <p class="opacity-90">Akun Anda belum memiliki akses ke menu. Untuk mendapatkan akses, harap hubungi admin.</p>
        <p class="opacity-90 mt-2">Perubahan role akun Anda akan diproses dalam waktu 2x24 jam.</p>
      </div>
      <div class="bg-white bg-opacity-20 p-3 rounded-lg">
        <i class="fas fa-info-circle text-3xl"></i>
      </div>
    </div>
  </div>

  <!-- Send Request Button -->
  <div class="flex justify-center">
    <button id="sendRequestButton" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
      Kirim Permintaan Akses ke Admin
    </button>
  </div>

</section>

<?php include 'footer.php'; ?>

<script>
  // Menambahkan event listener pada tombol send request
  document.getElementById('sendRequestButton').addEventListener('click', function() {
    // Menampilkan alert atau bisa kirim email ke admin (untuk tujuan ini hanya alert)
    showSweetAlert('success', 'Permintaan Terkirim', 'Permintaan akses Anda telah dikirim ke admin. Harap tunggu konfirmasi dalam waktu 2x24 jam.', true, '');
  });
</script>