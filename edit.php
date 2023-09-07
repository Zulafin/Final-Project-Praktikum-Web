<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Karyawan</title>
    <style>
        body {
            background-color: #4152b3;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            width: 400px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .success-message {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            color: #3c763d;
            font-weight: bold;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            color: #fff;
            background-color: #4152b3;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #31419e;
        }
    </style>
    <script>
        function showPopup() {
            var result = confirm("Apakah Anda yakin ingin menyimpan perubahan?");
            if (result) {
                alert("Data berhasil disimpan.");
                window.location.href = "admin.php";
            }
        }
    </script>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "karyawan");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_karyawan'])) {
        $id = $_GET['id_karyawan'];

        $query = "SELECT * FROM karyawan WHERE id_karyawan = $id";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_karyawan'])) {
        $id = $_POST['id_karyawan'];
        $nama = $_POST['nama_karyawan'];
        $jabatan = $_POST['jabatan'];
        $tgl_masuk = $_POST['tgl_masuk'];
        $nama_divisi = $_POST['nama_divisi'];

        $query = "UPDATE karyawan SET nama_karyawan='$nama', jabatan='$jabatan', tgl_masuk='$tgl_masuk', nama_divisi='$nama_divisi' WHERE id_karyawan=$id";
        mysqli_query($conn, $query);

        // Redirect to admin.php after update
        header("Location: admin.php?success=true");
        exit();
    }

    // Get list of divisions
    $query_divisions = "SELECT * FROM divisi";
    $result_divisions = mysqli_query($conn, $query_divisions);
    $divisions = mysqli_fetch_all($result_divisions, MYSQLI_ASSOC);
    ?>

    <div class="container">
        <div class="form-container">
            <h1>Edit Data Karyawan</h1>

            <?php
            if (isset($_GET['success']) && $_GET['success'] == 'true') {
                echo '<div class="success-message">Data berhasil diperbarui.</div>';
            }
            ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_karyawan">Nama Karyawan:</label>
                    <input type="text" class="form-control" name="nama_karyawan" value="<?php echo $data['nama_karyawan']; ?>">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan:</label>
                    <input type="text" class="form-control" name="jabatan" value="<?php echo $data['jabatan']; ?>">
                </div>
                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk:</label>
                    <input type="text" class="form-control" name="tgl_masuk" value="<?php echo $data['tgl_masuk']; ?>">
                </div>
                <div class="form-group">
                    <label for="nama_divisi">Divisi:</label>
                    <select name="nama_divisi" class="form-control">
                        <?php foreach ($divisions as $division) { ?>
                            <option value="<?php echo $division['nama_divisi']; ?>" <?php if ($data['nama_divisi'] == $division['nama_divisi']) echo 'selected'; ?>>
                                <?php echo $division['nama_divisi']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <input type="hidden" name="id_karyawan" value="<?php echo $data['id_karyawan']; ?>">

                <button type="submit" class="btn btn-primary" onclick="showPopup()">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>
