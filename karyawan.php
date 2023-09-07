<!DOCTYPE html>
<html>

<head>
    <title>Data Karyawan</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            background-color: #4152b3;
            font-family: Arial, sans-serif;
        }

        h3 {
            font-weight: bold;
            color: #1b1e23;
        }

        .table-container {
            background-color: #fff;
            border-radius: 4px;
            padding: 40px;
            margin: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            overflow: auto;
        }

        .table-container table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-container td {
            padding: 8px;
        }

        .confirm-delete-link {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<?php
$conn = mysqli_connect("localhost", "root", "", "karyawan");
?>

<body>
        <form method="POST" action="karyawan.php">
            <div class="table-container">
            <center>
                <h3>Masukkan Data Karyawan</h3>
                <table>
                    <tr>
                        <td width="25%">ID Karyawan</td>
                        <td width="5%">:</td>
                        <td width="65%">
                            <input type="text" name="id_karyawan" size="40" class="form-control form-control-user"
                                style="margin-bottom: 10px;">
                        </td>
                    </tr>

                    <tr>
                        <td width="25%">Nama Karyawan</td>
                        <td width="5%">:</td>
                        <td width="65%">
                            <input type="text" name="nama_karyawan" size="40"
                                class="form-control form-control-user" style="margin-bottom: 10px;">
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Jabatan</td>
                        <td width="5%">:</td>
                        <td width="65%">
                            <input type="text" name="jabatan" size="40" class="form-control form-control-user"
                                style="margin-bottom: 10px;">
                        </td>
                    </tr>

                    <!-- <tr>
                        <td width="25%">Tanggal Masuk</td>
                        <td width="5%">:</td>
                        <td width="65%">
                            <input type="date" name="tgl_masuk" size="40">
                        </td>
                    </tr> -->
                    <tr>
                        <td width="25%">Divisi</td>
                        <td width="5%">:</td>
                        <td width="65%">
                            <select name="nama_divisi" id="id_divisi" class="form-control form-control-user"
                                style="margin-bottom: 10px;">
                                <?php
                                $sql = "SELECT * FROM divisi";
                                $retval = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($retval)) {
                                    echo "<option value='$row[nama_divisi]'>$row[nama_divisi]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="Masukkan" class="btn btn-success mb-3">
            </div>
            <br>


        </form>

        <?php
        error_reporting(E_ALL & E_NOTICE);
        $id_karyawan = $_POST["id_karyawan"];
        $nama_karyawan = $_POST["nama_karyawan"];
        $jabatan = $_POST["jabatan"];
        $tgl_masuk = $_POST["tgl_masuk"];
        $nama_divisi = $_POST["nama_divisi"];
        $submit = $_POST["submit"];
        $input = "INSERT INTO karyawan(id_karyawan, nama_karyawan, jabatan, tgl_masuk, nama_divisi) VALUES ('$id_karyawan', '$nama_karyawan', '$jabatan', NOW(), '$nama_divisi')";

        if ($submit) {
            if ($id_karyawan == '') {
                echo "</br>ID karyawan tidak boleh kosong, harus diisi";
            } elseif ($nama_karyawan == '') {
                echo "</br>Nama karyawan tidak boleh kosong, harus diisi";
            } elseif ($jabatan == '') {
                echo "</br> Jabatan tidak boleh kosong, harus diisi";
            }
            // elseif ( $tgl_masuk== '') {
            //     echo "</br> Tanggal masuk tidak boleh kosong, harus diisi";
            // }
            elseif ($nama_divisi == '') {
                echo "</br> Nama divisi tidak boleh kosong, harus diisi";
            } else {
                mysqli_query($conn, $input);
                echo "</br>Data berhasil dimasukkan";
            }
        }
        ?>
        <hr>
        <br>
        <div class="table-container">
        <center><h3>Data Karyawan</h3></center>
        <div align="right" style='margin-right: 5px'>
            <a href="logout.php" class="btn btn-danger"><i class="fa fa-table"></i>Logout</a>
        </div>
            <br>
            <table class="table table-bordered">
                <tr>
                    <td width="15%"><b>ID Karyawan</b></td>
                    <td width="25%"><b>Nama Karyawan</b></td>
                    <td width="20%"><b>Jabatan</b></td>
                    <td width="20%"><b>Tanggal Masuk</b></td>
                    <td width="20%"><b>Divisi</b></td>
                    <!-- <td width="15%" colspan="2" align="center"><b>Aksi</b></td> -->
                </tr>
                <?php
                $cari = "SELECT * FROM karyawan ORDER BY id_karyawan";
                $hasil_cari = mysqli_query($conn, $cari);
                while ($data = mysqli_fetch_row($hasil_cari)) {
                    echo "<tr>
                                <td width='15%'>$data[0]</td>
                                <td width='25%'>$data[1]</td>
                                <td width='20%'>$data[2]</td>
                                <td width='20%'>$data[3]</td>
                                <td width='20%'>$data[4]</td>

                            </tr>";
                }
                ?>
            </table>
        </div>
    </center>
    <!-- <script>
        function confirmDelete(id_karyawan) {
            Swal.fire({
                title: 'Konfirmasi Delete',
                text: 'Apakah Anda yakin ingin menghapus karyawan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete_karyawan.php?id_karyawan=' + id_karyawan;
                }
            });
        }
    </script> -->
</body>

</html>
