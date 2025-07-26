<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - WRI Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

</head>

<body class="relative min-h-screen flex flex-col items-center justify-center font-sans px-4">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-[url('img/bg_login.png')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card Login -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md border border-white/30 shadow-xl rounded-xl w-full max-w-md p-8">
        <div class="text-center mb-6">
            <img src="img/logo_text.png" alt="WRI Indonesia" class="h-12 mx-auto mb-4" />
            <h2 class="text-2xl font-bold text-wri-black">Sign in to MIS Portal</h2>
            <p class="text-sm text-wri-black">Collaboration & reporting platform</p>
        </div>

        <form class="space-y-5">
            <div>
                <label for="email" class="block text-sm text-wri-black mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" placeholder="name@wri-indonesia.org" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow" required />
            </div>
            <div>
                <label for="password" class="block text-sm text-wri-black mb-1">Password <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="••••••••" class="w-full px-4 py-2 rounded-md border border-gray-300 focus-ring-wri-yellow pr-10" required />
                    <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-2.5 text-gray-500 hover:text-wri-yellow text-sm focus:outline-none">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm gap-3 sm:gap-0 mt-2">
                <label class="inline-flex items-center cursor-pointer text-wri-black">
                    <input
                        type="checkbox"
                        class="w-4 h-4 text-wri-yellow border-gray-300 rounded focus:ring-wri-yellow transition duration-200" />
                    <span class="ml-2 select-none">Remember me</span>
                </label>

                <a href="#" class="text-wri-brown hover:text-wri-yellow transition duration-200">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="w-full bg-wri-yellow hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-md transition">
                Sign In
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Don't have an account?
            <a href="auth-register" class="text-wri-yellow font-medium hover:underline">Register now</a>
        </p>
    </div>
    <div class="relative z-10 text-center mt-8 text-xs text-white">
        &copy; <span id="year"></span> MIS Portal. Built by
        <a class="text-wri-yellow font-medium" href="https://wri-indonesia.org/id" target="_blank">WRI Indonesia</a>.
    </div>

    <script>
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
    </script>

</body>

</html>