<?php
session_start(); // Memulai session

// Menghapus semua variabel session
session_unset();

// Menghancurkan session
session_destroy();

// Mengalihkan pengguna ke halaman login
header("Location: auth-login");
exit(); // Hentikan eksekusi PHP setelah pengalihan
