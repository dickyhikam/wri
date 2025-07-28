<!DOCTYPE html>
<html lang="id">
<?php
session_start();
session_unset();      // Hapus semua variabel session
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

        // Reusable SweetAlert function
        function showSweetAlert(icon, title, text, autoClose) {
            if (autoClose) {
                // Auto-close alert after a set time (e.g., 3000 milliseconds or 3 seconds)
                Swal.fire({
                    icon: icon, // 'success', 'error', etc.
                    title: title, // The title of the modal
                    text: text, // The message shown inside the modal
                    confirmButtonText: 'OK', // The button text
                    background: '#f3f4f6', // The background color of the modal
                    allowOutsideClick: false, // Disable clicking outside the modal
                    allowEscapeKey: false, // Disable closing with the Escape key
                    timer: 3000, // Auto-close after 3 seconds
                    timerProgressBar: true, // Show progress bar for the timer
                }).then((result) => {
                    // Redirect to dashboard after auto-close or button click
                    if (result.isConfirmed) {
                        // Navigate to the dashboard when "OK" is clicked or after the auto-close timer
                        window.location.href = "auth-register-verif"; // Replace with your actual dashboard URL
                    }
                });
            } else {
                // Error alert that requires the user to click "OK" to close
                Swal.fire({
                    icon: icon, // 'error' for invalid OTP
                    title: title, // The title of the modal
                    text: text, // The message shown inside the modal
                    confirmButtonText: 'OK', // The button text
                    background: '#f3f4f6', // The background color of the modal
                    allowOutsideClick: false, // Disable clicking outside the modal
                    allowEscapeKey: false, // Disable closing with the Escape key
                }).then((result) => {
                    // No navigation needed for error, but we can handle any action if required
                    if (result.isConfirmed) {
                        // Handle the action after the user clicks "OK"
                        // For example, you could clear the OTP inputs or perform other actions
                    }
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
                echo "<script>showSweetAlert('success', 'Login Berhasil', 'Email Anda terdaftar, namun belum diverifikasi. Silakan cek kotak masuk Anda untuk menyelesaikan proses verifikasi.', true);</script>";
                // Mengalihkan pengguna ke halaman verifikasi email atau halaman lain setelah pemberitahuan
                echo "<script>setTimeout(function(){ window.location.href = 'auth-register-verif'; }, 2000);</script>";
            } else {
                echo "<script>showSweetAlert('error', 'Login Gagal', 'Email atau kata sandi tidak ditemukan.', false);</script>";
            }
        } else {
            echo "<script>showSweetAlert('error', 'Login Gagal', 'Email atau kata sandi tidak ditemukan.', false);</script>";
        }
    }
    ?>
</body>

</html>