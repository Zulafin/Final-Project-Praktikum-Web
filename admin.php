<!DOCTYPE html>
<html>

<head>
    <title>Rekapitulasi Data Karyawan</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
    body {
        background-color: #4152b3;
        font-family: Arial, Helvetica, sans-serif;
    }
    .box {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    h3 {
            font-weight: bold;
    }
</style>

<body>
    <br>
    <center>
        <div class="container" style="width: 1000px;">
            <div class="table-responsive box">
            <h3>Rekapitulasi Data Karyawan</h3>
                <div align="right">
                    <a href="divisi.php" class="btn btn-warning"><i class="fa fa-table"></i>Tambah Data Divisi</a>
                    <a href="logout.php" class="btn btn-danger"><i class="fa fa-table"></i>Logout</a>
                </div>
                <br>

                <table class="table table-bordered">
                    <tr align='center'>
                        <td width="10%"><b>ID Karyawan</b></td>
                        <td width="20%"><b>Nama Karyawan</b></td>
                        <td width="10%"><b>Jabatan</b></td>
                        <td width="15%"><b>Tanggal Masuk</b></td>
                        <td width="15%"><b>Divisi</b></td>
                        <td colspan=2 width="20%"><b>Keterangan</b></td>
                    </tr>

                    <!-- //menampilkan data karyawan -->
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "karyawan");

                    $cari = "SELECT * FROM karyawan, divisi WHERE karyawan.nama_divisi = divisi.nama_divisi ORDER BY karyawan.id_karyawan";
                    $hasil_cari = mysqli_query($conn, $cari);
                    while ($data = mysqli_fetch_row($hasil_cari)) {
                        echo "
                            <tr>
                                <td align='center'>$data[0]</td>
                                <td>$data[1]</td>
                                <td>$data[2]</td>
                                <td align='center'>$data[3]</td>
                                <td>$data[4]</td>
                                <td width='10%'><a href='edit.php?id_karyawan=$data[0]'>Edit</a></td> 
                                <td width='10%'><a href='#' onclick='confirmDelete($data[0])'>Delete</a></td>
                            </tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>
    </center>

    <script>
        // Fungsi untuk menampilkan pop-up konfirmasi delete
        function confirmDelete(id_karyawan) {
            Swal.fire({
                title: 'Konfirmasi Delete',
                text: 'Apakah Anda yakin ingin menghapus data karyawan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?id_karyawan=' + id_karyawan;
                }
            });
        }
    </script>
</body>

</html>
