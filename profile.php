<?php include 'header.php'; ?>

<section class="flex-1 overflow-y-auto p-8 bg-gray-50">
    <!-- Header Profil -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border border-gray-100">
        <div class="flex items-center space-x-6">
            <img class="w-24 h-24 rounded-full object-cover border-4" src="https://ui-avatars.com/api/?name=WRI&background=4299e1&color=fff" alt="Avatar">
            <div>
                <h2 class="text-2xl font-bold text-gray-800"><?= $user['profile']['name'] ?></h2>
                <p class="text-gray-500"><?= $user['email'] ?></p>
                <span class="text-xs text-green-600 font-medium">● Active</span>
            </div>
        </div>
    </div>

    <!-- Tab Profil dan Pengaturan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Wrapper: hanya satu x-data -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 col-span-2" x-data="{ tab: 'biodata' }">
            <!-- Tab Header -->
            <div class="border-b border-gray-200 px-6 pt-6">
                <nav class="-mb-px flex space-x-6">
                    <button @click="tab = 'biodata'" :class="tab === 'biodata' ? 'border-[#F0AB00] text-[#F0AB00]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap pb-2 px-1 border-b-2 font-medium text-sm">
                        Biodata
                    </button>
                    <button @click="tab = 'password'" :class="tab === 'password' ? 'border-[#F0AB00] text-[#F0AB00]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap pb-2 px-1 border-b-2 font-medium text-sm">
                        Ubah Password
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Biodata -->
                <div x-show="tab === 'biodata'" x-transition>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Profil</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama Lengkap</p>
                                <p class="text-base font-medium text-gray-800"><?= $user['profile']['name'] ?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Role</p>
                                <p class="text-base font-medium text-gray-800">Administrator Sistem</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">No. Telepon</p>
                                <p class="text-base font-medium text-gray-800">+62 812 3456 7890</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Terakhir Login</p>
                                <p class="text-base font-medium text-gray-800">26 Juli 2025, 10:32 WIB</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="text-base font-medium text-gray-800">Jl. Cendana No. 12, Jakarta Selatan</p>
                        </div>
                    </div>
                </div>

                <!-- Ubah Password -->
                <div x-show="tab === 'password'" x-transition>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ganti Kata Sandi</h3>
                    <form method="POST" action="change-password.php" class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1" for="current_password">Kata Sandi Lama</label>
                            <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#F0AB00] focus:border-[#F0AB00]">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1" for="new_password">Kata Sandi Baru</label>
                            <input type="password" id="new_password" name="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#F0AB00] focus:border-[#F0AB00]">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1" for="confirm_password">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-[#F0AB00] focus:border-[#F0AB00]">
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="bg-[#F0AB00] hover:bg-yellow-500 text-white px-4 py-2 rounded-md shadow">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Riwayat Login -->
        <div class="pt-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Riwayat Login Terakhir</h3>
            <div class="space-y-3">

                <!-- Login Item -->
                <div class="flex items-start space-x-3 bg-gray-50 rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800 font-medium">26 Juli 2025, 10:32 WIB</p>
                        <p class="text-xs text-gray-500">IP Address: 103.45.6.12</p>
                    </div>
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Berhasil</span>
                </div>

                <div class="flex items-start space-x-3 bg-gray-50 rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800 font-medium">25 Juli 2025, 14:19 WIB</p>
                        <p class="text-xs text-gray-500">IP Address: 103.45.6.12</p>
                    </div>
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Berhasil</span>
                </div>

                <div class="flex items-start space-x-3 bg-gray-50 rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition">
                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800 font-medium">24 Juli 2025, 08:44 WIB</p>
                        <p class="text-xs text-gray-500">IP Address: 103.45.6.12</p>
                    </div>
                    <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Expired OTP</span>
                </div>

                <div class="flex items-start space-x-3 bg-gray-50 rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition">
                    <div class="bg-red-100 text-red-600 p-2 rounded-full">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800 font-medium">23 Juli 2025, 19:02 WIB</p>
                        <p class="text-xs text-gray-500">IP Address: 103.45.6.13</p>
                    </div>
                    <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">Gagal</span>
                </div>

            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>