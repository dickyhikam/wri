<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - WRI Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        .otp-container {
            display: flex;
            justify-content: space-between;
            max-width: 300px;
            margin: 0 auto;
            gap: 12px;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            border-color: #f0ab00;
            outline: none;
        }

        .otp-input:focus::-webkit-outer-spin-button,
        .otp-input:focus::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Timer Styling */
        .timer {
            font-size: 15px;
            /* font-weight: bold; */
            margin-top: 10px;
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
            <h2 class="text-2xl font-bold text-wri-black">Verify Your Email for MIS Portal</h2>
            <p class="text-sm text-wri-black">Enter the 5-digit code sent <b><span id="masked-email"></span></b> to complete your registration</p>
        </div>

        <!-- OTP Verification Form -->
        <form id="otpVerificationForm" class="space-y-5">
            <!-- OTP Verification Code Input -->
            <div>
                <div class="otp-container">
                    <input type="text" id="otp-1" class="otp-input" maxlength="1" oninput="moveFocus(event, 'otp-2')" />
                    <input type="text" id="otp-2" class="otp-input" maxlength="1" oninput="moveFocus(event, 'otp-3')" />
                    <input type="text" id="otp-3" class="otp-input" maxlength="1" oninput="moveFocus(event, 'otp-4')" />
                    <input type="text" id="otp-4" class="otp-input" maxlength="1" oninput="moveFocus(event, 'otp-5')" />
                    <input type="text" id="otp-5" class="otp-input" maxlength="1" oninput="moveFocus(event, '')" />
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-wri-yellow hover:bg-yellow-500 text-white font-semibold py-2 px-4 rounded-md transition">
                Verify Code
            </button>
        </form>

        <!-- Timer Display -->
        <div id="timer" class="timer">Time remaining: <span id="countdown">05:00</span></div>

        <!-- Resend OTP Button -->
        <button id="resendBtn" class="w-full bg-gray-500 text-white font-semibold py-2 px-4 rounded-md mt-4" style="display: none;">
            Resend OTP
        </button>
    </div>

    <div class="relative z-10 text-center mt-8 text-xs text-white">
        &copy; <span id="year"></span> MIS Portal. Built by
        <a class="text-wri-yellow font-medium" href="https://wri-indonesia.org/id" target="_blank">WRI Indonesia</a>.
    </div>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Move focus to next input automatically when typing
        function moveFocus(event, nextId) {
            if (event.target.value.length === 1 && nextId) {
                document.getElementById(nextId).focus();
            }
        }

        // Mask the email
        function maskEmail(email) {
            const parts = email.split('@');
            const firstPart = parts[0];
            const domainPart = parts[1];
            const maskedFirstPart = firstPart.slice(0, 3) + '***';
            return maskedFirstPart + '@' + domainPart;
        }

        const userEmail = "user@example.com"; // Replace with actual email
        document.getElementById('masked-email').textContent = maskEmail(userEmail);

        // Timer countdown function
        function startCountdown() {
            let timeRemaining = 300; // 5 minutes in seconds
            const countdownElement = document.getElementById('countdown');
            const resendBtn = document.getElementById('resendBtn');

            // Function to update the countdown every second
            const interval = setInterval(() => {
                const minutes = Math.floor(timeRemaining / 60);
                const seconds = timeRemaining % 60;
                countdownElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                timeRemaining--;

                // Show Resend OTP button after 5 minutes
                if (timeRemaining < 0) {
                    clearInterval(interval);
                    resendBtn.style.display = 'block'; // Show the resend button after 5 minutes
                }
            }, 1000);
        }

        // Initialize countdown
        startCountdown();

        // Resend OTP button click handler
        document.getElementById('resendBtn').addEventListener('click', () => {
            Swal.fire({
                icon: 'info',
                title: 'OTP Resent',
                text: 'A new OTP has been sent to your email.',
                confirmButtonText: 'OK',
            });

            // Hide resend button and restart the countdown for another 5 minutes
            document.getElementById('resendBtn').style.display = 'none';
            startCountdown(); // Restart the countdown
        });

        // Form submission handler
        document.getElementById('otpVerificationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const otp1 = document.getElementById('otp-1').value;
            const otp2 = document.getElementById('otp-2').value;
            const otp3 = document.getElementById('otp-3').value;
            const otp4 = document.getElementById('otp-4').value;
            const otp5 = document.getElementById('otp-5').value;

            const otpCode = otp1 + otp2 + otp3 + otp4 + otp5;

            if (otpCode.length === 5) {
                if (otpCode === '12345') {
                    showSweetAlert('success', 'OTP Verified', 'Your OTP has been successfully verified!', true);
                    setTimeout(function() {
                        window.location.href = "index"; // Redirect to your dashboard or homepage
                    }, 2000);
                } else {
                    showSweetAlert('error', 'Invalid OTP', 'The OTP you entered is incorrect. Please try again.', false);
                    document.getElementById('otpVerificationForm').reset();
                }
            } else {
                showSweetAlert('error', 'Invalid OTP', 'Please enter the complete 5-digit OTP code.', false);
            }
        });

        // Reusable SweetAlert function
        function showSweetAlert(icon, title, text, autoClose) {
            if (autoClose) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                    confirmButtonText: 'OK',
                    background: '#f3f4f6',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    timer: 3000,
                    timerProgressBar: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index"; // Replace with your actual dashboard URL
                    }
                });
            } else {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                    confirmButtonText: 'OK',
                    background: '#f3f4f6',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            }
        }
    </script>
</body>

</html>