<!DOCTYPE html>
<html>

<head>
    <title>Edit Divisi</title>
    <style>
        body {
            background-color: #4152b3;
            font-family: Arial, sans-serif;
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
        }

        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
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
        }

        .form-group input[type="submit"] {
            background-color: #4152b3;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }
    </style>
    <script>
        var isPopupShown = false;

        function showPopup() {
            if (!isPopupShown) {
                var result = confirm("Apakah Anda yakin ingin menyimpan perubahan?");
                if (result) {
                    isPopupShown = true;
                    alert("Data berhasil disimpan.");
                    window.location.href = "divisi.php";
                }
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <?php
            if (isset($_GET['id_divisi'])) {
                $id_divisi = $_GET['id_divisi'];

                $conn = mysqli_connect("localhost", "root", "", "karyawan");
                if (!$conn) {
                    die("Koneksi database gagal: " . mysqli_connect_error());
                }

                // Query untuk mendapatkan data divisi berdasarkan ID
                $query = "SELECT * FROM divisi WHERE id_divisi = '$id_divisi'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $data = mysqli_fetch_assoc($result);
            ?>
                    <h1>Edit Divisi</h1>
                    <form method="POST" action="edit_divisi.php">
                        <div class="form-group">
                            <label>ID Divisi</label>
                            <input type="text" name="id_divisi" class="form-control" value="<?php echo $data['id_divisi']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Divisi</label>
                            <input type="text" name="nama_divisi" class="form-control" value="<?php echo $data['nama_divisi']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Update" onclick="showPopup()">
                        </div>
                    </form>
            <?php
                } else {
                    echo "Data divisi tidak ditemukan.";
                }
            } else {
                echo "ID divisi tidak ditemukan.";
            }

            if (isset($_POST['submit'])) {
                $id_divisi = $_POST['id_divisi'];
                $nama_divisi = $_POST['nama_divisi'];

                $conn = mysqli_connect("localhost", "root", "", "karyawan");
                if (!$conn) {
                    die("Koneksi database gagal: " . mysqli_connect_error());
                }

                // Query untuk update data divisi
                $update_query = "UPDATE divisi SET nama_divisi = '$nama_divisi' WHERE id_divisi = '$id_divisi'";
                $update_result = mysqli_query($conn, $update_query);

                if ($update_result) {
                    echo "<script>showPopup()</script>";
                } else {
                    echo "Gagal memperbarui data divisi.";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
