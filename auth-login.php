<!DOCTYPE html>
<html lang="id">
<?php
session_start();
// Menghapus session jika akses ditolak
// session_unset();      // Hapus semua variabel session
// session_destroy();    // Hapus session dari server
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - WRI Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="relative min-h-screen flex flex-col items-center justify-center font-sans px-4">
    <!-- Gambar Latar + Overlay -->
    <div class="absolute inset-0 bg-[url('img/bg_login.png')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Kartu Login -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md border border-white/30 shadow-xl rounded-xl w-full max-w-md p-8">
        <div class="text-center mb-6">
            <img src="img/logo_text.png" alt="WRI Indonesia" class="h-12 mx-auto mb-4" />
            <h2 class="text-2xl font-bold text-wri-black">Masuk ke Portal MIS</h2>
            <p class="text-sm text-wri-black">Platform kolaborasi & pelaporan</p>
        </div>

        <form class="space-y-5" method="POST">
            <div>
                <label for="email" class="block text-sm text-wri-black mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" placeholder="nama@wri-indonesia.org"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
            </div>

            <div>
                <label for="password" class="block text-sm text-wri-black mb-1">Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="••••••••"
                        class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow pr-10" required />
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-3 top-2.5 text-gray-500 hover:text-wri-yellow text-sm focus:outline-none">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm gap-3 sm:gap-0 mt-2">
                <label class="inline-flex items-center cursor-pointer text-wri-black">
                    <input type="checkbox"
                        class="w-4 h-4 text-wri-yellow border-gray-300 rounded focus:ring-wri-yellow transition duration-200" />
                    <span class="ml-2 select-none">Ingat saya</span>
                </label>

                <a href="#" class="text-wri-brown hover:text-wri-yellow transition duration-200">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="w-full bg-wri-yellow hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-md transition">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="auth-register" class="text-wri-yellow font-medium hover:underline">Daftar sekarang</a>
        </p>
    </div>

    <div class="relative z-10 text-center mt-8 text-xs text-white">
        &copy; <span id="year"></span> Portal MIS. Dibuat oleh
        <a class="text-wri-yellow font-medium" href="https://wri-indonesia.org/id" target="_blank">WRI Indonesia</a>.
    </div>

    <!-- Icon Button di Kanan Bawah -->
    <button class="fixed bottom-6 right-6 bg-[#f0ab00] text-white p-3 rounded-full shadow-lg hover:bg-[#e09900]" id="infoBtn">
        <i class="fas fa-info-circle text-lg"></i>
    </button>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Update tahun secara otomatis
        document.getElementById('year').textContent = new Date().getFullYear();

        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        document.getElementById('infoBtn').addEventListener('click', function() {
            // Membuat tabel HTML untuk menampilkan email dan password dengan tombol Copy di samping email
            const tableContent = `
                <table class="min-w-full table-auto">
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2 flex items-center justify-between">
                                <p>Email : <b id="email1">inactive@example.com</b> 
                                    <button class="copy-btn text-white bg-blue-500 px-2 py-1 rounded ml-4" data-email="inactive@example.com">
                                        <i class="fas fa-copy text-white"></i>
                                    </button> 
                                    <br> Pass : 12 <br>Akun test untuk inactive.
                                </p>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 flex items-center justify-between">
                                <p>Email : <b id="email2">super_admin@example.com</b>
                                    <button class="copy-btn text-white bg-blue-500 px-2 py-1 rounded ml-4" data-email="super_admin@example.com">
                                        <i class="fas fa-copy text-white"></i>
                                    </button> 
                                    <br> Pass : 12 <br>Akun test untuk super admin.
                                </p>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 flex items-center justify-between">
                                <p>Email : <b id="email3">new_user@example.com</b> 
                                    <button class="copy-btn text-white bg-blue-500 px-2 py-1 rounded ml-4" data-email="new_user@example.com">
                                        <i class="fas fa-copy text-white"></i>
                                    </button> 
                                    <br> Pass : 12 <br>Akun test untuk user baru daftar.
                                </p>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 flex items-center justify-between">
                                <p>Email : <b id="email3">user_ics@example.com</b> 
                                    <button class="copy-btn text-white bg-blue-500 px-2 py-1 rounded ml-4" data-email="user_ics@example.com">
                                        <i class="fas fa-copy text-white"></i>
                                    </button> 
                                    <br> Pass : 12 <br>Akun test untuk user ICS.
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            `;

            // Menampilkan SweetAlert
            showSweetAlert('info', 'Informasi Akun', tableContent, false);

            // Menambahkan event listener untuk tombol copy setelah SweetAlert ditampilkan
            document.querySelectorAll('.copy-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Mendapatkan email yang disimpan di atribut data-email
                    const emailText = this.getAttribute('data-email');

                    // Menyalin email ke clipboard
                    navigator.clipboard.writeText(emailText).then(function() {
                        showSweetAlert('success', 'Berhasil', 'Email telah disalin ke clipboard.', false, '');
                    }).catch(function(err) {
                        showSweetAlert('error', 'Gagal', 'Gagal menyalin email ke clipboard.', false, '');
                    });
                });
            });
        });

        // Reusable SweetAlert function
        function showSweetAlert(icon, title, text, autoClose, menu) {
            if (autoClose) {
                Swal.fire({
                    icon: icon, // 'success', 'error', etc.
                    title: title, // The title of the modal
                    html: text, // The message shown inside the modal (supports HTML)
                    confirmButtonText: 'OK', // The button text
                    background: '#f3f4f6', // The background color of the modal
                    allowOutsideClick: false, // Disable clicking outside the modal
                    allowEscapeKey: false, // Disable closing with the Escape key
                    timer: 3000, // Auto-close after 3 seconds
                    timerProgressBar: true, // Show progress bar for the timer
                }).then((result) => {
                    // Redirect to dashboard after auto-close or button click
                    if (result.isConfirmed) {
                        window.location.href = menu; // Replace with your actual dashboard URL
                    }
                });
            } else {
                Swal.fire({
                    icon: icon, // 'error' for invalid OTP
                    title: title, // The title of the modal
                    html: text, // The message shown inside the modal (supports HTML)
                    confirmButtonText: 'OK', // The button text
                    background: '#f3f4f6', // The background color of the modal
                    allowOutsideClick: false, // Disable clicking outside the modal
                    allowEscapeKey: false, // Disable closing with the Escape key
                });
            }
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $jsonFile = 'data/user_management.json';
        $jsonFileUser = 'data/new_user.json';

        if (file_exists($jsonFile)) {
            $data = json_decode(file_get_contents($jsonFile), true);
            $isValid = false;
            $userFound = null;

            foreach ($data as $entry) {
                foreach ($entry['user_cred'] as $user) {
                    // Cek kecocokan email dan password
                    if (($user['email'] === $email || $user['username'] === $email) && $user['password'] === $password) {
                        $isValid = true;
                        $userFound = $user; // Menyimpan data kredensial pengguna
                        break;
                    }
                }

                // Jika ditemukan data kredensial yang valid, gabungkan dengan profil pengguna
                if ($isValid) {
                    foreach ($entry['user_profile'] as $profile) {
                        if ($profile['id'] == $userFound['id']) {
                            // Gabungkan informasi profil dengan kredensial pengguna
                            $userFound['profile'] = $profile;
                            break;
                        }
                    }

                    foreach ($entry['akun_log'] as $log) {
                        if ($log['id'] == $userFound['id']) {
                            // Gabungkan informasi profil dengan kredensial pengguna
                            $userFound['akun'] = $log;
                            break;
                        }
                    }
                }

                if ($isValid) break;
            }

            // Simpan email ke session
            $_SESSION['email'] = $email;

            if ($isValid) {
                // Cek apakah akun aktif
                if ($userFound['is_active'] == 1) {
                    $_SESSION['userFound'] = $userFound;
                    $menu = $userFound['akun']['role'] == 'User' ? 'index-user' : 'index';
                    // Jika akun aktif
                    echo "<script>showSweetAlert('success', 'Login Berhasil', 'Selamat datang, " . $userFound['profile']['name'] . ". Anda berhasil login.', true, '" . $menu . "');</script>";
                    echo "<script>setTimeout(function(){ window.location.href = 'index'; }, 2000);</script>";
                } else {
                    // Jika akun tidak aktif
                    echo "<script>showSweetAlert('warning', 'Akun Tidak Aktif', 'Akun Anda tidak aktif. Silakan hubungi admin untuk informasi lebih lanjut.', false, '');</script>";
                }
            } else {
                echo "<script>showSweetAlert('error', 'Login Gagal', 'Email atau kata sandi tidak ditemukan.', false, '');</script>";
            }
        } elseif (file_exists($jsonFileUser)) {
            $data = json_decode(file_get_contents($jsonFileUser), true);
            $isValid = false;
            $userFound = null;

            foreach ($data as $entry) {
                foreach ($entry['user_cred'] as $user) {
                    if (($user['email'] === $email || $user['username'] === $email) && $user['password'] === $password) {
                        $isValid = true;
                        $userFound = $user;
                        break;
                    }
                }
                if ($isValid) break;
            }

            // Simpan email ke session
            $_SESSION['email'] = $email;

            if ($isValid) {
                echo "<script>showSweetAlert('success', 'Login Berhasil', 'Email Anda terdaftar, namun belum diverifikasi. Silakan cek kotak masuk Anda untuk menyelesaikan proses verifikasi.', true, 'auth-register-verif');</script>";
                // Mengalihkan pengguna ke halaman verifikasi email atau halaman lain setelah pemberitahuan
                echo "<script>setTimeout(function(){ window.location.href = 'auth-register-verif'; }, 2000);</script>";
            } else {
                echo "<script>showSweetAlert('error', 'Login Gagal', 'Email atau kata sandi tidak ditemukan.', false, '');</script>";
            }
        } else {
            echo "<script>showSweetAlert('error', 'Login Gagal', 'Email atau kata sandi tidak ditemukan.', false, '');</script>";
        }
    }
    ?>
</body>

</html>