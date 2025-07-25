<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - WRI Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

</head>

<body class="relative min-h-screen flex flex-col items-center justify-center font-sans px-4">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-[url('img/bg_login.png')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card Register -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md border border-white/30 shadow-xl rounded-xl w-full max-w-md p-8">
        <div class="text-center mb-6">
            <img src="img/logo_text.png" alt="WRI Indonesia" class="h-12 mx-auto mb-4" />
            <h2 class="text-2xl font-bold text-wri-black">Create your MIS Account</h2>
            <p class="text-sm text-wri-black">Join our platform for collaboration & reporting</p>
        </div>

        <form class="space-y-5">
            <div>
                <label for="name" class="block text-sm text-wri-black mb-1">Full Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" placeholder="Your full name" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
            </div>
            <div>
                <label for="email" class="block text-sm text-wri-black mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" placeholder="name@wri-indonesia.org" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
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
                <label for="confirm_password" class="block text-sm text-wri-black mb-1">Confirm Password <span class="text-red-500">*</span></label>
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
            Already have an account?
            <a href="auth-login" class="text-wri-yellow font-medium hover:underline">Sign in here</a>
        </p>
    </div>
    <div class="relative z-10 text-center mt-8 text-xs text-white">
        &copy; <span id="year"></span> MIS Portal. Built by
        <span class="text-wri-yellow font-medium">WRI Indonesia</span>.
    </div>

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
    </script>
</body>

</html>