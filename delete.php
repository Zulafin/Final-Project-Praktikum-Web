<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "karyawan");

// Cek jika parameter id_karyawan ada
if (isset($_GET['id_karyawan'])) {
    $id_karyawan = $_GET['id_karyawan'];

    // Query untuk menghapus karyawan berdasarkan id_karyawan
    $hapus = "DELETE FROM karyawan WHERE id_karyawan = '$id_karyawan'";
    $result = mysqli_query($conn, $hapus);

    if ($result) {
        // Jika berhasil dihapus, redirect kembali ke halaman admin
        echo "
		<script>
		alert('data berhasil di hapus');
		document.location.href='admin.php';
        </script>";
        exit();
    } else {
        // Jika gagal dihapus, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>