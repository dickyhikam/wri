<!DOCTYPE html>
<html lang="en">
<?php
// Read the data from the JSON file
$json_data = file_get_contents('new_user.json');

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - WRI Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /* Tab container */
        .tab-container {
            display: flex;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        /* Tab button style */
        .tab-button {
            flex: 1;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            border: 2px solid #ddd;
            border-radius: 8px 8px 8px 8px;
            transition: all 0.3s ease;
            margin: 5px;
        }

        /* Hover effect for tabs */
        .tab-button:hover {
            background-color: #9B9B9B;
            color: white;
        }

        /* Active tab styling */
        .tab-button.active {
            background-color: #f0ab00;
            color: white;
            font-weight: bold;
            border-color: #f0ab00;
        }

        .tab-button.active:hover {
            background-color: #9B9B9B;
            border-color: #9B9B9B;
            color: white;
        }

        /* Hiding radio buttons */
        input[type="radio"] {
            display: none;
        }
    </style>
</head>

<body class="relative min-h-screen flex flex-col items-center justify-center font-sans px-4">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-[url('img/bg_login.png')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card Register -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md border border-white/30 shadow-xl rounded-xl w-full max-w-md p-8">
        <div class="text-center mb-6">
            <img src="img/logo_text.png" alt="WRI Indonesia" class="h-12 mx-auto mb-4" />
            <h2 class="text-2xl font-bold text-wri-black">Buat Akun MIS Anda</h2>
            <p class="text-sm text-wri-black">Bergabunglah untuk kolaborasi & pelaporan</p>
        </div>

        <form class="space-y-5" id="registerForm">
            <!-- Radio Buttons as Tabs -->
            <div class="tab-container" id="tab-container">
                <label for="ics" class="tab-button" id="ics-tab">ICS</label>
                <label for="wri" class="tab-button" id="wri-tab">WRI</label>
            </div>
            <input type="radio" id="ics" name="organization" value="ics" required checked>
            <input type="radio" id="wri" name="organization" value="wri" required>

            <div>
                <label for="name" class="block text-sm text-wri-black mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" placeholder="Nama lengkap anda" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
            </div>
            <div>
                <label for="phone_number" class="block text-sm text-wri-black mb-1">Nomor Telp <span class="text-red-500">*</span></label>
                <input type="text" id="phone_number" name="phone_number" placeholder="Nomor telp anda" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
            </div>
            <div>
                <label for="email" class="block text-sm text-wri-black mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" placeholder="nama@wri-indonesia.org" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
            </div>
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm text-wri-black mb-1">Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="••••••••" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow pr-10" required />
                    <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-2.5 text-gray-500 hover:text-wri-yellow text-sm focus:outline-none">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="confirm_password" class="block text-sm text-wri-black mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow pr-10" required />
                    <button type="button" onclick="togglePassword('confirm_password', this)" class="absolute right-3 top-2.5 text-gray-500 hover:text-wri-yellow text-sm focus:outline-none">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>


            <button type="submit" class="w-full bg-wri-yellow hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-md transition">
                Register
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="auth-login" class="text-wri-yellow font-medium hover:underline">Masuk di sini</a>
        </p>
    </div>
    <div class="relative z-10 text-center mt-8 text-xs text-white">
        &copy; <span id="year"></span> Portal MIS. Dibuat oleh
        <a class="text-wri-yellow font-medium" href="https://wri-indonesia.org/id" target="_blank">WRI Indonesia</a>.
    </div>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePassword(inputId, toggleBtn) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                toggleBtn.textContent = "Hide";
            } else {
                input.type = "password";
                toggleBtn.textContent = "Show";
            }
        }

        // Set dynamic year in footer
        document.getElementById("year").textContent = new Date().getFullYear();

        // JavaScript to manage the active tab state
        const icsTab = document.getElementById('ics-tab');
        const wriTab = document.getElementById('wri-tab');
        const icsRadio = document.getElementById('ics');
        const wriRadio = document.getElementById('wri');
        const tabContainer = document.getElementById('tab-container');

        // Function to handle tab switching
        function handleTabSwitch() {
            if (icsRadio.checked) {
                icsTab.classList.add('active');
                wriTab.classList.remove('active');
                // tabContainer.classList.add('active');
            } else if (wriRadio.checked) {
                wriTab.classList.add('active');
                icsTab.classList.remove('active');
                // tabContainer.classList.add('active');
            }
        }

        // Event listeners for the radio buttons
        icsRadio.addEventListener('change', handleTabSwitch);
        wriRadio.addEventListener('change', handleTabSwitch);

        // Initialize the active tab state
        handleTabSwitch();

        // Form submission handler
        document.querySelector('#registerForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Capture data from form fields
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const phone_number = document.getElementById('phone_number').value;
            const type_user = document.querySelector('input[name="organization"]:checked').value;

            // Prepare data as an object
            const formData = {
                name: name,
                email: email,
                password: password,
                phone_number: phone_number,
                type_user: type_user
            };

            // Send data to the server via AJAX (fetch)
            fetch('action/auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData) // Send the form data as JSON
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log response from server (for debugging)
                    if (data.status === 'success') {
                        showSweetAlert('success', 'Register Success', data.message, true);

                        setTimeout(function() {
                            window.location.href = 'auth-register-verif'; // Redirect to a success page
                        }, 2000); // 2 second delay before redirection

                    } else {
                        showSweetAlert('error', 'Invalid Register', data.message, false);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

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
</body>

</html>