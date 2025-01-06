<?php
session_start();  // Memulai session

// Menghapus semua data session
session_unset(); 

// Menghancurkan session
session_destroy(); 

// Redirect ke halaman login setelah logout
header("Location: login.php");
exit;  // Pastikan tidak ada kode yang dieksekusi setelah redirect
?>
