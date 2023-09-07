<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "karyawan");

// Cek jika parameter id_divisi ada
if (isset($_GET['id_divisi'])) {
    $id_divisi = $_GET['id_divisi'];

    // Query untuk menghapus divisi berdasarkan id_divisi
    $hapus = "DELETE FROM divisi WHERE id_divisi = '$id_divisi'";
    $result = mysqli_query($conn, $hapus);

    if ($result) {
        // Jika berhasil dihapus, redirect kembali ke halaman divisi
        echo "
		<script>
		alert('data berhasil di hapus');
		document.location.href='divisi.php';
        </script>";
        exit();
    } else {
        // Jika gagal dihapus, tampilkan pesan error
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>