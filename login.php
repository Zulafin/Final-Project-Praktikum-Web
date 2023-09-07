<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect('localhost', 'root', '', 'karyawan');
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$submit = $_POST['submit'] ?? '';

if ($submit) {
    $sql_admin = "SELECT * FROM user WHERE username = ? AND password = ? AND status = 'Administrator'";
    $stmt_admin = mysqli_prepare($conn, $sql_admin);
    mysqli_stmt_bind_param($stmt_admin, "ss", $username, $password);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);
    $row_admin = mysqli_fetch_array($result_admin);

    $sql_karyawan = "SELECT * FROM user WHERE username = ? AND password = ? AND status = 'Karyawan'";
    $stmt_karyawan = mysqli_prepare($conn, $sql_karyawan);
    mysqli_stmt_bind_param($stmt_karyawan, "ss", $username, $password);
    mysqli_stmt_execute($stmt_karyawan);
    $result_karyawan = mysqli_stmt_get_result($stmt_karyawan);
    $row_karyawan = mysqli_fetch_array($result_karyawan);

    if ($row_admin) {
        $_SESSION['username'] = $row_admin['username'] ?? '';
        $_SESSION['status'] = $row_admin['status'] ?? '';

        ?>
        <script language="JavaScript">
            alert('Anda Login Sebagai Admin <?php echo $_SESSION['username']; ?>');
            window.location.href = 'admin.php';
        </script>
        <?php
    } elseif ($row_karyawan) {
        $_SESSION['username'] = $row_karyawan['username'] ?? '';
        $_SESSION['status'] = $row_karyawan['status'] ?? '';

        ?>
        <script language="JavaScript">
            alert('Anda Login Sebagai Karyawan <?php echo $_SESSION['username']; ?>');
            window.location.href = 'karyawan.php';
        </script>
        <?php
    } else {
        ?>
        <script language="JavaScript">
            alert("Gagal Login");
            window.location.href = 'login.php';
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        *{
            margin: 10;
            padding: 0;
            outline: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            background-image: url('background.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .center {
            text-align: center;
            margin-top: 200px;
            color: #4152b3;
        }
        .center h2 {
            color: #4152b3;
        }
        .center .login-box {
            display: inline-block;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-left: -700px;
        }
        .center .login-box input[type="text"],
        .center .login-box input[type="password"],
        .center .login-box input[type="submit"] {
            margin: 10px;
            height: 30px;
            width: 200px;
            font-size: 16px;
        }
        .center .login-box input[type="submit"] {
            background-color: #4152b3;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 90px;
        }
    </style>
</head>
<body>
    <form method='post' action='login.php'>
        <div class="center">
            <div class="login-box">
                <h2>Login</h2>
                <p>
                    Username : <input type='text' name='username'><br>
                    Password : <input type='password' name='password'><br>
                    <input type='submit' name='submit' value="Login">
                </p>
            </div>
        </div>
    </form>
</body>
</html>