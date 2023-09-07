<!DOCTYPE html>
<html>

<head>
    <title>Data Divisi</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            background-color: #4152b3;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 1000px;
        }

        .box {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h3 {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <br>
    <center>
        <div class="container">
            <div class="box">

                <h3>Masukkan Divisi Kantor</h3>
                
                <form method="POST" action="divisi.php">
                    <table border="0" width="50%">
                        <tr>
                        <td width="25%">ID Divisi</td>
                        <td width="5%">:</td>
                        <td width="65%">
                            <input type="text" name="id_divisi" size="40" class="form-control form-control-user"
                                style="margin-bottom: 10px;">
                        </td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Divisi</td>
                            <td width="5%">:</td>
                            <td width="65">
                             <input type="text" name="nama_divisi" size="40" class="form-control form-control-user"
                                style="margin-bottom: 10px;">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" name="submit" value="Masukkan" class="button" style="background-color: #4CAF50;">
                    
                </form>

                <?php
                error_reporting(E_ALL & E_NOTICE);

                // Koneksi ke database
                $conn = mysqli_connect("localhost", "root", "", "karyawan");

                $id_divisi = $_POST["id_divisi"];
                $nama_divisi = $_POST["nama_divisi"];

                $submit = $_POST["submit"];
                $input = "INSERT INTO divisi(id_divisi, nama_divisi) VALUES ('$id_divisi', '$nama_divisi')";
                if ($submit) {
                    if ($id_divisi == '') {
                        echo "</br>ID divisi tidak boleh kosong, harus diisi";
                    } elseif ($nama_divisi == '') {
                        echo "</br>Nama Divisi tidak boleh kosong, harus diisi";
                    } else {
                        mysqli_query($conn, $input);
                        echo "</br>Data berhasil dimasukkan";
                    }
                }

                ?>

                <hr>
                <h3>Data Divisi</h3>
                <table class="table table-bordered">
                    <tr align="center">
                        <td width="20%"><b>ID Divisi</b></td>
                        <td width="30%"><b>Nama Divisi</b></td>
                        <td colspan="2" width="20%"><b>Keterangan</b></td>
                    </tr>

                    <?php
                    $cari = "SELECT * FROM divisi ORDER BY id_divisi";
                    $hasil_cari = mysqli_query($conn, $cari);
                    while ($data = mysqli_fetch_row($hasil_cari)) {
                        echo "
                            <tr>
                                <td width='20%'>$data[0]</td>
                                <td width='30%'>$data[1]</td>
                                <td width='10%'><a href='edit_divisi.php?id_divisi=$data[0]'>Edit</a></td>
                                <td width='10%'><a href='#' onclick='confirmDelete($data[0])'>Delete</a></td>
                            </tr>";
                    }
                    ?>

                </table>

                <div align="center">
                    <a href="admin.php" class="btn btn-warning"><i class="fa fa-table"></i>kembali</a>
                </div>
            </div>
        </div>
    </center>

    <script>
        function confirmDelete(id_divisi) {
            Swal.fire({
                title: 'Konfirmasi Delete',
                text: 'Apakah Anda yakin ingin menghapus divisi ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete_divisi.php?id_divisi=' + id_divisi;
                }
            });
        }
    </script>
</body>

</html>
